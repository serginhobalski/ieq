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


// --- ÁREA ADMINISTRATIVA (Protegida) ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Rotas do Calendário
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/feed', [CalendarController::class, 'events'])->name('calendar.feed');

    // Dashboard principal do Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Aqui entrarão as rotas dos seus módulos depois
    Route::resource('events', EventController::class);
    Route::resource('members', MemberController::class);
    
});