<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    //
    protected $fillable = [
        'nm_etapa', 'cd_escola'
    ];
    protected $table = "etapa";
    public $timestamps = false;
}
