<?php

//socialite
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

//Route::get('/', function () {return view('pages.index');});
Route::get('/', 'FrontController@index');
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

// admin part----------------------
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@storecategory')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@DeleteCategory');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@EditCategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@UpdateCategory');
//Brands==========
Route::get('admin/brands', 'Admin\Category\CategoryController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\CategoryController@storebrand')->name('store.brand');
Route::get('delete/brand/{id}', 'Admin\Category\CategoryController@DeleteBrand');
Route::get('edit/brand/{id}', 'Admin\Category\CategoryController@EditBrand');
Route::post('update/brand/{id}', 'Admin\Category\CategoryController@UpdateBrand');

//sub categories=====
Route::get('admin/sub/category', 'Admin\Category\CategoryController@subcategories')->name('sub.categories');
Route::post('admin/store/subcat', 'Admin\Category\CategoryController@storesubcat')->name('store.subcategory');
Route::get('delete/subcategory/{id}','Admin\Category\CategoryController@DeleteSubCat');
Route::get('edit/subcategory/{id}','Admin\Category\CategoryController@EditSubCat');
Route::post('update/subcategory/{id}','Admin\Category\CategoryController@UpdateSubCat'); 

//Coupon==========
Route::get('admin/coupon', 'Admin\CouponController@Coupon')->name('admin.coupon');
Route::post('admin/store/coupon', 'Admin\CouponController@StoreCoupon')->name('store.coupon');
Route::get('delete/coupon/{id}','Admin\CouponController@DeleteCoupon');
Route::get('edit/coupon/{id}','Admin\CouponController@EditCoupon');
Route::post('update/coupon/{id}','Admin\CouponController@UpdateCoupon'); 


//Others==========
Route::get('admin/newslater', 'Admin\CouponController@Newslater')->name('admin.newslater');
Route::get('delete/sub/{id}','Admin\CouponController@DeleteSub');
Route::get('admin/main_sliders', 'Admin\SliderController@index')->name('admin.main_sliders');
Route::get('admin/add/slider', 'Admin\SliderController@create')->name('add.main_sliders');
Route::post('admin/store/slider', 'Admin\SliderController@store')->name('store.slider');
Route::get('delete/slider/{id}','Admin\SliderController@destroy');
Route::get('edit/slider/{id}','Admin\SliderController@edit');
Route::post('update/slider/{id}','Admin\SliderController@update');
Route::get('admin/seo','Admin\CouponController@Seo')->name('admin.seo');
Route::post('admin/update/seo','Admin\CouponController@UpdateSeo')->name('update.seo');

//Products backend==========
Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');
Route::post('admin/store/product', 'Admin\ProductController@store')->name('store.product');
Route::get('inactive/product/{id}','Admin\ProductController@Inactive');
Route::get('active/product/{id}','Admin\ProductController@Active');
Route::get('delete/product/{id}','Admin\ProductController@DeleteProduct');
Route::get('edit/product/{id}','Admin\ProductController@EditProduct');
Route::post('update/product/withoutphoto/{id}','Admin\ProductController@UpdateProductWithoutPhoto');
Route::post('update/product/photo/{id}','Admin\ProductController@UpdateProductPhoto');
Route::get('view/product/{id}','Admin\ProductController@ViewProduct');
        // get subcat by ajax
Route::get('get/subcategory/{category_id}','Admin\ProductController@GetSubcat');

//Admin Posts==========
Route::get('admin/add/post', 'Admin\PostController@create')->name('add.blogpost');
Route::post('admin/store/post', 'Admin\PostController@store')->name('store.post');
Route::get('admin/all/post', 'Admin\PostController@index')->name('all.blogpost');
Route::get('delete/post/{id}','Admin\PostController@destroy');
Route::get('edit/post/{id}','Admin\PostController@edit');
Route::post('update/post/{id}','Admin\PostController@update');

//Admin order Routes==========
Route::get('admin/pending/order', 'Admin\OrderController@NewOrder')->name('admin.neworder');
Route::get('admin/view/order/{id}', 'Admin\OrderController@ViewOrder');
Route::get('admin/payment/accept/{id}', 'Admin\OrderController@PaymentAccept');
Route::get('admin/payment/cancel/{id}', 'Admin\OrderController@PaymentCancel');
Route::get('admin/accept/payment', 'Admin\OrderController@AcceptPaymentOrder')->name('admin.accept.payment');
Route::get('admin/cancel/payment', 'Admin\OrderController@CancelPaymentOrder')->name('admin.cancel.order');
Route::get('admin/progress/delivery', 'Admin\OrderController@ProgressDeliveryOrder')->name('admin.progress.delivery');
Route::get('admin/success/delivery', 'Admin\OrderController@SuccessDeliveryOrder')->name('admin.success.delivery');
Route::get('admin/delivery/progress/{id}', 'Admin\OrderController@DeliveryProgress');
Route::get('admin/delivery/done/{id}', 'Admin\OrderController@DeliveryDone');
Route::get('admin/product/stock', 'Admin\OrderController@Stock')->name('admin.product.stock');

