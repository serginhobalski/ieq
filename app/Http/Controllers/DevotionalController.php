<?php

namespace App\Http\Controllers;

use App\Models\Devotional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DevotionalController extends Controller
{
    // --- ÁREA PÚBLICA (LEITURA) ---

    public function index(Request $request)
    {

        $devotionals = Devotional::with('author')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('devotionals.index', compact('devotionals'));
    }

    public function show(Devotional $devotional)
    {
        return view('devotionals.show', compact('devotional'));
    }

    // --- ÁREA ADMINISTRATIVA (GESTÃO) ---
    // Apenas Pastores e Admins deveriam acessar aqui, controlaremos na rota/view

    public function create()
    {
        return view('devotionals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'cover' => 'nullable|image|max:2048'
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('devotionals', 'public');
        }

        Devotional::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . uniqid(), // Garante slug único
            'content' => $data['content'],
            'published_at' => $data['published_at'],
            'cover_path' => $coverPath,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('devotionals.index')->with('success', 'Devocional publicado!');
    }

    public function destroy(Devotional $devotional)
    {
        if(Auth::user()->is_admin || Auth::id() == $devotional->user_id) {
            if($devotional->cover_path) Storage::disk('public')->delete($devotional->cover_path);
            $devotional->delete();
            return redirect('devotionals.index')->with('success', 'Removido com sucesso.');
        }
        return back()->with('error', 'Sem permissão.');
    }
}