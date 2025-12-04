<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function index()
    {
        // Pega avisos ativos, ordenados por criação
        $notices = Notice::active()
            ->with('author')
            ->latest()
            ->paginate(10);

        return view('notices.index', compact('notices'));
    }

    public function create()
    {
        // Apenas admins/líderes podem criar (proteção simples)
        if (Auth::user()->role === 'pastor' || Auth::user()->is_admin == 1) {
            return view('notices.create');
        }
        return redirect()->route('notices.index')->with('error', 'Apenas líderes podem postar avisos.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'expires_at' => 'nullable|date|after:today',
            'target_audience' => 'required|in:all,leaders,youth,kids'
        ]);

        Notice::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'expires_at' => $data['expires_at'],
            'target_audience' => $data['target_audience'],
            'author_id' => Auth::id()
        ]);

        return redirect()->route('notices.index')->with('success', 'Aviso publicado no mural!');
    }

    public function destroy(Notice $notice)
    {
        // Apenas dono ou admin apaga
        if (Auth::user()->is_admin || Auth::id() === $notice->author_id) {
            $notice->delete();
            return back()->with('success', 'Aviso removido.');
        }
        return back()->with('error', 'Sem permissão.');
    }
}