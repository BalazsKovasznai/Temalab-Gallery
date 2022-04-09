<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-black leading-tight ">
            {{ __('Shared this album with') }}
        </h2>
    </x-slot>
    <xslot name="body">

    @if($sharingExist)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-green overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-green-400 border-b border-gray-200">
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-green-500">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="relative px-6 py-3 ">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                            </thead>

                                                <tbody class="bg-white divide-y divide-gray-200">

                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $user->name }}
                                                        </td>

                                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

                                                            <form action="{{ route('sharing-destroy', $albumid) }}" method="POST">
                                                                <input type="hidden" value="{{$user->id}}" name="user_id">

                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" title="Delete">Unshare</button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>

                                        </table>

                                    </div>
                                    @else
                                        <div>Not shared with anyone.</div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </xslot>
</x-app-layout>
