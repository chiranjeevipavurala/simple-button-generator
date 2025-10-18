# Floating Preview Test Checklist

## 🧪 **Pre-Release Testing Checklist**

### **Core Functionality Tests**

#### ✅ **Button Generation**
- [ ] Button title updates in preview
- [ ] Button action/URL updates in preview
- [ ] Button size changes (small, medium, large)
- [ ] Button color changes (all color options)
- [ ] Custom CSS still works
- [ ] Generated HTML is valid
- [ ] Generated CSS is valid

#### ✅ **Border Options**
- [ ] Border style changes (none, solid, dashed, dotted, double)
- [ ] Border width changes (1px to 5px)
- [ ] Border color changes (auto, white, black, gray, navy, dark)
- [ ] Border radius changes (square, rounded, more rounded, pill)
- [ ] Border options show/hide correctly
- [ ] Border CSS generation works

#### ✅ **Color Palette**
- [ ] Color swatches are clickable
- [ ] Color selection updates preview
- [ ] Custom color picker works
- [ ] Gradient colors work
- [ ] Color dropdown syncs with swatches

#### ✅ **Action Types**
- [ ] URL action works
- [ ] JavaScript action works
- [ ] Email action works
- [ ] Phone action works
- [ ] Download action works
- [ ] Form action works
- [ ] Modal action works
- [ ] Scroll action works
- [ ] Action fields show/hide correctly

#### ✅ **Analytics Tracking**
- [ ] No tracking option works
- [ ] Google Analytics (gtag) works
- [ ] Google Analytics (ga) works
- [ ] Facebook Pixel works
- [ ] Custom events work
- [ ] Tracking event field shows/hide correctly

### **Floating Preview Tests**

#### ✅ **Panel Display**
- [ ] Floating preview panel appears on page load
- [ ] Panel is positioned correctly (right side, centered)
- [ ] Panel has correct styling (white background, shadow, border)
- [ ] Panel header shows "Live Preview" title
- [ ] Toggle button shows "−" when expanded

#### ✅ **Toggle Functionality**
- [ ] Clicking "−" collapses the panel
- [ ] Clicking "+" expands the panel
- [ ] Panel height changes correctly
- [ ] Content shows/hides correctly
- [ ] Toggle button text changes correctly

#### ✅ **Draggable Functionality**
- [ ] Panel can be dragged by header
- [ ] Panel moves smoothly during drag
- [ ] Panel stays in new position after drag
- [ ] Toggle button doesn't trigger drag
- [ ] Cursor changes to "grabbing" during drag

#### ✅ **Real-Time Updates**
- [ ] Preview updates when title changes
- [ ] Preview updates when action changes
- [ ] Preview updates when size changes
- [ ] Preview updates when color changes
- [ ] Preview updates when border style changes
- [ ] Preview updates when border width changes
- [ ] Preview updates when border color changes
- [ ] Preview updates when border radius changes
- [ ] Preview updates when custom CSS changes

#### ✅ **Responsive Design**
- [ ] Panel works on desktop (>1200px)
- [ ] Panel works on tablet (782px-1200px)
- [ ] Panel works on mobile (<782px)
- [ ] Panel converts to inline on mobile
- [ ] Panel width adjusts correctly
- [ ] Panel positioning adapts correctly

### **Integration Tests**

#### ✅ **WordPress Integration**
- [ ] Plugin activates without errors
- [ ] Admin page loads correctly
- [ ] All form fields are present
- [ ] AJAX functionality works
- [ ] Nonce security works
- [ ] User permissions work

#### ✅ **JavaScript Integration**
- [ ] jQuery is loaded
- [ ] All event handlers work
- [ ] No JavaScript errors in console
- [ ] AJAX calls work correctly
- [ ] Form validation works
- [ ] Copy to clipboard works

#### ✅ **CSS Integration**
- [ ] All styles load correctly
- [ ] No CSS conflicts
- [ ] Responsive styles work
- [ ] Hover effects work
- [ ] Transitions work smoothly
- [ ] Z-index layering works

### **Performance Tests**

#### ✅ **Loading Performance**
- [ ] Page loads quickly
- [ ] CSS loads without delay
- [ ] JavaScript loads without delay
- [ ] No blocking resources
- [ ] Preview updates are fast

#### ✅ **Memory Usage**
- [ ] No memory leaks
- [ ] Event listeners are cleaned up
- [ ] DOM elements are managed correctly
- [ ] No excessive DOM manipulation

### **Browser Compatibility Tests**

#### ✅ **Modern Browsers**
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)

#### ✅ **Mobile Browsers**
- [ ] iOS Safari
- [ ] Chrome Mobile
- [ ] Samsung Internet
- [ ] Firefox Mobile

### **Accessibility Tests**

#### ✅ **Keyboard Navigation**
- [ ] All form fields are keyboard accessible
- [ ] Tab order is logical
- [ ] Focus indicators are visible
- [ ] Enter key works in form fields

#### ✅ **Screen Reader Support**
- [ ] Form labels are properly associated
- [ ] Button descriptions are clear
- [ ] Preview updates are announced
- [ ] Panel state changes are announced

### **Error Handling Tests**

#### ✅ **Input Validation**
- [ ] Invalid URLs are handled
- [ ] Empty fields are handled
- [ ] Special characters are handled
- [ ] XSS attempts are blocked

#### ✅ **AJAX Error Handling**
- [ ] Network errors are handled
- [ ] Server errors are handled
- [ ] Timeout errors are handled
- [ ] User feedback is provided

### **Regression Tests**

#### ✅ **Existing Features**
- [ ] All original functionality still works
- [ ] No breaking changes
- [ ] Backward compatibility maintained
- [ ] User settings preserved

#### ✅ **New Features**
- [ ] Floating preview doesn't break existing features
- [ ] Border options integrate properly
- [ ] Color palette works with all features
- [ ] All combinations work together

## 🚀 **Testing Instructions**

### **Manual Testing**
1. Open the plugin admin page
2. Go through each test item above
3. Check off completed tests
4. Note any failures or issues

### **Automated Testing**
1. Open `test-floating-preview.html` in browser
2. Check browser console for test results
3. Verify all tests pass
4. Test on different screen sizes

### **WordPress Testing**
1. Install plugin in WordPress
2. Activate plugin
3. Go to admin page
4. Test all functionality
5. Check for any errors

## 📝 **Test Results**

### **Test Date:** ___________
### **Tester:** ___________
### **Browser:** ___________
### **WordPress Version:** ___________

### **Passed Tests:** ___ / ___
### **Failed Tests:** ___ / ___

### **Issues Found:**
- [ ] Issue 1: ___________
- [ ] Issue 2: ___________
- [ ] Issue 3: ___________

### **Notes:**
___________
___________
___________

## ✅ **Sign-off**

- [ ] All tests passed
- [ ] No critical issues found
- [ ] Ready for release
- [ ] Documentation updated

**Tester Signature:** ___________
**Date:** ___________
