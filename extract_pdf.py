import pypdf
import sys

def extract_pdf_text(pdf_path, txt_path):
    try:
        reader = pypdf.PdfReader(pdf_path)
        text = ""
        for i, page in enumerate(reader.pages):
            text += f"--- Page {i+1} ---\n"
            text += page.extract_text() + "\n"
        with open(txt_path, 'w', encoding='utf-8') as f:
            f.write(text)
        print(f"Successfully extracted text to {txt_path}")
    except Exception as e:
        print(f"Error: {e}")

if __name__ == "__main__":
    pdf_path = r"C:\Users\alaco\Downloads\Коммерческое предложение.pdf"
    txt_path = r"c:\Users\alaco\Academy_Webistan\pdf_text.txt"
    extract_pdf_text(pdf_path, txt_path)
