import { useState } from 'react';
import { useTranslation } from 'react-i18next';
import { motion, AnimatePresence } from 'framer-motion';
import { ChevronDown } from 'lucide-react';

const FAQ = () => {
  const { t } = useTranslation();
  const [openIndex, setOpenIndex] = useState<number | null>(0);
  const questions = ['q1', 'q2', 'q3', 'q4'];

  return (
    <section className="section-padding" style={{ backgroundColor: 'var(--white)' }}>
      <div className="container" style={{ maxWidth: '900px' }}>
        
        <div style={{ textAlign: 'center', marginBottom: '60px' }}>
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
                    fontFamily: 'Onest',
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

      </div>

      <style>
        {`
          .faq-item:hover {
            border-color: rgba(43, 165, 181, 0.3) !important;
          }
        `}
      </style>
    </section>
  );
};

export default FAQ;
