# 🎨 CSS Examples Guide for Simple Button Generator

This guide provides ready-to-use CSS examples that you can copy and paste into the Custom CSS field to create unique button styles.

> **💡 Tip**: You can also access these examples directly from the plugin admin page by clicking the "CSS Examples Guide" link in the Custom CSS field description. This opens a modal with all examples that you can copy directly.

## 📐 Size & Spacing Examples

### Extra Large Button
```css
.simple-button {
    padding: 20px 40px;
    font-size: 20px;
}
```

### Compact Button
```css
.simple-button {
    padding: 8px 16px;
    font-size: 14px;
}
```

### Full Width Button
```css
.simple-button {
    width: 100%;
    display: block;
}
```

### Custom Padding
```css
.simple-button {
    padding: 15px 50px;
    font-size: 18px;
}
```

## 🎨 Colors & Backgrounds

### Gradient Background
```css
.simple-button {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}
```

### Two-Tone Button
```css
.simple-button {
    background: linear-gradient(to right, #ff6b6b 50%, #4ecdc4 50%);
}
```

### Transparent Button with Border
```css
.simple-button {
    background: transparent;
    border: 2px solid #0073aa;
    color: #0073aa;
}
```

### Dark Theme Button
```css
.simple-button {
    background: #2c3e50;
    color: #ecf0f1;
}
.simple-button:hover {
    background: #34495e;
}
```

### Neon Glow Effect
```css
.simple-button {
    background: #00ff88;
    color: #000;
    box-shadow: 0 0 20px #00ff88;
}
```

## 🔘 Shapes & Borders

### Fully Rounded Button
```css
.simple-button {
    border-radius: 25px;
}
```

### Pill-Shaped Button
```css
.simple-button {
    border-radius: 50px;
}
```

### Square Button
```css
.simple-button {
    border-radius: 0;
}
```

### Custom Border
```css
.simple-button {
    border: 3px solid #333;
}
```

### Dashed Border
```css
.simple-button {
    background: transparent;
    border: 2px dashed #0073aa;
    color: #0073aa;
}
```

## ✨ Effects & Animations

### Shadow Effect
```css
.simple-button {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
```

### Glow Effect
```css
.simple-button {
    box-shadow: 0 0 20px rgba(0, 123, 170, 0.5);
}
```

### Scale Animation
```css
.simple-button:hover {
    transform: scale(1.1);
}
```

### Bounce Animation
```css
.simple-button:hover {
    animation: bounce 0.6s;
}
@keyframes bounce {
    0%, 20%, 60%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    80% { transform: translateY(-5px); }
}
```

### Pulse Animation
```css
.simple-button {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
```

### Slide Animation
```css
.simple-button {
    position: relative;
    overflow: hidden;
}
.simple-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    transition: left 0.5s;
}
.simple-button:hover::before {
    left: 0;
}
```

## 🎯 Business-Specific Styles

### E-commerce "Buy Now"
```css
.simple-button {
    background: #28a745;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
}
.simple-button:hover {
    background: #218838;
    transform: translateY(-2px);
}
```

### Contact/Support Button
```css
.simple-button {
    background: #17a2b8;
    border-radius: 20px;
    padding: 12px 30px;
}
```

### Download Button
```css
.simple-button {
    background: #6c757d;
    border-radius: 4px;
    position: relative;
}
.simple-button::after {
    content: " ⬇";
}
```

### Subscribe Button
```css
.simple-button {
    background: #e83e8c;
    border-radius: 25px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
```

### Learn More Button
```css
.simple-button {
    background: transparent;
    border: 2px solid #007bff;
    color: #007bff;
    border-radius: 0;
}
.simple-button:hover {
    background: #007bff;
    color: white;
}
```

## 🎨 Advanced Combinations

### Modern Glass Effect
```css
.simple-button {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
}
```

### 3D Button Effect
```css
.simple-button {
    background: #3498db;
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 0 #2980b9;
    transform: translateY(0);
    transition: all 0.1s;
}
.simple-button:hover {
    transform: translateY(2px);
    box-shadow: 0 2px 0 #2980b9;
}
.simple-button:active {
    transform: translateY(4px);
    box-shadow: 0 0 0 #2980b9;
}
```

### Animated Gradient
```css
.simple-button {
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
    background-size: 400% 400%;
    animation: gradientShift 3s ease infinite;
}
@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
```

### Text Icon Button
```css
.simple-button {
    background: #ff6b6b;
    border-radius: 50px;
    padding: 12px 20px;
    position: relative;
}
.simple-button::before {
    content: "→";
    margin-right: 8px;
}
```

## 💡 Pro Tips

### Combining Multiple Effects
```css
.simple-button {
    /* Size */
    padding: 15px 30px;
    font-size: 16px;
    
    /* Color */
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
    
    /* Shape */
    border-radius: 25px;
    
    /* Effects */
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    
    /* Animation */
    transition: all 0.3s ease;
}
.simple-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
}
```

### Responsive Design
```css
.simple-button {
    padding: 12px 24px;
    font-size: 16px;
}

@media (max-width: 768px) {
    .simple-button {
        padding: 10px 20px;
        font-size: 14px;
    }
}
```

### Accessibility Improvements
```css
.simple-button {
    /* Ensure good contrast */
    background: #0073aa;
    color: white;
    
    /* Focus state for keyboard navigation */
    outline: 2px solid transparent;
    outline-offset: 2px;
}
.simple-button:focus {
    outline: 2px solid #0073aa;
    outline-offset: 2px;
}
```

## 🚀 How to Use These Examples

1. **Copy** the CSS code you want to use
2. **Paste** it into the Custom CSS field in the plugin
3. **Modify** colors, sizes, or effects as needed
4. **Preview** your button in real-time
5. **Generate** and download your custom button

## 🎯 Common Use Cases

- **Call-to-Action**: Use bold colors and animations
- **Download Links**: Add download icons or arrows
- **Contact Forms**: Use professional, trustworthy colors
- **Social Media**: Match your brand colors
- **E-commerce**: Use green for "Buy Now" buttons
- **Newsletters**: Use engaging, clickable designs

Remember: You can combine multiple examples to create unique button styles that match your brand perfectly!
