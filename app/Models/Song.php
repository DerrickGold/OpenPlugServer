<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{

    protected $table = 'songs';
    public $timestamps = false;

    protected $fillable = ['playlist_id', 'priority', 'youtube_url', 'title', 'artist', 'length', 'filesize'];

    protected $validationFields = [
        'playlist_id' => 'required|exists:playlists,id',
        'priority' => 'required|float',
        'youtube_url' => 'required|youtube',
        'title' => 'required',
        'artist' => 'required',
        'length' => 'required|integer',
        'filesize'=>'required|integer',
    ];

    public function validationRules() {
        return $this->validationFields;
    }

    public function getIdAttribute($value) {
        return (int)$value;
    }

    public function getPlaylistIdAttribute($value) {
        return (int)$value;
    }

    public function getPriorityAttribute($value) {
        return (float)$value;
    }

    public function getLengthAttribute($value) {
        return (int)$value;
    }

    public function getFilesizeAttribute($value) {
        return (int)$value;
    }

}
