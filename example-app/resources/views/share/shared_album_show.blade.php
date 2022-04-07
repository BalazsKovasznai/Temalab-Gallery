
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __($album->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-green-500 border-b border-gray-200">
                    <section class="py-5 text-center container">
                        <div class="row py-lg-5">
                            <div class="col-lg-6 col-md-8 mx-auto">
                                <h1 class="fw-light">{{$album->name}}</h1>
                                <p class="lead text-muted">{{$album->description}}</p>
                                <p>
                                    <a href="/albums" class="btn btn-secondary my-2">Go Back</a>
                                </p>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @if(count($album->photos)>0)
        <div class="container">
        <div class="row" >
            @foreach($album->photos as $photo)
                <div class="col" >
                    <img class="card shadow-sm">
                        <img src="/storage/albums/{{ $album->id}}/{{$photo->photo}}" alt="{{ $photo->photo }}" height="300" width="300">
                        <div class="card-body">
                            <p class="card-text">{{$photo->desciption}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('shared-photo-show',$photo->id)}}" class="btn btn-sm btn-outline-secondary">View</a>

                                </div>
                                <small class="text-muted">{{$photo->title}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h3>No photos yet.</h3>
    @endif
        </div>
</x-app-layout>

