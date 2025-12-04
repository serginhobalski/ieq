<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Devotional extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'cover_path', 'published_at', 'user_id'
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    // Relacionamento com Autor
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Acessor para URL da Imagem
    public function getCoverUrlAttribute()
    {
        if ($this->cover_path) {
            return asset('storage/' . $this->cover_path);
        }
        // Imagem genérica bonita se não tiver capa
        return 'https://source.unsplash.com/random/800x400/?bible,church,sky&sig=' . $this->id;
    }
}