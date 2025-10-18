<?php
/**
 * Plugin Name: Simple Button Generator
 * Plugin URI: https://wordpress.org/plugins/simple-button-generator/
 * Description: Generate professional customizable buttons with multiple sizes, colors, and styles. Includes analytics tracking, live preview, and custom CSS support. Download HTML files for any website.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-button-generator
 * Domain Path: /languages
 * Requires at least: 4.0
 * Tested up to: 6.4
 * Requires PHP: 5.6
 * Network: false
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class SimpleButtonGenerator {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_generate_button', array($this, 'generate_button_ajax'));
    }
    
    public function add_admin_menu() {
        add_options_page(
            'Simple Button Generator',
            'Button Generator',
            'manage_options',
            'simple-button-generator',
            array($this, 'admin_page')
        );
    }
    
    public function enqueue_admin_scripts($hook) {
        if ($hook != 'settings_page_simple-button-generator') {
            return;
        }
        
        wp_enqueue_style('simple-button-generator-admin', plugin_dir_url(__FILE__) . 'admin-style.css', array(), '1.0.0');
        wp_enqueue_script('simple-button-generator-admin', plugin_dir_url(__FILE__) . 'admin-script.js', array('jquery'), '1.0.0', true);
        
        wp_localize_script('simple-button-generator-admin', 'buttonGenerator', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('button_generator_nonce')
        ));
    }
    
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1>Simple Button Generator</h1>
            <p>Generate customizable buttons that your customers can download and use on their websites.</p>
            
            <div class="notice notice-info">
                <p><strong>💡 Pro Tip:</strong> Use this tool to create call-to-action buttons, download links, or any custom buttons for your websites. The generated HTML files work on any website, not just WordPress!</p>
            </div>
            
            <div class="button-generator-container">
                <form id="button-generator-form">
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="button-title">Button Title</label>
                            </th>
                            <td>
                                <input type="text" id="button-title" name="button_title" class="regular-text" placeholder="Click Me" value="Click Me" required>
                                <p class="description">The text that will appear on the button</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="button-action">Button Action</label>
                            </th>
                            <td>
                                <input type="url" id="button-action" name="button_action" class="regular-text" placeholder="https://example.com" required>
                                <p class="description">The URL the button will link to</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="button-size">Button Size</label>
                            </th>
                            <td>
                                <select id="button-size" name="button_size">
                                    <option value="small">Small</option>
                                    <option value="medium" selected>Medium (Default)</option>
                                    <option value="large">Large</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <p class="description">Choose a predefined size or select custom for manual CSS</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="button-color">Button Color</label>
                            </th>
                            <td>
                                <select id="button-color" name="button_color">
                                    <option value="blue" selected>Blue (Default)</option>
                                    <option value="green">Green</option>
                                    <option value="red">Red</option>
                                    <option value="orange">Orange</option>
                                    <option value="purple">Purple</option>
                                    <option value="custom">Custom</option>
                                </select>
                                <p class="description">Choose a predefined color scheme</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="button-tracking">Analytics Tracking</label>
                            </th>
                            <td>
                                <select id="button-tracking" name="button_tracking">
                                    <option value="none">No Tracking</option>
                                    <option value="google-analytics">Google Analytics (gtag)</option>
                                    <option value="google-analytics-ga">Google Analytics (ga)</option>
                                    <option value="facebook-pixel">Facebook Pixel</option>
                                    <option value="custom">Custom Event</option>
                                </select>
                                <p class="description">Add tracking for button clicks to measure performance</p>
                            </td>
                        </tr>
                        <tr id="tracking-event-row" style="display: none;">
                            <th scope="row">
                                <label for="tracking-event">Event ID/Name</label>
                            </th>
                            <td>
                                <input type="text" id="tracking-event" name="tracking_event" class="regular-text" placeholder="button_click" value="button_click">
                                <p class="description">Event name for analytics tracking (e.g., "download_button", "contact_form")</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="custom-css">Custom CSS</label>
                            </th>
                            <td>
                                <textarea id="custom-css" name="custom_css" rows="15" cols="50" class="large-text code" placeholder="/* Custom CSS Examples - Uncomment and modify as needed */

/* Rounded Button */
.simple-button {
    border-radius: 25px;
}

