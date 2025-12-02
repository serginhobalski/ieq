<?php

namespace App\Http\Controllers;

use App\Models\GroupUser;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'group_id' => 'required|string',
            'is_co_leader' => 'nullable|string',
        ]);
        if (!isset($data['is_co_leader'])) {
            $data['is_co_leader'] = 0;
        } else {
            $data['is_co_leader'] = 1;
        }

        GroupUser::create($data);

        return redirect()->route('groups.index')->with('success', 'Membro adicionado ao grupo de comunhão!');
    }

    public function join(Group $group)
    {
        $user = Auth::user();

        // Verifica se já é membro para não duplicar
        if (!$group->members()->where('user_id', $user->id)->exists()) {
            // Adiciona na tabela pivô (group_user)
            $group->members()->attach($user->id, ['is_co_leader' => false]);
            
            return back()->with('success', 'Você agora participa deste grupo!');
        }

        return back()->with('info', 'Você já é membro deste grupo.');
    }

    public function leave(Group $group)
    {
        $user = Auth::user();

        // Impede que o Líder principal saia do grupo (regra de negócio opcional, mas recomendada)
        if ($group->leader_id === $user->id) {
            return back()->with('error', 'O líder não pode sair do grupo. Transfira a liderança primeiro.');
        }

        // Remove da tabela pivô
        $group->members()->detach($user->id);

        return back()->with('success', 'Você saiu do grupo.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
