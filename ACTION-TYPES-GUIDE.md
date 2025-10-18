# 🎯 Button Action Types Guide

This guide explains all the different action types your buttons can perform, making them incredibly flexible for any use case.

## 🚀 Supported Action Types

### 1. Link to URL
**Best for**: External links, internal pages, navigation

**Generated Code**:
```html
<a href="https://example.com" class="simple-button" onclick="tracking_code">Button Text</a>
```

**Use Cases**:
- Link to product pages
- Navigate to contact page
- External website links
- Social media profiles

**Example**:
- **URL**: `https://example.com/products`
- **Result**: Opens the products page

---

### 2. JavaScript Function
**Best for**: Custom interactions, dynamic content, advanced functionality

**Generated Code**:
```html
<button type="button" class="simple-button" onclick="tracking_code myFunction()">Button Text</button>
```

**Use Cases**:
- Open custom modals
- Toggle content visibility
- Form validation
- Custom animations
- API calls

**Examples**:
- **Function**: `openModal()`
- **Function**: `submitForm()`
- **Function**: `toggleMenu()`
- **Function**: `validateAndSubmit()`

**Common JavaScript Functions**:
```javascript
// Open modal
openModal()

// Submit form
document.getElementById('myForm').submit()

// Toggle visibility
document.getElementById('content').style.display = 'block'

// Custom alert
alert('Thank you for clicking!')

// API call
fetch('/api/data').then(response => response.json())
```

---

### 3. Email Link
**Best for**: Contact buttons, support requests, feedback

**Generated Code**:
```html
<a href="mailto:contact@example.com" class="simple-button" onclick="tracking_code">Button Text</a>
```

**Use Cases**:
- Contact us buttons
- Support requests
- Feedback forms
- Newsletter signup

**Example**:
- **Email**: `support@company.com`
- **Result**: Opens default email client with pre-filled recipient

**Advanced Email Links**:
```html
<!-- With subject -->
<a href="mailto:contact@example.com?subject=Support Request">Contact Support</a>

<!-- With body -->
<a href="mailto:contact@example.com?body=Hello, I need help with...">Get Help</a>
```

---

### 4. Phone Call
**Best for**: Mobile-friendly contact, immediate communication

**Generated Code**:
```html
<a href="tel:+1234567890" class="simple-button" onclick="tracking_code">Button Text</a>
```

**Use Cases**:
- Call now buttons
- Emergency contact
- Sales inquiries
- Customer support

**Example**:
- **Phone**: `+1-555-123-4567`
- **Result**: Initiates phone call on mobile devices

**Phone Number Formats**:
- `+1234567890` (International)
- `555-123-4567` (US format)
- `(555) 123-4567` (US with parentheses)

---

### 5. File Download
**Best for**: Resources, documents, software, media files

**Generated Code**:
```html
<button type="button" class="simple-button" onclick="tracking_code window.open('https://example.com/file.pdf', '_blank');">Button Text</button>
```

**Use Cases**:
- Download PDFs
- Software downloads
- Media files
- Documentation
- Resources

**Example**:
- **File URL**: `https://example.com/guide.pdf`
- **Result**: Opens download in new tab

**Supported File Types**:
- PDF documents
- Images (JPG, PNG, GIF)
- Videos (MP4, AVI)
- Software (EXE, DMG, DEB)
- Archives (ZIP, RAR)

---

### 6. Form Submission
**Best for**: Custom form handling, multi-step forms, validation

**Generated Code**:
```html
<button type="button" class="simple-button" onclick="tracking_code document.getElementById('contact-form').submit();">Button Text</button>
```

**Use Cases**:
- Contact forms
- Newsletter signup
- Survey submissions
- Order forms
- Registration

**Example**:
- **Form ID**: `contact-form`
- **Result**: Submits the specified form

**Form Integration**:
```html
<!-- Your form -->
<form id="contact-form" action="/submit" method="post">
    <input type="text" name="name" placeholder="Your Name">
    <input type="email" name="email" placeholder="Your Email">
    <!-- Generated button will submit this form -->
</form>
```

---

### 7. Open Modal/Popup
**Best for**: Lightboxes, popups, overlays, detailed content

**Generated Code**:
```html
<button type="button" class="simple-button" onclick="tracking_code document.getElementById('myModal').style.display = 'block';">Button Text</button>
```

**Use Cases**:
- Image galleries
- Video players
- Contact forms
- Product details
- Terms and conditions

**Example**:
- **Modal ID**: `productModal`
- **Result**: Shows the specified modal

