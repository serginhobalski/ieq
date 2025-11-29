<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VolunteerScale extends Model
{
    protected $table = 'volunteer_scales'; // Força o nome se necessário
    
    protected $fillable = [
        'event_id', 'department_id', 'user_id', 'role_in_event', 'status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function event() { return $this->belongsTo(Event::class); }
    public function department() { return $this->belongsTo(Department::class); }
}
