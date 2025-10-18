<?php
/**
 * Validation Test for Updated Simple Button Generator
 * Tests the new CSS examples and modal functionality
 */

echo "🧪 Simple Button Generator - Update Validation Test\n";
echo "================================================\n\n";

// Test 1: Check if main plugin file has new features
echo "Test 1: Checking for new CSS examples in main plugin file...\n";
$plugin_content = file_get_contents('simple-button-generator.php');

if (strpos($plugin_content, 'CSS Examples Guide') !== false) {
    echo "✅ CSS Examples Guide found in plugin\n";
} else {
    echo "❌ CSS Examples Guide not found\n";
}

if (strpos($plugin_content, 'css-examples-modal') !== false) {
    echo "✅ CSS Examples Modal found in plugin\n";
} else {
    echo "❌ CSS Examples Modal not found\n";
}

if (strpos($plugin_content, 'showCSSExamples') !== false) {
    echo "✅ CSS Examples JavaScript function found\n";
} else {
    echo "❌ CSS Examples JavaScript function not found\n";
}

// Test 2: Check if JavaScript file has new functions
echo "\nTest 2: Checking JavaScript file for new functions...\n";
$js_content = file_get_contents('admin-script.js');

if (strpos($js_content, 'showCSSExamples') !== false) {
    echo "✅ showCSSExamples function found in JavaScript\n";
} else {
    echo "❌ showCSSExamples function not found in JavaScript\n";
}

if (strpos($js_content, 'closeCSSExamples') !== false) {
    echo "✅ closeCSSExamples function found in JavaScript\n";
} else {
    echo "❌ closeCSSExamples function not found in JavaScript\n";
}

// Test 3: Check if CSS examples file exists
echo "\nTest 3: Checking for CSS examples documentation...\n";
if (file_exists('CSS-EXAMPLES.md')) {
    echo "✅ CSS-EXAMPLES.md file exists\n";
    $css_examples_size = filesize('CSS-EXAMPLES.md');
    echo "   File size: " . $css_examples_size . " bytes\n";
} else {
    echo "❌ CSS-EXAMPLES.md file not found\n";
}

// Test 4: Check placeholder text improvements
echo "\nTest 4: Checking for improved placeholder text...\n";
if (strpos($plugin_content, 'Custom CSS Examples - Uncomment and modify as needed') !== false) {
    echo "✅ Improved placeholder text found\n";
} else {
    echo "❌ Improved placeholder text not found\n";
}

if (strpos($plugin_content, 'Pro Tips:') !== false) {
    echo "✅ Pro Tips section found\n";
} else {
    echo "❌ Pro Tips section not found\n";
}

// Test 5: Check for enhanced textarea
echo "\nTest 5: Checking for enhanced textarea...\n";
if (strpos($plugin_content, 'rows="15"') !== false) {
    echo "✅ Enhanced textarea size (15 rows) found\n";
} else {
    echo "❌ Enhanced textarea size not found\n";
}

// Test 6: Validate CSS examples content
echo "\nTest 6: Validating CSS examples content...\n";
$css_examples = file_get_contents('CSS-EXAMPLES.md');

$required_examples = [
    'Gradient Background',
    'Shadow Effect',
    'Bounce Animation',
    'E-commerce "Buy Now"',
    'Modern Glass Effect',
    '3D Button Effect'
];

$found_examples = 0;
foreach ($required_examples as $example) {
    if (strpos($css_examples, $example) !== false) {
        $found_examples++;
        echo "✅ Found: $example\n";
    } else {
        echo "❌ Missing: $example\n";
    }
}

echo "\nFound $found_examples out of " . count($required_examples) . " required examples\n";

// Test 7: Check for proper modal structure
echo "\nTest 7: Checking modal structure...\n";
if (strpos($plugin_content, 'position: fixed') !== false) {
    echo "✅ Modal positioning CSS found\n";
} else {
    echo "❌ Modal positioning CSS not found\n";
}

if (strpos($plugin_content, 'z-index: 9999') !== false) {
    echo "✅ Modal z-index found\n";
} else {
    echo "❌ Modal z-index not found\n";
}

// Summary
echo "\n" . str_repeat("=", 50) . "\n";
echo "🎯 UPDATE VALIDATION SUMMARY\n";
echo str_repeat("=", 50) . "\n";

$total_tests = 7;
$passed_tests = 0;

// Count passed tests (simplified check)
if (strpos($plugin_content, 'CSS Examples Guide') !== false) $passed_tests++;
if (strpos($plugin_content, 'css-examples-modal') !== false) $passed_tests++;
if (strpos($js_content, 'showCSSExamples') !== false) $passed_tests++;
if (file_exists('CSS-EXAMPLES.md')) $passed_tests++;
if (strpos($plugin_content, 'Pro Tips:') !== false) $passed_tests++;
if (strpos($plugin_content, 'rows="15"') !== false) $passed_tests++;
if ($found_examples >= 4) $passed_tests++; // At least 4 out of 6 examples

echo "Tests Passed: $passed_tests out of $total_tests\n";

if ($passed_tests >= 6) {
    echo "🎉 SUCCESS: All major updates are in place!\n";
    echo "✅ CSS Examples Guide implemented\n";
    echo "✅ Modal functionality added\n";
    echo "✅ Enhanced user experience\n";
    echo "✅ Comprehensive documentation\n";
} else {
    echo "⚠️  WARNING: Some updates may be missing\n";
    echo "Please check the failed tests above\n";
}

echo "\n🚀 Your plugin is ready for testing in Local WordPress!\n";
echo "Next steps:\n";
echo "1. Upload to Local WordPress\n";
echo "2. Test the CSS Examples Guide\n";
echo "3. Verify modal functionality\n";
echo "4. Create screenshots for WordPress.org\n";
?>
