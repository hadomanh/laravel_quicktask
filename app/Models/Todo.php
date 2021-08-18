<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'content',
        'deadline',
        'status',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
