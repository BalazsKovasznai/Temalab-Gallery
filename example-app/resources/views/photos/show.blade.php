@extends('layouts.app1')

@section('content')
    <div class="container">
        <h3>{{$photo->title}}</h3>
        <p>{{$photo->desciption}}</p>
        <form action="{{route('photo-destroy',$photo->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" name="button" class="btn btn-danger float-right">Delete image</button>
        </form>
        <a href="{{route('album-show',$photo->album->id)}}" class="btn btn-info">Go Back</a>
        <hr>
        <img src="/storage/albums/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->photo}}">





    </div>


@endsection
