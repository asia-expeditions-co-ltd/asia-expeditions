<?php



use Illuminate\Support\Facades\Auth;

use App\components\Shared;

use Illuminate\Http\Request;

use Illuminate\Contracts\Encryption\DecryptException;

use App\User;

use App\Wishlist;
 
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



// Route::get('checktemplate', function(){
// 	return view('emails.sendtemplate.sendtemplate');
// });


Route::get("/category/{name}", "CategoryController@getCategory")->name("category"); 

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index'] );

Route::resource('/destination', 'HomeController', [ 'only' => ['index','store','show','update','destroy']]);

Route::get('/destination/{country}/{province}', 'HomeController@showProvince')->name('destination');

Route::get('/mice','HomeController@getmice');
Route::get('/mice/{name}','HomeController@getmiceName')->name('miceName');

Route::get("/ourteam", "HomeController@ourteam");

Route::get("/ourteam/{name}", "HomeController@teamDetail")->name('teamDetail');

Route::get('/contactus', "HomeController@contactUs");

Route::post('/contactus', "HomeController@sendContactus");

Route::get('/forgot_password', 'HomeController@getForgot');

Route::post('/forgotpassword', "HomeController@doForgot");

Route::get('/create_new_password', 'HomeController@getCreateNewPassword');

Route::post('/create_new_password', 'HomeController@doCreateNewPassword');

Route::get('/general-information/', "HomeController@getInformation");

Route::get('/site-map.xml', "HomeController@getSiteMape")->name('sitemap');

Route::get('/slide', "HomeController@testSlide");

Route::get('/ournews', "HomeController@ournew")->name('ournew');

Route::get('/ournews/{name}', "HomeController@newsDetail")->name('DetailNew');

Route::get('/newsletter', "NewsletterController@getNewsletter");
Route::post('/getSubscrbe', "NewsletterController@getEmailSubscribe");

Route::get('/getemailNewsletter', "NewsletterController@GetemailNewsletter");

Route::post('/sentnewsletter', "NewsletterController@Newsletter");

Route::get('/getcity', ['uses' => 'TourController@getSearchcity', 'as' => 'tour.getSearchcity']);

Route::get('search', ['uses' => 'TourController@getTour', 'as' => 'tour.search'])->name('search_tour');

Route::get('/searchtour', ['uses' => 'TourController@getTourName', 'as' => 'tour.searchName']);

Route::get("/tour/{name}", "TourController@tourDetails")->name('tourDetails');

Route::post("/tour/mail/to", "TourController@mailto");

Route::get("/test", "TourController@getTest");

Route::get('return_data', ['uses' => 'CartController@getReturn', 'as' => 'check.returnPay']);

Route::get('return_fails', ['uses' => 'CartController@getReturnFails', 'as' => 'check.fails']);

Route::post('login', ['uses' => 'CartController@Login', 'as' => 'check.login']);

Route::get('add-to-cart/{id}', ['uses' => 'CartController@addTocart', 'as' => 'tour.addTocart']);

Route::post('edit-cart/{id}', ['uses' => 'CartController@updateCart', 'as' => 'tour.editCart']);

Route::get('shopping-cart', ['uses' => 'CartController@getCart', 'as' => 'tour.shopping-cart']);

Route::get('remove-cart/{id}', ['uses' =>'CartController@removeCart', 'as' => 'tour.remove-cart']);

Route::get('register', ['uses' => 'CartController@getChechout', 'as' => 'tour.checkout']);

Route::get('checkout', ['uses' => 'CartController@getChechout', 'as' => 'tour.checkout']);


Route::get("film/{film_locaton}", "HomeController@getFilm")->name('getFilm');

Route::post('checkout', ['uses' => 'CartController@getCheckAccount', 'as' => 'check.account']);

