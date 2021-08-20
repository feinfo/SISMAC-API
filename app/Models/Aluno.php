<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    //
    protected $fillable = [
        'nm_escola', 'sg_uf',
    ];

    public $timestamps = false;

    protected $primaryKey = 'cd_aluno';

    protected $table = "aluno";

    public function escola(){
        return $this->hasOne(Escola::class, 'cd_escola', 'cd_escola');
    }
    public function etapa(){
        return $this->hasOne(Etapa::class, 'cd_etapa', 'cd_etapa');
    }
}
