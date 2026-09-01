import sharp from 'sharp';

const src =
  'C:/Users/mahob/.cursor/projects/c-Users-mahob-Dev-lawncare/assets/c__Users_mahob_AppData_Roaming_Cursor_User_workspaceStorage_b9cea521daeb725cef87d7956a4a150c_images_cropped_circle_image-93f2cb15-85fe-44f3-ac43-fb614476f526.jpg';
const out = 'public/assets/site/logo-header.png';
const size = 512;
const radius = size / 2;

const { data, info } = await sharp(src)
  .trim({ threshold: 12 })
  .resize(size, size, {
    fit: 'contain',
    background: { r: 0, g: 0, b: 0, alpha: 0 },
  })
  .ensureAlpha()
  .raw()
  .toBuffer({ resolveWithObject: true });

for (let y = 0; y < info.height; y += 1) {
  for (let x = 0; x < info.width; x += 1) {
    const index = (y * info.width + x) * 4;
    const r = data[index];
    const g = data[index + 1];
    const b = data[index + 2];
    const a = data[index + 3];

    if (a < 20) {
      continue;
    }

    const dx = x - radius + 0.5;
    const dy = y - radius + 0.5;

    if (dx * dx + dy * dy > radius * radius) {
      data[index + 3] = 0;
      continue;
    }

    if (r < 35 && g < 35 && b < 35) {
      data[index + 3] = 0;
      continue;
    }

    const inTopArc = y < 188;
    const inBottomArc = y > 324;
    const isColored = g > r + 12 || b > r + 12 || (g > 70 && g > b && r < 120);

    if (inTopArc || inBottomArc || isColored) {
      continue;
    }

    if (r > 205 && g > 205 && b > 205) {
      data[index + 3] = 0;
    }
  }
}

await sharp(data, {
  raw: {
    width: info.width,
    height: info.height,
    channels: 4,
  },
})
  .png({ compressionLevel: 9 })
  .toFile(out);

console.log('Transparent logo saved to', out);
