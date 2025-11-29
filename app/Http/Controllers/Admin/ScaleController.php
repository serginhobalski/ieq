<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Department;
use App\Models\VolunteerScale;
use Illuminate\Http\Request;

class ScaleController extends Controller
{
    // Lista os próximos eventos para serem gerenciados
    public function index()
    {
        $events = Event::where('start_at', '>=', now())
            ->orderBy('start_at')
            ->get();
            
        return view('admin.scales.index', compact('events'));
    }

    // Tela de Edição da Escala de UM evento
    public function edit(Event $event)
    {
        // Traz todos os departamentos e seus membros disponíveis
        $departments = Department::with('members')->get();
        
        // Traz a escala atual deste evento organizada por departamento
        $scales = VolunteerScale::where('event_id', $event->id)->get()->groupBy('department_id');

        return view('admin.scales.edit', compact('event', 'departments', 'scales'));
    }

    // Salvar uma nova escalação
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'department_id' => 'required',
            'user_id' => 'required',
            'role_in_event' => 'nullable|string' // Ex: "Camera 1", "Baixo"
        ]);

        VolunteerScale::create([
            'event_id' => $event->id,
            'department_id' => $request->department_id,
            'user_id' => $request->user_id,
            'role_in_event' => $request->role_in_event,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Voluntário escalado!');
    }

    public function destroy($id)
    {
        VolunteerScale::destroy($id);
        return back()->with('success', 'Removido da escala.');
    }
}