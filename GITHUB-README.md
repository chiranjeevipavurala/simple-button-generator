# Simple Button Generator WordPress Plugin

[![WordPress](https://img.shields.io/badge/WordPress-4.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-5.6%2B-purple.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPL%20v2%2B-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

A powerful WordPress plugin that allows you to generate customizable buttons that customers can download and use on any website. Perfect for creating call-to-action buttons, download links, and custom interactive elements.

## ✨ Features

- 🎨 **Multiple Button Sizes**: Small, Medium, Large, and Custom
- 🌈 **5 Color Schemes**: Blue, Green, Red, Orange, Purple + Custom CSS
- 👀 **Live Preview**: See your button as you create it
- 📥 **Download HTML**: Get complete, self-contained HTML files
- 📋 **Copy Code**: Copy generated code to clipboard
- 🎯 **Professional Styling**: Modern, responsive design with hover effects
- 🔧 **Custom CSS**: Add your own styling to override defaults
- 📱 **Mobile Friendly**: Responsive design that works on all devices

## 🚀 Quick Start

### Installation

1. **Download the plugin**:
   ```bash
   git clone https://github.com/yourusername/simple-button-generator.git
   ```

2. **Upload to WordPress**:
   - Zip the `simple-button-generator` folder
   - Go to WordPress Admin → Plugins → Add New → Upload Plugin
   - Upload the ZIP file and activate

3. **Start creating buttons**:
   - Go to Settings → Button Generator
   - Fill in your button details
   - Generate and download your button!

### Usage

1. **Navigate to Settings → Button Generator** in your WordPress admin
2. **Configure your button**:
   - Enter button title (e.g., "Get Started Now")
   - Set action URL (where the button links)
   - Choose size (Small, Medium, Large, or Custom)
   - Select color scheme (Blue, Green, Red, Orange, Purple, or Custom)
   - Add custom CSS (optional)
3. **Preview and download**:
   - See live preview as you type
   - Click "Generate Button" to create
   - Download HTML file or copy code

## 📸 Screenshots

### Admin Interface
![Admin Interface](assets/screenshot-1.png)

### Button Preview
![Button Preview](assets/screenshot-2.png)

### Generated Output
![Generated Output](assets/screenshot-3.png)

## 🎨 Customization Examples

### Red Call-to-Action Button
```css
.simple-button {
    background-color: #dc3545;
    border-radius: 25px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
```

### Green Download Button
```css
.simple-button {
    background-color: #28a745;
    padding: 15px 30px;
    font-size: 18px;
}
```

### Custom Styled Button
```css
.simple-button {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 50px;
    color: white;
    padding: 12px 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
```

## 📁 File Structure

```
simple-button-generator/
├── simple-button-generator.php    # Main plugin file
├── admin-style.css                # Admin interface styling
├── admin-script.js                # JavaScript functionality
├── assets/                        # Screenshots and banners
├── README.md                      # Plugin documentation
├── CHANGELOG.md                   # Version history
├── FAQ.md                         # Frequently asked questions
├── INSTALLATION.md                # Installation guide
└── .gitignore                     # Git ignore rules
```

## 🔧 Development

### Requirements
- WordPress 4.0 or higher
- PHP 5.6 or higher
- Modern web browser

### Local Development
1. Clone the repository
2. Set up local WordPress environment (recommend Local by Flywheel)
3. Upload plugin to WordPress
4. Test functionality

### Contributing
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📋 Testing

### Automated Testing
- [ ] Plugin activates without errors
- [ ] Admin interface loads correctly
- [ ] Form validation works
- [ ] Button generation functions properly
- [ ] Download functionality works
- [ ] Cross-browser compatibility

### Manual Testing
- [ ] Test with different WordPress versions
- [ ] Test with various themes
- [ ] Test on mobile devices
- [ ] Test with different browsers

## 🐛 Bug Reports

Found a bug? Please create an issue with:
- WordPress version
- PHP version
- Browser information
- Steps to reproduce
- Expected vs actual behavior

## 💡 Feature Requests

Have an idea for a new feature? We'd love to hear it! Please create an issue with:
- Detailed description
- Use case examples
- Potential implementation ideas

## 📄 License

This plugin is licensed under the GPL v2 or later.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
```

## 🙏 Credits

- **Author**: Your Name
- **WordPress**: Built for the WordPress community
- **Icons**: Modern UI icons and symbols
- **Inspiration**: WordPress plugin development best practices

## 📞 Support

- **Documentation**: Check the README.md and FAQ.md files
- **Issues**: Create an issue on GitHub
- **Email**: your-email@example.com

## 🌟 Show Your Support

If you find this plugin helpful, please:
- ⭐ Star this repository
- 🐛 Report bugs
- 💡 Suggest features
- 📢 Share with others

---

**Made with ❤️ for the WordPress community**
