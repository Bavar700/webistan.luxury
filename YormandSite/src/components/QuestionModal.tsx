import { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import { X, Send } from 'lucide-react';
import { useTranslation } from 'react-i18next';

interface QuestionModalProps {
  isOpen: boolean;
  onClose: () => void;
}

const QuestionModal = ({ isOpen, onClose }: QuestionModalProps) => {
  const { t } = useTranslation();
  const [status, setStatus] = useState<'idle' | 'submitting' | 'success'>('idle');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setStatus('submitting');
    // Simulate API call
    setTimeout(() => {
      setStatus('success');
      setTimeout(() => {
        onClose();
        setTimeout(() => setStatus('idle'), 300); // reset after exit animation
      }, 3000);
    }, 1000);
  };

  return (
    <AnimatePresence>
      {isOpen && (
        <>
          {/* Backdrop */}
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            onClick={onClose}
            style={{
              position: 'fixed',
              inset: 0,
              backgroundColor: 'rgba(11, 29, 50, 0.7)',
              backdropFilter: 'blur(8px)',
              zIndex: 1000,
            }}
          />
          
          {/* Modal Container */}
          <div style={{
            position: 'fixed',
            inset: 0,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            zIndex: 1001,
            pointerEvents: 'none',
            padding: '20px'
          }}>
            <motion.div
              initial={{ opacity: 0, scale: 0.9, y: 30 }}
              animate={{ opacity: 1, scale: 1, y: 0 }}
              exit={{ opacity: 0, scale: 0.9, y: 30 }}
              transition={{ type: 'spring', bounce: 0.4, duration: 0.6 }}
              style={{
                backgroundColor: 'var(--white)',
                borderRadius: '24px',
                padding: '50px 40px',
                width: '100%',
                maxWidth: '500px',
                pointerEvents: 'auto',
                position: 'relative',
                boxShadow: '0 25px 50px -12px rgba(0, 0, 0, 0.25)'
              }}
            >
              {/* Close Button */}
              <button
                onClick={onClose}
                style={{
                  position: 'absolute',
                  top: '20px',
                  right: '20px',
                  background: 'rgba(43, 165, 181, 0.1)',
                  border: 'none',
                  width: '45px',
                  height: '45px',
                  borderRadius: '50%',
                  display: 'flex',
                  alignItems: 'center',
                  justifyContent: 'center',
                  cursor: 'pointer',
                  color: 'var(--teal)',
                  transition: 'all 0.3s ease'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.background = 'var(--teal)';
                  e.currentTarget.style.color = 'var(--white)';
                  e.currentTarget.style.transform = 'rotate(90deg)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.background = 'rgba(43, 165, 181, 0.1)';
                  e.currentTarget.style.color = 'var(--teal)';
                  e.currentTarget.style.transform = 'rotate(0deg)';
                }}
              >
                <X size={22} />
              </button>

              {status === 'success' ? (
                <motion.div 
                  initial={{ opacity: 0, scale: 0.8 }}
                  animate={{ opacity: 1, scale: 1 }}
                  style={{ textAlign: 'center', padding: '20px 0' }}
                >
                  <div style={{
                    width: '90px', height: '90px', borderRadius: '50%',
                    backgroundColor: 'rgba(43, 165, 181, 0.1)',
                    color: 'var(--teal)',
                    display: 'flex', alignItems: 'center', justifyContent: 'center',
                    margin: '0 auto 25px'
                  }}>
                    <Send size={45} style={{ marginLeft: '-5px' }} />
                  </div>
                  <h3 style={{ fontSize: '2rem', marginBottom: '15px' }}>{t('question_modal.successTitle')}</h3>
                  <p style={{ color: 'var(--text-body)', fontSize: '1.1rem' }}>
                    {t('question_modal.successDesc')}
                  </p>
                </motion.div>
              ) : (
                <motion.div
                  initial={{ opacity: 0 }}
                  animate={{ opacity: 1 }}
                  exit={{ opacity: 0 }}
                >
                  <div style={{ marginBottom: '35px', paddingRight: '20px' }}>
                    <div className="section-subtitle" style={{ marginBottom: '10px', color: 'var(--teal)' }}>
                      {t('question_modal.subtitle')}
                    </div>
                    <h3 style={{ fontSize: '2.2rem', lineHeight: '1.2' }}>{t('question_modal.title')}</h3>
                  </div>

                  <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                    <div>
                      <input 
                        type="text" 
                        placeholder={t('question_modal.name')}
                        required 
                        style={{ 
                          margin: 0, 
                          backgroundColor: 'var(--ivory)',
                          border: '1px solid var(--border)',
                          padding: '18px 25px'
                        }}
                      />
                    </div>
                    <div>
                      <input 
                        type="tel" 
                        placeholder={t('question_modal.phone')}
                        required 
                        style={{ 
                          margin: 0, 
                          backgroundColor: 'var(--ivory)',
                          border: '1px solid var(--border)',
                          padding: '18px 25px'
                        }}
                      />
                    </div>
                    <div>
                      <textarea 
                        placeholder={t('question_modal.question')}
                        rows={4} 
                        required
                        style={{ 
                          margin: 0, 
                          resize: 'none',
                          backgroundColor: 'var(--ivory)',
                          border: '1px solid var(--border)',
                          padding: '18px 25px'
                        }}
                      />
                    </div>
                    <button 
                      type="submit" 
                      className="btn btn-primary"
                      disabled={status === 'submitting'}
                      style={{ 
                        marginTop: '10px', 
                        width: '100%', 
                        padding: '18px',
                        backgroundColor: 'var(--teal)',
                        borderColor: 'var(--teal)',
                        fontSize: '1.1rem',
                        opacity: status === 'submitting' ? 0.7 : 1,
                        cursor: status === 'submitting' ? 'not-allowed' : 'pointer'
                      }}
                    >
                      {status === 'submitting' ? t('question_modal.submitting') : t('question_modal.submit')}
                    </button>
                  </form>
                </motion.div>
              )}
            </motion.div>
          </div>
        </>
      )}
    </AnimatePresence>
  );
};

export default QuestionModal;
