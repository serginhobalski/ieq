<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // Importante: Now para ser instantâneo
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    // Recebe a mensagem criada
    public function __construct(ChatMessage $message)
    {
        $this->message = $message;
    }

    // Define em qual canal a mensagem será transmitida
    public function broadcastOn(): array
    {
        // Canal público 'chat.NOME_DA_SALA'
        return [
            new Channel('chat.' . $this->message->room),
        ];
    }

    // Define quais dados serão enviados para o Javascript
    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'content' => $this->message->content,
            'user_name' => $this->message->user->name,
            'user_avatar' => $this->message->user->avatar_url, // Usando o acessor que criamos
            'created_at' => $this->message->created_at->format('H:i'),
            'user_id' => $this->message->user_id, // Para saber se fui eu que mandei
        ];
    }
}