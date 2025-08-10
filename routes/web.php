<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CustomAuth\AuthController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\Category\SubCategoryController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Brand\BrandController;
use App\Http\Controllers\Backend\Color\ColorController;
use App\Http\Controllers\Backend\Discount\DiscountCodeController;
use App\Http\Controllers\Backend\Shipping\ShippingChargeController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Backend\Pages\PagesController;
use App\Http\Controllers\Backend\Setting\SystemSettingController;
use App\Http\Controllers\Backend\Setting\HomeSettingController;
use App\Http\Controllers\Backend\Slider\SliderController;
use App\Http\Controllers\Backend\Partner\PartnerController;
use App\Http\Controllers\Backend\Blog\BlogCategoryController;
use App\Http\Controllers\Backend\Blog\BlogController;

// use App\Http\Controllers\Frontend\ProductController as FrontendProduct;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Frontend\HomeController;

/*
|-------------------------------------------------------------------------- 
| Ecommerce Backend
|--------------------------------------------------------------------------
*/
    // -------------- CustomAuth ---------------   
Route::prefix('customAuths')->group(function(){
        // M1
        // Route::get('/login', 'App\Http\Controllers\Backend\CustomAuth\AuthController@adminLogin')->name('customAuths.login');
        // Route::post('/login', 'App\Http\Controllers\Backend\CustomAuth\AuthController@adminAuthLogin')->name('customAuths.auth');
        // Route::get('/logout', 'App\Http\Controllers\Backend\CustomAuth\AuthController@adminLogout')->name('customAuths.logout');
        // M2 OR
        // Route::get('/login', [App\Http\Controllers\Backend\CustomAuth\AuthController::class, 'adminLogin'])->name('customAuths.login');
        // Route::post('/login', [App\Http\Controllers\Backend\CustomAuth\AuthController::class, 'adminAuthLogin'])->name('customAuths.auth');
        // Route::get('/logout', [App\Http\Controllers\Backend\CustomAuth\AuthController::class, 'adminLogout'])->name('customAuths.logout');
        // M3 OR // if using the following must include|use path on the top
        Route::get('/login', [AuthController::class, 'adminLogin'])->name('customAuths.login');
        Route::post('/login', [AuthController::class, 'adminAuthLogin'])->name('customAuths.auth');
        Route::get('/logout', [AuthController::class, 'adminLogout'])->name('customAuths.logout');
        });

// -------------- User Middleware --------------- 
Route::group(['middleware' => 'userAuth'], function () {

    // -------------- User Dashboard --------------- /
    Route::get('user/dashboard', [App\Http\Controllers\Frontend\UserController::class, 'userDashboard'])->name('UserDashboard');
    Route::get('user/order', [App\Http\Controllers\Frontend\UserController::class, 'userOrder'])->name('UserOrder');
    Route::get('user/order/detail/{id}', [App\Http\Controllers\Frontend\UserController::class, 'userOrderDetail'])->name('UserOrderdetail');
    Route::get('user/edit-profile', [App\Http\Controllers\Frontend\UserController::class, 'userEditProfile'])->name('edit_Profile');
    Route::post('user/edit-profile', [App\Http\Controllers\Frontend\UserController::class, 'userUpdateProfile'])->name('update_Profile');

    Route::get('user/change-password', [App\Http\Controllers\Frontend\UserController::class, 'userChangePassword'])->name('change_Password');
    Route::post('user/change-password', [App\Http\Controllers\Frontend\UserController::class, 'userUpdatePassword'])->name('change_Password');
    Route::post('add_to_wishlist', [App\Http\Controllers\Frontend\UserController::class, 'userAddToWishlist'])->name('add_To_Wishlist');

    Route::post('user/make-review', [App\Http\Controllers\Frontend\UserController::class, 'userReview'])->name('user_review');

    //... UserNotification
    Route::get('user/notification', [App\Http\Controllers\Frontend\UserController::class, 'userNotification'])->name('UserNotification');
    //... /UserNotification


    Route::get('my-wishlist', [App\Http\Controllers\Frontend\ProductController::class, 'myWishlist'])->name('my_Wishlist');
    

    Route::post('blog/submit_comment', [HomeController::class, 'submitBlogComment']);


});


