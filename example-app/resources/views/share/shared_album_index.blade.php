<x-app-layout>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __('Shared with me Albums') }}
        </h2>
    </x-slot>
    <xslot name="body">
        <div class="container" >
            @if($ownAlbumExist)
            <div class="row" >
                @foreach($albums as $album)
                <div class="col" >
                    <div class="card shadow-sm m-2" style="width: 18rem; height:17rem">
                        <img src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->cover_image }}" class="card-img-top cover-image">
                        <div class="card-body">
                            <p class="card-text">{{$album->desciption}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('album-share-show',$album->id)}}" class="btn btn-sm btn-outline-secondary">View</a>

                                </div>
                                <small class="text-muted">{{$album->name}}</small>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            @else
            <h5 class="my-3">No shared albums yet.</h5>
            @endif
        </div>
    </xslot>



</x-app-layout>
