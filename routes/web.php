<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\GroupMemberController;
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
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::put('/profile', [HomeController::class, 'profileUpdate'])->name('profile.update');
Route::get('/calendar/feed', [HomeController::class, 'feed'])->name('calendar.feed');
Route::get('/events', [HomeController::class, 'events'])->name('events');
// Route::get('/groups', [HomeController::class, 'groups'])->name('groups');
Route::get('/volunteers', [HomeController::class, 'volunteers'])->name('volunteers');
Route::get('/debq', [HomeController::class, 'debq'])->name('debq');
Route::get('/trilho', [HomeController::class, 'trilho'])->name('trilho');
// Route::get('/pray', [HomeController::class, 'pray'])->name('pray');
Route::middleware(['auth'])->group(function () {
    Route::get('/bible', [App\Http\Controllers\BibleController::class, 'index'])->name('bible.index');
    Route::resource('groups', App\Http\Controllers\GroupController::class);
    Route::resource('groups_members', App\Http\Controllers\GroupMemberController::class);
    Route::resource('courses', App\Http\Controllers\CourseController::class);
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/history', [App\Http\Controllers\ChatController::class, 'history'])->name('chat.history');
    Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/groups/{group}/join', [App\Http\Controllers\GroupMemberController::class, 'join'])->name('groups.join');
    Route::post('/groups/{group}/leave', [App\Http\Controllers\GroupMemberController::class, 'leave'])->name('groups.leave');
    Route::get('/prayers', [App\Http\Controllers\PrayerController::class, 'index'])->name('prayers.index');
    Route::post('/prayers', [App\Http\Controllers\PrayerController::class, 'store'])->name('prayers.store');
    Route::delete('/prayers/{prayer}', [App\Http\Controllers\PrayerController::class, 'destroy'])->name('prayers.destroy');
    Route::post('/prayers/{prayer}/pray', [App\Http\Controllers\PrayerController::class, 'togglePrayer'])->name('prayers.pray');
    // Listagem e Leitura
    Route::get('/devotionals', [App\Http\Controllers\DevotionalController::class, 'index'])->name('devotionals.index');
    Route::get('/devotionals/read/{devotional:slug}', [App\Http\Controllers\DevotionalController::class, 'show'])->name('devotionals.show'); // Busca pelo Slug para URL bonita
    
    // Gestão (Criar/Apagar)
    Route::get('/devotionals/create', [App\Http\Controllers\DevotionalController::class, 'create'])->name('devotionals.create');
    Route::post('/devotionals', [App\Http\Controllers\DevotionalController::class, 'store'])->name('devotionals.store');
    Route::delete('/devotionals/{devotional}', [App\Http\Controllers\DevotionalController::class, 'destroy'])->name('devotionals.destroy');
});



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
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
    
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
    
    // Rotas de Cursos
    Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);

    // Rotas específicas para adicionar/remover aulas dentro do curso
    Route::post('courses/{course}/lessons', [\App\Http\Controllers\Admin\CourseController::class, 'storeLesson'])->name('courses.lessons.store');
    Route::delete('lessons/{lesson}', [\App\Http\Controllers\Admin\CourseController::class, 'destroyLesson'])->name('lessons.destroy');
});