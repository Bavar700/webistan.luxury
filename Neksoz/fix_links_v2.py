import os
import re

root_dir = r'c:\Users\alaco\Academy_Webistan\Neksoz'

def fix_links():
    for root, dirs, files in os.walk(root_dir):
        for file in files:
            if file.endswith('.php') and file != 'functions.php':
                file_path = os.path.join(root, file)
                try:
                    with open(file_path, 'r', encoding='utf-8') as f:
                        content = f.read()
                except:
                    with open(file_path, 'r', encoding='latin-1') as f:
                        content = f.read()

                # Determine lang from filename
                lang = 'ru'
                if '-tj.php' in file: lang = 'tj'
                elif '-en.php' in file: lang = 'en'
                else: lang = '$current_lang'

                # Pattern to find home_url calls
                # Match home_url('/path') or home_url("/")
                pattern = r"home_url\(\s*['\"]([^'\"]*)['\"]\s*\)"
                
                def replace_func(match):
                    path = match.group(1)
                    # If path already has ?lang=, we strip it because nk_link adds it
                    path = re.sub(r'\?lang=[a-z]{2}', '', path)
                    
                    if lang == '$current_lang':
                        return f"nk_link('{path}', $current_lang)"
                    else:
                        return f"nk_link('{path}', '{lang}')"

                new_content = re.sub(pattern, replace_func, content)
                
                if new_content != content:
                    print(f"Fixed: {file}")
                    with open(file_path, 'w', encoding='utf-8') as f:
                        f.write(new_content)

if __name__ == '__main__':
    fix_links()
