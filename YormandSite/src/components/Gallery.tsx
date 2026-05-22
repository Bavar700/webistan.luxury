import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';

import img1 from '../assets/images/clinic.jpg';
import img2 from '../assets/images/photo1.jpg';
import img3 from '../assets/images/chair.jpg';
import img4 from '../assets/images/bg.jpg';

const Gallery = () => {
  const { t } = useTranslation();

  return (
    <section className="section-padding" style={{ backgroundColor: 'var(--white)' }}>
      <div className="container">
        
        <div style={{ textAlign: 'center', marginBottom: '80px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>
            {t('gallery.title')}
          </div>
          <h2>{t('gallery.title')}</h2>
        </div>

        <div className="gallery-grid" style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(4, 1fr)',
          gridAutoRows: '300px',
          gap: '20px'
        }}>
          
          <motion.div className="gallery-item item-wide" initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ duration: 0.5 }}>
            <img src={img1} alt="Gallery 1" onError={(e) => { e.currentTarget.style.display = 'none'; }} />
          </motion.div>

          <motion.div className="gallery-item item-tall" initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ duration: 0.5, delay: 0.1 }}>
            <img src={img2} alt="Gallery 2" onError={(e) => { e.currentTarget.style.display = 'none'; }} />
          </motion.div>

          <motion.div className="gallery-item item-normal" initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ duration: 0.5, delay: 0.2 }}>
            <img src={img3} alt="Gallery 3" onError={(e) => { e.currentTarget.style.display = 'none'; }} />
          </motion.div>

          <motion.div className="gallery-item item-wide" initial={{ opacity: 0, y: 20 }} whileInView={{ opacity: 1, y: 0 }} viewport={{ once: true }} transition={{ duration: 0.5, delay: 0.3 }}>
            <img src={img4} alt="Gallery 4" onError={(e) => { e.currentTarget.style.display = 'none'; }} />
          </motion.div>

        </div>
      </div>

      <style>
        {`
          .gallery-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
          }
          .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
          }
          .gallery-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(11, 29, 50, 0.4), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
          }
          .gallery-item:hover img {
            transform: scale(1.05);
          }
          .gallery-item:hover::after {
            opacity: 1;
          }

          .item-wide {
            grid-column: span 2;
          }
          .item-tall {
            grid-row: span 2;
          }
          .item-normal {
            grid-column: span 1;
          }

          @media (max-width: 992px) {
            .gallery-grid {
              grid-template-columns: repeat(2, 1fr) !important;
              grid-auto-rows: 250px !important;
            }
            .item-wide { grid-column: span 2; }
            .item-tall { grid-row: span 1; }
            .item-normal { grid-column: span 1; }
          }
          @media (max-width: 600px) {
            .gallery-grid {
              grid-template-columns: 1fr !important;
              grid-auto-rows: 250px !important;
            }
            .item-wide, .item-normal { grid-column: span 1; }
          }
        `}
      </style>
    </section>
  );
};

export default Gallery;
