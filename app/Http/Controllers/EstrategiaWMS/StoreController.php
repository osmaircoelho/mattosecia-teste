<?php

namespace App\Http\Controllers\EstrategiaWMS;

use App\Http\Controllers\Controller;
use App\Models\EstrategiaWMS;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    /**
     * Lidar com a solicitação recebida.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->all();

        DB::beginTransaction();

        try {
            $estrategia = $this->createEstrategia($data);
            $this->createHorarios($estrategia, $data['horarios']);

            DB::commit();

            return response()->json(['message' => 'Estrategia WMS criada com sucesso!'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Erro ao criar Estrategia WMS', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Cria uma nova EstrategiaWMS.
     *
     * @param array $data
     * @return EstrategiaWMS
     */
    private function createEstrategia(array $data): EstrategiaWMS
    {
        return EstrategiaWMS::create([
            'ds_estrategia_wms' => $data['dsEstrategia'],
            'nr_prioridade'     => $data['nrPrioridade'],
            'dt_registro'       => now(),
        ]);
    }

    /**
     * Crie HorariosPrioridade para a EstratégiaWMS fornecida.
     *
     * @param EstrategiaWMS $estrategia
     * @param array $horarios
     * @return void
     */
    private function createHorarios(EstrategiaWMS $estrategia, array $horarios): void
    {
        foreach ($horarios as $horario) {
            $estrategia->horariosPrioridade()->create([
                'ds_horario_inicio' => $horario['dsHorarioInicio'],
                'ds_horario_final'  => $horario['dsHorarioFinal'],
                'nr_prioridade'     => $horario['nrPrioridade'],
                'dt_registro'       => now(),
                'dt_modificado'     => now(),
            ]);
        }
    }
}
