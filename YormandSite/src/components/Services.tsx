import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';

const Services = () => {
  const { t } = useTranslation();
  const servicesList = ['s1', 's2', 's3', 's4', 's5', 's6', 's7', 's8', 's9'];
  const symbols = ['01', '02', '03', '04', '05', '06', '07', '08', '09'];

  return (
    <section id="services" className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container">
        
        <div style={{ textAlign: 'center', marginBottom: '80px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>
            {t('services.subtitle')}
          </div>
          <h2>{t('services.title')}</h2>
        </div>

        <div className="services-grid" style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(3, 1fr)',
          gap: '1px',
          backgroundColor: 'var(--border)',
          border: '1px solid var(--border)',
          borderRadius: '20px',
          overflow: 'hidden'
        }}>
          {servicesList.map((service, index) => (
            <motion.div
              key={service}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, margin: '-50px' }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="service-card"
              style={{
                backgroundColor: 'var(--white)',
                padding: '50px 40px',
                position: 'relative',
                transition: 'all 0.4s ease',
                display: 'flex',
                flexDirection: 'column',
                gap: '20px'
              }}
            >
              <div style={{
                fontFamily: 'Montserrat',
                fontSize: '2.5rem',
                color: 'var(--teal)',
                opacity: 0.4,
                lineHeight: 1
              }}>
                {symbols[index]}
              </div>
              
              <h3 style={{ fontSize: '1.4rem' }}>
                {t(`services.${service}.title`)}
              </h3>
              
              <p style={{ color: 'var(--text-body)', margin: 0 }}>
                {t(`services.${service}.desc`)}
              </p>

              <div className="service-hover-border" style={{
                position: 'absolute',
                top: 0, left: 0, right: 0,
                height: '4px',
                backgroundColor: 'var(--teal)',
                transform: 'scaleX(0)',
                transformOrigin: 'left',
                transition: 'transform 0.4s ease'
              }} />
            </motion.div>
          ))}
        </div>

      </div>

      <style>
        {`
          .service-card:hover {
            z-index: 10;
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
          }
          .service-card:hover .service-hover-border {
            transform: scaleX(1) !important;
          }
          @media (max-width: 1024px) {
            .services-grid {
              grid-template-columns: repeat(2, 1fr) !important;
            }
          }
          @media (max-width: 600px) {
            .services-grid {
              grid-template-columns: 1fr !important;
            }
            .service-card {
              padding: 40px 30px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default Services;
