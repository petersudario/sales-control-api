<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Venda extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'vendas';

    protected $fillable = [
        'vendedor_id',
        'is_roaming',
        'valor',
    ];
}
