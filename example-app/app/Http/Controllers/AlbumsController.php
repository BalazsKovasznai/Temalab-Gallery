<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$albums = Album::paginate();
        $albums=Album::get();
        return view('albums.index', compact('albums'))->with('albums',$albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
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
            'name' => 'required',
            'description' => 'required',
            'cover-image' => 'required|image'

        ]);
        $filenameWithExtension=$request->file('cover-image')->getClientOriginalName();

        $filename=pathinfo($filenameWithExtension,PATHINFO_FILENAME);

        $extension= $request->file('cover-image')->getClientOriginalExtension();

        $filenameToStore=$filename . '_' . time() . '_' . $extension;

        $request->file('cover-image')->storeAs('public/album_covers',$filenameToStore);

        $album=new Album();
        $album->name=$request->input('name');
        $album->description=$request->input('description');
        $album->cover_image=$filenameToStore;
        $album->save();

        return redirect('/albums')->with('success','Album created succesfully!');









    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album=Album::with('photos')->find($id);
            return view('albums.show')->with('album',$album);
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
        $album=Album::find ($id);
        if(Storage::delete('/public/storage/albums/'.$album->album_id.'/'.$album->album)) {
            $album->delete();
            return redirect('/albums')->with('success', 'Album deleted successfully');
        }
    }
}
