<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Venda;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class VendasController extends Controller
{
    public function index() {

        $vendas = $this->getSales();

        return Inertia::render('Vendas/Index', ['sales' => $vendas]);
    }


    public function getSales(){

        $vendas = Venda::all();

        $response = [];

        foreach ($vendas as $venda) {
            $saleInfo = DB::table('users')
            ->join('diretoria', 'users.diretoria_id', '=', 'diretoria.id')
            ->join('unidade', 'users.unidade_id', '=', 'unidade.id')
            ->where('users.id', $venda->vendedor_id)
            ->select(
                DB::raw('users.id as user_id'),
                DB::raw('users.diretoria_id as diretoria_id'),
                DB::raw('users.gerente_id as gerente_id'),
                DB::raw('users.name as username'),
                DB::raw('diretoria.diretoria as diretoria'),
                DB::raw('unidade.unidade as unidade'),
                DB::raw('unidade.latitude as latitude'),
                DB::raw('unidade.longitude as longitude')
            )
            ->get();

            $saleInfo = $saleInfo[0];

            $saleInfo->valor = $venda->valor;
            $saleInfo->is_roaming = $venda->is_roaming;
            $saleInfo->created_at = Carbon::parse($venda->created_at)->format('d/m/Y H:i:s');

            $response[] = $saleInfo;
        
        }

        return response()->json($response);

    }

}