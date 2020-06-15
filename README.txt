## Algorithm for this problem solution:

Admin part -----
1. Create 2 admin pages 
  a. Special URL Setting: From this page, admin can create a product's special page slug. Page URL's prefix is up to the customer account page + slug. Also, the WooCommerce consumer key and consumer secret field should set on this page.
  b. Videos:  From this page, admin can show and download all videos uploaded by the customers.

My account part -----
2. Get a new page on the customer account, based on the product ordered. It shows like a tab.
3. On this page, there are 3 parts a. Video upload section b. This customer video section c. Other customer's video section

## My steps to solve this problem
1. First develop admin pages: Settings and Videos. For these pages, I use VueJS, Axios, WooCommerceApi. To store the values of the Settings page, I use axios AJAX call. To get products, I use WooCommerceApi.
2. At the frontend or customer's special page, I use PHP and VueJS.
3. For uploading the video, I use firebase cloud storage with VusJS.
4. After uploading complete, an AJAX call with axios system called. With this AJAX function, this customer id, special product id and uploaded video's URL stored in a DB table called wp_itbz.
5. This table's data are used later for populating video at the admin Video page. Also, these data are used to populate data on the customer's special page. With the "customer id" field, I can find out "my videos" and "other videos".

## Test instructions:
1. Install this plugin as normal.
2. It has WooCommerce dependency. Minimum WC version 4.0 required.
3. After activating this plugin, we get 2 admin pages under ITBZ admin menu. These are - Settings and Videos
4. At the "Settings" page we can provide followings:
a. product id
b. special page slug
c. WooCommerce consumer key. I created it from WooCommerce->Settings->Advanced->REST API page.
  d. WooCommerce consumer secret. I created it from WooCommerce->Settings->Advanced->REST API page.
  e. Firebase configures options. It requires because I use firebase as cloud storage.
 5. At the "Videos" page admin will see uploaded video. Admin can download this video also.
 6. Customer who has bought the special product will be eligible to a special page, which was defined by admin.
 7. On this special page, customers can upload videos of mp4 format with 20mb to 200mb size at the top "upload" area.
 8. If the customer had uploaded any video previously, he can show and upload this video in the middle "my videos" section.
 9. This customer can see other customers video at last "others videos" section, who also bought this product and uploaded a video. This customer can not download other customer's videos.
 10. This special page URL can not be accessed by any guest user. 

## References
1. https://github.com/mrinal013/wp-admin-vue
2. https://vue-multiselect.js.org/
3. https://getbootstrap.com/
4. WordPress Codex
5. WooCommerce Doc
6. Stackoverflow
7. Others
