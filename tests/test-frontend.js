/**
 * Simple Button Generator - Frontend Test Suite
 * 
 * This file contains JavaScript tests to ensure all frontend functionality works correctly
 * and that changes don't break existing features.
 * 
 * Usage: Include this file in the admin page and run tests via browser console
 */

class SimpleButtonGeneratorFrontendTests {
    
    constructor() {
        this.testResults = [];
        this.passedTests = 0;
        this.failedTests = 0;
    }
    
    /**
     * Run all frontend tests
     */
    runAllTests() {
        console.log('🧪 Starting Simple Button Generator Frontend Tests...');
        console.log('='.repeat(60));
        
        this.testColorPickers();
        this.testBorderControls();
        this.testFontFamilySelection();
        this.testBoxShadowSelection();
        this.testActionTypeSwitching();
        this.testLivePreview();
        this.testFormValidation();
        this.testAJAXSubmission();
        
        this.displayResults();
    }
    
    /**
     * Test color picker functionality
     */
    testColorPickers() {
        console.log('\n🎨 Testing Color Pickers...');
        
        // Test button color picker
        this.testElementExists('#custom-color-picker', 'Button color picker should exist');
        this.testElementExists('#apply-custom-color', 'Apply button color button should exist');
        
        // Test text color picker
        this.testElementExists('#custom-text-color-picker', 'Text color picker should exist');
        this.testElementExists('#apply-custom-text-color', 'Apply text color button should exist');
        
        // Test border color picker
        this.testElementExists('#custom-border-color-picker', 'Border color picker should exist');
        this.testElementExists('#apply-custom-border-color', 'Apply border color button should exist');
        
        // Test color picker functionality
        this.testColorPickerFunctionality('#custom-color-picker', 'Button color picker should work');
        this.testColorPickerFunctionality('#custom-text-color-picker', 'Text color picker should work');
        this.testColorPickerFunctionality('#custom-border-color-picker', 'Border color picker should work');
    }
    
    /**
     * Test border controls
     */
    testBorderControls() {
        console.log('\n🔲 Testing Border Controls...');
        
        // Test border style dropdown
        this.testElementExists('#border-style', 'Border style dropdown should exist');
        this.testDropdownOptions('#border-style', ['none', 'solid', 'dashed', 'dotted', 'double'], 'Border style options');
        
        // Test border width dropdown
        this.testElementExists('#border-width', 'Border width dropdown should exist');
        this.testDropdownOptions('#border-width', ['1px', '2px', '3px', '4px', '5px'], 'Border width options');
        
        // Test border radius radio buttons
        this.testElementExists('input[name="border_radius"]', 'Border radius radio buttons should exist');
        this.testRadioButtons('input[name="border_radius"]', ['0', '4', '8', '20'], 'Border radius options');
    }
    
    /**
     * Test font family selection
     */
    testFontFamilySelection() {
        console.log('\n🔤 Testing Font Family Selection...');
        
        this.testElementExists('#font-family', 'Font family dropdown should exist');
        
        const expectedFonts = [
            'Arial, sans-serif',
            'Helvetica, sans-serif',
            'Georgia, serif',
            'Times New Roman, serif',
            'Verdana, sans-serif',
            'Tahoma, sans-serif',
            'Trebuchet MS, sans-serif',
            'Impact, sans-serif',
            'Courier New, monospace'
        ];
        
        this.testDropdownOptions('#font-family', expectedFonts, 'Font family options');
    }
    
    /**
     * Test box shadow selection
     */
    testBoxShadowSelection() {
        console.log('\n🌫️ Testing Box Shadow Selection...');
        
        this.testElementExists('#box-shadow', 'Box shadow dropdown should exist');
        
        const expectedShadows = ['none', 'subtle', 'medium', 'strong', 'glow', 'inset'];
        this.testDropdownOptions('#box-shadow', expectedShadows, 'Box shadow options');
    }
    
    /**
     * Test action type switching
     */
    testActionTypeSwitching() {
        console.log('\n⚡ Testing Action Type Switching...');
        
        this.testElementExists('#button-action-type', 'Action type dropdown should exist');
        
        const expectedActions = ['url', 'javascript', 'email', 'phone', 'download', 'form', 'modal', 'scroll'];
        this.testDropdownOptions('#button-action-type', expectedActions, 'Action type options');
        
        // Test that action fields show/hide correctly
        this.testActionFieldVisibility();
    }
    
    /**
     * Test live preview functionality
     */
    testLivePreview() {
        console.log('\n👁️ Testing Live Preview...');
        
        this.testElementExists('#floating-preview-container', 'Floating preview container should exist');
        this.testElementExists('#toggle-preview', 'Toggle preview button should exist');
        
        // Test that preview updates when controls change
        this.testLivePreviewUpdates();
    }
    
    /**
     * Test form validation
     */
    testFormValidation() {
        console.log('\n✅ Testing Form Validation...');
        
        this.testElementExists('#button-title', 'Button title field should exist');
        this.testElementExists('#button-action', 'Button action field should exist');
        this.testElementExists('#button-generator-form', 'Main form should exist');
        
        // Test required fields
        this.testRequiredFields();
    }
    
    /**
     * Test AJAX submission
     */
    testAJAXSubmission() {
        console.log('\n📡 Testing AJAX Submission...');
        
        this.testElementExists('#button-generator-form', 'Form should exist for AJAX submission');
        
        // Test that form data is properly collected
        this.testFormDataCollection();
    }
    
    /**
     * Test if element exists
     */
    testElementExists(selector, message) {
        const element = document.querySelector(selector);
        if (element) {
            this.passTest(message);
        } else {
            this.failTest(message);
        }
    }
    
