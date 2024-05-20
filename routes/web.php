<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Dashboard\Menu;
use App\Livewire\Dashboard\OrderConfirmation;
use App\Livewire\Dashboard\OrderHistory;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Orders;

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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('orders', Orders::class)
            ->name('admin.orders');
    });

Route::prefix('dashboard')
    ->middleware('auth')
    ->group(function () {
        Route::get('menu', Menu::class)
            ->name('dashboard.menu');

        Route::get('order/{uuid}', OrderConfirmation::class)
            ->name('dashboard.order-confirmation');

        Route::get('order-history', OrderHistory::class)
            ->name('dashboard.order-history');
    });

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
