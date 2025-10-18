jQuery(document).ready(function($) {
    $('#button-generator-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            action: 'generate_button',
            nonce: buttonGenerator.nonce,
            button_title: $('#button-title').val(),
            button_action: $('#button-action').val(),
            button_size: $('#button-size').val(),
            button_color: $('#button-color').val(),
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
    
    // Live preview as user types
    $('#button-title, #button-action, #button-size, #button-color, #custom-css').on('input change', function() {
        if ($('#button-title').val() && $('#button-action').val()) {
            updateLivePreview();
        }
    });
    
    function updateLivePreview() {
        var title = $('#button-title').val() || 'Click Me';
        var action = $('#button-action').val() || '#';
        var size = $('#button-size').val() || 'medium';
        var color = $('#button-color').val() || 'blue';
        var customCss = $('#custom-css').val();
        
        // Base CSS
        var baseCss = `
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
}`;
        
        // Size CSS
        var sizeCss = getSizeCss(size);
        
        // Color CSS
        var colorCss = getColorCss(color);
        
        var finalCss = baseCss + sizeCss + colorCss + '\n' + customCss;
        
        // Create a temporary style element
        var tempStyle = $('<style>').text(finalCss);
        var previewHtml = '<a href="' + action + '" class="simple-button">' + title + '</a>';
        
        // Update preview
        $('#preview-container').html(tempStyle).append(previewHtml);
        $('#button-preview').show();
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
});
