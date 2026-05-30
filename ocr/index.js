const Tesseract = require('tesseract.js');
const fs = require('fs');
const path = require('path');

const imgDir = 'C:\\Users\\alaco\\Academy_Webistan\\YormandSite\\src\\assets\\images';
const images = fs.readdirSync(imgDir).filter(f => f.endsWith('.jpg') || f.endsWith('.png'));

async function recognizeImages() {
  for (const img of images) {
    console.log(`\n--- Recognizing ${img} ---`);
    try {
      const { data: { text } } = await Tesseract.recognize(
        path.join(imgDir, img),
        'rus+eng',
        { logger: m => {} } // hide progress
      );
      console.log(text);
    } catch (e) {
      console.error('Error on', img, e.message);
    }
  }
}

recognizeImages();
