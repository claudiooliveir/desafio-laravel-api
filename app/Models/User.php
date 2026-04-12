<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Profile;
use App\Models\Address;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'profile_id',
        'birth_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Um usuário pertence a UM perfil
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    // Um usuário pode ter MUITOS endereços
    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }
}



