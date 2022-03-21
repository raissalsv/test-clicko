<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Resources\Estadisticas as Estadisticas;

use Illuminate\Support\Facades\DB;

class EstadisticasController extends BaseController
{

    public function index()
    {
        $report =  DB::table('contactos')
                ->selectRaw("SUBSTRING_INDEX(email,'@',-1) as dominio, count(id) as cantidad ")
                ->groupBy(DB::raw("SUBSTRING_INDEX(email,'@',-1)"))
                ->orderByRaw('count(id) DESC')
                ->limit(3)
                ->get();

        return $this->sendResponse(Estadisticas::collection($report), 'Lista de los 3 domínios mas usados');
    
    }
}
