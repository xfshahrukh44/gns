<?php

use App\Http\Controllers\FrontController;
use App\Jobs\CreateCategory;
use App\Jobs\CreateFastenalProduct;
use App\Jobs\CreateTifcoProduct;
use App\Jobs\UpdateCategoryImage;
use App\Jobs\UpdateFastenalSkus;
use App\Jobs\UpdateTifcoSkus;
use App\Models\Bikecheck;
use App\Models\GlobalMember;
use App\Models\HowTo;
use App\Models\News;
use App\Models\UsMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


//===================== Admin Routes =====================//

Route::group(['middleware' => ['auth', 'roles'], 'roles' => 'admin', 'prefix' => 'admin'], function () {


    Route::get('/', 'Admin\AdminController@dashboard');

    Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');

    Route::get('account/settings', 'Admin\UsersController@getSettings');
    Route::post('account/settings', 'Admin\UsersController@saveSettings');

    Route::get('project', function () {
        return view('dashboard.index-project');
    });

    Route::get('analytics', function () {
        return view('admin.dashboard.index-analytics');
    });


    Route::get('logo/edit', 'Admin\AdminController@logoEdit')->name('admin.logo.edit');
    Route::post('logo/upload', 'Admin\AdminController@logoUpload')->name('logo_upload');

    Route::get('favicon/edit', 'Admin\AdminController@faviconEdit')->name('admin.favicon.edit');

    Route::post('favicon/upload', 'Admin\AdminController@faviconUpload')->name('favicon_upload');

    Route::get('config/setting', 'Admin\AdminController@configSetting')->name('admin.config.setting');

    Route::get('contact/inquiries', 'Admin\AdminController@contactSubmissions');
    Route::get('contact/inquiries/{id}', 'Admin\AdminController@inquiryshow');
    Route::get('newsletter/inquiries', 'Admin\AdminController@newsletterInquiries');

    Route::any('contact/submissions/delete/{id}', 'Admin\AdminController@contactSubmissionsDelete');
    Route::any('newsletter/inquiries/delete/{id}', 'Admin\AdminController@newsletterInquiriesDelete');

    /* Config Setting Form Submit Route */
    Route::post('config/setting', 'Admin\AdminController@configSettingUpdate')->name('config_settings_update');


//==============================================================//

//==================== Error pages Routes ====================//
    Route::get('403', function () {
        return view('pages.403');
    });

    Route::get('404', function () {
        return view('pages.404');
    });

    Route::get('405', function () {
        return view('pages.405');
    });

    Route::get('500', function () {
        return view('pages.500');
    });
//============================================================//

    #Permission management
    Route::get('permission-management', 'PermissionController@getIndex');
    Route::get('permission/create', 'PermissionController@create');
    Route::post('permission/create', 'PermissionController@save');
    Route::get('permission/delete/{id}', 'PermissionController@delete');
    Route::get('permission/edit/{id}', 'PermissionController@edit');
    Route::post('permission/edit/{id}', 'PermissionController@update');

    #Role management
    Route::get('role-management', 'RoleController@getIndex');
    Route::get('role/create', 'RoleController@create');
    Route::post('role/create', 'RoleController@save');
    Route::get('role/delete/{id}', 'RoleController@delete');
    Route::get('role/edit/{id}', 'RoleController@edit');
    Route::post('role/edit/{id}', 'RoleController@update');

    #CRUD Generator
    Route::get('/crud-generator', ['uses' => 'ProcessController@getGenerator']);
    Route::post('/crud-generator', ['uses' => 'ProcessController@postGenerator']);

    # Activity log
    Route::get('activity-log', 'LogViewerController@getActivityLog');
    Route::get('activity-log/data', 'LogViewerController@activityLogData')->name('activity-log.data');

    #User Management routes
    Route::get('users', 'Admin\\UsersController@Index');
    Route::get('user/create', 'Admin\\UsersController@create');
    Route::post('user/create', 'Admin\\UsersController@save');
    Route::get('user/edit/{id}', 'Admin\\UsersController@edit');
    Route::post('user/edit/{id}', 'Admin\\UsersController@update');
    Route::get('user/delete/{id}', 'Admin\\UsersController@destroy');
    Route::get('user/deleted/', 'Admin\\UsersController@getDeletedUsers');
    Route::get('user/restore/{id}', 'Admin\\UsersController@restoreUser');


    Route::resource('product', 'Admin\\ProductController');
    Route::get('product/{id}/delete', ['as' => 'product.delete', 'uses' => 'Admin\\ProductController@destroy']);
    Route::get('order/list', ['as' => 'order.list', 'uses' => 'Admin\\ProductController@orderList']);
    Route::get('order/detail/{id}', ['as' => 'order.list.detail', 'uses' => 'Admin\\ProductController@orderListDetail']);

    //Order Status Change Routes//
    Route::get('status/completed/{id}', 'Admin\\ProductController@updatestatuscompleted')->name('status.completed');
    Route::get('status/pending/{id}', 'Admin\\ProductController@updatestatusPending')->name('status.pending');


});

