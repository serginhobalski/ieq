<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Exibe a tela do chat
    public function index()
    {
        $user_id = Auth::id();
        // Carrega os grupos do usuário logado
        $myGroups = Group::whereHas('members', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        
        return view('chat.index', compact('myGroups'));
    }

    // API para carregar mensagens antigas (Histórico)
    public function history(Request $request)
    {
        $room = $request->get('room', 'geral');
        
        $messages = ChatMessage::with('user')
            ->where('room', $room)
            ->latest()
            ->take(50) // Pega as últimas 50
            ->get()
            ->reverse() // Inverte para mostrar cronologicamente
            ->values();

        // Formatamos para o JS entender igual ao evento
        $formatted = $messages->map(function ($msg) {
            return [
                'id' => $msg->id,
                'content' => $msg->content,
                'user_name' => $msg->user->name,
                'user_avatar' => $msg->user->avatar_url,
                'created_at' => $msg->created_at->format('H:i'),
                'user_id' => $msg->user_id,
            ];
        });

        return response()->json($formatted);
    }

    // Salva e envia a mensagem
    public function sendMessage(Request $request)
    {
        $request->validate(['content' => 'required|string']);

        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'room' => $request->get('room', 'geral'),
        ]);

        // Dispara o evento para o Reverb
        broadcast(new MessageSent($message));

        return response()->json(['status' => 'Message Sent!']);
    }
}