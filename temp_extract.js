const fs = require('fs');
const c = fs.readFileSync('c:/Users/mahob/Dev/lawncare/Template/Lwancare 1/harmone.framer.ai/index.html', 'utf8');

const patterns = ['Our Services', 'services', 'Services', 'What We Offer', 'Lawn Care', 'Garden'];
for (const p of patterns) {
  const i = c.indexOf(p);
  console.log(p, i);
}

const re = /data-framer-name="([^"]*service[^"]*)"/gi;
let m;
const names = [];
while ((m = re.exec(c)) !== null) names.push(m[1]);
console.log('framer service names:', [...new Set(names)].slice(0, 50));

// search section headings in p/h tags
const headingRe = /<p[^>]*>([^<]{5,80})<\/p>/g;
const headings = [];
while ((m = headingRe.exec(c)) !== null) {
  if (/service|lawn|garden|land|care|offer/i.test(m[1])) headings.push(m[1]);
}
console.log('relevant headings:', [...new Set(headings)].slice(0, 40));