// -------------- Admin Middleware --------------- 
Route::group(['middleware' => 'adminAuth'], function () {

    // -------------- Dashboard --------------- 
    Route::get('backend/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'dashboard'])->name('dashboards');
    
    // -------------- Admins --------------- 
    Route::prefix('admins/')->group(function(){
        Route::get('admin/list', [App\Http\Controllers\Backend\Admin\AdminController::class, 'ListAdmin'])->name('admins.list');
        Route::get('admin/add', [App\Http\Controllers\Backend\Admin\AdminController::class, 'addAdmin'])->name('admins.add');
        Route::post('admin/add', [App\Http\Controllers\Backend\Admin\AdminController::class, 'insertAdmin'])->name('admins.add');
        Route::get('admin/edit/{id}', [App\Http\Controllers\Backend\Admin\AdminController::class, 'editAdmin'])->name('admins.edit');
        Route::post('admin/edit/{id}', [App\Http\Controllers\Backend\Admin\AdminController::class, 'updateAdmin'])->name('admins.edit');
        Route::get('admin/delete/{id}', [App\Http\Controllers\Backend\Admin\AdminController::class, 'deleteAdmin'])->name('admins.delete');
        Route::get('customer/list', [App\Http\Controllers\Backend\Admin\AdminController::class, 'Listcustomer']);
    });

    //  // -------------- customers --------------- 
    // Route::prefix('customers/')->group(function(){
    //     Route::get('customer/list', [App\Http\Controllers\Backend\Customer\CustomerController::class, 'Listcustomer'])->name('customers.list');
    //     Route::get('customer/add', [App\Http\Controllers\Backend\Customer\CustomerController::class, 'addcustomer'])->name('customers.add');
    //     Route::post('customer/add', [App\Http\Controllers\Backend\Customer\CustomerController::class, 'insertcustomer'])->name('customers.add');
    //     Route::get('customer/edit/{id}', [App\Http\Controllers\Backend\Customer\CustomerController::class, 'editcustomer'])->name('customers.edit');
    //     Route::post('customer/edit/{id}', [App\Http\Controllers\Backend\Customer\CustomerController::class, 'updatecustomer'])->name('customers.edit');
    //     Route::get('customer/delete/{id}', [App\Http\Controllers\Backend\Customer\CustomerController::class, 'deletecustomer'])->name('customers.delete');
    // });

    // -------------- Orders --------------- 
    Route::prefix('orders/')->group(function(){
        Route::get('order/list', [OrderController::class, 'listOrder'])->name('orders.list');
        Route::get('order/detail/{id}', [OrderController::class, 'detailOrder'])->name('orders.detail');
        Route::get('order/status', [OrderController::class, 'orderStatus'])->name('orders.status');
    });


    // -------------- Category --------------- 
    Route::prefix('categories/')->group(function(){
        Route::get('category/list', [CategoryController::class, 'listCategory'])->name('categories.list');
        Route::get('category/add', [CategoryController::class, 'addCategory'])->name('categories.add');
        Route::post('category/add', [CategoryController::class, 'insertCategory'])->name('categories.add');
        Route::get('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('categories.edit');
        Route::post('category/edit/{id}', [CategoryController::class, 'updateCategory'])->name('categories.edit');
        Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('categories.delete');
    });

    // -------------- Sub Category --------------- 
    Route::prefix('subCategories/')->group(function(){
        Route::get('subCategory/list', [SubCategoryController::class, 'listsubCategory'])->name('subCategories.list');
        Route::get('subCategory/add', [SubCategoryController::class, 'addsubCategory'])->name('subCategories.add');
        Route::post('subCategory/add', [SubCategoryController::class, 'insertSubCategory'])->name('subCategories.add');
        Route::get('subCategory/edit/{id}', [SubCategoryController::class, 'editsubCategory'])->name('subCategories.edit');
        Route::post('subCategory/edit/{id}', [SubCategoryController::class, 'updatesubCategory'])->name('subCategories.edit');
        Route::get('subCategory/delete/{id}', [SubCategoryController::class, 'deletesubCategory'])->name('subCategories.delete');
        Route::post('subCategory/get_sub_categories', [SubCategoryController::class, 'getSubCategories'])->name('subCategories.get_sub_categories');
    });

     // -------------- Brand ---------------
    Route::prefix('brands/')->group(function(){
        Route::get('brand/list', [BrandController::class, 'listBrand'])->name('brands.list');
        Route::get('brand/add', [BrandController::class, 'addBrand'])->name('brands.add');
        Route::post('brand/add', [BrandController::class, 'insertBrand'])->name('brands.add');
        Route::get('brand/edit/{id}', [BrandController::class, 'editBrand'])->name('brands.edit');
        Route::post('brand/edit/{id}', [BrandController::class, 'updateBrand'])->name('brands.edit');
        Route::get('brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('brands.delete');
    });

    // -------------- Color ---------------
    Route::prefix('colors/')->group(function(){
        Route::get('color/list', [ColorController::class, 'listColor'])->name('colors.list');
        Route::get('color/add', [ColorController::class, 'addColor'])->name('colors.add');
        Route::post('color/add', [ColorController::class, 'insertColor'])->name('colors.add');
        Route::get('color/edit/{id}', [ColorController::class, 'editColor'])->name('colors.edit');
        Route::post('color/edit/{id}', [ColorController::class, 'updateColor'])->name('colors.edit');
        Route::get('color/delete/{id}', [ColorController::class, 'deleteColor'])->name('colors.delete');
    });

    // -------------- Product ---------------
    Route::prefix('products/')->group(function(){
        Route::get('product/list', [ProductController::class, 'listProduct'])->name('products.list');
        Route::get('product/add', [ProductController::class, 'addProduct'])->name('products.add');
        Route::post('product/add', [ProductController::class, 'insertProduct'])->name('products.add');
        Route::get('product/edit/{id}', [ProductController::class, 'editProduct'])->name('products.edit');
        Route::post('product/edit/{id}', [ProductController::class, 'updateProduct'])->name('products.edit');
        Route::get('product/imageDelete/{id}', [ProductController::class, 'deleteProductImage'])->name('products.imageDelete');
        Route::post('product/sortableImage', [ProductController::class, 'sortableProductImage'])->name('products.sortableImage');
    });

    // -------------- Discount Code ---------------
    Route::prefix('discountCodes/')->group(function(){
        Route::get('discountCode/list', [DiscountCodeController::class, 'listDiscountCode'])->name('discountCodes.list');
        Route::get('discountCode/add', [DiscountCodeController::class, 'addDiscountCode'])->name('discountCodes.add');
        Route::post('discountCode/add', [DiscountCodeController::class, 'insertDiscountCode'])->name('discountCodes.add');
        Route::get('discountCode/edit/{id}', [DiscountCodeController::class, 'editDiscountCode'])->name('discountCodes.edit');
        Route::post('discountCode/edit/{id}', [DiscountCodeController::class, 'updateDiscountCode'])->name('discountCodes.edit');
        Route::get('discountCode/delete/{id}', [DiscountCodeController::class, 'deleteDiscountCode'])->name('discountCodes.delete');
    });

    // -------------- ShippingCharge ---------------
    Route::prefix('shipping_charges/')->group(function(){
        Route::get('shipping_charge/list', [ShippingChargeController::class, 'listShippingCharge'])->name('shipping_charges.list');
        Route::get('shipping_charge/add', [ShippingChargeController::class, 'addShippingCharge'])->name('shipping_charges.add');
        Route::post('shipping_charge/add', [ShippingChargeController::class, 'insertShippingCharge'])->name('shipping_charges.add');
        Route::get('shipping_charge/edit/{id}', [ShippingChargeController::class, 'editShippingCharge'])->name('shipping_charges.edit');
        Route::post('shipping_charge/edit/{id}', [ShippingChargeController::class, 'updateShippingCharge'])->name('shipping_charges.edit');
        Route::get('shipping_charge/delete/{id}', [ShippingChargeController::class, 'deleteShippingCharge'])->name('shipping_charges.delete');
    });

    // -------------- Slider ---------------
    Route::prefix('sliders/')->group(function(){
        Route::get('slider/list', [SliderController::class, 'sliderList'])->name('sliders.list');
        Route::get('slider/add', [SliderController::class, 'sliderAdd'])->name('sliders.add');
        Route::post('slider/add', [SliderController::class, 'sliderInsert'])->name('sliders.add');
        Route::get('slider/edit/{id}', [SliderController::class, 'sliderEdit'])->name('sliders.edit');
        Route::post('slider/edit/{id}', [SliderController::class, 'sliderUpdate'])->name('sliders.edit');
        Route::get('slider/delete/{id}', [SliderController::class, 'sliderDelete'])->name('sliders.delete');
    });


    // -------------- Business Partner Logo  ---------------
    Route::prefix('partners/')->group(function(){
        Route::get('partner/list', [PartnerController::class, 'partnerList'])->name('partners.list');
        Route::get('partner/add', [PartnerController::class, 'partnerAdd'])->name('partners.add');
        Route::post('partner/add', [PartnerController::class, 'partnerInsert'])->name('partners.add');
        Route::get('partner/edit/{id}', [PartnerController::class, 'partnerEdit'])->name('partners.edit');
        Route::post('partner/edit/{id}', [PartnerController::class, 'partnerUpdate'])->name('partners.edit');
        Route::get('partner/delete/{id}', [PartnerController::class, 'partnerDelete'])->name('partners.delete');
    });


     // -------------- Pages ---------------
    Route::prefix('pages/')->group(function(){
        Route::get('page/list', [PagesController::class, 'listPage'])->name('pages.list');
        Route::get('page/add', [PagesController::class, 'addPage'])->name('pages.add');
        Route::post('page/add', [PagesController::class, 'insertPage'])->name('pages.add');
        Route::get('page/edit/{id}', [PagesController::class, 'editPage'])->name('pages.edit');
        Route::post('page/edit/{id}', [PagesController::class, 'updatePage'])->name('pages.edit');
    });

    // -------------- Blog categoy --------------- 
    Route::prefix('blogs/')->group(function(){
        Route::get('categoy/list', [BlogCategoryController::class, 'listBlogCategoy'])->name('blogs.list');
        Route::get('categoy/add', [BlogCategoryController::class, 'addBlogCategoy'])->name('blogs.add');
        Route::post('categoy/add', [BlogCategoryController::class, 'insertBlogCategoy'])->name('blogs.add');
        Route::get('categoy/edit/{id}', [BlogCategoryController::class, 'editBlogCategoy'])->name('blogs.edit');
        Route::post('categoy/edit/{id}', [BlogCategoryController::class, 'updateBlogCategoy'])->name('blogs.edit');
        Route::get('categoy/delete/{id}', [BlogCategoryController::class, 'deleteBlogCategoy'])->name('blogs.delete');

        });

    // -------------- Blog --------------- 
    Route::prefix('bblogs/')->group(function(){
        Route::get('blog/list', [BlogController::class, 'listBlog'])->name('bblogs.list');
        Route::get('blog/add', [BlogController::class, 'addBlog'])->name('bblogs.add');
        Route::post('blog/add', [BlogController::class, 'insertBlog'])->name('bblogs.add');
        Route::get('blog/edit/{id}', [BlogController::class, 'editBlog'])->name('bblogs.edit');
        Route::post('blog/edit/{id}', [BlogController::class, 'updateBlog'])->name('bblogs.edit');
        Route::get('blog/delete/{id}', [BlogController::class, 'deleteBlog'])->name('bblogs.delete');

        });


    // -------------- contactus ---------------
    Route::prefix('contacts/')->group(function(){
        Route::get('contactus/list', [PagesController::class, 'contactUsList'])->name('contacts.list');
        Route::get('contactus/delete/{id}', [PagesController::class, 'contactUsDelete'])->name('contacts.delete');
    });


    // -------------- Setting --------------- 
    //system setting
    Route::prefix('settings/')->group(function(){
        Route::get('system-setting', [SystemSettingController::class, 'systemSetting'])->name('settings.systemSet');
        Route::post('system-setting', [SystemSettingController::class, 'updateSystemSetting'])->name('settings.upSystemSet');
    });

    //home setting
    Route::prefix('hsettings/')->group(function(){
        Route::get('home-setting', [HomeSettingController::class, 'homeSetting'])->name('hsettings.homeSet');
        Route::post('home-setting', [HomeSettingController::class, 'updatehomeSetting'])->name('hsettings.uphomeSet');
    });

    //SMTP setting
    Route::prefix('emails/')->group(function(){
        Route::get('smtp-setting', [HomeSettingController::class, 'smtpSetting'])->name('emails.smtp');
        Route::post('smtp-setting', [HomeSettingController::class, 'updateSMPTsetting'])->name('emails.updsmtp');
    });

    //SMTP setting
    Route::prefix('payments/')->group(function(){
        Route::get('payment-setting', [HomeSettingController::class, 'paymentSetting'])->name('payments.payment');
        Route::post('payment-setting', [HomeSettingController::class, 'updatePaymentSetting'])->name('payments.updpayment');
    });
    // -------------- /Setting ---------------


    // -------------- /notification --------------- 
     Route::get('admin/notification', [HomeSettingController::class, 'notification'])->name('NotiFication');


});
/*
|--------------------------------------------------------------------------
|   /Ecommerce Backend
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Ecommerce Frontend
|--------------------------------------------------------------------------
*/

 // -------------- Dashboard --------------- 
// Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'home'])->name('dashboards');

Route::get('/', [HomeController::class, 'home'])->name('dashboards');

Route::get('contact', [HomeController::class, 'contact']);
Route::post('contact', [HomeController::class, 'submitContact']);
Route::get('about', [HomeController::class, 'about']);

Route::get('blog', [HomeController::class, 'blog']);
Route::get('blog/category/{slug}', [HomeController::class, 'blogCategory']);
Route::get('blog/{slug}', [HomeController::class, 'blogDetail']);


Route::get('faq', [HomeController::class, 'faq']);
Route::get('payment-methods', [HomeController::class, 'paymentMethods']);
Route::get('money-back-guarantee', [HomeController::class, 'moneyBackGuarantee']);
Route::get('returns', [HomeController::class, 'returns']);
Route::get('shipping', [HomeController::class, 'shipping']);
Route::get('terms-conditions', [HomeController::class, 'termsConditions']);
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy']);

Route::post('recent_arrival_category_product', [HomeController::class, 'recentArrivalCategoryProduct']);

// Route::get('track-my-order', [HomeController::class, 'trackMyOrder']);







// -------------- Frontend auth register ---------------
Route::post('frontend_auth_register', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'frontendAuthRegister'])->name('FrontAuthRegRoute');
Route::post('frontend_auth_login', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'frontendAuthLogin'])->name('FrontAuthLoginRoute');

// -------------- Frontend Forgot Password ---------------
Route::get('forgot_password', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'frontendForgotPassword'])->name('FrontForgotPassword');
Route::post('forgot_password', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'frontendAuthForgotPassword'])->name('FrontAuthForgotPassword');
Route::get('reset/{token}', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'frontendResetPassword'])->name('reset_password');
Route::post('reset/{token}', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'frontendAuthResetPassword'])->name('Areset_password');
Route::get('activate/{id}', [App\Http\Controllers\Frontend\FrontendAuthController::class, 'activateEmail'])->name('activate_email');

