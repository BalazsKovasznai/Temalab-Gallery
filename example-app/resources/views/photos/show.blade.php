<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __($photo->title) }}
        </h2>
    </x-slot>
    <xslot name="body">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-green-500 p-6 bg-green-500 border-b border-gray-200">
                        <div class="text-center">
                            <h3>{{$photo->title}}</h3>
                            <p>{{$photo->desciption}}</p>
                            <form action="{{route('photo-destroy',$photo->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="button" class="btn btn-danger float-right">Delete image</button>
                            </form>
                            <a href="{{route('album-show',$photo->album->id)}}" class="btn btn-info">Go Back</a>
                        </div>
                        <div class="py-1 flex items-center justify-center">
                            <img src="/storage/albums/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->photo}}">
                        </div>
                    </div>
                    <div class="bg-emerald-100">
                        <div class="pt-6">
                            <form method="post" action="{{ route('comment-store-as-owner') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="photo_id" value="{{$photo->id}}">
                                <input type="text" class="form-control rounded-md w-full" name=comment id="comment" placeholder="Leave a comment...">
                                <div class="text-right">
                                    <button dusk="Comment" type="submit" class="inline-flex items-center px-4 py-2 bg-green-700 border border-transparent rounded-md
                                      font-semibold text-small text-black uppercase tracking-widest hover:bg-green-500 active:bg-gray-900
                                       focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
                                       ease-in-out duration-150 ml-3">Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-emerald-100 pt-6">
                        @if(count($comments)>0)
                            @foreach($comments as $comment)
                                <div class="comment-field">
                                    <p><b>{{$comment->username}}</b></p>
                                    <p>{{$comment->comment}}</p>
                                </div>
                            @endforeach
                        @else
                            <h3>No comments yet.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </xslot>
</x-app-layout>



