# Simple Button Generator WordPress Plugin

A powerful WordPress plugin that allows you to generate customizable buttons that customers can download and use on any website. Perfect for creating call-to-action buttons, download links, and custom interactive elements.

## ✨ Features

### **Core Functionality**
- **Customizable Button Title**: Set any text for your button
- **Multiple Action Types**: URL links, JavaScript functions, email, phone calls, downloads, forms, modals, and scroll actions
- **Live Preview**: Real-time preview with floating draggable panel
- **Download HTML**: Get a complete HTML file ready to use
- **Copy Code**: Copy the generated code to clipboard

### **Styling Options**
- **Custom Color Pickers**: Button background, text, and border colors
- **Typography**: Font family selection (Arial, Helvetica, Georgia, Times, etc.)
- **Border Controls**: Style (solid, dashed, dotted, double), width, and radius
- **Box Shadows**: Subtle, medium, strong, glow, and inset effects
- **Button Sizes**: Small, medium, and large options
- **Custom CSS**: Advanced styling with CSS examples guide

### **Advanced Features**
- **Analytics Tracking**: Google Analytics, Facebook Pixel, and custom event tracking
- **Flexible Actions**: Support for 8 different button action types
- **CSS Examples Modal**: Built-in guide with copy-paste examples
- **Responsive Design**: Works on all devices and screen sizes
- **Professional Output**: Clean, semantic HTML with proper CSS

## 🚀 Installation

### Method 1: WordPress Admin (Recommended)
1. Download the plugin ZIP file
2. Go to your WordPress admin dashboard
3. Navigate to **Plugins > Add New**
4. Click **Upload Plugin**
5. Choose the ZIP file and click **Install Now**
6. Click **Activate Plugin**
7. Go to **Settings > Button Generator** to start using

### Method 2: FTP Upload
1. Extract the plugin ZIP file
2. Upload the `simple-button-generator` folder to `/wp-content/plugins/`
3. Go to **Plugins** in WordPress admin
4. Find "Simple Button Generator" and click **Activate**
5. Go to **Settings > Button Generator** to start using

## 📖 Usage

1. Navigate to **Settings > Button Generator** in your WordPress admin
2. Configure your button:
   - **Button Title**: The text that will appear on the button
   - **Action Type**: Choose from URL, JavaScript, email, phone, download, form, modal, or scroll
   - **Action Value**: Enter the appropriate value based on your action type
3. Customize appearance:
   - **Colors**: Use color pickers for background, text, and border
   - **Typography**: Select font family
   - **Borders**: Choose style, width, and radius
   - **Effects**: Add box shadows
   - **Size**: Select small, medium, or large
4. Add tracking (optional):
   - Choose tracking type (Google Analytics, Facebook Pixel, or custom)
   - Set event name for analytics
5. Click **Generate Button** to see a preview
6. Download the HTML file or copy the code to use on any website

## 🎨 Action Types

- **URL Link**: Standard web links
- **JavaScript**: Custom JavaScript functions
- **Email**: Opens default email client
- **Phone**: Initiates phone calls on mobile devices
- **Download**: Triggers file downloads
- **Form**: Submits forms by ID
- **Modal**: Opens modal/popup by ID
- **Scroll**: Smooth scrolls to element by ID

## 📊 Analytics Integration

- **Google Analytics**: Automatic gtag event tracking
- **Facebook Pixel**: Facebook conversion tracking
- **Custom Events**: Console logging and custom tracking code
- **Event Naming**: Customizable event names and labels

## 🛠️ Customization

### CSS Examples
The plugin includes a built-in CSS examples guide with:
- Hover effects
- Gradient backgrounds
- Border styles
- Text effects
- Shadow effects
- Animation examples

### Custom CSS
Add your own CSS for advanced styling:
```css
.simple-button {
    /* Your custom styles here */
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    transform: scale(1.05);
    transition: all 0.3s ease;
}
```

## 📁 File Structure

```
simple-button-generator/
├── simple-button-generator.php    # Main plugin file
├── admin-script.js               # JavaScript functionality
├── admin-style.css               # Admin page styling
├── assets/                       # Plugin assets
│   ├── banner-772x250.png       # Plugin banner
│   └── screenshot-1.png         # Plugin screenshot
└── tests/                        # Test suite
    ├── run-all-tests.php        # Master test runner
    └── [various test files]     # Comprehensive tests
```

## 🧪 Testing

The plugin includes a comprehensive test suite:

```bash
# Run all tests
php tests/run-all-tests.php

# Run individual tests
php tests/quick-test.php
php tests/standalone-tests.php
php tests/test-plugin.php
```

## 📚 Documentation

- **[Action Types Guide](ACTION-TYPES-GUIDE.md)** - Detailed guide for all button actions
- **[Analytics Tracking Guide](ANALYTICS-TRACKING-GUIDE.md)** - Analytics integration guide
- **[Border Options Guide](BORDER-OPTIONS-GUIDE.md)** - Border styling guide
- **[CSS Examples](CSS-EXAMPLES.md)** - CSS styling examples
- **[FAQ](FAQ.md)** - Frequently asked questions
- **[Installation Guide](INSTALLATION.md)** - Detailed installation instructions
- **[Publishing Guide](PUBLISHING-GUIDE.md)** - WordPress.org submission guide
- **[Testing Guide](TESTING-GUIDE.md)** - Testing documentation

## 🔧 Requirements

- **WordPress**: 4.0 or higher
- **PHP**: 5.6 or higher
- **Browser**: Modern browser with JavaScript enabled

## 📄 License

This plugin is licensed under the GPL v2 or later.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run the test suite
5. Submit a pull request

## 📞 Support

For support, feature requests, or bug reports, please check the FAQ or create an issue in the repository.

## 🎯 Use Cases

- **E-commerce**: Add to cart buttons, checkout links
- **Lead Generation**: Contact forms, newsletter signups
- **Downloads**: PDF downloads, software downloads
- **Navigation**: Scroll to sections, modal triggers
- **Social Media**: Share buttons, follow links
- **Analytics**: Track user interactions and conversions

---

**Made with ❤️ for the WordPress community**