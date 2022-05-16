<x-app-layout>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <x-slot name="header">
        <h2 class="font-semi-bold text-xl text-green-800 leading-tight ">
            {{ __('Shared this album with') }}
        </h2>
    </x-slot>
    <xslot name="body">

        @if($sharingExist)
            <div class="py-12 flex items-center justify-center">
                <div class="max-w-7xl mx-auto">
                    <table class="table overflow-hidden border-b rounded-md min-w-400">
                        <thead class="bg-green-500">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                                <span class="table-row-margin">Username</span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-black uppercase tracking-wider">
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <span class="table-row-margin">{{ $user->name }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('sharing-destroy', $albumid) }}" method="POST">
                                        <input type="hidden" value="{{$user->id}}" name="user_id">
                                        @csrf
                                        @method('DELETE')
                                        <div class="px-6">
                                            <button class="btn btn-danger btn-sm" title="Delete">Unshare</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <div class="px-4 my-3 mx-5">Not shared with anyone.</div>
                @endif

        </div>
    </xslot>
</x-app-layout>
