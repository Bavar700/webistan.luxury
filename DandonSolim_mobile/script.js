document.addEventListener('DOMContentLoaded', () => {
    // 1. Universal 3-Language Toggle Logic (RU / TJ / EN)
    const langButtons = document.querySelectorAll('.lang-btn');
    const htmlTag = document.documentElement;
    const allLangs = ['ru', 'tj', 'en'];

    // Custom Tajik Locale for Flatpickr
    const flatpickrTajik = {
        weekdays: {
            shorthand: ["Як", "Ду", "Се", "Чо", "Па", "Ҷу", "Ша"],
            longhand: [
                "Якшанбе",
                "Душанбе",
                "Сешанбе",
                "Чоршанбе",
                "Панҷшанбе",
                "Ҷумъа",
                "Шанбе"
            ]
        },
        months: {
            shorthand: [
                "Янв",
                "Фев",
                "Мар",
                "Апр",
                "Май",
                "Июн",
                "Июл",
                "Авг",
                "Сен",
                "Окт",
                "Ноя",
                "Дек"
            ],
            longhand: [
                "Январ",
                "Феврал",
                "Март",
                "Апрел",
                "Май",
                "Июн",
                "Июл",
                "Август",
                "Сентябр",
                "Октябр",
                "Ноябр",
                "Декабр"
            ]
        },
        firstDayOfWeek: 1,
        ordinal: () => "",
        rangeSeparator: " то ",
        weekAbbreviation: "Ҳаф",
        scrollTitle: "Барои зиёд кардан чарх занед",
        toggleTitle: "Барои иваз кардан клик кунед",
        amPM: ["пеш аз нисфирӯзӣ", "пас аз нисфирӯзӣ"],
        yearAriaLabel: "Сол",
        monthAriaLabel: "Моҳ",
        hourAriaLabel: "Соат",
        minuteAriaLabel: "Дақиқа"
    };

    // Validation translations
    const validationTranslations = {
        ru: {
            name: "Пожалуйста, заполните это поле",
            phone: "Пожалуйста, введите ваш номер телефона",
            date: "Пожалуйста, выберите дату"
        },
        tj: {
            name: "Лутфан, ин майдонро пур кунед",
            phone: "Лутфан, рақами телефони худро ворид кунед",
            date: "Лутфан, санаро интихоб кунед"
        },
        en: {
            name: "Please fill out this field",
            phone: "Please enter your phone number",
            date: "Please select a date"
        }
    };

    function updateValidationMessages() {
        const inputs = [
            { id: 'bookingName', type: 'name' },
            { id: 'bookingPhone', type: 'phone' },
            { id: 'bookingDate', type: 'date' },
            { id: 'clientName', type: 'name' },
            { id: 'clientPhone', type: 'phone' }
        ];

        inputs.forEach(item => {
            const el = document.getElementById(item.id);
            if (el) {
                // Clear any custom validity
                el.setCustomValidity('');

                // Custom invalid message callback
                el.oninvalid = function(e) {
                    const currentLang = localStorage.getItem('dandoni_lang') || 'ru';
                    const msg = validationTranslations[currentLang][item.type];
                    e.target.setCustomValidity(msg);
                };

                // Clear validation error popup as soon as user types
                el.oninput = function(e) {
                    e.target.setCustomValidity('');
                };
            }
        });
    }

    // Set minimum date to today and reference elements
    const today = new Date().toISOString().split('T')[0];
    const dateInput = document.getElementById('bookingDate');
    if (dateInput) {
        dateInput.min = today;
        dateInput.value = today;
    }

    // Initialize Flatpickr for the booking date input early so it is available to setLanguage
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
        const bookingDateInput = document.getElementById('bookingDate');
        const bookingNameInput = document.getElementById('bookingName');
        const clientNameInput = document.getElementById('clientName');
        const langCodes = { ru: 'ru', tj: 'tg', en: 'en' };
        const datePlaceholders = { ru: 'Выберите дату...', tj: 'Санаро интихоб кунед...', en: 'Select a date...' };
        const namePlaceholders = { ru: 'Алишер', tj: 'Алишер', en: 'e.g. Alex' };

        htmlTag.setAttribute('lang', langCodes[lang] || 'ru');

        // Toggle active button
        langButtons.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.lang === lang);
        });

        // Hide all languages, then show the active one
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

        if (bookingDateInput) {
            bookingDateInput.placeholder = datePlaceholders[lang] || datePlaceholders.ru;
        }
        if (bookingNameInput) {
            bookingNameInput.placeholder = namePlaceholders[lang] || namePlaceholders.ru;
        }
        if (clientNameInput) {
            clientNameInput.placeholder = namePlaceholders[lang] || namePlaceholders.ru;
        }

        // Dynamically update Flatpickr locale
        if (fp) {
            if (lang === 'tj') {
                fp.set('locale', flatpickrTajik);
            } else if (lang === 'en') {
                fp.set('locale', 'default');
            } else {
                fp.set('locale', 'ru');
            }
            fp.redraw();
        }

        localStorage.setItem('dandoni_lang', lang);
        
        // Update form validation messages for the new language
        updateValidationMessages();
    }

    langButtons.forEach(btn => {
        btn.addEventListener('click', () => setLanguage(btn.dataset.lang));
    });

    // Restore saved language or default to Russian
    const savedLang = localStorage.getItem('dandoni_lang') || 'ru';
    setLanguage(savedLang);

    // Make body visible after init (CSS starts with opacity:0 for smooth load)
    requestAnimationFrame(() => {
        document.body.classList.add('page-ready');
    });


    // 3. Header Scroll Effect
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });


    // 4. Fallback Modal Trigger
    const bookingModal = document.getElementById('bookingModal');
    const openModalButtons = document.querySelectorAll('.open-modal-btn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const bookingForm = document.getElementById('bookingForm');
    const successMsg = document.getElementById('successMsg');

    function openModal() {
        bookingModal.classList.add('active');
        bookingForm.style.display = 'flex';
        successMsg.style.display = 'none';
        document.body.style.overflow = 'hidden'; 
    }

    function closeModal() {
        bookingModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    openModalButtons.forEach(btn => {
        btn.addEventListener('click', openModal);
    });

    closeModalBtn.addEventListener('click', closeModal);
    bookingModal.addEventListener('click', (e) => {
        if (e.target === bookingModal) {
            closeModal();
        }
    });

    bookingForm.addEventListener('submit', (e) => {
        e.preventDefault();
        bookingForm.style.opacity = '0';
        setTimeout(() => {
            bookingForm.style.display = 'none';
            successMsg.style.display = 'flex';
            successMsg.style.opacity = '1';
        }, 300);
    });


    // 5. High-End Interactive Inline Appointment Booking Logic
    const doctorCards = document.querySelectorAll('.doctor-card');
    const timeSlots = document.querySelectorAll('.time-slot');
    const mainBookingForm = document.getElementById('mainBookingForm');
    const mainBookingSuccess = document.getElementById('mainBookingSuccess');
    const btnBookAgain = document.getElementById('btnBookAgain');

    // Doctor Selection Cards
    doctorCards.forEach(card => {
        card.addEventListener('click', () => {
            doctorCards.forEach(c => c.classList.remove('active'));
            card.classList.add('active');
        });
    });

    // Time Slot Selectors
    timeSlots.forEach(slot => {
        slot.addEventListener('click', () => {
            timeSlots.forEach(s => s.classList.remove('active'));
            slot.classList.add('active');
        });
    });

    // Main Booking Form Submission
    mainBookingForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Gather selection values
        const activeDoctorCard = document.querySelector('.doctor-card.active');
        const activeTimeSlot = document.querySelector('.time-slot.active');
        const doctorId = activeDoctorCard ? activeDoctorCard.dataset.doctor : 'dr-alisher';
        const doctorNameText = doctorId === 'dr-zarina' ? 'Dr. Zarina' : 'Dr. Alisher';
        const dateValue = dateInput.value;
        const timeSlotValue = activeTimeSlot ? activeTimeSlot.dataset.time : '09:00';
        const patientName = document.getElementById('bookingName').value;
        const patientPhone = document.getElementById('bookingPhone').value;

        // Custom receipt display with translatable spans
        const receiptDoctorEl = document.getElementById('receiptDoctor');
        if (doctorId === 'dr-zarina') {
            receiptDoctorEl.innerHTML = `
                <span class="lang-ru">Д-р Зарина</span>
                <span class="lang-tj" style="display:none;">Д-р Зарина</span>
                <span class="lang-en" style="display:none;">Dr. Zarina</span>
            `;
        } else {
            receiptDoctorEl.innerHTML = `
                <span class="lang-ru">Д-р Алишер</span>
                <span class="lang-tj" style="display:none;">Д-р Алишер</span>
                <span class="lang-en" style="display:none;">Dr. Alisher</span>
            `;
        }
        
        // Match the receipt doctor name instantly to the current language
        const currentLang = localStorage.getItem('dandoni_lang') || 'ru';
        receiptDoctorEl.querySelectorAll('.lang-ru, .lang-tj, .lang-en').forEach(el => {
            el.style.display = 'none';
        });
        const activeSpan = receiptDoctorEl.querySelector('.lang-' + currentLang);
        if (activeSpan) {
            activeSpan.style.display = 'inline';
        }
        
        // Formatted date string (DD.MM.YYYY)
        const dateParts = dateValue.split('-');
        const formattedDate = dateParts.length === 3 ? `${dateParts[2]}.${dateParts[1]}.${dateParts[0]}` : dateValue;
        document.getElementById('receiptDate').innerText = formattedDate;
        
        document.getElementById('receiptTime').innerText = timeSlotValue;
        document.getElementById('receiptName').innerText = patientName;

        // Handoff details logged to console
        console.log(`[Dandoni Solim Appointment booked] Name: ${patientName}, Phone: ${patientPhone}, Doctor: ${doctorNameText}, Date: ${formattedDate}, Time: ${timeSlotValue}`);

        // Smooth transition to Success Screen
        mainBookingForm.style.opacity = '0';
        setTimeout(() => {
            mainBookingForm.style.display = 'none';
            mainBookingSuccess.style.display = 'flex';
            mainBookingSuccess.style.opacity = '1';
        }, 300);
    });

    // Reset Form to book again
    btnBookAgain.addEventListener('click', () => {
        mainBookingSuccess.style.display = 'none';
        mainBookingForm.style.display = 'flex';
        mainBookingForm.style.opacity = '1';
        
        // Reset name, phone and date to defaults
        document.getElementById('bookingName').value = '';
        document.getElementById('bookingPhone').value = '';
        dateInput.value = today;
    });


    // 6. Mobile Menu Toggle
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

    mobileMenuToggle.addEventListener('click', openMobileMenu);
    closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
    
    mobLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    mobileNavOverlay.addEventListener('click', (e) => {
        if (e.target === mobileNavOverlay) {
            closeMobileMenu();
        }
    });
});
