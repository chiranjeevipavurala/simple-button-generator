<?php
/**
 * Plugin Name: Simple Button Generator
 * Plugin URI: https://wordpress.org/plugins/simple-button-generator/
 * Description: Generate professional customizable buttons with flexible actions (URLs, JavaScript, email, phone, downloads, forms, modals, scroll). Includes analytics tracking, live preview, and custom CSS support. Download HTML files for any website.
 * Version: 1.0.0
 * Author: chiranjeevi pavurala
 * Author URI: https://github.com/chiranjeevipavurala/simple-button-generator
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-button-generator
 * Domain Path: /languages
 * Requires at least: 4.0
 * Tested up to: 6.5
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
            
            <!-- Floating Preview Panel -->
            <div id="floating-preview" class="floating-preview-panel">
                <div class="preview-header">
                    <h3>Live Preview</h3>
                    <button type="button" id="toggle-preview" class="toggle-preview-btn">−</button>
                </div>
                <div class="preview-content">
                    <div id="floating-preview-container">
                        <div class="preview-placeholder">
                            <p>Enter button title and action to see preview</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="notice notice-info">
                <p><strong>💡 Pro Tip:</strong> Use this tool to create call-to-action buttons, download links, or any custom buttons for your websites. The generated HTML files work on any website, not just WordPress!</p>
            </div>
            
            <div class="button-generator-container">
                <form id="button-generator-form">
                    <table class="form-table">
                        <!-- Button Text & Content Section -->
                        <tr class="section-header">
                            <th colspan="2">
                                <h3 class="section-title">📝 Button Text & Content</h3>
                                <p class="section-description">Configure the button text and action</p>
                            </th>
                        </tr>
                        
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
                                <label for="button-action-type">Button Action Type</label>
                            </th>
                            <td>
                                <select id="button-action-type" name="button_action_type">
                                    <option value="url">Link to URL</option>
                                    <option value="javascript">JavaScript Function</option>
                                    <option value="email">Email Link</option>
                                    <option value="phone">Phone Call</option>
                                    <option value="download">File Download</option>
                                    <option value="form">Form Submission</option>
                                    <option value="modal">Open Modal/Popup</option>
                                    <option value="scroll">Scroll to Element</option>
                                </select>
                                <p class="description">Choose what the button should do when clicked</p>
                            </td>
                        </tr>
                        <tr id="action-url-row">
                            <th scope="row">
                                <label for="button-action">URL/Link</label>
                            </th>
                            <td>
                                <input type="url" id="button-action" name="button_action" class="regular-text" placeholder="https://example.com">
                                <p class="description">The URL the button will link to</p>
                            </td>
                        </tr>
                        <tr id="action-javascript-row" style="display: none;">
                            <th scope="row">
                                <label for="button-javascript">JavaScript Function</label>
                            </th>
                            <td>
                                <input type="text" id="button-javascript" name="button_javascript" class="regular-text" placeholder="myFunction()">
                                <p class="description">JavaScript function to call (e.g., "openModal()", "submitForm()")</p>
                            </td>
                        </tr>
                        <tr id="action-email-row" style="display: none;">
                            <th scope="row">
                                <label for="button-email">Email Address</label>
                            </th>
                            <td>
                                <input type="email" id="button-email" name="button_email" class="regular-text" placeholder="contact@example.com">
                                <p class="description">Email address to open in default email client</p>
                            </td>
                        </tr>
                        <tr id="action-phone-row" style="display: none;">
                            <th scope="row">
                                <label for="button-phone">Phone Number</label>
                            </th>
                            <td>
                                <input type="tel" id="button-phone" name="button_phone" class="regular-text" placeholder="+1234567890">
                                <p class="description">Phone number to call (mobile devices will initiate call)</p>
                            </td>
                        </tr>
                        <tr id="action-download-row" style="display: none;">
                            <th scope="row">
                                <label for="button-download">File URL</label>
                            </th>
                            <td>
                                <input type="url" id="button-download" name="button_download" class="regular-text" placeholder="https://example.com/file.pdf">
                                <p class="description">URL of file to download</p>
                            </td>
                        </tr>
                        <tr id="action-form-row" style="display: none;">
                            <th scope="row">
                                <label for="button-form">Form ID</label>
                            </th>
                            <td>
                                <input type="text" id="button-form" name="button_form" class="regular-text" placeholder="contact-form">
                                <p class="description">ID of the form to submit</p>
                            </td>
                        </tr>
                        <tr id="action-modal-row" style="display: none;">
                            <th scope="row">
                                <label for="button-modal">Modal ID</label>
                            </th>
                            <td>
                                <input type="text" id="button-modal" name="button_modal" class="regular-text" placeholder="myModal">
                                <p class="description">ID of the modal/popup to open</p>
                            </td>
                        </tr>
                        <tr id="action-scroll-row" style="display: none;">
                            <th scope="row">
                                <label for="button-scroll">Element ID</label>
                            </th>
                            <td>
                                <input type="text" id="button-scroll" name="button_scroll" class="regular-text" placeholder="contact-section">
                                <p class="description">ID of the element to scroll to</p>
                            </td>
                        </tr>
                        
                        <!-- Button Appearance Section -->
                        <tr class="section-header">
                            <th colspan="2">
                                <h3 class="section-title">🎨 Button Appearance</h3>
                                <p class="section-description">Customize the visual style of your button</p>
                            </th>
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
                                    <option value="responsive-small">📱 Responsive Small</option>
                                    <option value="responsive-medium">📱 Responsive Medium</option>
                                    <option value="responsive-large">📱 Responsive Large</option>
                                    <option value="responsive-extra-large">📱 Responsive Extra Large</option>
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
                                <!-- Custom Color Picker -->
                                <div class="custom-color-section" style="margin-top: 10px;">
                                    <input type="color" id="custom-color-picker" value="#0073aa" style="width: 50px; height: 30px; border: none; border-radius: 4px; cursor: pointer;">
                                    <button type="button" id="apply-custom-color" class="button button-small">Apply Color</button>
                                    <p class="description">Choose any color for your button background</p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="text-color">Text Color</label>
                            </th>
                            <td>
                                <!-- Custom Text Color Picker -->
                                <div class="custom-color-section" style="margin-top: 10px;">
                                    <input type="color" id="custom-text-color-picker" value="#ffffff" style="width: 50px; height: 30px; border: none; border-radius: 4px; cursor: pointer;">
                                    <button type="button" id="apply-custom-text-color" class="button button-small">Apply Text Color</button>
                                    <p class="description">Choose any color for your button text</p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="font-family">Font Family</label>
                            </th>
                            <td>
                                <select id="font-family" name="font_family">
                                    <option value="Arial, sans-serif" selected>Arial (Default)</option>
                                    <option value="Helvetica, sans-serif">Helvetica</option>
                                    <option value="Georgia, serif">Georgia</option>
                                    <option value="Times New Roman, serif">Times New Roman</option>
                                    <option value="Verdana, sans-serif">Verdana</option>
                                    <option value="Tahoma, sans-serif">Tahoma</option>
                                    <option value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                    <option value="Impact, sans-serif">Impact</option>
                                    <option value="Courier New, monospace">Courier New</option>
                                </select>
                                <p class="description">Choose the font family for your button text</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="box-shadow">Box Shadow</label>
                            </th>
                            <td>
                                <select id="box-shadow" name="box_shadow">
                                    <option value="none" selected>None</option>
                                    <option value="subtle">Subtle (2px 2px 4px rgba(0,0,0,0.1))</option>
                                    <option value="medium">Medium (4px 4px 8px rgba(0,0,0,0.15))</option>
                                    <option value="strong">Strong (6px 6px 12px rgba(0,0,0,0.2))</option>
                                    <option value="glow">Glow (0 0 10px rgba(0,115,170,0.5))</option>
                                    <option value="inset">Inset (inset 0 2px 4px rgba(0,0,0,0.1))</option>
                                </select>
                                <p class="description">Add shadow effects to your button</p>
                            </td>
                        </tr>
                        
                        <!-- Border Options Section -->
                        <tr class="section-header">
                            <th colspan="2">
                                <h3 class="section-title">🔲 Border Options</h3>
                                <p class="section-description">Add borders and customize corner styles</p>
                            </th>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="border-style">Border Style</label>
                            </th>
                            <td>
                                <select id="border-style" name="border_style">
                                    <option value="none" selected>None</option>
                                    <option value="solid">Solid</option>
                                    <option value="dashed">Dashed</option>
                                    <option value="dotted">Dotted</option>
                                    <option value="double">Double</option>
                                </select>
                                <p class="description">Choose the border style for your button</p>
                                
                                <!-- Border Style Visual Examples -->
                                <div class="border-style-examples" style="margin-top: 15px;">
                                    <h4 style="margin: 10px 0 5px 0; font-size: 14px;">Border Style Examples:</h4>
                                    <div class="border-examples-grid">
                                        <div class="border-example" data-style="none">
                                            <div class="border-preview" style="border: none; background: #f0f0f0; color: #666;">
                                                <span>None</span>
                                            </div>
                                            <label>None</label>
                                        </div>
                                        <div class="border-example" data-style="solid">
                                            <div class="border-preview" style="border: 2px solid #333;">
                                                <span>Solid</span>
                                            </div>
                                            <label>Solid</label>
                                        </div>
                                        <div class="border-example" data-style="dashed">
                                            <div class="border-preview" style="border: 2px dashed #333;">
                                                <span>Dashed</span>
                                            </div>
                                            <label>Dashed</label>
                                        </div>
                                        <div class="border-example" data-style="dotted">
                                            <div class="border-preview" style="border: 2px dotted #333;">
                                                <span>Dotted</span>
                                            </div>
                                            <label>Dotted</label>
                                        </div>
                                        <div class="border-example" data-style="double">
                                            <div class="border-preview" style="border: 4px double #333;">
                                                <span>Double</span>
                                            </div>
                                            <label>Double</label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                        <tr id="border-width-row" style="display: none;">
                            <th scope="row">
                                <label for="border-width">Border Width</label>
                            </th>
                            <td>
                                <select id="border-width" name="border_width">
                                    <option value="1px" selected>1px (Thin)</option>
                                    <option value="2px">2px (Medium)</option>
                                    <option value="3px">3px (Thick)</option>
                                    <option value="4px">4px (Extra Thick)</option>
                                    <option value="5px">5px (Very Thick)</option>
                                </select>
                                <p class="description">Choose the thickness of the border</p>
                            </td>
                        </tr>
                        
                        <tr id="border-color-row" style="display: none;">
                            <th scope="row">
                                <label for="border-color">Border Color</label>
                            </th>
                            <td>
                                <!-- Custom Border Color Picker -->
                                <div class="custom-color-section" style="margin-top: 10px;">
                                    <input type="color" id="custom-border-color-picker" value="#000000" style="width: 50px; height: 30px; border: none; border-radius: 4px; cursor: pointer;">
                                    <button type="button" id="apply-custom-border-color" class="button button-small">Apply Border Color</button>
                                    <p class="description">Choose any color for your button border</p>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="border-radius">Corner Style</label>
                            </th>
                            <td>
                                <div class="radius-options">
                                    <label class="radius-option">
                                        <input type="radio" name="border_radius" value="0" checked>
                                        <span class="radius-preview" style="border-radius: 0px;">Square</span>
                                    </label>
                                    <label class="radius-option">
                                        <input type="radio" name="border_radius" value="4">
                                        <span class="radius-preview" style="border-radius: 4px;">Rounded</span>
                                    </label>
                                    <label class="radius-option">
                                        <input type="radio" name="border_radius" value="8">
                                        <span class="radius-preview" style="border-radius: 8px;">More Rounded</span>
                                    </label>
                                    <label class="radius-option">
                                        <input type="radio" name="border_radius" value="20">
                                        <span class="radius-preview" style="border-radius: 20px;">Pill</span>
                                    </label>
                                </div>
                                <p class="description">Choose the corner style for your button</p>
                            </td>
                        </tr>
                        
                        <!-- Advanced Options Section -->
                        <tr class="section-header">
                            <th colspan="2">
                                <h3 class="section-title">⚙️ Advanced Options</h3>
                                <p class="section-description">Analytics tracking and custom styling</p>
                            </th>
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
        $button_action_type = sanitize_text_field($_POST['button_action_type']);
        $button_action = sanitize_text_field($_POST['button_action']);
        $button_javascript = sanitize_text_field($_POST['button_javascript']);
        $button_email = sanitize_email($_POST['button_email']);
        $button_phone = sanitize_text_field($_POST['button_phone']);
        $button_download = esc_url_raw($_POST['button_download']);
        $button_form = sanitize_text_field($_POST['button_form']);
        $button_modal = sanitize_text_field($_POST['button_modal']);
        $button_scroll = sanitize_text_field($_POST['button_scroll']);
        $button_size = sanitize_text_field($_POST['button_size']);
        $button_color = sanitize_text_field($_POST['button_color']);
        $font_family = sanitize_text_field($_POST['font_family']);
        $box_shadow = sanitize_text_field($_POST['box_shadow']);
        $border_style = sanitize_text_field($_POST['border_style']);
        $border_width = sanitize_text_field($_POST['border_width']);
        $border_color = sanitize_text_field($_POST['border_color']);
        $border_radius = sanitize_text_field($_POST['border_radius']);
        $button_tracking = sanitize_text_field($_POST['button_tracking']);
        $tracking_event = sanitize_text_field($_POST['tracking_event']);
        $custom_css = wp_strip_all_tags($_POST['custom_css']);
        
        // Size CSS
        $size_css = $this->get_size_css($button_size);
        
        // Border CSS
        $border_css = $this->get_border_css($border_style, $border_width, $border_color, $border_radius);
        
        // Box shadow CSS
        $shadow_css = $this->get_box_shadow_css($box_shadow);
        
        // Base CSS
        $base_css = '
.simple-button {
    display: inline-block;
    text-decoration: none;
    border-radius: 4px;
    font-family: ' . esc_attr($font_family) . ';
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
    box-sizing: border-box;
    background-color: #0073aa;
    color: white;
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
        
        $default_css = $base_css . $size_css . $shadow_css . $border_css;
        
        $final_css = $default_css . "\n" . $custom_css;
        
        // Generate action code and tracking code
        $action_code = $this->get_action_code($button_action_type, $button_action, $button_javascript, $button_email, $button_phone, $button_download, $button_form, $button_modal, $button_scroll);
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
        ' . $action_code . '
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
            case 'responsive-small':
                return '
.simple-button {
    padding: 10px 20px;
    font-size: 14px;
    min-height: 44px;
}

@media (max-width: 768px) {
    .simple-button {
        padding: 12px 24px;
        font-size: 16px;
        width: 100%;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .simple-button {
        padding: 11px 22px;
        font-size: 15px;
    }
}';
            case 'responsive-medium':
                return '
.simple-button {
    padding: 12px 24px;
    font-size: 16px;
    min-height: 44px;
}

@media (max-width: 768px) {
    .simple-button {
        padding: 16px 32px;
        font-size: 18px;
        width: 100%;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .simple-button {
        padding: 14px 28px;
        font-size: 17px;
    }
}';
            case 'responsive-large':
                return '
.simple-button {
    padding: 16px 32px;
    font-size: 18px;
    min-height: 48px;
}

@media (max-width: 768px) {
    .simple-button {
        padding: 20px 40px;
        font-size: 20px;
        width: 100%;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .simple-button {
        padding: 18px 36px;
        font-size: 19px;
    }
}';
            case 'responsive-extra-large':
                return '
.simple-button {
    padding: 20px 40px;
    font-size: 20px;
    min-height: 52px;
}

@media (max-width: 768px) {
    .simple-button {
        padding: 24px 48px;
        font-size: 22px;
        width: 100%;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .simple-button {
        padding: 22px 44px;
        font-size: 21px;
    }
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
            case 'navy':
                return '
.simple-button {
    background-color: #2c3e50;
    color: white;
}
.simple-button:hover {
    background-color: #1a252f;
}';
            case 'teal':
                return '
.simple-button {
    background-color: #17a2b8;
    color: white;
}
.simple-button:hover {
    background-color: #138496;
}';
            case 'gray':
                return '
.simple-button {
    background-color: #6c757d;
    color: white;
}
.simple-button:hover {
    background-color: #5a6268;
}';
            case 'dark':
                return '
.simple-button {
    background-color: #343a40;
    color: white;
}
.simple-button:hover {
    background-color: #23272b;
}';
            case 'indigo':
                return '
.simple-button {
    background-color: #6610f2;
    color: white;
}
.simple-button:hover {
    background-color: #520dc2;
}';
            case 'pink':
                return '
.simple-button {
    background-color: #e83e8c;
    color: white;
}
.simple-button:hover {
    background-color: #d91a72;
}';
            case 'cyan':
                return '
.simple-button {
    background-color: #20c997;
    color: white;
}
.simple-button:hover {
    background-color: #1aa179;
}';
            case 'yellow':
                return '
.simple-button {
    background-color: #ffc107;
    color: #212529;
}
.simple-button:hover {
    background-color: #e0a800;
    color: #212529;
}';
            case 'lime':
                return '
.simple-button {
    background-color: #28a745;
    color: white;
}
.simple-button:hover {
    background-color: #218838;
}';
            case 'coral':
                return '
.simple-button {
    background-color: #ff6b6b;
    color: white;
}
.simple-button:hover {
    background-color: #ff5252;
}';
            case 'gradient-blue':
                return '
.simple-button {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #5a6fd8 0%, #6a4190 100%);
}';
            case 'gradient-green':
                return '
.simple-button {
    background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #3d8bfe 0%, #00d4fe 100%);
}';
            case 'gradient-red':
                return '
.simple-button {
    background: linear-gradient(45deg, #fa709a 0%, #fee140 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #f95d8a 0%, #fdd835 100%);
}';
            case 'gradient-purple':
                return '
.simple-button {
    background: linear-gradient(45deg, #a8edea 0%, #fed6e3 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #9ce5e2 0%, #fdc9d7 100%);
}';
            case 'gradient-sunset':
                return '
.simple-button {
    background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #ff8a8e 0%, #fec5ef 100%);
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
    
    private function get_border_css($border_style, $border_width, $border_color, $border_radius) {
        $css = '';
        
        // Border style and width
        if ($border_style !== 'none') {
            $css .= '
.simple-button {
    border-style: ' . esc_attr($border_style) . ';
    border-width: ' . esc_attr($border_width) . ';';
            
            // Border color
            if ($border_color === 'auto') {
                // Auto color will be handled by JavaScript or default to darker shade
                $css .= '
    border-color: rgba(0, 0, 0, 0.2);';
            } elseif ($border_color === 'white') {
                $css .= '
    border-color: #ffffff;';
            } elseif ($border_color === 'black') {
                $css .= '
    border-color: #000000;';
            } elseif ($border_color === 'gray') {
                $css .= '
    border-color: #6c757d;';
            } elseif ($border_color === 'navy') {
                $css .= '
    border-color: #2c3e50;';
            } elseif ($border_color === 'dark') {
                $css .= '
    border-color: #343a40;';
            } elseif ($border_color === 'blue') {
                $css .= '
    border-color: #0073aa;';
            } elseif ($border_color === 'green') {
                $css .= '
    border-color: #28a745;';
            } elseif ($border_color === 'red') {
                $css .= '
    border-color: #dc3545;';
            } elseif ($border_color === 'orange') {
                $css .= '
    border-color: #fd7e14;';
            } elseif ($border_color === 'purple') {
                $css .= '
    border-color: #6f42c1;';
            } elseif ($border_color === 'teal') {
                $css .= '
    border-color: #17a2b8;';
            } else {
                // Custom color - will be handled by custom CSS
                $css .= '
    border-color: #000000;';
            }
            
            $css .= '
}';
        }
        
        // Border radius
        if ($border_radius !== '0') {
            $css .= '
.simple-button {
    border-radius: ' . esc_attr($border_radius) . 'px;
}';
        }
        
        return $css;
    }
    
    private function get_box_shadow_css($box_shadow) {
        $css = '';
        
        if ($box_shadow !== 'none') {
            $shadow_value = '';
            switch ($box_shadow) {
                case 'subtle':
                    $shadow_value = '2px 2px 4px rgba(0,0,0,0.1)';
                    break;
                case 'medium':
                    $shadow_value = '4px 4px 8px rgba(0,0,0,0.15)';
                    break;
                case 'strong':
                    $shadow_value = '6px 6px 12px rgba(0,0,0,0.2)';
                    break;
                case 'glow':
                    $shadow_value = '0 0 10px rgba(0,115,170,0.5)';
                    break;
                case 'inset':
                    $shadow_value = 'inset 0 2px 4px rgba(0,0,0,0.1)';
                    break;
                default:
                    $shadow_value = '2px 2px 4px rgba(0,0,0,0.1)';
            }
            
            $css = '
.simple-button {
    box-shadow: ' . esc_attr($shadow_value) . ';
}';
        }
        
        return $css;
    }
    
    private function get_action_code($action_type, $url, $javascript, $email, $phone, $download, $form, $modal, $scroll) {
        $button_title = esc_html($_POST['button_title']);
        $tracking_code = $this->get_tracking_code($_POST['button_tracking'], $_POST['tracking_event'], $_POST['button_title']);
        
        switch ($action_type) {
            case 'url':
                $href = !empty($url) ? esc_url($url) : '#';
                return '<a href="' . $href . '" class="simple-button" onclick="' . $tracking_code . '">' . $button_title . '</a>';
                
            case 'javascript':
                $js_function = !empty($javascript) ? esc_js($javascript) : 'alert("Button clicked!")';
                $combined_js = $tracking_code . (!empty($tracking_code) ? ' ' : '') . $js_function;
                return '<button type="button" class="simple-button" onclick="' . $combined_js . '">' . $button_title . '</button>';
                
            case 'email':
                $email_address = !empty($email) ? esc_attr($email) : 'contact@example.com';
                $href = 'mailto:' . $email_address;
                return '<a href="' . $href . '" class="simple-button" onclick="' . $tracking_code . '">' . $button_title . '</a>';
                
            case 'phone':
                $phone_number = !empty($phone) ? esc_attr($phone) : '+1234567890';
                $href = 'tel:' . $phone_number;
                return '<a href="' . $href . '" class="simple-button" onclick="' . $tracking_code . '">' . $button_title . '</a>';
                
            case 'download':
                $download_url = !empty($download) ? esc_url($download) : '#';
                $combined_js = $tracking_code . (!empty($tracking_code) ? ' ' : '') . 'window.open("' . esc_js($download_url) . '", "_blank");';
                return '<button type="button" class="simple-button" onclick="' . $combined_js . '">' . $button_title . '</button>';
                
            case 'form':
                $form_id = !empty($form) ? esc_js($form) : 'myForm';
                $combined_js = $tracking_code . (!empty($tracking_code) ? ' ' : '') . 'document.getElementById("' . $form_id . '").submit();';
                return '<button type="button" class="simple-button" onclick="' . $combined_js . '">' . $button_title . '</button>';
                
            case 'modal':
                $modal_id = !empty($modal) ? esc_js($modal) : 'myModal';
                $combined_js = $tracking_code . (!empty($tracking_code) ? ' ' : '') . 'document.getElementById("' . $modal_id . '").style.display = "block";';
                return '<button type="button" class="simple-button" onclick="' . $combined_js . '">' . $button_title . '</button>';
                
            case 'scroll':
                $element_id = !empty($scroll) ? esc_js($scroll) : 'target';
                $combined_js = $tracking_code . (!empty($tracking_code) ? ' ' : '') . 'document.getElementById("' . $element_id . '").scrollIntoView({behavior: "smooth"});';
                return '<button type="button" class="simple-button" onclick="' . $combined_js . '">' . $button_title . '</button>';
                
            default:
                return '<a href="#" class="simple-button" onclick="' . $tracking_code . '">' . $button_title . '</a>';
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
