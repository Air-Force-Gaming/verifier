<?php

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');

    if (Auth::User()) {
        redirect()->route('/account');
    }
});

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')
            ->where('provider','battlenet|discord|facebook|live|steam');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')
            ->where('provider','battlenet|discord|facebook|live|steam');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/account', 'AccountController@show');

Route::post('/generateVerification', 'AccountController@emailAuthToken');
Route::get('/resend', 'AccountController@resendEmailAuthToken');
Route::get('/verify/{token}', 'AccountController@handleVerifyAttempt');