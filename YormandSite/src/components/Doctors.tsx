import { motion } from 'framer-motion';
import { useTranslation } from 'react-i18next';
import docPlaceholder1 from '../assets/images/doc1.jpg';
import docPlaceholder2 from '../assets/images/doc2.jpg';
import docPlaceholder3 from '../assets/images/doc3.jpg';

const Doctors = () => {
  const { t } = useTranslation();

  const doctors = [
    {
      id: 1,
      name: t('doctors_section.d1.name'),
      specialty: t('doctors_section.d1.specialty'),
      experience: t('doctors_section.d1.experience'),
      photo: docPlaceholder1,
      objectPosition: 'center',
    },
    {
      id: 2,
      name: t('doctors_section.d2.name'),
      specialty: t('doctors_section.d2.specialty'),
      experience: t('doctors_section.d2.experience'),
      photo: docPlaceholder2,
      objectPosition: 'center',
    },
    {
      id: 3,
      name: t('doctors_section.d3.name'),
      specialty: t('doctors_section.d3.specialty'),
      experience: t('doctors_section.d3.experience'),
      photo: docPlaceholder3,
      objectPosition: 'center', 
      transform: 'scale(1.35) translate(-6%, -10%)',
    }
  ];

  return (
    <section id="doctors" className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container">
        
        <div className="section-title-wrapper" style={{ textAlign: 'center', marginBottom: '80px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>
            {t('doctors_section.team')}
          </div>
          <h2>{t('doctors_section.title')}</h2>
        </div>

        <div className="doctors-grid" style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(3, 1fr)',
          gap: '40px'
        }}>
          {doctors.map((doc, index) => (
            <motion.div
              key={doc.id}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.6, delay: index * 0.2 }}
              className="doctor-card"
              style={{
                backgroundColor: 'var(--white)',
                borderRadius: '24px',
                overflow: 'hidden',
                boxShadow: 'var(--shadow-sm)',
                transition: 'transform 0.4s ease, box-shadow 0.4s ease',
                display: 'flex',
                flexDirection: 'column',
                height: '100%'
              }}
            >
              <div style={{ aspectRatio: '3/4', overflow: 'hidden' }}>
                <img 
                  src={doc.photo} 
                  alt={doc.name} 
                  style={{ 
                    width: '100%', 
                    height: '100%', 
                    objectFit: 'cover', 
                    objectPosition: doc.objectPosition || 'center',
                    transform: doc.transform || 'none'
                  }}
                  onError={(e) => { e.currentTarget.style.display = 'none'; }} 
                />
              </div>
              <div style={{ padding: '30px', display: 'flex', flexDirection: 'column', flexGrow: 1 }}>
                <h3 style={{ fontSize: '1.5rem', marginBottom: '5px' }}>{doc.name}</h3>
                <div style={{ color: 'var(--teal)', fontWeight: 600, fontSize: '0.9rem', marginBottom: '15px' }}>
                  {doc.specialty}
                </div>
                <div style={{ color: 'var(--text-light)', fontSize: '0.9rem', display: 'flex', alignItems: 'center', gap: '8px', marginTop: 'auto' }}>
                  <span style={{ display: 'inline-block', width: '6px', height: '6px', borderRadius: '50%', backgroundColor: 'var(--teal)' }} />
                  {doc.experience}
                </div>
              </div>
            </motion.div>
          ))}
        </div>

      </div>

      <style>
        {`
          .doctor-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg) !important;
          }
          @media (max-width: 992px) {
            .doctors-grid {
              grid-template-columns: repeat(2, 1fr) !important;
            }
          }
          @media (max-width: 600px) {
            .doctors-grid {
              grid-template-columns: 1fr !important;
            }
            .section-title-wrapper {
              margin-bottom: 30px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default Doctors;
