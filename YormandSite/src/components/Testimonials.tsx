import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

const Testimonials = () => {
  const { t } = useTranslation();
  const reviews = ['t1', 't2', 't3', 't4'];

  return (
    <section id="reviews" className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container">
        
        <div className="section-title-wrapper" style={{ textAlign: 'center', marginBottom: '60px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>
            {t('testimonials.badge')}
          </div>
          <h2>{t('testimonials.title')}</h2>
        </div>

        <motion.div
          initial={{ opacity: 0, y: 30 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
        >
          <Swiper
            modules={[Pagination, Autoplay]}
            spaceBetween={30}
            slidesPerView={1}
            breakpoints={{
              768: { slidesPerView: 2 }
            }}
            pagination={{ clickable: true, dynamicBullets: true }}
            autoplay={{ delay: 5000, disableOnInteraction: false }}
            style={{ paddingBottom: '60px' }}
          >
            {reviews.map((review) => (
              <SwiperSlide key={review} style={{ height: 'auto' }}>
                <div
                  className="testimonial-card"
                  style={{
                    backgroundColor: 'var(--white)',
                    padding: '50px 40px',
                    borderRadius: '24px',
                    border: '1px solid var(--border)',
                    position: 'relative',
                    transition: 'all 0.4s ease',
                    height: '100%',
                    display: 'flex',
                    flexDirection: 'column'
                  }}
                >
                  {/* Giant decorative quote */}
                  <div className="quote-mark" style={{
                    position: 'absolute',
                    top: '20px',
                    left: '40px',
                    fontFamily: 'Montserrat',
                    fontSize: '8rem',
                    color: 'var(--teal)',
                    opacity: 0.1,
                    lineHeight: 1,
                    userSelect: 'none'
                  }}>
                    "
                  </div>

                  {/* Stars */}
                  <div style={{ display: 'flex', gap: '5px', marginBottom: '25px', position: 'relative', zIndex: 1, justifyContent: 'flex-end' }}>
                    {[...Array(5)].map((_, j) => (
                      <span key={j} style={{ color: 'var(--teal)', fontSize: '1.2rem' }}>★</span>
                    ))}
                  </div>

                  {/* Quote Text */}
                  <p style={{
                    fontFamily: 'Montserrat',
                    fontStyle: 'italic',
                    fontSize: '1.2rem',
                    color: 'var(--navy)',
                    lineHeight: 1.8,
                    marginBottom: '30px',
                    position: 'relative',
                    zIndex: 1,
                    flexGrow: 1
                  }}>
                    "{t(`testimonials.${review}.text`)}"
                  </p>

                  {/* Author */}
                  <div style={{
                    borderTop: '1px solid var(--border)',
                    paddingTop: '20px',
                    position: 'relative',
                    zIndex: 1
                  }}>
                    <span style={{
                      fontFamily: 'Montserrat',
                      fontWeight: 600,
                      fontSize: '0.9rem',
                      textTransform: 'uppercase',
                      letterSpacing: '0.1em',
                      color: 'var(--navy)'
                    }}>
                      {t(`testimonials.${review}.name`)}
                    </span>
                  </div>

                </div>
              </SwiperSlide>
            ))}
          </Swiper>
        </motion.div>

      </div>

      <style>
        {`
          .swiper-pagination-bullet-active {
            background: var(--teal) !important;
          }
          .swiper-pagination-bullet {
            background: rgba(43, 165, 181, 0.5);
            width: 10px;
            height: 10px;
          }
          .testimonial-card:hover {
            box-shadow: var(--shadow-lg);
            border-color: rgba(43, 165, 181, 0.2) !important;
          }
          @media (max-width: 600px) {
            .section-title-wrapper {
              margin-bottom: 30px !important;
            }
            .testimonial-card {
              padding: 30px 20px !important;
            }
            .quote-mark {
              font-size: 5rem !important;
              left: 20px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default Testimonials;
