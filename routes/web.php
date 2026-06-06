<?php

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Main;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\Joinexam;

Route::get('/', Main::class);
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/joinexam', Joinexam::class)->name('joinexam');


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', function () {
        return view('livewire.admin.main');
    })->name('admin.dashboard');    
});

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/', function () {
        return view('user.dashboard');
    })->name('user');
});


