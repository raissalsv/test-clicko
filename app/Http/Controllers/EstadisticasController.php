<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\Estadisticas as Estadisticas;

use Illuminate\Support\Facades\DB;

class EstadisticasController extends BaseController
{
    CONST QUERY_DOMINIO = "SUBSTRING_INDEX(email,'@',-1)";

    public function index()
    {
        $report =  DB::table('contactos')
                ->selectRaw(self::QUERY_DOMINIO . " as dominio, count(id) as cantidad ")
                ->groupBy(DB::raw(self::QUERY_DOMINIO))
                ->orderByRaw('count(id) DESC')
                ->limit(3)
                ->get();

        return $this->sendResponse(Estadisticas::collection($report), 'Lista de los 3 domínios mas usados');
    
    }
}
