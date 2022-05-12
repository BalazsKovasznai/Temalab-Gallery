<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_as_owner(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment=$request->input('comment');
        $user = User::find(auth()->id());
        $photo = Photo::find($request->input('photo_id'));
        $albums = Album::get();
        foreach ($albums as $album){
            if($album->id == $photo->album_id){
                $owner_userid = $album->user_id;
            }
        }
        DB::table('comments3')->insert([
            'user_id' => $user->id,
            'username' => $user->name,
            'photo_id' => $photo->id,
            'owner_userid' => $owner_userid,
            'comment' => $comment
        ]);
        return redirect('/photos/'.$request->input('photo_id'));
    }

    public function store_as_user(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $comment=$request->input('comment');
        $photo = Photo::find($request->input('photo_id'));
        $user = User::find(auth()->id());

        $sharedalbums = DB::table('user_album_sharing')->where('user_id', $user->id)->get()->toArray();

        foreach ($sharedalbums as $share){
            if($share->album_id == $photo->album_id){
                $albums = Album::get();
                foreach ($albums as $album){
                    if($album->id == $photo->album_id){
                        $owner_userid = $album->user_id;
                    }
                }
                DB::table('comments3')->insert([
                    'user_id' => $user->id,
                    'username' => $user->name,
                    'photo_id' => $photo->id,
                    'owner_userid' => $owner_userid,
                    'comment' => $comment
                ]);
                return redirect('/shared_photos/'.$request->input('photo_id'));
            }
        }
        return redirect('/dashboard')->with('danger', 'Access denied');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy_as_owner(Request $request)
    {
        DB::table('comments3')->delete($request->input('comment_id'));
        return redirect('/photos/'.$request->input('photo_id'));
    }

    public function destroy_as_user(Request $request)
    {
        DB::table('comments3')->delete($request->input('comment_id'));
        return redirect('/shared_photos/'.$request->input('photo_id'));
    }
}
