<?php

namespace App\Http\Controllers\EstrategiaWMS;

use App\Http\Controllers\Controller;
use App\Models\EstrategiaWMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{

    public function __invoke(Request $request)
    {

        $data = $request->all();

        DB::beginTransaction();

        $estrategia = EstrategiaWMS::create([
           'ds_estrategia_wms' => $data['dsEstrategia'],
           'nr_prioridade' => $data['nrPrioridade'],
           'dt_registro' => now(),
        ]);

        foreach($data['horarios'] as $horario) {
            $estrategia->horariosPrioridade()->create([
                'ds_horario_inicio' => $horario['dsHorarioInicio'],
                'ds_horario_final' => $horario['dsHorarioFinal'],
                'nr_prioridade' => $horario['nrPrioridade'],
                'dt_registro' => now(),
                'dt_modificado' => now()
            ]);

        }
        DB::commit();
        return response()->json(
            ['message' => 'Estrategia WMS Criado com sucesso!']
            , 201);

    }

}
