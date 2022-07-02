<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(1)->comment('0 => Rascunho, 1 => Publicado');;
            $table->string('title');
            $table->string('slug');
            $table->string('summary')->nullable();
            $table->text('content');
            $table->integer('categoria_id');
            $table->integer('gallery_id')->nullable();
            $table->string('image')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
