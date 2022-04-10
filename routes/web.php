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
// Home page
Route::get('/', 'HomeController@index')->name('home');
Route::resource('movie-detail', 'MovieController');
Route::resource('booking', 'BookingController');
Route::resource('vote', 'VoteController');
Route::group(['middleware' => 'user'], function() {
    Route::resource('choose-seat', 'ChooseSeatController');
    Route::resource('payment', 'PaymentController');
    Route::resource('bill', 'BillController');
    Route::resource('profile', 'UserController');
});
Route::get('now-showing', 'MovieController@nowShowing')->name('now-showing');
Route::get('comming-soon', 'MovieController@commingSoon')->name('comming-soon');
Auth::routes();
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', 'AdminHomeController@index')->name('admin-home');
    Route::resource('cinema', 'CinemaController');
    Route::resource('room', 'RoomController');
    Route::resource('seat_type', 'SeatTypeController');
    Route::resource('room_type', 'RoomTypeController');
    Route::resource('seat_price', 'SeatPriceController');
    Route::resource('seat', 'SeatController');
    Route::resource('seat_col', 'SeatColController');
    Route::resource('movie', 'MovieController');
    Route::resource('showtime', 'ShowtimeController');
    Route::resource('ticket', 'TicketController');
    Route::resource('slide', 'SlideController');
    Route::resource('adm-bill', 'AdminBillController');
    Route::resource('user', 'UserController');
});
Route::get('/search', 'SearchController@searchFullText')->name('search');
Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');
Route::get('lang/{lang}', 'LangController@changeLang')->name('lang');
Route::post('sendmess', 'ChooseSeatController@postSend');
Route::resource('pdf','pdfController');
Route::resource('map', 'MapController');
