<x-layout>
    <x-card class="pl-0">
    <div class="flex justify-around">
                <button class="text-red-500"><i class="fa-solid fa-user"></i> <a href="/applicant/profileSetup">Profile</a></button>
                <button class="text-red-500 active"><i class="fa-solid fa-trash"></i> <a href="/applicant">Applications</a></button>
                </div>
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage applications
            </h1>
        </header>
            
        <table class="w-full table-auto rounded-sm">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company Name</th>
                    <th>Job Tags</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @unless($listings->isEmpty())
                    @foreach ($listings as $listing)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/listings/{{ $listing['id'] }}">
                                    {{ $listing->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="https://{{ $listing->website }}">

                                {{ $listing->company }}
                            </a>

                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <x-listTags :tags="$listing->tags" />
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            
                                <form method="POST" action="/apply/{{ $listing->id }}">
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
            </tbody>
        </table>

    </x-card>
</x-layout>
