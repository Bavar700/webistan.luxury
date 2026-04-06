import sys

def fix_encoding(text):
    try:
        # The text is likely UTF-8 bytes interpreted as windows-1252 or similar
        # We need to encode it back to bytes as if it was windows-1251 or latin1 and then decode as utf-8
        return text.encode('latin1').decode('utf-8')
    except Exception as e:
        return text

if __name__ == "__main__":
    content = sys.stdin.read()
    sys.stdout.write(fix_encoding(content))
