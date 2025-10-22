<?php
/**
 * Validation Test for Updated Simple Button Generator
 * Tests the new CSS examples and modal functionality
 */

echo "🧪 Simple Button Generator - Update Validation Test\n";
echo "================================================\n\n";

// Test 1: Check if main plugin file has new features
echo "Test 1: Checking for new CSS examples in main plugin file...\n";
$plugin_content = file_get_contents(dirname(__DIR__) . '/simple-button-generator.php');

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

if (strpos($plugin_content, 'CSS Examples') !== false) {
    echo "✅ CSS Examples button found in plugin\n";
} else {
    echo "❌ CSS Examples button not found\n";
}

// Test 2: Check if CSS examples modal has proper structure
echo "\nTest 2: Checking CSS examples modal structure...\n";

if (strpos($plugin_content, '<div id="css-examples-modal"') !== false) {
    echo "✅ CSS examples modal div found\n";
} else {
    echo "❌ CSS examples modal div not found\n";
}

if (strpos($plugin_content, 'position: fixed') !== false) {
    echo "✅ Modal has fixed positioning\n";
} else {
    echo "❌ Modal missing fixed positioning\n";
}

if (strpos($plugin_content, 'z-index: 9999') !== false) {
    echo "✅ Modal has proper z-index\n";
} else {
    echo "❌ Modal missing proper z-index\n";
}

// Test 3: Check for CSS examples content
echo "\nTest 3: Checking CSS examples content...\n";

$css_examples = [
    '/* Hover Effects */',
    '/* Gradient Backgrounds */',
    '/* Border Styles */',
    '/* Text Effects */',
    '/* Shadow Effects */'
];

foreach ($css_examples as $example) {
    if (strpos($plugin_content, $example) !== false) {
        echo "✅ Found CSS example: " . trim($example, '/* ') . "\n";
    } else {
        echo "❌ Missing CSS example: " . trim($example, '/* ') . "\n";
    }
}

// Test 4: Check for modal close functionality
echo "\nTest 4: Checking modal close functionality...\n";

if (strpos($plugin_content, 'close-css-examples') !== false) {
    echo "✅ Modal close button found\n";
} else {
    echo "❌ Modal close button not found\n";
}

if (strpos($plugin_content, 'display: none') !== false) {
    echo "✅ Modal can be hidden\n";
} else {
    echo "❌ Modal missing hide functionality\n";
}

// Test 5: Check for JavaScript modal functionality
echo "\nTest 5: Checking JavaScript modal functionality...\n";
$js_content = file_get_contents(dirname(__DIR__) . '/admin-script.js');

if (strpos($js_content, 'css-examples-modal') !== false) {
    echo "✅ JavaScript modal references found\n";
} else {
    echo "❌ JavaScript modal references not found\n";
}

if (strpos($js_content, 'show-css-examples') !== false) {
    echo "✅ Show CSS examples button handler found\n";
} else {
    echo "❌ Show CSS examples button handler not found\n";
}

if (strpos($js_content, 'close-css-examples') !== false) {
    echo "✅ Close CSS examples button handler found\n";
} else {
    echo "❌ Close CSS examples button handler not found\n";
}

// Test 6: Check for CSS styling of modal
echo "\nTest 6: Checking CSS styling for modal...\n";
$css_content = file_get_contents(dirname(__DIR__) . '/admin-style.css');

if (strpos($css_content, '#css-examples-modal') !== false) {
    echo "✅ CSS examples modal styling found\n";
} else {
    echo "❌ CSS examples modal styling not found\n";
}

// Test 7: Check for proper button integration
echo "\nTest 7: Checking button integration...\n";

if (strpos($plugin_content, 'button button-secondary') !== false) {
    echo "✅ CSS Examples button has proper styling\n";
} else {
    echo "❌ CSS Examples button missing proper styling\n";
}

// Summary
echo "\n" . str_repeat('=', 50) . "\n";
echo "📊 Update Validation Summary\n";
echo str_repeat('=', 50) . "\n";

$checks = [
    'CSS Examples Guide' => strpos($plugin_content, 'CSS Examples Guide') !== false,
    'CSS Examples Modal' => strpos($plugin_content, 'css-examples-modal') !== false,
    'CSS Examples Button' => strpos($plugin_content, 'CSS Examples') !== false,
    'Modal Structure' => strpos($plugin_content, '<div id="css-examples-modal"') !== false,
    'Modal Positioning' => strpos($plugin_content, 'position: fixed') !== false,
    'Modal Z-Index' => strpos($plugin_content, 'z-index: 9999') !== false,
    'Close Button' => strpos($plugin_content, 'close-css-examples') !== false,
    'JavaScript Integration' => strpos($js_content, 'css-examples-modal') !== false,
    'CSS Styling' => strpos($css_content, '#css-examples-modal') !== false
];

$passed = 0;
$total = count($checks);

foreach ($checks as $check => $result) {
    echo ($result ? "✅" : "❌") . " {$check}\n";
    if ($result) $passed++;
}

$success_rate = round(($passed / $total) * 100, 1);

echo "\nResults: {$passed}/{$total} checks passed ({$success_rate}%)\n";

if ($success_rate >= 90) {
    echo "🎉 Excellent! All major features are properly implemented.\n";
} elseif ($success_rate >= 70) {
    echo "⚠️  Good! Most features are implemented, but some may need attention.\n";
} else {
    echo "❌ Issues detected! Please review the failed checks above.\n";
}

echo "\n✅ Update validation completed!\n";
?>
