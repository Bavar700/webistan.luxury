/**
 * Офарин / Молодец — Kids Task Manager
 * Data management module
 */

const STORAGE_KEY = 'kids_tasks_app';
const DEFAULT_PIN = '0000';

// ===== SUPABASE CONFIG =====
const SUPABASE_URL = 'https://pegxtmauqavxcnmiqoaz.supabase.co'; 
const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBlZ3h0bWF1cWF2eGNubWlxb2F6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODA1NzQ2ODcsImV4cCI6MjA5NjE1MDY4N30._7DbonZtdU5GFGqPa9lgQaXbqxxGHlkxol_LgjPghNY'; 

let supabaseClient = null;

function getSupabaseConfig() {
    const url = SUPABASE_URL || safeStorage.getItem('supabase_url') || '';
    const key = SUPABASE_ANON_KEY || safeStorage.getItem('supabase_key') || '';
    return { url, key };
}

function initSupabase() {
    if (supabaseClient) return;
    const config = getSupabaseConfig();
    if (config.url && config.key && typeof supabase !== 'undefined') {
        try {
            supabaseClient = supabase.createClient(config.url, config.key);
        } catch (e) {
            console.error('Failed to initialize Supabase client:', e);
        }
    }
}

function updateSyncStatus(status) {
    const dot = document.getElementById('sync-status-dot');
    const text = document.getElementById('sync-status-text');
    if (!dot || !text) return;
    
    if (status === 'online') {
        dot.style.background = '#10b981'; // green
        text.textContent = (currentLang === 'tg') ? 'Пайваст' : 'Синхронизировано';
    } else if (status === 'syncing') {
        dot.style.background = '#f59e0b'; // yellow
        text.textContent = (currentLang === 'tg') ? 'Ҳамоҳангсозӣ...' : 'Синхронизация...';
    } else {
        dot.style.background = '#ef4444'; // red
        text.textContent = (currentLang === 'tg') ? 'Пайваст нест' : 'Не в сети';
    }
}

function promiseWithTimeout(promise, timeoutMs, name = 'Promise') {
    let timeoutId;
    const timeoutPromise = new Promise((_, reject) => {
        timeoutId = setTimeout(() => reject(new Error(`${name} timed out`)), timeoutMs);
    });
    return Promise.race([promise, timeoutPromise]).finally(() => clearTimeout(timeoutId));
}

async function fetchRemoteState() {
    if (!supabaseClient) return null;
    try {
        const { data: { session } } = await promiseWithTimeout(supabaseClient.auth.getSession(), 5000, 'getSession');
        if (session && session.user) {
            updateSyncStatus('syncing');
            const { data, error } = await promiseWithTimeout(
                supabaseClient
                    .from('family_states')
                    .select('state')
                    .eq('id', session.user.id)
                    .single(),
                10000, 'fetchState'
            );
            
            if (error) {
                if (error.code === 'PGRST116') {
                    console.log('No family state found, creating default...');
                    await saveRemoteState();
                    updateSyncStatus('online');
                    return state;
                }
                console.error('Error fetching state from Supabase:', error);
                updateSyncStatus('offline');
                return null;
            }
            
            if (data && data.state) {
                const remoteState = data.state;
                const localStateStr = safeStorage.getItem(STORAGE_KEY);
                let localState = null;
                if (localStateStr) {
                    try {
                        localState = JSON.parse(localStateStr);
                    } catch (e) {
                        console.warn('Failed to parse localState in fetchRemoteState:', e);
                    }
                }
                
                const remoteVersion = Number(remoteState.version) || 0;
                const localVersion = (localState && Number(localState.version)) || 0;
                const remoteTime = Number(remoteState.lastUpdated) || 0;
                const localTime = (localState && Number(localState.lastUpdated)) || 0;
                
                let isRemoteNewer = false;
                let isLocalNewer = false;
                
                if (remoteVersion > localVersion) {
                    isRemoteNewer = true;
                } else if (localVersion > remoteVersion) {
                    isLocalNewer = true;
                } else {
                    if (remoteTime > localTime) {
                        isRemoteNewer = true;
                    } else if (localTime > remoteTime) {
                        isLocalNewer = true;
                    }
                }
                
                if (isRemoteNewer) {
                    console.log('Remote state is newer. Syncing from remote to local. Versions: remote=', remoteVersion, ', local=', localVersion);
                    migrateState(remoteState);
                    state = remoteState;
                    safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                } else if (isLocalNewer) {
                    console.log('Local state is newer. Syncing from local to remote. Versions: local=', localVersion, ', remote=', remoteVersion);
                    state = localState;
                    migrateState(state);
                    // Save local state to database asynchronously (don't block)
                    saveRemoteState();
                } else {
                    console.log('Local and remote states are already in sync. Version:', localVersion);
                    migrateState(remoteState);
                    state = remoteState;
                    safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                }
                updateSyncStatus('online');
                return state;
            }
        }
    } catch (err) {
        console.error('Failed to fetch remote state:', err);
        updateSyncStatus('offline');
    }
    return null;
}

async function saveRemoteState() {
    if (!supabaseClient) return;
    try {
        const { data: { session } } = await promiseWithTimeout(supabaseClient.auth.getSession(), 5000, 'getSession');
        if (session && session.user) {
            updateSyncStatus('syncing');
            const { error } = await promiseWithTimeout(
                supabaseClient
                    .from('family_states')
                    .upsert({ id: session.user.id, state: state, updated_at: new Date().toISOString() }),
                10000, 'saveState'
            );
            if (error) {
                console.error('Error saving state to Supabase:', error);
                updateSyncStatus('offline');
            } else {
                updateSyncStatus('online');
            }
        }
    } catch (err) {
        console.error('Failed to save remote state:', err);
        updateSyncStatus('offline');
    }
}

