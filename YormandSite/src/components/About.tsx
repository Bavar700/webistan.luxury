import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import heroImg from '../assets/images/hero-bg.jpg';

const About = () => {
  const { t } = useTranslation();

  return (
    <section id="about" className="section-padding" style={{ backgroundColor: 'var(--white)' }}>
      <div className="container about-grid" style={{
        display: 'grid',
        gridTemplateColumns: '1fr 1fr',
        gap: '80px',
        alignItems: 'center'
      }}>

        {/* Left Image */}
        <motion.div
          initial={{ opacity: 0, x: -30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          style={{ position: 'relative' }}
        >
          <div style={{
            borderRadius: '24px',
            overflow: 'hidden',
            boxShadow: 'var(--shadow-lg)',
            position: 'relative'
          }}>
            <img src={heroImg} alt="Dental Clinic Yormand" style={{ width: '100%', height: 'auto', display: 'block' }} onError={(e) => { e.currentTarget.style.display = 'none'; }} />
          </div>
        </motion.div>

        {/* Right Content */}
        <motion.div
          initial={{ opacity: 0, x: 30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8, delay: 0.2 }}
        >
          <div className="section-subtitle">{t('nav.about')}</div>
          
          <h2 style={{ marginBottom: '30px' }}>{t('about.title')}</h2>
          
          <p style={{ marginBottom: '40px', fontSize: '1.15rem' }}>
            {t('about.desc')}
          </p>

          <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
            {[
              { icon: '✨', text: t('about_features.premium') },
              { icon: '🔬', text: t('about_features.equipment') },
              { icon: '🛡️', text: t('about_features.sterile') }
            ].map((feature, i) => (
              <div key={i} style={{ display: 'flex', alignItems: 'center', gap: '15px' }}>
                <div style={{ 
                  width: '40px', height: '40px', 
                  backgroundColor: 'var(--ivory)', 
                  borderRadius: '50%', 
                  display: 'flex', alignItems: 'center', justifyContent: 'center',
                  fontSize: '1.2rem',
                  boxShadow: 'var(--shadow-sm)'
                }}>
                  {feature.icon}
                </div>
                <span style={{ fontFamily: 'Montserrat', fontWeight: 500, color: 'var(--navy)' }}>
                  {feature.text}
                </span>
              </div>
            ))}
          </div>

        </motion.div>

      </div>

      <style>
        {`
          @media (max-width: 992px) {
            .about-grid {
              grid-template-columns: 1fr !important;
              gap: 50px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default About;
