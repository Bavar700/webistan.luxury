import React from 'react';

interface NavbarProps {
  lang: any;
  currentLang: string;
  setLang: (lang: string) => void;
}

const Navbar: React.FC<NavbarProps> = ({ lang, currentLang, setLang }) => {
  return (
    <nav className="glass-panel" style={{
      position: 'fixed',
      top: 0,
      left: 0,
      right: 0,
      height: '80px',
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      padding: '0 5%',
      zIndex: 1000,
      borderBottom: '1px solid var(--border-subtle)'
    }}>
      <div className="logo" style={{ fontSize: '1.5rem', fontWeight: 800, color: 'var(--primary)' }}>
        allTj<span style={{ color: '#fff' }}>.online</span>
      </div>

      <div className="nav-links" style={{ display: 'flex', gap: '2rem' }}>
        <a href="#home">{lang.nav.home}</a>
        <a href="#services">{lang.nav.services}</a>
        <a href="#about">{lang.nav.about}</a>
      </div>

      <div className="lang-switcher" style={{ display: 'flex', gap: '0.5rem' }}>
        {['tj', 'ru', 'en'].map((l) => (
          <button
            key={l}
            onClick={() => setLang(l)}
            style={{
              padding: '0.3rem 0.6rem',
              borderRadius: '4px',
              border: currentLang === l ? '1px solid var(--primary)' : '1px solid transparent',
              background: currentLang === l ? 'rgba(184, 134, 11, 0.1)' : 'transparent',
              color: currentLang === l ? 'var(--primary)' : '#fff',
              cursor: 'pointer',
              fontSize: '0.8rem',
              textTransform: 'uppercase',
              fontWeight: 600
            }}
          >
            {l}
          </button>
        ))}
      </div>
    </nav>
  );
};

export default Navbar;
