<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'nom',
        'numero',
        'statut',
        'statut_modifie',
        'numero_table',
    ];

    protected $casts = [
        'statut_modifie' => 'boolean',
    ];
}
