import { useTranslation } from 'react-i18next';
import { motion } from 'framer-motion';

// You will replace these with real photos later
import docPlaceholder1 from '../assets/images/photo1.jpg';
import docPlaceholder2 from '../assets/images/photo3.jpg';
import docPlaceholder3 from '../assets/images/photo4.jpg';

const Doctors = () => {
  const { t } = useTranslation();

  const doctors = [
    {
      id: 1,
      name: 'Dr. Ёрманд',
      specialty: 'Главный врач, Хирург-имплантолог',
      experience: '15 лет опыта',
      photo: docPlaceholder1,
    },
    {
      id: 2,
      name: 'Dr. Азизов',
      specialty: 'Врач-ортодонт',
      experience: '10 лет опыта',
      photo: docPlaceholder2,
    },
    {
      id: 3,
      name: 'Dr. Саидова',
      specialty: 'Терапевт, Эндодонтист',
      experience: '8 лет опыта',
      photo: docPlaceholder3,
    },
  ];

  return (
    <section id="doctors" className="section-padding" style={{ backgroundColor: 'var(--ivory)' }}>
      <div className="container">
        
        <div style={{ textAlign: 'center', marginBottom: '80px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>
            Команда
          </div>
          <h2>Наши Доктора</h2>
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
              }}
            >
              <div style={{ aspectRatio: '3/4', overflow: 'hidden' }}>
                <img 
                  src={doc.photo} 
                  alt={doc.name} 
                  style={{ width: '100%', height: '100%', objectFit: 'cover' }}
                  onError={(e) => { e.currentTarget.style.display = 'none'; }} 
                />
              </div>
              <div style={{ padding: '30px' }}>
                <h3 style={{ fontSize: '1.5rem', marginBottom: '5px' }}>{doc.name}</h3>
                <div style={{ color: 'var(--teal)', fontWeight: 600, fontSize: '0.9rem', marginBottom: '15px' }}>
                  {doc.specialty}
                </div>
                <div style={{ color: 'var(--text-light)', fontSize: '0.9rem', display: 'flex', alignItems: 'center', gap: '8px' }}>
                  <span style={{ display: 'inline-block', width: '6px', height: '6px', borderRadius: '50%', backgroundColor: 'var(--gold)' }} />
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
          }
        `}
      </style>
    </section>
  );
};

export default Doctors;
