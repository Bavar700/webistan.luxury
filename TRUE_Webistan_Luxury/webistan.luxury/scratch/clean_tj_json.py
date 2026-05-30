import json
import os

file_path = r'c:\Users\alaco\Academy_Webistan\TRUE_Webistan_Luxury\webistan.luxury\messages\tj.json'

with open(file_path, 'r', encoding='utf-8') as f:
    data = json.load(f)

def clean_underscores(obj):
    if isinstance(obj, dict):
        return {k: clean_underscores(v) for k, v in obj.items()}
    elif isinstance(obj, list):
        return [clean_underscores(i) for i in obj]
    elif isinstance(obj, str):
        # Specifically avoid keys and only clean values
        # Also fix the <br></br> issue if it's there
        cleaned = obj.replace('_', ' ').replace('<br></br>', '<br /><br />').replace('<br><br>', '<br /><br />')
        return cleaned
    return obj

cleaned_data = clean_underscores(data)

with open(file_path, 'w', encoding='utf-8') as f:
    json.dump(cleaned_data, f, ensure_ascii=False, indent=2)
