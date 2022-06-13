<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;

/*
   |--------------------------------------------------------------------------
   | Web Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register web routes for your application. These
   | routes are loaded by the RouteServiceProvider within a group whichblzinvst_pre_assesment_save
   | contains the "web" middleware group. Now create something great!
   |business-directory-beltraide
 */


Route::get('lang/{locale}', function ($locale) {
  if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
    abort(400);
  }   
  Session()->put('locale', $locale);
  Session::get('locale');
  App::setLocale(Session::get('locale'));
  $locale = App::getLocale();
  return redirect()->back();
})->name('lang');


// Route::get('/admin', function () {  return redirect()->route('login'); })->name('/');
Route::get('logout', [App\Http\Controllers\UserController::class,'logout']);

Route::get('ajaxapproved', [App\Http\Controllers\ProductController::class,'ajaxapproved']);
Route::post('featured', [App\Http\Controllers\ProductController::class,'featured']);
//Front
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\FrontController::class, 'index'])->name('home');
Route::get('/seller_faq', [App\Http\Controllers\FrontController::class, 'faq_seller'])->name('faq_seller');
Route::get('/faq', [App\Http\Controllers\FrontController::class, 'faq'])->name('faq');

Route::get('/events-listing', [App\Http\Controllers\FrontController::class, 'events_listing'])->name('events-listing');
Route::get('/events-detail/{id}', [App\Http\Controllers\FrontController::class, 'events_detail'])->name('events-detail');
Route::get('/events-register/{id}', [App\Http\Controllers\FrontController::class, 'events_register'])->name('events-register');

Route::post('/store_event_regsitration', [App\Http\Controllers\FrontController::class, 'store_event_regsitration'])->name('store_event_regsitration');
Route::post('/store_request_assistance', [App\Http\Controllers\FrontController::class, 'store_request_assistance'])->name('store_request_assistance');

 Route::post('role', [App\Http\Controllers\RoleController::class, 'store']);
 
Route::get('/products/{id?}', [App\Http\Controllers\FrontController::class, 'products'])->name('products');
Route::post('/product-search', [App\Http\Controllers\FrontController::class, 'product_search'])->name('product-search');

Route::get('/business-directory-beltraide/{id?}', [App\Http\Controllers\FrontController::class, 'businessdirectory'])->name('business-directory-beltraide');
Route::post('/business-directory-beltraide_sear', [App\Http\Controllers\FrontController::class, 'Services_search'])->name('business-directory-beltraide-sear');
Route::post('/business-directory-beltraide_seller', [App\Http\Controllers\FrontController::class, 'Seller_search'])->name('business-directory-beltraide-seller');



Route::post('/business-directory-beltraide', [App\Http\Controllers\FrontController::class, 'Business_Search'])->name('business-directory-beltraide');
Route::get('/autocomplete_business_dir', [App\Http\Controllers\FrontController::class, 'autocomplete_business_dir'])->name('autocomplete_business_dir');
//

Route::get('/export_belize', [App\Http\Controllers\FrontController::class, 'exportbelize'])->name('export_belize');
Route::get('/request_assistance', [App\Http\Controllers\FrontController::class, 'request_assistance'])->name('request_assistance');
Route::get('/sdbc-services', [App\Http\Controllers\FrontController::class, 'sdbcservices'])->name('sdbc-services');
Route::get('/belizeinvest-services', [App\Http\Controllers\FrontController::class, 'belizeinvestservices'])->name('belizeinvest-services');
Route::get('/btec-services', [App\Http\Controllers\FrontController::class, 'btecservices'])->name('btec-services');
//
Route::get('/jobs', [App\Http\Controllers\FrontController::class, 'jobs'])->name('jobs');
Route::get('/job_detail/{id}', [App\Http\Controllers\FrontController::class, 'job_detail'])->name('job_detail');


Route::get('/seller-profile/{id}', [App\Http\Controllers\FrontController::class, 'seller_profile'])->name('seller-profile');
Route::get('/self-paced', [App\Http\Controllers\FrontController::class, 'selfpaced'])->name('self-paced');
Route::post('/self-paced', [App\Http\Controllers\FrontController::class, 'selfpacedsubmit'])->name('self-paced');


Route::get('/active-training', [App\Http\Controllers\FrontController::class, 'active-training'])->name('active-training');
Route::post('/active-training', [App\Http\Controllers\FrontController::class, 'activetrainingsubmit'])->name('active-training');

//
Route::get('/training-registration/{id}', [App\Http\Controllers\FrontController::class, 'training_registration'])->name('training-registration');
Route::post('/store_training_regsitration', [App\Http\Controllers\FrontController::class, 'store_training_regsitration'])->name('store_training_regsitration');
Route::post('/request_assistance_form', [App\Http\Controllers\FrontController::class, 'request_assistance_form'])->name('request_assistance');
//
Route::get('/selfpaced-detail/{id}', [App\Http\Controllers\FrontController::class, 'selfpaced_detail'])->name('selfpaced-detail');

Route::get('/active-training', [App\Http\Controllers\FrontController::class, 'activetraining'])->name('active-training');
Route::get('/training-detail/{id}', [App\Http\Controllers\FrontController::class, 'training_detail'])->name('training-detail');

//
Route::get('/support-services', [App\Http\Controllers\FrontController::class, 'supportservices'])->name('support-services');

Route::get('/trainning_calender', [App\Http\Controllers\FrontController::class, 'trainning_calender'])->name('trainning_calender');

Route::post('/postrequirements', [App\Http\Controllers\FrontController::class, 'storeRequirements'])->name('postrequirements');
Route::post('/requirements', [App\Http\Controllers\FrontController::class, 'postRequirements'])->name('requirements');
//
Route::get('/finance-access', [App\Http\Controllers\FrontController::class, 'finance_access'])->name('finance-access');


Route::get('/services', [App\Http\Controllers\FrontController::class, 'services'])->name('services');
Route::get('/seller-services', [App\Http\Controllers\FrontController::class, 'seller_services'])->name('seller-services');

Route::get('/product-category', [App\Http\Controllers\FrontController::class, 'product_category'])->name('product-category');

//
Route::get('/jobs_employment', [App\Http\Controllers\FrontController::class, 'jobs_employment'])->name('employment');
//
Route::get('/clear-cache', function() {
  Artisan::call('config:cache');
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('view:clear');
  Artisan::call('route:clear');
  return "Cache is cleared";
})->name('clear.cache');


Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth']], function() {
    /**
    * Verification Routes
    */
    Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/user/login')->with('succ','Congratulations ! Your Email Verified, Thanks.');
        
    })->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard')->middleware(["verified"]);
Route::get("/all-payment-list",[App\Http\Controllers\BlzInvstTrainingController::class, 'All_payment_list']);
Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');

Route::get('/user/login', function () {
  $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
    return view('login',compact('user_session'));
})->name('user-login');


Route::get('/user/signup', function () {
  $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
    return view('signup',compact('user_session'));
})->name('signup');
 
Route::get('/contact', function () {
  $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
    return view('contact',compact('user_session'));
})->name('contact');


Route::post('/contactus', [App\Http\Controllers\FrontController::class, 'contactus']); 

//
Route::get('/user/forgot_password', function () {
  $Session_id = Session::get('member_id');
        $user_session =  User::where('id', $Session_id)->get();
    return view('forgot_password',compact('user_session'));
})->name('forgot_password');



Route::get('/admin', function () {  
    return view("auth.login");
    });
