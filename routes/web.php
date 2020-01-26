<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Contact;
use App\Subscription;
use Carbon\Carbon;




Route::get('/', 'Frontend\HomeController@index')->name('frontend.index');
Route::get('/faq', 'Frontend\HomeController@fag')->name('frontend.faq');
Route::get('/contact', 'Frontend\HomeController@contact')->name('frontend.contact');
Route::get('/set-locale', 'Frontend\HomeController@setLocale')->name('set-locale');
Route::get("/about-us", 'Frontend\HomeController@about')->name("about");
Route::get("/shop", 'Frontend\HomeController@shop')->name("shop.index");
Route::get("/shop/{product}", 'Frontend\HomeController@product')->name("shop.product");
Route::get("/shopping-cart", 'Frontend\HomeController@cart')->name("shop.cart");
Route::post("/shop/save_session_value", 'Frontend\HomeController@save_session_value')->name("shop.save_session_value");




Route::get("/article/{slug}", 'Frontend\HomeController@article_show')->name("front.article.show");
//header payment
Route::get('/payment', 'Frontend\HomeController@payment')->name('frontend.payment');



Route::middleware('auth')->group(function () {
    Route::get('/profile', 'Frontend\ProfileController@index')->name('profile');
    Route::get('/order/{package_id}', 'Frontend\OrderController@subscribe')->name('order.subscribe');
    Route::get('/how-to-connect','Frontend\ProfileController@connect')->name('profile.connect');
    Route::get('/how-to-connect-via-subscription/{id}','Frontend\ProfileController@connectSubscribe')->name('profile.connect_via_sub');
    Route::post('/order/{package_id}', 'Frontend\OrderController@order')->name('order.order');
    Route::post('/order/pay/{order_id}', 'Frontend\OrderController@paymentPage')->name('order.payment');
    Route::post('/change-pass', 'Frontend\ProfileController@changepass')->name('change-pass');
    Route::get('/order-test', 'Frontend\OrderController@paymentResult');
    Route::post('/service/detail', 'Frontend\ProfileController@serviceDetail')->name('service.detail');
    Route::get("/select-package/{package_id}", 'Frontend\OrderController@selectPackage')->name("frontend.select-package");
    Route::post("/merger-package/{package_id}", 'Frontend\OrderController@mergePackage')->name("frontend.merge-package");
    Route::post("/profile/code", 'Frontend\ProfileController@searchCouponCode')->name("frontend.search.coupon");

});

Auth::routes();

Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::middleware(['auth:admin','role:admin|super-admin'])->prefix('admin')->group(function() {
    Route::get('/','Admin\AdminController@index')->name('admin.home');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin.home');
    Route::get('/profile', 'Admin\AdminController@profile')->name('admin.profile');
    Route::Resource('language', 'Admin\LanguageController');
    Route::Resource('package', 'Admin\PackageController');
    Route::Resource('faq', 'Admin\FaqController');
    Route::Resource('contact', 'Admin\ContactController');
    Route::Resource('about', 'Admin\AboutController');
    Route::Resource('article', 'Admin\ArticleController');
    Route::Resource('content', 'Admin\ContentController');
    Route::Resource('promocode', 'Admin\PromocodeController');
    Route::Resource('payment_methods', 'Admin\PaymentMethodsController');

    Route::Resource('user', 'Admin\UserController',[
        'except' => ['destroy']
    ]);
    Route::delete('user/{user}', 'Admin\UserController@destroy')->name('user.destroy')->middleware('role:super-admin|admin');


    Route::Resource('subscription', 'Admin\SubscriptionController');
    Route::Resource('service', 'Admin\ServiceController');
    Route::Resource('period', 'Admin\PeriodController');
    Route::Resource('license', 'Admin\LicenseController');
    Route::Resource('payment', 'Admin\PaymentController');
    Route::Resource('tariff', 'Admin\TariffController');
    Route::Resource('coupon', 'Admin\CouponController');
    Route::Resource('roles', 'Admin\RolesController',[
        'except' => ['edit', 'update']
    ]);
    Route::post('/coupon/services','Admin\CouponController@getServices')->name('admin.coupon.services');

    Route::Resource('user_roles', 'Admin\UserRolesController')->except('edit','update');
    Route::get('user_roles/{role_id}/{user_id}/edit', 'Admin\UserRolesController@edit')->name('user_roles.edit')->middleware('role:super-admin|admin');
    Route::put('user_roles/{role_id}/{user_id}', 'Admin\UserRolesController@update')->name('user_roles.update')->middleware('role:super-admin|admin');

    Route::post('/change-pass/{id}','Admin\AdminController@changePass')->name('admin.change-pass');
    Route::post('/modal','Admin\UserController@modal')->name('admin.modal');

    Route::post('/package/activate','Admin\PackageController@activate');
    Route::post('/license/activate','Admin\LicenseController@activate');
    Route::post('/license/status','Admin\LicenseController@status');
    Route::post('/article/activate','Admin\ArticleController@activate');
    Route::post('/content/activate','Admin\ContentController@activate');
    Route::post('/promocode/activate','Admin\Promocode@activate');


    Route::resource("/product", 'Admin\ProductController');
});

// Baku electronics panel

Route::middleware(['auth:admin','role:be|admin|super-admin'])->prefix('be')->group(function() {
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('be.logout');
    Route::get("/", 'Be\HomeController@index')->name('be.home');
});

Route::middleware(['auth:admin','role:be|admin|super-admin'])->prefix('be')->name('be.')->group(function() {
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('logout');
    Route::get("/", 'Be\HomeController@index')->name('home');
    Route::get('/license-keys', 'Be\HomeController@licenseKeys')->name('license-keys');
    Route::Resource('customers', 'Be\CustomerController');
    Route::post('customers/detail', 'Be\CustomerController@detail')->name('customers.detail');
    Route::post('customers/get-packages', 'Be\CustomerController@getPackages')->name('customers.get-packages');
    Route::post('print', 'Be\CustomerController@print')->name('customers.print');;
});

Route::post("/send-message",'Frontend\HomeController@sendMessage')->name('frontend.sendMessage');
Route::post('/read-all','Admin\AdminController@readAllMessages');






Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    return "Cache is cleared";
});

Route::get('/update', function (){
    $subscriptions = Subscription::where('deadline', '<', Carbon::now())->get();
    foreach ($subscriptions as $subscription) {
        $subscription->status = 0;
        $subscription->save();
    }    return 'ok';
});
