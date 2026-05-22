import { useTranslation } from 'react-i18next';
import { MapPin, Phone } from 'lucide-react';

const Footer = () => {
  const { t } = useTranslation();

  return (
    <footer id="contact" style={{ backgroundColor: 'var(--navy)', color: 'var(--white)', paddingTop: '80px', paddingBottom: '30px' }}>
      <div className="container">
        
        <div className="footer-grid" style={{
          display: 'grid',
          gridTemplateColumns: '2fr 1.5fr 1.5fr 1fr',
          gap: '40px',
          marginBottom: '60px'
        }}>
          
          {/* Col 1: Brand */}
          <div>
            <div style={{ fontFamily: 'Onest', fontSize: '2.5rem', marginBottom: '15px', color: 'var(--white)' }}>
              Ёрманд
            </div>
            <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: '0.95rem', maxWidth: '300px' }}>
              {t('hero.slogan')}
            </p>
          </div>

          {/* Col 2: Contact */}
          <div>
            <h4 style={{ color: 'var(--white)', marginBottom: '25px', fontFamily: 'Onest', textTransform: 'uppercase', letterSpacing: '0.1em', fontSize: '0.9rem' }}>
              {t('nav.contact')}
            </h4>
            <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
              <div style={{ display: 'flex', gap: '15px' }}>
                <MapPin size={20} color="var(--teal)" style={{ flexShrink: 0 }} />
                <span style={{ color: 'rgba(255,255,255,0.8)', fontSize: '0.95rem' }}>{t('contact.address')}</span>
              </div>
              <div style={{ display: 'flex', gap: '15px' }}>
                <Phone size={20} color="var(--teal)" style={{ flexShrink: 0 }} />
                <a href={`tel:${t('contact.phone')}`} style={{ color: 'rgba(255,255,255,0.8)', fontSize: '0.95rem', textDecoration: 'none' }}>
                  {t('contact.phone')}
                </a>
              </div>
            </div>
          </div>

          {/* Col 3: Schedule */}
          <div>
            <h4 style={{ color: 'var(--white)', marginBottom: '25px', fontFamily: 'Onest', textTransform: 'uppercase', letterSpacing: '0.1em', fontSize: '0.9rem' }}>
              График
            </h4>
            <div style={{ color: 'rgba(255,255,255,0.8)', fontSize: '0.95rem', lineHeight: 1.8 }}>
              Пн - Сб: 08:00 - 20:00<br/>
              Вс: Выходной
            </div>
          </div>

          {/* Col 4: Social */}
          <div>
            <h4 style={{ color: 'var(--white)', marginBottom: '25px', fontFamily: 'Onest', textTransform: 'uppercase', letterSpacing: '0.1em', fontSize: '0.9rem' }}>
              Соцсети
            </h4>
            <div style={{ display: 'flex', gap: '15px' }}>
              <a href="#" className="social-link">IG</a>
              <a href="#" className="social-link">FB</a>
            </div>
          </div>

        </div>

        {/* Bottom Bar */}
        <div style={{
          borderTop: '1px solid rgba(255,255,255,0.1)',
          paddingTop: '30px',
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          flexWrap: 'wrap',
          gap: '20px'
        }}>
          <div style={{ color: 'rgba(255,255,255,0.5)', fontSize: '0.85rem' }}>
            © {new Date().getFullYear()} Yormand Clinic. All rights reserved.
          </div>
          <div style={{ color: 'rgba(255,255,255,0.5)', fontSize: '0.85rem' }}>
            Designed by Webistan
          </div>
        </div>

      </div>

      <style>
        {`
          .social-link {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background-color: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
          }
          .social-link:hover {
            background-color: var(--teal);
            border-color: var(--teal);
            transform: translateY(-3px);
          }
          @media (max-width: 992px) {
            .footer-grid {
              grid-template-columns: repeat(2, 1fr) !important;
            }
          }
          @media (max-width: 600px) {
            .footer-grid {
              grid-template-columns: 1fr !important;
            }
          }
        `}
      </style>
    </footer>
  );
};

export default Footer;
