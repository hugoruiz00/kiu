<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\OAuthProviderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessQueueController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\EnsureBusinessIsCreated;
use App\Http\Middleware\EnsureIsBusinessOwner;
use Illuminate\Support\Facades\Route;

Route::get('/', [BusinessController::class, 'index'])->name('home');
Route::get('/business/{business}/welcome', [BusinessQueueController::class, 'public_active_clients'])->name('business.public_active_clients');
Route::post('/business/{business}/public-add-queue-entry', [BusinessQueueController::class, 'public_add_queue_entry'])->name('business.public_add_queue_entry');

Route::get('/business-queue/{queue_entry}', [BusinessQueueController::class, 'view_queue_entry'])->name('business.view_queue_entry');
Route::patch('/business-queue/{queue_entry}', [BusinessQueueController::class, 'cancel_queue_entry'])->name('business.cancel_queue_entry');

Route::get('/comment/create', [CommentController::class, 'create'])->name('comment.create');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Business Owner
    Route::get('/business', [BusinessController::class, 'edit'])->name('business.edit');
    Route::post('/business', [BusinessController::class, 'save'])->name('business.save');
    Route::get('/business/{business_id}/manage', [BusinessController::class, 'manage'])->name('business.manage')->middleware([EnsureBusinessIsCreated::class, EnsureIsBusinessOwner::class]);
    Route::post('/business/{business}/toggle-status', [BusinessController::class, 'toggle_status'])->name('business.toggle_status')->middleware(EnsureIsBusinessOwner::class);
    
    Route::get('/business/{business_id}/active-clients', [BusinessQueueController::class, 'active_clients'])->name('business.active_clients')->middleware(EnsureBusinessIsCreated::class, EnsureIsBusinessOwner::class);
    Route::post('/business/{business}/add-queue-entry', [BusinessQueueController::class, 'add_queue_entry'])->name('business.add_queue_entry')->middleware(EnsureIsBusinessOwner::class);
    Route::patch('/business-queue/{queue_entry}/attend-queue-entry', [BusinessQueueController::class, 'attend_queue_entry'])->name('business.attend_queue_entry')->middleware(EnsureIsBusinessOwner::class);
});

Route::middleware(['guest'])->prefix('login')->name('login')->group(function () {
    Route::get('{provider}', [OAuthProviderController::class, 'redirectToProvider'])->name('provider');
    Route::get('{provider}/callback', [OAuthProviderController::class, 'handleProviderCallback'])->name('provider.callback');
});

require __DIR__.'/auth.php';

// crear droplet
// colasvirtuales.com
// Add Not found page