Route::group(['middleware' => ['isCustomer']], function () {
	Route::get('payment', ['uses' => 'CartController@getPayment', 'as' => 'check.payment']);
	Route::post('pay_link', ['uses' => 'CartController@linkPayment', 'as' => 'check.linkpayment']);
	Route::get('inovice', ['uses' => 'CartController@getInvoice', 'as' => 'check.invoice']);
    Route::get('account', ['uses' => 'CustomerController@getAccount', 'as' => 'get.account']);
    Route::post('account', ['uses' => 'CustomerController@doAccount', 'as' => 'do.account']);
    Route::post('editaccount', ['uses' => 'CustomerController@doCreateNewPassword', 'as' => 'edit.password']);
	Route::get('logout', ['uses' => 'CustomerController@getLogout', 'as' => 'get.logout']);
});


Route::get('/login', "UserController@getLogin")->name('login');
Route::post('/clientLogin', "UserController@getDoLogin")->name('doLogin');
Route::post('logout', 'UserController@getLogout')->name('logout');

Route::group(['middleware' => ['isAdmin']], function () {
	Route::group(['prefix'=> 'admin'], function () {
	   	Route::get('/', 'NewsletterController@getViewDashboard')->name('admin');
	   	Route::get('email/list', 'NewsletterController@getEmailList')->name('emailList');
	   	Route::get('email/sent', 'NewsletterController@getSentEmailList')->name('sentemailList');
	   	Route::get('email/', 'NewsletterController@getEmailtemplate')->name('getEmailtemplate');
	   	Route::post('email/send', 'NewsletterController@sendEmail')->name('sendEmail');
	   	Route::get('getsearchmail', 'NewsletterController@getsearchMailsubscribe')->name('searchEmail');

	   	// return 'hello'; 
	   	Route::get('user', 'UserController@getUser')->name('getUser');
	   	Route::get('update', 'UserController@getUpdate')->name('getUpdate');
	   	Route::post('userAdd', 'UserController@createUser')->name('createUser');
	   	Route::post('userEdit', 'UserController@updateUser')->name('updateUser');

	   	// our news 
	   	Route::get('ournews', 'Admin\TourController@ourNewsList')->name('ourNewsList');
	   	Route::get('ournews/add', 'Admin\TourController@ourNewsForm')->name('ourNewsForm');
	   	Route::post('ournews/created', 'Admin\TourController@ourNewsCreate')->name('ourNewsCreate');


	   	Route::get('slideshow', 'Admin\TourController@slideList')->name('slideList');
	   	Route::get('slide/add', 'Admin\TourController@SlideForm')->name('SlideForm');
	   	Route::post('slide/created', 'Admin\TourController@createSlide')->name('slideCreate');

	   	// tour section
	   	Route::get('tours', 'Admin\TourController@index')->name('tourList');
	   	Route::get('tours/create', 'Admin\TourController@create')->name('tourForm');
	   	Route::post('tours/create/tour', 'Admin\TourController@store')->name('tourCreate');
	   	Route::get('tour/update/{tour}/edit', 'Admin\TourController@getEdit')->name('getEdit');
	   	Route::post('tour/update', 'Admin\TourController@getUpdate')->name('getUpdate');

	   	Route::get('search-data', 'Admin\AdminController@searchData')->name('searchProvince');
	   	Route::get('delete-option/{delid}', 'Admin\AdminController@getDelete')->name('getDelete');
	   	Route::get('check-hotel', 'Admin\AdminController@checkHotel')->name('checkHotel');



	   	Route::get('window/uploaded', 'Admin\UploadController@fileUploaded')->name('fileUploaded');
		Route::get('window/remove/fileUploaded', 'Admin\UploadController@removeFile')->name('removeFile');
		Route::post("window/uploadfile", 'Admin\UploadController@uploadfile')->name('uploadfile');
		Route::post("window/uploadfile/only", 'Admin\UploadController@uploadOnlyFile')->name('uploadOnlyFile');
		Route::get("window/remove-image/logo", 'Admin\UploadController@RemoveLogo')->name('RemoveLogo');
	   	
	});
});





// start leaning angularjs from 2017-11-29
// Route::get('ang', "AngurlarController@getAngu")->name('getAng');

