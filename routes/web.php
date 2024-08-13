<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');

Route::post('/images/upload', [ImageController::class, 'upload'])->name('images.upload');

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name('register');

Route::get('/', function () {
    return Inertia::render('Welcome');
});



Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');


Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');


    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // ... otras rutas ...

    // Ruta para mostrar los detalles de un equipo
    Route::get('/teams/{team}', function ($team) {
        // Aquí puedes devolver una vista o realizar alguna lógica
    })->name('teams.show');

    // Ruta para crear un nuevo equipo
    Route::get('/teams/create', function () {
        return Inertia::render('Auth/Register');
    })->name('teams.create');
});
