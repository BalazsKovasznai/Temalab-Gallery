<x-app-layout>
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
                    <div class="card shadow-sm">
                        <img src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->cover_image }}" height="300" width="300">
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
            <div>No albums yet.</div>
            @endif
        </div>
    </xslot>



</x-app-layout>
