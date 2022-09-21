<x-layout>

<header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Profile
        </h2>
        <p class="mb-4">Setup your profile to post jobs</p>
    </header>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <form method="POST" action="/users">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Name
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
                <label for="phone" class="inline-block text-lg mb-2">Email</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ old('phone') }}" />

                @error('phone')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            //add more here. those ss will help
            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Email</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ old('phone') }}" />

                @error('phone')
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
                <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Sign Up
                </button>
            </div>

            <div class="mt-8">
                <p>
                  
                    <a href="/change_password/{{auth()->user()->id}}" class="text-laravel">Change Password?</a>
                </p>
            </div>
        </form>
    </x-card>
</x-layout>
