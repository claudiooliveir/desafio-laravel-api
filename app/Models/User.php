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
        'profile_id', // Chave estrangeira para o perfil do usuário
        'birth_date', // Data de nascimento do usuário
        'weight', // Peso do usuário
    ];

    protected $hidden = [
        'password',
        'email_verified_at', // Esconde a data de verificação do email
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



