<div class="footer-separator"></div>
<footer class="footer">
    <div class="container">
        <div class="footer__grid">
            <div>
                <div style="font-family:Montserrat,sans-serif;font-weight:900;font-size:20px;margin-bottom:16px;">
                    <span style="color:rgba(255,255,255,0.9)">NEK</span><span style="color:rgba(255,255,255,0.5)">SOZ</span>
                </div>
                <p class="footer__about-text">Консалтинговая группа NEKSOZ — Ваш надёжный партнёр в сфере аудита, налогообложения и юридических услуг. Работаем для Вашего успеха.</p>
            </div>

            <div>
                <div class="footer__heading">Услуги</div>
                <ul class="footer__links">
                    <li><a href="#">Аудит</a></li>
                    <li><a href="#">Налогообложение</a></li>
                    <li><a href="#">Юридические услуги</a></li>
                    <li><a href="#">Бухгалтерский учёт</a></li>
                    <li><a href="#">Восстановление учёта</a></li>
                </ul>
            </div>

            <div>
                <div class="footer__heading">Компания</div>
                <ul class="footer__links">
                    <li><a href="#">О нас</a></li>
                    <li><a href="#">Новости</a></li>
                    <li><a href="#">Вакансии</a></li>
                    <li><a href="#">Контакты</a></li>
                </ul>
            </div>

            <div>
                <div class="footer__heading">Контакты</div>
                <div class="footer__contact-item">
                    <div class="footer__contact-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div class="footer__contact-text">
                        <a href="tel:+992000000000">+992 (000) 00-00-00</a>
                    </div>
                </div>
                <div class="footer__contact-item">
                    <div class="footer__contact-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <div class="footer__contact-text">
                        <a href="mailto:info@neksoz.com">info@neksoz.com</a>
                    </div>
                </div>
                <div class="footer__contact-item">
                    <div class="footer__contact-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div class="footer__contact-text">
                        г. Душанбе, ул. Рудаки 42
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__bottom">
            <span>© 2026 NEKSOZ. Все права защищены.</span>
            <span>Разработано <a href="https://webistan.luxury" target="_blank" rel="noopener">Webistan.Luxury</a></span>
        </div>
    </div>
</footer>

<script>
// Intersection Observer for fade-in animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        }
    });
}, { rootMargin: '0px 0px -40px 0px', threshold: 0.1 });

document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

<?php wp_footer(); ?>
</body>
</html>