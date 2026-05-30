import os
import re

root_dir = r'c:\Users\alaco\Academy_Webistan\Neksoz'

def fix_links():
    for root, dirs, files in os.walk(root_dir):
        for file in files:
            if file.endswith('.php') and file != 'functions.php':
                file_path = os.path.join(root, file)
                with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                    content = f.read()

                # Determine lang from filename
                lang = 'ru'
                if '-tj.php' in file: lang = 'tj'
                elif '-en.php' in file: lang = 'en'
                else: lang = '$current_lang'

                # Fix the broken nk_link('', ... calls
                # This happened because of the previous bad script
                # We want to restore them if we can, but since we don't know the original,
                # we'll look for pattern nk_link('', 'lang') and try to guess or just fix the general home_url
                
                # First, let's revert the damage: nk_link('', 'lang') -> home_url('/') (incorrect but safe starting point)
                # content = content.replace("nk_link('',", "home_url('/") # This is too risky
                
                # Better: just fix all home_url('/path') calls again correctly
                
                # regex to find home_url('/path')
                pattern = r"home_url\('(/[^']*)'\)"
                
                def replace_func(match):
                    path = match.group(1)
                    if lang == '$current_lang':
                        return f"nk_link('{path}', $current_lang)"
                    else:
                        return f"nk_link('{path}', '{lang}')"

                new_content = re.sub(pattern, replace_func, content)
                
                # ALSO fix the already broken ones if they were home_url('/...')
                # Regex for nk_link('', 'tj') which was home_url('/...')
                # Actually I'll just look for nk_link('', and see if I can find the original path.
                # Since I don't have the original, I'll have to manually fix the ones I found.
                
                if new_content != content:
                    with open(file_path, 'w', encoding='utf-8') as f:
                        f.write(new_content)

fix_links()
