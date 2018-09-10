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
Route::get('home','Checkin_outController@home');


Route::get('previous_check','Previous_checkController@index');
Route::get('report','ReportController@index');


Route::get('signup','AccountController@create');
Route::post('signup','AccountController@store');

Route::get('/','AccountController@index');
Route::get('signin','AccountController@index');
Route::post('signin','AccountController@signin');

Route::get('logout', 'AccountController@logout');

Route::get('role','RoleController@index');


Route::post('role/create','RoleController@store');
Route::get('role/edit/{id}',"RoleController@edit");
Route::post('role/edit/{id}',"RoleController@update");

Route::get('unassigned_user','AccountController@assign');
Route::post('unassigned_user','AccountController@add_assign');

Route::get('block/{id}','AccountController@destroy');

Route::get('assign/edit/{id}','AccountController@edit');
Route::post('assign/edit/{id}','AccountController@update');




Route::get('checkin/{id}','Checkin_outController@checkin_form');
Route::post('checkin/{id}','Checkin_outController@check_in');

Route::get('checkout/{id}','Checkin_outController@check_out');

// Route::get('late/{id}','Checkin_outController@late');
Route::post('late/{id}','Checkin_outController@store_late');

Route::get('late/{id}','Checkin_outController@late');



Route::get('late_report','AccountController@late_report');

Route::get('reprint_late/{id}',"AccountController@reprint_late");
Route::post('reprint_late/{id}',"AccountController@reprint_late_store");



Route::get('leave/{id}','Checkin_outController@leave');
Route::post('leave/{id}','Checkin_outController@store_leave');

Route::get('leave_report','AccountController@leave_report');
Route::post('leave_report','AccountController@store_leave_rp');

Route::get('date','Checkin_outController@date');
Route::get('time','Checkin_outController@time');

Route::get('profile','AccountController@profile');

Route::get('profile/edit/{id}','AccountController@profile_edit');
Route::post('profile/edit/{id}','AccountController@profile_update');

Route::get('change_pass/{id}','AccountController@changePasswordForm');
Route::post('change_pass/{id}','AccountController@changePassword');

Route::get('requestLeave','AccountController@requestLeave');


Route::get('leave_review/{id}','AccountController@leave_review');


Route::get('leave_review','Leave_absentController@index');

Route::get('leave_detail/{id}','Leave_absentController@show');

Route::get('unactive_user','RoleController@block_user');

Route::get('reactive/{id}','RoleController@reactive');

Route::get('cancel/{id}','RoleController@destroy');
