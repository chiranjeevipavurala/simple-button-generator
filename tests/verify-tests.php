<?php
echo "🔍 Verifying Test Failures...\n";
echo str_repeat('-', 50) . "\n";

$plugin_file = dirname(__DIR__) . '/simple-button-generator.php';
$content = file_get_contents($plugin_file);

// Test border styles
echo "Testing border styles:\n";
$border_styles = ['none', 'solid', 'dashed', 'dotted', 'double'];
foreach ($border_styles as $style) {
    $found = strpos($content, $style) !== false;
    echo ($found ? "✅" : "❌") . " {$style}\n";
}

echo "\nTesting action types:\n";
$action_types = ['url', 'javascript', 'email', 'phone', 'download', 'form', 'modal', 'scroll'];
foreach ($action_types as $type) {
    $found = strpos($content, $type) !== false;
    echo ($found ? "✅" : "❌") . " {$type}\n";
}

echo "\nTesting border widths:\n";
$border_widths = ['1px', '2px', '3px', '4px', '5px'];
foreach ($border_widths as $width) {
    $found = strpos($content, $width) !== false;
    echo ($found ? "✅" : "❌") . " {$width}\n";
}

echo "\nTesting border radius:\n";
$border_radius_values = ['0', '4', '8', '20'];
foreach ($border_radius_values as $radius) {
    $found = strpos($content, $radius) !== false;
    echo ($found ? "✅" : "❌") . " {$radius}\n";
}

echo "\nDone!\n";
?>
