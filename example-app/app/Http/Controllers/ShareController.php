<?php

namespace App\Http\Controllers;



use App\Models\Photo;
use App\Models\User;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ShareController extends Controller
{

    public function index()
    {

        $sharedalbums = DB::table('user_album_sharing')
            ->select('album_id')
            ->where('user_id', auth()->id())->get()->toArray();

        $s_albums=Arr::pluck($sharedalbums,'album_id');
        $albums = Album::select()->whereIn('id',$s_albums)->get();
        foreach ($albums as $album) {

                    return view('share.shared_album_index', compact('albums'))->with('albums', $albums)->with('ownAlbumExist', true);


            }

        return view('share.shared_album_index', compact('albums'))->with('albums', $albums)->with('ownAlbumExist', false);

    }
    public function shared_photo_show($id)
    {
        $photo=Photo::find($id);
        return view('share.shared_photo_show')->with('photo',$photo);
    }





    public function create(int $albumId)
    {
        return view('share.share')->with('albumId',$albumId);
    }

    public function add(Request $request)
    {

        $this->validate($request, [
            'userid' => 'required|exists:users,name'

        ]);
        $username=$request->input('userid');
        $album_id=$request->input('album-id');
        $user_id = User::select('id')->where('name', $username)->first()->id;
        $album = Album::select('id')->where('id', $album_id)->first();
        if(!($album->shared_with()->where('user_id', '=', $user_id)->count())) {
            DB::table('user_album_sharing')->insert([
                'user_id' => $user_id,
                'album_id' => $album_id
            ]);
            $album->is_share=true;
            return redirect('/albums')->with('success', 'Sharing created successfully!');
        }
        return redirect('/albums')->with('success', 'Album is already shared with this user.');
    }
    public function show($id)
    {
        $album=Album::with('photos')->find($id);
        return view('share.shared_album_show')->with('album',$album);
    }
 }



