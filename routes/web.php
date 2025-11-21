<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('nusavirland.home');
});

Route::get('/explore-monas', function () {
    return view('nusavirland.explore-monas');
});

Route::get('/explore-gedungsate', function () {
    return view('nusavirland.explore-gedungsate');
});

Route::get('/explore-borobudur', function () {
    return view('nusavirland.explore-borobudur');
});

Route::get('/explore-surabaya', function () {
    return view('nusavirland.explore-surabaya');
});

Route::get('/explore-lawangsewu', function () {
    return view('nusavirland.explore-lawangsewu');
});

Route::get('/explore-ampera', function () {
    return view('nusavirland.explore-ampera');
});
