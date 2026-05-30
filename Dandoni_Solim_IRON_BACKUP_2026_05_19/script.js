document.addEventListener('DOMContentLoaded', () => {
    // 1. Universal 3-Language Toggle Logic (RU / TJ / EN)
    const langButtons = document.querySelectorAll('.lang-btn');
    const htmlTag = document.documentElement;
    const allLangs = ['ru', 'tj', 'en'];

    function setLanguage(lang) {
        const bookingDateInput = document.getElementById('bookingDate');
        const bookingNameInput = document.getElementById('bookingName');
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
        localStorage.setItem('dandoni_lang', lang);
    }

    langButtons.forEach(btn => {
        btn.addEventListener('click', () => setLanguage(btn.dataset.lang));
    });

    // Restore saved language or default to Russian
    const savedLang = localStorage.getItem('dandoni_lang') || 'ru';
    setLanguage(savedLang);


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
    const dateInput = document.getElementById('bookingDate');
    const mainBookingForm = document.getElementById('mainBookingForm');
    const mainBookingSuccess = document.getElementById('mainBookingSuccess');
    const btnBookAgain = document.getElementById('btnBookAgain');
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;
    dateInput.value = today;

    // Initialize Flatpickr for the booking date input
    const fp = flatpickr("#bookingDate", {
        locale: "ru",
        dateFormat: "Y-m-d",
        minDate: "today",
        defaultDate: today,
        disableMobile: "true"
    });

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
        const doctorName = activeDoctorCard ? activeDoctorCard.querySelector('.dr-name').innerText : 'Д-р Алишер';
        const dateValue = dateInput.value;
        const timeSlotValue = activeTimeSlot ? activeTimeSlot.dataset.time : '09:00';
        const patientName = document.getElementById('bookingName').value;
        const patientPhone = document.getElementById('bookingPhone').value;

        // Custom receipt display
        document.getElementById('receiptDoctor').innerText = doctorName;
        
        // Formatted date string (DD.MM.YYYY)
        const dateParts = dateValue.split('-');
        const formattedDate = dateParts.length === 3 ? `${dateParts[2]}.${dateParts[1]}.${dateParts[0]}` : dateValue;
        document.getElementById('receiptDate').innerText = formattedDate;
        
        document.getElementById('receiptTime').innerText = timeSlotValue;
        document.getElementById('receiptName').innerText = patientName;

        // Handoff details logged to console
        console.log(`[Dandoni Solim Appointment booked] Name: ${patientName}, Phone: ${patientPhone}, Doctor: ${doctorName}, Date: ${formattedDate}, Time: ${timeSlotValue}`);

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
