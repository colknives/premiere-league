<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

    protected $table = 'players';

    protected $fillable = [
        'player_id',
        'first_name',
        'second_name',
        'form',
        'total_points',
        'web_name',
        'photo',
        'statistics'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'statistics' => 'array',
    ];
}