const fs = require('fs');

const cleanFile = (path) => {
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
        console.log(`Successfully cleaned ${path}`);
    } catch (err) {
        console.error(`Error cleaning ${path}:`, err);
    }
};

cleanFile('messages/en.json');
cleanFile('messages/ru.json');
cleanFile('messages/tj.json');
