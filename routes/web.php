<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AntecedenteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DetalleRecipeController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TipoAntecedenteController;
use App\Http\Controllers\TipoCitaController;

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
        $users = User::all();
        return Inertia::render('Dashboard', compact('users'));
    })->name('dashboard');

    
    /* Agrupar las rutas de los controladores con resource */
    Route::resources([
        'users' => UserController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'doctors' => DoctorController::class,
        'antecedents' => AntecedenteController::class,
        'citas' => CitaController::class,
        'pacientes' => PacienteController::class,
        'detallerecipes' => DetalleRecipeController::class,
        'evaluacions' => EvaluacionController::class,
        'historia' => HistoriaController::class,
        'informes' => InformeController::class,
        'productos' => ProductoController::class,
        'recipes' => RecipeController::class,
        'tipoantecedentes' => TipoAntecedenteController::class,
        'tipocitas' => TipoCitaController::class,
    ]);

});
