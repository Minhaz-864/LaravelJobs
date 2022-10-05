<x-layout>
    {{-- {{ $userInfo }} --}}
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header>
            <h2 class="text-2xl font-bold text-center uppercase mb-1">
                Applicant Information
            </h2>
        </header>
        <hr>
        <hr>
        <form>
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">Name: </label>
                <label for="name" class="inline-block text-lg mb-2"><strong>{{ $userInfo->name }}</strong></label>
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email: </label>
                <label for="email" class="inline-block text-lg mb-2"><strong>{{ $userInfo->email }}</strong></label>
            </div>

            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Phone</label>
                <label for="phone" class="inline-block text-lg mb-2"><strong>{{ $userInfo->phone }}</strong></label>

            </div>


            <div class="mb-6">
                <label for="latest_degree" class="inline-block text-lg mb-2">Latest Degree:</label>
                <label for="latest_degree"
                    class="inline-block text-lg mb-2"><strong>{{ $userInfo->latest_degree }}</strong></label>

            </div>

            <div class="mb-6">
                <label for="latest_institute" class="inline-block text-lg mb-2">Latest Institute: </label>
                <label for="latest_institute"
                    class="inline-block text-lg mb-2"><strong>{{ $userInfo->latest_institute }}</strong></label>

            </div>

            <div class="mb-6">
                <label for="present_address" class="inline-block text-lg mb-2">Present Address: </label>
                <label for="present_address"
                    class="inline-block text-lg mb-2"><strong>{{ $userInfo->present_address }}</strong></label>

            </div>

            <div class="mb-6">
                <label for="cover_letter" class="inline-block text-lg mb-2">
                    Cover Letter
                </label>

                <textarea disabled class="border border-gray-200 rounded p-2 w-full" name="cover_letter" rows="10"
                    placeholder="Your cover letter here">{{ $userInfo->cover_letter }}</textarea>

            </div>

            <div class="mb-6">
                <label for="cv" class="inline-block text-lg mb-2">
                    Curriculum vitae:
                </label>
                <label for="cv" class="inline-block text-lg mb-2">
                    @unless($userInfo->cv)
                    @else
                    <a href="{{asset($userInfo->cv)}}"><i class="fa fa-file text-lime-500" aria-hidden="true"></i><i></i> CV</a>
                
                    @endunless
                </label>

            </div>
        </form>
    </x-card>
</x-layout>
