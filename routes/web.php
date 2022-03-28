<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Contact;
use App\Models\category;
use Illuminate\Support\Facades\Auth;

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
    $brands = DB::table('brands')->get();
    $about = DB::table('home_abouts')->get();
    $multi = DB::table('multipics')->get();
    return view('home',compact('brands','about','multi'));
});

Route::get('/home', function () {
    echo "If you have been redirected to this page it probably means you are too young to be visiting these types of sites";
});

Route::get('/portfolio', function () {
    $multi = DB::table('multipics')->get();
    return view('portfolio', compact('multi'));
});

Route::get('/contact',function(){
    $details = Contact::all();
    return view('contact',compact('details'));
});

Route::get('/about',function(){
    return view('about');
})->middleware('check');

//category controller
Route::get('/category/all', [CategoryController::class,'AllCat'])->name('all.category');
Route::post('/category/all', [CategoryController::class,'AddCat'])->name('store.category');


Route::get('/category/edit/{id}', [CategoryController::class,'Edit']);
Route::post('/category/update/{id}', [CategoryController::class,'Update']);


//Delete Route --On this paper route and im having fun
Route::get('/softdelete/category/{id}', [CategoryController::class,'softDelete']);



Route::get('/category/restore/{id}', [CategoryController::class,'Restore']);
Route::get('/pdelete/category/{id}', [CategoryController::class,'Pdelete']);







// --------------- For Brand route
Route::get('/brand/all', [BrandController::class,'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class,'Edit']);
Route::post('/brand/update/{id}', [BrandController::class,'Update']);
Route::get('/brand/delete/{id}', [BrandController::class,'Delete']);



///--------------Multi image route
Route::get('/multipic/all', [BrandController::class,'Multipic'])->name('multi.image');
Route::post('/multipic/add', [BrandController::class,'Storemultipic'])->name('store.image');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');







//------------Admin all route

Route::get('/home/slider', [HomeController::class,'HomeSlider'])->name('home.slider');

Route::get('/add/slider', [HomeController::class,'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class,'StoreSlider'])->name('store.slider');

Route::get('/slider/edit/{id}', [HomeController::class,'EditSlider']);
Route::post('/slider/update/{id}', [HomeController::class,'UpdateSlider'])->name('update.slider');

Route::get('/slider/delete/{id}', [HomeController::class,'DeleteSlider']);










//----------Home about All route

Route::get('/home/about', [AboutController::class,'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class,'AddAbout'])->name('add.about');
Route::post('/create/about', [AboutController::class,'CreateAbout'])->name('create.about');
Route::get('/about/edit/{id}', [AboutController::class,'EditAbout'])->name('edit.about');
Route::post('/about/update/{id}', [AboutController::class,'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class,'DeleteAbout'])->name('delete.about');





//////////// ------- Admin contact page
Route::get('/admin/contact', [ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('/admin/add', [ContactController::class,'AddContact'])->name('admin.add');
Route::post('/contact/create', [ContactController::class,'CreateContact'])->name('create.contact');
Route::get('/contact/edit/{id}', [ContactController::class,'EditContact']);
Route::post('/contact/update/{id}', [ContactController::class,'UpdateContact']);
Route::get('/contact/delete/{id}', [ContactController::class,'DeleteContact']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // return view('admin.index_master',compact('users'));
    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout', [BrandController::class,'Logout'])->name('user.logout');


//// Change password and user profile
Route::get('/user/password', [ChangePass::class,'CPassword'])->name('change.password');
Route::post('/user/update', [ChangePass::class,'UpdatePassword'])->name('password.update');
