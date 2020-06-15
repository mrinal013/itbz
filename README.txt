## Algorithm for this problem solution:

Admin part -----
1. Create 2 admin pages 
  a. Special URL Setting : From this page admin can create product's special page url. Page url's prefix is upto customer account page + slug. Also, consumer key and consumer secret field should set on this page.
  b. Videos : : From this page admin can show and download all videos uploaded by customer.

My account part -----
2. Create a new page on customer account, based on product ordered. It shows like a tab.
3. In this page there are 3 parts
  a. Video upload section
  b. This customer video section
  c. Other customer's video section

## Test instructions:
1. Install this plugin as normal.
2. It has WooCommerce dependency. Minimum WC version 4.0 required.
3. After activate this plugin, we get 2 admin pages under ITBZ admin menu. These are - Settings and Videos
4. At "Settings" page we can provide these
  a. product id
  b. special page slug
  c. WooCommerce consumer key. You can get it from WooCommerce->Settings->Advanced->REST API page.
  d. WooCommerce consumer secret. You can get it from WooCommerce->Settings->Advanced->REST API page.
  e. Firebase configure options. It requires, because I use firebase as cloud storage.
 5. At "Videos" page admin will see uploaded video. Admin can download this video also.
 6. Customer which have bought special product, will be aligable to special page, which were defined by admin.
 7. At this special page, customer can upload video of mp4 format with 20mb to 200mb size at top "upload" area.
 8. If customer had uploaded any video previously, he can show and upload this video at middle "my videos" section.
 9. This customer can see other customers video at last "others videos" section, who also bought this product and uploaded video. This customer can not download other customers video.
 10. This special page url can not accessed by any guest user. 

## References
1. https://github.com/mrinal013/wp-admin-vue
2. https://vue-multiselect.js.org/
3. https://getbootstrap.com/
4. WordPress Codex
5. WooCommerce Doc
6. Stackoverflow
7. Others
