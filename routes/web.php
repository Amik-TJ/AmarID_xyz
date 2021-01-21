<?php

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
// Landing Page
Route::get('/', '\App\Http\Controllers\WelcomeController@index');
Route::get('/career', '\App\Http\Controllers\Landing_Page\CareerController@index')->name('career');
Route::get('/about_us', '\App\Http\Controllers\Landing_Page\AboutUsController@index')->name('about_us');
Route::get('/privacy_policy', '\App\Http\Controllers\Landing_Page\PrivacyPolicyController@index')->name('privacy_policy');
Route::get('/contact_us', '\App\Http\Controllers\Landing_Page\ContactUsController@index')->name('contact_us');
Route::get('/read_blogs', '\App\Http\Controllers\Landing_Page\ReadBlogsController@index')->name('read_blogs');
Route::Get('/read_full_web_blog', '\App\Http\Controllers\Landing_Page\ReadBlogsController@no_blog_id')->name('no_blog_id');
Route::Post('/read_full_web_blog', '\App\Http\Controllers\Landing_Page\ReadBlogsController@read_full_web_blog')->name('read_full_web_blog');








Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/search', '\App\Http\Controllers\SearchController@search');
Route::get('/search/{search}', '\App\Http\Controllers\SearchController@search_icon')->name('search');
Route::post('/create_business_card', '\App\Http\Controllers\CreateController@create_business_card');
Route::post('/generate_qr_code', '\App\Http\Controllers\QrCodeGeneratorController@index');


// Admin Panel
Route::get('/admin_dash_board', '\App\Http\Controllers\AdminDashBoardController@index')->name('admin_dash_board')->middleware('admin_print_delivery');
Route::get('/revenue_forecast', '\App\Http\Controllers\RevenueForecastController@index')->name('revenue_forecast')->middleware('admin');
Route::get('/all_order', '\App\Http\Controllers\AllOrderController@index')->middleware('admin');
Route::get('/placed_order', '\App\Http\Controllers\PlacedOrderController@index')->middleware('admin');
Route::post('/cancel_order', '\App\Http\Controllers\CancelOrderController@cancel_order')->middleware('admin'); // Cancel Order more than two days
Route::post('/cancel_all_order', '\App\Http\Controllers\CancelOrderController@cancel_all_order')->middleware('admin'); // Cancel All Orders
Route::get('/verify_orders', '\App\Http\Controllers\VerifyOrderController@index')->middleware('admin');
Route::post('/price_verify', '\App\Http\Controllers\VerifyOrderController@price_verify')->middleware('admin'); // Verify Button in On verification Page
Route::get('/on_print', '\App\Http\Controllers\OnPrintController@index')->name('on_print')->middleware(['admin_print']);



// Admin Push User Registration
Route::get('/admin_user_registration', '\App\Http\Controllers\AdminPanelUserRegisterController@index')->middleware('admin'); // Registration Form
Route::post('/push_user_registration', '\App\Http\Controllers\AdminPanelUserRegisterController@register_user')->middleware('admin'); // Registration Form Submit
Route::get('/view_unverified_user', '\App\Http\Controllers\AdminPanelUserRegisterController@view_unverified_user')->middleware('admin'); // View Unverified User
Route::post('/verify_user_registration', '\App\Http\Controllers\AdminPanelUserRegisterController@verify_user_registration')->middleware('admin'); // Verify User Button



Route::get('/assign_print_vendor', '\App\Http\Controllers\AssignPrintVendorController@index')->name('assign_print_vendor')->middleware(['admin']);
Route::post('/select_print_vendor', '\App\Http\Controllers\AssignPrintVendorController@select_print_vendor')->name('select_print_vendor')->middleware(['admin']);


Route::post('/print_change_status', '\App\Http\Controllers\OnPrintController@print_change_status')->middleware(['admin_print']); // Mark as Processed Button


Route::get('/assign_delivery_vendor', '\App\Http\Controllers\AssignDeliveryVendorController@index')->middleware(['admin']); // Assign Vendor
Route::post('/select_delivery_vendor', '\App\Http\Controllers\AssignDeliveryVendorController@select_delivery_vendor')->middleware(['admin']); // Select Vendor


Route::get('/shipped_order', '\App\Http\Controllers\ShippedOrderController@index')->middleware(['admin_print_delivery']);
Route::post('/mark_as_shipped', '\App\Http\Controllers\ShippedOrderController@mark_as_shipped')->middleware(['admin_delivery']); // Mark as Shipped Button
Route::get('/delivered_order', '\App\Http\Controllers\DeliveredOrder@index')->middleware('admin_delivery');
Route::get('/cancelled_order', '\App\Http\Controllers\CancelledOrder@index')->middleware('admin');



// Print Vendor
Route::get('/print_vendor_all_order', '\App\Http\Controllers\PrintVendorController@index')->middleware('print_vendor');




// Delivery Vendor
Route::get('/delivery_vendor_all_order', '\App\Http\Controllers\DeliveryVendorController@index')->middleware('delivery_vendor');





//Remote Requests
Route::post('/remote_upload_design', '\App\Http\Controllers\RemoteRequestController@upload_design');
Route::post('/remote_upload_image', '\App\Http\Controllers\RemoteRequestController@upload_image');
Route::post('/remote_place_order', '\App\Http\Controllers\RemoteRequestController@place_order');
Route::get('/remote_delivery_charge', '\App\Http\Controllers\RemoteRequestController@delivery_charge');



