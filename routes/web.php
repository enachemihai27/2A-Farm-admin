<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MapDataController;
use App\Http\Controllers\NumberController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

function registerResourceRoutes($prefix, $controller, $name): void
{
    Route::middleware('auth')->prefix($prefix)->as("$name.")->group(function () use ($controller) {
        Route::get('/private', [$controller, 'privateIndex'])->name('privateIndex');
        Route::get('/create', [$controller, 'create'])->name('create');
        Route::post('/', [$controller, 'store'])->name('store');
        Route::get('/{id}/edit', [$controller, 'edit'])->name('edit');
        Route::put('/{id}', [$controller, 'update'])->name('update');
        Route::delete('/{id}', [$controller, 'destroy'])->name('destroy');
    });
}

/*Client Routes*/
Route::get('client', [ClientController::class, 'index'])->name('client.index');
Route::middleware('auth')->prefix('client')->as('client.')->group(function () {
    Route::get('/private', [ClientController::class, 'privateIndex'])->name('privateIndex');
    Route::post('/', [ClientController::class, 'store'])->name('store');
    Route::get('/{client}/edit', [ClientController::class, 'edit'])->name('edit');
    Route::put('/{client}', [ClientController::class, 'update'])->name('update');
});

// Events Routes
registerResourceRoutes('events', EventController::class, 'events');
Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{event}/show', [EventController::class, 'show'])->name('events.show');

// Numbers Routes
registerResourceRoutes('numbers', NumberController::class, 'numbers');
Route::get('numbers', [NumberController::class, 'index'])->name('numbers.index');

// Jobs Routes
registerResourceRoutes('jobs', JobController::class, 'jobs');
Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');

// Email
Route::post('email/send', [MailController::class, 'sendEmail'])->name('email.send');

// Map data
Route::get('map/data', [MapDataController::class, 'index'])->name('map.data.index');
Route::get('map/data/{id}/show', [MapDataController::class, 'show'])->name('map.data.show');

// Persons map data
Route::get('map/persons', [PersonController::class, 'index'])->name('map.persons.index');










