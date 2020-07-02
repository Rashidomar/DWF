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

// use Illuminate\Routing\Route;

//Admin Routes
Route::prefix('admin')->group(function () {

    Route::get('/login', 'AdminController@admin_login_page')->name('login');

    Route::post('/login_admin', 'AdminController@admin_login');

    Route::get('/register', 'AdminController@admin_signup_page');

    Route::post('/register_admin', 'AdminController@admin_register');

    Route::get('/admindashboard', 'AdminController@admin_dashboard')->middleware('auth:admin');

    Route::get('/logout', 'AdminController@logout');

});


//Staff Routes
Route::prefix('staff')->group(function () {

    Route::get('/login', 'StaffController@index')->name('login');

    Route::post('/login_staff', 'StaffController@staff_login');

    Route::get('/register', 'StaffController@staff_signup_page');

    Route::post('/register_staff', 'StaffController@staff_register');

    Route::get('/staffdashboard', 'StaffController@staff_dashboard')->middleware('auth:staff');

    Route::put('/update/{id}', 'StaffController@staff_update');

    Route::get('/{id}/edit', 'StaffController@staff_edit');

    Route::get('/staffshow', 'StaffController@show');

    Route::get('/logout', 'StaffController@logout');
});

//Auditor Routes
Route::prefix('auditor')->group(function () {

    Route::get('/login', 'AuditorController@index')->name('login');

    Route::post('/login_auditor', 'AuditorController@auditor_login');

    Route::get('/register', 'AuditorController@auditor_signup_page');

    Route::post('/register_auditor', 'AuditorController@auditor_register');

    Route::get('/dashboard', 'AuditorController@auditor_dashboard')->middleware('auth:auditor');

    Route::put('/update/{id}', 'AuditorController@auditor_update');

    Route::get('/{id}/edit', 'AuditorController@auditor_edit');

    Route::get('/show', 'AuditorController@show');

    Route::get('/logout', 'AuditorController@logout');
});

//Registrar Routes
Route::prefix('registrar')->group(function () {

    Route::get('/login', 'RegistrarController@index')->name('login');

    Route::post('/login_registrar', 'RegistrarController@registrar_login');

    Route::get('/register', 'RegistrarController@registrar_signup_page');

    Route::post('/register_registrar', 'RegistrarController@registrar_register');

    Route::get('/dashboard', 'RegistrarController@registrar_dashboard')->middleware('auth:registrar');

    Route::put('/update/{id}', 'RegistrarController@registrar_update');

    Route::get('/{id}/edit', 'RegistrarController@registrar_edit');

    Route::get('/show', 'RegistrarController@show');

    Route::get('/logout', 'RegistrarController@logout');
});

//Dean Routes
Route::prefix('dean')->group(function () {

    Route::get('/login', 'DeanController@index')->name('login');

    Route::post('/login_dean', 'DeanController@dean_login');

    Route::get('/register', 'DeanController@dean_signup_page');

    Route::post('/register_dean', 'DeanController@dean_register');

    Route::get('/dashboard', 'DeanController@dean_dashboard')->middleware('auth:dean');

    Route::put('/update/{id}', 'DeanController@dean_update');

    Route::get('/{id}/edit', 'DeanController@dean_edit');

    Route::get('/show', 'DeanController@show');

    Route::get('/logout', 'DeanController@logout');
});

//Inbox Routes
Route::prefix('inbox')->group(function () {

    Route::get('/audit', 'InboxController@inbox_audit');

    Route::get('/registrar/{document_id}/{auditor_id}/{staff_id}', 'InboxController@inbox_registrar');

    Route::get('/registrar/' , 'InboxController@get_inbox_registrar');

    Route::get('/dean/{document_id}/{staff_id}/{reg_id}', 'InboxController@inbox_dean');

    Route::get('/dean', 'InboxController@get_inbox_dean');

});

//Message Routes
Route::prefix('message')->group(function () {

    Route::get('/approved/{document_id}/{staff_id}', 'InboxController@approved');

    Route::get('/approved', 'InboxController@get_approved');

    Route::get('/disapproved/{document_id}/{staff_id}', 'InboxController@disapproved');

    Route::get('/disapproved', 'InboxController@get_disapproved');

});

//Documents
Route::resource('/document', 'DocumentController');

