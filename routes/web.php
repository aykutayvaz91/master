<?php

use Illuminate\Support\Facades\Route;


#Bu eklenecek controllerlar için Resource route ekleniyor

use App\Http\Controllers\UsersController;
use App\Http\Controllers\KameraController;

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */

    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('/personel', 'PersonnelController@index')->name('personel.index');
        Route::get('/appoint', 'AppointController@index')->name('appoint.index');
        Route::get('/appoint/me', 'AppointController@me')->name('appoint.me');
        Route::get('/report', 'AppointController@list')->name('appoint.list');
        Route::post('/home/performsync', 'HomeController@performsync')->name('home.performsync');
        Route::post('/appoint/save', 'AppointController@save')->name('appoint.save');
    });
});

