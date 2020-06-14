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

//Admin Routess
Route::get('/admin/login', 'AdminController@admin_login_page');

Route::post('/admin/login_admin', 'AdminController@admin_login');

Route::get('/admin/register', 'AdminController@admin_signup_page');

Route::post('/admin/register_admin', 'AdminController@admin_register');

Route::get('/admin/admindashboard', 'AdminController@admin_dashboard');

//Staff Routes
Route::get('/staff/login', 'StaffController@staff_login_page');

Route::post('/staff/login_staff', 'StaffController@staff_login');

Route::get('/staff/register', 'StaffController@staff_signup_page');

Route::post('/staff/register_staff', 'StaffController@staff_register');

Route::get('/staff/staffdashboard', 'StaffController@staff_dashboard');
