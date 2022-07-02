<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'label' => 'Administrador'],
            ['id' => 2, 'label' => 'Cliente'],
            ['id' => 3, 'label' => 'Conteudoria'],
            ['id' => 4, 'label' => 'Editor'],
            ['id' => 5, 'label' => 'Redator']
        ];

        DB::table('roles')->insert($roles);
    }
}
