<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaWMS extends Model
{
    use HasFactory;

    protected $table = 'tb_estrategia_wms';

    protected $primaryKey = 'cd_estrategia_wms';

    public $timestamps = false;

    public function horariosPrioridade()
    {
        return $this->hasMany(EstrategiaWMSPrioridade::class, 'cd_estrategia_wms');
    }
}
