import { useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion, AnimatePresence } from 'framer-motion';
import { ChevronDown, MessageCircleQuestion } from 'lucide-react';
import QuestionModal from './QuestionModal';

const FAQ = () => {
  const { t } = useTranslation();
  const [openIndex, setOpenIndex] = useState<number | null>(0);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const questions = ['q1', 'q2', 'q3', 'q4'];

  return (
    <section className="section-padding" style={{ backgroundColor: 'var(--white)' }}>
      <div className="container" style={{ maxWidth: '900px' }}>
        
        <div className="section-title-wrapper" style={{ textAlign: 'center', marginBottom: '60px' }}>
          <div className="section-subtitle" style={{ justifyContent: 'center' }}>FAQ</div>
          <h2>{t('faq.title')}</h2>
        </div>

        <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
          {questions.map((q, index) => {
            const isOpen = openIndex === index;
            
            return (
              <div 
                key={q} 
                className="faq-item"
                style={{
                  border: '1px solid var(--border)',
                  borderRadius: '16px',
                  backgroundColor: isOpen ? 'var(--ivory)' : 'var(--white)',
                  transition: 'all 0.3s ease',
                  overflow: 'hidden'
                }}
              >
                <button
                  onClick={() => setOpenIndex(isOpen ? null : index)}
                  style={{
                    width: '100%',
                    display: 'flex',
                    justifyContent: 'space-between',
                    alignItems: 'center',
                    padding: '30px',
                    background: 'none',
                    border: 'none',
                    cursor: 'pointer',
                    textAlign: 'left'
                  }}
                >
                  <span style={{
                    fontFamily: 'Montserrat',
                    fontSize: '1.3rem',
                    fontWeight: 600,
                    color: isOpen ? 'var(--teal)' : 'var(--navy)',
                    transition: 'color 0.3s ease'
                  }}>
                    {t(`faq.${q}.q`)}
                  </span>
                  <motion.div
                    animate={{ rotate: isOpen ? 180 : 0 }}
                    transition={{ duration: 0.3 }}
                    style={{ color: isOpen ? 'var(--teal)' : 'var(--navy)' }}
                  >
                    <ChevronDown size={24} />
                  </motion.div>
                </button>

                <AnimatePresence>
                  {isOpen && (
                    <motion.div
                      initial={{ height: 0, opacity: 0 }}
                      animate={{ height: 'auto', opacity: 1 }}
                      exit={{ height: 0, opacity: 0 }}
                      transition={{ duration: 0.3 }}
                    >
                      <div style={{
                        padding: '0 30px 30px 30px',
                        color: 'var(--text-body)',
                        fontSize: '1.1rem',
                        lineHeight: 1.6
                      }}>
                        {t(`faq.${q}.a`)}
                      </div>
                    </motion.div>
                  )}
                </AnimatePresence>
              </div>
            );
          })}
        </div>

        <motion.div 
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          style={{ textAlign: 'center', marginTop: '60px', padding: '40px', backgroundColor: 'var(--ivory)', borderRadius: '24px' }}
        >
          <h3 style={{ marginBottom: '15px', fontSize: '1.8rem' }}>{t('faq_contact.title')}</h3>
          <p style={{ marginBottom: '30px', color: 'var(--text-body)', fontSize: '0.95rem' }}>{t('faq_contact.desc')}</p>
          <button 
            onClick={() => setIsModalOpen(true)}
            className="btn btn-primary"
            style={{ padding: '16px 45px', fontSize: '1.1rem', backgroundColor: 'var(--teal)', borderColor: 'var(--teal)' }}
          >
            <MessageCircleQuestion size={22} />
            {t('faq_contact.btn')}
          </button>
        </motion.div>

        <QuestionModal isOpen={isModalOpen} onClose={() => setIsModalOpen(false)} />

      </div>

      <style>
        {`
          .faq-item:hover {
            border-color: rgba(43, 165, 181, 0.3) !important;
          }
          @media (max-width: 600px) {
            .section-title-wrapper {
              margin-bottom: 30px !important;
            }
          }
        `}
      </style>
    </section>
  );
};

export default FAQ;
