<?php

namespace App\Http\Controllers;

use App\Models\PlayList;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class PlayListController extends Controller
{
    private $playlist;

    public function __construct(PlayList $playlist) {
        $this->playlist = $playlist;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