Route::group(['middleware' => 'auth'], function () {
  Route::group(['middleware' => "web"], function () {
  Route::view('index', 'admin.back.dashboard.index')->name('index');  

Route::get('sdbc_self_paced', [App\Http\Controllers\BlzInvstTrainingController::class, 'create']); 
Route::get('btec_self_paced', [App\Http\Controllers\BlzInvstTrainingController::class, 'create']); 
Route::get('expblz_training', [App\Http\Controllers\ExportBlzTrainingController::class, 'index']); 




  //Route::get('dashboard',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard') ; 

   // route for Business Resource Guide //

Route::get('business_resources', [App\Http\Controllers\BusinessRcsController::class, 'index']); 
Route::get('business_resources/create', [App\Http\Controllers\BusinessRcsController::class, 'create']); 
Route::post('business_resources', [App\Http\Controllers\BusinessRcsController::class, 'store']); 
Route::get('business_resources/{id}', [App\Http\Controllers\BusinessRcsController::class, 'edit']);
Route::post('business_resources/{id}', [App\Http\Controllers\BusinessRcsController::class, 'update']); 
Route::get('business_resources/delete/{id}', [App\Http\Controllers\BusinessRcsController::class, 'delete']); 



  // route for roles
  Route::get('role', [App\Http\Controllers\RoleController::class, 'index']);     
  Route::get('role/create', [App\Http\Controllers\RoleController::class, 'create']);
  Route::post('role', [App\Http\Controllers\RoleController::class, 'store']);
  Route::get('role/{id}', [App\Http\Controllers\RoleController::class, 'edit']);
  Route::put('role/{id}', [App\Http\Controllers\RoleController::class, 'update']);
  
  Route::get('module/{id}', [App\Http\Controllers\RoleController::class, 'moduleEdit']);
  Route::put('module/{id}', [App\Http\Controllers\RoleController::class, 'moduleUpdate']);
  
  // route for users
 // Route::get('users/buyer', [App\Http\Controllers\UserController::class, 'buyers']);
  Route::get('users', [App\Http\Controllers\UserController::class, 'index']); 
 // Route::get('users/{type}', [App\Http\Controllers\UserController::class, 'index']);     
  Route::get('users/create', [App\Http\Controllers\UserController::class, 'create']);  
  Route::post('users', [App\Http\Controllers\UserController::class, 'store']);  
  Route::get('users/{id}', [App\Http\Controllers\UserController::class, 'edit']);  
  Route::put('users/{id}', [App\Http\Controllers\UserController::class, 'update']);  

  
   // route for Investor
  Route::get('users/investor', [App\Http\Controllers\UserController::class, 'investor']);
  Route::get('users/{type}/{id}', [App\Http\Controllers\UserController::class, 'edit']);  
  Route::put('users/{id}', [App\Http\Controllers\UserController::class, 'update']);  


  // route for customer
  Route::get('customer', [App\Http\Controllers\CustomerController::class, 'index']);     
  Route::get('customer/create', [App\Http\Controllers\CustomerController::class, 'create']);  
  Route::post('customer', [App\Http\Controllers\CustomerController::class, 'store']);  
  Route::get('customer/{id}', [App\Http\Controllers\CustomerController::class, 'edit']);  
  Route::put('customer/{id}', [App\Http\Controllers\CustomerController::class, 'update']);  
  Route::get('customerDetail/{id}', [App\Http\Controllers\CustomerController::class, 'view']);  

  
  // route for Brand
  Route::get('brand', [App\Http\Controllers\BrandController::class, 'index']);     
  Route::get('brand/create', [App\Http\Controllers\BrandController::class, 'create']);  
  Route::post('brand', [App\Http\Controllers\BrandController::class, 'store']);  
  Route::get('brand/{id}', [App\Http\Controllers\BrandController::class, 'edit']);  
  Route::put('brand/{id}', [App\Http\Controllers\BrandController::class, 'update']);  
  
  // route for Product
  Route::get('product', [App\Http\Controllers\ProductController::class, 'pending']);    
  Route::get('product/approved', [App\Http\Controllers\ProductController::class, 'approved']); 
  Route::get('product/disapproved', [App\Http\Controllers\ProductController::class, 'disapproved']);
  Route::get('product/pending', [App\Http\Controllers\ProductController::class, 'pending']);
  Route::get('product/create', [App\Http\Controllers\ProductController::class, 'create']);  
  Route::post('product', [App\Http\Controllers\ProductController::class, 'store']);  
  Route::get('product/{id}', [App\Http\Controllers\ProductController::class, 'edit']);  
  Route::put('products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
  Route::get('productDetail/{id}', [App\Http\Controllers\ProductController::class, 'view']);
  Route::get('productgallery/{id}', [App\Http\Controllers\ProductController::class, 'productgallery']);
  Route::get('/productapprove/{id}', [App\Http\Controllers\ProductController::class, 'productapprove']);
  Route::get('/productdisapprove/{id}', [App\Http\Controllers\ProductController::class, 'productdisapprove']);
  Route::post('uploadProductImage/{id}', [App\Http\Controllers\ProductController::class, 'uploadProductImage']);
  Route::post('uploadProduct', [App\Http\Controllers\ProductController::class, 'uploadProduct']);
  Route::post('getSubcategory', [App\Http\Controllers\ProductController::class, 'getSubcategory']);
  
  
  
    // route for Product Services  Category//
  Route::get('service_category', [App\Http\Controllers\ServiceCategoryController::class, 'index']);     
  Route::get('service_category/create', [App\Http\Controllers\ServiceCategoryController::class, 'create']);  
  Route::post('service_category', [App\Http\Controllers\ServiceCategoryController::class, 'store']);  
  Route::get('service_category/{id}', [App\Http\Controllers\ServiceCategoryController::class, 'edit']);  
  Route::put('service_category/{id}', [App\Http\Controllers\ServiceCategoryController::class, 'update']);
  Route::get('service_category/{id}', [App\Http\Controllers\ServiceCategoryController::class, 'view']);
 
  // Product Services  Category End //
  
  
   // route for Product Services //
  Route::get('product_services', [App\Http\Controllers\SdbcProductServiceController::class, 'index']);     
  Route::get('product_services/create', [App\Http\Controllers\SdbcProductServiceController::class, 'create']);  
  Route::post('product_services', [App\Http\Controllers\SdbcProductServiceController::class, 'store']);  
  Route::get('product_services/{id}', [App\Http\Controllers\SdbcProductServiceController::class, 'edit']);  
  Route::put('product/{id}', [App\Http\Controllers\SdbcProductServiceController::class, 'update']);
  Route::get('product_services/{id}', [App\Http\Controllers\SdbcProductServiceController::class, 'view']);
 
  // route for Product Services End //
  
  // route for Combo
  Route::get('combo', [App\Http\Controllers\ComboController::class, 'index']);     
  Route::get('combo/create', [App\Http\Controllers\ComboController::class, 'create']);  
  Route::post('combo', [App\Http\Controllers\ComboController::class, 'store']);  
  Route::get('combo/{id}', [App\Http\Controllers\ComboController::class, 'edit']);  
  Route::put('combo/{id}', [App\Http\Controllers\ComboController::class, 'update']); 
  Route::post('getProduct', [App\Http\Controllers\ComboController::class, 'getProduct']); 
  
  // route for variation product
  
  Route::get('variation-product', [App\Http\Controllers\VariationProductController::class, 'index']);     
  Route::get('variation-product/create', [App\Http\Controllers\VariationProductController::class, 'create']);  
  Route::post('variation-product', [App\Http\Controllers\VariationProductController::class, 'store']);  
  Route::get('variation-product/{id}', [App\Http\Controllers\VariationProductController::class, 'edit']);  
  Route::put('variation-product/{id}', [App\Http\Controllers\VariationProductController::class, 'update']); 

  // route for banner
  Route::get('banner', [App\Http\Controllers\BannerController::class, 'index']);     
  Route::get('banner/create', [App\Http\Controllers\BannerController::class, 'create']);  
  Route::post('banner', [App\Http\Controllers\BannerController::class, 'store']);  
  Route::get('banner/{id}', [App\Http\Controllers\BannerController::class, 'edit']);  
  Route::put('banner/{id}', [App\Http\Controllers\BannerController::class, 'update']);
  
  // route for profile
  Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index']);     
  Route::put('profile/{id}', [App\Http\Controllers\ProfileController::class, 'update']);
  
   // route for Trainning Stream
  Route::get('trainning_stream', [App\Http\Controllers\TrainningStreamController::class, 'index']);     
  Route::get('trainning_stream/create', [App\Http\Controllers\TrainningStreamController::class, 'create']);  
  Route::post('trainning_stream', [App\Http\Controllers\TrainningStreamController::class, 'store']);  
  Route::get('trainning_stream/{id}', [App\Http\Controllers\TrainningStreamController::class, 'edit']);  
  Route::put('trainning_stream/{id}', [App\Http\Controllers\TrainningStreamController::class, 'update']);
  Route::get('trainning_stream/delete/{id}', [App\Http\Controllers\TrainningStreamController::class, 'delete']);
  // route for Trainning Stream
  
    // route for Trainning Stream
  Route::get('trainning_course', [App\Http\Controllers\TrainningCourseController::class, 'index']);     
  Route::get('trainning_course/create', [App\Http\Controllers\TrainningCourseController::class, 'create']);  
  Route::post('trainning_course', [App\Http\Controllers\TrainningCourseController::class, 'store']);  
  Route::get('trainning_course/{id}', [App\Http\Controllers\TrainningCourseController::class, 'edit']);  
  Route::put('trainning_course/{id}', [App\Http\Controllers\TrainningCourseController::class, 'update']);
  Route::get('trainning_course/delete/{id}', [App\Http\Controllers\TrainningCourseController::class, 'delete']);
  Route::post('get_trainning_course', [App\Http\Controllers\TrainningCourseController::class, 'getData']);  
  // route for Trainning Stream
  
  
  // Route::resource('coupon', [CouponController::class]);
  
  Route::resource('coupon', App\Http\Controllers\CouponController::class);
});
});
Route::middleware(['module'])->group(function () {
	
// route for Training  //// Route::resource('training', [TrainingController::class]);
Route::get('blzinvst_training', [App\Http\Controllers\BlzInvstTrainingController::class, 'index']); 
Route::get('blzinvst_training/create', [App\Http\Controllers\BlzInvstTrainingController::class, 'create']);
Route::post('blzinvst_training', [App\Http\Controllers\BlzInvstTrainingController::class, 'store']); 
Route::get('blzinvst_training/{id}', [App\Http\Controllers\BlzInvstTrainingController::class, 'edit']);
Route::post('blzinvst_training/{id}', [App\Http\Controllers\BlzInvstTrainingController::class, 'update']); 
Route::get('blzinvst_training/delete/{id}', [App\Http\Controllers\BlzInvstTrainingController::class, 'delete']);
Route::get('blzinvst_training/Get_Category/{id}', [App\Http\Controllers\BlzInvstTrainingController::class, 'Get_Category']); 


// route for Trainees  //// 
Route::get('blzinvst_trainee', [App\Http\Controllers\BlzInvstTraineeController::class, 'index']); 
Route::get('blzinvst_trainee/create', [App\Http\Controllers\BlzInvstTraineeController::class, 'create']);
Route::post('blzinvst_trainee', [App\Http\Controllers\BlzInvstTraineeController::class, 'store']); 
Route::get('blzinvst_trainee/{id}', [App\Http\Controllers\BlzInvstTraineeController::class, 'edit']);
Route::post('blzinvst_trainee/{id}', [App\Http\Controllers\BlzInvstTraineeController::class, 'update']); 
Route::get('blzinvst_trainee/delete/{id}', [App\Http\Controllers\BlzInvstTraineeController::class, 'delete']); 

// route for Trainning Calender  //// 
Route::get('blzinvst_trainning_calender', [App\Http\Controllers\BlzInvstTrainningCalenderController::class, 'index']); 
Route::get('blzinvst_trainning_calender/create', [App\Http\Controllers\BlzInvstTrainningCalenderController::class, 'create']);
Route::post('blzinvst_trainning_calender', [App\Http\Controllers\BlzInvstTrainningCalenderController::class, 'store']); 
Route::get('blzinvst_trainning_calender/{id}', [App\Http\Controllers\BlzInvstTrainningCalenderController::class, 'edit']);
Route::post('blzinvst_trainning_calender/{id}', [App\Http\Controllers\BlzInvstTrainningCalenderController::class, 'update']); 
Route::get('blzinvst_trainning_calender/delete/{id}', [App\Http\Controllers\BlzInvstTrainningCalenderController::class, 'delete']); 

// route for Self-paced learning  //// 
Route::get('blzinvst_self_paced', [App\Http\Controllers\SelfPacedController::class, 'index']); 
Route::get('blzinvst_self_paced/create', [App\Http\Controllers\SelfPacedController::class, 'create']);
Route::post('blzinvst_self_paced', [App\Http\Controllers\SelfPacedController::class, 'store']); 
Route::get('blzinvst_self_paced/{id}', [App\Http\Controllers\SelfPacedController::class, 'edit']);
Route::post('blzinvst_self_paced/{id}', [App\Http\Controllers\SelfPacedController::class, 'update']); 
Route::get('blzinvst_self_paced/delete/{id}', [App\Http\Controllers\SelfPacedController::class, 'delete']); 

// route for Online Quiz   //// 
Route::get('blzinvst_online_quiz', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'index']); 
Route::get('blzinvst_online_quiz/create', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'create']);
Route::post('blzinvst_online_quiz', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'store']); 
Route::get('blzinvst_online_quiz/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'edit']);
Route::post('blzinvst_online_quiz/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'update']); 
Route::get('blzinvst_online_quiz/delete/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'delete']); 


Route::post('blzinvst_add_topic/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_topic']);

Route::get('blzinvst_subtopic/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_subtopic']); 
Route::get('blzinvst_subtopic_edit/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_subtopic_edit']); 
Route::post('blzinvst_update_subtopic/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_update_subtopic']); 
Route::get('blzinvst_subtopic_delete/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_subtopic_delete']);  
Route::post('blzinvst_add_subtopic', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_subtopic']); 


Route::get('blzinvst_quiz_list', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_quiz_list']);
Route::get('blzinvst_fetch_data_quiz', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_fetch_data_quiz']);
Route::post('/blzinvst_quiz_delete/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_quiz_delete']);


Route::get('/blzinvst_add_quiz_form/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_quiz_form']);
Route::get('blzinvst_add_quiz/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_quiz']);

