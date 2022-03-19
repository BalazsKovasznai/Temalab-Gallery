<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <xslot name="body">
        <div class="container" h>
            @if(count($albums)>0)
                <div class="row" >
                    @foreach($albums as $album)
                        <div class="col" >
                            <div class="card shadow-sm">
                                <img src="/storage/album_covers/{{ $album->cover_image }}" alt="{{ $album->cover_image }}" height="200px">
                                <div class="card-body">
                                    <p class="card-text">{{$album->desciption}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{route('album-show',$album->id)}}" class="btn btn-sm btn-outline-secondary">View</a>
                                        </div>
                                        <small class="text-muted">{{$album->name}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h3>No albums yet.</h3>
            @endif
        </div>
    </xslot>



</x-app-layout>
