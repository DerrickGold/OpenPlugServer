<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{

    protected $table = 'songs';
    public $timestamps = false;

    protected $fillable = ['playlist_id', 'priority', 'youtube_url', 'title', 'artist', 'length'];

    protected $validationFields = [
        'playlist_id' => 'required|exists:playlists,id',
        'priority' => 'required|integer',
        'youtube_url' => 'required|youtube',
        'title' => 'required',
        'artist' => 'required',
        'length' => 'required|integer'
    ];

    public function validationRules() {
        return $this->validationFields;
    }
}
