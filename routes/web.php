<?php

use Lib\Route;

use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function(){
    return;
});

Route::get('/about', function(){
    return;
});

Route::get('/courses/:slug', function($slug){
    return;
});

Route::dispatch();