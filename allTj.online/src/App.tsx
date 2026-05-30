import { useState } from 'react';
import Navbar from './components/layout/Navbar';
import Hero from './components/layout/HeroSection';
import Services from './components/layout/Services';

import tj from './i18n/tj.json';
import ru from './i18n/ru.json';
import en from './i18n/en.json';

const translations: Record<string, any> = { tj, ru, en };

function App() {
  const [langCode, setLangCode] = useState('tj');
  const t = translations[langCode];

  return (
    <div className="app-container">
      <Navbar lang={t} currentLang={langCode} setLang={setLangCode} />
      <main>
        <Hero lang={t} />
        <Services lang={t} />
        {/* Additional sections can be added here */}
      </main>
      
      <footer style={{
        padding: '2rem',
        textAlign: 'center',
        color: 'var(--text-muted)',
        fontSize: '0.9rem',
        borderTop: '1px solid var(--border-subtle)'
      }}>
        &copy; {new Date().getFullYear()} allTj.online. All rights reserved.
      </footer>
    </div>
  );
}

export default App;
