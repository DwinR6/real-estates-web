<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // ... otras rutas ...

    // Ruta para mostrar los detalles de un equipo
    Route::get('/teams/{team}', function ($team) {
        // Aquí puedes devolver una vista o realizar alguna lógica
    })->name('teams.show');

    // Ruta para crear un nuevo equipo
    Route::get('/teams/create', function () {
        // Aquí puedes devolver una vista o realizar alguna lógica
    })->name('teams.create');
});
