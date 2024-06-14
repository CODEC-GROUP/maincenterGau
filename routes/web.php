<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeContronllers::class,'home'])->name('home');


    Route::get('/logout', [\App\Http\Controllers\HomeContronllers::class,'logout'])->name('logout');

    Route::get('/subscriptions/liste', [\App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions/liste', [\App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscriptions.index');
    Route::get('/subscriptions/{id}/edit', [\App\Http\Controllers\SubscriptionController::class, 'edit'])->whereNumber('id')->name('subscriptions.edit');
    Route::post('/subscriptions/{id}/edit', [\App\Http\Controllers\SubscriptionController::class, 'update'])->whereNumber('id')->name('subscriptions.edit');
    Route::get('/subscriptions/delete/{id}', [\App\Http\Controllers\SubscriptionController::class, 'destroy'])->whereNumber('id')->name('subscriptions.destroy');


    Route::get('/subscriptions/make/{id}', [\App\Http\Controllers\SubscriptionController::class, 'makeSubscription'])->whereNumber('id')->name('subscriptions.make');
    Route::post('/subscriptions/make', [\App\Http\Controllers\SubscriptionController::class, 'storeSubscription'])->name('subscriptions.store');
    Route::get('/subscriptions/{id}/changeU', [\App\Http\Controllers\SubscriptionController::class, 'editForm'])->whereNumber('id')->name('subscriptions.changeU');
    Route::post('/subscriptions/{id}/changeU', [\App\Http\Controllers\SubscriptionController::class, 'updateForm'])->whereNumber('id')->name('subscriptions.changeU');

    Route::get('/subscriptions/cancel/{id}', [\App\Http\Controllers\Subscription_usersContronllers::class, 'cancelSubscription'])->whereNumber('id')->name('subscriptions.cancel');
    Route::get('/subscriptions/{id}/change', [\App\Http\Controllers\Subscription_usersContronllers::class, 'edit'])->whereNumber('id')->name('subscriptions.change');
    Route::post('/subscriptions/{id}/change', [\App\Http\Controllers\Subscription_usersContronllers::class, 'update'])->whereNumber('id')->name('subscriptions.change');

    Route::get('/subscriptions_user/liste', [\App\Http\Controllers\Subscription_usersContronllers::class, 'show'])->name('subscriptions.show');
    Route::post('/subscriptions_user/liste', [\App\Http\Controllers\Subscription_usersContronllers::class, 'store'])->name('subscriptions.show');
});

    Route::get('/login', [\App\Http\Controllers\AuthContronllers::class,'showFormLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthContronllers::class,'login'])->name('login');

    Route::get('/register', [\App\Http\Controllers\AuthContronllers::class,'showFormResgiter'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthContronllers::class,'register'])->name('register');

    Route::fallback(function () { return redirect('/'); });
