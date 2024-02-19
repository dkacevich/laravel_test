<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Storage;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'position_id'
    ];


    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }


    public function photoUrl(): string
    {
        return Storage::disk('media')->url($this->photo);
    }

}
