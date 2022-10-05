<x-layout>
    <x-card class="p-10">
        <div class="flex justify-around">
            <button class="text-red-500"><i class="fa-solid fa-user"></i> <a
                    href="/company/profileSetup">Profile</a></button>
            <button class="text-red-500"><i class="fa-solid fa-trash"></i> <a
                    href="/company/applications">Applications</a></button>
        </div>

        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Applications
            </h1>
        </header>


        <table class="w-full content-end table-auto rounded-sm">
            <tbody>
                @unless($listings->isEmpty())
                    @foreach ($listings as $listing)
                        @php
                        
                            $applicant = \App\Models\Applicant::find($listing->applicant_id);
                        @endphp

                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/listings/{{ $listing['id'] }}">
                                    {{ $listing->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">

                                {{ $applicant->name }}

                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $applicant->latest_degree }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg
                            {{$listing->status == 'Pending'? 'text-yellow-400': 'text-lime-400' }}">
                                {{ $listing->status }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                
                                <form action="/applicant/view/{{ $listing->applicant_id }}" method="post">
                                    @csrf
                                    <input type="text" hidden name="listing_id" value="{{ $listing->listing_id}}"/>
                                    <button type="submit">View Application</button>
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
