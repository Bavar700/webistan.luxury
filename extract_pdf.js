const fs = require('fs');
const pdfModule = require('pdf-parse');

const pdfPath = 'C:\\Users\\alaco\\Downloads\\Коммерческое предложение.pdf';
const txtPath = 'c:\\Users\\alaco\\Academy_Webistan\\pdf_text.txt';

async function main() {
    try {
        let buffer = fs.readFileSync(pdfPath);
        let uint8Array = new Uint8Array(buffer.buffer, buffer.byteOffset, buffer.byteLength);
        const parser = new pdfModule.PDFParse(uint8Array);
        await parser.load();
        const result = await parser.getText();
        
        fs.writeFileSync(txtPath, result.text);
        console.log("PDF text extracted successfully to pdf_text.txt!");
    } catch (err) {
        console.error("Error:", err);
    }
}

main();
