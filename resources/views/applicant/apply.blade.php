<x-layout>
    <div><a href="/applicant" class="text-black ml-4 p-10 m-10">
            <i class="fa fa-angle-left" aria-hidden="true"></i> Back </a>
    </div>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Apply to "{{$listing->title}}"
            </h2>
        </header>

        <form method="POST" action="/apply/{{$profile[0]->id}}" enctype="multipart/form-data">
            @csrf

            <h3 class="text-laravel">Company Information</h3>
    <hr><hr>
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Company Name:</label>
                <label for="name" class="inline-block text-lg mb-2"><strong>{{ $company->name }}</strong></label>
                <input type="text" hidden class="border bg-slate-200 rounded p-2 w-full" name="company"
                    value="{{ $company->name }}" />
                <input type="text" hidden class="border bg-slate-200 rounded p-2 w-full" name="comapny_id"
                    value="{{ $company->id }}" />
                <input type="text" hidden class="border bg-slate-200 rounded p-2 w-full" name="title"
                    value="{{ $listing->title }}" />  
                <input type="text" hidden class="border bg-slate-200 rounded p-2 w-full" name="tags"
                    value="{{ $listing->tags }}" />      
                    <input type="text" hidden class="border bg-slate-200 rounded p-2 w-full" name="listing_id"
                    value="{{ $listing->id }}" />   
            </div>


            @unless(!$company->website)
            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">Website: </label>
                <label for="website" class="inline-block text-lg mb-2"><strong>{{ $company->website }}</strong></label>
                <input type="text" hidden class="border bg-slate-200 rounded p-2 w-full" name="website"
                    value="{{ $company->website }}" />

                @error('website')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            @endunless

            <h3 class="text-laravel">Personal Information</h3>
            <hr><hr>
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name: </label>
                <label for="name" class="inline-block text-lg mb-2"><strong>{{ $profile[0]->name }}</strong></label>
                <input type="text" hidden class="border  bg-slate-200 rounded p-2 w-full" name="applicant_id"
                    value="{{ $profile[0]->id }}" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email: </label>
                <label for="email" class="inline-block text-lg mb-2"><strong>{{ $profile[0]->email }}</strong></label>
            </div>

            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Phone</label>
                <label for="phone" class="inline-block text-lg mb-2"><strong>{{ $profile[0]->phone }}</strong></label>
                
            </div>


            <div class="mb-6">
                <label for="latest_degree" class="inline-block text-lg mb-2">Latest Degree:</label>
                <label for="latest_degree" class="inline-block text-lg mb-2"><strong>{{ $profile[0]->latest_degree }}</strong></label>
                
            </div>

            <div class="mb-6">
                <label for="latest_institute" class="inline-block text-lg mb-2">Latest Institute: </label>
                <label for="latest_institute" class="inline-block text-lg mb-2"><strong>{{ $profile[0]->latest_institute }}</strong></label>
                
            </div>

            <div class="mb-6">
                <label for="present_address" class="inline-block text-lg mb-2">Present Address: </label>
                <label for="present_address" class="inline-block text-lg mb-2"><strong>{{ $profile[0]->present_address }}</strong></label>
                
            </div>

            <div class="mb-6">
                <label for="cover_letter" class="inline-block text-lg mb-2">
                    Cover Letter
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="cover_letter" rows="10"
                    placeholder="Your cover letter here">{{ $profile[0]->cover_letter }}</textarea>
                @error('cover_letter')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="cv" class="inline-block text-lg mb-2">
                    Curriculum vitae:   
                </label>
                <label for="cv" class="inline-block text-lg mb-2">
                @unless($profile[0]->cv)
                @else
                <a href="#" class="text-laravel"><i class="fa-solid fa-file-check"></i>{{explode('/',$profile[0]->cv)[1]}}</a>
                @endunless
                </label>
                <!-- <input type="file" class="border border-gray-200 rounded p-2 w-full" name="cv" />
                
                @error('cv')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror -->
            </div>

           

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Apply
                </button>


            </div>
        </form>
    </x-card>


</x-layout>
