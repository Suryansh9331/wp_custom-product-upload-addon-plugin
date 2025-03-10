# 🚀 WooCommerce Custom Upload Addon Plugin For Product



A powerful WooCommerce plugin that allows customers to **upload images** directly on the product page and dynamically adjusts the product price based on the uploaded file. Perfect for customized products like t-shirts, mugs, and more! 🎯

---

## ✨ **Features**
✅ Adds a file upload field to WooCommerce product pages  
✅ Dynamically updates product price on the product page after file upload  
✅ Displays uploaded file and adjusted price in:  
- ✅ Cart  
- ✅ Checkout  
- ✅ Order details (Admin + Customer)  
✅ Clean and lightweight — No unnecessary bloat  
✅ Easy to customize and extend  

---

## 📸 **Example Scenario**
| Product | Base Price | File Upload Extra | Final Price |
|---------|------------|-------------------|-------------|
| T-shirt | ₹450 | ₹50 | ₹500 |
| Hoodie | ₹700 | ₹100 | ₹800 |

---

## 🛠️ **Installation**
1. **Download** the plugin ZIP file.  
2. Go to **WordPress Dashboard → Plugins → Add New → Upload Plugin**  
3. Upload the ZIP file and click **Activate**  

---

## 🚀 **Usage**
### 1. **Add the Upload Field**  
- Go to **Products → Add New**  
- Set product type to **Variable Product**  
- The file upload field will automatically appear on the product page  

---

### 2. **Set Pricing for Upload**  
- The file upload price is predefined (you can adjust it in the code).  
- Example: ₹50 added for each uploaded file  

---

### 3. **Dynamic Price Update**  
- When a customer uploads an image, the price updates automatically on:  
  ✅ Product Page  
  ✅ Cart  
  ✅ Checkout  
  ✅ Order Summary  



➡️ Allow Multiple Files
To allow multiple files, update the input field like this:

<input type="file" id="custom_upload" name="custom_upload[]" multiple />

➡️ Limit File Types
You can restrict file types by adjusting the accept attribute:

accept="image/png, image/jpeg, image/jpg"

💻 Code Structure
📦 custom-upload-addon

├── 📄 custom_product_add_on.php
├── 📄 custom_product_add_on.js
└── 📄 README.md

🎯 How It Works
  
1. User selects product variation
 2. User uploads an image
 3. Price is updated instantly on the product page ✅
 4. Updated price reflects in cart, checkout, and order summary ✅ 
 5. Uploaded file is saved and shown in admin order details ✅

🚨 Troubleshooting
Issue: 
 Price not updating on product page?
 ➡️ Make sure WooCommerce JavaScript is loaded correctly.
 ➡️ Check if jQuery is enabled in your theme.

Issue: 
    Uploaded file not showing in admin?
 ➡️ Ensure proper file permissions for uploads directory.

🌟 Future Enhancements
✅ Multiple file uploads
✅ Option to apply percentage-based pricing
✅ Custom validation for file size and type

📃 License
This plugin is licensed under the GPL-2.0+ License.

💖 Like This Plugin?
Give it a ⭐️ on GitHub!

👉https://github.com/Suryansh9331/wp_custom-product-upload-addon-plugin

🧑‍💻 Contributing
Contributions are welcome! Feel free to fork the repo and submit a pull request.
