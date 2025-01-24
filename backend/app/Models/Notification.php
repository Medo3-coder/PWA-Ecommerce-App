<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'message',
        'is_read',
        'notifiable_id',
        'notifiable_type',
        'read_at',
    ];


    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function notifiable(){
        return $this->morphTo();
    }
}
