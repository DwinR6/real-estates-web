<?php

use App\Http\Controllers\DesignController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MachinaryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



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



Route::get('/advices', function () {
    return Inertia::render('Advices');
})->name('advices');

Route::get('/documents/download/{file}', function ($file) {
    return response()->download(storage_path('app/public/documents/' . $file));
})->name('documents.download');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');



Route::get('/maquinaria', [MachinaryController::class, 'index'])->name('machinaries');

Route::get('/servicios', [ServiceController::class, 'index'])->name('services');

Route::get('/disenos', [DesignController::class, 'index'])->name('designs');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');


    Route::get('disenos/crear', [DesignController::class, 'create'])->name('designs.create');
    Route::get('/disenos/{id}/edit', [DesignController::class, 'edit'])->name('designs.edit');
    Route::post('/disenos', [DesignController::class, 'store'])->name('designs.store');
    Route::put('/disenos/{id}', [DesignController::class, 'update'])->name('designs.update');
    Route::delete('/disenos/{id}', [DesignController::class, 'destroy'])->name('designs.destroy');
    Route::post('/disenos/{id}/store-images', [DesignController::class, 'storeImages'])->name('designs.images.store');

    Route::post('/maquinaria/crear', [MachinaryController::class, 'store'])->name('machinaries.store');
    Route::get('/maquinaria/{id}/edit', [MachinaryController::class, 'edit'])->name('machinaries.edit');
    Route::put('/maquinaria/{id}', [MachinaryController::class, 'update'])->name('machinaries.update');
    Route::delete('/maquinaria/{id}', [MachinaryController::class, 'destroy'])->name('machinaries.destroy');
    Route::post('/maquinaria/{id}/store-images', [MachinaryController::class, 'storeImages'])->name('machinaries.images.store');


    Route::post('/servicios/crear', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/servicios/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/servicios/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/servicios/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::post('/servicios/{id}/store-images', [ServiceController::class, 'storeImages'])->name('services.images.store');
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

Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/disenos/{id}', [DesignController::class, 'show'])->name('designs.show');
