<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    protected $table = 'playlists';
    public $timestamps = false;

    protected $fillable = ['playlist_name', 'current_song', 'song_start_time'];

    public function validation($input) {

        $name = $input['playlist_name'];

        if($this->where('playlist_name', '=', $name)->count() > 0) {
            //playlist with this name already exists
            return false;
        }

        $this->fill($input);
        return true;
    }
}
