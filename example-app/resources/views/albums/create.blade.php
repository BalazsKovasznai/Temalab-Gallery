<x-app-layout>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __('Create an Album') }}
        </h2>
    </x-slot>
    <xslot name="body">
        <div class="py-12 flex items-center justify-center">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg fit-width">
                    <div class="px-6 py-3 bg-green-500 border-b border-gray-200">
                        <form method="post" action="{{ route('album-store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group p-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control rounded-md w-full sm:max-w-md" name=name id="name" placeholder="Enter name">
                            </div>
                            <div class="form-group px-3">
                                <label for="description">Description</label>
                                <input type="text" class="form-control rounded-md w-full sm:max-w-md" name="description" id="description" placeholder="Enter description">
                            </div>
                            <div class="form-group p-3">
                                <div>
                                    <label for="cover-image">Cover image</label>
                                </div>
                                <div>
                                    <input type="file" class="form-control" name="cover-image" id="cover-image" height="200px">
                                </div>
                            </div>
                            <div class="flex items-center justify-center p-4">
                            <button dusk="Submit" type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-100 border border-transparent rounded-md
                              font-semibold text-small text-black uppercase tracking-widest hover:bg-green-700 active:bg-gray-900
                               focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition
                               ease-in-out duration-150 ml-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </xslot>
</x-app-layout>
