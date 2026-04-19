<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Profile extends Model // ← era "Profiles" (remover o 's')
{
    protected $fillable = ['name']; // ← FALTAVA
    protected $hidden = ['created_at', 'update_at',];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
