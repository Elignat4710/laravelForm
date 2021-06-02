<?php

use App\Http\Controllers\Form\MemberProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function () {
    Route::get('countries', [\App\Http\Controllers\Form\CountryController::class, 'getAllCountries'])->name('countries');
    Route::post('first', [MemberProfileController::class, 'firstForm'])->name('first');
    Route::get('allprofiles', [MemberProfileController::class, 'getAllProfiles'])->name('allProfiles');
    Route::get('count', [MemberProfileController::class, 'countProfiles'])->name('count');
    Route::post('/second/{id}', [MemberProfileController::class, 'secondForm'])->name('second');
});
