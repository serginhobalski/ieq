<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Traz os grupos com o nome do líder (Eager Loading para performance)
        $groups = Group::with('leader', 'members')->get();
        $users = User::with('groups')->get();
        return view('admin.groups.index', compact('groups', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Busca apenas usuários aptos a liderar para o <select>
        // Ajuste conforme os 'roles' que você definiu no passo anterior
        // $leaders = User::whereIn('role', ['leader', 'pastor', 'admin'])->get();
        $leaders = User::all();
        
        return view('admin.groups.create', compact('leaders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'leader_id' => 'required|exists:users,id',
            'address' => 'nullable|string',
            'meeting_day' => 'required|string', // Ex: 'Segunda-feira'
            'meeting_time' => 'required', // Formato H:i
        ]);

        Group::create($data);

        return redirect()->route('admin.groups.index')->with('success', 'Grupo de comunhão criado!');
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
        // $leaders = User::whereIn('role', ['leader', 'pastor', 'admin'])->get();
        $leaders = User::all();
        $group = Group::findOrFail($id);
        return view('admin.groups.edit', compact('group', 'leaders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'leader_id' => 'required|exists:users,id',
            'address' => 'nullable|string',
            'meeting_day' => 'required|string',
            'meeting_time' => 'required',
        ]);

        $group = Group::findOrFail($id);
        $group->update($data);

        return redirect()->route('admin.groups.index')->with('success', 'Grupo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect()->route('admin.groups.index')->with('success', 'Grupo removido.');
    }
}
