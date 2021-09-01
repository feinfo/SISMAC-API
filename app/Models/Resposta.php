<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    //
    protected $fillable = [
        'cd_avaliacao', 'nm_resposta',
    ];

    public $timestamps = false;

    protected $primaryKey = 'cd_resposta';

    protected $table = "resposta";

    public function avaliacao(){
        return $this->hasOne(Avaliacao::class, 'cd_avaliacao', 'cd_avaliacao');
    }
}
