<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MemberController;

Route::get('/', function () {
    return view('home.index'); // Página inicial pública
});

Auth::routes();


// Rota dos Membros (Padrão do Laravel UI)
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/chat', [ChatMessageController::class, 'index'])->name('chat');
Route::get('/calendar/feed', [HomeController::class, 'events'])->name('calendar.feed');


// --- ÁREA ADMINISTRATIVA (Protegida) ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Rotas do Calendário
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/feed', [CalendarController::class, 'events'])->name('calendar.feed');

    // Dashboard principal do Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Gestão de Grupos de Comunhão
    Route::resource('groups', \App\Http\Controllers\Admin\GroupController::class);

    // Gestão de Membros
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['create', 'store', 'show']);
    
    // Aqui entrarão as rotas dos seus módulos depois
    Route::resource('events', EventController::class);
    Route::resource('members', MemberController::class);

    // Departamentos (Básico)
    Route::resource('departments', \App\Http\Controllers\Admin\DepartmentController::class);

    // Gestão de Membros do Departamento (Rotas customizadas)
    Route::get('departments/{department}/members', 
        [\App\Http\Controllers\Admin\DepartmentController::class, 'members'])->name('departments.members');
    Route::post('departments/{department}/members', 
        [\App\Http\Controllers\Admin\DepartmentController::class, 'addMember'])->name('departments.addMember');
    Route::delete('departments/{department}/members/{user}',
        [\App\Http\Controllers\Admin\DepartmentController::class, 'removeMember'])->name('departments.removeMember');

    // Escalas
    Route::get('scales', [\App\Http\Controllers\Admin\ScaleController::class, 'index'])
        ->name('scales.index');
    Route::get('scales/{event}', [\App\Http\Controllers\Admin\ScaleController::class, 'edit'])
        ->name('scales.edit');
    Route::post('scales/{event}', [\App\Http\Controllers\Admin\ScaleController::class, 'store'])
        ->name('scales.store');
    Route::delete('scales/{id}', [\App\Http\Controllers\Admin\ScaleController::class, 'destroy'])
        ->name('scales.destroy');
    
});