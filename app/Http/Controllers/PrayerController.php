<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrayerController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Lógica de Visualização:
        // 1. Se for Admin/Pastor: Vê TUDO.
        // 2. Se for membro: Vê os Públicos + Os seus próprios (mesmo que privados).
        
        $query = PrayerRequest::with('user')->withCount('intercessors')->latest();

        if (!$user->is_admin && $user->role !== 'pastor') {
            $query->where(function($q) use ($user) {
                $q->where('is_public', true)
                  ->orWhere('user_id', $user->id);
            });
        }

        $prayers = $query->paginate(10);

        return view('home.pray', compact('prayers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'request' => 'required|string|max:1000',
        ]);

        PrayerRequest::create([
            'user_id' => Auth::id(),
            'request' => $data['request'],
            'is_public' => $request->has('is_public'),     // Checkbox
            'is_anonymous' => $request->has('is_anonymous'), // Checkbox
        ]);

        return back()->with('success', 'Seu pedido de oração foi postado.');
    }

    public function destroy(PrayerRequest $prayer)
    {
        // Só pode apagar se for dono OU admin/pastor
        if (Auth::id() !== $prayer->user_id && !Auth::user()->is_admin) {
            return back()->with('error', 'Sem permissão.');
        }

        $prayer->delete();
        return back()->with('success', 'Pedido removido.');
    }

    // Ação do botão "Eu Orei"
    public function togglePrayer(PrayerRequest $prayer)
    {
        $user = Auth::user();

        // O toggle adiciona se não existe, remove se existe
        $prayer->intercessors()->toggle($user->id);

        return back()->with('success', 'Sua intercessão foi registrada!');
    }
}