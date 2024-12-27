<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any}', "HomeController@index")->where('any', '.*')->name('frontend.home');


//Fetch API data
//Middleware "role:donor", "role:charity"