//==============================================================//

//Log Viewer
Route::get('log-viewers', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log-viewers');
Route::get('log-viewers/logs', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log-viewers.logs');
Route::delete('log-viewers/logs/delete', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log-viewers.logs.delete');
Route::get('log-viewers/logs/{date}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log-viewers.logs.show');
Route::get('log-viewers/logs/{date}/download', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log-viewers.logs.download');
Route::get('log-viewers/logs/{date}/{level}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log-viewers.logs.filter');
Route::get('log-viewers/logs/{date}/{level}/search', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('log-viewers.logs.search');
Route::get('log-viewers/logcheck', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@logCheck')->name('log-viewers.logcheck');


Route::get('auth/{provider}/', 'Auth\SocialLoginController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\SocialLoginController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();


//===================== Account Area Routes =====================//


Route::get('signin', 'GuestController@signin')->name('signin');
Route::get('signup', 'GuestController@signup')->name('signup');
Route::get('account', 'LoggedInController@account')->name('account');
Route::get('orders', 'LoggedInController@orders')->name('orders');
Route::get('account-detail', 'LoggedInController@accountDetail')->name('accountDetail');

Route::post('update/account', 'LoggedInController@updateAccount')->name('update.account');
Route::get('signout', function () {
    Auth::logout();

    Session::flash('flash_message', 'You have logged out  Successfully');
    Session::flash('alert-class', 'alert-success');

    return redirect('signin');
});

Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();

Route::get('account/friends', 'LoggedInController@friends')->name('friends');
Route::get('account/upload', 'LoggedInController@upload')->name('upload');
Route::get('account/password', 'LoggedInController@password')->name('password');

Route::get('/success', 'OrderController@success')->name('success');

Route::post('update/profile', 'LoggedInController@update_profile')->name('update_profile');
Route::post('update/uploadPicture', 'LoggedInController@uploadPicture')->name('uploadPicture');


//===================== Front Routes =====================//

Route::get('/product/{cat?}/{subcat?}/{childsubcat?}', 'HomeController@product')->name('product');
Route::get('/product_detail/{id?}/{cat?}/{subcat?}/{childsubcat?}', 'HomeController@product_detail')->name('product_detail');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/blog_detail/{id?}', 'HomeController@blog_detail')->name('blog_detail');

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('front.about');
Route::get('/categories', [FrontController::class, 'categories'])->name('front.categories');
Route::get('/category-detail/{id}', [FrontController::class, 'categoryDetail'])->name('front.categoryDetail');
Route::get('/compare', [FrontController::class, 'compare'])->name('front.compare');
Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
Route::get('/product-detail/{id}', [FrontController::class, 'productDetail'])->name('front.productDetail');
Route::get('/shop', [FrontController::class, 'shop'])->name('front.shop');
Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('front.wishlist');

Route::get('/bio', 'FrontController@bio')->name('front.bio');
Route::get('/featured', 'FrontController@featured')->name('front.featured');
Route::get('/featured-detail/{id}', 'FrontController@featuredDetail')->name('front.featuredDetail');
Route::get('/books', 'FrontController@books')->name('front.books');
Route::get('/book-detail/{id}', 'FrontController@bookDetail')->name('front.bookDetail');
Route::get('/articles', 'FrontController@articles')->name('front.articles');
Route::get('/article-detail/{id}', 'FrontController@articleDetail')->name('front.articleDetail');
Route::get('/videos', 'FrontController@videos')->name('front.videos');
Route::get('/blog', 'FrontController@blog')->name('front.blog');
Route::get('/my-account', 'FrontController@myAccount')->name('front.myAccount');
Route::get('/bike-checks', 'FrontController@bikeChecks')->name('front.bikeChecks');
Route::get('/bike-check-detail/{id}', 'FrontController@bikeCcheckDetail')->name('front.bikeCcheckDetail');
Route::get('/distributors', 'FrontController@distributors')->name('front.distributors');
Route::get('/factory-race-team', 'FrontController@factoryRaceTeam')->name('front.factoryRaceTeam');
Route::get('/faqs', 'FrontController@faqs')->name('front.faqs');
Route::get('/freestyle-global-family', 'FrontController@freestyleGlobalFamily')->name('front.freestyleGlobalFamily');
Route::get('/freestyle-us-family', 'FrontController@freestyleUsFamily')->name('front.freestyleUsFamily');
Route::get('/history', 'FrontController@history')->name('front.history');
Route::get('/how-tos', 'FrontController@howTos')->name('front.howTos');
Route::get('/how-to-detail/{id}', 'FrontController@howToDetail')->name('front.howToDetail');
Route::get('/jobs', 'FrontController@jobs')->name('front.jobs');
Route::get('/job-detail/{id}', 'FrontController@jobDetail')->name('front.jobDetail');
Route::post('/submit-job-application', 'JobApplicationController@submitJobApplication')->name('front.submitJobApplication');
Route::get('/manufacturing', 'FrontController@manufacturing')->name('front.manufacturing');
Route::get('/news', 'FrontController@news')->name('front.news');
Route::get('/news/{id}', 'FrontController@newsDetail')->name('front.newsDetail');
Route::get('/recycling', 'FrontController@recycling')->name('front.recycling');
Route::get('/returns', 'FrontController@returns')->name('front.returns');
Route::get('/shipping', 'FrontController@shipping')->name('front.shipping');
Route::get('/terms', 'FrontController@terms')->name('front.terms');
Route::get('/support', 'FrontController@support')->name('front.support');
Route::get('/measurements', 'FrontController@measurements')->name('front.measurements');
Route::get('/warranty-info', 'FrontController@warrantyInfo')->name('front.warrantyInfo');
Route::get('/privacy', 'FrontController@privacy')->name('front.privacy');

Route::get('/set_sub_category', 'Admin\ProductController@set_sub_category')->name('set_sub_category');
Route::get('/set_child_sub_category', 'Admin\ProductController@set_child_sub_category')->name('set_child_sub_category');


Route::get('upcoming-classes', 'HomeController@upcoming_classes')->name('upcoming-classes');
Route::get('online-classes/{id?}', 'HomeController@online_classes')->name('classes');
Route::get('learn-to-play', 'HomeController@play')->name('play');
// Route::get('store','HomeController@store')->name('store');


Route::post('careerSubmit', 'HomeController@careerSubmit')->name('contactUsSubmit');
Route::post('newsletter-submit', 'HomeController@newsletterSubmit')->name('newsletterSubmit');
Route::post('update-content', 'HomeController@updateContent')->name('update-content');

//=================================================================//

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::get('/temp', function () {
    //291 > 278
    \Illuminate\Support\Facades\DB::table('categories')->where('parent_id', 291)->update(['parent_id' => 278]);
//    $data = json_decode(file_get_contents(asset('scrape-data/fastenal/step_2_products.json')));
//    $data2 = json_decode(file_get_contents(asset('scrape-data/tifco/step_2_products.json')));
//    dd($data2->products[0]);
//    foreach ($data->products as $product) {
//        dispatch(new UpdateFastenalSkus($product));
//    }
//    foreach ($data2->products as $product) {
//        dispatch(new UpdateTifcoSkus($product));
//    }
////    dump($data);
//    dd('enqueued!');

//    dump($data->products[0]);
//    dd($data2->products[0]);
//    foreach ($data->products as $product) {
//        dispatch(new CreateFastenalProduct($product));
//    }
//
//    foreach ($data2->products as $product) {
//        dispatch(new CreateTifcoProduct($product));
//    }

//    dump($data);
    dd('enqueued!');
});


//===================== Shop Routes Below ========================//

Route::get('store', 'ProductController@shop')->name('shop');
Route::get('store-detail/{id}', 'ProductController@shopDetail')->name('shopDetail');
//Route::get('category-detail/{id}', 'ProductController@categoryDetail')->name('categoryDetail');

Route::post('/cartAdd', 'ProductController@saveCart')->name('save_cart');
Route::any('/remove-cart/{id}', 'ProductController@removeCart')->name('remove_cart');
Route::post('/updateCart', 'ProductController@updateCart')->name('update_cart');
Route::get('/cart', 'ProductController@cart')->name('cart');
Route::get('/payment', 'OrderController@payment')->name('payment');
Route::get('invoice/{id}', 'LoggedInController@invoice')->name('invoice');
Route::get('/payment', 'OrderController@payment')->name('payment');
Route::get('/checkout', 'OrderController@checkout')->name('checkout');
Route::post('/place-order', 'OrderController@placeOrder')->name('order.place');
Route::post('/new-order', 'OrderController@newOrder')->name('new.place');
Route::post('shipping', 'ProductController@shipping')->name('shipping');

///*wishlist*/
//Route::get('/wishlist', 'WishlistController@index')->name('customer.wishlist.list');
//Route::any('/wishlist/add/{id?}', 'WishlistController@addwishlist')->name('wishlist.add');
//Route::any('/wishlist/add/{id?}', 'WishlistController@addwishlist')->name('wishlist.add');
///*wishlist end*/

Route::post('/language-form', 'ProductController@language')->name('language');

//==============================================================//

Route::get('user-ip', 'HomeController@getusersysteminfo');

//===================== New Crud-Generators Routes Will Auto Display Below ========================//
route::get('status/delivered/{id}', 'admin\\productcontroller@updatestatusdelivered')->name('status.delivered');
route::get('status/cancelled/{id}', 'admin\\productcontroller@updatestatuscancelled')->name('status.cancelled');

Route::get('export-products', 'Admin\\ProductController@export')->name('export.products');

Route::resource('admin/blog', 'Admin\\BlogController');
Route::resource('admin/category', 'Admin\\CategoryController');

Route::resource('admin/banner', 'Admin\\BannerController', ['names' => 'admin.banner']);
Route::get('admin/banner/{id}/delete', ['as' => 'banner.delete', 'uses' => 'Admin\\BannerController@destroy']);
Route::resource('admin/category', 'Admin\\CategoryController');
Route::resource('admin/attributes', 'Admin\\AttributesController');
Route::resource('admin/attributes-value', 'Admin\\AttributesValueController');
Route::post('admin/get-attributes', 'Admin\\AttributesValueController@getdata')->name('get-attributes');
Route::post('admin/pro-img-id-delet', 'Admin\\AttributesValueController@img_delete')->name('pro-img-id-delet');
Route::post('admin/delete-product-variant', 'Admin\\AttributesValueController@deleteProVariant')->name('delete.product.variant');
Route::resource('admin/testimonial', 'Admin\\TestimonialController');
Route::resource('admin/page', 'Admin\\PageController');
Route::resource('about/about', 'Admin, User\\AboutController');
Route::resource('news/news', 'Admin\\NewsController');

Route::resource('traning-videos', 'TraningVideosController');
Route::resource('upcomingclasses', 'UpcomingclassesController');
Route::resource('instagram/instagram', 'Admin\InstagramController');
Route::resource('subcategory/subcategory', 'Admin\SubcategoryController');
Route::resource('childsubcategory/childsubcategory', 'Admin\ChildsubcategoryController');
Route::resource('childsubcategory/childsubcategory', 'Admin\ChildsubcategoryController');
Route::resource('childsubcategory/childsubcategory', 'Admin\ChildsubcategoryController');

Route::resource('admin/history', 'Admin\HistoryController');
Route::resource('admin/recycling', 'Admin\RecyclingController');
Route::resource('admin/job', 'Admin\JobController');
Route::resource('admin/job-application', 'Admin\JobApplicationController');

Route::resource('admin/bikecheck', 'Admin\BikecheckController');

Route::resource('admin/us-member', 'Admin\UsMemberController');
Route::resource('admin/global-member', 'Admin\GlobalMemberController');
Route::resource('admin/race-team-member', 'Admin\RaceTeamMemberController');
Route::resource('admin/distributor', 'Admin\DistributorController');
Route::resource('admin/how-to', 'Admin\HowToController');

Route::resource('admin/faq', 'Admin\FaqController');

Route::resource('admin/news', 'Admin\NewsController');

Route::resource('admin/book', 'Admin\BookController');
Route::resource('admin/article', 'Admin\ArticleController');
Route::resource('admin/video', 'Admin\VideoController');
Route::resource('admin/review', 'Admin\ReviewController');