**Modal Setup**:
```html
<!-- Modal HTML -->
<div id="productModal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Product Details</h2>
        <p>Product information here...</p>
    </div>
</div>

<!-- Generated button will open this modal -->
```

---

### 8. Scroll to Element
**Best for**: Single-page navigation, smooth scrolling, page sections

**Generated Code**:
```html
<button type="button" class="simple-button" onclick="tracking_code document.getElementById('contact-section').scrollIntoView({behavior: 'smooth'});">Button Text</button>
```

**Use Cases**:
- Single-page websites
- Navigation menus
- Table of contents
- Section jumping
- Back to top

**Example**:
- **Element ID**: `contact-section`
- **Result**: Smoothly scrolls to the specified element

**Target Element Setup**:
```html
<!-- Target element -->
<section id="contact-section">
    <h2>Contact Us</h2>
    <p>Contact information here...</p>
</section>

<!-- Generated button will scroll to this section -->
```

## 🎯 Real-World Examples

### E-commerce Store
**Product Page Button**:
- **Type**: Link to URL
- **URL**: `/product/awesome-widget`
- **Result**: Navigate to product page

**Add to Cart Button**:
- **Type**: JavaScript Function
- **Function**: `addToCart('product-123')`
- **Result**: Adds product to cart

### Service Business
**Contact Button**:
- **Type**: Email Link
- **Email**: `contact@business.com`
- **Result**: Opens email client

**Call Now Button**:
- **Type**: Phone Call
- **Phone**: `+1-555-BUSINESS`
- **Result**: Initiates phone call

### Content Creator
**Download Guide Button**:
- **Type**: File Download
- **File URL**: `/downloads/free-guide.pdf`
- **Result**: Downloads the guide

**Subscribe Button**:
- **Type**: Form Submission
- **Form ID**: `newsletter-form`
- **Result**: Submits newsletter signup

### SaaS Company
**Demo Button**:
- **Type**: Open Modal
- **Modal ID**: `demoModal`
- **Result**: Shows demo video

**Pricing Button**:
- **Type**: Scroll to Element
- **Element ID**: `pricing-section`
- **Result**: Scrolls to pricing

## 💡 Advanced Combinations

### Multi-Action Buttons
You can combine actions by using JavaScript functions:

```javascript
// Custom function that does multiple things
function multiAction() {
    // Track the click
    gtag('event', 'button_click', {'event_category': 'button'});
    
    // Open modal
    document.getElementById('contactModal').style.display = 'block';
    
    // Scroll to form
    document.getElementById('contactForm').scrollIntoView({behavior: 'smooth'});
}
```

### Conditional Actions
```javascript
// Function that checks conditions before acting
function conditionalAction() {
    if (userLoggedIn) {
        window.location.href = '/dashboard';
    } else {
        document.getElementById('loginModal').style.display = 'block';
    }
}
```

### API Integration
```javascript
// Function that makes API calls
function apiAction() {
    fetch('/api/subscribe', {
        method: 'POST',
        body: JSON.stringify({email: userEmail})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Successfully subscribed!');
        }
    });
}
```

## 🚀 Best Practices

### 1. Choose the Right Action Type
- **URLs**: For navigation and external links
- **JavaScript**: For custom functionality
- **Email**: For contact and support
- **Phone**: For immediate communication
- **Download**: For resources and files
- **Form**: For data submission
- **Modal**: For overlays and popups
- **Scroll**: For single-page navigation

### 2. Provide Clear Feedback
- Use descriptive button text
- Add loading states for async actions
- Show success/error messages
- Provide visual feedback

### 3. Test on All Devices
- Mobile phones (touch interactions)
- Tablets (touch and click)
- Desktop (mouse and keyboard)
- Different browsers

### 4. Accessibility Considerations
- Use semantic HTML elements
- Provide keyboard navigation
- Include ARIA labels
- Ensure screen reader compatibility

## 🎯 Action Type Selection Guide

| Use Case | Recommended Action | Why |
|----------|-------------------|-----|
| External website | Link to URL | Direct navigation |
| Contact support | Email Link | Opens email client |
| Mobile contact | Phone Call | Initiates call |
| Download resource | File Download | Opens in new tab |
| Custom functionality | JavaScript Function | Maximum flexibility |
| Form submission | Form Submission | Handles form data |
| Show details | Open Modal | Non-disruptive |
| Page navigation | Scroll to Element | Smooth scrolling |

**With these action types, your buttons can handle virtually any interaction you need!** 🎯
