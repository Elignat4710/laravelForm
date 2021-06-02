<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'homePageAdmin'])->name('homePageAdmin');
        Route::get('/list', [AdminController::class, 'listMembers'])->name('listMembers');
        Route::patch('/hide/{id}', [AdminController::class, 'changeHideField'])->name('changeHideField');
        Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::put('/put/{id}', [AdminController::class, 'update'])->name('update');
        Route::get('/delete_photo/{id}', [AdminController::class, 'deletePhoto'])->name('deletePhoto');
    });
});

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
