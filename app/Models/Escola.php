<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    //
    protected $fillable = [
        'nm_escola', 'sg_uf',
    ];
    protected $table = "sismac_escolas";
}
