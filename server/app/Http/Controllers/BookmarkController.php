<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bookmark;
use App\User;
use App\Song;

class BookmarkController extends Controller
{
    public function index($songId=null, $userId=null)
    {
        $matchThese = ['song_id' => $songId, 'user_id' => $userId];
        $SongsBookmark = Bookmark::where($matchThese)->get();


        return response()
    	        ->json([
                'songId' => $songId,
                'userId' => $userId,
                'SongsBookmark' => count($SongsBookmark)
                ], 200);


    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $song = Song::findOrFail($request->songId);

        $exists = $user->songs->contains($song->id);

        if(!$exists)
        {
            $song->users()->attach($user);
            return response()
    	        ->json([
                'bookmarked' => 'Bookmarked'
                ], 200);
        }

    }

    public function unbookmark(Request $request)
    {
        //Get signed in user's id
        $user = User::findOrFail($request->userId);

        //Get song
        $song = Song::findOrFail($request->songId);

        $matchThese = ['song_id' => $song->id, 'user_id' => $user->id];
        $bookmark = Bookmark::where($matchThese)->delete();

        return response()
    	        ->json([
               'message' => 'Unbookmarked',

                ], 200);
    }

    public function userbookmarks($userId)
    {

        $bookmarks = Bookmark::where('user_id', $userId)->get();
        $songs = array();
        foreach ($bookmarks as $bookmark) {
            $song = Song::findOrFail($bookmark->song_id);
           array_push($songs, $song);
        }
        return response()
    	        ->json([
               //'bookmarks' => $bookmarks,
               'bookmarks' => $songs

                ], 200);

    }
}
