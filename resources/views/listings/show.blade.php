{{-- @extends('layout') --}}
{{-- @section('content') --}}
{{-- if we are going to use layout as view
then we need to to extend and do section
so that we can pass the whole thing as a
template. but as we are now using it as component
we will wrap the whole section with <x-layout> --}}

<x-layout>

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="hidden w-48 mr-6 md:block"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/apple.jpg') }}"
                    alt="" />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                <x-listTags :tags="$listing->tags" />
                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $listing->city }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{ $listing->description }}
                        </p>

                        <div class="flex items-center">

                            <a href="mailto:{{ $listing->email }}"
                                class="block w-80 bg-laravel text-white mt-6 py-2 px-5 mx-10 ml-20 rounded-xl hover:opacity-80"><i
                                    class="fa-solid fa-envelope"></i>
                                Contact Employer</a>
    
                            <a href="https:{{ $listing->website }}" target="_blank"
                                class="block w-80 bg-black text-white mt-6 py-2 px-5 mx-10  rounded-xl hover:opacity-80"><i
                                    class="fa-solid fa-globe"></i> Visit
                                Website</a>
                            @auth()
                            @unless(auth()->user()->is_company == 1)
                            <a href="/apply/{{$listing->id}}" target="_blank"
                            class="block w-80 bg-green text-white mt-6 py-2  px-5 mx-5 pr-0 rounded-xl hover:opacity-80"><i
                               class="fa-solid fa-globe"></i>Apply for this job</a>
                            @endunless
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </x-card>
        
    </div>
</x-layout>
{{-- @endsection --}}
