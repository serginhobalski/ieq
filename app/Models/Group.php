<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leader_id',
        'address',
        'meeting_day',
        'meeting_time',
    ];

    // Relacionamento: O grupo tem um líder (User)
    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    // Relacionamento: O grupo tem vários membros (Muitos-para-Muitos)
    // Usaremos isso mais tarde para adicionar pessoas ao grupo
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_users')
                    ->withPivot('is_co_leader')
                    ->withTimestamps();
    }

    
}
