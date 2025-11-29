<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega os eventos ordenados pela data mais próxima, 10 por página
        $events = Event::orderBy('start_at', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Upload da imagem
        if ($request->hasFile('banner')) {
            $data['banner_path'] = $request->file('banner')->store('events', 'public');
        }

        $data['is_published'] = $request->has('is_published');

        Event::create($data);

        return redirect()->route('admin.events.index')->with('success', 'Evento criado com sucesso!');
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
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            // Apaga a imagem antiga se existir
            if ($event->banner_path) {
                Storage::disk('public')->delete($event->banner_path);
            }
            $data['banner_path'] = $request->file('banner')->store('events', 'public');
        }

        $data['is_published'] = $request->has('is_published');

        $event = Event::findOrFail($id);
        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Evento atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
