<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Event;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection; // Use se $data for um array e você quiser convertê-lo

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.dashboard');
    }

    public function events()
    {
        // Pega os eventos ordenados pela data mais próxima, 10 por página
        $events = Event::orderBy('start_at', 'desc')->paginate(10);
        return view('home.events', compact('events'));
    }

    // Retorna o JSON que o FullCalendar vai consumir via AJAX
    public function feed(Request $request)
    {
        // O FullCalendar envia automaticamente parâmetros 'start' e 'end' 
        // para carregar apenas o mês visível. Vamos filtrar para performance.
        $start = $request->get('start');
        $end = $request->get('end');

        $events = Event::where('is_published', true)
            ->whereBetween('start_at', [$start, $end]) // Filtra pela data
            ->get()
            ->map(function ($event) {
                // Mapeia as cores baseadas no tipo do evento
                $color = match ($event->type) {
                    'culto' => '#0d6efd',    // Azul
                    'ensaio' => '#ffc107',   // Amarelo
                    'evento' => '#198754',   // Verde
                    'reuniao' => '#6c757d',  // Cinza
                    default => '#3788d8',
                };

                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_at->toIso8601String(),
                    'end' => $event->end_at->toIso8601String(),
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    // Opcional: Link para editar ao clicar
                    // 'url' => route('admin.events.edit', $event->id),
                    'extendedProps' => [
                        'location' => $event->location,
                        'description' => $event->description,
                    ]
                ];
            });

        return response()->json($events);
    }

    public function groups()
    {
        // Traz os grupos com o nome do líder (Eager Loading para performance)
        $groups = Group::with('leader')->get();
        return view('home.groups', compact('groups'));
    }

    public function volunteers()
    {
        return view('home.volunteers');
    }

    public function chat()
    {
        return view('home.chat');
    }

    public function pray()
    {
        return view('home.pray');
    }

    public function debq(Request $request)
    {
        $title = 'Escola Bíblica (DEBQ)';
        // 1. Usar ->paginate(9) em vez de ->get()
        // Isso garante que apenas 9 cursos sejam carregados por vez
        $perPage = 9; // Defina quantos cursos por página você deseja
        
        $courses = Course::with('lessons')
            ->where('category', 'debq')
            ->orderBy('title', 'asc')
            ->paginate($perPage); // <-- MUDANÇA PRINCIPAL

        // O $courses agora é um objeto LengthAwarePaginator

        return view('home.debq', compact('courses', 'title'));
    }

    public function trilho()
    {
        $title = 'Trilho de Crescimento';
        // 1. Usar ->paginate(9) em vez de ->get()
        // Isso garante que apenas 9 cursos sejam carregados por vez
        $perPage = 9; // Defina quantos cursos por página você deseja
        
        $courses = Course::with('lessons')
            ->where('category', 'debq')
            ->orderBy('title', 'asc')
            ->paginate($perPage); // <-- MUDANÇA PRINCIPAL

        // O $courses agora é um objeto LengthAwarePaginator;
        return view('home.trilho', compact('courses','title'));
    }

    public function devotionals()
    {
        $title = 'Devocionais';
        return view('home.devotionals');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('home.profile', compact('user'));
    }

    /**
     * Atualiza os dados do usuário logado.
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|max:2048', // Max 2MB
            'password' => 'nullable|string|min:8|confirmed', // Senha opcional
        ]);

        // 1. Lógica de Upload de Avatar
        if ($request->hasFile('avatar')) {
            // Se já tiver avatar antigo (e não for um placeholder externo), deleta
            if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $user->avatar_path = $request->file('avatar')->store('avatars', 'public');
        }

        // 2. Atualização de Senha (se preenchida)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 3. Atualiza os outros dados
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? $user->phone;
        $user->birth_date = $data['birth_date'] ?? $user->birth_date;
        $user->address = $data['address'] ?? $user->address;
        
        $user->save();

        return back()->with('success', 'Perfil atualizado com sucesso!');
    }


}
