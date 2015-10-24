<?php

namespace App\Http\Controllers;

use App\Models\PlayList;
use App\Models\Song;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SongsController extends Controller
{
    protected $song;
    private $priorityDistance = 1.0;

    public function __construct(Song $song) {
        $this->song = $song;

    }

    private function playListByName($playlist_name) {
        return PlayList::where('playlist_name', '=', $playlist_name)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($playlist_name, Request $request)
    {
        //refer to playlist by name rather than ID
        $playlist = $this->playListByName($playlist_name);
        if(!$playlist)
            return response()->json([], 404);

        //determine the number of results to return
        $perPage = $request->input('limit');
        if ($perPage > 150) $perPage = 150;
        else if ($perPage < 0) $perPage = 1;

        //return paginated list of songs
        $songs = $this->song->where('playlist_id', '=', $playlist->id)
            ->paginate($perPage);
        return response()->json($songs, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($playlist_name, Request $request)
    {
        $playlist = $this->playListByName($playlist_name);
        if (!$playlist) {
            return response()->json(['msg'=>"Invalid playlist"], 404);
        }
        $input = $request->all();

        //set the playlist id to the one based in the url
        $input['playlist_id'] = $playlist->id;

        if(!array_key_exists('priority', $input)) {
            $lastSong = $this->song->where('playlist_id', '=', $playlist->id)
                ->orderby('priority', 'desc')->first();

            if (!$lastSong)
                $input['priority'] = $this->priorityDistance;
            else
                $input['priority'] = floor($lastSong->priority) + $this->priorityDistance;
        }
        $validator = Validator::make($input, $this->song->validationRules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $newSong = new $this->song();
        $newSong->fill($input);


        $newSong->save();
        return response()->json($newSong, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($playlist_name, $song_id)
    {
        $playlist = $this->playListByName($playlist_name);
        if (!$playlist) {
            return response()->json(['msg'=>"Invalid playlist"], 404);
        }

        $song = $this->song->find($song_id);
        if(is_null($song)) return response()->json(["status"=>false], 404);
        return response()->json($song, 200);
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
