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
        $user_id = auth()->id();
        $users = User::get();
        foreach ($users as $user){
            if($user->id == $user_id){
                $username = $user->name;
            }
        }
        $photo_id = $request->input('photo_id');
        $photos = Photo::get();
        foreach ($photos as $photo)
        {
            if($photo->id == $photo_id){
                $album_id = $photo->album_id;
            }
        }
        $albums = Album::get();
        foreach ($albums as $album){
            if($album->id == $album_id){
                $owner_userid = $album->ulby;
            }
        }
        DB::table('comments3')->insert([
            'user_id' => $user_id,
            'username' => $username,
            'photo_id' => $photo_id,
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
        $user_id = auth()->id();
        $users = User::get();
        foreach ($users as $user){
            if($user->id == $user_id){
                $username = $user->name;
            }
        }
        $photo_id = $request->input('photo_id');
        $photos = Photo::get();
        foreach ($photos as $photo)
        {
            if($photo->id == $photo_id){
                $album_id = $photo->album_id;
            }
        }
        $albums = Album::get();
        foreach ($albums as $album){
            if($album->id == $album_id){
                $owner_userid = $album->ulby;
            }
        }
        DB::table('comments3')->insert([
            'user_id' => $user_id,
            'username' => $username,
            'photo_id' => $photo_id,
            'owner_userid' => $owner_userid,
            'comment' => $comment
        ]);
        return redirect('/shared_photos/'.$request->input('photo_id'));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
