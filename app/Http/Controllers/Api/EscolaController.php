<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Escola;
use App\Http\Controllers\Controller;

class EscolaController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json($request->ip());
        // return response()->json(Escola::where('ic_ativo',"1")->get());
    }
   

}
