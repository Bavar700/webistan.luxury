document.addEventListener('DOMContentLoaded', () => {

    // ─── 1. LANGUAGE SWITCH ─────────────────────────────────
    const allLangButtons = document.querySelectorAll('.lang-btn');
    const htmlTag = document.documentElement;
    const allLangs = ['ru', 'tj', 'en'];

    // Custom Tajik locale for Flatpickr
    const flatpickrTajik = {
        weekdays: {
            shorthand: ["Як", "Ду", "Се", "Чо", "Па", "Ҷу", "Ша"],
            longhand: ["Якшанбе","Душанбе","Сешанбе","Чоршанбе","Панҷшанбе","Ҷумъа","Шанбе"]
        },
        months: {
            shorthand: ["Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек"],
            longhand: ["Январ","Феврал","Март","Апрел","Май","Июн","Июл","Август","Сентябр","Октябр","Ноябр","Декабр"]
        },
        firstDayOfWeek: 1,
        ordinal: () => "",
        rangeSeparator: " то ",
        weekAbbreviation: "Ҳаф",
        scrollTitle: "Барои зиёд кардан чарх занед",
        toggleTitle: "Барои иваз кардан клик кунед",
        amPM: ["пеш аз нисфирӯзӣ","пас аз нисфирӯзӣ"],
        yearAriaLabel: "Сол",
        monthAriaLabel: "Моҳ",
        hourAriaLabel: "Соат",
        minuteAriaLabel: "Дақиқа"
    };

    // Validation messages
    const validationMsgs = {
        ru: { name: "Пожалуйста, заполните это поле", phone: "Пожалуйста, введите номер телефона", date: "Пожалуйста, выберите дату" },
        tj: { name: "Лутфан, ин майдонро пур кунед", phone: "Лутфан, рақами телефон ворид кунед", date: "Лутфан, санаро интихоб кунед" },
        en: { name: "Please fill out this field", phone: "Please enter your phone number", date: "Please select a date" }
    };

    function updateValidationMessages(lang) {
        const fields = [
            { id: 'bookingName',  key: 'name' },
            { id: 'bookingPhone', key: 'phone' },
            { id: 'bookingDate',  key: 'date' },
            { id: 'clientName',   key: 'name' },
            { id: 'clientPhone',  key: 'phone' }
        ];
        fields.forEach(f => {
            const el = document.getElementById(f.id);
            if (!el) return;
            el.setCustomValidity('');
            el.oninvalid = e => e.target.setCustomValidity(validationMsgs[lang][f.key]);
            el.oninput = e => e.target.setCustomValidity('');
        });
    }

    // Flatpickr init
    const today = new Date().toISOString().split('T')[0];
    let fp = null;
    if (document.getElementById('bookingDate')) {
        fp = flatpickr("#bookingDate", {
            locale: "ru",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: today,
            disableMobile: "true"
        });
    }

    function setLanguage(lang) {
        const langCodes = { ru: 'ru', tj: 'tg', en: 'en' };
        const datePlaceholders = { ru: 'Выберите дату...', tj: 'Санаро интихоб кунед...', en: 'Select a date...' };
        const namePlaceholders = { ru: 'Ваше имя', tj: 'Номи Шумо', en: 'Your name' };

        htmlTag.setAttribute('lang', langCodes[lang] || 'ru');

        // Toggle active button on ALL lang-btn elements (header + mobile)
        allLangButtons.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.lang === lang);
        });

        // Hide all, show active
        allLangs.forEach(l => {
            document.querySelectorAll('.lang-' + l).forEach(el => {
                el.style.display = 'none';
            });
        });
        document.querySelectorAll('.lang-' + lang).forEach(el => {
            if (el.tagName === 'OPTION') {
                el.style.display = 'block';
            } else if (el.tagName === 'SPAN' || el.tagName === 'I') {
                el.style.display = 'inline';
            } else {
                el.style.display = 'block';
            }
        });

        // Update placeholders
        const dateInput = document.getElementById('bookingDate');
        const bookingName = document.getElementById('bookingName');
        const clientName = document.getElementById('clientName');
        if (dateInput) dateInput.placeholder = datePlaceholders[lang] || datePlaceholders.ru;
        if (bookingName) bookingName.placeholder = namePlaceholders[lang] || namePlaceholders.ru;
        if (clientName) clientName.placeholder = namePlaceholders[lang] || namePlaceholders.ru;

        // Update Flatpickr locale
        if (fp) {
            if (lang === 'tj') { fp.set('locale', flatpickrTajik); }
            else if (lang === 'en') { fp.set('locale', 'default'); }
            else { fp.set('locale', 'ru'); }
            fp.redraw();
        }

        localStorage.setItem('khalif_lang', lang);
        updateValidationMessages(lang);
    }

    allLangButtons.forEach(btn => {
        btn.addEventListener('click', () => setLanguage(btn.dataset.lang));
    });

    // Restore saved language
    const savedLang = localStorage.getItem('khalif_lang') || 'ru';
    setLanguage(savedLang);

    // Body fade-in
    requestAnimationFrame(() => { document.body.classList.add('page-ready'); });


    // ─── 2. HEADER SCROLL EFFECT ────────────────────────────
    const header = document.querySelector('.main-header');
    const scrollProgress = document.querySelector('.scroll-progress');

    function updateScroll() {
        const scrollY = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;

        // Header state
        if (scrollY > 40) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        // Scroll progress bar
        if (scrollProgress && docHeight > 0) {
            const percent = (scrollY / docHeight) * 100;
            scrollProgress.style.width = Math.min(percent, 100) + '%';
        }
    }

    window.addEventListener('scroll', updateScroll, { passive: true });
    updateScroll();


    // ─── 3. SCROLL REVEAL ANIMATIONS ────────────────────────
    const revealElements = document.querySelectorAll('.reveal, .reveal-stagger');

    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        // Fallback: show all
        revealElements.forEach(el => el.classList.add('visible'));
    }


    // ─── 4. MOBILE MENU ─────────────────────────────────────
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileNavOverlay = document.getElementById('mobileNavOverlay');
    const closeMobileMenuBtn = document.getElementById('closeMobileMenuBtn');
    const mobLinks = document.querySelectorAll('.mob-link');

    function openMobileMenu() {
        mobileNavOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeMobileMenu() {
        mobileNavOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (mobileMenuToggle) mobileMenuToggle.addEventListener('click', openMobileMenu);
    if (closeMobileMenuBtn) closeMobileMenuBtn.addEventListener('click', closeMobileMenu);

    mobLinks.forEach(link => link.addEventListener('click', closeMobileMenu));
    if (mobileNavOverlay) {
        mobileNavOverlay.addEventListener('click', e => {
            if (e.target === mobileNavOverlay) closeMobileMenu();
        });
    }


    // ─── 5. BOOKING: DOCTOR SELECTION ───────────────────────
    const doctorCards = document.querySelectorAll('.doctor-card');
    doctorCards.forEach(card => {
        card.addEventListener('click', () => {
            doctorCards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
        });
    });


    // ─── 6. BOOKING: TIME SLOTS ─────────────────────────────
    const timeSlots = document.querySelectorAll('.time-slot');
    timeSlots.forEach(slot => {
        slot.addEventListener('click', () => {
            timeSlots.forEach(s => s.classList.remove('active'));
            slot.classList.add('active');
        });
    });


    // ─── 7. MAIN BOOKING FORM SUBMISSION ────────────────────
    const mainBookingForm = document.getElementById('mainBookingForm');
    const mainBookingSuccess = document.getElementById('mainBookingSuccess');
    const btnBookAgain = document.getElementById('btnBookAgain');
    const dateInput = document.getElementById('bookingDate');

    if (mainBookingForm) {
        mainBookingForm.addEventListener('submit', e => {
            e.preventDefault();

            const activeDoctorCard = document.querySelector('.doctor-card.active');
            const activeTimeSlot = document.querySelector('.time-slot.active');
            const doctorId = activeDoctorCard ? activeDoctorCard.dataset.doctor : 'dr-alisher';
            const dateValue = dateInput ? dateInput.value : today;
            const timeValue = activeTimeSlot ? activeTimeSlot.dataset.time : '09:00';
            const patientName = document.getElementById('bookingName').value;
            const patientPhone = document.getElementById('bookingPhone').value;

            // Populate receipt
            const receiptDoctorEl = document.getElementById('receiptDoctor');
            if (receiptDoctorEl) {
                if (doctorId === 'dr-zarina') {
                    receiptDoctorEl.innerHTML = `<span class="lang-ru">Д-р Зарина</span><span class="lang-tj" style="display:none;">Д-р Зарина</span><span class="lang-en" style="display:none;">Dr. Zarina</span>`;
                } else {
                    receiptDoctorEl.innerHTML = `<span class="lang-ru">Д-р Алишер</span><span class="lang-tj" style="display:none;">Д-р Алишер</span><span class="lang-en" style="display:none;">Dr. Alisher</span>`;
                }
                // Apply current language to receipt doctor spans
                const currentLang = localStorage.getItem('khalif_lang') || 'ru';
                receiptDoctorEl.querySelectorAll('[class^="lang-"]').forEach(el => el.style.display = 'none');
                const activeSpan = receiptDoctorEl.querySelector('.lang-' + currentLang);
                if (activeSpan) activeSpan.style.display = 'inline';
            }

            // Format date
            const dateParts = dateValue.split('-');
            const formattedDate = dateParts.length === 3 ? `${dateParts[2]}.${dateParts[1]}.${dateParts[0]}` : dateValue;
            document.getElementById('receiptDate').innerText = formattedDate;
            document.getElementById('receiptTime').innerText = timeValue;
            document.getElementById('receiptName').innerText = patientName;

            console.log(`[Khalif Dental] Appointment — Name: ${patientName}, Phone: ${patientPhone}, Doctor: ${doctorId}, Date: ${formattedDate}, Time: ${timeValue}`);

            // Transition to success screen
            mainBookingForm.style.opacity = '0';
            mainBookingForm.style.transition = 'opacity 0.3s ease';
            setTimeout(() => {
                mainBookingForm.style.display = 'none';
                mainBookingSuccess.style.display = 'flex';
                mainBookingSuccess.style.opacity = '1';
                mainBookingSuccess.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 300);
        });
    }

    if (btnBookAgain) {
        btnBookAgain.addEventListener('click', () => {
            mainBookingSuccess.style.display = 'none';
            mainBookingForm.style.display = 'flex';
            mainBookingForm.style.opacity = '1';
            document.getElementById('bookingName').value = '';
            document.getElementById('bookingPhone').value = '';
            if (fp) { fp.setDate(today); }
        });
    }


    // ─── 8. FALLBACK MODAL ──────────────────────────────────
    const bookingModal = document.getElementById('bookingModal');
    const openModalButtons = document.querySelectorAll('.open-modal-btn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const bookingForm = document.getElementById('bookingForm');
    const successMsg = document.getElementById('successMsg');

    function openModal() {
        if (!bookingModal) return;
        bookingModal.classList.add('active');
        if (bookingForm) { bookingForm.style.display = 'flex'; bookingForm.style.opacity = '1'; }
        if (successMsg) successMsg.style.display = 'none';
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        if (!bookingModal) return;
        bookingModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    openModalButtons.forEach(btn => btn.addEventListener('click', openModal));
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (bookingModal) {
        bookingModal.addEventListener('click', e => {
            if (e.target === bookingModal) closeModal();
        });
    }

    if (bookingForm) {
        bookingForm.addEventListener('submit', e => {
            e.preventDefault();
            bookingForm.style.opacity = '0';
            setTimeout(() => {
                bookingForm.style.display = 'none';
                if (successMsg) { successMsg.style.display = 'flex'; successMsg.style.opacity = '1'; }
            }, 300);
        });
    }


    // ─── 9. SMOOTH ANCHOR SCROLLING ─────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            const targetId = anchor.getAttribute('href');
            if (targetId === '#') return;
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                const headerH = header ? header.offsetHeight : 0;
                const targetY = target.getBoundingClientRect().top + window.scrollY - headerH - 20;
                window.scrollTo({ top: targetY, behavior: 'smooth' });
            }
        });
    });

});
