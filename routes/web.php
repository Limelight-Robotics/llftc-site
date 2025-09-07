<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeamController;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('entries', EntryController::class)->except(['index']);
    
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
});

// Allow public access to entries index and show
Route::get('/entries', [EntryController::class, 'index'])->name('entries.index');
Route::get('/entries/{entry}', [EntryController::class, 'show'])->name('entries.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    
    Route::resource('admin/teams', TeamController::class)->names([
        'index' => 'admin.teams.index',
        'create' => 'admin.teams.create',
        'store' => 'admin.teams.store',
        'show' => 'admin.teams.show',
        'edit' => 'admin.teams.edit',
        'update' => 'admin.teams.update',
        'destroy' => 'admin.teams.destroy',
    ]);
});

require __DIR__.'/auth.php';
