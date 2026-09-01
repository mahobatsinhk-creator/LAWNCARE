import sharp from 'sharp';

const src =
  'C:/Users/mahob/.cursor/projects/c-Users-mahob-Dev-lawncare/assets/c__Users_mahob_AppData_Roaming_Cursor_User_workspaceStorage_b9cea521daeb725cef87d7956a4a150c_images_cropped_circle_image-18f0f74c-e4ad-4110-a3db-e14921c9baff.jpg';
const out = 'public/assets/site/logo.png';
const size = 512;
const mask = Buffer.from(
  `<svg width="${size}" height="${size}"><circle cx="${size / 2}" cy="${size / 2}" r="${size / 2}" fill="white"/></svg>`,
);

await sharp(src)
  .resize(size, size, { fit: 'cover', position: 'centre' })
  .ensureAlpha()
  .composite([{ input: mask, blend: 'dest-in' }])
  .png()
  .toFile(out);

console.log('Saved', out);
