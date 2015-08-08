<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('playlist_id')->references('id')->on('playlists');
            $table->integer('priority')->unique();
            $table->string("youtube_url");
            $table->string("title");
            $table->string("artist");
            $table->integer("length");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('songs');
    }
}
