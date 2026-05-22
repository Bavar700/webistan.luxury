import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import clinicImg from '../assets/images/clinic.jpg';

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
            <img src={clinicImg} alt="Dental Clinic Yormand" style={{ width: '100%', height: 'auto', display: 'block' }} onError={(e) => { e.currentTarget.style.display = 'none'; }} />
          </div>
          {/* Gold Accent Line */}
          <div style={{
            position: 'absolute',
            top: '40px',
            bottom: '40px',
            left: '-2px',
            width: '4px',
            backgroundColor: 'var(--gold)',
            borderRadius: '4px'
          }} />
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
              { icon: '✨', text: 'Премиум интерьер и комфорт' },
              { icon: '🔬', text: 'Новейшее европейское оборудование' },
              { icon: '🛡️', text: 'Абсолютная стерильность' }
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
                <span style={{ fontFamily: 'Onest', fontWeight: 500, color: 'var(--navy)' }}>
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
