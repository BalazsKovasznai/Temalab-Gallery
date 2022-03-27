<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __($photo->title) }}
        </h2>
    </x-slot>
    <xslot name="body">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-green-500 border-b border-gray-200">
                            <div class="container">
                                <h3>{{$photo->title}}</h3>
                                <p>{{$photo->desciption}}</p>
                                <form action="{{route('photo-destroy',$photo->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="button" class="btn btn-danger float-right">Delete image</button>
                                </form>
                                <a href="{{route('album-show',$photo->album->id)}}" class="btn btn-info">Go Back</a>
                                <img src="/storage/albums/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->photo}}">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </xslot>
</x-app-layout>



