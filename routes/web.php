<?php



Route::get('/', function () {return view('pages.index');});
//auth & user
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
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

//Products==========
Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');
Route::post('admin/store/product', 'Admin\ProductController@store')->name('store.product');
        // get subcat by ajax
Route::get('get/subcategory/{category_id}','Admin\ProductController@GetSubcat');



//Front==========
Route::post('store/newslater', 'FrontController@StoreNewslater')->name('store.newslater');