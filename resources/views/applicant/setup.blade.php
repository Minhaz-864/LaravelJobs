<x-layout>
    <div><a href="/applicant" class="text-black ml-4 p-10 m-10">
            <i class="fa fa-angle-left" aria-hidden="true"></i> Back </a>
    </div>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Profile Setup
            </h2>
            <p class="mb-4">Setup your profile. This informations will be added to email with your CV</p>
        </header>

        <form method="POST" action="/applicant/profileSetup/{{ $profile[0]->user_id }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ $profile[0]->name }}" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ $profile[0]->email }}" />

                @error('email')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Phone</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ $profile[0]->phone }}" />

                @error('phone')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gender" class="inline-block text-lg mb-2">Gender</label>
                <select name="gender" class="border border-gray-200 rounded p-2 w-full">
                    <option value="" {{ $profile[0]->gender == '' ? 'selected' : '' }}>Select</option>
                    <option value="male" {{ $profile[0]->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $profile[0]->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="others" {{ $profile[0]->gender == 'others' ? 'selected' : '' }}>Others</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="dob" class="inline-block text-lg mb-2">Date of Birth</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="dob"
                    value="{{ $profile[0]->dob }}" />
                @error('dob')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="latest_degree" class="inline-block text-lg mb-2">Latest Degree</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="latest_degree"
                    value="{{ $profile[0]->latest_degree }}" />
                @error('latest_degree')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="latest_institute" class="inline-block text-lg mb-2">Latest Institute</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="latest_institute"
                    value="{{ $profile[0]->latest_institute }}" />
                @error('latest_institute')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="present_address" class="inline-block text-lg mb-2">Present Address</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="present_address"
                    value="{{ $profile[0]->present_address }}" />
                @error('present_address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="cover_letter" class="inline-block text-lg mb-2">
                    Cover Letter
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="cover_letter" rows="10"
                    placeholder="Your cover letter here" value="{{ $profile[0]->cover_letter }}"></textarea>
                @error('cover_letter')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="cv" class="inline-block text-lg mb-2">
                    Curriculum vitae
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="cv" />
                @unless($profile[0]->cv)
                @else
                    <i class="fa-regular fa-file-check"></i>
                @endunless
                @error('cv')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Update Profile
                </button>


            </div>
            <div class="mt-8">
                <p>
                    <a href="/change_password/{{ auth()->user()->id }}" class="text-laravel">Change Password?</a>
                </p>
            </div>
        </form>
    </x-card>


</x-layout>
