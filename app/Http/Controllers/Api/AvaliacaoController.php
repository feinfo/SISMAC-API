<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Http\Controllers\Controller;
use App\Models\Avaliacao;
use App\Models\Etapa;
use App\Models\Questao;
use App\Models\Resposta;
use Error;
use Illuminate\Support\Facades\DB;

class AvaliacaoController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json(
            Escola::selectRaw('cd_escola as value, nm_escola as text')
            ->where('ic_ativo',"1")
            ->where('cd_uf',$request->cd_uf)
            ->get()
        );
    }

    public function getUfEscolas(){
        return response()->json(
            Escola::selectRaw('cd_uf as value, sg_uf as text')->where('ic_ativo',"1")->groupBy(['cd_uf', 'sg_uf'])->get()
        );

    }

    public function getEtapas(){
        return response()->json(
             Etapa::selectRaw('cd_etapa as value, nm_etapa as text')
             ->where('ic_ativo','1')
             ->groupBy('nm_etapa')
            ->get()
        );

    }
    public function getUFs(){
        return response()->json(
            DB::table('uf')->get()
            ,200
        );
    }
    public function cadastrar(Request $request){
        // $teste1 = $request->all();
        extract($request->all());
        // extract(json_decode($dados[0]));
        // return response()->json($request->all(), 201);
        try{
            $avaliacao = new Avaliacao;
            $avaliacao->nm_avaliacao = $nm_avaliacao;
            $avaliacao->cd_escola = $cd_escola;
            $avaliacao->cd_etapa = $cd_etapa;
            $avaliacao->nm_anexo_b64 = $nm_anexo_b64 ?? null;
            $avaliacao->save();
            $cd_avaliacao = $avaliacao->cd_avaliacao;
            
            $decodeRespostas = json_decode($respostas);

            $questao = new Questao;
            $questao->ds_questao = $nm_questao;
            $questao->cd_avaliacao = $cd_avaliacao;
            $questao->save();
            
            foreach($decodeRespostas as $alternativa){
                $resposta = new Resposta;
                $resposta->cd_avaliacao = $cd_avaliacao;
                $resposta->cd_questao = $questao->cd_questao;
                $resposta->nm_resposta = $alternativa->nm_resposta;
                $resposta->save();
            }

            return response()->json(200);

        }
        catch(Error $er){
            return response()->json($er, 201);
        }
    }
    public function cadastrarEtapa(Request $request){
        extract($request->all());
        try{
            $etapa = new Etapa;
            $etapa->nm_etapa = $nm_etapa;
            $etapa->cd_escola = $cd_escola;
            $etapa->save();
            return response()->json(200);
        }
        catch(Error $er){
            return response()->json($er, 201);
        }
    }
    public function filtrar(Request $request){
        extract($request->all());
        return response()->json(
            Avaliacao::where('avaliacao.ic_ativo','1')
            ->with('questoes')
            ->with('respostas')
            ->join('escola', 'escola.cd_escola', 'avaliacao.cd_escola')
            ->when($cd_uf, function($q, $cd_uf){
                $q->where('cd_uf', $cd_uf);
            })
            ->when($cd_escola, function($q, $cd_escola){
                $q->where('escola.cd_escola', $cd_escola);
            })
            ->when($cd_etapa, function($q, $cd_etapa){
                $q->where('cd_etapa', $cd_etapa);
            })
            ->when($nm_avaliacao, function($q, $nm_avaliacao){
                $q->where('nm_avaliacao', 'like', "%".$nm_avaliacao."%");
            })
            ->get()
        );

    }
    public function editar(Request $request){
        extract($request->all());
        try{

            $aluno = Avaliacao::find($cd_avaliacao);
            $aluno->nm_avaliacao = $nm_avaliacao;
            $aluno->cd_escola = $cd_escola;
            $aluno->cd_etapa = $cd_etapa;
            $aluno->save();

            $decodeQuestoes = json_decode($questoes);
            

            foreach($decodeQuestoes as $questaoAlterada){
                $questao = Questao::find($questaoAlterada->cd_questao);
                $questao->ds_questao = $questaoAlterada->ds_questao;
                $questao->save();
            }

            $decodeRespostas = json_decode($respostas);

            foreach($decodeRespostas as $respostaAlterada){
                $resposta = Resposta::find($respostaAlterada->cd_resposta);
                $resposta->nm_resposta = $respostaAlterada->nm_resposta;
                $resposta->save();
            }

            $existeNovaQuestao = strlen($nm_questao) > 3 ? 1 : 0;

            if($existeNovaQuestao)
            {

                $novaQuestao = new Questao;
                $novaQuestao->ds_questao = $nm_questao;
                $novaQuestao->cd_avaliacao = $cd_avaliacao;
                $novaQuestao->save();
                
                $decodeNovasRespostas = json_decode($novasRespostas);
    
                foreach($decodeNovasRespostas as $novaResposta){
                    $resposta = new Resposta;
                    $resposta->cd_avaliacao = $cd_avaliacao;
                    $resposta->cd_questao = $novaQuestao->cd_questao;
                    $resposta->nm_resposta = $novaResposta->nm_resposta;
                    $resposta->save();
                }
            }
            
            return response()->json(200);
        }
        catch(Error $er){
            return response()->json($er,201);
        }

    }

   

}
