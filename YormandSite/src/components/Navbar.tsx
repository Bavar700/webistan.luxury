import { useState, useEffect } from 'react';
import { useTranslation } from 'react-i18next';
import { Calendar, Menu, X } from 'lucide-react';
import { motion, AnimatePresence } from 'framer-motion';

import logoEn from '../assets/images/ermand-logo-en.svg';
import logoRu from '../assets/images/ermand-logo-ru.svg';
import logoTj from '../assets/images/ermand-logo-tj.svg';

interface NavbarProps {
  onOpenModal: () => void;
}

const Navbar = ({ onOpenModal }: NavbarProps) => {
  const { t, i18n } = useTranslation();
  const [scrolled, setScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 20);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  const changeLanguage = (lng: string) => i18n.changeLanguage(lng);

  const getLogo = () => {
    if (i18n.language === 'en') return logoEn;
    if (i18n.language === 'tj') return logoTj;
    return logoRu;
  };

  const navLinks = [
    { id: 'services', label: t('nav.services') },
    { id: 'about', label: t('nav.about') },
    { id: 'reviews', label: t('nav.reviews') },
    { id: 'contact', label: t('nav.contact') },
  ];

  return (
    <>
      <header style={{
        position: 'fixed',
        top: 0, left: 0, right: 0,
        zIndex: 1000,
        transition: 'all 0.4s ease',
        backgroundColor: scrolled ? 'rgba(255, 255, 255, 0.95)' : 'transparent',
        backdropFilter: scrolled ? 'blur(10px)' : 'none',
        borderBottom: scrolled ? '1px solid var(--border)' : 'none',
        padding: scrolled ? '15px 0' : '30px 0',
      }}>
        <div className="container" style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
          
          {/* Logo */}
          <a href="#" style={{ zIndex: 1001, marginLeft: '-10px' }}>
            <img 
              src={getLogo()} 
              alt="Yormand" 
              style={{ 
                height: scrolled ? '50px' : '70px', 
                transition: 'height 0.4s ease',
                width: 'auto'
              }} 
            />
          </a>

          {/* Desktop Nav */}
          <nav className="desktop-nav" style={{ display: 'flex', gap: '40px', alignItems: 'center' }}>
            {navLinks.map(link => (
              <a key={link.id} href={`#${link.id}`} className="nav-link">
                {link.label}
              </a>
            ))}
          </nav>

          {/* Right Actions */}
          <div className="desktop-actions" style={{ display: 'flex', alignItems: 'center', gap: '20px' }}>
            
            {/* Lang Switcher */}
            <div style={{ display: 'flex', backgroundColor: 'var(--ivory)', borderRadius: '30px', padding: '5px' }}>
              {['tj', 'ru', 'en'].map(lng => (
                <button
                  key={lng}
                  onClick={() => changeLanguage(lng)}
                  className={`lang-pill ${i18n.language === lng ? 'active' : ''}`}
                >
                  {lng.toUpperCase()}
                </button>
              ))}
            </div>
          </div>

          {/* Mobile Menu Toggle */}
          <button 
            className="mobile-toggle" 
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            style={{ background: 'none', border: 'none', cursor: 'pointer', zIndex: 1001, color: 'var(--navy)' }}
          >
            {mobileMenuOpen ? <X size={28} /> : <Menu size={28} />}
          </button>
        </div>
      </header>

      {/* Mobile Menu Overlay */}
      <AnimatePresence>
        {mobileMenuOpen && (
          <motion.div
            initial={{ opacity: 0, y: -20 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -20 }}
            style={{
              position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
              backgroundColor: 'var(--white)', zIndex: 999,
              display: 'flex', flexDirection: 'column',
              paddingTop: '100px', alignItems: 'center'
            }}
          >
            <nav style={{ display: 'flex', flexDirection: 'column', gap: '30px', textAlign: 'center', marginBottom: '40px' }}>
              {navLinks.map(link => (
                <a 
                  key={link.id} 
                  href={`#${link.id}`} 
                  style={{ fontSize: '1.2rem', color: 'var(--navy)', textDecoration: 'none', fontFamily: 'Onest', textTransform: 'uppercase', letterSpacing: '2px', fontWeight: 600 }}
                  onClick={() => setMobileMenuOpen(false)}
                >
                  {link.label}
                </a>
              ))}
            </nav>
            <div style={{ display: 'flex', gap: '15px', marginBottom: '40px' }}>
              {['tj', 'ru', 'en'].map(lng => (
                <button
                  key={lng}
                  onClick={() => { changeLanguage(lng); setMobileMenuOpen(false); }}
                  style={{
                    padding: '10px 20px', borderRadius: '30px', border: '1px solid var(--border)',
                    backgroundColor: i18n.language === lng ? 'var(--navy)' : 'transparent',
                    color: i18n.language === lng ? 'var(--white)' : 'var(--navy)',
                    fontFamily: 'Onest', fontWeight: 500
                  }}
                >
                  {lng.toUpperCase()}
                </button>
              ))}
            </div>
          </motion.div>
        )}
      </AnimatePresence>

      <style>
        {`
          .nav-link {
            color: var(--navy);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            transition: color 0.3s;
          }
          .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--teal);
            transition: width 0.3s ease;
          }
          .nav-link:hover::after {
            width: 100%;
          }
          .nav-link:hover {
            color: var(--teal);
          }
          .lang-pill {
            background: transparent;
            border: none;
            padding: 8px 15px;
            border-radius: 25px;
            cursor: pointer;
            font-family: 'Onest', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-light);
            transition: all 0.3s ease;
          }
          .lang-pill.active {
            background-color: var(--white);
            color: var(--teal);
            box-shadow: var(--shadow-sm);
          }
          .mobile-toggle {
            display: none;
          }
          @media (max-width: 992px) {
            .desktop-nav, .desktop-actions { display: none !important; }
            .mobile-toggle { display: block !important; }
          }
        `}
      </style>
    </>
  );
};

export default Navbar;
