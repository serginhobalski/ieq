<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        // Carregamos os departamentos
        $departments = Department::with('leader')->with('members')->get();
        
        // Carregamos TODOS os usuários para popular o select da modal
        // Idealmente, filtramos apenas quem ainda não é membro no front ou backend, 
        // mas para simplificar aqui, vamos mandar todos.
        $users = User::orderBy('name')->get(); 

        return view('admin.departments.index', compact('departments', 'users'));
    }

    // ... (Métodos create, store e edit são padrão CRUD, vou pular para economizar espaço) ...
    // Se precisar deles detalhados, me avise! Focarei na lógica de membros abaixo:

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:departments',
            'description' => 'nullable|string',
            'slug' => 'nullable|string',
        ]);

        // Gerar slug se não fornecido
        // $validated['slug'] = $validated['slug'] ?? \Str::slug($validated['name']);
        $validated['slug'] = $validated['slug'] ?? \Str::slug($validated['name']);
        
        Department::create($validated);
        
        return redirect()->back()->with('success', 'Departamento criado com sucesso!');

    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:departments,name,' . $department->id, // ✅ Corrigido
            'description' => 'nullable|string',
            'slug' => 'required|string',
            'leader_id' => 'nullable|string',
        ]);

        $department->update($validated); // ✅ Usa a instância injetada
        
        return redirect()->back()->with('success', 'Departamento atualizado com sucesso!'); // ✅ Mensagem corrigida
    }

    // Exibe a tela de gerenciar membros de um departamento específico
    public function members(Department $department)
    {
        // Carrega quem já é membro
        $department->load('members');
        
        // Carrega usuários que NÃO são membros ainda (para o select)
        $users = User::whereDoesntHave('departments', function($q) use ($department){
            $q->where('id', $department->id);
        })->orderBy('name')->get();

        return view('admin.departments.members', compact('department', 'users'));
    }

    // Salva o novo membro no departamento
    public function addMember(Request $request, Department $department)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        
        // Attach adiciona na tabela pivô
        $department->members()->attach($request->user_id);

        return back()->with('success', 'Voluntário adicionado à equipe!');
    }

    // Remove membro
    public function removeMember(Department $department, User $user)
    {
        $department->members()->detach($user->id);
        return back()->with('success', 'Voluntário removido da equipe.');
    }
}