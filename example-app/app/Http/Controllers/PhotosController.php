<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       /* $photos = Photo::all();
        return $photos;*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $albumId)
    {
        $album = Album::find($albumId);
        if($album->ulby == auth()->id()){
            return view('photos.create')->with('albumId',$albumId);
        }
        else return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image'
        ]);
        $filenameWithExtension=$request->file('photo')->getClientOriginalName();

        $filename=pathinfo($filenameWithExtension,PATHINFO_FILENAME);

        $extension= $request->file('photo')->getClientOriginalExtension();

        $filenameToStore=$filename . '_' . time() . '_' . $extension;

        $request->file('photo')->storeAs('public/albums/' . $request->input('album-id'),$filenameToStore);

        $photo=new Photo();
        $photo->title=$request->input('title');
        $photo->description=$request->input('description');
        $photo->photo=$filenameToStore;
        $photo->size=$request->file('photo')->getSize();
        $photo->album_id=$request->input('album-id');
        $photo->save();
        return redirect('/albums/' . $request->input('album-id'))->with('success','Photo created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo=Photo::find($id);
        $album=Album::find($photo->album_id);
        $comments=DB::table('comments3')->select('comment', 'username', 'id')->where('photo_id', $id)->get()->toArray();
        return view('photos.show')->with('photo',$photo)->with('comments', $comments)->with('album',$album);
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
        $photo=Photo::find ($id);
        $album=Album::find($photo->album_id);
        if(Storage::delete('/public/albums/'.$photo->album_id.'/'.$photo->photo) && $album->ulby==auth()->id())
        {
            $photo->delete();
            return redirect('/albums')->with('success', 'Photo deleted successfully');
        }
    }
}
