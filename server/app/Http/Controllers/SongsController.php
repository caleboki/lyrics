<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Song;

class SongsController extends Controller
{
    public function index($id = null)
    {

        if ($id) {

            $songs = Song::where('title', 'like', '%' . $id . '%')
                    ->orwhere('artist', 'like', '%' . $id . '%')
                    ->orwhere('genre', 'like', '%' . $id . '%')
                    ->orwhere('album', 'like', '%' . $id . '%')
                    ->orwhere('lyrics', 'like', '%' . $id . '%')->get();
        }
        else {
            $songs = Song::orderBy('id', 'desc')
            ->take(10)
            ->get();
        }

    	return response()
    		->json([
                'songs' => $songs
    		]);
    }

    public function store(Request $request)
    {
        $song = new Song($request->all());
        $song->save();
        return response()
            ->json([
                'created' => true
            ]);
    }

    public function show($id)
    {

        $song = Song::findOrFail($id);
        return response()
            ->json([
                'song' => $song
            ]);
    }

    public function update(Request $request, $id)
    {

        $id = (int)$request->id;
        $song = Song::findOrFail($id);

        $song->title = $request->song['title'];
        $song->artist = $request->song['artist'];
        $song->genre = $request->song['genre'];
        $song->album = $request->song['album'];
        $song->albumImageUrl = $request->song['albumImageUrl'];
        $song->youtubeId = $request->song['youtubeId'];
        $song->lyrics = $request->song['lyrics'];
        $song->tab = $request->song['tab'];

        $song->save();
        return response()
            ->json([
                'updated' => true
            ]);
    }
}
