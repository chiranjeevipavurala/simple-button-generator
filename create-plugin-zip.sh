#!/bin/bash

# Simple Button Generator - Plugin ZIP Creator
# This script creates a ZIP file of your plugin for testing and distribution

echo "🚀 Creating Simple Button Generator Plugin ZIP..."

# Create a temporary directory
TEMP_DIR="simple-button-generator-temp"
PLUGIN_DIR="simple-button-generator"
ZIP_FILE="simple-button-generator.zip"

# Clean up any existing temp directory
if [ -d "$TEMP_DIR" ]; then
    rm -rf "$TEMP_DIR"
fi

# Create temp directory and copy plugin files
mkdir "$TEMP_DIR"
cp -r "$PLUGIN_DIR" "$TEMP_DIR/"

# Remove any unnecessary files from the copy
cd "$TEMP_DIR/$PLUGIN_DIR"
rm -f "*.md" "*.sh" "test-plugin.php" "assets/*.png" 2>/dev/null || true

# Go back to temp directory
cd ..

# Create ZIP file
zip -r "../$ZIP_FILE" "$PLUGIN_DIR" -x "*.DS_Store" "*.git*" "*.md" "*.sh" "test-plugin.php"

# Clean up temp directory
cd ..
rm -rf "$TEMP_DIR"

echo "✅ Plugin ZIP created: $ZIP_FILE"
echo "📦 Ready for WordPress upload!"
echo ""
echo "Next steps:"
echo "1. Upload $ZIP_FILE to your local WordPress site"
echo "2. Activate the plugin"
echo "3. Go to Settings > Button Generator"
echo "4. Test all functionality"
echo ""
echo "Files included in ZIP:"
echo "- simple-button-generator.php (main plugin file)"
echo "- admin-style.css (admin styling)"
echo "- admin-script.js (JavaScript functionality)"
echo ""
echo "Files excluded from ZIP:"
echo "- Documentation files (*.md)"
echo "- Test files (test-plugin.php)"
echo "- Scripts (*.sh)"
echo "- Asset placeholders"
