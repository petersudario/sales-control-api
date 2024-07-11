<?php

namespace Database\Seeders;

use App\Models\Diretoria;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Venda;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendasSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Venda::create([
            'vendedor_id' => rand(15, 64),
            'is_roaming' => false,
            'valor' => mt_rand(100, 1000.00),
        ]);
        
    }
}