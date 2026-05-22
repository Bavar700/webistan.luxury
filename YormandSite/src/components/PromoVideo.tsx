import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { Play } from 'lucide-react';
import photo3 from '../assets/images/photo3.jpg';

const PromoVideo = () => {
  const { t } = useTranslation();

  return (
    <section className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container promo-grid" style={{
        display: 'grid',
        gridTemplateColumns: '1fr 1fr',
        gap: '80px',
        alignItems: 'center'
      }}>
        
        {/* Left: Video Thumbnail */}
        <motion.div
          initial={{ opacity: 0, scale: 0.95 }}
          whileInView={{ opacity: 1, scale: 1 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          style={{ position: 'relative' }}
        >
          <div style={{
            borderRadius: '24px',
            overflow: 'hidden',
            boxShadow: 'var(--shadow-lg)',
            position: 'relative',
            aspectRatio: '1/1'
          }}>
            <img src={photo3} alt="Promo" style={{ width: '100%', height: '100%', objectFit: 'cover' }} onError={(e) => { e.currentTarget.style.display = 'none'; }} />
            
            {/* Dark Overlay */}
            <div style={{
              position: 'absolute', inset: 0,
              backgroundColor: 'rgba(11, 29, 50, 0.3)',
              display: 'flex', alignItems: 'center', justifyContent: 'center'
            }}>
              {/* Play Button */}
              <button style={{
                width: '80px', height: '80px',
                backgroundColor: 'rgba(255, 255, 255, 0.2)',
                backdropFilter: 'blur(10px)',
                borderRadius: '50%',
                border: '1px solid rgba(255, 255, 255, 0.5)',
                display: 'flex', alignItems: 'center', justifyContent: 'center',
                color: 'var(--white)',
                cursor: 'pointer',
                transition: 'all 0.3s ease'
              }}
              onMouseEnter={(e) => e.currentTarget.style.backgroundColor = 'var(--teal)'}
              onMouseLeave={(e) => e.currentTarget.style.backgroundColor = 'rgba(255, 255, 255, 0.2)'}
              >
                <Play size={32} fill="currentColor" style={{ marginLeft: '5px' }} />
              </button>
            </div>
          </div>
        </motion.div>

        {/* Right Content */}
        <motion.div
          initial={{ opacity: 0, x: 30 }}
          whileInView={{ opacity: 1, x: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8, delay: 0.2 }}
        >
          <div className="section-subtitle">Ramazon 2026</div>
          
          <h2 style={{ marginBottom: '30px' }}>{t('promo.title')}</h2>
          
          <p style={{ marginBottom: '40px', fontSize: '1.15rem' }}>
            {t('promo.subtitle')}
          </p>

          <a href="#contact" className="btn btn-gold">
            {t('promo.button')}
          </a>
        </motion.div>

      </div>

      <style>
        {`
          @media (max-width: 992px) {
            .promo-grid {
              grid-template-columns: 1fr !important;
              text-align: center;
              gap: 50px !important;
            }
            .promo-grid .section-subtitle {
              justify-content: center !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default PromoVideo;
