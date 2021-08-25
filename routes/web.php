<?php

use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DonaturController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Models\Campaign;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

//group route with prefix "admin" localhost/admin/user-admin
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::resource('/category', CategoryController::class, ['as' => 'admin']);
        Route::resource('/campaign', CampaignController::class, ['as' => 'admin']);
        Route::get('/donatur', [DonaturController::class, 'index'])->name('admin.donatur.index');
        Route::get('/donation', [DonationController::class, 'index'])->name('admin.donation.index');
        Route::get('/donation/filter', [DonationController::class, 'filter'])->name('admin.donation.firter');
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::resource('/slider', SliderController::class, ['except' => ['show', 'create', 'edit', 'update'], 'as' => 'admin']);
    });
});

Route::fallback(function () {
    return view('layouts.error-404');
});
