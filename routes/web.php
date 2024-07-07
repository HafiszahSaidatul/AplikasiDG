<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardItemController;
use App\Http\Controllers\LowController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendingController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('login.index', [
        "title" => "login",
    ]);
});





Route::get('/dashboard', [DashboardItemController::class, "index"])->middleware(['auth']);
Route::get('/pending', [PendingController::class, 'index'])->name('pendings.index')->middleware('auth');
Route::get('/pending/create/{itemId}', [PendingController::class, 'create'])->name('pendings.create')->middleware('auth');;
Route::post('/pending/{itemId}', [PendingController::class, 'store'])->name('pendings.store')->middleware('auth');;
Route::get('/pending/{id}', [PendingController::class, 'show'])->name('pendings.show')->middleware('role:admin');;
Route::get('/pending/{id}/edit', [PendingController::class, 'edit'])->name('pendings.edit')->middleware('auth');;
Route::put('/pending/{id}', [PendingController::class, 'update'])->name('pendings.update')->middleware('auth');;
Route::delete('/pending/{id}', [PendingController::class, 'destroy'])->name('pendings.destroy')->middleware('role:admin');;



Route::get('/low', [LowController::class, 'index'])->name('lows.index');
Route::get('/low/create/{itemId}', [LowController::class, 'create'])->name('lows.create')->middleware('auth');;
Route::post('/low/{itemId}', [LowController::class, 'store'])->name('lows.store')->middleware('auth');;
Route::get('/low/{id}', [LowController::class, 'show'])->name('lows.show');
Route::get('/low/{id}/edit', [LowController::class, 'edit'])->name('lows.edit')->middleware('auth');;
Route::put('/low/{id}', [LowController::class, 'update'])->name('lows.update')->middleware('auth');;
Route::delete('/low/{id}', [LowController::class, 'destroy'])->name('lows.destroy')->middleware('role:admin');;


//produk
Route::get('/produk', [ItemController::class, 'index'])->middleware('auth')->name('produk.index');
Route::get('/produk/create', [ItemController::class, 'create'])->middleware('auth')->name('produk.create')->middleware('role:admin');
Route::post('/produk/create', [ItemController::class, 'store'])->middleware('auth')->name('produk.store')->middleware('role:admin');;




Route::get('/produk/{id}/edit', [ItemController::class, 'edit'])->name('produk.edit')->middleware('role:admin');;
Route::delete('/produk/{id}/delete', [ItemController::class, 'destroy'])->name('produk.destroy')->middleware('role:admin');;

Route::put('/produk/{id}/edit', [ItemController::class, 'update'])->name('produk.update')->middleware('role:admin');;



// Route::middleware(['role:pegawai'])->group(function () {
//     Route::get('pegawai/dashboard', [PegawaiController::class, "index"]);
//     Route::get('pegawai/produk', [PegawaiController::class, "product"]);
//     Route::get('pegawai/pending', [PegawaiController::class, "pending"])->name('pending.pegawai.index');
//     Route::get('pegawai/low', [PegawaiController::class, "low"])->name('low.pegawai.index');


//     Route::get('pegawai/pending/create/{id}', [PegawaiController::class, "craetePending"])->name('pending.pegawai.create');
//     Route::post('pegawai/pending/create/{id}', [PegawaiController::class, "storePending"])->name('pending.pegawai.store');



//     Route::get('pegawai/low/create/{id}', [PegawaiController::class, "craeteLow"])->name('low.pegawai.create');
//     Route::post('pegawai/low/create/{id}', [PegawaiController::class, "storeLow"])->name('low.pegawai.store');
// });





//halaman detail
Route::get('items/{item:slug}', [ItemController::class, 'show']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/dashboard/items/checkSlug', [DashboardItemController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/items', DashboardItemController::class)->middleware('auth');


// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

Route::get('/search', [ItemController::class, 'search'])->name('products.search');
