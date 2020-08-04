<?php


Route::get('/','IndexController@index')->name('index');
Route::get('/san-pham/{id}','IndexController@products')->name('product_details');
Route::get('/danh-muc-san-pham/{category_id}','IndexController@categories')->name('categories');

Route::get('/gia-san-pham','IndexController@getPrice');

Route::get('/login-client','UsersController@login')->name('userLogin');

Route::post('/client-register','UsersController@register')->name('client_register');

Route::post('/client-login','UsersController@clientLogin')->name('client_login');

Route::get('/user-logout','UsersController@logout');

Route::group(['middleware'=>['frontLogin']],function (){
    Route::match(['get','post'],'/account','UsersController@account');
    Route::match(['get','post'],'/change-password','UsersController@changePassword');
    Route::match(['get','post'],'/change-address','UsersController@changeAddress');
});
//gio hang
Route::group(['namespace'=>'Client','as'=>'client.','middleware'=>['frontLogin']],function (){
    Route::match(['get','post'],'/add-cart','CartsController@addToCart');

    //trang gio hang
    Route::get('/cart','CartsController@getCart')->name('getCart');
    Route::post('/cart','CartsController@postCart');

    //delete cart
    Route::get('/cart/delete-product/{id}','CartsController@deleteCart')->name('deleteCart');

    //cap nhat gio hang
    Route::get('/cart/update-quantity/{id}/{quantity}','CartsController@updateCartQuantity')->name('updateCartQuantity');

    //cap nhat coupon
    Route::post('/cart/apply-coupon','CartsController@applyCoupon')->name('applyCoupon');

});

Route::get('/admin','IndexController@admin')->name('adminLogin');

Route::group(['as'=>'admin.','prefix'=>'/admin','namespace'=>'Admin','middleware'=>['auth','admin']],function (){
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('/categories','CategoryController');
    Route::resource('/banners','BannersController');

    Route::resource('/product','ProductController');
    //cap nhat trang thai san pham
    Route::post('/update-product-status','ProductController@updateStatus');

    //cap nhat so luong hang dang co
    Route::get('/add-attributes/{id}','ProductController@getAddAttributes')->name('getProductAttributes');
    Route::post('/add-attributes/{id}','ProductController@postAddAttributes')->name('postProductAttributes');
    Route::get('/delete-attributes/{id}','ProductController@deleteAttribute')->name('deleteAttribute');
    Route::match(['get','post'],'/edit-attribute/{id}','ProductController@editAttribute')->name('editAttribute');

    //cap nhat them anh cua san pham
    Route::get('/add-images/{id}','ProductController@getAddImages')->name('getProductImages');
    Route::post('/add-images','ProductController@postAddImages')->name('postProductImages');
    Route::get('/delete-alt-image/{id}','ProductController@deleteAltImage')->name('deleteAltImage');

    //coupons route
    Route::resource('/coupons','CouponsController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
