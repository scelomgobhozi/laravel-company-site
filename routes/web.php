<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;

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

Route::get('/home', function () {
    echo "If you have been redirected to this page it probably means you are too young to be visiting these types of sites";
});


Route::get('/about',function(){
    return view('about');
})->middleware('check');

//category controller
Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/all', [CategoryController::class,'AddCat'])->name('store.category');

Route::get('/contact',[ContactController::class, 'index'])->name('con');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('dashboard',compact('users'));
})->name('dashboard');
