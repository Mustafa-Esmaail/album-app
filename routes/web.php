<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->resource('/albums', AlbumController::class);

Route::middleware('auth')->get('albums/{album}/delete', [AlbumController::class, 'delete'])->name('albums.delete');
Route::middleware('auth')->post('albums/{album}/delete', [AlbumController::class, 'deleteAlbum'])->name('albums.delete.submit');
