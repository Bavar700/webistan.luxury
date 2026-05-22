import { Suspense } from 'react';
import Navbar from './components/Navbar';
import Hero from './components/Hero';
import Services from './components/Services';
import PromoVideo from './components/PromoVideo';
import About from './components/About';
import Doctors from './components/Doctors';
import FAQ from './components/FAQ';
import Testimonials from './components/Testimonials';
import Footer from './components/Footer';
import WhatsAppWidget from './components/WhatsAppWidget';

function App() {
  return (
    <Suspense fallback={<div style={{ height: '100vh', display: 'flex', justifyContent: 'center', alignItems: 'center' }}>Loading...</div>}>
      {/* We removed onOpenModal since we are using Dikidi links directly */}
      <Navbar onOpenModal={() => window.open('https://dikidi.net/ru/', '_blank')} />
      <main>
        <Hero />
        <Services />
        <PromoVideo />
        <About />
        <Doctors />
        <FAQ />
        <Testimonials />
      </main>
      <Footer />
      
      <WhatsAppWidget />
    </Suspense>
  );
}

export default App;
