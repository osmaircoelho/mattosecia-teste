<?php

namespace App\Http\Controllers\EstrategiaWMS;

use App\Http\Controllers\Controller;
use App\Models\{EstrategiaWMS, EstrategiaWMSPrioridade};
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PrioridadeController extends Controller
{
    /**
     * Lidar com a solicitação recebida.
     *
     * @param int $cdEstrategia
     * @param string $dsHora
     * @param string $dsMinuto
     * @return JsonResponse
     */
    public function __invoke(int $cdEstrategia, string $dsHora, string $dsMinuto): JsonResponse
    {
        $horario = $this->formatHorario($dsHora, $dsMinuto);

        $estrategia = $this->getEstrategia($cdEstrategia);

        if (!$estrategia) {
            return response()->json(['message' => 'Estratégia WMS não encontrada'], Response::HTTP_NOT_FOUND);
        }

        $prioridade = $this->getPrioridade($cdEstrategia, $horario);

        if ($prioridade) {
            return response()->json(['prioridade' => $prioridade->nr_prioridade], Response::HTTP_OK);
        }

        return response()->json(['prioridade' => $estrategia->nr_prioridade], Response::HTTP_OK);
    }

    /**
     * Format the hour and minute into a single time string.
     *
     * @param string $dsHora
     * @param string $dsMinuto
     * @return string
     */
    private function formatHorario(string $dsHora, string $dsMinuto): string
    {
        return $dsHora . ':' . $dsMinuto;
    }

    /**
     * Recupere o modelo EstratégiaWMS por sua chave primária.
     *
     * @param int $cdEstrategia
     * @return EstrategiaWMS|null
     */
    private function getEstrategia(int $cdEstrategia): ?EstrategiaWMS
    {
        return EstrategiaWMS::find($cdEstrategia);
    }

    /**
     * Recupere o modelo EstratégiaWMSPrioridade com base no ID da estratégia e no tempo.
     *
     * @param int $cdEstrategia
     * @param string $horario
     * @return EstrategiaWMSPrioridade|null
     */
    private function getPrioridade(int $cdEstrategia, string $horario): ?EstrategiaWMSPrioridade
    {
        return EstrategiaWMSPrioridade::where('cd_estrategia_wms', $cdEstrategia)
            ->where('ds_horario_inicio', '<=', $horario)
            ->where('ds_horario_final', '>=', $horario)
            ->orderBy('nr_prioridade', 'desc')
            ->first();
    }
}
