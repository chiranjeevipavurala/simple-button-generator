jQuery(document).ready(function($) {
    $('#button-generator-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            action: 'generate_button',
            nonce: buttonGenerator.nonce,
            button_title: $('#button-title').val(),
            button_action_type: $('#button-action-type').val(),
            button_action: $('#button-action').val(),
            button_javascript: $('#button-javascript').val(),
            button_email: $('#button-email').val(),
            button_phone: $('#button-phone').val(),
            button_download: $('#button-download').val(),
            button_form: $('#button-form').val(),
            button_modal: $('#button-modal').val(),
            button_scroll: $('#button-scroll').val(),
            button_size: $('#button-size').val(),
            button_color: $('#button-color').val(),
            border_style: $('#border-style').val(),
            border_width: $('#border-width').val(),
            border_color: $('#border-color').val(),
            border_radius: $('input[name="border_radius"]:checked').val(),
            button_tracking: $('#button-tracking').val(),
            tracking_event: $('#tracking-event').val(),
            custom_css: $('#custom-css').val()
        };
        
        // Show loading state
        $('.button-primary').val('Generating...').prop('disabled', true);
        
        $.ajax({
            url: buttonGenerator.ajax_url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Show preview
                    $('#preview-container').html(response.data.preview_html);
                    $('#button-preview').show();
                    
                    // Show download section
                    $('#generated-code').val(response.data.html_code);
                    $('#download-section').show();
                    
                    // Scroll to preview
                    $('html, body').animate({
                        scrollTop: $('#button-preview').offset().top - 100
                    }, 500);
                } else {
                    alert('Error generating button: ' + response.data);
                }
            },
            error: function() {
                alert('An error occurred while generating the button.');
            },
            complete: function() {
                $('.button-primary').val('Generate Button').prop('disabled', false);
            }
        });
    });
    
    // Download button functionality
    $('#download-button').on('click', function() {
        var code = $('#generated-code').val();
        var blob = new Blob([code], { type: 'text/html' });
        var url = window.URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'custom-button.html';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
    });
    
    // Copy code functionality
    $('#copy-code').on('click', function() {
        var codeTextarea = document.getElementById('generated-code');
        codeTextarea.select();
        codeTextarea.setSelectionRange(0, 99999); // For mobile devices
        
        try {
            document.execCommand('copy');
            $(this).text('Copied!');
            setTimeout(function() {
                $('#copy-code').text('Copy Code');
            }, 2000);
        } catch (err) {
            alert('Unable to copy. Please select and copy manually.');
        }
    });
    
        // Show/hide action fields based on action type selection
        $('#button-action-type').on('change', function() {
            var actionType = $(this).val();
            
            // Hide all action rows first
            $('#action-url-row, #action-javascript-row, #action-email-row, #action-phone-row, #action-download-row, #action-form-row, #action-modal-row, #action-scroll-row').hide();
            
            // Show the appropriate row based on selection
            switch(actionType) {
                case 'url':
                    $('#action-url-row').show();
                    break;
                case 'javascript':
                    $('#action-javascript-row').show();
                    break;
                case 'email':
                    $('#action-email-row').show();
                    break;
                case 'phone':
                    $('#action-phone-row').show();
                    break;
                case 'download':
                    $('#action-download-row').show();
                    break;
                case 'form':
                    $('#action-form-row').show();
                    break;
                case 'modal':
                    $('#action-modal-row').show();
                    break;
                case 'scroll':
                    $('#action-scroll-row').show();
                    break;
            }
        });

        // Color palette functionality
        $('.color-swatch:not(.border-swatch)').on('click', function() {
            var colorValue = $(this).data('color');
            
            // Remove selected class from all button color swatches (not border swatches)
            $('.color-swatch:not(.border-swatch)').removeClass('selected');
            
            // Add selected class to clicked swatch
            $(this).addClass('selected');
            
            // Update the dropdown
            $('#button-color').val(colorValue);
            
            // Update custom color picker if it's a custom color
            if (colorValue.startsWith('gradient-')) {
                // For gradients, set a representative color
                var gradientColors = {
                    'gradient-blue': '#667eea',
                    'gradient-green': '#4facfe',
                    'gradient-red': '#fa709a',
                    'gradient-purple': '#a8edea',
                    'gradient-sunset': '#ff9a9e'
                };
                $('#custom-color-picker').val(gradientColors[colorValue] || '#0073aa');
            } else if (colorValue !== 'custom') {
                // Map color names to hex values
                var colorMap = {
                    'blue': '#0073aa',
                    'green': '#28a745',
                    'red': '#dc3545',
                    'orange': '#fd7e14',
                    'purple': '#6f42c1',
                    'navy': '#2c3e50',
                    'teal': '#17a2b8',
                    'gray': '#6c757d',
                    'dark': '#343a40',
                    'indigo': '#6610f2',
                    'pink': '#e83e8c',
                    'cyan': '#20c997',
                    'yellow': '#ffc107',
                    'lime': '#28a745',
                    'coral': '#ff6b6b'
                };
                $('#custom-color-picker').val(colorMap[colorValue] || '#0073aa');
            }
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Custom color picker functionality
        $('#apply-custom-color').on('click', function() {
            var customColor = $('#custom-color-picker').val();
            
            // Remove selected class from all button color swatches (not border swatches)
            $('.color-swatch:not(.border-swatch)').removeClass('selected');
            
            // Set dropdown to custom
            $('#button-color').val('custom');
            
            // Update custom CSS field with the color
            var currentCSS = $('#custom-css').val();
            var newCSS = currentCSS.replace(/background-color:\s*[^;]+;?/g, '');
            newCSS = newCSS.replace(/background:\s*[^;]+;?/g, '');
            newCSS += 'background-color: ' + customColor + ' !important;';
            $('#custom-css').val(newCSS);
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Initialize color palette selection
        function initializeColorPalette() {
            var currentColor = $('#button-color').val();
            $('.color-swatch:not(.border-swatch)').removeClass('selected');
            $('.color-swatch:not(.border-swatch)[data-color="' + currentColor + '"]').addClass('selected');
        }

        // Initialize on page load
        initializeColorPalette();

        // Button color dropdown change handler
        $('#button-color').on('change', function() {
            var selectedColor = $(this).val();
            
            // Update color swatch selection
            $('.color-swatch:not(.border-swatch)').removeClass('selected');
            $('.color-swatch:not(.border-swatch)[data-color="' + selectedColor + '"]').addClass('selected');
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Border style change handler
        $('#border-style').on('change', function() {
            var borderStyle = $(this).val();
            
            if (borderStyle === 'none') {
                $('#border-width-row, #border-color-row').hide();
            } else {
                $('#border-width-row, #border-color-row').show();
            }
            
            // Update border style examples selection
            $('.border-example').removeClass('selected');
            $('.border-example[data-style="' + borderStyle + '"]').addClass('selected');
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Border style example click handler
        $('.border-example').on('click', function() {
            var borderStyle = $(this).data('style');
            
            // Remove selected class from all examples
            $('.border-example').removeClass('selected');
            
            // Add selected class to clicked example
            $(this).addClass('selected');
            
            // Update the dropdown
            $('#border-style').val(borderStyle);
            
            // Show/hide border options
            if (borderStyle === 'none') {
                $('#border-width-row, #border-color-row').hide();
            } else {
                $('#border-width-row, #border-color-row').show();
            }
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Border width change handler
        $('#border-width').on('change', function() {
            // Trigger live preview update
            updateLivePreview();
        });

        // Border color change handler
        $('#border-color').on('change', function() {
            var borderColor = $(this).val();
            
            if (borderColor === 'custom') {
                $('#border-color-palette').show();
            } else {
                $('#border-color-palette').hide();
            }
            
            // Update border color swatches
            $('.border-swatch').removeClass('selected');
            $('.border-swatch[data-color="' + borderColor + '"]').addClass('selected');
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Border color swatch click handler
        $('.border-swatch').on('click', function() {
            var colorValue = $(this).data('color');
            
            // Remove selected class from all border swatches
            $('.border-swatch').removeClass('selected');
            
            // Add selected class to clicked swatch
            $(this).addClass('selected');
            
            // Update the dropdown
            $('#border-color').val(colorValue);
            
            // Hide palette if not custom
            if (colorValue !== 'custom') {
                $('#border-color-palette').hide();
            }
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Custom border color picker functionality
        $('#apply-custom-border-color').on('click', function() {
            var customColor = $('#custom-border-color-picker').val();
            
            // Remove selected class from all border swatches
            $('.border-swatch').removeClass('selected');
            
            // Set dropdown to custom
            $('#border-color').val('custom');
            
            // Update custom CSS field with the border color
            var currentCSS = $('#custom-css').val();
            var newCSS = currentCSS.replace(/border-color:\s*[^;]+;?/g, '');
            newCSS += 'border-color: ' + customColor + ' !important;';
            $('#custom-css').val(newCSS);
            
            // Trigger live preview update
            updateLivePreview();
        });

        // Border radius change handler
        $('input[name="border_radius"]').on('change', function() {
            // Trigger live preview update
            updateLivePreview();
        });

        // Initialize border controls
        function initializeBorderControls() {
            var borderStyle = $('#border-style').val();
            if (borderStyle === 'none') {
                $('#border-width-row, #border-color-row').hide();
            } else {
                $('#border-width-row, #border-color-row').show();
            }
            
            // Initialize border style examples selection
            $('.border-example').removeClass('selected');
            $('.border-example[data-style="' + borderStyle + '"]').addClass('selected');
            
            var borderColor = $('#border-color').val();
            if (borderColor === 'custom') {
                $('#border-color-palette').show();
            } else {
                $('#border-color-palette').hide();
            }
            
            // Initialize border color swatch selection
            $('.border-swatch').removeClass('selected');
            $('.border-swatch[data-color="' + borderColor + '"]').addClass('selected');
        }

        // Initialize border controls on page load
        initializeBorderControls();
        
        // Initialize live preview on page load
        if ($('#button-title').val() && $('#button-action').val()) {
            updateLivePreview();
        }

        // Floating preview functionality
        $('#toggle-preview').on('click', function() {
            var $panel = $('#floating-preview');
            var $btn = $(this);
            
            if ($panel.hasClass('collapsed')) {
                $panel.removeClass('collapsed');
                $btn.text('−');
            } else {
                $panel.addClass('collapsed');
                $btn.text('+');
            }
        });

        // Make floating preview draggable
        var isDragging = false;
        var currentX;
        var currentY;
        var initialX;
        var initialY;
        var xOffset = 0;
        var yOffset = 0;

        $('.preview-header').on('mousedown', function(e) {
            if (e.target.tagName === 'BUTTON') return; // Don't drag when clicking toggle button
            
            initialX = e.clientX - xOffset;
            initialY = e.clientY - yOffset;

            if (e.target === this || $(e.target).closest('.preview-header').length) {
                isDragging = true;
                $('.preview-header').css('cursor', 'grabbing');
            }
        });

        $(document).on('mousemove', function(e) {
            if (isDragging) {
                e.preventDefault();
                currentX = e.clientX - initialX;
                currentY = e.clientY - initialY;

                xOffset = currentX;
                yOffset = currentY;

                $('#floating-preview').css({
                    'transform': 'translate(' + currentX + 'px, ' + currentY + 'px)',
                    'top': '50%',
                    'right': 'auto'
                });
            }
        });

        $(document).on('mouseup', function() {
            isDragging = false;
            $('.preview-header').css('cursor', 'move');
        });
    
    // Show/hide tracking event field based on tracking selection
    $('#button-tracking').on('change', function() {
        if ($(this).val() === 'none') {
            $('#tracking-event-row').hide();
        } else {
            $('#tracking-event-row').show();
        }
    });
    
    function getBorderCss(borderStyle, borderWidth, borderColor, borderRadius) {
        var css = '';
        
        // Border style and width
        if (borderStyle !== 'none') {
            css += `
.simple-button {
    border-style: ${borderStyle};
    border-width: ${borderWidth};`;
            
            // Border color
            if (borderColor === 'auto') {
                css += `
    border-color: rgba(0, 0, 0, 0.2);`;
            } else if (borderColor === 'white') {
                css += `
    border-color: #ffffff;`;
            } else if (borderColor === 'black') {
                css += `
    border-color: #000000;`;
            } else if (borderColor === 'gray') {
                css += `
    border-color: #6c757d;`;
            } else if (borderColor === 'navy') {
                css += `
    border-color: #2c3e50;`;
            } else if (borderColor === 'dark') {
                css += `
    border-color: #343a40;`;
            } else if (borderColor === 'blue') {
                css += `
    border-color: #0073aa;`;
            } else if (borderColor === 'green') {
                css += `
    border-color: #28a745;`;
            } else if (borderColor === 'red') {
                css += `
    border-color: #dc3545;`;
            } else if (borderColor === 'orange') {
                css += `
    border-color: #fd7e14;`;
            } else if (borderColor === 'purple') {
                css += `
    border-color: #6f42c1;`;
            } else if (borderColor === 'teal') {
                css += `
    border-color: #17a2b8;`;
            } else {
                css += `
    border-color: #000000;`;
            }
            
            css += `
}`;
        }
        
        // Border radius
        if (borderRadius !== '0') {
            css += `
.simple-button {
    border-radius: ${borderRadius}px;
}`;
        }
        
        return css;
    }
    
    // Live preview as user types
    $('#button-title, #button-action, #button-size, #button-color, #border-style, #border-width, #border-color, #custom-css').on('input change', function() {
        if ($('#button-title').val() && $('#button-action').val()) {
            updateLivePreview();
        }
    });
    
    // Live preview for border radius radio buttons
    $('input[name="border_radius"]').on('change', function() {
        if ($('#button-title').val() && $('#button-action').val()) {
            updateLivePreview();
        }
    });
    
    function updateLivePreview() {
        var title = $('#button-title').val() || 'Click Me';
        var action = $('#button-action').val() || '#';
        var size = $('#button-size').val() || 'medium';
        var color = $('#button-color').val() || 'blue';
        var borderStyle = $('#border-style').val() || 'none';
        var borderWidth = $('#border-width').val() || '1px';
        var borderColor = $('#border-color').val() || 'auto';
        var borderRadius = $('input[name="border_radius"]:checked').val() || '0';
        var customCss = $('#custom-css').val();
        
        // Base CSS
        var baseCss = `
.simple-button {
    display: inline-block;
    text-decoration: none;
    font-family: Arial, sans-serif;
    font-weight: bold;
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
}`;
        
        // Size CSS
        var sizeCss = getSizeCss(size);
        
        // Color CSS
        var colorCss = getColorCss(color);
        
        // Border CSS
        var borderCss = getBorderCss(borderStyle, borderWidth, borderColor, borderRadius);
        
        var finalCss = baseCss + sizeCss + colorCss + borderCss + '\n' + customCss;
        
        // Create a temporary style element
        var tempStyle = $('<style>').text(finalCss);
        var previewHtml = '<a href="' + action + '" class="simple-button">' + title + '</a>';
        
        // Update floating preview
        $('#floating-preview-container').html(tempStyle.clone()).append(previewHtml);
        
        // Update original preview (if it exists)
        if ($('#preview-container').length) {
            $('#preview-container').html(tempStyle).append(previewHtml);
            $('#button-preview').show();
        }
    }
    
    function getSizeCss(size) {
        switch (size) {
            case 'small':
                return `
.simple-button {
    padding: 8px 16px;
    font-size: 14px;
}`;
            case 'large':
                return `
.simple-button {
    padding: 16px 32px;
    font-size: 18px;
}`;
            default: // medium
                return `
.simple-button {
    padding: 12px 24px;
    font-size: 16px;
}`;
        }
    }
    
    function getColorCss(color) {
        switch (color) {
            case 'green':
                return `
.simple-button {
    background-color: #28a745;
    color: white;
}
.simple-button:hover {
    background-color: #218838;
}`;
            case 'red':
                return `
.simple-button {
    background-color: #dc3545;
    color: white;
}
.simple-button:hover {
    background-color: #c82333;
}`;
            case 'orange':
                return `
.simple-button {
    background-color: #fd7e14;
    color: white;
}
.simple-button:hover {
    background-color: #e8650e;
}`;
            case 'purple':
                return `
.simple-button {
    background-color: #6f42c1;
    color: white;
}
.simple-button:hover {
    background-color: #5a32a3;
}`;
            case 'navy':
                return `
.simple-button {
    background-color: #2c3e50;
    color: white;
}
.simple-button:hover {
    background-color: #1a252f;
}`;
            case 'teal':
                return `
.simple-button {
    background-color: #17a2b8;
    color: white;
}
.simple-button:hover {
    background-color: #138496;
}`;
            case 'gray':
                return `
.simple-button {
    background-color: #6c757d;
    color: white;
}
.simple-button:hover {
    background-color: #5a6268;
}`;
            case 'dark':
                return `
.simple-button {
    background-color: #343a40;
    color: white;
}
.simple-button:hover {
    background-color: #23272b;
}`;
            case 'pink':
                return `
.simple-button {
    background-color: #e83e8c;
    color: white;
}
.simple-button:hover {
    background-color: #d91a72;
}`;
            case 'cyan':
                return `
.simple-button {
    background-color: #20c997;
    color: white;
}
.simple-button:hover {
    background-color: #1aa179;
}`;
            case 'yellow':
                return `
.simple-button {
    background-color: #ffc107;
    color: #212529;
}
.simple-button:hover {
    background-color: #e0a800;
    color: #212529;
}`;
            case 'lime':
                return `
.simple-button {
    background-color: #28a745;
    color: white;
}
.simple-button:hover {
    background-color: #218838;
}`;
            case 'coral':
                return `
.simple-button {
    background-color: #ff6b6b;
    color: white;
}
.simple-button:hover {
    background-color: #ff5252;
}`;
            case 'gradient-blue':
                return `
.simple-button {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #5a6fd8 0%, #6a4190 100%);
}`;
            case 'gradient-green':
                return `
.simple-button {
    background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #3d8bfe 0%, #00d4fe 100%);
}`;
            case 'gradient-red':
                return `
.simple-button {
    background: linear-gradient(45deg, #fa709a 0%, #fee140 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #f95d8a 0%, #fdd835 100%);
}`;
            case 'gradient-purple':
                return `
.simple-button {
    background: linear-gradient(45deg, #a8edea 0%, #fed6e3 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #9ce5e2 0%, #fdc9d7 100%);
}`;
            case 'gradient-sunset':
                return `
.simple-button {
    background: linear-gradient(45deg, #ff9a9e 0%, #fecfef 100%);
    color: white;
}
.simple-button:hover {
    background: linear-gradient(45deg, #ff8a8e 0%, #fec5ef 100%);
}`;
            default: // blue
                return `
.simple-button {
    background-color: #0073aa;
    color: white;
}
.simple-button:hover {
    background-color: #005a87;
}`;
        }
    }
    
    // CSS Examples Modal Functions
    window.showCSSExamples = function() {
        $('#css-examples-modal').show();
    };
    
    window.closeCSSExamples = function() {
        $('#css-examples-modal').hide();
    };
    
    // Close modal when clicking outside
    $('#css-examples-modal').on('click', function(e) {
        if (e.target === this) {
            closeCSSExamples();
        }
    });
    
    // Close modal with Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('#css-examples-modal').is(':visible')) {
            closeCSSExamples();
        }
    });
});
