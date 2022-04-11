
<x-app-layout>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __($album->name) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-green-500 border-b border-gray-200">
                    <section class="text-center container">
                        <div class="row">
                            <div class="col-lg-6 col-md-8 mx-auto">
                                <h2 class="fw-light">{{$album->name}}</h2>
                                <p class="lead text-muted">{{$album->description}}</p>
                                <div class="button-group flex items-center justify-center">
                                    <a href="{{ route('photo-create',$album->id ) }}" class="btn btn-primary ">Upload Photo</a>
                                    <a href="/albums" class="btn btn-secondary ">Go Back</a>
                                    <a href="{{ route('album-share-list',$album->id ) }}" class="btn btn-primary ">Shared with</a>
                                <form action="{{route('album-destroy',$album->id)}}" method="post" class="d-flex justify-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="button" class="btn btn-danger float-right">Delete album</button>
                                </form>
                                </div>
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
                    <div class="card shadow-sm m-2">
                        <img src="/storage/albums/{{ $album->id}}/{{$photo->photo}}" alt="{{ $photo->photo }}" height="300" width="300">
                        <div class="card-body">
                            <p class="card-text">{{$photo->desciption}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('photo-show',$photo->id)}}" class="btn btn-sm btn-outline-secondary">View</a>
                                </div>
                                <small class="text-muted">{{$photo->title}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="padding-left-50">
            <h5>No photos yet.</h5>
        </div>
    @endif
        </div>
</x-app-layout>

