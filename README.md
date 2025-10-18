# Simple Button Generator WordPress Plugin

A simple WordPress plugin that allows you to generate customizable buttons that customers can download and use on their websites.

## Features

- **Customizable Button Title**: Set any text for your button
- **Custom Action URL**: Link the button to any URL
- **Custom CSS Styling**: Add your own CSS to style the button
- **Default Styling**: Professional default button appearance
- **Live Preview**: See your button as you create it
- **Download HTML**: Get a complete HTML file ready to use
- **Copy Code**: Copy the generated code to clipboard

## Installation

1. Download the plugin files
2. Upload the `simple-button-generator` folder to your WordPress `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to Settings > Button Generator to start creating buttons

## Usage

1. Navigate to **Settings > Button Generator** in your WordPress admin
2. Fill in the form:
   - **Button Title**: The text that will appear on the button
   - **Button Action**: The URL the button will link to
   - **Custom CSS**: Optional custom styling (leave blank for default styling)
3. Click **Generate Button** to see a preview
4. Download the HTML file or copy the code to use on any website

## Default Button Styling

The plugin includes professional default styling:
- Blue background (#0073aa)
- White text
- Rounded corners
- Hover effects
- Focus states for accessibility
- Responsive design

## Custom CSS Examples

Here are some examples of custom CSS you can add:

### Red Button
```css
.simple-button {
    background-color: #dc3545;
}
.simple-button:hover {
    background-color: #c82333;
}
```

### Green Button with Shadow
```css
.simple-button {
    background-color: #28a745;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.simple-button:hover {
    background-color: #218838;
    box-shadow: 0 6px 12px rgba(0,0,0,0.3);
}
```

### Large Button
```css
.simple-button {
    padding: 20px 40px;
    font-size: 20px;
}
```

## File Structure

```
simple-button-generator/
├── simple-button-generator.php    # Main plugin file
├── admin-style.css                # Admin page styling
├── admin-script.js                # JavaScript functionality
└── README.md                      # This file
```

## Requirements

- WordPress 4.0 or higher
- PHP 5.6 or higher

## Support

For support or feature requests, please contact the plugin author.

## License

This plugin is licensed under the GPL v2 or later.
