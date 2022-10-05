<x-layout>
    <x-card class="p-10">
        <div class="flex justify-around">
            <button class="{{$page == 'rejected'? 'text-laravel' : 'text-black' }}" ><i class="fa-solid fa-trash"></i> 
                <a href="/admin/rejected">Rejected</a></button>
            <button class="{{$page == 'pending'? 'text-laravel' : 'text-black' }}"><i class="fa-solid fa-user"></i> 
                <a href="/admin">Pending</a></button>
            <button class="{{$page == 'accepted'? 'text-laravel' : 'text-black' }}"><i class="fa-solid fa-trash"></i> 
                <a href="/admin/accepted">Accepted</a></button>
            
        </div>

        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Company Applications
            </h1>
        </header>


        <table class="w-full content-end table-auto rounded-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Trade Lincense Number</th>
                    <th>Trade Lincense File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @unless($users->isEmpty())
                    @foreach ($users as $user)
                        {{-- @php
                            $profile = \App\Models\Applicant::find($listing->applicant_id)
                        @endphp --}}
                        
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{-- <a href="/listings/{{ $listing['id'] }}">
                                    {{ $listing->title }}
                                </a> --}}
                                {{$user->name}}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">

                                {{ $user->email }}

                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $user->phone }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{ $user->address }}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">

                                {{ $user->tradelicense }}

                            </td>
                            <td class="px-4 py-8 border-t text-center border-b border-gray-300 text-lg">

                                @if($user->tradelicensefile)
                                <a href="{{asset($user->tradelicensefile)}}"><i class="fa fa-file" aria-hidden="true"></i></a>
                                @endif

                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                @if($page == 'accepted' || $page == 'pending')
                                <a href="/admin/reject/{{ $user->id }}">
                                    <button class="text-red-900">
                                        Reject
                                    </button>
                                </a>
                                @endif
                                <i>|</i>
                                @if($page == 'rejected' || $page == 'pending')
                                <a href="/admin/accept/{{ $user->id }}">
                                    <button class="text-lime-500">

                                        Accept
                                    </button>
                                </a> 
                                @endif
                                
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
                    {{ $users->links() }}
                </div>
            </tbody>
        </table>

    </x-card>

</x-layout>
