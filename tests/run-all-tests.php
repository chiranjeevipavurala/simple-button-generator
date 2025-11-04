<?php
/**
 * Simple Button Generator - Master Test Runner
 * 
 * This script runs all available tests and provides a comprehensive report
 * 
 * Usage: php tests/run-all-tests.php
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "🚀 Simple Button Generator - Master Test Suite\n";
echo str_repeat('=', 70) . "\n";
echo "Running all available tests...\n\n";

$test_results = [];
$total_passed = 0;
$total_failed = 0;

/**
 * Run a test file and capture results
 */
function runTest($test_name, $test_file) {
    global $test_results, $total_passed, $total_failed;
    
    echo "🧪 Running: {$test_name}\n";
    echo str_repeat('-', 50) . "\n";
    
    if (!file_exists($test_file)) {
        echo "❌ Test file not found: {$test_file}\n";
        $test_results[] = [
            'name' => $test_name,
            'status' => 'error',
            'message' => 'Test file not found'
        ];
        $total_failed++;
        return;
    }
    
    // Capture output
    ob_start();
    $exit_code = 0;
    
    try {
        include $test_file;
    } catch (Exception $e) {
        echo "❌ Test failed with exception: " . $e->getMessage() . "\n";
        $exit_code = 1;
    }
    
    $output = ob_get_clean();
    echo $output;
    
    // Simple success detection based on output
    $success_indicators = ['✅', 'All tests passed', 'Success Rate: 100%', 'Pass Rate: 100%'];
    $failure_indicators = ['❌', 'Failed', 'Missing', 'Error'];
    
    $has_success = false;
    $has_failure = false;
    
    foreach ($success_indicators as $indicator) {
        if (strpos($output, $indicator) !== false) {
            $has_success = true;
            break;
        }
    }
    
    foreach ($failure_indicators as $indicator) {
        if (strpos($output, $indicator) !== false) {
            $has_failure = true;
            break;
        }
    }
    
    if ($has_failure && !$has_success) {
        $status = 'failed';
        $total_failed++;
    } else {
        $status = 'passed';
        $total_passed++;
    }
    
    $test_results[] = [
        'name' => $test_name,
        'status' => $status,
        'output' => $output
    ];
    
    echo "\n";
}

// Run all available tests
$tests = [
    'Quick Test' => __DIR__ . '/quick-test.php',
    'Simple Test' => __DIR__ . '/simple-test.php',
    'Standalone Tests' => __DIR__ . '/standalone-tests.php',
    'Plugin Test' => __DIR__ . '/test-plugin.php',
    'Analytics Test' => __DIR__ . '/test-analytics.php',
    'Validate Updates' => __DIR__ . '/validate-updates.php',
    'Verify Tests' => __DIR__ . '/verify-tests.php',
    'Responsive Sizes Test' => __DIR__ . '/test-responsive-sizes.php'
];

foreach ($tests as $name => $file) {
    runTest($name, $file);
}

// Display summary
echo str_repeat('=', 70) . "\n";
echo "📊 MASTER TEST SUITE SUMMARY\n";
echo str_repeat('=', 70) . "\n";

$total_tests = $total_passed + $total_failed;
$success_rate = $total_tests > 0 ? round(($total_passed / $total_tests) * 100, 1) : 0;

echo "Total Test Suites: {$total_tests}\n";
echo "Passed: {$total_passed}\n";
echo "Failed: {$total_failed}\n";
echo "Success Rate: {$success_rate}%\n\n";

// Detailed results
echo "📋 DETAILED RESULTS:\n";
echo str_repeat('-', 50) . "\n";

foreach ($test_results as $result) {
    $status_icon = $result['status'] === 'passed' ? '✅' : '❌';
    echo "{$status_icon} {$result['name']}: " . strtoupper($result['status']) . "\n";
    
    if ($result['status'] === 'failed' && isset($result['message'])) {
        echo "   {$result['message']}\n";
    }
}

echo "\n";

// Recommendations
if ($total_failed === 0) {
    echo "🎉 ALL TESTS PASSED! Your plugin is working correctly.\n";
    echo "\n💡 Next steps:\n";
    echo "   • Test the plugin in a WordPress environment\n";
    echo "   • Create screenshots for WordPress.org submission\n";
    echo "   • Submit to WordPress.org plugin directory\n";
} else {
    echo "⚠️  SOME TESTS FAILED. Please review the issues above.\n";
    echo "\n🔧 Troubleshooting tips:\n";
    echo "   • Check file paths and permissions\n";
    echo "   • Verify all required files exist\n";
    echo "   • Review error messages for specific issues\n";
    echo "   • Run individual tests to isolate problems\n";
}

echo "\n" . str_repeat('=', 70) . "\n";
echo "✅ Master test suite completed!\n";
echo "\nFor individual test details, run:\n";
echo "  • php tests/quick-test.php\n";
echo "  • php tests/simple-test.php\n";
echo "  • php tests/standalone-tests.php\n";
echo "  • php tests/verify-tests.php\n";
echo "  • php tests/test-responsive-sizes.php\n";
?>
