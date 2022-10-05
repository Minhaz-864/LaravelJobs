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
                Manage Gigs
            </h1>
        </header>


        <table class="w-full content-end table-auto rounded-sm">
            <tbody>
                @unless($listings->isEmpty())
                    @foreach ($listings as $listing)
                        @php
                            $applicant = \App\Models\Applicant::find($listing->applicant_id)
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
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $applicant->cv }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/applicant/view/{{ $listing->applicant_id }}">

                                    View Application
                                </a>
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
