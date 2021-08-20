<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Error;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function filtrar(Request $request)
    {
        extract($request->all());

        return response()->json(
            Aluno::with('escola')->with('etapa')->where('aluno.ic_ativo',"1")
            ->when($cd_uf, function($q, $cd_uf){
                $q->join('escola', 'escola.cd_escola', 'aluno.cd_escola')
                ->where('cd_uf', $cd_uf);
            })
            ->when($cd_escola, function($q, $cd_escola){
                $q->where('escola.cd_escola', $cd_escola);
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
    public function cadastrar(Request $request){
        extract($request->all());
        try{

            $aluno = new Aluno;
            $aluno->nm_aluno = $nm_aluno;
            $aluno->nm_email = $nm_email;
            $aluno->cd_escola = $cd_escola;
            $aluno->cd_etapa = $cd_etapa;
            $aluno->save();
            return response()->json(200);
        }
        catch(Error $er){
            return response()->json($er,201);
        }

    }
    public function editar(Request $request){
        extract($request->all());
        try{

            $aluno = Aluno::find($cd_aluno);
            $aluno->nm_aluno = $nm_aluno;
            $aluno->nm_email = $nm_email;
            $aluno->cd_escola = $cd_escola;
            $aluno->cd_etapa = $cd_etapa;
            $aluno->save();
            return response()->json(200);
        }
        catch(Error $er){
            return response()->json($er,201);
        }

    }
}
