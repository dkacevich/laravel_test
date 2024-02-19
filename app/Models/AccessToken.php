<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'payload',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];
}
