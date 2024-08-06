<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaWMSPrioridade extends Model
{
    use HasFactory;

    protected $table = 'tb_estrategia_wms_horario_prioridade';
    protected $primaryKey = 'cd_estrategia_wms_horario_prioridade';
    public $timestamps = false;
}
