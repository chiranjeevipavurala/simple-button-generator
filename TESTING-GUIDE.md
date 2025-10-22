# Simple Button Generator - Testing Guide

This guide explains how to run tests to ensure the plugin works correctly and that changes don't break existing functionality.

## 🧪 Test Suite Overview

The plugin includes a comprehensive test suite with three main components:

1. **Backend Tests** (`test-suite.php`) - Tests PHP functionality
2. **Frontend Tests** (`test-frontend.js`) - Tests JavaScript functionality  
3. **Test Runner** (`run-tests.php`) - Command-line test execution

## 🚀 Running Tests

### Method 1: Command Line (Recommended)

```bash
# Navigate to the plugin directory
cd /path/to/simple-button-generator

# Run all tests
php run-tests.php
```

### Method 2: WordPress Admin

1. Upload the plugin to your WordPress site
2. Activate the plugin
3. Navigate to the plugin admin page
4. Open browser developer tools (F12)
5. Go to Console tab
6. Frontend tests will run automatically

### Method 3: Direct PHP Execution

```bash
# Run backend tests directly
php test-suite.php
```

## 📋 Test Categories

### Backend Tests

- ✅ **Plugin Initialization** - Ensures plugin loads correctly
- ✅ **Button Generation** - Tests HTML/CSS generation
- ✅ **Color Functionality** - Tests color picker logic
- ✅ **Border Functionality** - Tests border controls
- ✅ **Font Family** - Tests typography options
- ✅ **Box Shadow** - Tests shadow effects
- ✅ **Action Types** - Tests button actions
- ✅ **Analytics Tracking** - Tests tracking integration
- ✅ **CSS Generation** - Tests CSS output
- ✅ **AJAX Handling** - Tests server communication

### Frontend Tests

- ✅ **Color Pickers** - Tests all color input controls
- ✅ **Border Controls** - Tests border style/width/radius
- ✅ **Font Selection** - Tests font family dropdown
- ✅ **Box Shadow** - Tests shadow selection
- ✅ **Action Types** - Tests action switching
- ✅ **Live Preview** - Tests real-time updates
- ✅ **Form Validation** - Tests required fields
- ✅ **AJAX Submission** - Tests form submission

## 🔧 Manual Testing Checklist

### Core Functionality

- [ ] Plugin activates without errors
- [ ] Admin menu appears in WordPress dashboard
- [ ] All form fields are present and functional
- [ ] Button preview updates in real-time
- [ ] Generated HTML contains correct structure
- [ ] CSS is properly formatted and applied

### Color Controls

- [ ] Button background color picker works
- [ ] Text color picker works
- [ ] Border color picker works
- [ ] Colors apply to preview immediately
- [ ] Generated HTML includes color CSS
- [ ] No color conflicts between pickers

### Border Controls

- [ ] Border style dropdown works
- [ ] Border width dropdown works
- [ ] Border radius radio buttons work
- [ ] Border preview updates correctly
- [ ] Generated CSS includes border properties

### Typography

- [ ] Font family dropdown works
- [ ] Font changes apply to preview
- [ ] Generated CSS includes font-family

### Effects

- [ ] Box shadow dropdown works
- [ ] Shadow effects apply to preview
- [ ] Generated CSS includes box-shadow

### Action Types

- [ ] URL action works
- [ ] JavaScript action works
- [ ] Email action works
- [ ] Phone action works
- [ ] Download action works
- [ ] Form action works
- [ ] Modal action works
- [ ] Scroll action works
- [ ] Correct input fields show/hide

### Analytics

- [ ] No tracking option works
- [ ] Google Analytics option works
- [ ] Facebook Pixel option works
- [ ] Custom tracking option works
- [ ] Tracking code appears in generated HTML

## 🐛 Troubleshooting Tests

### Common Issues

1. **WordPress Not Found**
   - Ensure you're running tests in a WordPress environment
   - Check that wp-config.php is accessible

2. **Plugin Class Not Found**
   - Ensure the plugin is activated
   - Check that the main plugin file is loaded

3. **Frontend Tests Not Running**
   - Ensure jQuery is loaded
   - Check browser console for JavaScript errors
   - Verify the admin page is loaded

4. **AJAX Tests Failing**
   - Check WordPress AJAX endpoints
   - Verify nonce security tokens
   - Ensure proper permissions

### Debug Mode

Enable debug mode by adding this to your wp-config.php:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);
```

## 📊 Test Results Interpretation

### Pass Rate Expectations

- **90%+ Pass Rate**: Excellent - Plugin is working correctly
- **80-89% Pass Rate**: Good - Minor issues may exist
- **70-79% Pass Rate**: Fair - Some functionality may be broken
- **<70% Pass Rate**: Poor - Major issues need attention

### Failed Test Actions

1. **Review Error Messages** - Check what specific functionality failed
2. **Check Recent Changes** - Identify what was modified recently
3. **Test Manually** - Verify the issue exists in the actual plugin
4. **Fix and Re-test** - Make corrections and run tests again

## 🔄 Continuous Testing

### Before Making Changes

1. Run the full test suite
2. Note the current pass rate
3. Make your changes
4. Run tests again
5. Ensure pass rate doesn't decrease

### After Making Changes

1. Run tests immediately
2. Fix any new failures
3. Re-test until all pass
4. Document any new test cases needed

## 📝 Adding New Tests

### Backend Tests

Add new test methods to `test-suite.php`:

```php
private function testNewFeature() {
    $this->startTest("New Feature");
    
    // Your test logic here
    $this->assertTrue($condition, "Test message");
    
    $this->endTest();
}
```

### Frontend Tests

Add new test methods to `test-frontend.js`:

```javascript
testNewFeature() {
    console.log('\n🆕 Testing New Feature...');
    
    // Your test logic here
    this.testElementExists('#new-element', 'New element should exist');
}
```

## 🎯 Best Practices

1. **Run Tests Frequently** - Test after every significant change
2. **Test Edge Cases** - Include boundary conditions and error cases
3. **Keep Tests Updated** - Update tests when adding new features
4. **Document Failures** - Record what broke and why
5. **Automate When Possible** - Use the test runner for consistency

## 📞 Support

If tests are failing and you need help:

1. Check the error messages carefully
2. Review recent changes to the codebase
3. Test manually to confirm the issue
4. Check WordPress error logs
5. Verify all dependencies are installed

Remember: Tests are your safety net - use them to catch issues before they reach users! 🛡️