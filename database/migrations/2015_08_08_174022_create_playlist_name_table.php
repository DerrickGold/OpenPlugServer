<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function(Blueprint $table){
            $table->increments('id');
            $table->string('playlist_name')->unique();
            $table->integer('current_song')->references('id')->on('songs')->nullable();
            $table->timestamp('song_start_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playlists');
    }
}