Route::get('blzinvst_add_content_form/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_content_form']);
Route::get('blzinvst_add_content/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_content']);
Route::post('blzinvst_add_content_do/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_add_content_do']);
Route::post('/blzinvst_add_quiz_do/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'Blzinvst_add_quiz_Do']);

Route::get('blzinvst_content_list', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_content_list']);
Route::get('blzinvst_content_list_fetch', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_content_list_fetch']);
Route::post('blzinvst_content_delete/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_Delete_Audio']);
//
Route::get('blzinvst_pre_assesment/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_pre_assesment']);
Route::post('/blzinvst_pre_assesment/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_pre_assesment_save']);
Route::get('/blzinvst_assesment_list', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_fetch_pre_ass_list']);
Route::get('/blzinvst_assesment_data', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_fetch_pre_ass_list_date']);
Route::post('/blzinvst_pre_delete/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_pre_delete']);

Route::get('blzinvst_final_assesment/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_final_assesment']);
Route::post('/blzinvst_final_assesment_sve/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_final_assesment_save']);
Route::get('/blzinvst_final_assesment_list', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_final_assesment_list']);
Route::get('/blzinvst_final_assesment_data', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_final_assesment_data']);
Route::post('/blzinvst_final_delete/{id}', [App\Http\Controllers\BlzInvstOnlineQuizController::class, 'blzinvst_final_delete']);

// route for EventListing //
Route::get('blzinvst_events', [App\Http\Controllers\BlzInvstEventListingController::class, 'index']); 
Route::get('blzinvst_events/create', [App\Http\Controllers\BlzInvstEventListingController::class, 'create']);  
Route::post('blzinvst_events', [App\Http\Controllers\BlzInvstEventListingController::class, 'store']); 
Route::get('blzinvst_events/{id}', [App\Http\Controllers\BlzInvstEventListingController::class, 'edit']);
Route::post('blzinvst_events/{id}', [App\Http\Controllers\BlzInvstEventListingController::class, 'update']); 
Route::get('blzinvst_events/delete/{id}', [App\Http\Controllers\BlzInvstEventListingController::class, 'delete']); 

// route for Event Calender //
Route::get('blzinvst_event_calender', [App\Http\Controllers\BlzInvstEventListingController::class, 'calenderlist']); 


// route for VideoUpload //
Route::get('blzinvst_videoupload', [App\Http\Controllers\BlzInvstVideoUploadController::class, 'index']); 
Route::get('blzinvst_videoupload/create', [App\Http\Controllers\BlzInvstVideoUploadController::class, 'create']);  
Route::post('blzinvst_videoupload', [App\Http\Controllers\BlzInvstVideoUploadController::class, 'store']); 
Route::get('blzinvst_videoupload/{id}', [App\Http\Controllers\BlzInvstVideoUploadController::class, 'edit']);
Route::post('blzinvst_videoupload/{id}', [App\Http\Controllers\BlzInvstVideoUploadController::class, 'update']); 
Route::get('blzinvst_videoupload/delete/{id}', [App\Http\Controllers\BlzInvstVideoUploadController::class, 'delete']); 

// route for Jobs //

Route::get('blzinvst_jobs', [App\Http\Controllers\BlzInvstJobsController::class, 'index']); 
Route::get('blzinvst_jobs/create', [App\Http\Controllers\BlzInvstJobsController::class, 'create']); 
Route::post('blzinvst_jobs', [App\Http\Controllers\BlzInvstJobsController::class, 'store']);
Route::get('blzinvst_jobs/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'edit']);
Route::post('blzinvst_jobs/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'update']); 
Route::get('blzinvst_jobs/delete/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'delete']);  

// route for Jobs Preparedness //

Route::get('blzinvst_JobsPreparedness', [App\Http\Controllers\BlzInvstJobsController::class, 'JobsPreparednessList']);
Route::get('blzinvst_JobsPreparedness/Add_JobPreparedness', [App\Http\Controllers\BlzInvstJobsController::class, 'Add_JobPreparedness']);
Route::post('blzinvst_JobsPreparedness', [App\Http\Controllers\BlzInvstJobsController::class, 'store_jobpreparedness']);
Route::get('blzinvst_JobsPreparedness/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'edit_jobpreparedness']);
Route::post('blzinvst_JobsPreparedness/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'update_jobpreparedness']);
Route::get('blzinvst_JobsPreparedness/delete/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'JobsPreparednessdelete']); 



// route for External Jobs //

Route::get('blzinvst_ExternalJobs', [App\Http\Controllers\BlzInvstJobsController::class, 'ExternalJobsList']);
Route::get('blzinvst_ExternalJobs/Add_ExternalJobs', [App\Http\Controllers\BlzInvstJobsController::class, 'Add_ExternalJobs']);
Route::post('blzinvst_ExternalJobs', [App\Http\Controllers\BlzInvstJobsController::class, 'store_externaljobs']);
Route::get('blzinvst_ExternalJobs/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'edit_externaljobs']);
Route::post('blzinvst_ExternalJobs/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'update_externaljobs']);
Route::get('blzinvst_ExternalJobs/delete/{id}', [App\Http\Controllers\BlzInvstJobsController::class, 'ExternalJobsdelete']); 

// route for Advisory Request //

Route::get('blzinvst_advisory', [App\Http\Controllers\BlzInvstAdvRqstController::class, 'index']); 
Route::get('blzinvst_advisory/create', [App\Http\Controllers\BlzInvstAdvRqstController::class, 'create']); 
Route::post('blzinvst_advisory', [App\Http\Controllers\BlzInvstAdvRqstController::class, 'store']);
Route::get('blzinvst_advisory/{id}', [App\Http\Controllers\BlzInvstAdvRqstController::class, 'edit']);
Route::post('blzinvst_advisory/{id}', [App\Http\Controllers\BlzInvstAdvRqstController::class, 'update']); 
Route::get('blzinvst_advisory/delete/{id}', [App\Http\Controllers\BlzInvstAdvRqstController::class, 'delete']); 


// route for Business Template //

Route::get('blzinvst_businesstmpl', [App\Http\Controllers\BlzInvstBusinessTmplController::class, 'index']); 
Route::get('blzinvst_businesstmpl/create', [App\Http\Controllers\BlzInvstBusinessTmplController::class, 'create']); 
Route::post('blzinvst_businesstmpl', [App\Http\Controllers\BlzInvstBusinessTmplController::class, 'store']); 
Route::get('blzinvst_businesstmpl/{id}', [App\Http\Controllers\BlzInvstBusinessTmplController::class, 'edit']);
Route::post('blzinvst_businesstmpl/{id}', [App\Http\Controllers\BlzInvstBusinessTmplController::class, 'update']); 
Route::get('blzinvst_businesstmpl/delete/{id}', [App\Http\Controllers\BlzInvstBusinessTmplController::class, 'delete']); 



// route for Online Application //

Route::get('blzinvst_online_application', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'index']); 
Route::get('view_details/{id}', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'view_detail']); 
Route::get('blzinvst_online_application/create', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'create']); 

Route::post('blzinvst_online_application', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'store']); 
Route::get('blzinvst_online_application/delete/{id}', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'delete']);
Route::get('blzinvst_online_application/{id}', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'edit']);
Route::post('onlineformupdate/{id}', [App\Http\Controllers\BlzInvstOnlineAppController::class, 'update']);

// Route for FAQ //

Route::get('blzinvst_faq', [App\Http\Controllers\BlzInvstFaqController::class, 'index']); 
Route::get('blzinvst_faq/create', [App\Http\Controllers\BlzInvstFaqController::class, 'create']); 
Route::post('blzinvst_faq', [App\Http\Controllers\BlzInvstFaqController::class, 'store']); 
Route::get('blzinvst_faq/{id}', [App\Http\Controllers\BlzInvstFaqController::class, 'edit']);
Route::post('blzinvst_faq/{id}', [App\Http\Controllers\BlzInvstFaqController::class, 'update']); 
Route::get('blzinvst_faq/delete/{id}', [App\Http\Controllers\BlzInvstFaqController::class, 'delete']); 

// Route for QueryLists //

Route::get('blzinvst_QueryList', [App\Http\Controllers\BlzInvstQueryListsController::class, 'index']); 
Route::get('blzinvst_QueryList/create', [App\Http\Controllers\BlzInvstQueryListsController::class, 'create']); 
Route::post('blzinvst_QueryList', [App\Http\Controllers\BlzInvstQueryListsController::class, 'store']); 
Route::get('blzinvst_QueryList/{id}', [App\Http\Controllers\BlzInvstQueryListsController::class, 'edit']);
Route::post('blzinvst_QueryList/{id}', [App\Http\Controllers\BlzInvstQueryListsController::class, 'update']); 
Route::get('blzinvst_QueryList/delete/{id}', [App\Http\Controllers\BlzInvstQueryListsController::class, 'delete']); 

Route::get('blzinvst_add_module/{id}', [App\Http\Controllers\BlzInvstQueryListsController::class, 'blzinvst_add_module']);
Route::post('blzinvst_add_training_module', [App\Http\Controllers\BlzInvstQueryListsController::class, 'Add_Training_Model']);
Route::post('blzinvst_delete/{id}', [App\Http\Controllers\BlzInvstQueryListsController::class, 'blzinvst_delete']);
Route::get('blzinvst_edit/{id}', [App\Http\Controllers\BlzInvstQueryListsController::class, 'blzinvst_edit']);
Route::get('blzinvst_fetch_data', [App\Http\Controllers\BlzInvstQueryListsController::class, 'Blzinvst_fetch_data']); 

// Route for Investment Generation Promotion //

Route::get('blzinvst_what_we_do', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'index']); 
Route::get('blzinvst_what_we_do/create', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'create']); 
Route::post('blzinvst_what_we_do', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'store']); 
Route::get('blzinvst_what_we_do/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'edit']);
Route::post('blzinvst_what_we_do/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'update']); 
Route::get('blzinvst_what_we_do/delete/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'delete']); 


// Route for Investment Generation Promotion //

Route::get('blzinvst_team_members', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'team_lists']); 
Route::get('blzinvst_team_members/create', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'team_create']); 
Route::post('blzinvst_team_members', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'team_store']); 
Route::get('blzinvst_team_members/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'team_edit']);
Route::post('blzinvst_team_members/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'team_update']); 
Route::get('blzinvst_team_members/delete/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'team_delete']); 

// Route for Investment Generation Other Resources //

Route::get('blzinvst_resources', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'resource_lists']); 
Route::get('blzinvst_resources/create', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'resource_create']); 
Route::post('blzinvst_resources', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'resource_store']); 
Route::get('blzinvst_resources/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'resource_edit']);
Route::post('blzinvst_resources/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'resource_update']); 
Route::get('blzinvst_resources/delete/{id}', [App\Http\Controllers\BlzInvstInvstgenpromotionController::class, 'resource_delete']); 


// Route for Finance  Access  //

Route::get('blzinvst_grant_section', [App\Http\Controllers\BlzInvstGrantSectionController::class, 'index']); 
Route::get('blzinvst_grant_section/create', [App\Http\Controllers\BlzInvstGrantSectionController::class, 'create']); 
Route::post('blzinvst_grant_section', [App\Http\Controllers\BlzInvstGrantSectionController::class, 'store']); 
Route::get('blzinvst_grant_section/{id}', [App\Http\Controllers\BlzInvstGrantSectionController::class, 'edit']);
Route::post('blzinvst_grant_section/{id}', [App\Http\Controllers\BlzInvstGrantSectionController::class, 'update']); 
Route::get('blzinvst_grant_section/delete/{id}', [App\Http\Controllers\BlzInvstGrantSectionController::class, 'delete']); 


// Route for Finance  Access  //

Route::get('blzinvst_loan_section', [App\Http\Controllers\BlzInvstLoanSectionController::class, 'index']); 
Route::get('blzinvst_loan_section/create', [App\Http\Controllers\BlzInvstLoanSectionController::class, 'create']); 
Route::post('blzinvst_loan_section', [App\Http\Controllers\BlzInvstLoanSectionController::class, 'store']); 
Route::get('blzinvst_loan_section/{id}', [App\Http\Controllers\BlzInvstLoanSectionController::class, 'edit']);
Route::post('blzinvst_loan_section/{id}', [App\Http\Controllers\BlzInvstLoanSectionController::class, 'update']); 
Route::get('blzinvst_loan_section/delete/{id}', [App\Http\Controllers\BlzInvstLoanSectionController::class, 'delete']); 

// Route for Finance  Access  // blzinvst_loan_section
});

//Route::post('jobs', [App\Http\Controllers\BlzInvstJobsController::class, 'store']);
// route for Admin B2b Seller  Account Creation List //

Route::get('seller_account', [App\Http\Controllers\SellerAccountController::class, 'index']); 
Route::get('seller_account/create', [App\Http\Controllers\SellerAccountController::class, 'create']); 
Route::post('seller_account', [App\Http\Controllers\SellerAccountController::class, 'store']); 
Route::get('seller_view/{id}', [App\Http\Controllers\SellerAccountController::class, 'view']); 
Route::get('seller_account/{id}', [App\Http\Controllers\SellerAccountController::class, 'edit']);  
Route::put('seller_account/{id}', [App\Http\Controllers\SellerAccountController::class, 'update']);  
Route::get('seller_account/acivate_account/{id}', [App\Http\Controllers\SellerAccountController::class, 'acivate_account']); 
Route::get('seller_account/deacivate_account/{id}', [App\Http\Controllers\SellerAccountController::class, 'deacivate_account']);  
// route for Admin B2b Buyer  Account Creation List //

Route::get('buyer_account', [App\Http\Controllers\BuyerAccountController::class, 'index']); 
Route::get('buyer_account/create', [App\Http\Controllers\BuyerAccountController::class, 'create']); 
Route::post('buyer_account', [App\Http\Controllers\BuyerAccountController::class, 'store']);  
Route::get('buyer_view/{id}', [App\Http\Controllers\BuyerAccountController::class, 'view']); 
Route::get('buyer_account/acivate_account/{id}', [App\Http\Controllers\BuyerAccountController::class, 'acivate_account']); 
Route::get('buyer_account/deacivate_account/{id}', [App\Http\Controllers\BuyerAccountController::class, 'deacivate_account']);  
Route::get('buyer_account/{id}', [App\Http\Controllers\BuyerAccountController::class, 'edit']);  
Route::put('buyer_account/{id}', [App\Http\Controllers\BuyerAccountController::class, 'update']); 

// route for Admin B2b Investor  Account Creation List //

Route::get('investor_account', [App\Http\Controllers\InvestorAccountController::class, 'index']); 
Route::get('investor_account/create', [App\Http\Controllers\InvestorAccountController::class, 'create']);
Route::post('/investor/create-concept', [App\Http\Controllers\InvestorPanelController::class, 'investment_concept_add']);
Route::post('/investor/delete/{id}', [App\Http\Controllers\InvestorPanelController::class, 'investment_delete']);
Route::get('/investor/edit/{id}', [App\Http\Controllers\InvestorPanelController::class, 'investment_edit']);
Route::post('/investor/update/{id}', [App\Http\Controllers\InvestorPanelController::class, 'investment_update']);
//Route::get('/investor/settings', [App\Http\Controllers\InvestorPanelController::class, 'investment_profile']);

Route::get('/investor/investor_concept_detail', [App\Http\Controllers\InvestorPanelController::class, 'investor_Concept_Profile']);
Route::post('investor_account', [App\Http\Controllers\InvestorAccountController::class, 'store']);  
Route::get('investor_view/{id}', [App\Http\Controllers\InvestorAccountController::class, 'view']); 
Route::get('investor_account/acivate_account/{id}', [App\Http\Controllers\InvestorAccountController::class, 'acivate_account']); 
Route::get('investor_account/deacivate_account/{id}', [App\Http\Controllers\InvestorAccountController::class, 'deacivate_account']);  

Route::get('investor_account/{id}', [App\Http\Controllers\InvestorAccountController::class, 'edit']);  
Route::put('investor_account/{id}', [App\Http\Controllers\InvestorAccountController::class, 'update']);  

// route for category
Route::get('category', [App\Http\Controllers\CategoryController::class, 'index']);     
Route::get('category/create', [App\Http\Controllers\CategoryController::class, 'create']);  
Route::post('category', [App\Http\Controllers\CategoryController::class, 'store']);  
Route::get('category/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);  
Route::put('category/{id}', [App\Http\Controllers\CategoryController::class, 'update']);  

// route for sub category
Route::get('subcategory', [App\Http\Controllers\SubCategoryController::class, 'index']);     
Route::get('subcategory/create', [App\Http\Controllers\SubCategoryController::class, 'create']);  
Route::post('subcategory', [App\Http\Controllers\SubCategoryController::class, 'store']);  
Route::get('subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'edit']);  
Route::put('subcategory/{id}', [App\Http\Controllers\SubCategoryController::class, 'update']);

// route for Admin B2b Client Testimonials  //

Route::get('clienttestimonials', [App\Http\Controllers\ClientTestimonialsController::class, 'index']); 
Route::get('clienttestimonials/create', [App\Http\Controllers\ClientTestimonialsController::class, 'create']); 
Route::post('clienttestimonials', [App\Http\Controllers\ClientTestimonialsController::class, 'store']);  
Route::get('clienttestimonials/{id}', [App\Http\Controllers\ClientTestimonialsController::class, 'edit']);  
Route::post('clienttestimonials/{id}', [App\Http\Controllers\ClientTestimonialsController::class, 'update']);
// route for Admin B2b Newsletter   //

Route::get('newsletter', [App\Http\Controllers\NewsletterController::class, 'index']); 
Route::get('newsletter/create', [App\Http\Controllers\NewsletterController::class, 'create']); 
Route::post('newsletter', [App\Http\Controllers\NewsletterController::class, 'store']);
Route::get('newsletter/{id}', [App\Http\Controllers\NewsletterController::class, 'edit']);
Route::post('newsletter/{id}', [App\Http\Controllers\NewsletterController::class, 'update']); 
Route::get('newsletter/delete/{id}', [App\Http\Controllers\NewsletterController::class, 'delete']); 

// route for Admin B2b QueryLists   //

// Route::get('querylist', [App\Http\Controllers\QueryListsController::class, 'index']); 
Route::get('querylist', [App\Http\Controllers\BlzInvstQueryListsController::class, 'index']); 
 
//Route::get('newsletter/create', [App\Http\Controllers\QueryListsController::class, 'create']); 


// route for Admin B2b Product Management   //

Route::get('ManageProduct', [App\Http\Controllers\ProductManagementController::class, 'index']); 
Route::get('ManageProduct/create', [App\Http\Controllers\ProductManagementController::class, 'create']); 

// route for Tags
Route::get('tags', [App\Http\Controllers\TagsController::class, 'index']);     
Route::get('tags/create', [App\Http\Controllers\TagsController::class, 'create']);  
Route::post('tags', [App\Http\Controllers\TagsController::class, 'store']);  
Route::get('tags/{id}', [App\Http\Controllers\TagsController::class, 'edit']);  
Route::post('tags/{id}', [App\Http\Controllers\TagsController::class, 'update']);
Route::get('tags/delete/{id}', [App\Http\Controllers\TagsController::class, 'delete']);


// Route  for SDBC Admin Start //

// Route for SDBC Admin self_paced  //

Route::get('sdbc_self_paced', [App\Http\Controllers\BlzInvstTrainingController::class, 'create']); 


// Route for SDBC Admin FAQ  //

Route::get('sdbc_faq', [App\Http\Controllers\SdbcFaqController::class, 'index']); 
Route::get('sdbc_faq/create', [App\Http\Controllers\SdbcFaqController::class, 'create']); 
Route::post('sdbc_faq', [App\Http\Controllers\SdbcFaqController::class, 'store']); 
Route::get('sdbc_faq/{id}', [App\Http\Controllers\SdbcFaqController::class, 'edit']);
Route::post('sdbc_faq/{id}', [App\Http\Controllers\SdbcFaqController::class, 'update']); 
Route::get('sdbc_faq/delete/{id}', [App\Http\Controllers\SdbcFaqController::class, 'delete']); 

// Route for sdbc_query //

Route::get('sdbc_query', [App\Http\Controllers\SdbcQueryListsController::class, 'index']); 
Route::get('sdbc_query/create', [App\Http\Controllers\SdbcQueryListsController::class, 'create']); 
Route::post('sdbc_query', [App\Http\Controllers\SdbcQueryListsController::class, 'store']); 
Route::get('sdbc_query/{id}', [App\Http\Controllers\SdbcQueryListsController::class, 'edit']);
Route::post('sdbc_query/{id}', [App\Http\Controllers\SdbcQueryListsController::class, 'update']); 
Route::get('sdbc_query/delete/{id}', [App\Http\Controllers\SdbcQueryListsController::class, 'delete']); 


// Route for sdbc_application //

Route::get('sdbc_application', [App\Http\Controllers\SdbcOnlineAppController::class, 'index']); 
Route::get('sdbc_application/create', [App\Http\Controllers\SdbcOnlineAppController::class, 'create']); 
Route::post('sdbc_application', [App\Http\Controllers\SdbcOnlineAppController::class, 'store']); 
Route::get('sdbc_application/{id}', [App\Http\Controllers\SdbcOnlineAppController::class, 'edit']);
Route::post('sdbc_application/{id}', [App\Http\Controllers\SdbcOnlineAppController::class, 'update']); 
Route::get('sdbc_application/delete/{id}', [App\Http\Controllers\SdbcOnlineAppController::class, 'delete']); 

// Route for sdbc_application //


// Route for sdbc_business_resources //

Route::get('sdbc_business_resources', [App\Http\Controllers\SdbcBusinessRcsController::class, 'index']); 
Route::get('sdbc_business_resources/create', [App\Http\Controllers\SdbcBusinessRcsController::class, 'create']); 
Route::post('sdbc_business_resources', [App\Http\Controllers\SdbcBusinessRcsController::class, 'store']); 
Route::get('sdbc_business_resources/{id}', [App\Http\Controllers\SdbcBusinessRcsController::class, 'edit']);
Route::post('sdbc_business_resources/{id}', [App\Http\Controllers\SdbcBusinessRcsController::class, 'update']); 
Route::get('sdbc_business_resources/delete/{id}', [App\Http\Controllers\SdbcBusinessRcsController::class, 'delete']); 

// Route for sdbc_business_resources //

// Route for sdbc_template_resources //

Route::get('sdbc_businesstmpl', [App\Http\Controllers\SdbcBusinessTmplController::class, 'index']); 
Route::get('sdbc_businesstmpl/create', [App\Http\Controllers\SdbcBusinessTmplController::class, 'create']); 
Route::post('sdbc_businesstmpl', [App\Http\Controllers\SdbcBusinessTmplController::class, 'store']); 
Route::get('sdbc_businesstmpl/{id}', [App\Http\Controllers\SdbcBusinessTmplController::class, 'edit']);
Route::post('sdbc_businesstmpl/{id}', [App\Http\Controllers\SdbcBusinessTmplController::class, 'update']); 
Route::get('sdbc_businesstmpl/delete/{id}', [App\Http\Controllers\SdbcBusinessTmplController::class, 'delete']); 

// Route for sdbc_template_resources //


// Route for Sdbc Advisory Requests //

Route::get('sdbc_advisory', [App\Http\Controllers\SdbcAdvRqstController::class, 'index']); 
Route::get('sdbc_advisory/create', [App\Http\Controllers\SdbcAdvRqstController::class, 'create']); 
Route::post('sdbc_advisory', [App\Http\Controllers\SdbcAdvRqstController::class, 'store']); 
Route::get('sdbc_advisory/{id}', [App\Http\Controllers\SdbcAdvRqstController::class, 'edit']);
Route::post('sdbc_advisory/{id}', [App\Http\Controllers\SdbcAdvRqstController::class, 'update']); 
Route::get('sdbc_advisory/delete/{id}', [App\Http\Controllers\SdbcAdvRqstController::class, 'delete']); 

// Route for Sdbc Advisory Requests //



// Route for sdbc_video //

Route::get('sdbc_video', [App\Http\Controllers\SdbcVideoUploadController::class, 'index']); 
Route::get('sdbc_video/create', [App\Http\Controllers\SdbcVideoUploadController::class, 'create']); 
Route::post('sdbc_video', [App\Http\Controllers\SdbcVideoUploadController::class, 'store']); 
Route::get('sdbc_video/{id}', [App\Http\Controllers\SdbcVideoUploadController::class, 'edit']);
Route::post('sdbc_video/{id}', [App\Http\Controllers\SdbcVideoUploadController::class, 'update']); 
Route::get('sdbc_video/delete/{id}', [App\Http\Controllers\SdbcVideoUploadController::class, 'delete']); 

// Route for sdbc_event //


Route::get('sdbc_event', [App\Http\Controllers\SdbcEventListingController::class, 'index']); 
Route::get('sdbc_event/create', [App\Http\Controllers\SdbcEventListingController::class, 'create']); 
Route::post('sdbc_event', [App\Http\Controllers\SdbcEventListingController::class, 'store']); 
Route::get('sdbc_event/{id}', [App\Http\Controllers\SdbcEventListingController::class, 'edit']);
Route::post('sdbc_event/{id}', [App\Http\Controllers\SdbcEventListingController::class, 'update']); 
Route::get('sdbc_event/delete/{id}', [App\Http\Controllers\SdbcEventListingController::class, 'delete']); 


// Route for Investment Generation Promotion //

Route::get('sdbc_what_we_do', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'index']); 
Route::get('sdbc_what_we_do/create', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'create']); 
Route::post('sdbc_what_we_do', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'store']); 
Route::get('sdbc_what_we_do/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'edit']);
Route::post('sdbc_what_we_do/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'update']); 
Route::get('sdbc_what_we_do/delete/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'delete']); 


// Route for Investment Generation Promotion //

Route::get('sdbc_team_members', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'team_lists']); 
Route::get('sdbc_team_members/create', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'team_create']); 
Route::post('sdbc_team_members', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'team_store']); 
Route::get('sdbc_team_members/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'team_edit']);
Route::post('sdbc_team_members/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'team_update']); 
Route::get('sdbc_team_members/delete/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'team_delete']); 

// Route for Investment Generation Other Resources //

Route::get('sdbc_resources', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'resource_lists']); 
Route::get('sdbc_resources/create', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'resource_create']); 
Route::post('sdbc_resources', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'resource_store']); 
Route::get('sdbc_resources/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'resource_edit']);
Route::post('sdbc_resources/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'resource_update']); 
Route::get('sdbc_resources/delete/{id}', [App\Http\Controllers\SdbcInvstgenpromotionController::class, 'resource_delete']); 

// Route for BTEC ADMIN START //

// Route for FAQ //
Route::get('btec_faq', [App\Http\Controllers\BtecFaqController::class, 'index']); 
Route::get('btec_faq/create', [App\Http\Controllers\BtecFaqController::class, 'create']); 
Route::post('btec_faq', [App\Http\Controllers\BtecFaqController::class, 'store']); 
Route::get('btec_faq/{id}', [App\Http\Controllers\BtecFaqController::class, 'edit']);
Route::post('btec_faq/{id}', [App\Http\Controllers\BtecFaqController::class, 'update']); 
Route::get('btec_faq/delete/{id}', [App\Http\Controllers\BtecFaqController::class, 'delete']); 


// Route for BTEC Query

Route::get('btec_query', [App\Http\Controllers\BtecQueryListsController::class, 'index']); 
Route::get('btec_query/create', [App\Http\Controllers\BtecQueryListsController::class, 'create']); 
Route::post('btec_query', [App\Http\Controllers\BtecQueryListsController::class, 'store']); 
Route::get('btec_query/{id}', [App\Http\Controllers\BtecQueryListsController::class, 'edit']);
Route::post('btec_query/{id}', [App\Http\Controllers\BtecQueryListsController::class, 'update']); 
Route::get('btec_query/delete/{id}', [App\Http\Controllers\BtecQueryListsController::class, 'delete']); 


// route for BTEC Training  
Route::get('btec_training', [App\Http\Controllers\BtecTrainingController::class, 'index']); 
Route::get('btec_training/create', [App\Http\Controllers\BtecTrainingController::class, 'create']);
Route::post('btec_training', [App\Http\Controllers\BtecTrainingController::class, 'store']); 
Route::get('btec_training/{id}', [App\Http\Controllers\BtecTrainingController::class, 'edit']);
Route::post('btec_training/{id}', [App\Http\Controllers\BtecTrainingController::class, 'update']); 
Route::get('btec_training/delete/{id}', [App\Http\Controllers\BtecTrainingController::class, 'delete']);

// route for Trainees  
Route::get('btec_trainee', [App\Http\Controllers\BtecTraineeController::class, 'index']); 
Route::get('btec_trainee/create', [App\Http\Controllers\BtecTraineeController::class, 'create']);
Route::post('btec_trainee', [App\Http\Controllers\BtecTraineeController::class, 'store']); 
Route::get('btec_trainee/{id}', [App\Http\Controllers\BtecTraineeController::class, 'edit']);
Route::post('btec_trainee/{id}', [App\Http\Controllers\BtecTraineeController::class, 'update']); 
Route::get('btec_trainee/delete/{id}', [App\Http\Controllers\BBtecTraineeController::class, 'delete']); 

// route for Trainning Calender  
Route::get('btec_trainning_calender', [App\Http\Controllers\BtecTrainningCalenderController::class, 'index']); 
Route::get('btec_trainning_calender/create', [App\Http\Controllers\BtecTrainningCalenderController::class, 'create']);
Route::post('btec_trainning_calender', [App\Http\Controllers\BtecTrainningCalenderController::class, 'store']); 
Route::get('btec_trainning_calender/{id}', [App\Http\Controllers\BtecTrainningCalenderController::class, 'edit']);
Route::post('btec_trainning_calender/{id}', [App\Http\Controllers\BtecTrainningCalenderController::class, 'update']); 
Route::get('btec_trainning_calender/delete/{id}', [App\Http\Controllers\BtecTrainningCalenderController::class, 'delete']); 


// route for Online Quiz   //// 
Route::get('btec_online_quiz', [App\Http\Controllers\BtecOnlineQuizController::class, 'index']); 
Route::get('btec_online_quiz/create', [App\Http\Controllers\BtecOnlineQuizController::class, 'create']);
Route::post('btec_online_quiz', [App\Http\Controllers\BtecOnlineQuizController::class, 'store']); 
Route::get('btec_online_quiz/{id}', [App\Http\Controllers\BtecOnlineQuizController::class, 'edit']);
Route::post('btec_online_quiz/{id}', [App\Http\Controllers\BtecOnlineQuizController::class, 'update']); 
Route::get('btec_online_quiz/delete/{id}', [App\Http\Controllers\BtecOnlineQuizController::class, 'delete']); 

// route for EventListing //
Route::get('btec_events', [App\Http\Controllers\BtecEventListingController::class, 'index']); 
Route::get('btec_events/create', [App\Http\Controllers\BtecEventListingController::class, 'create']);  
Route::post('btec_events', [App\Http\Controllers\BtecEventListingController::class, 'store']); 
Route::get('btec_events/{id}', [App\Http\Controllers\BtecEventListingController::class, 'edit']);
Route::post('btec_events/{id}', [App\Http\Controllers\BtecEventJobsPreparednessListingController::class, 'update']); 
Route::get('btec_events/delete/{id}', [App\Http\Controllers\BtecEventListingController::class, 'delete']); 

// route for Event Calender //
Route::get('btec_event_calender', [App\Http\Controllers\BtecEventListingController::class, 'calenderlist']); 


// route for VideoUpload //
Route::get('btec_videoupload', [App\Http\Controllers\BtecVideoUploadController::class, 'index']); 
Route::get('btec_videoupload/create', [App\Http\Controllers\BtecVideoUploadController::class, 'create']);  
Route::post('btec_videoupload', [App\Http\Controllers\BtecVideoUploadController::class, 'store']); 
Route::get('btec_videoupload/{id}', [App\Http\Controllers\BtecVideoUploadController::class, 'edit']);
Route::post('btec_videoupload/{id}', [App\Http\Controllers\BtecVideoUploadController::class, 'update']); 
Route::get('btec_videoupload/delete/{id}', [App\Http\Controllers\BtecVideoUploadController::class, 'delete']); 

// route for Jobs //

Route::get('btec_jobs', [App\Http\Controllers\BtecJobsController::class, 'index']); 
Route::get('btec_jobs/create', [App\Http\Controllers\BtecJobsController::class, 'create']); 
Route::post('btec_jobs', [App\Http\Controllers\BtecJobsController::class, 'store']);
Route::get('btec_jobs/{id}', [App\Http\Controllers\BtecJobsController::class, 'edit']);
Route::post('btec_jobs/{id}', [App\Http\Controllers\BtecJobsController::class, 'update']); 
Route::get('btec_jobs/delete/{id}', [App\Http\Controllers\BtecJobsController::class, 'delete']);  

// route for Jobs Preparedness //

Route::get('btec_JobsPreparedness', [App\Http\Controllers\BtecJobsController::class, 'JobsPreparednessList']);
Route::get('btec_JobsPreparedness/Add_JobPreparedness', [App\Http\Controllers\BtecJobsController::class, 'Add_JobPreparedness']);
Route::post('btec_JobsPreparedness', [App\Http\Controllers\BtecJobsController::class, 'store_jobpreparedness']);
Route::get('btec_JobsPreparedness/delete/{id}', [App\Http\Controllers\BtecJobsController::class, 'JobsPreparednessdelete']); 
Route::get('btec_ExternalJobs', [App\Http\Controllers\BtecJobsController::class, 'ExternalJobsList']);

// route for Advisory Request 
Route::get('btec_advisory', [App\Http\Controllers\BtecAdvRqstController::class, 'index']); 
Route::get('btec_advisory/create', [App\Http\Controllers\BtecAdvRqstController::class, 'create']); 
Route::post('btec_advisory', [App\Http\Controllers\BtecAdvRqstController::class, 'store']);
Route::get('btec_advisory/{id}', [App\Http\Controllers\BtecAdvRqstController::class, 'edit']);
Route::post('btec_advisory/{id}', [App\Http\Controllers\BtecAdvRqstController::class, 'update']); 
Route::get('btec_advisory/delete/{id}', [App\Http\Controllers\BtecAdvRqstController::class, 'delete']); 


// route for Business Template 
Route::get('btec_businesstmpl', [App\Http\Controllers\BtecBusinessTmplController::class, 'index']); 
Route::get('btec_businesstmpl/create', [App\Http\Controllers\BtecBusinessTmplController::class, 'create']); 
Route::post('btec_businesstmpls', [App\Http\Controllers\BtecBusinessTmplController::class, 'store']); 
Route::get('btec_businesstmpls/{id}', [App\Http\Controllers\BtecBusinessTmplController::class, 'edit']);
Route::post('btec_businesstmpls/{id}', [App\Http\Controllers\BtecBusinessTmplController::class, 'update']); 
Route::get('btec_businesstmpls/delete/{id}', [App\Http\Controllers\BtecBusinessTmplController::class, 'delete']); 


// route for Business Resource Guide 
Route::get('btec_business_resources', [App\Http\Controllers\BtecBusinessRcsController::class, 'index']); 
Route::get('btec_business_resources/create', [App\Http\Controllers\BtecBusinessRcsController::class, 'create']); 
Route::post('btec_business_resources', [App\Http\Controllers\BtecBusinessRcsController::class, 'store']); 
Route::get('btec_business_resources/{id}', [App\Http\Controllers\BtecBusinessRcsController::class, 'edit']);
Route::post('btec_business_resources/{id}', [App\Http\Controllers\BtecBusinessRcsController::class, 'update']); 
Route::get('btec_business_resources/delete/{id}', [App\Http\Controllers\BtecBusinessRcsController::class, 'delete']); 

// route for Online Application 
Route::get('btec_online_application', [App\Http\Controllers\BtecOnlineAppController::class, 'index']); 
Route::get('btec_online_application/create', [App\Http\Controllers\BtecOnlineAppController::class, 'create']); 
Route::post('btec_online_application', [App\Http\Controllers\BtecOnlineAppController::class, 'store']); 
Route::get('btec_online_application/delete/{id}', [App\Http\Controllers\BtecOnlineAppController::class, 'delete']);





// Route for BTEC ADMIN END //
// Route Start for Export Belize //


// Route Start for FAQ  //
Route::get('expblz_faq', [App\Http\Controllers\ExportBlzFaqController::class, 'index']); 
Route::get('expblz_faq/create', [App\Http\Controllers\ExportBlzFaqController::class, 'create']); 
Route::post('expblz_faq', [App\Http\Controllers\ExportBlzFaqController::class, 'store']); 
Route::get('expblz_faq/{id}', [App\Http\Controllers\ExportBlzFaqController::class, 'edit']);
Route::post('expblz_faq/{id}', [App\Http\Controllers\ExportBlzFaqController::class, 'update']); 
Route::get('expblz_faq/delete/{id}', [App\Http\Controllers\ExportBlzFaqController::class, 'delete']); 

// Route End for FAQ  //

// Route Start for Query Listings  //
Route::get('expblz_query', [App\Http\Controllers\ExportBlzQueryListsController::class, 'index']); 
Route::get('expblz_query/create', [App\Http\Controllers\ExportBlzQueryListsController::class, 'create']); 
Route::post('expblz_query', [App\Http\Controllers\ExportBlzQueryListsController::class, 'store']); 
Route::get('expblz_query/{id}', [App\Http\Controllers\ExportBlzQueryListsController::class, 'edit']);
Route::post('expblz_query/{id}', [App\Http\Controllers\ExportBlzQueryListsController::class, 'update']); 
Route::get('expblz_query/delete/{id}', [App\Http\Controllers\ExportBlzQueryListsController::class, 'delete']); 

// Route End for Query Listings  //


// Route Start for Application Forms  //
Route::get('expblz_application', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'index']); 
Route::get('expblz_application/create', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'create']); 
Route::post('expblz_application', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'store']); 
Route::get('expblz_application/{id}', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'edit']);
Route::post('expblz_application/{id}', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'update']); 
Route::get('expblz_application/delete/{id}', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'delete']); 

