<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'room'];

    // Precisamos saber quem mandou a mensagem
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}