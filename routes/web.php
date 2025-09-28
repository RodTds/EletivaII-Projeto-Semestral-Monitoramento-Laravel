<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\PppoeController;
use App\Http\Controllers\PtpController;
use App\Http\Controllers\RadioController;



Route::get('/', function () {
    return view('layout');
});

Route::get('/pppoe', [MikrotikController::class, 'pppoe'])->name('pppoe');

Route::get('/radio/update-status', [RadioController::class, 'updateStatus']);

Route::resource('ptp', PtpController::class);

Route::resource('/radio', RadioController::class);



//Route::get('/radio', [RadioController::class, 'index'])->name('radio.index');
//Route::get('/radio/create', [RadioController::class, 'create'])->name('radio.create');
//Route::post('/radio', [RadioController::class, 'store'])->name('radio.store');






