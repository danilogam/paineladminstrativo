<?php

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    public function run()
    {
        factory(App\Post::class, 14)->create();
    }
}
