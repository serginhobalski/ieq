<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Adicionamos uma busca simples por nome ou email
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Paginação de 15 por página, ordenado pelos mais novos
        $users = $query->orderBy('name', 'asc')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'string', 'max:255'],
            'is_admin' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $avatarPath = null;

        // Verifica se a imagem foi enviada no array $data
        if (isset($data['avatar'])) {
            // Salva na pasta 'storage/app/public/avatars' e retorna o caminho
            $avatarPath = $data['avatar']->store('avatars', 'public');
        }

        User::create([
            'name' => $data['name'],
            'username' => $data['username'], // Novo campo
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar_path' => $avatarPath, // Salva o caminho (ex: avatars/nome-do-arquivo.jpg)
            'phone' => $data['phone'] ?? null,     // Caso você adicione o input depois
            'address' => $data['address'] ?? null, // Caso você adicione o input depois
            'birth_date' => $data['birth_date'] ?? null,
            'is_admin' => false, // Padrão
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Membro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            // Validamos o papel (role) se você criou essa coluna na primeira migration
            // Caso não tenha criado a coluna 'role', remova essa linha ou crie a migration agora.
            'role' => 'nullable|string', 
        ]);

        // Atualiza senha apenas se for preenchida
        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8']);
            $data['password'] = Hash::make($request->password);
        }

        // Checkbox de Admin (se não vier no request, é false)
        $user->is_admin = $request->has('is_admin');
        
        // Se tiver o campo role (ex: pastor, lider, membro)
        if($request->has('role')) {
            $user->role = $request->role;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Dados do membro atualizados!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Evita que o admin se auto-delete
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Você não pode excluir sua própria conta.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Membro removido do sistema.');
    }
}
