<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('/galeri', 'galeri')->name('galeri');
Route::redirect('/projects', '/galeri')->name('projects.index');
Route::redirect('/project', '/galeri');

Route::view('/projects/alfagift', 'alfagift')->name('projects.alfagift');
Route::view('/projects/powerbi', 'powerbi')->name('projects.powerbi');
Route::view('/projects/khamenei', 'khamenei')->name('projects.khamenei');
Route::view('/projects/clustering', 'clustering')->name('projects.clustering');

/*
|--------------------------------------------------------------------------
| Backward compatible aliases
|--------------------------------------------------------------------------
| Link lama tetap aman, tapi route canonical berada di /projects/...
*/
Route::redirect('/alfagift', '/projects/alfagift')->name('alfagift');
Route::redirect('/powerbi', '/projects/powerbi')->name('powerbi');
Route::redirect('/khamenei', '/projects/khamenei')->name('khamenei');
Route::redirect('/clustering', '/projects/clustering')->name('clustering');
