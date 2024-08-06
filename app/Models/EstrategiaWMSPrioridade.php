<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstrategiaWMSPrioridade extends Model
{
    use HasFactory;

    protected $table = 'tb_estrategia_wms_horario_prioridade';
    protected $primaryKey = 'cd_estrategia_wms_horario_prioridade';
    public $timestamps = false;

    public function estrategiaWMS(): BelongsTo
    {
        return $this->belongsTo(EstrategiaWMS::class, 'cd_estrategia_wms');
    }
}
