<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        factory(App\Categoria::class, 5)->create();
    }
}
