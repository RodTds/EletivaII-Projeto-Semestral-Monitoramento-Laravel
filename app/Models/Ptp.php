<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ptp extends Model
{
    protected $table = "ptps";
    public $incrementing = true;

    protected $fillable = ['nome','descricao','endereco','responsavel','telefone'];
}
