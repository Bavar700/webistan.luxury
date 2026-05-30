import { motion } from 'framer-motion';
import { Moon, Gift, AlertCircle, Clock, Star } from 'lucide-react';
import { useTranslation } from 'react-i18next';

const PromoCard = () => {
  const { t } = useTranslation();
  return (
    <section className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container">
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.8 }}
          style={{
            backgroundColor: 'var(--navy)',
            borderRadius: '24px',
            padding: '60px',
            color: 'var(--white)',
            position: 'relative',
            overflow: 'hidden',
            boxShadow: 'var(--shadow-xl)',
            display: 'flex',
            flexDirection: 'column'
          }}
        >
          {/* Subtle background decoration */}
          <div style={{
            position: 'absolute',
            top: '-20%',
            right: '-5%',
            width: '400px',
            height: '400px',
            background: 'radial-gradient(circle, rgba(43, 165, 181, 0.15) 0%, rgba(11, 29, 50, 0) 70%)',
            borderRadius: '50%',
            pointerEvents: 'none'
          }} />

          <div style={{ textAlign: 'center', marginBottom: '40px' }}>
            <motion.div 
              className="section-subtitle" 
              style={{ color: 'var(--teal)', justifyContent: 'center', margin: '0 auto 20px auto', display: 'inline-flex' }}
              animate={{ opacity: [1, 0.4, 1] }}
              transition={{ repeat: Infinity, duration: 1.5, ease: "easeInOut" }}
            >
              <Moon size={20} style={{ marginRight: '8px' }} />
              {t('promo_details.badge')}
            </motion.div>
            
            <p style={{ fontSize: '1.2rem', lineHeight: 1.8, marginBottom: '20px', color: 'var(--white)' }}>
              {t('promo_details.p1')}
            </p>
            
            <p style={{ fontSize: '0.95rem', lineHeight: 1.7, marginBottom: '40px', color: 'var(--white)' }}>
              {t('promo_details.p2')}
            </p>
          </div>
          
          <div style={{
            display: 'grid',
            gridTemplateColumns: 'repeat(2, 1fr)',
            gap: '20px',
            marginBottom: '30px'
          }}>
            {/* Promo 1 */}
            <div style={{ backgroundColor: 'rgba(255, 255, 255, 0.05)', padding: '25px', borderRadius: '16px', border: '1px solid rgba(43, 165, 181, 0.3)' }}>
              <div style={{ color: 'var(--teal)', fontSize: '1.5rem', fontWeight: 'bold', marginBottom: '10px' }}>{t('promo_details.w1')}</div>
              <h4 style={{ marginBottom: '10px', fontSize: '1.2rem', color: 'var(--white)' }}>{t('promo_details.w1_title')}</h4>
              <p style={{ opacity: 0.8, fontSize: '0.95rem', color: 'var(--white)' }}>{t('promo_details.w1_date')}</p>
            </div>
            
            {/* Promo 2 */}
            <div style={{ backgroundColor: 'rgba(255, 255, 255, 0.05)', padding: '25px', borderRadius: '16px', border: '1px solid rgba(43, 165, 181, 0.3)' }}>
              <div style={{ color: 'var(--teal)', fontSize: '1.5rem', fontWeight: 'bold', marginBottom: '10px' }}>{t('promo_details.w2')}</div>
              <h4 style={{ marginBottom: '10px', fontSize: '1.2rem', color: 'var(--white)' }}>{t('promo_details.w2_title')}</h4>
              <p style={{ opacity: 0.8, fontSize: '0.95rem', color: 'var(--white)' }}>{t('promo_details.w2_date')}</p>
            </div>

            {/* Promo 3 */}
            <div style={{ backgroundColor: 'rgba(255, 255, 255, 0.05)', padding: '25px', borderRadius: '16px', border: '1px solid rgba(43, 165, 181, 0.3)' }}>
              <div style={{ color: 'var(--teal)', fontSize: '1.5rem', fontWeight: 'bold', marginBottom: '10px' }}>{t('promo_details.w3')}</div>
              <h4 style={{ marginBottom: '10px', fontSize: '1.2rem', color: 'var(--white)' }}>{t('promo_details.w3_title')}</h4>
              <p style={{ opacity: 0.8, fontSize: '0.95rem', color: 'var(--white)' }}>{t('promo_details.w3_date')}</p>
            </div>

            {/* Promo 4 */}
            <div style={{ backgroundColor: 'rgba(255, 255, 255, 0.05)', padding: '25px', borderRadius: '16px', border: '1px solid rgba(43, 165, 181, 0.3)' }}>
              <div style={{ color: 'var(--teal)', fontSize: '1.5rem', fontWeight: 'bold', marginBottom: '10px' }}>{t('promo_details.w4')}</div>
              <h4 style={{ marginBottom: '10px', fontSize: '1.2rem', color: 'var(--white)' }}>{t('promo_details.w4_title')}</h4>
              <p style={{ opacity: 0.8, fontSize: '0.95rem', color: 'var(--white)' }}>{t('promo_details.w4_date')}</p>
            </div>
          </div>

          <div style={{ 
            backgroundColor: 'rgba(43, 165, 181, 0.1)', 
            padding: '20px 30px', 
            borderRadius: '12px',
            marginBottom: '30px',
            borderLeft: '4px solid var(--teal)',
            display: 'flex',
            alignItems: 'flex-start',
            gap: '15px'
          }}>
            <Gift color="var(--teal)" size={28} style={{ flexShrink: 0, marginTop: '2px' }} />
            <p style={{ fontSize: '1.1rem', margin: 0, lineHeight: '1.5', color: 'var(--white)' }}>
              {t('promo_details.rule1')}
            </p>
          </div>

          <div style={{ marginBottom: '40px' }}>
            <ul style={{ 
              listStyle: 'none', 
              padding: 0, 
              display: 'flex', 
              flexDirection: 'column', 
              gap: '15px',
              fontSize: '1.1rem',
              color: 'var(--white)'
            }}>
              <li style={{ display: 'flex', gap: '15px', alignItems: 'flex-start' }}>
                <AlertCircle color="var(--teal)" size={24} style={{ flexShrink: 0 }} />
                <span>{t('promo_details.rule2')}</span>
              </li>
              <li style={{ display: 'flex', gap: '15px', alignItems: 'flex-start' }}>
                <Star color="var(--teal)" size={24} style={{ flexShrink: 0 }} />
                <span>{t('promo_details.rule3')}</span>
              </li>
              <li style={{ display: 'flex', gap: '15px', alignItems: 'flex-start' }}>
                <Clock color="var(--teal)" size={24} style={{ flexShrink: 0 }} />
                <span>{t('promo_details.rule4')}</span>
              </li>
            </ul>
          </div>

          <div style={{
            display: 'flex',
            justifyContent: 'center',
            borderTop: '1px solid rgba(255, 255, 255, 0.1)',
            paddingTop: '30px',
            marginTop: 'auto'
          }}>
            <a href="#contact" className="btn btn-teal" style={{ padding: '15px 40px', fontSize: '1.1rem' }}>
              Записаться по акции
            </a>
          </div>
        </motion.div>
      </div>

      <style>
        {`
          @media (max-width: 768px) {
            .container > div {
              padding: 30px 15px !important;
            }
            .container h2 {
              font-size: 1.6rem !important;
            }
            .container > div > div:nth-child(3) {
              grid-template-columns: 1fr !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default PromoCard;
