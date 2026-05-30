import React from 'react';

interface HeroProps {
  lang: any;
}

const Hero: React.FC<HeroProps> = ({ lang }) => {
  return (
    <section id="home" style={{
      minHeight: '100vh',
      display: 'flex',
      flexDirection: 'column',
      justifyContent: 'center',
      alignItems: 'center',
      padding: '0 10%',
      textAlign: 'center',
      background: 'radial-gradient(circle at 50% 50%, rgba(184, 134, 11, 0.05) 0%, transparent 50%)'
    }}>
      <div className="animate-fade-in">
        <h1 className="premium-gradient-text" style={{
          fontSize: 'clamp(3rem, 8vw, 5rem)',
          marginBottom: '1.5rem',
          lineHeight: 1.1
        }}>
          {lang.hero.title}
        </h1>
        <p style={{
          fontSize: '1.2rem',
          color: 'var(--text-secondary)',
          maxWidth: '600px',
          margin: '0 auto 2.5rem',
          fontWeight: 400
        }}>
          {lang.hero.subtitle}
        </p>
        <button className="btn-premium">
          {lang.hero.cta}
        </button>
      </div>

      {/* Decorative background element */}
      <div style={{
        position: 'absolute',
        bottom: '10%',
        width: '100%',
        height: '1px',
        background: 'linear-gradient(90deg, transparent, var(--border-gold), transparent)',
        opacity: 0.3
      }}></div>
    </section>
  );
};

export default Hero;
