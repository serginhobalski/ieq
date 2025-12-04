<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'expires_at', 'target_audience', 'author_id'
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Escopo para filtrar apenas avisos ativos (não expirados)
    public function scopeActive($query)
    {
        return $query->whereDate('expires_at', '>=', now())
                     ->orWhereNull('expires_at');
    }
}