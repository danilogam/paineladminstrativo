<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            ['id' => 1, 'title' => 'Lorem ipsum dolor sit amet', 'name' => 'Inicial', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi cum tempora blanditiis ab in harum necessitatibus, nobis et earum quasi at officia amet soluta ex quis iure maiores, porro, ratione.</p><p>Harum dolore sequi ullam, explicabo, quibusdam ea eveniet saepe itaque assumenda eum, voluptatibus possimus odit illum ex quas, totam expedita. Quis ea, commodi voluptates placeat natus ab quasi consequuntur voluptatibus.</p>'],
            ['id' => 2, 'title' => 'Lorem ipsum dolor sit amet', 'name' => 'Sobre', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam at eius consequatur dignissimos quod quas dicta est, accusamus repudiandae quaerat placeat nobis similique cupiditate facilis sit, asperiores amet fugiat fugit.</p><p>Labore quidem natus beatae, ullam magnam, sint vitae velit ipsa similique illo aperiam, voluptates dolorum molestiae corporis repellendus laudantium, optio fugit expedita ab magni error hic earum. Quos consectetur, neque!</p>'],
            ['id' => 3, 'title' => 'Lorem ipsum dolor sit amet', 'name' => 'Contato', 'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam at eius consequatur dignissimos quod quas dicta est, accusamus repudiandae quaerat placeat nobis similique cupiditate facilis sit, asperiores amet fugiat fugit.</p><p>Labore quidem natus beatae, ullam magnam, sint vitae velit ipsa similique illo aperiam, voluptates dolorum molestiae corporis repellendus laudantium, optio fugit expedita ab magni error hic earum. Quos consectetur, neque!</p>']
        ];

        DB::table('pages')->insert($pages);
    }
}
