import { motion, AnimatePresence } from 'framer-motion';
import { useTranslation } from 'react-i18next';
import { X } from 'lucide-react';

interface BookingModalProps {
  isOpen: boolean;
  onClose: () => void;
}

const BookingModal = ({ isOpen, onClose }: BookingModalProps) => {
  const { t } = useTranslation();

  if (!isOpen) return null;

  return (
    <AnimatePresence>
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        style={{
          position: 'fixed',
          inset: 0,
          backgroundColor: 'rgba(11, 29, 50, 0.6)',
          backdropFilter: 'blur(5px)',
          zIndex: 9999,
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          padding: '20px'
        }}
        onClick={onClose}
      >
        <motion.div
          initial={{ scale: 0.95, opacity: 0, y: 20 }}
          animate={{ scale: 1, opacity: 1, y: 0 }}
          exit={{ scale: 0.95, opacity: 0, y: 20 }}
          transition={{ duration: 0.3 }}
          onClick={(e) => e.stopPropagation()}
          style={{
            backgroundColor: 'var(--white)',
            borderRadius: '24px',
            padding: '40px',
            width: '100%',
            maxWidth: '500px',
            position: 'relative',
            boxShadow: 'var(--shadow-lg)'
          }}
        >
          <button
            onClick={onClose}
            style={{
              position: 'absolute',
              top: '20px',
              right: '20px',
              background: 'none',
              border: 'none',
              cursor: 'pointer',
              color: 'var(--text-light)',
              padding: '5px'
            }}
          >
            <X size={24} />
          </button>

          <h3 style={{ marginBottom: '10px', fontSize: '1.8rem' }}>{t('hero.cta')}</h3>
          <p style={{ color: 'var(--text-light)', marginBottom: '30px' }}>Оставьте свои данные, и наш администратор свяжется с вами для подтверждения времени.</p>

          <form onSubmit={(e) => { e.preventDefault(); alert('Отправлено! В реальности здесь был бы API запрос.'); onClose(); }}>
            <div style={{ marginBottom: '20px' }}>
              <input type="text" placeholder="Ваше имя" required />
            </div>
            <div style={{ marginBottom: '20px' }}>
              <input type="tel" placeholder="Номер телефона" required />
            </div>
            <div style={{ marginBottom: '30px' }}>
              <select required>
                <option value="">Выберите услугу</option>
                <option value="s1">{t('services.s1.title')}</option>
                <option value="s2">{t('services.s2.title')}</option>
                <option value="s3">{t('services.s3.title')}</option>
                <option value="s4">{t('services.s4.title')}</option>
                <option value="s5">{t('services.s5.title')}</option>
                <option value="s6">{t('services.s6.title')}</option>
                <option value="s7">{t('services.s7.title')}</option>
                <option value="s8">{t('services.s8.title')}</option>
                <option value="s9">{t('services.s9.title')}</option>
              </select>
            </div>
            
            <button type="submit" className="btn btn-primary" style={{ width: '100%' }}>
              Записаться
            </button>
          </form>

        </motion.div>
      </motion.div>
    </AnimatePresence>
  );
};

export default BookingModal;
