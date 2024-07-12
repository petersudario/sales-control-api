<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VendasController extends Controller
{
    public function index()
    {
        $vendas = $this->getSales();
        return Inertia::render('Vendas/Index', ['sales' => $vendas]);
    }

    public function create()
    {
        return Inertia::render('Vendas/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'valor' => 'required|min:1',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        Venda::create([
            'vendedor_id' => $request->vendedor_id,
            'valor' => $request->valor,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('vendas.index');
    }

    public function getAllDiretorias()
    {
        $diretorias = DB::table('diretoria')->get();
        return response()->json($diretorias, 200);
    }

    public function filterUnidades($diretoria_id)
    {
        $unidades = DB::table('unidade')->where('diretoria_id', $diretoria_id)->get();
        return response()->json($unidades);
    }

    public function filterVendedores($unidade_id)
    {
        $vendedores = DB::table('users')->where('cargo', 'Vendedor')->where('unidade_id', $unidade_id)->get();
        return response()->json($vendedores);
    }

    public function searchNearbyUnidades($latitude, $longitude, $unidade_id)
    {
        $unidades = Unidade::all();

        $closestUnidade = null;
        $minDistance = INF;

        foreach ($unidades as $unidade) {
            if ($unidade->id === $unidade_id) {
                continue;
            }

            $distance = $this->getDistanceBetweenPoints(
                $latitude,
                $longitude,
                $unidade->latitude,
                $unidade->longitude
            );

            if ($distance < $minDistance) {
                $closestUnidade = $unidade;
                $minDistance = $distance;
            }
        }

        return $closestUnidade;
    }


    public function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371;

        $latFrom = deg2rad($latitude1);
        $lonFrom = deg2rad($longitude1);
        $latTo = deg2rad($latitude2);
        $lonTo = deg2rad($longitude2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }

    public function isRoaming($latitude, $longitude, $unidadeLatitude, $unidadeLongitude, $threshold = 0.5)
    {
        $distance = $this->getDistanceBetweenPoints($latitude, $longitude, $unidadeLatitude, $unidadeLongitude);
        return $distance > $threshold;
    }

    public function getSalesFiltered($diretoria_id, $unidade_id, $vendedor_id, $date)
    {
        $vendas = Venda::all();

        $response = [];

        if ($diretoria_id != 0 && $diretoria_id != null) {
            $vendas = $vendas->filter(function ($venda) use ($diretoria_id) {
                $vendedor = DB::table('users')->where('id', $venda->vendedor_id)->first();
                $unidade = DB::table('unidade')->where('id', $vendedor->unidade_id)->first();
                return $unidade->diretoria_id == $diretoria_id;
            });
        }

        if ($unidade_id != 0 && $unidade_id != null) {
            $vendas = $vendas->filter(function ($venda) use ($unidade_id) {
                $vendedor = DB::table('users')->where('id', $venda->vendedor_id)->first();
                return $vendedor->unidade_id == $unidade_id;
            });
        }

        if ($vendedor_id != 0 && $vendedor_id != null) {
            $vendas = $vendas->filter(function ($venda) use ($vendedor_id) {
                return $venda->vendedor_id == $vendedor_id;
            });
        }

        if ($date != 0 && $date != null && $date != "") {
            $vendas = $vendas->filter(function ($venda) use ($date) {
                return Carbon::parse($venda->created_at)->format('Y-m-d') == $date;
            });
        }

        foreach ($vendas as $venda) {
            $saleInfo = DB::table('users')
                ->join('diretoria', 'users.diretoria_id', '=', 'diretoria.id')
                ->join('unidade', 'users.unidade_id', '=', 'unidade.id')
                ->where('users.id', $venda->vendedor_id)
                ->select(
                    DB::raw('users.id as user_id'),
                    DB::raw('users.unidade_id as unidade_id'),
                    DB::raw('users.diretoria_id as diretoria_id'),
                    DB::raw('users.gerente_id as gerente_id'),
                    DB::raw('unidade.unidade as unidade'),
                    DB::raw('users.name as username'),
                    DB::raw('diretoria.diretoria as diretoria'),
                    DB::raw('unidade.latitude as unidade_latitude'),
                    DB::raw('unidade.longitude as unidade_longitude'),
                )
                ->get();

            $saleInfo = $saleInfo[0];

            $saleInfo->valor = $venda->valor;
            $saleInfo->latitude = $venda->latitude;
            $saleInfo->longitude = $venda->longitude;
            $closestUnidade = $this->searchNearbyUnidades($venda->latitude, $venda->longitude, $saleInfo->unidade_id);
            $saleInfo->closest_unidade = $closestUnidade ? $closestUnidade->unidade : null;
            $saleInfo->created_at = Carbon::parse($venda->created_at)->format('d/m/Y H:i:s');

            $saleInfo->is_roaming = $this->isRoaming(
                $venda->latitude, 
                $venda->longitude, 
                $saleInfo->unidade_latitude, 
                $saleInfo->unidade_longitude
            );

            $response[] = $saleInfo;

        }

        return response()->json($response);
    }


    public function getSales()
    {
        $vendas = Venda::all();
    
        $response = [];
    
        foreach ($vendas as $venda) {
            $saleInfo = DB::table('users')
                ->join('diretoria', 'users.diretoria_id', '=', 'diretoria.id')
                ->join('unidade', 'users.unidade_id', '=', 'unidade.id')
                ->where('users.id', $venda->vendedor_id)
                ->select(
                    DB::raw('users.id as user_id'),
                    DB::raw('users.unidade_id as unidade_id'),
                    DB::raw('users.diretoria_id as diretoria_id'),
                    DB::raw('users.gerente_id as gerente_id'),
                    DB::raw('unidade.unidade as unidade'),
                    DB::raw('users.name as username'),
                    DB::raw('diretoria.diretoria as diretoria'),
                    DB::raw('unidade.latitude as unidade_latitude'),
                    DB::raw('unidade.longitude as unidade_longitude'),
                )
                ->get();
    
            $saleInfo = $saleInfo[0];
    
            $saleInfo->valor = $venda->valor;
            $saleInfo->latitude = $venda->latitude;
            $saleInfo->longitude = $venda->longitude;
            $closestUnidade = $this->searchNearbyUnidades($venda->latitude, $venda->longitude, $saleInfo->unidade_id);
            $saleInfo->closest_unidade = $closestUnidade ? $closestUnidade->unidade : null;
    
            $saleInfo->is_roaming = $this->isRoaming(
                $venda->latitude, 
                $venda->longitude, 
                $saleInfo->unidade_latitude, 
                $saleInfo->unidade_longitude
            );
            
            $saleInfo->created_at = Carbon::parse($venda->created_at)->format('d/m/Y H:i:s');
    
            $response[] = $saleInfo;
        }
    
        return response()->json($response);
    }
    


}