// Route End for Application Forms  //



// Route Start for Business Resources  //

Route::get('expblz_application', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'index']); 
Route::get('expblz_application/create', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'create']); 
Route::post('expblz_application', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'store']); 
Route::get('expblz_application/{id}', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'edit']);
Route::post('expblz_application/{id}', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'update']); 
Route::get('expblz_application/delete/{id}', [App\Http\Controllers\ExportBlzOnlineAppController::class, 'delete']); 

// Route End for Business Resources  //



// Route Start for Business Template  //

Route::get('expblz_business_resources', [App\Http\Controllers\ExportBlzBusinessRcsController::class, 'index']); 
Route::get('expblz_business_resources/create', [App\Http\Controllers\ExportBlzBusinessRcsController::class, 'create']); 
Route::post('expblz_business_resources', [App\Http\Controllers\ExportBlzBusinessRcsController::class, 'store']); 
Route::get('expblz_business_resources/{id}', [App\Http\Controllers\ExportBlzBusinessRcsController::class, 'edit']);
Route::post('expblz_business_resources/{id}', [App\Http\Controllers\ExportBlzBusinessRcsController::class, 'update']); 
Route::get('expblz_business_resources/delete/{id}', [App\Http\Controllers\ExportBlzBusinessRcsController::class, 'delete']); 

