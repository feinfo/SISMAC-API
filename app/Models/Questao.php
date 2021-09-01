<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    //
    protected $fillable = [
        'nm_questao', 'cd_avaliacao'
    ];

    public $timestamps = false;

    protected $primaryKey = 'cd_questao';

    protected $table = "questao";

    public function respostas(){
        return $this->hasMany(Resposta::class, 'cd_resposta', 'cd_resposta');
    }
}
