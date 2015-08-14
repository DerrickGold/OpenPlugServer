<?php

namespace App\Http\Controllers;

use App\Models\PlayList;
use App\Models\Song;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class PlayListController extends Controller
{
    private $playlist;
    private $songs;

    public function __construct(PlayList $playlist, Song $songs) {
        $this->playlist = $playlist;
        $this->songs = $songs;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $newPlaylist = new $this->playlist();
        $status = $newPlaylist->validation(Input::all());

        $httpCode = 400;
        if ($status) {
            $newPlaylist->save();
            $httpCode = 200;
        }

        return response()->json(["status" => $status], $httpCode);
    }


    private function startPlaylist($playlist, $curNumber = null) {
        if (is_null($curNumber)) $curNumber = 0;

        $nextSong = $this->songs->where('playlist_id', '=', $playlist->id)
            ->where('priority', '>', $curNumber)->orderby('priority')->first();

        $status = false;
        if(!is_null($nextSong)) {
            $playlist->current_song = $nextSong->id;
            $playlist->song_start_time = time();
            $status = true;

        } else if ($curNumber > 0){
            //probably hit end of playlist, lets start it over again
            return $this->startPlaylist($playlist, 0);
        } else {
            //fuck the police, the playlist be empty as fuck
            $playlist->current_song = null;
            $playlist->song_start_time = null;

        }

        $playlist->save();
        return $status;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($playlist_name)
    {
        $playlist = $this->playlist->where('playlist_name', '=', $playlist_name)->first();
        if(!$playlist) {
            return response()->json(["status"=>false], 404);
        }

        if ($this->songs->where('playlist_id', '=', $playlist->id)->count() > 0) {

            //no song playing, grab the first one on the playlist
            if (is_null($playlist->current_song)) {
                $this->startPlaylist($playlist, 0);
            } else {
                $currentTime = time();

                //check if we need to go to the next song on the playlist
                $currentSong = $this->songs->find($playlist->current_song);
                if (is_null($currentSong)) {
                    //this shouldn't happen! Start playlist from beginning
                    $this->startPlaylist($playlist);
                } else {
                    //if song is over, then start the next one, since clients will be pinging like mofos
                    if ($currentTime - $playlist->song_start_time > $currentSong->length) {
                        $this->startPlaylist($playlist, $currentSong->priority);
                    }
                }
            }

        }
        $playlist->status = true;
        $playlist->requested_time = time();
        return response()->json($playlist, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
