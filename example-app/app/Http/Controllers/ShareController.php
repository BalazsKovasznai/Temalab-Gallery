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
        $sharedalbums = DB::table('user_album_sharing')->where('user_id', auth()->id())->get()->toArray();

        foreach ($sharedalbums as $album){
            if($album->album_id == $photo->album_id){
                $comments=DB::table('comments3')->select('comment', 'username', 'user_id', 'id')->where('photo_id', $id)->get()->toArray();
                return view('share.shared_photo_show')->with('photo',$photo)->with('comments', $comments);
            }
        }
        return view('layouts.unavailable');

    }





    public function create(int $albumId)
    {
        return view('share.share')->with('albumId',$albumId);
    }

    public function add(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|exists:users,name'

        ]);
        $username=$request->input('username');
        $album_id=$request->input('album-id');
        $user_id = User::select('id')->where('name', $username)->first()->id;
        $album = Album::select('id')->where('id', $album_id)->first();
        if(!($album->shared_with()->where('user_id', '=', $user_id)->count())) {
            DB::table('user_album_sharing')->insert([
                'user_id' => $user_id,
                'album_id' => $album_id
            ]);

            return redirect('/albums')->with('success', 'Sharing created successfully!');
        }
        return redirect('/albums')->with('success', 'Album is already shared with this user.');
    }
    public function show($id)
    {
        $album=Album::with('photos')->find($id);
        $sharedalbums = DB::table('user_album_sharing')->where('user_id', auth()->id())->get()->toArray();
        foreach ($sharedalbums as $shared){
            if($shared->album_id == $album->id){
                return view('share.shared_album_show')->with('album',$album);
            }
        }
        return view('layouts.unavailable');
    }

    public function destroy($albumid,Request $request)
    {

        $user_id = $request->input('user_id');
        $delete=DB::table('user_album_sharing')
        ->where('album_id',$albumid)->where('user_id',$user_id)->delete();
        return redirect('/albums')->with('success', 'Sharing deleted successfully');

    }

    public function list_users($albumid){


        $sharedusers = DB::table('user_album_sharing')
            ->select('user_id')
            ->where('album_id', $albumid)->get()->toArray();

        $s_users=Arr::pluck($sharedusers,'user_id');
        $users = User::select()->whereIn('id',$s_users)->get();

        foreach($users as $user) {
            return view('share.shared_with_users', compact('users','albumid'))->with('user', $users)->with('sharingExist', true);
        }
        return view('share.shared_with_users', compact('users','albumid'))->with('user', $users)->with('sharingExist', false);

    }
 }