// -------------- Add to cart --------------- 
// Route::post('product/addToCart', [App\Http\Controllers\Payments\PaymentController::class, 'addToCart']);
 // OR
Route::get('cart', [PaymentController::class, 'cart']);
Route::get('cart/delete/{id}', [PaymentController::class, 'deleteCart']);
Route::post('update_cart', [PaymentController::class, 'updateCart']);
Route::get('checkout', [PaymentController::class, 'checkOut']);
Route::post('checkout/apply_discount_code', [PaymentController::class, 'applyDiscountCode']);
Route::post('checkout/place_order', [PaymentController::class, 'placeOrder']);
Route::get('checkout/payment', [PaymentController::class, 'checkoutPayment']);
Route::get('paypal/success-payment', [PaymentController::class, 'paypalSuccessPayment']);
Route::get('stripe/success-payment', [PaymentController::class, 'stripeSuccessPayment']);
Route::post('product/addToCart', [PaymentController::class, 'addToCart']);


// -------------- Search Products  in search bar --------------- 
Route::get('search', [App\Http\Controllers\Frontend\ProductController::class, 'getSearchProduct'])->name('searchroute');
// -------------- Filter/search Product by category and sub category --------------- 
Route::post('get_filter_product_ajax', [App\Http\Controllers\Frontend\ProductController::class, 'getFilterProductAjax'])->name('filterProductAjax');
// Route::get('{slug?}/{subslug?}', [App\Http\Controllers\Frontend\ProductController::class, 'getCategoryAndSub'])->name('frontendProduct');
Route::get('{category?}/{subCategoy?}', [App\Http\Controllers\Frontend\ProductController::class, 'getCategoryAndSub'])->name('frontendProduct');
// -------------- /Filter/search Product by category and sub category --------------- 



/*
|--------------------------------------------------------------------------
|  /Ecommerce Frontend
|--------------------------------------------------------------------------
*/