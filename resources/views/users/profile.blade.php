<x-layout>

    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Profile
        </h2>
        <p class="mb-4">Setup your profile to post jobs</p>
    </header>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <form method="POST" action="/users/profile/{{ $profile['id'] }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Comapny Name
                </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ $profile->name }}" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ $profile->email }}" />

                @error('email')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Phone</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ $profile->phone }}" />

                @error('phone')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="establishment" class="inline-block text-lg mb-2">Year of Establishment</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="establishment"
                    value="{{ $profile->establishment }}" />

                @error('establishment')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="address" class="inline-block text-lg mb-2">company address</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="address"
                    value="{{ $profile->address }}" />

                @error('address')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="website" class="inline-block text-lg mb-2">Website</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
                    value="{{ $profile->website }}" />

                @error('website')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tradelicense" class="inline-block text-lg mb-2">Bussiness/Trade License Number</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tradelicense"
                    value="{{ $profile->tradelicense }}" />

                @error('tradelicense')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="tradelicensefile" class="inline-block text-lg mb-2">Bussiness/Trade License
                    Certificate</label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="tradelicensefile"
                    value="{{ $profile->tradelicensefile }}" />
                <span>
                    @unless($profile->tradelicensefile)
                    @else
                    <div>

                        <a href="{{asset($profile->tradelicensefile)}}" class="text-lime-500"><i class="fa fa-file" aria-hidden="true"></i></a>
                    </div>
                    
                    @endunless
                </span>
                @error('tradelicensefile')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">Logo</label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo"
                    value="{{ $profile->logo }}" />
                <span>
                    @unless($profile->logo)
                    @else
                        <img class="w-24" src="{{asset($profile->logo)}}" alt="">
                    @endunless
                </span>
                @error('logo')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
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
