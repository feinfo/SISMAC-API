<?php

namespace App\Http\Controllers\Api;

use App\Models\UserPerfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(UserPerfil::whereNull('ic_excluido')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPerfil  $userPerfil
     * @return \Illuminate\Http\Response
     */
    public function show($userPerfil)
    {
        return response()->json(userPerfil::find($userPerfil));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPerfil  $userPerfil
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPerfil $userPerfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPerfil  $userPerfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPerfil $userPerfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPerfil  $userPerfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPerfil $userPerfil)
    {
        //
    }
}
