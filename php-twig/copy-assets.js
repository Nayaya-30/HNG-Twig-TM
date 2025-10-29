const fs = require('fs');
const path = require('path');

// Create directories if they don't exist
const publicDir = path.join(__dirname, 'php-twig', 'public');
const buildDir = path.join(publicDir, 'build');

if (!fs.existsSync(publicDir)) {
  fs.mkdirSync(publicDir, { recursive: true });
}

if (!fs.existsSync(buildDir)) {
  fs.mkdirSync(buildDir, { recursive: true });
}

// Copy CSS file
const sourceCss = path.join(__dirname, 'assets', 'css', 'styles.css');
const destCss = path.join(buildDir, 'styles.css');

fs.copyFileSync(sourceCss, destCss);
console.log('Copied CSS file to public directory');