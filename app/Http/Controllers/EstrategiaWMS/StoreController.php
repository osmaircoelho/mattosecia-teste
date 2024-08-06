<?php

namespace App\Http\Controllers\EstrategiaWMS;

use App\Http\Controllers\Controller;
use App\Models\EstrategiaWMS;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function __invoke(Request $request)
    {

        $data = $request->all();


        $estrategia = EstrategiaWMS::create([
           'ds_estrategia_wms' => $data['dsEstrategia'],
           'nr_prioridade' => $data['nrPrioridade'],
           'dt_registro' => now(),
        ]);

        foreach($data['horarios'] as $horario) {
            //

        }

    }

}
