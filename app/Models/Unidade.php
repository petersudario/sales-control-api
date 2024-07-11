<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Unidade extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'unidade';

    protected $fillable = [
        'unidade',
        'latitude',
        'longitude',
        'gerente_id',
        'diretoria_id',
    ];
}
