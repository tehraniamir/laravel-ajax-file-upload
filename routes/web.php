<?php

use Illuminate\Support\Facades\Route;


Route::get('/article/create', 'TestController@index');
Route::post('/upload-ajax', 'TestController@store')->name('upload.ajax');
