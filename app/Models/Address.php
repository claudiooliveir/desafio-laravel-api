<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Address extends Model
{
    protected $fillable = [ // ← FALTAVA
        'street', 'number', 'neighborhood', 'city', 'state', 'zip_code',
    ];
     protected $hidden = ['created_at', 'update_at', 'pivot'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
