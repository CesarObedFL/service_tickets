<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [ 'problem', 'description', 'status', 'priority', 'user_id', 'asigned_to' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function asignedTo()
    {
        return $this->hasOne(User::class, 'id', 'asigned_to');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

}
