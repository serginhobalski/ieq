<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category', // 'ebd' ou 'trilho'
        'cover_image',
        'is_published'
    ];

    // Relacionamento: Um curso tem muitas lições
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->orderBy('order', 'asc');
    }
    
    // Acessor para URL da imagem (igual fizemos no User)
    public function getCoverUrlAttribute()
    {
        if ($this->cover_path) {
            return asset('storage/' . $this->cover_path);
        }
        return 'https://placehold.co/600x400/e9ecef/6c757d?text=' . urlencode($this->title);
    }
}