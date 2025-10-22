# Simple Button Generator - Test Suite

This directory contains all test files for the Simple Button Generator plugin.

## 🚀 Quick Start

Run all tests with a single command:

```bash
php tests/run-all-tests.php
```

## 📁 Test Files

### Core Tests
- **`run-all-tests.php`** - Master test runner (runs all tests)
- **`quick-test.php`** - Fast basic functionality check
- **`simple-test.php`** - Basic file and content validation
- **`standalone-tests.php`** - Comprehensive standalone tests (no WordPress required)
- **`test-plugin.php`** - Plugin functionality test (simulates WordPress environment)
- **`test-analytics.php`** - Analytics tracking functionality test
- **`validate-updates.php`** - Validation test for new features and updates
- **`verify-tests.php`** - Verify specific test failures

### Frontend Tests
- **`test-frontend.js`** - JavaScript frontend tests (run in browser console)

## 🎯 Test Categories

### Backend Tests (PHP)
- ✅ File structure validation
- ✅ Plugin syntax and structure
- ✅ JavaScript functionality
- ✅ CSS styling
- ✅ HTML structure
- ✅ Color functionality
- ✅ Border controls
- ✅ Action types
- ✅ Analytics integration

### Frontend Tests (JavaScript)
- ✅ Color picker functionality
- ✅ Border controls
- ✅ Font family selection
- ✅ Box shadow options
- ✅ Action type switching
- ✅ Live preview
- ✅ Form validation
- ✅ AJAX submission

## 🔧 Running Individual Tests

```bash
# Quick test (fastest)
php tests/quick-test.php

# Simple test
php tests/simple-test.php

# Comprehensive standalone tests
php tests/standalone-tests.php

# Plugin functionality test
php tests/test-plugin.php

# Analytics tracking test
php tests/test-analytics.php

# Validate updates test
php tests/validate-updates.php

# Verify specific failures
php tests/verify-tests.php
```

## 🌐 Frontend Tests

Frontend tests run automatically when you:
1. Open the plugin admin page
2. Open browser developer tools (F12)
3. Go to Console tab
4. Tests will run automatically

Or run manually in console:
```javascript
const tests = new SimpleButtonGeneratorTests();
tests.runAllTests();
```

## 📊 Test Results

### Success Indicators
- **90%+ Pass Rate**: Excellent ✅
- **80-89% Pass Rate**: Good ⚠️
- **70-79% Pass Rate**: Fair ⚠️
- **<70% Pass Rate**: Poor ❌

### Common Issues
1. **File not found**: Check file paths
2. **Syntax errors**: Validate PHP/JavaScript syntax
3. **Missing elements**: Verify all required components exist
4. **WordPress not found**: Run in WordPress environment for full tests

## 🛠️ Troubleshooting

### Test Not Running
- Ensure PHP is installed and accessible
- Check file permissions
- Verify you're in the correct directory

### Tests Failing
- Review error messages carefully
- Check recent changes to the codebase
- Run individual tests to isolate issues
- Verify all dependencies are installed

### Frontend Tests Not Working
- Ensure jQuery is loaded
- Check browser console for JavaScript errors
- Verify the admin page is loaded
- Wait for DOM to be ready

## 📝 Adding New Tests

### Backend Tests
Add new test methods to `standalone-tests.php`:

```php
private function testNewFeature() {
    $this->startTest("New Feature");
    
    // Your test logic here
    $this->assertContains($content, 'expected', "Test message");
    
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

1. **Run tests frequently** - Test after every significant change
2. **Test edge cases** - Include boundary conditions and error cases
3. **Keep tests updated** - Update tests when adding new features
4. **Document failures** - Record what broke and why
5. **Automate when possible** - Use the master test runner for consistency

## 📞 Support

If tests are failing and you need help:

1. Check the error messages carefully
2. Review recent changes to the codebase
3. Test manually to confirm the issue
4. Check WordPress error logs
5. Verify all dependencies are installed

Remember: Tests are your safety net - use them to catch issues before they reach users! 🛡️
