<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PrayerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request',
        'is_anonymous',
        'is_public',
        'prayer_count' // Vamos manter atualizado por conveniência
    ];

    // Dono do pedido
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pessoas que clicaram em "Eu Orei"
    public function intercessors()
    {
        return $this->belongsToMany(User::class, 'prayer_interactions');
    }

    // Verifica se EU (logado) já orei por este pedido
    public function getIHavePrayedAttribute()
    {
        if (!Auth::check()) return false;
        return $this->intercessors->contains(Auth::id());
    }

    // Acessor para exibir nome (Trata Anônimo)
    public function getAuthorNameAttribute()
    {
        if ($this->is_anonymous) return 'Anônimo';
        return $this->user->name;
    }

    // Acessor para exibir avatar (Trata Anônimo)
    public function getAuthorAvatarAttribute()
    {
        if ($this->is_anonymous) {
            return 'https://ui-avatars.com/api/?name=Anônimo&background=ced4da&color=6c757d';
        }
        return $this->user->avatar_url;
    }
}