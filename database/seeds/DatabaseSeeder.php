<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(InformacoesSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(CidadesSeeder::class);
    }
}
