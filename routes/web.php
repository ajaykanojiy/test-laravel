<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisternewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth','verified']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
});
Route::get('/ip',[CategoryController::class,'ipdemo']);
Route::get('list', [ProductController::class, 'getProduct']);
Route::post('reg', [RegisternewController::class, 'create']);
Route::post('loginnew', [RegisternewController::class, 'customLogin']);
Route::get('delete/{id}', [ProductController::class, 'delete']);

Route::get('/profile', function () {
    // This route can only be accessed by confirmed users...
})->middleware('verified');

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::get('/profile', function () {
//     // This route can only be accessed by confirmed users...
// })->middleware('verified');