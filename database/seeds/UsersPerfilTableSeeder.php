<?php

use Illuminate\Database\Seeder;

class UsersPerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory()->define(App\Models\UserPerfil::class)->create();
        factory(App\Models\UserPerfil::class)->create([
            'ds_descricao' => 'Administração',
        ]);
        factory(App\Models\UserPerfil::class)->create([
            'ds_descricao' => 'Regional Administrativa',
        ]);
        factory(App\Models\UserPerfil::class)->create([
            'ds_descricao' => 'Atendente',
        ]);
        factory(App\Models\UserPerfil::class)->create([
            'ds_descricao' => 'Administrador',
        ]);
    }
}
