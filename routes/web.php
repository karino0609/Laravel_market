<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LikeController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\ItemController;

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
Route::get('/', [ItemController::class, 'index'])->name('top');

Route::resource('likes', LikeController::class)->only([
    'index'
    ]);
    
Route::patch('/likes/{item}/toggle_like', [LikeController::class, 'toggleLike'])->name('likes.toggle_like');


Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');

Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');

Route::get('/profile/edit_image', [UserController::class, 'editImage'])->name('profile.edit_image');

Route::patch('/profile/edit_image', [UserController::class, 'updateImage'])->name('profile.update_image');
 
Route::resource('users', UserController::class)->only([
  'show'
]);

Route::resource('items', ItemController::class);

Route::get('items/{item}/confirm', [ItemController::class, 'confirm'])->name('items.confirm');

Route::post('items/{item}/finish', [ItemController::class, 'finish'])->name('items.finish');

Route::get('/users/{user}/exhibitions', [UserController::class, 'exhibitions'])->name('users.exhibitions');

Route::get('items/{item}/edit_image', [ItemController::class, 'editImage'])->name('items.edit_image');//画像編集画面の呼び出し

Route::patch('items/{item}/edit', [ItemController::class, 'update'])->name('items.update');

Route::patch('items/{item}/edit_image', [ItemController::class, 'updateImage'])->name('items.update_image');//画像更新処理


Auth::routes();