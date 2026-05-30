import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import bgImg from '../assets/images/hero-bg.jpg';

const Hero = () => {
  const { t } = useTranslation();

  return (
    <section id="home" style={{ 
      minHeight: '100vh',
      position: 'relative',
      display: 'flex',
      alignItems: 'center',
      overflow: 'hidden'
    }}>
      {/* Background Image */}
      <div style={{
        position: 'absolute',
        top: 0, left: 0, right: 0, bottom: 0,
        zIndex: -2,
      }}>
        <img src={bgImg} alt="Dental Clinic Yormand" style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
      </div>

      {/* Premium Frosted Glass Overlay */}
      <div style={{
        position: 'absolute',
        top: 0, left: 0, right: 0, bottom: 0,
        background: 'linear-gradient(135deg, rgba(255, 255, 255, 0.6) 0%, rgba(255, 255, 255, 0.4) 100%)',
        backdropFilter: 'blur(12px)',
        WebkitBackdropFilter: 'blur(12px)',
        zIndex: -1
      }} />

      <div className="container" style={{ 
        position: 'relative',
        zIndex: 1,
        width: '100%',
        paddingTop: '80px'
      }}>
        
        <div style={{ maxWidth: '1200px', margin: '0 auto', textAlign: 'center' }}>
          <motion.div 
            initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}
            className="section-subtitle" style={{ justifyContent: 'center' }}
          >
            {t('hero.subtitle')}
          </motion.div>
          
          <motion.h1 
            initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6, delay: 0.1 }}
            style={{ marginBottom: '25px', color: '#034577', fontFamily: "'Cormorant SC', serif", fontSize: 'clamp(2.2rem, 5vw, 4.2rem)', fontWeight: 700, lineHeight: 1.25, letterSpacing: '0.05em', whiteSpace: 'pre-line', minHeight: '2.5em' }}
          >
            {t('hero.title')}
          </motion.h1>

          <motion.p 
            initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6, delay: 0.2 }}
            style={{ marginBottom: '50px', fontSize: '1.2rem', color: 'var(--text-body)', minHeight: '4.5em', whiteSpace: 'pre-line' }}
          >
            {t('hero.slogan')}
          </motion.p>

          <motion.div 
            initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6, delay: 0.3 }}
            className="hero-buttons"
            style={{ display: 'flex', gap: '20px', flexWrap: 'wrap', justifyContent: 'center' }}
          >
            {/* Dikidi link */}
            <a 
              href="https://dikidi.net/ru/" target="_blank" rel="noopener noreferrer"
              className="btn-hero-primary"
            >
              {t('hero.cta')}
            </a>
            <a 
              href="#services" 
              className="btn-hero-outline"
            >
              {t('nav.services')}
            </a>
          </motion.div>
        </div>

      </div>
      
      <style>
        {`
          @media (max-width: 600px) {
            .hero-buttons {
              flex-direction: column !important;
              width: 100%;
            }
            .hero-buttons a {
              width: 100% !important;
            }
          }
        `}
      </style>

    </section>
  );
};

export default Hero;
