<?php
/**
 * Simple Button Generator - Quick Test
 * 
 * A lightweight test script for quick functionality checks
 * 
 * Usage: php tests/quick-test.php
 */

echo "🚀 Simple Button Generator - Quick Test\n";
echo str_repeat('-', 50) . "\n";

// Test 1: Check if main plugin file exists
$plugin_file = __DIR__ . '/../simple-button-generator.php';
if (file_exists($plugin_file)) {
    echo "✅ Main plugin file exists\n";
} else {
    echo "❌ Main plugin file missing\n";
    exit(1);
}

// Test 2: Check if required files exist
$required_files = [
    '../admin-script.js',
    '../admin-style.css',
    'test-frontend.js'
];

$missing_files = [];
foreach ($required_files as $file) {
    if (!file_exists(__DIR__ . '/' . $file)) {
        $missing_files[] = $file;
    }
}

if (empty($missing_files)) {
    echo "✅ All required files present\n";
} else {
    echo "❌ Missing files: " . implode(', ', $missing_files) . "\n";
}

// Test 3: Check plugin file syntax
$syntax_check = shell_exec("php -l " . escapeshellarg($plugin_file) . " 2>&1");
if (strpos($syntax_check, 'No syntax errors') !== false) {
    echo "✅ Plugin file syntax is valid\n";
} else {
    echo "❌ Plugin file has syntax errors:\n";
    echo $syntax_check . "\n";
}

// Test 4: Check for basic plugin structure
$plugin_content = file_get_contents($plugin_file);
$required_elements = [
    'Plugin Name:',
    'class SimpleButtonGenerator',
    'add_action',
    'wp_enqueue_script',
    'wp_enqueue_style'
];

$missing_elements = [];
foreach ($required_elements as $element) {
    if (strpos($plugin_content, $element) === false) {
        $missing_elements[] = $element;
    }
}

if (empty($missing_elements)) {
    echo "✅ Plugin structure is correct\n";
} else {
    echo "❌ Missing plugin elements: " . implode(', ', $missing_elements) . "\n";
}

// Test 5: Check JavaScript file
$js_file = __DIR__ . '/../admin-script.js';
if (file_exists($js_file)) {
    $js_content = file_get_contents($js_file);
    $js_checks = [
        'jQuery(document).ready',
        'updateLivePreview',
        'button-generator-form',
        'color-picker'
    ];
    
    $js_missing = [];
    foreach ($js_checks as $check) {
        if (strpos($js_content, $check) === false) {
            $js_missing[] = $check;
        }
    }
    
    if (empty($js_missing)) {
        echo "✅ JavaScript functionality present\n";
    } else {
        echo "❌ Missing JavaScript elements: " . implode(', ', $js_missing) . "\n";
    }
} else {
    echo "❌ JavaScript file missing\n";
}

// Test 6: Check CSS file
$css_file = __DIR__ . '/../admin-style.css';
if (file_exists($css_file)) {
    $css_content = file_get_contents($css_file);
    $css_checks = [
        '.simple-button',
        'background-color',
        'border',
        'color'
    ];
    
    $css_missing = [];
    foreach ($css_checks as $check) {
        if (strpos($css_content, $check) === false) {
            $css_missing[] = $check;
        }
    }
    
    if (empty($css_missing)) {
        echo "✅ CSS styling present\n";
    } else {
        echo "❌ Missing CSS elements: " . implode(', ', $css_missing) . "\n";
    }
} else {
    echo "❌ CSS file missing\n";
}

// Test 7: Check for recent changes (git)
if (is_dir(__DIR__ . '/../.git')) {
    $git_status = shell_exec("cd " . escapeshellarg(__DIR__ . '/..') . " && git status --porcelain 2>/dev/null");
    if ($git_status) {
        echo "ℹ️  Uncommitted changes detected\n";
    } else {
        echo "✅ No uncommitted changes\n";
    }
} else {
    echo "ℹ️  Not a git repository\n";
}

echo str_repeat('-', 50) . "\n";
echo "✅ Quick test completed!\n";
echo "\nFor comprehensive testing, run: php tests/run-all-tests.php\n";
?>
