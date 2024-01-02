<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearancePoint extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'date_cleared' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'unit_id',
        'date_cleared',
        'cleared_by',
        'status',
        'comment'
    ];
}
