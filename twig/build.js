// Simple build script to copy assets to public directory

const fs = require('fs-extra');
const path = require('path');

// Define paths
const rootDir = __dirname;
const assetsDir = path.join(rootDir, 'assets');
const publicDir = path.join(rootDir, 'php-twig', 'public');

// Function to copy assets
async function build() {
  try {
    // Create public directory if it doesn't exist
    await fs.ensureDir(publicDir);
    
    // Create build directory if it doesn't exist
    const buildDir = path.join(publicDir, 'build');
    await fs.ensureDir(buildDir);
    
    // Copy CSS files
    const cssDir = path.join(assetsDir, 'css');
    const cssFiles = await fs.readdir(cssDir);
    
    for (const file of cssFiles) {
      if (file.endsWith('.css')) {
        const srcPath = path.join(cssDir, file);
        const destPath = path.join(buildDir, file);
        await fs.copy(srcPath, destPath, { overwrite: true });
        console.log(`Copied ${srcPath} to ${destPath}`);
      }
    }
    
    console.log('Build completed successfully!');
  } catch (error) {
    console.error('Build failed:', error);
  }
}

// Run build
build();