    /**
     * Test dropdown options
     */
    testDropdownOptions(selector, expectedOptions, message) {
        const dropdown = document.querySelector(selector);
        if (!dropdown) {
            this.failTest(`${message} - Dropdown not found`);
            return;
        }
        
        const options = Array.from(dropdown.options).map(option => option.value);
        const hasAllOptions = expectedOptions.every(option => options.includes(option));
        
        if (hasAllOptions) {
            this.passTest(`${message} - All expected options present`);
        } else {
            this.failTest(`${message} - Missing expected options`);
        }
    }
    
    /**
     * Test radio buttons
     */
    testRadioButtons(selector, expectedValues, message) {
        const radios = document.querySelectorAll(selector);
        if (radios.length === 0) {
            this.failTest(`${message} - No radio buttons found`);
            return;
        }
        
        const values = Array.from(radios).map(radio => radio.value);
        const hasAllValues = expectedValues.every(value => values.includes(value));
        
        if (hasAllValues) {
            this.passTest(`${message} - All expected values present`);
        } else {
            this.failTest(`${message} - Missing expected values`);
        }
    }
    
    /**
     * Test color picker functionality
     */
    testColorPickerFunctionality(selector, message) {
        const colorPicker = document.querySelector(selector);
        if (!colorPicker) {
            this.failTest(`${message} - Color picker not found`);
            return;
        }
        
        // Test that it's a color input
        if (colorPicker.type === 'color') {
            this.passTest(`${message} - Is a valid color input`);
        } else {
            this.failTest(`${message} - Is not a color input`);
        }
    }
    
    /**
     * Test action field visibility
     */
    testActionFieldVisibility() {
        const actionType = document.querySelector('#button-action-type');
        if (!actionType) {
            this.failTest('Action type dropdown not found for visibility test');
            return;
        }
        
        // Test that action fields exist
        const actionFields = [
            '#action-url-row',
            '#action-javascript-row',
            '#action-email-row',
            '#action-phone-row',
            '#action-download-row',
            '#action-form-row',
            '#action-modal-row',
            '#action-scroll-row'
        ];
        
        let allFieldsExist = true;
        actionFields.forEach(field => {
            if (!document.querySelector(field)) {
                allFieldsExist = false;
            }
        });
        
        if (allFieldsExist) {
            this.passTest('All action field rows exist');
        } else {
            this.failTest('Some action field rows are missing');
        }
    }
    
    /**
     * Test live preview updates
     */
    testLivePreviewUpdates() {
        const previewContainer = document.querySelector('#floating-preview-container');
        if (!previewContainer) {
            this.failTest('Preview container not found for update test');
            return;
        }
        
        // Test that preview container has content
        if (previewContainer.innerHTML.trim() !== '') {
            this.passTest('Live preview container has content');
        } else {
            this.failTest('Live preview container is empty');
        }
    }
    
    /**
     * Test required fields
     */
    testRequiredFields() {
        const titleField = document.querySelector('#button-title');
        const actionField = document.querySelector('#button-action');
        
        if (titleField && actionField) {
            this.passTest('Required fields (title and action) exist');
        } else {
            this.failTest('Required fields are missing');
        }
    }
    
    /**
     * Test form data collection
     */
    testFormDataCollection() {
        const form = document.querySelector('#button-generator-form');
        if (!form) {
            this.failTest('Form not found for data collection test');
            return;
        }
        
        // Test that form has submit event handler
        const hasSubmitHandler = jQuery._data(form, 'events') && jQuery._data(form, 'events').submit;
        
        if (hasSubmitHandler) {
            this.passTest('Form has submit event handler');
        } else {
            this.failTest('Form missing submit event handler');
        }
    }
    
    /**
     * Pass a test
     */
    passTest(message) {
        console.log(`✅ ${message}`);
        this.passedTests++;
    }
    
    /**
     * Fail a test
     */
    failTest(message) {
        console.log(`❌ ${message}`);
        this.failedTests++;
        this.testResults.push(message);
    }
    
    /**
     * Display test results
     */
    displayResults() {
        const totalTests = this.passedTests + this.failedTests;
        const passRate = totalTests > 0 ? Math.round((this.passedTests / totalTests) * 100) : 0;
        
        console.log('\n' + '='.repeat(60));
        console.log('📊 Frontend Test Results Summary');
        console.log('='.repeat(60));
        console.log(`Total Tests: ${totalTests}`);
        console.log(`Passed: ${this.passedTests}`);
        console.log(`Failed: ${this.failedTests}`);
        console.log(`Pass Rate: ${passRate}%`);
        
        if (this.failedTests > 0) {
            console.log('\n❌ Failed Tests:');
            this.testResults.forEach(result => {
                console.log(`• ${result}`);
            });
        }
        
        if (this.failedTests === 0) {
            console.log('\n🎉 All frontend tests passed! The plugin frontend is working correctly.');
        }
        
        console.log('\n' + '='.repeat(60));
    }
}

// Auto-run tests if this file is loaded in the admin page
if (typeof jQuery !== 'undefined' && document.querySelector('#button-generator-form')) {
    // Wait for DOM to be ready
    jQuery(document).ready(function($) {
        // Run tests after a short delay to ensure everything is loaded
        setTimeout(() => {
            const frontendTests = new SimpleButtonGeneratorFrontendTests();
            frontendTests.runAllTests();
        }, 1000);
    });
}

// Make tests available globally for manual running
window.SimpleButtonGeneratorTests = SimpleButtonGeneratorFrontendTests;
