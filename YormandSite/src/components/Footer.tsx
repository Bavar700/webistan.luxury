import { useTranslation } from 'react-i18next';
import { MapPin, Phone } from 'lucide-react';
import logoEn from '../assets/images/ermand-logo-en.svg';
import logoRu from '../assets/images/ermand-logo-ru.svg';
import logoTj from '../assets/images/ermand-logo-tj.svg';

const Footer = () => {
  const { t, i18n } = useTranslation();

  const getLogo = () => {
    if (i18n.language === 'en') return logoEn;
    if (i18n.language === 'tj') return logoTj;
    return logoRu;
  };

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
          <div className="footer-brand-col" style={{ display: 'flex', flexDirection: 'column', alignItems: 'flex-start' }}>
            <div className="footer-logo" style={{ marginBottom: '25px', marginLeft: '-15px' }}>
              <img src={getLogo()} alt="Yormand" style={{ height: '60px', filter: 'brightness(0) invert(1)' }} />
            </div>
            <p style={{ color: 'rgba(255,255,255,0.7)', fontSize: '0.95rem', maxWidth: '300px' }}>
              {t('hero.slogan')}
            </p>
          </div>

          {/* Col 2: Contact */}
          <div>
            <h4 style={{ color: 'var(--white)', marginBottom: '25px', fontFamily: 'Montserrat', textTransform: 'uppercase', letterSpacing: '0.1em', fontSize: '0.9rem' }}>
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
            <h4 style={{ color: 'var(--white)', marginBottom: '25px', fontFamily: 'Montserrat', textTransform: 'uppercase', letterSpacing: '0.1em', fontSize: '0.9rem' }}>
              {t('footer.schedule')}
            </h4>
            <div style={{ color: 'rgba(255,255,255,0.8)', fontSize: '0.95rem', lineHeight: 1.8 }}>
              {t('footer.weekdays')}<br/>
              {t('footer.weekend')}
            </div>
          </div>

          {/* Col 4: Social */}
          <div>
            <div style={{ display: 'flex', gap: '15px', marginBottom: '30px' }}>
              <a href="#" className="social-link instagram-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
              </a>
              <a href="#" className="social-link facebook-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
              </a>
            </div>
          </div>

        </div>

        {/* Bottom Bar */}
        <div className="footer-bottom" style={{
          borderTop: '1px solid rgba(255,255,255,0.1)',
          paddingTop: '30px',
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          flexWrap: 'wrap',
          gap: '20px'
        }}>
          <div style={{ color: 'rgba(255,255,255,0.5)', fontSize: '0.85rem' }}>
            © {new Date().getFullYear()} Yormand.Tj {t('footer.rights')}
          </div>
          <div style={{ color: 'rgba(255,255,255,0.5)', fontSize: '0.85rem' }}>
            {t('footer.designedBy')}<a href="https://webistan.luxury" target="_blank" rel="noreferrer" style={{ color: 'var(--teal)', textDecoration: 'none', fontWeight: 600 }}>WEBISTAN.LUXURY</a>
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
            transform: translateY(-3px);
          }
          .instagram-btn:hover {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            border-color: transparent;
            color: white;
          }
          .facebook-btn:hover {
            background-color: #1877F2;
            border-color: #1877F2;
            color: white;
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
            .footer-brand-col {
              align-items: center !important;
              text-align: center !important;
            }
            .footer-logo {
              margin-left: 0 !important;
            }
            .footer-bottom {
              flex-direction: column !important;
              justify-content: center !important;
              text-align: center !important;
            }
          }
        `}
      </style>
    </footer>
  );
};

export default Footer;