// Route End for Business Resources  //

// Route Start for Business Template  //

Route::get('expblz_businesstmpl', [App\Http\Controllers\ExportBlzBusinessTmplController::class, 'index']); 
Route::get('expblz_businesstmpl/create', [App\Http\Controllers\ExportBlzBusinessTmplController::class, 'create']); 
Route::post('expblz_businesstmpl', [App\Http\Controllers\ExportBlzBusinessTmplController::class, 'store']); 
Route::get('expblz_businesstmpl/{id}', [App\Http\Controllers\ExportBlzBusinessTmplController::class, 'edit']);
Route::post('expblz_businesstmpl/{id}', [App\Http\Controllers\ExportBlzBusinessTmplController::class, 'update']); 
Route::get('expblz_businesstmpl/delete/{id}', [App\Http\Controllers\ExportBlzBusinessTmplController::class, 'delete']); 

// Route End for Business Resources  //


// Route Start for Advisory Request  //

Route::get('expblz_advisory', [App\Http\Controllers\ExportBlzAdvRqstController::class, 'index']); 
Route::get('expblz_advisory/create', [App\Http\Controllers\ExportBlzAdvRqstController::class, 'create']); 
Route::post('expblz_advisory', [App\Http\Controllers\ExportBlzAdvRqstController::class, 'store']); 
Route::get('expblz_advisory/{id}', [App\Http\Controllers\ExportBlzAdvRqstController::class, 'edit']);
Route::post('expblz_advisory/{id}', [App\Http\Controllers\ExportBlzAdvRqstController::class, 'update']); 
Route::get('expblz_advisory/delete/{id}', [App\Http\Controllers\ExportBlzAdvRqstController::class, 'delete']); 

