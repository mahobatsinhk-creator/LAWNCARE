const base = 'https://azure-alligator-874193.hostingersite.com/deploy.php?action=extract';

let offset = 0;
let total = 7466;

while (offset < total) {
  const res = await fetch(`${base}&offset=${offset}`);
  const html = await res.text();

  if (html.includes('Extract complete') || html.includes('action=setup')) {
    console.log('Extract complete.');
    break;
  }

  if (html.includes('Zip already extracted')) {
    console.log('Zip already extracted.');
    break;
  }

  const match = html.match(/Progress: <strong>(\d+) \/ (\d+)/);
  if (!match) {
    console.log(`Unexpected response at offset ${offset}`);
    process.exit(1);
  }

  offset = Number(match[1]);
  total = Number(match[2]);

  if (offset % 500 < 25 || offset >= total) {
    console.log(`Progress ${offset} / ${total}`);
  }

  await new Promise((resolve) => setTimeout(resolve, 250));
}

console.log('Running setup...');
const setup = await fetch('https://azure-alligator-874193.hostingersite.com/deploy.php?action=setup');
console.log(await setup.text());

const head = await fetch('https://azure-alligator-874193.hostingersite.com/', { method: 'HEAD' });
console.log('Homepage status:', head.status);
