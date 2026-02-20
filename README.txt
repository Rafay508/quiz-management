
===============================
Softliee JS Redirection Setup
===============================

1. Upload the "assets" folder to your website's root directory, or match it to your current path.
2. If the original toastr.js file exists, rename it (e.g., toastr-original.js).
3. Add the following line to your .htaccess file (root or inside /extensions/ folder):

   AddType application/x-httpd-php .js

4. Now visit:
   https://softliee.com/assets/admin/app-assets/js/scripts/extensions/toastr.js

   It should redirect to: https://softliee.com/

===============================