/* Button with Shadow */
.simple-button {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Gradient Background */
.simple-button {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

/* Animated Button */
.simple-button {
    transition: all 0.3s ease;
}
.simple-button:hover {
    transform: scale(1.05);
}

/* Custom Size */
.simple-button {
    padding: 20px 40px;
    font-size: 18px;
}

/* Add your own custom styles below */"></textarea>
                                <p class="description">
                                    <strong>💡 Pro Tips:</strong><br>
                                    • Uncomment any example above to use it<br>
                                    • Combine multiple styles for unique looks<br>
                                    • Use <a href="#" onclick="showCSSExamples(); return false;">CSS Examples Guide</a> for more ideas<br>
                                    • Leave empty to use default styling
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                    <p class="submit">
                        <input type="submit" class="button-primary" value="Generate Button">
                    </p>
                </form>
                
                <div id="button-preview" style="display: none;">
                    <h3>Preview</h3>
                    <div id="preview-container"></div>
                </div>
                
                <div id="download-section" style="display: none;">
                    <h3>Download Your Button</h3>
                    <p>Copy the code below and save it as an HTML file:</p>
                    <textarea id="generated-code" rows="15" cols="80" readonly></textarea>
                    <p>
                        <button type="button" id="download-button" class="button button-secondary">Download HTML File</button>
                        <button type="button" id="copy-code" class="button button-secondary">Copy Code</button>
                    </p>
                </div>
            </div>
            
            <!-- CSS Examples Modal -->
            <div id="css-examples-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999;">
                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 30px; border-radius: 8px; max-width: 800px; max-height: 80vh; overflow-y: auto;">
                    <h2>🎨 CSS Examples Guide</h2>
                    <p>Copy and paste these examples into the Custom CSS field, then modify as needed:</p>
                    
                    <div style="margin: 20px 0;">
                        <h3>📐 Size & Spacing</h3>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>/* Extra Large Button */
.simple-button {
    padding: 20px 40px;
    font-size: 20px;
}

/* Compact Button */
.simple-button {
    padding: 8px 16px;
    font-size: 14px;
}

/* Full Width Button */
.simple-button {
    width: 100%;
    display: block;
}</code></pre>
                    </div>
                    
                    <div style="margin: 20px 0;">
                        <h3>🎨 Colors & Backgrounds</h3>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>/* Gradient Background */
.simple-button {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

/* Two-Tone Button */
.simple-button {
    background: linear-gradient(to right, #ff6b6b 50%, #4ecdc4 50%);
}

/* Transparent Button with Border */
.simple-button {
    background: transparent;
    border: 2px solid #0073aa;
    color: #0073aa;
}</code></pre>
                    </div>
                    
                    <div style="margin: 20px 0;">
                        <h3>🔘 Shapes & Borders</h3>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>/* Fully Rounded Button */
.simple-button {
    border-radius: 25px;
}

/* Pill-Shaped Button */
.simple-button {
    border-radius: 50px;
}

/* Square Button */
.simple-button {
    border-radius: 0;
}

/* Custom Border */
.simple-button {
    border: 3px solid #333;
}</code></pre>
                    </div>
                    
                    <div style="margin: 20px 0;">
                        <h3>✨ Effects & Animations</h3>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>/* Shadow Effect */
.simple-button {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Glow Effect */
.simple-button {
    box-shadow: 0 0 20px rgba(0, 123, 170, 0.5);
}

/* Scale Animation */
.simple-button:hover {
    transform: scale(1.1);
}

/* Bounce Animation */
.simple-button:hover {
    animation: bounce 0.6s;
}
@keyframes bounce {
    0%, 20%, 60%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    80% { transform: translateY(-5px); }
}</code></pre>
                    </div>
                    
                    <div style="margin: 20px 0;">
                        <h3>🎯 Business-Specific Styles</h3>
                        <pre style="background: #f5f5f5; padding: 15px; border-radius: 4px; overflow-x: auto;"><code>/* E-commerce "Buy Now" */
.simple-button {
    background: #28a745;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
}

/* Contact/Support Button */
.simple-button {
    background: #17a2b8;
    border-radius: 20px;
    padding: 12px 30px;
}

/* Download Button */
.simple-button {
    background: #6c757d;
    border-radius: 4px;
    position: relative;
}
.simple-button::after {
    content: " ⬇";
}</code></pre>
                    </div>
                    
                    <div style="text-align: center; margin-top: 30px;">
                        <button onclick="closeCSSExamples();" class="button button-primary">Close Guide</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    
    public function generate_button_ajax() {
        check_ajax_referer('button_generator_nonce', 'nonce');
        
        $button_title = sanitize_text_field($_POST['button_title']);
        $button_action = esc_url_raw($_POST['button_action']);
        $button_size = sanitize_text_field($_POST['button_size']);
        $button_color = sanitize_text_field($_POST['button_color']);
        $button_tracking = sanitize_text_field($_POST['button_tracking']);
        $tracking_event = sanitize_text_field($_POST['tracking_event']);
        $custom_css = wp_strip_all_tags($_POST['custom_css']);
        
        // Size CSS
        $size_css = $this->get_size_css($button_size);
        
        // Color CSS
        $color_css = $this->get_color_css($button_color);
        
        // Base CSS
        $base_css = '
.simple-button {
    display: inline-block;
    text-decoration: none;
    border-radius: 4px;
    font-family: Arial, sans-serif;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    box-sizing: border-box;
}

.simple-button:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.simple-button:focus {
    outline: 2px solid currentColor;
    outline-offset: 2px;
}
';
        
        $default_css = $base_css . $size_css . $color_css;
        
        $final_css = $default_css . "\n" . $custom_css;
        
        // Generate tracking code
        $tracking_code = $this->get_tracking_code($button_tracking, $tracking_event, $button_title);
        
        $html_code = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Button</title>
    <style>
' . $final_css . '
    </style>
</head>
<body>
    <div style="padding: 20px; text-align: center;">
        <a href="' . $button_action . '" class="simple-button" onclick="' . $tracking_code . '">' . esc_html($button_title) . '</a>
    </div>
</body>
</html>';
        
        wp_send_json_success(array(
            'html_code' => $html_code,
            'preview_html' => '<a href="' . $button_action . '" class="simple-button">' . esc_html($button_title) . '</a>',
            'css' => $final_css
        ));
    }
    
    private function get_size_css($size) {
        switch ($size) {
            case 'small':
                return '
.simple-button {
    padding: 8px 16px;
    font-size: 14px;
}';
            case 'large':
                return '
.simple-button {
    padding: 16px 32px;
    font-size: 18px;
}';
            case 'custom':
                return '';
            default: // medium
                return '
.simple-button {
    padding: 12px 24px;
    font-size: 16px;
}';
        }
    }
    
    private function get_color_css($color) {
        switch ($color) {
            case 'green':
                return '
.simple-button {
    background-color: #28a745;
    color: white;
}
.simple-button:hover {
    background-color: #218838;
}';
            case 'red':
                return '
.simple-button {
    background-color: #dc3545;
    color: white;
}
.simple-button:hover {
    background-color: #c82333;
}';
            case 'orange':
                return '
.simple-button {
    background-color: #fd7e14;
    color: white;
}
.simple-button:hover {
    background-color: #e8650e;
}';
            case 'purple':
                return '
.simple-button {
    background-color: #6f42c1;
    color: white;
}
.simple-button:hover {
    background-color: #5a32a3;
}';
            case 'custom':
                return '';
            default: // blue
                return '
.simple-button {
    background-color: #0073aa;
    color: white;
}
.simple-button:hover {
    background-color: #005a87;
}';
        }
    }
    
    private function get_tracking_code($tracking_type, $event_name, $button_title) {
        if ($tracking_type === 'none') {
            return '';
        }
        
        $event_name = !empty($event_name) ? $event_name : 'button_click';
        $button_title_safe = esc_js($button_title);
        
        switch ($tracking_type) {
            case 'google-analytics':
                return "gtag('event', '" . esc_js($event_name) . "', {'event_category': 'button', 'event_label': '" . $button_title_safe . "'});";
                
            case 'google-analytics-ga':
                return "ga('send', 'event', 'button', '" . esc_js($event_name) . "', '" . $button_title_safe . "');";
                
            case 'facebook-pixel':
                return "fbq('track', 'Lead', {content_name: '" . $button_title_safe . "', content_category: 'button'});";
                
            case 'custom':
                return "console.log('Button clicked: " . $button_title_safe . "'); // Custom tracking - replace with your analytics code";
                
            default:
                return '';
        }
    }
}

// Initialize the plugin
new SimpleButtonGenerator();
