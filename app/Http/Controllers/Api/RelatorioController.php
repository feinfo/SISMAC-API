<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Error;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function avaliacaoAluno(Request $request)
    {
        extract($request->all());

        return response()->json(
            DB::table('avalicao_aluno')
            ->when($cd_uf, function($q, $cd_uf){
                $q->where('cd_uf', $cd_uf);
            })
            ->when($cd_escola, function($q, $cd_escola){
                $q->where('cd_escola', $cd_escola);
            })
            ->when($cd_etapa, function($q, $cd_etapa){
                $q->where('cd_etapa', $cd_etapa);
            })
            ->when($nm_aluno, function($q, $nm_aluno){
                $q->where('nm_aluno', 'like', "%".$nm_aluno."%");
            })
            ->get()
        );
    }
}
