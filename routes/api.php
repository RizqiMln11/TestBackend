<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\AuthController@login');


Route::middleware('jwt.auth')->group(function(){

    // Route Staff

    //route staff log out
    Route::get('staff/logout', 'API\AuthController@logout');
    //vew all customer
    Route::get('staff/show/cust', 'StaffController@showAllCust');
    //Staff delete customer
    Route::post('staff/delete/cust', 'StaffController@deleteCust');
    //Staff send message customer
    Route::post('staff/message/cust', 'StaffController@sendMessageToCust');
    //Staff send message Staff
    Route::post('staff/message/staff', 'StaffController@sendMessageToStaff');
    //History Chat Terkirim
    Route::post('staff/message/sent', 'StaffController@viewAllMessageIsSent');
    //History Chat Di terima
    Route::post('staff/message/recived', 'StaffController@viewAllMessageIsRecived');

    //Route Customer

    //Customer send message customer
    Route::post('cust/message/cust', 'CustomerController@sendMessageToCust');
    //History Chat Terkirim
    Route::get('cust/message/sent', 'CustomerController@viewAllMessageIsSent');
    //History Chat Di terima
    Route::get('cust/message/recived', 'CustomerController@viewAllMessageIsRecived');
    // report other Customer(s) or own feedback/bug
    Route::post('cust/report', 'ReportController@sendReportoCust');


    Route::get('logout', 'API\AuthController@logout');
});
