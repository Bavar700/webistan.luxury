import { motion } from 'framer-motion';
import { CalendarCheck } from 'lucide-react';
import { useTranslation } from 'react-i18next';

const DikidiBooking = () => {
  const { t } = useTranslation();

  return (
    <section id="booking" className="section-padding" style={{ backgroundColor: 'var(--white)' }}>
      <div className="container" style={{ maxWidth: '900px' }}>
        <div style={{ textAlign: 'center', marginBottom: '50px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>{t('dikidi.subtitle')}</div>
          <h2>{t('dikidi.title1')}<br/>{t('dikidi.title2')}</h2>
          <p style={{ fontSize: '1.2rem', color: 'var(--text-light)', marginTop: '15px' }}>
            {t('dikidi.time')}
          </p>
        </div>

        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="dikidi-modal"
          style={{
            backgroundColor: 'var(--ivory)',
            borderRadius: '24px',
            padding: '50px 30px',
            boxShadow: 'var(--shadow-md)',
            border: '1px solid var(--border)',
            minHeight: '400px', 
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            overflow: 'hidden',
            position: 'relative'
          }}
        >
          <div style={{ textAlign: 'center', width: '100%', maxWidth: '500px' }}>
            <div style={{ 
              display: 'flex', 
              justifyContent: 'center', 
              marginBottom: '25px',
              color: 'var(--teal)' 
            }}>
              <CalendarCheck size={60} strokeWidth={1.5} />
            </div>
            <h3 style={{ marginBottom: '20px', fontSize: '1.8rem' }}>{t('dikidi.fastTitle')}</h3>
            <p style={{ color: 'var(--text-body)', lineHeight: 1.8, textWrap: 'balance' }}>
              {t('dikidi.fastDesc')}
            </p>
            <a 
              href="https://dikidi.ru/" // Временно стоит общая ссылка, потом заменим на ссылку вашей клиники
              target="_blank" 
              rel="noopener noreferrer"
              className="btn btn-primary"
              style={{ 
                margin: '30px 0 10px 0',
                padding: '18px 40px', 
                backgroundColor: 'var(--teal)', 
                borderColor: 'var(--teal)',
                display: 'inline-block',
                fontSize: '1.1rem',
                fontWeight: 600,
                borderRadius: '50px',
                width: 'fit-content'
              }}
            >
              {t('dikidi.btn')}
            </a>
          </div>
        </motion.div>
      </div>
      
      <style>
        {`
          @media (max-width: 600px) {
            .dikidi-modal {
              padding: 30px 20px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default DikidiBooking;
