<?php

use App\Http\Controllers\asyncController;
use App\Http\Controllers\newoperationController;
use App\Http\Controllers\operationController;
use Illuminate\Support\Facades\Route;

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
    return view('frontend.homepage');
})->name('homepage');
Route::get('/post',function(){
    return view('admin.post');
})->name('post');
Route::post('/postController',[operationController::class,'savePost'])->name('postController');
Route::post('/search',[operationController::class,'searchPost'])->name('search');
Route::post('/booking',[operationController::class,'booking'])->name('booking');
Route::get('confirmpage',function()
{
return view('frontend.confirmationpage');
})->name('confirmpage');
Route::get('newHomepage',[newoperationController::class,'homepageShow'])->name('newHomepage');
Route::post('/newsearch',[newoperationController::class,'newsearchPost'])->name('newsearchPost');
Route::post('/async',[asyncController::class,'selectedOptionHandler'])->name('selectedOptionHandler');
Route::view('new','frontend.newHomepage2');