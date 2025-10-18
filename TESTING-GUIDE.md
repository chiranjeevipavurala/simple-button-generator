# Plugin Testing Guide

## Local Development Setup

### Option 1: Local by Flywheel (Recommended for Beginners)
1. **Download**: Go to [localwp.com](https://localwp.com) and download Local
2. **Install**: Install the application (free)
3. **Create Site**: 
   - Click "Create a new site"
   - Choose a site name (e.g., "Button Generator Test")
   - Select WordPress version (latest)
   - Create admin credentials
4. **Start Site**: Click "Start" to launch your local WordPress
5. **Access Admin**: Click "WP Admin" to access WordPress admin
6. **Upload Plugin**: 
   - Go to Plugins > Add New > Upload Plugin
   - Upload your plugin ZIP file
   - Activate the plugin

### Option 2: XAMPP (Free, Full Control)
1. **Download**: Get XAMPP from [apachefriends.org](https://www.apachefriends.org)
2. **Install**: Install XAMPP on your computer
3. **Start Services**: Start Apache and MySQL in XAMPP control panel
4. **Download WordPress**: Get latest WordPress from wordpress.org
5. **Setup Database**: 
   - Go to http://localhost/phpmyadmin
   - Create new database (e.g., "wordpress_test")
6. **Install WordPress**: 
   - Extract WordPress to xampp/htdocs/wordpress
   - Go to http://localhost/wordpress
   - Follow WordPress installation wizard
7. **Upload Plugin**: Use WordPress admin to upload and activate your plugin

### Option 3: Docker (For Developers)
1. **Install Docker**: Download from [docker.com](https://docker.com)
2. **Create docker-compose.yml**:
```yaml
version: '3.8'
services:
  wordpress:
    image: wordpress:latest
    ports:
      - "8080:80"
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: wordpress
      WORDPRESS_DB_NAME: wordpress
    volumes:
      - ./wordpress:/var/www/html
      - ./plugin:/var/www/html/wp-content/plugins/simple-button-generator

  db:
    image: mysql:5.7
    environment:
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: wordpress
      MYSQL_ROOT_PASSWORD: rootpassword
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```
3. **Run**: `docker-compose up -d`
4. **Access**: Go to http://localhost:8080

## Testing Checklist

### ✅ Basic Functionality Tests
- [ ] Plugin activates without errors
- [ ] Admin menu appears under Settings
- [ ] Form loads correctly
- [ ] All form fields work (title, URL, size, color, CSS)
- [ ] Live preview updates when changing options
- [ ] Generate button works
- [ ] Download HTML file works
- [ ] Copy code works

### ✅ Cross-Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile browsers (iOS Safari, Chrome Mobile)

### ✅ WordPress Version Compatibility
- [ ] WordPress 5.0+
- [ ] WordPress 6.0+
- [ ] WordPress 6.4 (latest)

### ✅ Theme Compatibility
- [ ] Default WordPress themes (Twenty Twenty-Four, etc.)
- [ ] Popular themes (Astra, GeneratePress, etc.)
- [ ] Custom themes

### ✅ Security Tests
- [ ] Form inputs are properly sanitized
- [ ] AJAX requests use nonces
- [ ] No direct file access vulnerabilities
- [ ] XSS protection in place

### ✅ Performance Tests
- [ ] Plugin loads quickly
- [ ] No JavaScript errors in console
- [ ] CSS loads properly
- [ ] AJAX requests are fast

### ✅ Generated HTML Tests
- [ ] HTML file opens correctly in browsers
- [ ] Button styling works as expected
- [ ] Links work properly
- [ ] Responsive design works on mobile
- [ ] Custom CSS is applied correctly

## Quick Testing Script

Create a simple test file to verify your plugin works:

```php
<?php
// test-plugin.php - Place this in your WordPress root directory
// Access via: http://localhost/your-site/test-plugin.php

// Load WordPress
require_once('wp-config.php');
require_once('wp-load.php');

// Check if plugin is active
if (is_plugin_active('simple-button-generator/simple-button-generator.php')) {
    echo "✅ Plugin is active<br>";
} else {
    echo "❌ Plugin is not active<br>";
}

// Test AJAX endpoint
$nonce = wp_create_nonce('button_generator_nonce');
echo "✅ Nonce created: " . substr($nonce, 0, 10) . "...<br>";

// Test form data processing
$test_data = array(
    'button_title' => 'Test Button',
    'button_action' => 'https://example.com',
    'button_size' => 'medium',
    'button_color' => 'blue',
    'custom_css' => ''
);

echo "✅ Test data prepared<br>";
echo "Ready for testing!<br>";
?>
```

## Common Issues to Check

### JavaScript Errors
1. Open browser Developer Tools (F12)
2. Go to Console tab
3. Look for any red error messages
4. Test all plugin functionality

### CSS Issues
1. Check if styles are loading
2. Verify responsive design
3. Test on different screen sizes

### PHP Errors
1. Enable WordPress debug mode in wp-config.php:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```
2. Check error logs in /wp-content/debug.log

### AJAX Issues
1. Check Network tab in Developer Tools
2. Verify AJAX requests are successful
3. Check for 404 or 500 errors

## Testing Different Scenarios

### Edge Cases
- [ ] Empty form submission
- [ ] Very long button titles
- [ ] Invalid URLs
- [ ] Special characters in CSS
- [ ] Large CSS files

### User Experience
- [ ] Clear error messages
- [ ] Helpful descriptions
- [ ] Intuitive interface
- [ ] Mobile-friendly design

## Performance Testing

### Load Testing
- [ ] Test with multiple buttons generated
- [ ] Check memory usage
- [ ] Verify no memory leaks

### Speed Testing
- [ ] Page load time
- [ ] AJAX response time
- [ ] File download speed

## Final Validation

Before submitting to WordPress.org:
- [ ] All tests pass
- [ ] No console errors
- [ ] Works on multiple browsers
- [ ] Compatible with popular themes
- [ ] Security best practices followed
- [ ] Code follows WordPress standards
- [ ] Documentation is complete

## Resources

- [WordPress Plugin Developer Handbook](https://developer.wordpress.org/plugins/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Local by Flywheel](https://localwp.com)
- [XAMPP](https://www.apachefriends.org)
- [Docker](https://docker.com)