//Admin Reports==========
Route::get('admin/today/order', 'Admin\ReportController@TodayOrder')->name('today.order');
Route::get('admin/today/deleverd', 'Admin\ReportController@TodayDelevered')->name('today.delevered');
Route::get('admin/this/month', 'Admin\ReportController@ThisMonth')->name('this.month');
Route::get('admin/search/report', 'Admin\ReportController@search')->name('search.report');
Route::post('admin/search/byyear', 'Admin\ReportController@searchByYear')->name('search.by.year');
Route::post('admin/search/bymonth', 'Admin\ReportController@searchByMonth')->name('search.by.month');
Route::post('admin/search/bydate', 'Admin\ReportController@searchByDate')->name('search.by.date');

//User Roles==========
Route::get('admin/create/role', 'Admin\UserRoleController@User_role')->name('create.user.role');
Route::get('admin/create/admin', 'Admin\UserRoleController@UserCreate')->name('create.admin');
Route::post('admin/store/admin', 'Admin\UserRoleController@UserStore')->name('store.admin');
Route::get('delete/admin/{id}', 'Admin\UserRoleController@UserDelete');
Route::get('edit/admin/{id}', 'Admin\UserRoleController@UserEdit');
Route::post('admin/update/admin', 'Admin\UserRoleController@UserUpdate')->name('update.admin');

//site setting
Route::get('admin/site/setting', 'Admin\SettingController@SiteSetting')->name('admin.site.setting');
Route::post('admin/update/sitesetting', 'Admin\SettingController@UpdateSetting')->name('update.sitesetting');

//database backup
Route::get('admin/database/backup', 'Admin\SettingController@DatabaseBackup')->name('admin.database.backup');
Route::get('admin/database/backup/now', 'Admin\SettingController@BackupNow')->name('admin.backup.now');
Route::get('delete/database/{getFilename}', 'Admin\SettingController@DeleteDatabase');  
Route::get('download/{getFilename}', 'Admin\SettingController@DownloadDatabase');  


//return or cancel products admin panel
 Route::get('admin/cancel/request', 'Admin\ReturnCancelController@request')->name('admin.cancel.request');
 Route::get('/admin/approve/cancel/{id}', 'Admin\ReturnCancelController@ApproveCancel');
 Route::get('admin/all/cancel', 'Admin\ReturnCancelController@AllCancel')->name('admin.all.cancel');

//Front==========
Route::post('store/newslater', 'FrontController@StoreNewslater')->name('store.newslater');
Route::get('products/{id}','ProductController@SubCategoryProduct');
Route::post('order/tracking', 'FrontController@OrderTracking')->name('order.tracking');
Route::get('request/cancel/{id}', 'PaymentController@RequestCancel');
//Route::post('full-text-search/action', 'ProductController@search_action')->name('full-text-search.action');
Route::get('full-text-search/action', 'ProductController@search_action')->name('full-text-search.action');
Route::get('single/blog/{id}','BlogController@SingleBlog');

Route::get('our_story','FrontController@our_story')->name('footer.our_story');
Route::get('privacy_policy','FrontController@privacy_policy')->name('footer.privacy_policy');
Route::get('terms_of_use','FrontController@terms_of_use')->name('footer.terms_of_use');
Route::get('faq','FrontController@faq')->name('footer.faq');
Route::get('contact_us','FrontController@contact_us')->name('footer.contact_us');

//wishlists
Route::get('add/wishlist/{id}','WishlistController@AddWishlist');

//cart
Route::get('add/to/cart/{id}','CartController@AddCart');
Route::get('check','CartController@check');
Route::get('/show-cart','CartController@ShowCart')->name('show.cart');
Route::get('remove/cart/{rowId}','CartController@RemoveCart');
Route::post('/update-cart','CartController@UpdateCart');
Route::get('cart/product/view/{id}','CartController@ViewProduct');
Route::post('insert/into/cart','CartController@InsertCart')->name('insert.into.cart');
Route::get('user/checkout','CartController@Checkout')->name('user.checkout');
Route::get('user/wishlist','CartController@Wishlist')->name('user.wishlist');
Route::post('user/apply/coupon','CartController@Coupon')->name('apply.coupon');
Route::get('user/remove/','CartController@CouponRemove')->name('coupon.remove');
Route::get('order/view/{id}','FrontController@ViewOrder');

//Payment ===========
Route::post('user/payment/process','PaymentController@Payment')->name('payment.process');
Route::post('user/payment/charge','PaymentController@StripeCharge')->name('stripe.charge');

//Route::name('webhooks.mollie')->post('webhooks/mollie', 'MollieWebhookController@handle');
Route::post('webhooks/mollie','PaymentController@Molliehandle')->name('webhooks.mollie');
Route::get('/payment-success','PaymentController@MolliepaymentSuccess')->name('payment.success');

//Products frontend==========
Route::get('product/details/{id}/{product_name}','ProductController@ProductView');
Route::post('cart/product/add/{product_id}','CartController@ProductAddCart');

//Blogs frontend==========
Route::get('blog/post/','BlogController@blog')->name('blog.post');
Route::get('blog/bangla/','BlogController@Bangla')->name('language.bangla');
Route::get('blog/english/','BlogController@English')->name('language.english');

// customer profile related routes (email must be verified)


// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END