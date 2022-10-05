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
           
            <div class="flex justify-around">
                <button type="submit" class="bg-slate-400 px-4 rounded"><a href="/company/applications">Back</a></button>
                
                <form action="/application/Accept/{{$userInfo->id}}" method="POST">
                    @csrf
                    <input type="text" hidden name="listing_id" value= {{$listing_id}}>
                    <button class="bg-lime-400 px-4 rounded" type="submit">Accept</button>
                </form>

                <form action="/application/Reject/{{ $userInfo->id}}" method="POST">
                    @csrf
                    <input type="text" hidden name="listing_id" value= {{$listing_id}}>
                    <button class="bg-red-400 px-4 rounded" type="submit">Reject</button>
                </form>
                
            </div>
        
    </x-card>
</x-layout>
