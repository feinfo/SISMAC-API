<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Http\Controllers\Controller;
use App\Models\Etapa;
use Error;
use Illuminate\Support\Facades\DB;

class EscolaController extends Controller
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
            Escola::selectRaw('cd_uf as value, sg_uf as text')->where('ic_ativo',"1")->groupBy(['cd_uf', 'sg_uf'])->orderBy('sg_uf')
            ->get()
        );

    }

    public function getEtapas(Request $request){
        return response()->json(
             DB::table('etapa')->selectRaw('cd_etapa as value, nm_etapa as text')
            ->where('ic_ativo','1')
            ->where('cd_escola',$request->cd_escola)
            ->get()
        );

    }
    public function getUFs(){
        return response()->json(
            DB::table('uf')
            ->orderBy('sg_uf')
            ->get()
            ,200
        );
    }
    public function cadastrar(Request $request){
        extract($request->all());
        try{
            $escola = new Escola;
            $escola->nm_escola = $nm_escola;
            $escola->cd_uf = $cd_uf;
            $escola->sg_uf = $sg_uf;
            $escola->save();
            return response()->json(200);

        }
        catch(Error $er){
            return response()->json($er, 201);
        }
    }
    public function editar(Request $request){
        extract($request->all());
        try{
            $escola = Escola::find($cd_escola);
            $escola->nm_escola = $nm_escola;
            $escola->cd_uf = $cd_uf;
            $escola->sg_uf = $sg_uf;
            $escola->save();
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
            Escola::where('ic_ativo','1')
            ->when($cd_uf, function($q, $cd_uf){
                $q->where('escola.cd_uf', $cd_uf);
            })
            ->when($cd_escola, function($q, $cd_escola){
                $q->where('cd_escola', $cd_escola);
            })
            ->join('uf','uf.cd_uf','escola.cd_uf')
            ->get()
        );

    }

   

}
