<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    protected $table = "radios";
    public $incrementing = true;

    protected $fillable = [
        'nome',
        'ip',
        'modelo',
        'ssid',
        'direcao',
        'frequencia',
        'canal',
        'senhawifi',
        'login',
        'senhaacesso',
        'ptp_id',
        'status'
    ];

    public function ptp()
    {
        return $this->belongsTo(Ptp::class);
    }


public function getStatusAttribute()
{
    $cacheKey = "radio_status_{$this->id}";

    if (!Cache::has($cacheKey)) {
        return 'nao_monitorado';
    }

    $status = Cache::get($cacheKey);

    return in_array($status, ['online', 'offline']) ? $status : 'nao_monitorado';
}


}
