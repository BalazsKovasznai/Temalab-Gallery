<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __('Upload new photo') }}
        </h2>
    </x-slot>
    <xslot name="body">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-green-500 border-b border-gray-200">
                        <form method="post" action="{{ route('photo-store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="album-id" value="{{$albumId}}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name=title id="title" placeholder="Enter Title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter description">
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-100 border border-transparent rounded-md
                              font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-700 active:bg-gray-900
                               focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
                               ease-in-out duration-150 ml-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </xslot>
</x-app-layout>
