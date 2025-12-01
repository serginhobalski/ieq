<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'leader_id'];

    // Quem é o líder geral
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // Quem são os voluntários cadastrados neste ministério
    public function members()
    {
        return $this->belongsToMany(User::class, 'department_user');
    }

    
}