function getDefaultTasks() {
    var n = function(k,fb){ return (typeof __ === 'function' ? __('task.default.'+k) : null) || fb; };
    return [
        { id: 'wash',        name: n('wash',        'Шустушӯи дасту рӯй'),             duration: 10, order: 1, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' },
        { id: 'exercise',    name: n('exercise',    'Машқи ҷисмонӣ'),                   duration: 10, order: 2, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' },
        { id: 'bible',       name: n('bible',       'Хондани Китоби Муқаддас ва дуо'),  duration: 20, order: 3, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' },
        { id: 'solfeggio',   name: n('solfeggio',   'Сольфеджио (нотаҳо)'),             duration: 20, order: 4, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' },
        { id: 'piano',       name: n('piano',       'Машқи фортопиано'),                duration: 20, order: 5, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' },
        { id: 'calligraphy', name: n('calligraphy', 'Машқи ҳусни хат'),                 duration: 20, order: 6, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' },
        { id: 'mult',        name: n('mult',        'Ҷадвали зарб'),                    duration: 20, order: 7, isBonus: false, deadline: '', type: 'daily', rewardGold: 1, rewardStars: 1, useTimer: true, days: [1,2,3,4,5,6,0], startTime: '12:00' }
    ];
}

const ACHIEVEMENTS = [
    { id: 'first_task', name: '🌟 Супориши аввал', icon: '🎯', desc: 'Иҷрои 3 супориши аввал' },
    { id: 'all_today', name: '⭐ Ҳамаи супоришҳо', icon: '⭐', desc: 'Иҷрои ҳамаи супоришҳои имрӯз' },
    { id: 'week_streak', name: '🔥 Ҳафтаи пурра', icon: '🔥', desc: '7 рӯз пай дар пай' },
    { id: 'month_streak', name: '🏆 Моҳи тиллоӣ', icon: '🏆', desc: '30 рӯз пай дар пай' },
    { id: 'perfect_zeroes', name: '💯 Сифрҳои комил', icon: '💯', desc: '30 рӯз бе ҷарима' },
    { id: 'fast_worker', name: '⚡ Зудамал', icon: '⚡', desc: '30 рӯз бе деркунӣ' },
    { id: 'early_bird', name: '🌅 Саҳархез', icon: '🌅', desc: '30 рӯз оғози супоришҳо то соати 7:00' },
    { id: 'helper', name: '🤝 Дастёр', icon: '🤝', desc: 'Иҷрои 10 супориши бонусӣ' },
    { id: 'marksman', name: '🎯 Ҳадафрас', icon: '🎯', desc: '50 супориш дар умум' },
    { id: 'test_9', name: '📚 Донишманд', icon: '📚', desc: '9 аз 10 дар санҷиш' },
    { id: 'bonus_3', name: '🦁 Шуҷоъ', icon: '🦁', desc: 'Иҷрои 10 супориши бонусӣ 3 🪙' },
    { id: 'bonus_5', name: '🦸 Қаҳрамон', icon: '🦸', desc: 'Иҷрои 10 супориши бонусӣ 5 🪙' },
    { id: 'bonus_10', name: '🧙 Афсонавӣ', icon: '🧙', desc: 'Иҷрои 10 супориши бонусӣ 10 🪙' },
    { id: 'savings_100', name: '🪙 Сарфакор', icon: '🪙', desc: 'Ҷамъ кардани 100 🪙' },
    { id: 'savings_50', name: '💰 Сарватманд', icon: '💰', desc: 'Ҷамъ кардани 500 🪙' }
];

const MOTIVATIONAL_QUOTES_TG = [
    'Тарбия — беҳтарин сармояест, ки падару модар ба фарзанди худ медиҳад. 💫',
    'Кӯшиш кардан — аллакай муваффақият аст! 🚀',
    'Ҳар як рӯз имконияти наве барои беҳтар шудан аст. 🌅',
    'Илм — чароғи роҳи зиндагӣ аст. 📚',
    'Бо меҳнат ва сабр ба ҳар ҳадаф расидан мумкин аст. 🎯',
    'Парвардигоро, илму ҳикмат ба ман ато фармо! 🤲',
    'Китоб — беҳтарин дӯсти инсон аст. 📖',
    'Вақт — тиллост, онро беҳуда сарф накун! ⏰',
    'Ҳар як кори хуб — садақа аст. 💝',
    'Бо тартиб ва интизом ба муваффақият мерасӣ! 📋',
    'Дониш — қудрат аст! 💪',
    'Имрӯз кӯшиш кун, то фардо беҳтар гардӣ. 🌟',
    'Аз хатоҳо омӯз, лекин ҳеҷ гоҳ таслим нашав! 🔥',
    'Пайвастагӣ калиди муваффақият аст. 🔑',
    'Дар тани солим ақли солим аст! 🏃',
    'Мусиқӣ — ғизои рӯҳ аст. 🎵',
    'Хатти зебо — ойинаи фикри соф аст. ✍️',
    'Риёзиёт — асоси ҳамаи илмҳост. 🔢',
    'Дуо — қувваи рӯҳонист. 🙏',
    'Агар хоҳӣ, ки ҷаҳон тағйир ёбад, аз худат сар кун! 🌍',
    '«Падару модари худро иззат намо...»',
    '«Эй фарзандон, ба падару модари худ итоат кунед...»',
    '«Насиҳати падари худро бишнав...»',
    '«...Таълими модари худро тарк накун.»',
    '«Лаби ростгӯй то абад устувор мемонад...»',
    '«Дуздӣ накунед ва ба якдигар дурӯғ нагӯед...»',
    '«...Ба якдигар ҳақиқатро бигӯед.»',
    '«Касе ки бо ростӣ роҳ меравад, бехатар роҳ меравад...»',
    '«Забони худро аз бадӣ ва дурӯғ нигоҳ дор.»',
    '«Назди мӯрча бирав... ва хирадманд шав.»',
    '«Дасти танбал мӯҳтоҷ мекунад...»',
    '«...Дасти меҳнатдӯст сарватманд месозад.»',
    '«Ҷони меҳнатдӯстон сер хоҳад шуд.»',
    '«Ҳар коре ки мекунед, аз таҳти дил кунед...»',
    '«Дар ҳар меҳнат манфиат ҳаст...»',
    '«Ҷавоби нарм ғазабро дур мекунад...»',
    '«Касе ки пурсабр аст, хиради азим дорад...»',
    '«Одами пурсабр аз паҳлавон беҳтар аст...»',
    '«Нисбат ба якдигар меҳрубон ва дилсӯз бошед...»',
    '«...Дар шунидан чолок ва дар гуфтан оҳиста бош.»',
    '«Одами пурсабр ҷанҷолро фурӯ менишонад...»',
    '«Одами беақл хашми худро берун меорад, вале хирадманд онро бозмедорад.»',
    '«Ҳар он чи мехоҳед ба шумо кунанд, ба онҳо ҳамон тавр кунед.»',
    '«...Ёру ҷӯраҳои бад ахлоқи некро вайрон мекунанд.»',
    '«Кӯдак бо аъмоли худ шинохта мешавад...»',
    '«Номи нек аз сарвати бисёр беҳтар аст...»',
    '«Дар рафтор, дар муҳаббат ва дар покӣ намуна бош.»',
    '«...На бо забон, балки бо амал муҳаббат намоем.»',
    '«Ҳама чизро бе ғур-ғур ва шикоят иҷро кунед.»',
    '«Мағлуби бадӣ нашав, балки бадиро бо некӣ мағлуб кун.»',
    '«Бигзор дигаре туро таъриф кунад, на даҳони худат...»'
];

const MOTIVATIONAL_QUOTES_RU = [
    'Воспитание — лучшее богатство, которое родители дарят своему ребёнку. 💫',
    'Попробовать — уже успех! 🚀',
    'Каждый день — новая возможность стать лучше. 🌅',
    'Знания — свет в пути жизни. 📚',
    'Трудом и терпением можно достичь любой цели. 🎯',
    'Господи, даруй мне знания и мудрость! 🤲',
    'Книга — лучший друг человека. 📖',
    'Время — золото, не трать его напрасно! ⏰',
    'Каждое доброе дело — милостыня. 💝',
    'Порядок и дисциплина ведут к успеху! 📋',
    'Знание — сила! 💪',
    'Старайся сегодня, чтобы завтра стало лучше. 🌟',
    'Учись на ошибках, но никогда не сдавайся! 🔥',
    'Постоянство — ключ к успеху. 🔑',
    'В здоровом теле — здоровый дух! 🏃',
    'Музыка — пища для души. 🎵',
    'Красивый почерк — зеркало чистой мысли. ✍️',
    'Математика — основа всех наук. 🔢',
    'Молитва — духовная сила. 🙏',
    'Хочешь изменить мир — начни с себя! 🌍',
    '«Чти отца твоего и мать твою...»',
    '«Дети, повинуйтесь своим родителям...»',
    '«Слушай наставление отца твоего...»',
    '«...И не отвергай закона матери твоей.»',
    '«Уста правдивые вечно пребудут...»',
    '«Не крадите и не лгите друг другу...»',
    '«...Говорите истину друг другу.»',
    '«Кто ходит в непорочности, тот ходит безопасно...»',
    '«Удерживай язык от зла и уста от лживых слов.»',
    '«Пойди к муравью... и будь мудрым.»',
    '«Ленивая рука делает бедным...»',
    '«...А рука прилежных обогащает.»',
    '«Душа трудолюбивых насытится.»',
    '«Всё, что делаете, делайте от всей души...»',
    '«Во всяком труде есть прибыль...»',
    '«Кроткий ответ отвращает гнев...»',
    '«У терпеливого человека много разума...»',
    '«Долготерпеливый лучше храброго...»',
    '«Будьте добры и сострадательны друг к другу...»',
    '«...Будь скор на слышание, медлен на слова.»',
    '«Человек терпеливый укрощает ссору...»',
    '«Глупый весь гнев изливает, а мудрый сдерживает его.»',
    '«Как хотите, чтобы с вами поступали, так поступайте и вы.»',
    '«...Худые сообщества развращают добрые нравы.»',
    '«Дитя познаётся по своим поступкам...»',
    '«Доброе имя лучше большого богатства...»',
    '«Будь образцом в слове, в поведении, в любви и в чистоте.»',
    '«...Будем любить не словом, но делом.»',
    '«Всё делайте без ропота и сомнения.»',
    '«Не будь побеждён злом, но побеждай зло добром.»',
    '«Пусть хвалит тебя другой, а не уста твои...»'
];

const MOTIVATIONAL_QUOTES_EN = [
    'Education is the best gift parents can give their child. 💫',
    'To try is already success! 🚀',
    'Every day is a new opportunity to become better. 🌅',
    'Knowledge is the light on the path of life. 📚',
    'With hard work and patience, any goal is achievable. 🎯',
    'Lord, grant me knowledge and wisdom! 🤲',
    'A book is a person\'s best friend. 📖',
    'Time is gold — don\'t waste it! ⏰',
    'Every good deed is a blessing. 💝',
    'Order and discipline lead to success! 📋',
    'Knowledge is power! 💪',
    'Try today so tomorrow becomes better. 🌟',
    'Learn from mistakes, but never give up! 🔥',
    'Consistency is the key to success. 🔑',
    'A healthy body holds a healthy mind! 🏃',
    'Music is food for the soul. 🎵',
    'Beautiful handwriting reflects a clear mind. ✍️',
    'Mathematics is the foundation of all sciences. 🔢',
    'Prayer is spiritual strength. 🙏',
    'If you want to change the world — start with yourself! 🌍',
    '"Honour your father and your mother..."',
    '"Children, obey your parents..."',
    '"Listen to your father\'s instruction..."',
    '"...Do not forsake your mother\'s teaching."',
    '"Truthful lips endure forever..."',
    '"Do not steal or lie to one another..."',
    '"...Speak truth to each other."',
    '"Whoever walks in integrity walks securely..."',
    '"Keep your tongue from evil and your lips from lies."',
    '"Go to the ant... and be wise."',
    '"Lazy hands make for poverty..."',
    '"...Diligent hands bring wealth."',
    '"The desires of the diligent are fully satisfied."',
    '"Whatever you do, work at it with all your heart..."',
    '"In all hard work there is profit..."',
    '"A gentle answer turns away wrath..."',
    '"A patient person has great understanding..."',
    '"Better a patient person than a warrior..."',
    '"Be kind and compassionate to one another..."',
    '"...Be quick to listen, slow to speak."',
    '"A patient person calms a quarrel..."',
    '"A fool gives full vent to anger, but a wise person holds it back."',
    '"Do to others as you would have them do to you."',
    '"...Bad company corrupts good character."',
    '"Even a child is known by his actions..."',
    '"A good name is more desirable than great riches..."',
    '"Be an example in conduct, in love and in purity."',
    '"...Let us love not in word but in deed."',
    '"Do everything without grumbling or arguing."',
    '"Do not be overcome by evil, but overcome evil with good."',
    '"Let someone else praise you, not your own mouth..."'
];

const MOTIVATIONAL_QUOTES_UZ = [
    'Tarbiya — ota-onaning farzandiga bera oladigan eng yaxshi sovg\'asi. 💫',
    'Urinib ko\'rish — bu allaqachon muvaffaqiyat! 🚀',
    'Har bir kun yaxshilanish uchun yangi imkoniyat. 🌅',
    'Bilim — hayot yo\'lidagi chiroq. 📚',
    'Mehnat va sabr bilan har qanday maqsadga erishish mumkin. 🎯',
    'Rabbim, menga ilm va hikmat ato et! 🤲',
    'Kitob — insonning eng yaxshi do\'sti. 📖',
    'Vaqt — oltin, uni behuda sarf etma! ⏰',
    'Har bir yaxshi amal — sadaqa. 💝',
    'Tartib va intizom muvaffaqiyatga olib boradi! 📋',
    'Bilim — kuch! 💪',
    'Bugun harakat qil, ertangi kun yaxshiroq bo\'lsin. 🌟',
    'Xatolardan o\'rgan, lekin hech qachon taslim bo\'lma! 🔥',
    'Izchillik — muvaffaqiyat kaliti. 🔑',
    'Sog\'lom tanda sog\'lom aql! 🏃',
    'Musiqa — ruh ozig\'i. 🎵',
    'Chiroyli xat — toza fikrning ko\'zgusi. ✍️',
    'Matematika — barcha fanlar asosi. 🔢',
    'Namoz — ruhiy kuch. 🙏',
    'Dunyoni o\'zgartirishni xohlasang — o\'zingdan boshlashing kerak! 🌍',
    '«Ota-onangizni hurmat qiling...»',
    '«Ey farzandlar, ota-onangizga itoat qiling...»',
    '«Otangiz nasihatini eshiting...»',
    '«...Onangiz ta\'limini tark etmang.»',
    '«Haqiqatgo\'y lab abadiy mustahkam bo\'ladi...»',
    '«O\'g\'irlik qilmang va bir-biringizga yolg\'on gapirmang...»',
    '«...Bir-biringizga haqiqatni ayting.»',
    '«To\'g\'rilik bilan yuradigan kishi xavfsiz yuradi...»',
    '«Tilingni yovuzlikdan va yolg\'ondan saqlang.»',
    '«Chumolining oldiga bor... va dono bo\'l.»',
    '«Dangasa qo\'l kambag\'al bo\'ladi...»',
    '«...Mehnatsevar qo\'l boyitadi.»',
    '«Mehnatsevarlarning joni to\'yadi.»',
    '«Nima qilsangiz, butun qalbingiz bilan qiling...»',
    '«Har qanday mehnanda foyda bor...»',
    '«Yumshoq javob g\'azabni bartaraf etadi...»',
    '«Sabr-toqatli odam buyuk aqlga ega...»',
    '«Sabr-toqatli odam pahlavondan afzal...»',
    '«Bir-biringizga mehribon va shafqatli bo\'ling...»',
    '«...Eshitishda shoshqaloq, gapishda sekin bo\'l.»',
    '«Sabr-toqatli odam janjalni bosib tushiradi...»',
    '«Ahmoq barcha g\'azabini to\'kib tashlaydi, dono esa jilovlaydi.»',
    '«Odamlarga o\'zingizga nisbatan xohlagan munosabatni ko\'rsating.»',
    '«...Yomon do\'stlar yaxshi axloqni buzadi.»',
    '«Bola o\'z ishlari bilan taniladi...»',
    '«Yaxshi nom ko\'p boylikdan yaxshiroq...»',
    '«Xulq-atvorida, muhabbatda va poklikda namuna bo\'l.»',
    '«...So\'z bilan emas, balki amal bilan sevaylik.»',
    '«Hamma ishni ming\'irlamasdan va shikoyatsiz bajaring.»',
    '«Yovuzlikka mag\'lub bo\'lmang, yovuzlikni yaxshilik bilan mag\'lub qiling.»',
    '«Boshqalar sizni maqtasin, o\'z og\'zingiz emas...»'
];

const MOTIVATIONAL_QUOTES_KK = [
    'Тәрбие — ата-ананың балаға бере алатын ең жақсы сыйы. 💫',
    'Байқап көру — бұл жетістік! 🚀',
    'Әр күн жақсара түсуге жаңа мүмкіндік. 🌅',
    'Білім — өмір жолындағы шам. 📚',
    'Еңбек пен сабырлылықпен кез келген мақсатқа жетуге болады. 🎯',
    'Я Раббым, маған ілім мен хикмет бер! 🤲',
    'Кітап — адамның ең жақсы досы. 📖',
    'Уақыт — алтын, оны текке шашпа! ⏰',
    'Әр жақсы іс — сауап. 💝',
    'Тәртіп пен ынта жетістікке жетелейді! 📋',
    'Білім — күш! 💪',
    'Бүгін тырыс, ертеңгі күн жақсырақ болсын. 🌟',
    'Қателерден үйрен, бірақ ешқашан бас тартпа! 🔥',
    'Тұрақтылық — жетістіктің кілті. 🔑',
    'Дені сау денеде — сау ақыл! 🏃',
    'Музыка — жанның азығы. 🎵',
    'Әдемі жазу — анық ойдың айнасы. ✍️',
    'Математика — барлық ғылымның негізі. 🔢',
    'Намаз — рухани күш. 🙏',
    'Дүниені өзгерткің келсе — өзіңнен бастасаң! 🌍',
    '«Әкеңді және анаңды құрмет тұт...»',
    '«Балалар, ата-аналарыңызға бағыныңдар...»',
    '«Әкеңнің ақылын тыңда...»',
    '«...Анаңның тәлімін тастама.»',
    '«Шынайы ерін мәңгі тұрақты болады...»',
    '«Ұрлама және бір-біріңе өтірік айтпа...»',
    '«...Бір-біріңе шындықты айтыңдар.»',
    '«Адалдықпен жүрген адам қауіпсіз жүреді...»',
    '«Тіліңді жамандықтан және өтіріктен сақта.»',
    '«Құмырсқаның қасына бар... және даналан.»',
    '«Жалқау қол кедей болады...»',
    '«...Еңбекқор қол байытады.»',
    '«Еңбекқорлардың жаны тоядды.»',
    '«Не істесеңіз де, жүрегіңізбен жасаңыз...»',
    '«Кез келген еңбекте пайда бар...»',
    '«Жұмсақ жауап ашуды басады...»',
    '«Сабырлы адамның ақылы мол...»',
    '«Сабырлы адам батырдан артық...»',
    '«Бір-біріңе мейірімді және жанашыр болыңдар...»',
    '«...Тыңдауда жылдам, сөйлеуде баяу бол.»',
    '«Сабырлы адам дауды басады...»',
    '«Ақылсыз ашуын төгеді, дана ұстайды.»',
    '«Адамдарға өзіңе қалай қарасын десеңіз, оларға солай қараңыз.»',
    '«...Жаман достар жақсы мінезді бұзады.»',
    '«Бала өз ісімен танылады...»',
    '«Жақсы есім үлкен байлықтан артық...»',
    '«Мінез-құлықта, сүйіспеншілікте және тазалықта үлгі бол.»',
    '«...Сөзбен емес, ісімен сүй.»',
    '«Бәрін наразылықсыз және шағымсыз жасаңыз.»',
    '«Жамандыққа жеңілме, жамандықты жақсылықпен жең.»',
    '«Басқалар сені мақтасын, өз аузың емес...»'
];

const MOTIVATIONAL_QUOTES_KY = [
    'Тарбия — ата-эненин балага бере ала турган эң жакшы белеги. 💫',
    'Байкап көрүү — бул жетишкендик! 🚀',
    'Ар бир күн жакшыраак болуу үчүн жаңы мүмкүнчүлүк. 🌅',
    'Билим — жашоо жолундагы чырак. 📚',
    'Эмгек жана сабырдуулук менен каалаган максатка жетсе болот. 🎯',
    'Я Раббым, мага илим жана акылмандык бер! 🤲',
    'Китеп — адамдын эң жакшы досу. 📖',
    'Убакыт — алтын, аны текке шашпа! ⏰',
    'Ар бир жакшы иш — сооп. 💝',
    'Тартип жана умтулуу жетишкендикке алып барат! 📋',
    'Билим — күч! 💪',
    'Бүгүн аракет кыл, эртеңки күн жакшыраак болсун. 🌟',
    'Каталардан үйрөн, бирок эч качан баш тартпа! 🔥',
    'Туруктуулук — жетишкендиктин ачкычы. 🔑',
    'Дени сак денеде — сак акыл! 🏃',
    'Музыка — жандын азыгы. 🎵',
    'Сулуу жазуу — айкын ойдун күзгүсү. ✍️',
    'Математика — бардык илимдердин негизи. 🔢',
    'Намаз — руханий күч. 🙏',
    'Дүйнөнү өзгөрткүң келсе — өзүңдөн баштасаң! 🌍',
    '«Атаңды жана энеңди урматта...»',
    '«Балдар, ата-энеңерге баш ийгиле...»',
    '«Атаңдын акылын ук...»',
    '«...Энеңдин үйрөтмөсүн таштаба.»',
    '«Чынчыл эрин түбөлүккө туруктуу болот...»',
    '«Урлаба жана бири-бириңе жалган айтпагыла...»',
    '«...Бири-бириңерге чындыкты айткыла.»',
    '«Адилеттүүлүк менен жүргөн адам коопсуз жүрөт...»',
    '«Тилиңди жамандыктан жана жалгандан сакта.»',
    '«Кумурсканын жанына бар... жана акылман бол.»',
    '«Жалкоо кол кедей болот...»',
    '«...Эмгекчил кол байытат.»',
    '«Эмгекчилдердин жаны тоёт.»',
    '«Эмне кылсаңар да, жүрөгүңөр менен жасагыла...»',
    '«Каалаган эмгекте пайда бар...»',
    '«Жумшак жооп ачууну басат...»',
    '«Сабырдуу адамдын акылы мол...»',
    '«Сабырдуу адам баатырдан артык...»',
    '«Бири-бириңерге мейримдүү жана боорукер болгула...»',
    '«...Угууда шашкалак, сүйлөөдө жай бол.»',
    '«Сабырдуу адам талашты басат...»',
    '«Акылсыз ачуусун төгөт, даана кармайт.»',
    '«Адамдарга өзүңө кандай мамиле кылынышын кааласаң, аларга ошондой кыл.»',
    '«...Жаман достор жакшы мүнөздү бузат.»',
    '«Бала өз иштери менен таанылат...»',
    '«Жакшы ат чоң байлыктан артык...»',
    '«Жүрүм-турумда, сүйүүдө жана тазалыкта үлгү бол.»',
    '«...Сөз менен эмес, иш менен сүй.»',
    '«Баарын нааразылыксыз жана даттанбастан аткаргыла.»',
    '«Жамандыкка жеңилбе, жамандыкты жакшылык менен жең.»',
    '«Башкалар сени мактасын, өз оозуң эмес...»'
];

const MOTIVATIONAL_QUOTES_TK = [
    'Terbiýe — ata-enäniň çagasyna berip biljek iň gowy sowgady. 💫',
    'Synap görmek — bu üstünlikdir! 🚀',
    'Her gün has gowulaşmak üçin täze mümkinçilik. 🌅',
    'Bilim — ömür ýolundaky çyra. 📚',
    'Zähmet we sabyr bilen islendik maksada ýetip bolýar. 🎯',
    'Allam, maňa ylym we akyl ber! 🤲',
    'Kitap — adamyň iň gowy dosty. 📖',
    'Wagt — altyn, ony biderek sarp etme! ⏰',
    'Her ýagşy iş — sogap. 💝',
    'Tertip-düzgün we ymtylmak üstünlige alyp barýar! 📋',
    'Bilim — güýç! 💪',
    'Şu gün tagalla et, ertirki gün has gowy bolsun. 🌟',
    'Ýalňyşlyklardan öwren, ýöne hiç wagt pes gelme! 🔥',
    'Durnuklylyk — üstünligiň açary. 🔑',
    'Sagdyn bedende — sagdyn akyl! 🏃',
    'Saz — janyň azygy. 🎵',
    'Owadan ýazuw — aýdyň pikiriň aýnasy. ✍️',
    'Matematika — ähli ylymlaryň esasy. 🔢',
    'Namaz — ruhy güýç. 🙏',
    'Dünýäni üýtgetmek isleseň — özüňden başla! 🌍',
    '«Ataňy we eneňi hormatla...»',
    '«Eý çagalar, ata-eňeňize boýun egme...»',
    '«Ataňyň öwüdini diňle...»',
    '«...Eneňiň öwredişini terk etme.»',
    '«Dogry dodaklar hemişelik durnukly galýar...»',
    '«Ogurlamaň we biri-biriňize ýalan sözlemeň...»',
    '«...Biri-biriňize hakykat aýdyň.»',
    '«Dogrulyk bilen ýören adam howpsuz ýörýär...»',
    '«Diliňi ýamanlykdan we ýalandan sakla.»',
    '«Garynjanyň ýanyna bar... we akylly bol.»',
    '«Ýalta el garyp bolar...»',
    '«...Zähmetkeş el baýadar.»',
    '«Zähmetkeşleriň jany doýar.»',
    '«Näme etseňiz, ýüregiňizden ediň...»',
    '«Her işde peýda bar...»',
    '«Ýumşak jogap gazaby aýyrýar...»',
    '«Sabyrly adamyň akyly köp...»',
    '«Sabyrly adam batyrkdan artykdyr...»',
    '«Biri-biriňize mähirli we rehimli boluň...»',
    '«...Diňlemekde çalt, sözlemekde haýal bol.»',
    '«Sabyrly adam jedeli ýatyrýar...»',
    '«Akmak gazabyny dökýär, akylly saklaýar.»',
    '«Adamlara özüňize nähili garaşmasyny islýän bolsaň, olara şeýle bol.»',
    '«...Ýaman dostlar gowy ahlaky bozýar.»',
    '«Çaga öz işleri bilen tanylýar...»',
    '«Gowy at köp baýlykdan artykdyr...»',
    '«Häsiýetde, söýgüde we tämizlikde nusga bol.»',
    '«...Söz bilen däl, iş bilen söý.»',
    '«Hemmesini zeýrenmezden we şikaýatsyz ediň.»',
    '«Ýamanlyk bilen ýeňilme, ýamanlogy ýagşylyk bilen ýeň.»',
    '«Başgalar seni öwsün, öz agzyň däl...»'
];

function getQuotes() {
    if (currentLang === 'ru') return MOTIVATIONAL_QUOTES_RU;
    if (currentLang === 'en') return MOTIVATIONAL_QUOTES_EN;
    if (currentLang === 'uz') return MOTIVATIONAL_QUOTES_UZ;
    if (currentLang === 'kk') return MOTIVATIONAL_QUOTES_KK;
    if (currentLang === 'ky') return MOTIVATIONAL_QUOTES_KY;
    if (currentLang === 'tk') return MOTIVATIONAL_QUOTES_TK;
    return MOTIVATIONAL_QUOTES_TG;
}

const BONUS_TASK_EXAMPLES = [
    { name: 'Тоза кардани ҳуҷра', emoji: '🧹' },
    { name: 'Шустани зарфҳо', emoji: '🍽️' },
    { name: 'Кӯмак ба модар', emoji: '👩‍👦' },
    { name: 'Об додан ба гулҳо', emoji: '🌺' },
    { name: 'Хондани китоби иловагӣ', emoji: '📕' },
    { name: 'Ёд гирифтани оят', emoji: '📜' },
    { name: 'Расм кашидан', emoji: '🎨' },
    { name: 'Тартиб додани китобҳо', emoji: '📚' }
];

// ===== STATE =====
let state = null;
let currentChildId = null;
let currentPage = 'dashboard';

// ===== DATA FUNCTIONS =====

function generateId() {
    return Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
}

function localizeDefaultTaskNames() {
    // Rename any task whose name matches a default-task name in ANY language
    // to the current language's default name. Runs on load and on language change,
    // so a single chosen language is applied consistently everywhere.
    try {
        if (!state || !state.children) return;
        var defaultIds = ['wash','exercise','bible','solfeggio','piano','calligraphy','mult'];
        // Legacy hardcoded names (older saves predating per-language keys)
        var LEGACY = {
            wash:        ['Шустушӯи дасту рӯй', 'Умыть лицо и руки'],
            exercise:    ['Машқи ҷисмонӣ', 'Физические упражнения'],
            bible:       ['Хондани Китоби Муқаддас ва дуо', 'Чтение Священного Писания и молитва'],
            solfeggio:   ['Сольфеджио (нотаҳо)', 'Сольфеджио (ноты)'],
            piano:       ['Машқи фортопиано', 'Упражнение на фортепиано'],
            calligraphy: ['Машқи ҳусни хат', 'Упражнение по каллиграфии'],
            mult:        ['Ҷадвали зарб', 'Таблица умножения']
        };
        state.children.forEach(function(child) {
            (child.tasks || []).forEach(function(t) {
                if (defaultIds.indexOf(t.id) === -1) return;
                var matches = false;
                // Match against every language's default name
                if (typeof TRANSLATIONS === 'object') {
                    Object.keys(TRANSLATIONS).forEach(function(lang) {
                        var dn = TRANSLATIONS[lang] && TRANSLATIONS[lang]['task.default.' + t.id];
                        if (dn && t.name === dn) matches = true;
                    });
                }
                // Match against legacy hardcoded names
                if (LEGACY[t.id] && LEGACY[t.id].indexOf(t.name) !== -1) matches = true;
                if (matches) {
                    var localName = (typeof __ === 'function') ? __('task.default.' + t.id) : null;
                    if (localName && localName !== 'task.default.' + t.id) {
                        t.name = localName;
                    }
                }
            });
        });
    } catch (e) {
        console.warn('localizeDefaultTaskNames failed:', e);
    }
}

function migrateState(stateObj) {
    if (!stateObj) return;
    if (!stateObj.lastUpdated) {
        stateObj.lastUpdated = Date.now();
    }
    if (!stateObj.children) {
        stateObj.children = [];
    }
    stateObj.children.forEach(child => {
        if (!child.rewardType) child.rewardType = 'money';
        if (child.stars === undefined) child.stars = 0;
        if (child.totalStars === undefined) child.totalStars = 0;
        if (child.achievements === undefined) child.achievements = [];
        if (!child.withdrawals) child.withdrawals = [];
        
        const migrateTask = (t, isBonusDefault) => {
            if (t.deadline === undefined) t.deadline = '';
            if (t.type === undefined) t.type = t.isBonus ? 'bonus' : 'daily';
            if (t.rewardGold === undefined) t.rewardGold = t.bonusPrice || (isBonusDefault ? 3 : 1);
            if (t.rewardStars === undefined) t.rewardStars = isBonusDefault ? 0 : 1;
            if (t.useTimer === undefined) t.useTimer = true;
            if (t.days === undefined) t.days = [1, 2, 3, 4, 5, 6, 0];
            if (t.startTime === undefined) t.startTime = '12:00';
        };

        if (child.tasks) child.tasks.forEach(t => migrateTask(t, false));
        if (child.bonusTasks) child.bonusTasks.forEach(t => migrateTask(t, true));
    });
}

function loadState() {
    try {
        const saved = safeStorage.getItem(STORAGE_KEY);
        if (saved) {
            state = JSON.parse(saved);
            // Auto-delete proof photos older than 7 days after confirmation (frees localStorage)
            cleanupOldPhotos();
            // Set language if saved
            if (state.language) {
                setLanguage(state.language);
            }
            // Migrate state
            migrateState(state);
            // Localize default task names to the current language
            localizeDefaultTaskNames();
            return;
        }
    } catch (e) {
        console.warn('Failed to load state:', e);
    }
    // First launch — show welcome screen
    window._isFirstLaunch = true;

    // Create default state
    state = {
        pin: DEFAULT_PIN,
        language: 'en',
        children: [],
        lastUpdated: Date.now(),
        version: 1
    };
    currentChildId = null;
    setLanguage('en');
    saveState(true);
}

function cleanupOldPhotos() {
    // Remove proof photos from task logs confirmed more than 7 days ago.
    // Photos are base64 stored in localStorage; deleting frees space and
    // protects privacy (proof no longer needed after confirmation window).
    try {
        const SEVEN_DAYS = 7 * 24 * 60 * 60 * 1000;
        const now = Date.now();
        if (!state || !state.children) return;
        state.children.forEach(child => {
            if (!child.dailyLogs) return;
            Object.keys(child.dailyLogs).forEach(dateKey => {
                const log = child.dailyLogs[dateKey];
                if (!log || !log.tasks) return;
                Object.keys(log.tasks).forEach(taskId => {
                    const tl = log.tasks[taskId];
                    if (tl && tl.photo && tl.confirmed && tl.confirmedAt) {
                        if (now - new Date(tl.confirmedAt).getTime() > SEVEN_DAYS) {
                            delete tl.photo;
                            tl.photoCleaned = true;
                        }
                    }
                });
            });
        });
    } catch (e) {
        console.warn('Photo cleanup failed:', e);
    }
}

function saveState(isUserAction = true) {
    try {
        if (isUserAction) {
            state.version = (state.version || 0) + 1;
        }
        state.lastUpdated = Date.now();
        state.language = getLanguage();
        safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
        if (supabaseClient && isUserAction) {
            saveRemoteState();
        }
    } catch (e) {
        console.warn('Failed to save state:', e);
        // localStorage quota exceeded — try freeing space by clearing old photos
        if (e && (e.name === 'QuotaExceededError' || e.code === 22 || e.code === 1014)) {
            try {
                cleanupOldPhotos();
                safeStorage.setItem(STORAGE_KEY, JSON.stringify(state));
                if (supabaseClient && isUserAction) {
                    saveRemoteState();
                }
                if (typeof showToast === 'function') {
                    showToast('⚠️', __('storage.cleaned') || 'Хотира тоза карда шуд');
                }
                return;
            } catch (e2) {
                if (typeof showToast === 'function') {
                    showToast('⚠️', __('storage.full') || 'Хотира пур аст! Маълумотро содир кунед.');
                }
            }
        }
    }
}

function getChild(id) {
    return state.children.find(c => c.id === id);
}

function getCurrentChild() {
    if (!currentChildId && state && state.children && state.children.length > 0) {
        currentChildId = state.children[0].id;
    }
    return getChild(currentChildId);
}

function getToday() {
    return new Date().toISOString().split('T')[0];
}

function formatDate(dateStr) {
    const d = new Date(dateStr + 'T12:00:00');
    return `${d.getDate()} ${__month(d.getMonth())}`;
}

// ===== REWARD TYPE HELPERS =====

function getRewardSymbol(child) {
    const rt = child.rewardType || 'money';
    if (rt === 'stars') return '⭐';
    if (rt === 'both') return '💰';
    return '💰';
}

function formatBalanceAmount(child, amount) {
    const rt = child.rewardType || 'money';
    if (rt === 'money') return `${amount} ${__('balance.currency.sm')}`;
    if (rt === 'stars') return `${amount} ⭐`;
    return `${amount} ${__('balance.currency.sm')}`;
}

function formatBalanceFull(child) {
    const rt = child.rewardType || 'money';
    if (rt === 'money') return `${child.balance} 🪙`;
    if (rt === 'stars') return `${child.stars || 0} ⭐`;
    return `${child.balance} 🪙 | ${child.stars || 0} ⭐`;
}

function getDailyRewardAmounts(child) {
    const rt = child.rewardType || 'money';
    if (rt === 'money') return { main: 1, deduct: -1 };
    if (rt === 'stars') return { main: 1, deduct: -1 }; // 1 star for all done, -1 star for not
    return { main: 1, deduct: -1, starMain: 1, starDeduct: -1 };
}

function getTestRewardAmounts(child, score) {
    const rt = child.rewardType || 'money';
    let moneyReward = 0;
    let starReward = 0;
    if (score === 10) { moneyReward = 2; starReward = 2; }
    else if (score === 9) { moneyReward = 1; starReward = 1; }

    if (rt === 'money') return { text: `${moneyReward} ${__('balance.currency.sm')}`, money: moneyReward, stars: 0 };
    if (rt === 'stars') return { text: `${starReward} ⭐`, money: 0, stars: starReward };
    return { text: `${moneyReward} ${__('balance.currency.sm')} + ${starReward} ⭐`, money: moneyReward, stars: starReward };
}

// ===== DAILY LOGS =====

function getOrCreateDailyLog(childId) {
    const child = getChild(childId);
    if (!child) return null;
    const today = getToday();
    if (!child.dailyLogs) child.dailyLogs = {};
    if (!child.dailyLogs[today]) {
        // Clean up completed one-time tasks from active list
        const completedOneTimeIds = [];
        child.tasks.forEach(t => {
            if (t.type === 'one-time') {
                for (const dateStr in child.dailyLogs) {
                    const log = child.dailyLogs[dateStr];
                    if (log.tasks && log.tasks[t.id]) {
                        if (log.tasks[t.id].status === 'completed' && log.tasks[t.id].confirmed) {
                            completedOneTimeIds.push(t.id);
                            break;
                        }
                    }
                }
            }
        });
        if (completedOneTimeIds.length > 0) {
            child.tasks = child.tasks.filter(t => !completedOneTimeIds.includes(t.id));
        }

        child.dailyLogs[today] = {
            tasks: {},
            allCompleted: false,
            partiallyCompleted: false,
            excused: false,
            excuseReason: '',
            rewardApplied: false
        };
        syncDailyLogTasks(child, today);
        saveState(false);
    } else {
        syncDailyLogTasks(child, today);
    }
    return child.dailyLogs[today];
}

function syncDailyLogTasks(child, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return;

    let modified = false;
    const allTasks = [...child.tasks, ...child.bonusTasks];
    allTasks.forEach(t => {
        if (!log.tasks[t.id]) {
            log.tasks[t.id] = {
                status: 'pending',
                confirmed: false,
                timeSpent: 0,
                startedAt: null,
                photo: null,
                explanation: ''
            };
            modified = true;
        }
    });

    const validTaskIds = new Set(allTasks.map(t => t.id));
    Object.keys(log.tasks).forEach(taskId => {
        if (!validTaskIds.has(taskId)) {
            delete log.tasks[taskId];
            modified = true;
        }
    });

    if (modified) {
        saveState(false);
    }
}

function getDailyLog(childId, date) {
    const child = getChild(childId);
    if (!child || !child.dailyLogs) return null;
    return child.dailyLogs[date] || null;
}

// ===== ACCOUNTING =====

function calculateDailyReward(childId, date) {
    const child = getChild(childId);
    if (!child || !child.dailyLogs) return { reward: 0, reason: 'no_child', starReward: 0, medalReward: 0 };
    const log = child.dailyLogs[date];
    if (!log) return { reward: 0, reason: 'no_log', starReward: 0 };
    if (log.excused) return { reward: 0, reason: 'excused', starReward: 0 };
    if (log.rewardApplied) return { reward: 0, reason: 'already_applied', starReward: 0 };

    const todayDay = new Date(date + 'T12:00:00').getDay();
    const regularTasks = child.tasks.filter(t => !t.isBonus && (t.type !== 'daily' || !t.days || t.days.includes(todayDay)));
    let completedCount = 0;
    let totalCount = regularTasks.length;

    let regularGold = 0;
    let regularStars = 0;
    let regularMedals = 0;

    regularTasks.forEach(t => {
        const taskLog = log.tasks[t.id];
        if (taskLog && taskLog.status === 'completed' && taskLog.confirmed) {
            completedCount++;
            regularGold += parseInt(t.rewardGold !== undefined ? t.rewardGold : 1) || 0;
            regularStars += parseInt(t.rewardStars !== undefined ? t.rewardStars : 1) || 0;
            regularMedals += parseInt(t.rewardMedals !== undefined ? t.rewardMedals : 0) || 0;
        }
    });

    // Count bonus tasks separately
    let bonusGold = 0;
    let bonusStars = 0;
    let bonusMedals = 0;
    child.bonusTasks.forEach(t => {
        const taskLog = log.tasks[t.id];
        if (taskLog && taskLog.status === 'completed' && taskLog.confirmed) {
            bonusGold += parseInt(t.rewardGold !== undefined ? t.rewardGold : (t.bonusPrice || 0)) || 0;
            bonusStars += parseInt(t.rewardStars !== undefined ? t.rewardStars : 0) || 0;
            bonusMedals += parseInt(t.rewardMedals !== undefined ? t.rewardMedals : 0) || 0;
        }
    });

    if (completedCount === 0 && bonusGold === 0 && bonusStars === 0 && bonusMedals === 0) {
        return { reward: 0, reason: 'none_done', starReward: 0, medalReward: 0 };
    } else if (completedCount < totalCount) {
        return {
            reward: regularGold + bonusGold,
            reason: 'partial',
            starReward: regularStars + bonusStars,
            medalReward: regularMedals + bonusMedals
        };
    } else {
        return {
            reward: regularGold + bonusGold,
            reason: 'all_done',
            starReward: regularStars + bonusStars,
            medalReward: regularMedals + bonusMedals
        };
    }
}

function applyDailyReward(childId, date) {
    const child = getChild(childId);
    if (!child || !child.dailyLogs) return;
    const log = child.dailyLogs[date];
    if (!log || log.rewardApplied) return;

    const result = calculateDailyReward(childId, date);

    if (result.reward > 0) {
        child.balance += result.reward;
        child.totalEarned += result.reward;
    } else if (result.reward < 0) {
        child.totalDeducted += Math.abs(result.reward);
    }
    
    if (result.starReward > 0) {
        if (!child.stars) child.stars = 0;
        child.stars += result.starReward;
        child.totalStars = (child.totalStars || 0) + result.starReward;
    }
    
    if (result.medalReward > 0) {
        if (!child.medals) child.medals = 0;
        child.medals += result.medalReward;
        child.totalMedals = (child.totalMedals || 0) + result.medalReward;
    }
    
    log.rewardApplied = true;
    saveState();
}

// ===== 10-DAY TEST =====

function checkAndCreateTest(childId) {
    const child = getChild(childId);
    if (!child || !child.dailyLogs || !child.tenDayTests) return null;
    const logs = child.dailyLogs;
    const dates = Object.keys(logs).sort().reverse();

    const lastTest = child.tenDayTests.length > 0
        ? child.tenDayTests[child.tenDayTests.length - 1]
        : null;

    const today = getToday();
    const todayDate = new Date(today + 'T12:00:00');

    let countDays = 0;
    let lastTestDate = lastTest ? new Date(lastTest.date + 'T12:00:00') : null;

    for (const date of dates) {
        const d = new Date(date + 'T12:00:00');
        if (lastTestDate && d <= lastTestDate) break;
        if (d > todayDate) continue;
        const log = logs[date];
        if (log && !log.excused) {
            countDays++;
        }
    }

    const hasTestToday = child.tenDayTests.some(t => t.date === today);

    if (countDays >= 10 && !hasTestToday) {
        const test = {
            id: generateId(),
            date: today,
            completed: false,
            scores: {},
            totalScore: 0,
            reward: 0,
            starReward: 0
        };
        child.tasks.forEach(t => {
            test.scores[t.id] = -1;
        });
        child.tenDayTests.push(test);
        saveState();
        return test;
    }
    return null;
}

function evaluateTest(childId, testId, scores) {
    const child = getChild(childId);
    if (!child || !child.tenDayTests) return;
    const test = child.tenDayTests.find(t => t.id === testId);
    if (!test) return;

    test.scores = scores;
    let total = 0;
    Object.values(scores).forEach(s => { total += s; });
    test.totalScore = total;

    const rt = child.rewardType || 'money';
    let reward = 0;
    let starReward = 0;
    if (total === 10) { reward = 2; starReward = 2; }
    else if (total === 9) { reward = 1; starReward = 1; }

    test.reward = reward;
    test.starReward = starReward;
    test.completed = true;

    if (reward > 0 && (rt === 'money' || rt === 'both')) {
        child.balance += reward;
        child.totalEarned += reward;
    }
    if (starReward > 0 && (rt === 'stars' || rt === 'both')) {
        if (!child.stars) child.stars = 0;
        child.stars += starReward;
        child.totalStars = (child.totalStars || 0) + starReward;
    }

    saveState();
}

// ===== ACHIEVEMENTS =====

function getAchievementProgress(child, id) {
    if (!child) return { current: 0, target: 1, formatted: '0 / 1' };
    
    child.achievementTier = child.achievementTier || 0;
    const m = Math.pow(2, Math.min(2, child.achievementTier));
    const earned = child.achievements ? child.achievements.includes(id) : false;
    
    if (earned) {
        let target = 1;
        if (id === 'week_streak') target = 7 * m;
        else if (id === 'month_streak') target = 30 * m;
        else if (id === 'perfect_zeroes') target = 30 * m;
        else if (id === 'fast_worker') target = 30 * m;
        else if (id === 'helper') target = 10 * m;
        else if (id === 'marksman') target = 50 * m;
        else if (id === 'savings_100') target = 100 * m;
        else if (id === 'savings_50') target = 500 * m;
        return { current: target, target: target, formatted: `${target} / ${target}` };
    }
    
    switch (id) {
        case 'first_task': {
            let totalCompleted = 0;
            Object.values(child.dailyLogs).forEach(log => {
                Object.values(log.tasks).forEach(t => {
                    if (t.status === 'completed' && t.confirmed) {
                        totalCompleted++;
                    }
                });
            });
            return { current: Math.min(3, totalCompleted), target: 3, formatted: `${Math.min(3, totalCompleted)} / 3` };
        }
        case 'all_today': {
            const todayLog = child.dailyLogs[getToday()];
            if (!todayLog) return { current: 0, target: 1, formatted: '0 / 1' };
            const allTasks = child.tasks.filter(t => !t.isBonus);
            if (allTasks.length === 0) return { current: 0, target: 1, formatted: '0 / 1' };
            const doneCount = allTasks.filter(t => {
                const tl = todayLog.tasks[t.id];
                return tl && tl.status === 'completed' && tl.confirmed;
            }).length;
            return { current: doneCount, target: allTasks.length, formatted: `${doneCount} / ${allTasks.length}` };
        }
        case 'week_streak':
        case 'month_streak':
        case 'perfect_zeroes':
        case 'fast_worker': {
            const dates = Object.keys(child.dailyLogs).sort().reverse();
            let currentStreak = 0;
            let onTimeStreak = 0;
            let onTimeStreakBroken = false;
            let noPenaltyStreak = 0;
            let noPenaltyStreakBroken = false;
            const todayStr = getToday();
            const todayD = new Date(todayStr + 'T12:00:00');

            for (let i = 0; i < dates.length; i++) {
                const d = new Date(dates[i] + 'T12:00:00');
                const expected = new Date(todayD);
                expected.setDate(expected.getDate() - i);
                if (d.toDateString() === expected.toDateString()) {
                    const log = child.dailyLogs[dates[i]];
                    if (log && !log.excused && log.rewardApplied) {
                        const result = calculateDailyReward(child.id, dates[i]);
                        if (result.reward >= 0) {
                            currentStreak++;
                            if (!onTimeStreakBroken) {
                                const missedAny = Object.values(log.tasks).some(t => t.status === 'completed' && t.missedDeadline);
                                if (!missedAny) onTimeStreak++;
                                else onTimeStreakBroken = true;
                            }
                            if (!noPenaltyStreakBroken) {
                                const penaltyAny = Object.values(log.tasks).some(t => t.penaltyApplied && (t.penaltyApplied.stars > 0 || t.penaltyApplied.gold > 0));
                                if (!penaltyAny) noPenaltyStreak++;
                                else noPenaltyStreakBroken = true;
                            }
                        } else { break; }
                    } else if (log && log.excused) {
                        continue;
                    } else { break; }
                } else { break; }
            }
            
            const daysText = __('achievement_modal.days_suffix') || 'рӯз';
            if (id === 'week_streak') {
                const target = 7 * m;
                return { current: currentStreak, target: target, formatted: `${currentStreak} / ${target} ${daysText}` };
            }
            if (id === 'month_streak') {
                const target = 30 * m;
                return { current: currentStreak, target: target, formatted: `${currentStreak} / ${target} ${daysText}` };
            }
            if (id === 'fast_worker') {
                const target = 30 * m;
                return { current: onTimeStreak, target: target, formatted: `${onTimeStreak} / ${target} ${daysText}` };
            }
            if (id === 'perfect_zeroes') {
                const target = 30 * m;
                return { current: noPenaltyStreak, target: target, formatted: `${noPenaltyStreak} / ${target} ${daysText}` };
            }
            break;
        }
        case 'early_bird': {
            const morningStreak = calculateBlockStreak(child, 'morning');
            const target = 7;
            const daysText = __('achievement_modal.days_suffix') || 'рӯз';
            return { current: morningStreak, target: target, formatted: `${morningStreak} / ${target} ${daysText}` };
        }
        case 'helper':
        case 'marksman': {
            let totalTasksCompleted = 0;
            let bonusCount = 0;
            Object.values(child.dailyLogs).forEach(log => {
                Object.entries(log.tasks).forEach(([taskId, taskLog]) => {
                    if (taskLog.status === 'completed' && taskLog.confirmed) {
                        totalTasksCompleted++;
                        const bonusTask = child.bonusTasks.find(t => t.id === taskId);
                        if (bonusTask) {
                            bonusCount++;
                        }
                    }
                });
            });
            
            if (id === 'marksman') {
                const target = 50 * m;
                return { current: totalTasksCompleted, target: target, formatted: `${totalTasksCompleted} / ${target}` };
            }
            if (id === 'helper') {
                const target = 10 * m;
                return { current: bonusCount, target: target, formatted: `${bonusCount} / ${target}` };
            }
            break;
        }
        case 'test_9': {
            let maxScore = 0;
            child.tenDayTests.forEach(t => {
                if (t.completed && t.totalScore > maxScore) {
                    maxScore = t.totalScore;
                }
            });
            return { current: maxScore, target: 9, formatted: `${maxScore} / 9` };
        }
        case 'bonus_3':
        case 'bonus_5':
        case 'bonus_10': {
            let targetPrice = id === 'bonus_3' ? 3 : (id === 'bonus_5' ? 5 : 10);
            let completionsCount = 0;
            Object.values(child.dailyLogs).forEach(log => {
                Object.entries(log.tasks).forEach(([taskId, taskLog]) => {
                    if (taskLog.status === 'completed' && taskLog.confirmed) {
                        const bonusTask = child.bonusTasks.find(t => t.id === taskId);
                        if (bonusTask && bonusTask.bonusPrice === targetPrice) {
                            completionsCount++;
                        }
                    }
                });
            });
            const target = 10 * m;
            return { current: completionsCount, target: target, formatted: `${completionsCount} / ${target}` };
        }
        case 'savings_100': {
            const target = 100 * m;
            const current = Math.floor(child.totalEarned);
            const goldText = __('currency.gold') || 'тилло';
            return { current: current, target: target, formatted: `${current} / ${target} ${goldText}` };
        }
        case 'savings_50': {
            const target = 500 * m;
            const current = Math.floor(child.totalEarned);
            const goldText = __('currency.gold') || 'тилло';
            return { current: current, target: target, formatted: `${current} / ${target} ${goldText}` };
        }
    }
    
    return { current: 0, target: 1, formatted: '0 / 1' };
}

function checkAchievements(childId) {
    const child = getChild(childId);
    if (!child) return { unlocked: [], prestigeTriggered: false };
    const unlocked = [];

    child.achievementTier = child.achievementTier || 0;
    const m = Math.pow(2, Math.min(2, child.achievementTier));

    if (!child.achievements) child.achievements = [];

    let totalCompleted = 0;
    Object.values(child.dailyLogs).forEach(log => {
        Object.values(log.tasks).forEach(t => {
            if (t.status === 'completed' && t.confirmed) {
                totalCompleted++;
            }
        });
    });
    if (totalCompleted >= 3 && !child.achievements.includes('first_task')) {
        child.achievements.push('first_task');
        unlocked.push(__('achievement.first_task'));
    }

    const todayLog = getOrCreateDailyLog(childId);
    const allDone = child.tasks.every(t => {
        const tl = todayLog.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });
    if (allDone && !child.achievements.includes('all_today')) {
        child.achievements.push('all_today');
        unlocked.push(__('achievement.all_today'));
    }

    // Check streaks
    const dates = Object.keys(child.dailyLogs).sort().reverse();
    let currentStreak = 0;
    let onTimeStreak = 0;
    let onTimeStreakBroken = false;
    let noPenaltyStreak = 0;
    let noPenaltyStreakBroken = false;
    const todayStr = getToday();
    const todayD = new Date(todayStr + 'T12:00:00');

    for (let i = 0; i < dates.length; i++) {
        const d = new Date(dates[i] + 'T12:00:00');
        const expected = new Date(todayD);
        expected.setDate(expected.getDate() - i);
        if (d.toDateString() === expected.toDateString()) {
            const log = child.dailyLogs[dates[i]];
            if (log && !log.excused && log.rewardApplied) {
                const result = calculateDailyReward(childId, dates[i]);
                if (result.reward >= 0) {
                    currentStreak++;
                    if (!onTimeStreakBroken) {
                        const missedAny = Object.values(log.tasks).some(t => t.status === 'completed' && t.missedDeadline);
                        if (!missedAny) onTimeStreak++;
                        else onTimeStreakBroken = true;
                    }
                    if (!noPenaltyStreakBroken) {
                        const penaltyAny = Object.values(log.tasks).some(t => t.penaltyApplied && (t.penaltyApplied.stars > 0 || t.penaltyApplied.gold > 0));
                        if (!penaltyAny) noPenaltyStreak++;
                        else noPenaltyStreakBroken = true;
                    }
                } else { break; }
            } else if (log && log.excused) {
                continue;
            } else { break; }
        } else { break; }
    }

    if (currentStreak >= (7 * m) && !child.achievements.includes('week_streak')) {
        child.achievements.push('week_streak');
        unlocked.push(__('achievement.week_streak'));
    }
    if (currentStreak >= (30 * m) && !child.achievements.includes('month_streak')) {
        child.achievements.push('month_streak');
        unlocked.push(__('achievement.month_streak'));
    }
    if (onTimeStreak >= (30 * m) && !child.achievements.includes('fast_worker')) {
        child.achievements.push('fast_worker');
        unlocked.push(__('achievement.fast_worker'));
    }
    if (noPenaltyStreak >= (30 * m) && !child.achievements.includes('perfect_zeroes')) {
        child.achievements.push('perfect_zeroes');
        unlocked.push(__('achievement.perfect_zeroes'));
    }

    // Check early bird using 7-day morning streak
    const morningStreak = calculateBlockStreak(child, 'morning');
    if (morningStreak >= 7 && !child.achievements.includes('early_bird')) {
        child.achievements.push('early_bird');
        unlocked.push(__('achievement.early_bird'));
    }

    // test achievements
    child.tenDayTests.forEach(t => {
        if (t.completed && t.totalScore === 9 && !child.achievements.includes('test_9')) {
            child.achievements.push('test_9');
            unlocked.push(__('achievement.test_9'));
        }
    });

    // savings
    if (child.totalEarned >= (100 * m) && !child.achievements.includes('savings_100')) {
        child.achievements.push('savings_100');
        unlocked.push(__('achievement.savings_100'));
    }
    if (child.totalEarned >= (500 * m) && !child.achievements.includes('savings_50')) {
        child.achievements.push('savings_50');
        unlocked.push(__('achievement.savings_50'));
    }

    // bonus task achievements and total tasks
    let totalTasksCompleted = 0;
    let bonusCount = 0;
    let bonus3Count = 0;
    let bonus5Count = 0;
    let bonus10Count = 0;
    Object.values(child.dailyLogs).forEach(log => {
        Object.entries(log.tasks).forEach(([taskId, taskLog]) => {
            if (taskLog.status === 'completed' && taskLog.confirmed) {
                totalTasksCompleted++;
                const bonusTask = child.bonusTasks.find(t => t.id === taskId);
                if (bonusTask) {
                    bonusCount++;
                    if (bonusTask.bonusPrice === 3) {
                        bonus3Count++;
                    }
                    if (bonusTask.bonusPrice === 5) {
                        bonus5Count++;
                    }
                    if (bonusTask.bonusPrice === 10) {
                        bonus10Count++;
                    }
                }
            }
        });
    });

    if (bonus3Count >= (10 * m) && !child.achievements.includes('bonus_3')) {
        child.achievements.push('bonus_3');
        unlocked.push(__('achievement.bonus_3'));
    }
    if (bonus5Count >= (10 * m) && !child.achievements.includes('bonus_5')) {
        child.achievements.push('bonus_5');
        unlocked.push(__('achievement.bonus_5'));
    }
    if (bonus10Count >= (10 * m) && !child.achievements.includes('bonus_10')) {
        child.achievements.push('bonus_10');
        unlocked.push(__('achievement.bonus_10'));
    }
    if (totalTasksCompleted >= (50 * m) && !child.achievements.includes('marksman')) {
        child.achievements.push('marksman');
        unlocked.push(__('achievement.marksman'));
    }
    if (bonusCount >= (10 * m) && !child.achievements.includes('helper')) {
        child.achievements.push('helper');
        unlocked.push(__('achievement.helper'));
    }

    let prestigeTriggered = false;
    let newTier = child.achievementTier;
    let goldPrize = 0;
    let starPrize = 0;

    // Check if ALL achievements are unlocked
    if (child.achievements.length >= ACHIEVEMENTS.length) {
        prestigeTriggered = true;
        
        const t = child.achievementTier || 0;
        goldPrize = 200 + 100 * t;
        starPrize = 200 + 100 * t;
        
        child.balance += goldPrize;
        child.totalEarned += goldPrize;
        child.stars = (child.stars || 0) + starPrize;
        child.totalStars = (child.totalStars || 0) + starPrize;
        
        child.achievementTier += 1;
        newTier = child.achievementTier;
        child.achievements = []; // Reset achievements
    }

    saveState();
    return { unlocked, prestigeTriggered, newTier, goldPrize, starPrize };
}

// ===== DAY CYCLE STREAKS HELPERS =====
function getBlockTasks(child, blockType, dateDayOfWeek) {
    return child.tasks.filter(t => {
        if (t.type && t.type !== 'daily') return false; // only daily routine tasks
        if (t.days && !t.days.includes(dateDayOfWeek)) return false;
        const time = t.startTime || '12:00';
        const hour = parseInt(time.split(':')[0]);
        if (blockType === 'morning') return hour >= 5 && hour < 12;
        if (blockType === 'afternoon') return hour >= 12 && hour < 18;
        if (blockType === 'evening') return hour >= 18 || hour < 5;
        return false;
    });
}

function isBlockCompleted(child, blockType, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return false;
    if (log.excused) return true; // excused days don't break streak

    const dateDayOfWeek = new Date(dateStr + 'T12:00:00').getDay();
    const blockTasks = getBlockTasks(child, blockType, dateDayOfWeek);
    if (blockTasks.length === 0) return true; // no tasks scheduled = completed

    return blockTasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });
}

function isMorningBlockStreakCompleted(child, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return false;
    if (log.excused) return true;

    const dateDayOfWeek = new Date(dateStr + 'T12:00:00').getDay();
    const morningTasks = getBlockTasks(child, 'morning', dateDayOfWeek);
    if (morningTasks.length === 0) return true;

    return morningTasks.every(t => {
        const tl = log.tasks[t.id];
        if (!tl || tl.status !== 'completed' || !tl.confirmed) return false;
        const compDate = tl.completedAt ? new Date(tl.completedAt) : (tl.startedAt ? new Date(tl.startedAt) : null);
        if (!compDate) return false;
        return compDate.getHours() < 7;
    });
}

function calculateBlockStreak(child, blockType) {
    const todayStr = getToday();
    const todayD = new Date(todayStr + 'T12:00:00');
    
    // Check if child has any tasks configured in this block
    const anyTasks = child.tasks.some(t => {
        if (t.type && t.type !== 'daily') return false;
        const time = t.startTime || '12:00';
        const hour = parseInt(time.split(':')[0]);
        if (blockType === 'morning') return hour >= 5 && hour < 12;
        if (blockType === 'afternoon') return hour >= 12 && hour < 18;
        if (blockType === 'evening') return hour >= 18 || hour < 5;
        return false;
    });
    if (!anyTasks) return 0;

    let streak = 0;
    
    // First, check if today's block is completed
    let completedToday = false;
    if (blockType === 'morning') {
        completedToday = isMorningBlockStreakCompleted(child, todayStr);
    } else {
        completedToday = isBlockCompleted(child, blockType, todayStr);
    }

    if (completedToday) {
        streak = 1;
    } else {
        // Today is not completed. Check if it's already failed.
        const now = new Date();
        const currentHour = now.getHours();
        let failedToday = false;
        if (blockType === 'morning' && currentHour >= 7) failedToday = true;
        if (blockType === 'afternoon' && currentHour >= 18) failedToday = true;
        if (blockType === 'evening' && currentHour >= 5 && currentHour < 18) failedToday = true;
        
        if (failedToday) {
            return 0; // failed, streak is broken
        } else {
            streak = 0; // not failed yet, streak is yesterday's streak
        }
    }

    // Now loop back for previous days
    let dayOffset = 1;
    while (true) {
        const prevD = new Date(todayD);
        prevD.setDate(prevD.getDate() - dayOffset);
        const prevStr = prevD.toISOString().split('T')[0];
        
        const log = child.dailyLogs[prevStr];
        if (!log) {
            break;
        }
        
        if (log.excused) {
            dayOffset++;
            continue; // skip excused days
        }
        
        let completed = false;
        if (blockType === 'morning') {
            completed = isMorningBlockStreakCompleted(child, prevStr);
        } else {
            completed = isBlockCompleted(child, blockType, prevStr);
        }
        
        if (completed) {
            streak++;
            dayOffset++;
        } else {
            break;
        }
    }

    return streak;
}

// ===== ROUTINE (DAILY) HELPERS — added for Routine view =====
// Recurring daily items scheduled for a given weekday (the "routine").
// One-off / bonus quests are intentionally excluded — they live on the Tasks page.
function getScheduledRoutineTasks(child, dayOfWeek) {
    return child.tasks.filter(t =>
        (t.type === 'daily' || !t.type) &&
        (!t.days || t.days.includes(dayOfWeek))
    );
}

// A routine day is "complete" only when EVERY scheduled item is done+confirmed.
// Excused days and empty days are non-breaking (they freeze the streak).
function isRoutineDayComplete(child, dateStr) {
    const log = child.dailyLogs[dateStr];
    if (!log) return false;
    if (log.excused) return true; // freeze, don't break
    const dow = new Date(dateStr + 'T12:00:00').getDay();
    const tasks = getScheduledRoutineTasks(child, dow);
    if (tasks.length === 0) return true; // nothing scheduled = non-breaking
    return tasks.every(t => {
        const tl = log.tasks[t.id];
        return tl && tl.status === 'completed' && tl.confirmed;
    });
}

// Today's routine progress: { done, total, pct }.
function getRoutineProgress(child) {
    const dow = new Date().getDay();
    const tasks = getScheduledRoutineTasks(child, dow);
    const log = child.dailyLogs[getToday()];
    let done = 0;
    if (log) {
        tasks.forEach(t => {
            const tl = log.tasks[t.id];
            if (tl && tl.status === 'completed' && tl.confirmed) done++;
        });
    }
    const total = tasks.length;
    return { done, total, pct: total ? Math.round((done / total) * 100) : 0 };
}

// Streak = consecutive days where ALL scheduled routine items were completed.
// Today counts only if already fully complete; otherwise the streak carries from
// yesterday and is NOT broken (the day isn't over yet). Excused days are skipped.
function calculateRoutineStreak(child) {
    const todayStr = getToday();
    const todayD = new Date(todayStr + 'T12:00:00');
    const todayLog = child.dailyLogs[todayStr];

    let streak = 0;
    let offset = 1;

    if (todayLog && todayLog.excused) {
        // frozen today — carry yesterday's streak
    } else if (isRoutineDayComplete(child, todayStr)) {
        streak = 1;
    }
    // (if today is incomplete-but-not-over, we simply don't count it; no reset)

    while (true) {
        const d = new Date(todayD);
        d.setDate(d.getDate() - offset);
        const ds = d.toISOString().split('T')[0];
        const log = child.dailyLogs[ds];
        if (!log) break;
        if (log.excused) { offset++; continue; } // freeze
        if (isRoutineDayComplete(child, ds)) { streak++; offset++; }
        else break;
    }

    return streak;
}
