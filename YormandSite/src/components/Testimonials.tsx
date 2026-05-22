import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';

const Testimonials = () => {
  const { t } = useTranslation();
  const reviews = ['t1', 't2'];

  return (
    <section id="reviews" className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container">
        
        <div style={{ textAlign: 'center', marginBottom: '80px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>
            {t('testimonials.title')}
          </div>
          <h2>{t('testimonials.title')}</h2>
        </div>

        <div className="testimonials-grid" style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(2, 1fr)',
          gap: '40px'
        }}>
          {reviews.map((review, i) => (
            <motion.div
              key={review}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6, delay: i * 0.2 }}
              className="testimonial-card"
              style={{
                backgroundColor: 'var(--white)',
                padding: '60px 50px',
                borderRadius: '24px',
                border: '1px solid var(--border)',
                position: 'relative',
                transition: 'all 0.4s ease'
              }}
            >
              {/* Giant decorative quote */}
              <div style={{
                position: 'absolute',
                top: '20px',
                left: '40px',
                fontFamily: 'Onest',
                fontSize: '8rem',
                color: 'var(--teal)',
                opacity: 0.1,
                lineHeight: 1,
                userSelect: 'none'
              }}>
                "
              </div>

              {/* Stars */}
              <div style={{ display: 'flex', gap: '5px', marginBottom: '30px', position: 'relative', zIndex: 1 }}>
                {[...Array(5)].map((_, j) => (
                  <span key={j} style={{ color: 'var(--gold)', fontSize: '1.2rem' }}>★</span>
                ))}
              </div>

              {/* Quote Text */}
              <p style={{
                fontFamily: 'Onest',
                fontStyle: 'italic',
                fontSize: '1.4rem',
                color: 'var(--navy)',
                lineHeight: 1.8,
                marginBottom: '40px',
                position: 'relative',
                zIndex: 1
              }}>
                "{t(`testimonials.${review}.text`)}"
              </p>

              {/* Author */}
              <div style={{
                borderTop: '1px solid var(--border)',
                paddingTop: '25px',
                position: 'relative',
                zIndex: 1
              }}>
                <span style={{
                  fontFamily: 'Onest',
                  fontWeight: 600,
                  fontSize: '0.9rem',
                  textTransform: 'uppercase',
                  letterSpacing: '0.1em',
                  color: 'var(--navy)'
                }}>
                  {t(`testimonials.${review}.name`)}
                </span>
              </div>

            </motion.div>
          ))}
        </div>

      </div>

      <style>
        {`
          .testimonial-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-10px);
            border-color: rgba(43, 165, 181, 0.2) !important;
          }
          @media (max-width: 992px) {
            .testimonials-grid {
              grid-template-columns: 1fr !important;
            }
          }
          @media (max-width: 600px) {
            .testimonial-card {
              padding: 40px 30px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default Testimonials;
