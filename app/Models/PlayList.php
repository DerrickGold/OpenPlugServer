<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    protected $table = 'playlists';
    public $timestamps = false;

    protected $fillable = ['playlist_name', 'current_song', 'song_start_time'];

    protected $validationFields = [
        'playlist_name' => 'required|unique:playlists,playlist_name',
    ];

    public function validationRules() {
        return $this->validationFields;
    }

}
