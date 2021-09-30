<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escola extends Model
{
    //
    protected $fillable = [
        'nm_escola', 'cd_uf', 'sg_uf',
    ];
    protected $primaryKey = 'cd_escola';
    protected $table = "escola";
    public $timestamps = false;
}