// Route End for Advisory Request  //

// Route Start for Advisory Request  //

Route::get('expblz_video', [App\Http\Controllers\ExportBlzVideoUploadController::class, 'index']); 
Route::get('expblz_video/create', [App\Http\Controllers\ExportBlzVideoUploadController::class, 'create']); 
Route::post('expblz_video', [App\Http\Controllers\ExportBlzVideoUploadController::class, 'store']); 
Route::get('expblz_video/{id}', [App\Http\Controllers\ExportBlzVideoUploadController::class, 'edit']);
Route::post('expblz_video/{id}', [App\Http\Controllers\ExportBlzVideoUploadController::class, 'update']); 
Route::get('expblz_video/delete/{id}', [App\Http\Controllers\ExportBlzVideoUploadController::class, 'delete']); 

// Route End for Advisory Request  //
// Route Start for Advisory Request  //

// route for Jobs //

Route::get('expblz_jobs', [App\Http\Controllers\ExportBlzJobsController::class, 'index']); 
Route::get('expblz_jobs/create', [App\Http\Controllers\ExportBlzJobsController::class, 'create']); 
Route::post('expblz_jobs', [App\Http\Controllers\ExportBlzJobsController::class, 'store']);
Route::get('expblz_jobs/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'edit']);
Route::post('expblz_jobs/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'update']); 
Route::get('expblz_jobs/delete/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'delete']);  

// Route Start for Advisory Request  //
// route for Jobs Preparedness //

Route::get('expblz_jobsPreparedness', [App\Http\Controllers\ExportBlzJobsController::class, 'JobsPreparednessList']);
Route::get('expblz_jobsPreparedness/Add_JobPreparedness', [App\Http\Controllers\ExportBlzJobsController::class, 'Add_JobPreparedness']);
Route::post('expblz_jobsPreparedness', [App\Http\Controllers\ExportBlzJobsController::class, 'store_jobpreparedness']);
Route::get('expblz_jobsPreparedness/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'edit_jobpreparedness']);
Route::post('expblz_jobsPreparedness/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'update_jobpreparedness']); 
Route::get('expblz_jobsPreparedness/delete/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'JobsPreparednessdelete']); 
//Route::get('expblz_jobsPreparedness', [App\Http\Controllers\ExportBlzJobsController::class, 'ExternalJobsList']);
// route for Advisory Request //

// route for External Jobs //

Route::get('expblz_externaljobs', [App\Http\Controllers\ExportBlzJobsController::class, 'ExternalJobsList']);
Route::get('expblz_externaljobs/add_extjob', [App\Http\Controllers\ExportBlzJobsController::class, 'add_extjob']);
Route::post('expblz_externaljobs', [App\Http\Controllers\ExportBlzJobsController::class, 'store_extjobs']);
Route::get('expblz_externaljobs/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'edit_extjobs']);
Route::post('expblz_externaljobs/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'update_extjobs']); 
Route::get('expblz_externaljobs/ExternalJobsDelete/{id}', [App\Http\Controllers\ExportBlzJobsController::class, 'ExternalJobsDelete']); 

// route for End External Jobs //

// route for Event Listing //

Route::get('expblz_event', [App\Http\Controllers\ExportBlzEventListingController::class, 'index']);
Route::get('expblz_event/create', [App\Http\Controllers\ExportBlzEventListingController::class, 'create']);
Route::post('expblz_event', [App\Http\Controllers\ExportBlzEventListingController::class, 'store']);
Route::get('expblz_event/{id}', [App\Http\Controllers\ExportBlzEventListingController::class, 'edit']);
Route::post('expblz_event/{id}', [App\Http\Controllers\ExportBlzEventListingController::class, 'update']); 
Route::get('expblz_event/delete/{id}', [App\Http\Controllers\ExportBlzEventListingController::class, 'delete']); 

// route for End Event Listing //

// route for Event Calender //

Route::get('expblz_event_calender', [App\Http\Controllers\ExportBlzEventListingController::class, 'calenderlist']);
Route::get('expblz_event_calender/create', [App\Http\Controllers\ExportBlzEventListingController::class, 'create']);
Route::post('expblz_event_calender', [App\Http\Controllers\ExportBlzEventListingController::class, 'store']);
Route::get('expblz_event_calender/{id}', [App\Http\Controllers\ExportBlzEventListingController::class, 'edit']);
Route::post('expblz_event_calender/{id}', [App\Http\Controllers\ExportBlzEventListingController::class, 'update']); 
Route::get('expblz_event_calender/delete/{id}', [App\Http\Controllers\ExportBlzEventListingController::class, 'delete']); 

// route for End Event Calender //

// Route for Add Training  //// Route::resource('training', [TrainingController::class]);

Route::get('expblz_training', [App\Http\Controllers\ExportBlzTrainingController::class, 'index']); 
Route::get('expblz_training/create', [App\Http\Controllers\ExportBlzTrainingController::class, 'create']);
Route::post('expblz_training', [App\Http\Controllers\ExportBlzTrainingController::class, 'store']); 
Route::get('expblz_training/{id}', [App\Http\Controllers\ExportBlzTrainingController::class, 'edit']);
Route::post('expblz_training/{id}', [App\Http\Controllers\ExportBlzTrainingController::class, 'update']); 
Route::get('expblz_training/delete/{id}', [App\Http\Controllers\ExportBlzTrainingController::class, 'delete']);



// route for Trainees  //// 
Route::get('expblz_trainee', [App\Http\Controllers\ExportBlzTraineeController::class, 'index']); 
Route::get('expblz_trainee/create', [App\Http\Controllers\ExportBlzTraineeController::class, 'create']);
Route::post('expblz_trainee', [App\Http\Controllers\ExportBlzTraineeController::class, 'store']); 
Route::get('expblz_trainee/{id}', [App\Http\Controllers\ExportBlzTraineeController::class, 'edit']);
Route::post('expblz_trainee/{id}', [App\Http\Controllers\ExportBlzTraineeController::class, 'update']); 
Route::get('expblz_trainee/delete/{id}', [App\Http\Controllers\ExportBlzTraineeController::class, 'delete']); 

// route for Trainning Calender  //// 
Route::get('expblz_trainning_calender', [App\Http\Controllers\ExportBlzTrainningCalenderController::class, 'index']); 
Route::get('expblz_trainning_calender/create', [App\Http\Controllers\ExportBlzTrainningCalenderController::class, 'create']);
Route::post('expblz_trainning_calender', [App\Http\Controllers\ExportBlzTrainningCalenderController::class, 'store']); 
Route::get('expblz_trainning_calender/{id}', [App\Http\Controllers\ExportBlzTrainningCalenderController::class, 'edit']);
Route::post('expblz_trainning_calender/{id}', [App\Http\Controllers\ExportBlzTrainningCalenderController::class, 'update']); 
Route::get('expblz_trainning_calender/delete/{id}', [App\Http\Controllers\ExportBlzTrainningCalenderController::class, 'delete']); 

// route for Self-paced learning  //// 
Route::get('expblz_self_paced', [App\Http\Controllers\ExportBlzSelfPacedController::class, 'index']); 
Route::get('expblz_self_paced/create', [App\Http\Controllers\ExportBlzSelfPacedController::class, 'create']);
Route::post('expblz_self_paced', [App\Http\Controllers\ExportBlzSelfPacedController::class, 'store']); 
Route::get('expblz_self_paced/{id}', [App\Http\Controllers\ExportBlzSelfPacedController::class, 'edit']);
Route::post('expblz_self_paced/{id}', [App\Http\Controllers\ExportBlzSelfPacedController::class, 'update']); 
Route::get('expblz_self_paced/delete/{id}', [App\Http\Controllers\ExportBlzSelfPacedController::class, 'delete']); 

// route for Online Quiz   //// 
Route::get('expblz_online_quiz', [App\Http\Controllers\ExportBlzOnlineQuizController::class, 'index']); 
Route::get('expblz_online_quiz/create', [App\Http\Controllers\ExportBlzOnlineQuizController::class, 'create']);
Route::post('expblz_online_quiz', [App\Http\Controllers\ExportBlzOnlineQuizController::class, 'store']); 
Route::get('expblz_online_quiz/{id}', [App\Http\Controllers\ExportBlzOnlineQuizController::class, 'edit']);
Route::post('expblz_online_quiz/{id}', [App\Http\Controllers\ExportBlzOnlineQuizController::class, 'update']); 
Route::get('expblz_online_quiz/delete/{id}', [App\Http\Controllers\ExportBlzOnlineQuizController::class, 'delete']); 

Route::get('/productquotation', [App\Http\Controllers\ProductController::class, 'quotation']);
// Route Start for Export Belize //


//member panel

Route::group(['middleware' => ['auth']], function() {
    //only verified account can access with this group
    Route::group(['middleware' => ['verified']], function() {
            /**
             * Dashboard Routes
             */
            Route::post('/memberDologin', [App\Http\Controllers\MemberController::class, 'do_Login'])->middleware(["verified"]);
    });
});
Route::post('/memberDologin', [App\Http\Controllers\MemberController::class, 'do_Login']); 
// Route::get('/SwitchToAccount',[App\Http\Controllers\MemberController::class,'SwitchToAccount']);
Route::post('/SwitchToAccount',[App\Http\Controllers\MemberController::class,'SwitchToAccountLogin']);
Route::post('/Login_switch',[App\Http\Controllers\MemberController::class,'Login_switch']);
Route::post('/memberregister', [App\Http\Controllers\MemberController::class, 'doRegister']);
Route::post('/profile-update', [App\Http\Controllers\MemberController::class, 'profileupdate']);
Route::post('/featured/{id}',[App\Http\Controllers\ProductController::class,'featured']);

Route::post('/featured',[App\Http\Controllers\ProductController::class,'featuredsearch']);

Route::group(['middleware'=>['auth']],function(){
	    
    //seller
    Route::get('/seller', [App\Http\Controllers\SellerPanelController::class, 'index']);   
    Route::get('/seller/logout', [App\Http\Controllers\SellerPanelController::class, 'logout']);  
    Route::get('/seller/settings', [App\Http\Controllers\SellerPanelController::class, 'viewsettings']);   
    Route::get('/seller/product-details', [App\Http\Controllers\SellerPanelController::class, 'productdetails']);
    Route::get('/seller/edit-product/{id}', [App\Http\Controllers\SellerPanelController::class, 'edit']);  
    Route::put('/seller/edit-product/{id}', [App\Http\Controllers\SellerPanelController::class, 'update']);
    Route::get('/seller/add-product', [App\Http\Controllers\SellerPanelController::class, 'addproduct']);   
    Route::get('/seller/quotation-lists', [App\Http\Controllers\SellerPanelController::class, 'quotationslists']);
    Route::post('/seller/delete/{id}', [App\Http\Controllers\SellerPanelController::class, 'product_delete']);
 
 // route for category
Route::get('seller/category', [App\Http\Controllers\SellerPanelController::class, 'category_list']);     
Route::get('seller/category/create', [App\Http\Controllers\SellerPanelController::class, 'category_create']);  
Route::post('seller/category', [App\Http\Controllers\SellerPanelController::class, 'category_store']);  
Route::get('seller/category/{id}', [App\Http\Controllers\SellerPanelController::class, 'category_edit']);
Route::put('seller/category/{id}', [App\Http\Controllers\SellerPanelController::class, 'category_update']);  
Route::post('/seller/delete/{id}', [App\Http\Controllers\SellerPanelController::class, 'category_delete']);
// route for sub category
Route::get('seller/subcategory', [App\Http\Controllers\SellerPanelController::class, 'subcategory_list']);     
Route::get('seller/subcategory/create', [App\Http\Controllers\SellerPanelController::class, 'subcategory_create']);  
Route::post('seller/subcategory', [App\Http\Controllers\SellerPanelController::class, 'subcategory_store']);  
Route::get('seller/subcategory/{id}', [App\Http\Controllers\SellerPanelController::class, 'subcategory_edit']);  
Route::put('seller/subcategory/{id}', [App\Http\Controllers\SellerPanelController::class, 'subcategory_update']);
Route::post('/seller/delete/{id}', [App\Http\Controllers\SellerPanelController::class, 'subcategory_delete']);
	
	//
	 Route::get('/seller/testimonials', [App\Http\Controllers\SellerPanelController::class, 'testimonialslist']);
	 Route::get('/seller/delete_testimonials/{id}', [App\Http\Controllers\SellerPanelController::class, 'delete_testimonials']);
	 Route::get('/seller/add-testimonials', [App\Http\Controllers\SellerPanelController::class, 'add_testimonials']);
     Route::post('/seller/store_testimonial', [App\Http\Controllers\SellerPanelController::class, 'store_testimonial']); 	 
	 Route::get('/seller/edit-testimonial/{id}', [App\Http\Controllers\SellerPanelController::class, 'edit_testimonial']);  
     Route::post('/seller/edit-testimonial/{id}', [App\Http\Controllers\SellerPanelController::class, 'update_testimonial']);
	//
    
    Route::post('/seller/password', [App\Http\Controllers\SellerPanelController::class, 'password']);  
    Route::post('/seller/profile', [App\Http\Controllers\SellerPanelController::class, 'updateprofile']); 
    Route::post('/seller/add-product', [App\Http\Controllers\SellerPanelController::class, 'store']);  
    

    //buyer
    Route::get('/buyer', [App\Http\Controllers\BuyerPanelController::class, 'index']); 	
    Route::get('/buyer/logout', [App\Http\Controllers\BuyerPanelController::class, 'logout']);  
    Route::get('/buyer/settings', [App\Http\Controllers\BuyerPanelController::class, 'viewsettings']); 
    Route::get('/buyer/quotation', [App\Http\Controllers\BuyerPanelController::class, 'BuyerQuotation']);
     Route::get('/buyer/order', [App\Http\Controllers\BuyerPanelController::class, 'BuyerOrder']);
    Route::post('/buyer/password', [App\Http\Controllers\BuyerPanelController::class, 'password']);  
    Route::post('/buyer/profile', [App\Http\Controllers\BuyerPanelController::class, 'updateprofile']); 
    
	
	
    //trainee
    Route::get('/trainee', [App\Http\Controllers\TraineePanelController::class, 'index']);   
    Route::get('/trainee/logout', [App\Http\Controllers\TraineePanelController::class, 'logout']);  
    Route::get('/trainee/settings', [App\Http\Controllers\TraineePanelController::class, 'viewsettings']);   
    Route::post('/trainee/password', [App\Http\Controllers\TraineePanelController::class, 'password']);  
    Route::post('/trainee/profile', [App\Http\Controllers\TraineePanelController::class, 'updateprofile']); 
	//
	 Route::get('/trainee/pre_assessment/{id}', [App\Http\Controllers\TraineePanelController::class, 'pre_assessment']);
	 Route::get('/trainee/pre_assessment_start/{id}', [App\Http\Controllers\TraineePanelController::class, 'pre_assessment_start']);
	 Route::post('/trainee/pre_assessment_add/{id}', [App\Http\Controllers\TraineePanelController::class, 'pre_assessment_add']);
	
	//
	Route::get('/trainee/training_list', [App\Http\Controllers\TraineePanelController::class, 'training_list']); 
	Route::get('/trainee/view_payment', [App\Http\Controllers\TraineePanelController::class, 'view_payment']); 
	Route::get('/trainee/add_payment/{id}', [App\Http\Controllers\TraineePanelController::class, 'add_payment']);   
	Route::post('/trainee/payment_reciept_upload', [App\Http\Controllers\TraineePanelController::class, 'payment_reciept_upload']);  
	Route::get('/trainee/feedback_form/{id}', [App\Http\Controllers\TraineePanelController::class, 'feedback_form']);
	Route::post('/trainee/feedback_form_do', [App\Http\Controllers\TraineePanelController::class, 'feedback_form_do']);
	Route::get('/trainee/certificate', [App\Http\Controllers\TraineePanelController::class, 'pdf']);
    
    //investor
    Route::get('/investor', [App\Http\Controllers\InvestorPanelController::class, 'index']);  
    Route::get('/investor/create-concept', [App\Http\Controllers\InvestorPanelController::class, 'investment_concept']); 
    Route::get('/investor/profile-create', [App\Http\Controllers\InvestorPanelController::class, 'investment_project']);
    Route::post('/investor/profile-create_do', [App\Http\Controllers\InvestorPanelController::class, 'investment_create']);
    Route::get('/investor/logout', [App\Http\Controllers\InvestorPanelController::class, 'logout']);  
	
	
    Route::get('/investor/settings', [App\Http\Controllers\InvestorPanelController::class, 'viewsettings']);   
    Route::post('/investor/password', [App\Http\Controllers\InvestorPanelController::class, 'password']);  
    Route::post('/investor/profile', [App\Http\Controllers\InvestorPanelController::class, 'updateprofile']); 

});
