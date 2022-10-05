<x-layout>
            <x-card class="p-10">
                <div class="flex justify-around">
                <button class="text-red-500"><i class="fa-solid fa-user"></i> <a href="/company/profileSetup">Profile</a></button>
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> <a href="/company/applications">Applications</a></button>
                </div>
                <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                                            Manage Gigs
                </h1>
                </header>
                <table class="w-full content-end table-auto rounded-sm">
                    <tbody>
                        @unless($listings->isEmpty())
                        @foreach($listings as $listing)
    
                        <tr class="border-gray-300">
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="/listings/{{ $listing['id'] }}">
                                    {{$listing->title}}
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                
                                    {{$listing->description}}
                             
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                            <x-listTags :tags="$listing->tags" />
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                            <a href="/listings/{{ $listing->id }}/edit">
                        <i class="fa-solid fa-pencil">
                                                        </i>
                                                Edit
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                            <form method="POST" action="/listings/{{ $listing->id }}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
        </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                       <tr class="border-gray-500">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            Nothing to show yet!    
                        <td>
    </tr>
                    @endunless
                    <div class="mt-6 p-4">
                        {{ $listings->links() }}
                    </div>
                    </tbody>
                </table>
           
</x-card>

</x-layout>


