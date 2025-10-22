<?php
/**
 * Simple Button Generator - Standalone Test Suite
 * 
 * This file contains tests that can run without WordPress
 * for basic functionality validation
 * 
 * Usage: php tests/standalone-tests.php
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

class StandaloneButtonGeneratorTests {
    
    private $test_results = [];
    private $passed_tests = 0;
    private $failed_tests = 0;
    private $plugin_dir;
    
    public function __construct() {
        $this->plugin_dir = dirname(__DIR__);
    }
    
    /**
     * Run all standalone tests
     */
    public function runAllTests() {
        echo "🧪 Simple Button Generator - Standalone Test Suite\n";
        echo str_repeat('=', 60) . "\n";
        
        $this->testFileStructure();
        $this->testPluginFile();
        $this->testJavaScriptFile();
        $this->testCSSFile();
        $this->testHTMLStructure();
        $this->testColorFunctionality();
        $this->testBorderFunctionality();
        $this->testActionTypes();
        $this->testAnalyticsIntegration();
        
        $this->displayResults();
    }
    
    /**
     * Test file structure
     */
    private function testFileStructure() {
        $this->startTest("File Structure");
        
        $required_files = [
            'simple-button-generator.php',
            'admin-script.js',
            'admin-style.css',
            'README.md'
        ];
        
        foreach ($required_files as $file) {
            $file_path = $this->plugin_dir . '/' . $file;
            if (file_exists($file_path)) {
                $this->passTest("File {$file} exists");
            } else {
                $this->failTest("File {$file} is missing");
            }
        }
        
        $this->endTest();
    }
    
    /**
     * Test plugin file
     */
    private function testPluginFile() {
        $this->startTest("Plugin File");
        
        $plugin_file = $this->plugin_dir . '/simple-button-generator.php';
        
        if (!file_exists($plugin_file)) {
            $this->failTest("Plugin file does not exist");
            return;
        }
        
        $content = file_get_contents($plugin_file);
        
        // Test plugin header
        $this->assertContains($content, 'Plugin Name:', "Plugin should have Plugin Name header");
        $this->assertContains($content, 'Description:', "Plugin should have Description header");
        $this->assertContains($content, 'Version:', "Plugin should have Version header");
        
        // Test class definition
        $this->assertContains($content, 'class SimpleButtonGenerator', "Plugin should define main class");
        
        // Test required methods
        $required_methods = [
            'add_admin_menu',
            'enqueue_admin_scripts',
            'generate_button_ajax'
        ];
        
        foreach ($required_methods as $method) {
            $this->assertContains($content, "function {$method}", "Plugin should have {$method} method");
        }
        
        // Test WordPress hooks
        $this->assertContains($content, 'add_action', "Plugin should use WordPress hooks");
        $this->assertContains($content, 'wp_enqueue_script', "Plugin should enqueue scripts");
        $this->assertContains($content, 'wp_enqueue_style', "Plugin should enqueue styles");
        
        // Test syntax
        $syntax_check = shell_exec("php -l " . escapeshellarg($plugin_file) . " 2>&1");
        if (strpos($syntax_check, 'No syntax errors') !== false) {
            $this->passTest("Plugin file syntax is valid");
        } else {
            $this->failTest("Plugin file has syntax errors");
        }
        
        $this->endTest();
    }
    
    /**
     * Test JavaScript file
     */
    private function testJavaScriptFile() {
        $this->startTest("JavaScript File");
        
        $js_file = $this->plugin_dir . '/admin-script.js';
        
        if (!file_exists($js_file)) {
            $this->failTest("JavaScript file does not exist");
            return;
        }
        
        $content = file_get_contents($js_file);
        
        // Test jQuery usage
        $this->assertContains($content, 'jQuery(document).ready', "Should use jQuery document ready");
        
        // Test form handling
        $this->assertContains($content, 'button-generator-form', "Should handle form submission");
        
        // Test color pickers
        $this->assertContains($content, 'color-picker', "Should have color picker functionality");
        
        // Test live preview
        $this->assertContains($content, 'updateLivePreview', "Should have live preview functionality");
        
        // Test AJAX
        $this->assertContains($content, '$.ajax', "Should use AJAX for form submission");
        
        // Test border controls
        $this->assertContains($content, 'border-style', "Should handle border styles");
        $this->assertContains($content, 'border-width', "Should handle border widths");
        $this->assertContains($content, 'border_radius', "Should handle border radius");
        
        // Test font family
        $this->assertContains($content, 'font-family', "Should handle font family selection");
        
        // Test box shadow
        $this->assertContains($content, 'box-shadow', "Should handle box shadow selection");
        
        $this->endTest();
    }
    
    /**
     * Test CSS file
     */
    private function testCSSFile() {
        $this->startTest("CSS File");
        
        $css_file = $this->plugin_dir . '/admin-style.css';
        
        if (!file_exists($css_file)) {
            $this->failTest("CSS file does not exist");
            return;
        }
        
        $content = file_get_contents($css_file);
        
        // Test button styles
        $this->assertContains($content, '.simple-button', "Should define button styles");
        $this->assertContains($content, 'background-color', "Should have background color styles");
        $this->assertContains($content, 'color', "Should have text color styles");
        $this->assertContains($content, 'border', "Should have border styles");
        
        // Test admin styles
        $this->assertContains($content, '.button-generator-container', "Should have admin page styles");
        
        // Test floating preview
        $this->assertContains($content, 'floating-preview', "Should have floating preview styles");
        
        $this->endTest();
    }
    
    /**
     * Test HTML structure in PHP file
     */
    private function testHTMLStructure() {
        $this->startTest("HTML Structure");
        
        $plugin_file = $this->plugin_dir . '/simple-button-generator.php';
        $content = file_get_contents($plugin_file);
        
        // Test form elements
        $this->assertContains($content, '<form', "Should have form element");
        $this->assertContains($content, 'button-title', "Should have button title field");
        $this->assertContains($content, 'button-action', "Should have button action field");
        
        // Test color pickers
        $this->assertContains($content, 'custom-color-picker', "Should have custom color picker");
        $this->assertContains($content, 'custom-text-color-picker', "Should have text color picker");
        $this->assertContains($content, 'custom-border-color-picker', "Should have border color picker");
        
        // Test border controls
        $this->assertContains($content, 'border-style', "Should have border style control");
        $this->assertContains($content, 'border-width', "Should have border width control");
        $this->assertContains($content, 'border_radius', "Should have border radius control");
        
        // Test typography
        $this->assertContains($content, 'font-family', "Should have font family control");
        $this->assertContains($content, 'box-shadow', "Should have box shadow control");
        
        // Test action types
        $this->assertContains($content, 'button-action-type', "Should have action type control");
        
        // Test tracking
        $this->assertContains($content, 'button-tracking', "Should have tracking control");
        
        $this->endTest();
    }
    
    /**
     * Test color functionality
     */
    private function testColorFunctionality() {
        $this->startTest("Color Functionality");
        
        $js_file = $this->plugin_dir . '/admin-script.js';
        $content = file_get_contents($js_file);
        
        // Test color picker handlers
        $this->assertContains($content, 'custom-color-picker', "Should handle button color picker");
        $this->assertContains($content, 'custom-text-color-picker', "Should handle text color picker");
        $this->assertContains($content, 'custom-border-color-picker', "Should handle border color picker");
        
        // Test CSS generation
        $this->assertContains($content, 'background-color', "Should generate background color CSS");
        $this->assertContains($content, 'color:', "Should generate text color CSS");
        $this->assertContains($content, 'border-color', "Should generate border color CSS");
        
        // Test comment markers
        $this->assertContains($content, 'Button Background Color', "Should use comment markers for button color");
        $this->assertContains($content, 'Button Text Color', "Should use comment markers for text color");
        $this->assertContains($content, 'Button Border Color', "Should use comment markers for border color");
        
        $this->endTest();
    }
    
    /**
     * Test border functionality
     */
    private function testBorderFunctionality() {
        $this->startTest("Border Functionality");
        
        $plugin_file = $this->plugin_dir . '/simple-button-generator.php';
        $content = file_get_contents($plugin_file);
        
        // Test border style options (these are in the PHP HTML)
        $border_styles = ['none', 'solid', 'dashed', 'dotted', 'double'];
        foreach ($border_styles as $style) {
            $this->assertContains($content, $style, "Should support border style: {$style}");
        }
        
        // Test border width options (these are in the PHP HTML)
        $border_widths = ['1px', '2px', '3px', '4px', '5px'];
        foreach ($border_widths as $width) {
            $this->assertContains($content, $width, "Should support border width: {$width}");
        }
        
        // Test border radius options (these are in the PHP HTML)
        $border_radius_values = ['0', '4', '8', '20'];
        foreach ($border_radius_values as $radius) {
            $this->assertContains($content, $radius, "Should support border radius: {$radius}");
        }
        
        $this->endTest();
    }
    
    /**
     * Test action types
     */
    private function testActionTypes() {
        $this->startTest("Action Types");
        
        $plugin_file = $this->plugin_dir . '/simple-button-generator.php';
        $content = file_get_contents($plugin_file);
        
        // Test action type options
        $action_types = ['url', 'javascript', 'email', 'phone', 'download', 'form', 'modal', 'scroll'];
        foreach ($action_types as $type) {
            $this->assertContains($content, $type, "Should support action type: {$type}");
        }
        
        // Test action field visibility
        $this->assertContains($content, 'action-url-row', "Should have URL action field");
        $this->assertContains($content, 'action-javascript-row', "Should have JavaScript action field");
        $this->assertContains($content, 'action-email-row', "Should have email action field");
        $this->assertContains($content, 'action-phone-row', "Should have phone action field");
        
        $this->endTest();
    }
    
    /**
     * Test analytics integration
     */
    private function testAnalyticsIntegration() {
        $this->startTest("Analytics Integration");
        
        $plugin_file = $this->plugin_dir . '/simple-button-generator.php';
        $content = file_get_contents($plugin_file);
        
        // Test tracking options
        $tracking_types = ['none', 'google-analytics', 'facebook-pixel', 'custom'];
        foreach ($tracking_types as $type) {
            $this->assertContains($content, $type, "Should support tracking type: {$type}");
        }
        
        // Test tracking code generation
        $this->assertContains($content, 'gtag', "Should support Google Analytics");
        $this->assertContains($content, 'fbq', "Should support Facebook Pixel");
        
        $this->endTest();
    }
    
    /**
     * Start a test group
     */
    private function startTest($test_name) {
        echo "\n🧪 Testing: {$test_name}\n";
        $this->current_test = $test_name;
    }
    
    /**
     * End a test group
     */
    private function endTest() {
        echo "\n";
    }
    
    /**
     * Assert that content contains a string
     */
    private function assertContains($content, $needle, $message) {
        if (strpos($content, $needle) !== false) {
            $this->passTest($message);
        } else {
            $this->failTest($message);
        }
    }
    
    /**
     * Pass a test
     */
    private function passTest($message) {
        echo "✅ {$message}\n";
        $this->passed_tests++;
    }
    
    /**
     * Fail a test
     */
    private function failTest($message) {
        echo "❌ {$message}\n";
        $this->failed_tests++;
        $this->test_results[] = "FAILED: {$this->current_test} - {$message}";
    }
    
    /**
     * Display test results
     */
    private function displayResults() {
        $total_tests = $this->passed_tests + $this->failed_tests;
        $pass_rate = $total_tests > 0 ? round(($this->passed_tests / $total_tests) * 100, 2) : 0;
        
        echo "\n" . str_repeat('=', 60) . "\n";
        echo "📊 Standalone Test Results Summary\n";
        echo str_repeat('=', 60) . "\n";
        echo "Total Tests: {$total_tests}\n";
        echo "Passed: {$this->passed_tests}\n";
        echo "Failed: {$this->failed_tests}\n";
        echo "Pass Rate: {$pass_rate}%\n";
        
        if ($this->failed_tests > 0) {
            echo "\n❌ Failed Tests:\n";
            foreach ($this->test_results as $result) {
                echo "• {$result}\n";
            }
        }
        
        if ($this->failed_tests === 0) {
            echo "\n🎉 All standalone tests passed! The plugin structure is correct.\n";
        }
        
        echo "\n" . str_repeat('=', 60) . "\n";
    }
}

// Run tests if this file is accessed directly
if (basename($_SERVER['PHP_SELF']) === 'standalone-tests.php') {
    $test_suite = new StandaloneButtonGeneratorTests();
    $test_suite->runAllTests();
}
?>
