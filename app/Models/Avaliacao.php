<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    //
    protected $fillable = [
        'nm_avaliacao', 'cd_escola', 'cd_etapa',  'nm_anexo_b64',
    ];

    public $timestamps = false;

    protected $primaryKey = 'cd_avaliacao';

    protected $table = "avaliacao";

    public function respostas(){
        return $this->hasMany(Resposta::class, 'cd_avaliacao');
    }
    public function questoes(){
        return $this->hasMany(Questao::class, 'cd_avaliacao');
    }
}
