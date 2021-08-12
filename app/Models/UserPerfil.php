<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPerfil extends Model
{
    protected $table = 'users_perfil';
    protected $primaryKey = 'cd_perfil';
    protected $fillable = [
        'ds_descricao'
    ];
}
