<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MapController extends Controller
{

    public function index()
    {
        $sales = $this->getTotalSales();
        return Inertia::render('Home', ['sales' => $sales]);
    }

    public function getTotalSales()
    {
        $unidades = Unidade::all();

        $response = [];

        foreach ($unidades as $unidade) {
            $totalSales = DB::table('vendas')
                ->join('users', 'vendas.vendedor_id', '=', 'users.id')
                ->where('users.cargo', 'Vendedor')
                ->where('users.unidade_id', $unidade->id)
                ->sum('vendas.valor');

            $totalSales = number_format($totalSales, 2, ',', '.');

            $response[] = [
                'unidade' => $unidade->unidade,
                'total_sales' => $totalSales,
                'latitude' => $unidade->latitude,
                'longitude' => $unidade->longitude,
            ];
        }

        return response()->json($response);
    }

}