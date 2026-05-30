const fs = require('fs');
const path = 'messages/tj.json';

try {
    const rawData = fs.readFileSync(path, 'utf8');
    const data = JSON.parse(rawData);

    const cleanUnderscores = (obj) => {
        if (typeof obj === 'string') {
            return obj.replace(/_/g, ' ').replace(/<br><\/br>/g, '<br /><br />').replace(/<br><br>/g, '<br /><br />');
        } else if (Array.isArray(obj)) {
            return obj.map(cleanUnderscores);
        } else if (typeof obj === 'object' && obj !== null) {
            const newObj = {};
            for (const key in obj) {
                newObj[key] = cleanUnderscores(obj[key]);
            }
            return newObj;
        }
        return obj;
    };

    const cleanedData = cleanUnderscores(data);
    fs.writeFileSync(path, JSON.stringify(cleanedData, null, 2), 'utf8');
    console.log('Successfully cleaned tj.json');
} catch (err) {
    console.error('Error:', err);
    process.exit(1);
}
