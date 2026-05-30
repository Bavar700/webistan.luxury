import React from 'react';

interface ServicesProps {
  lang: any;
}

const Services: React.FC<ServicesProps> = ({ lang }) => {
  const serviceItems = [
    {
      title: lang.services.webDev.title,
      desc: lang.services.webDev.desc,
      icon: '🌐'
    },
    {
      title: lang.services.consulting.title,
      desc: lang.services.consulting.desc,
      icon: '📈'
    },
    {
      title: lang.services.cloud.title,
      desc: lang.services.cloud.desc,
      icon: '☁️'
    }
  ];

  return (
    <section id="services" style={{ padding: '8rem 10%' }}>
      <h2 style={{
        fontSize: '2.5rem',
        textAlign: 'center',
        marginBottom: '4rem',
        color: 'var(--text-primary)'
      }}>
        {lang.nav.services}
      </h2>
      <div style={{
        display: 'grid',
        gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))',
        gap: '2rem'
      }}>
        {serviceItems.map((item, index) => (
          <div key={index} className="glass-panel" style={{
            padding: '2.5rem',
            borderRadius: '16px',
            transition: 'var(--transition-smooth)',
            cursor: 'pointer',
            border: '1px solid var(--border-subtle)',
            position: 'relative',
            overflow: 'hidden'
          }}>
            <div style={{ fontSize: '2.5rem', marginBottom: '1.5rem' }}>{item.icon}</div>
            <h3 style={{ fontSize: '1.5rem', marginBottom: '1rem', color: 'var(--primary)' }}>{item.title}</h3>
            <p style={{ color: 'var(--text-secondary)' }}>{item.desc}</p>
            
            {/* Hover glow effect */}
            <div className="hover-glow" style={{
              position: 'absolute',
              top: 0,
              left: 0,
              width: '100%',
              height: '100%',
              background: 'radial-gradient(circle at center, var(--primary-glow) 0%, transparent 70%)',
              opacity: 0,
              transition: 'opacity 0.3s ease'
            }}></div>
          </div>
        ))}
      </div>
    </section>
  );
};

export default Services;
