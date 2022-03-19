<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('photos.create')->with('albumId',$albumId);
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
