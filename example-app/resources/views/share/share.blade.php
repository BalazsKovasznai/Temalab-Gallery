<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __('Share an Album') }}
        </h2>
    </x-slot>
    <xslot name="body">
        <div class="py-12 flex items-center justify-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg fit-width">
                    <div class="px-6 py-3 bg-green-500 border-b border-gray-200">
                        <form method="post" action="{{ route('album-share-add') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="album-id" value="{{$albumId}}">
                            <div class="form-group p-4">
                                <label for="userid">User to share</label>
                                <input type="text" class="form-control rounded-md w-full sm:max-w-md" name=userid id="userid" placeholder="Enter user ID">
                            </div>

                            <div class="flex items-center justify-center p-4">
                            <button dusk="Share" type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-100 border border-transparent rounded-md
                              font-semibold text-small text-black uppercase tracking-widest hover:bg-green-700 active:bg-gray-900
                               focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
                               ease-in-out duration-150 ml-3">Share</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </xslot>
</x-app-layout>
