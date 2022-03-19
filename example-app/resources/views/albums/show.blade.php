
<x-app-layout>
    <x-slot name="header">
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
                                    <a href="{{ route('photo-create',$album->id) }}" class="btn btn-primary my-2">Upload Photo</a>
                                    <a href="/dashboard" class="btn btn-secondary my-2">Go Back</a>
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