// Packages
Route::get('/package', '\App\Http\Controllers\PackageController@index')->middleware('admin');
Route::post('/delete_package', '\App\Http\Controllers\PackageController@delete_package')->middleware('admin');
Route::post('/create_new_package', '\App\Http\Controllers\PackageController@create_package')->middleware('admin');
Route::post('/edit_package', '\App\Http\Controllers\PackageController@edit_package')->middleware('admin');

// Templates
Route::get('/template', '\App\Http\Controllers\TemplateController@index')->middleware('admin'); // Display Templates
Route::post('/create_new_template', '\App\Http\Controllers\TemplateController@create_template')->middleware('admin'); // Create Template
Route::post('/delete_template', '\App\Http\Controllers\TemplateController@delete_template')->middleware('admin'); // Delete Template


// Banner
Route::get('/banner', '\App\Http\Controllers\BannerController@index')->middleware('admin'); // Display Banner
Route::post('/create_new_banner', '\App\Http\Controllers\BannerController@create_banner')->middleware('admin'); // Create Banner
Route::post('/delete_banner', '\App\Http\Controllers\BannerController@delete_banner')->middleware('admin'); // Delete Banner


// Blog
Route::get('/blog', '\App\Http\Controllers\BlogController@index')->middleware('admin'); // Display Blog
Route::post('/create_new_blog', '\App\Http\Controllers\BlogController@create_blog')->middleware('admin'); // Create Blog
Route::post('/delete_blog', '\App\Http\Controllers\BlogController@delete_blog')->middleware('admin'); // Delete Blog
Route::post('/edit_blog', '\App\Http\Controllers\BlogController@edit_blog')->middleware('admin'); // Delete Blog



// Web App Blog
Route::get('/web_app_blog', '\App\Http\Controllers\WebAppBlogController@index')->middleware('admin'); // Display Blog
Route::post('/create_web_app_blog', '\App\Http\Controllers\WebAppBlogController@create_web_app_blog')->middleware('admin'); // Create Blog
Route::post('/delete_web_app_blog', '\App\Http\Controllers\WebAppBlogController@delete_web_app_blog')->middleware('admin'); // Delete Blog
Route::post('/edit_web_app_blog', '\App\Http\Controllers\WebAppBlogController@edit_web_app_blog')->middleware('admin'); // Delete Blog



// Account Type
Route::get('/account_type', '\App\Http\Controllers\AccountTypeController@index')->middleware('admin'); // Display Account Type
Route::post('/create_new_account_type', '\App\Http\Controllers\AccountTypeController@create_account_type')->middleware('admin'); // Create Account Type
Route::post('/delete_account_type', '\App\Http\Controllers\AccountTypeController@delete_account_type')->middleware('admin'); // Delete Account Type
Route::post('/edit_account_type', '\App\Http\Controllers\AccountTypeController@edit_account_type')->middleware('admin'); // Edit Account Type


// Field
Route::get('/field', '\App\Http\Controllers\FieldController@index')->middleware('admin'); // Display Fields
Route::post('/create_new_field', '\App\Http\Controllers\FieldController@create_field')->middleware('admin'); // Create Field
Route::post('/delete_field', '\App\Http\Controllers\FieldController@delete_field')->middleware('admin'); // Delete Field
Route::post('/edit_field', '\App\Http\Controllers\FieldController@edit_field')->middleware('admin'); // Edit Field


// Sub Field
Route::get('/sub_field', '\App\Http\Controllers\SubFieldController@index')->middleware('admin'); // Display Sub Fields
Route::post('/create_new_sub_field', '\App\Http\Controllers\SubFieldController@create_sub_field')->middleware('admin'); // Create Sub Field
Route::post('/delete_sub_field', '\App\Http\Controllers\SubFieldController@delete_sub_field')->middleware('admin'); // Delete Sub Field
Route::post('/edit_sub_field', '\App\Http\Controllers\SubFieldController@edit_sub_field')->middleware('admin'); // Edit Sub Field



// Weight
Route::get('/weight', '\App\Http\Controllers\WeightController@index')->middleware('admin'); // Display All Weights



// Feedback
Route::get('/feedback', '\App\Http\Controllers\FeedbackReportController@view_feedback')->middleware('admin'); // Display All Feedbacks
Route::get('/report', '\App\Http\Controllers\FeedbackReportController@view_report')->middleware('admin'); // Display All Reports



// FAQ
Route::get('/faq', '\App\Http\Controllers\FAQController@index')->middleware('admin'); // Display FAQ
Route::post('/create_new_faq', '\App\Http\Controllers\FAQController@create_faq')->middleware('admin'); // Create FAQ
Route::post('/delete_faq', '\App\Http\Controllers\FAQController@delete_faq')->middleware('admin'); // Delete FAQ
Route::post('/edit_faq', '\App\Http\Controllers\FAQController@edit_faq')->middleware('admin'); // Delete Blog










// User Module
Route::get('/user_dashboard','\App\Http\Controllers\User\UserDashboardController@index')->middleware('user');







// Common Routes For All user
Route::get('/show_more_notification','\App\Http\Controllers\Common_Controllers\NotificationController@index')->middleware('auth');
Route::get('/see_more_message','\App\Http\Controllers\Common_Controllers\MessageController@index')->middleware('auth');
Route::get('/see_full_conversation','\App\Http\Controllers\Common_Controllers\MessageController@show_full_conversation')->middleware('auth');
