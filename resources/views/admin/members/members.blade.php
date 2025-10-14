<x-navigation>

    @if(session('created'))
            <div class="flex justify-center items-center text-center text-3xl text-green-500 p-5 mb-5 max-w-1xl">
                {{session('created')}}
            </div>
    @endif
    @if(session('deleted'))
            <div class="flex justify-center items-center text-center text-3xl text-red-500 p-5 mb-5 max-w-1xl">
                {{session('deleted')}}
            </div>
    @endif
    <div>
        <div class="flex justify-between p-5 ">
            <div>
                <h1 class="title-text">Members</h1>
            </div>

            <a href="{{ route('admin.members.createMembers') }}" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Add New Member
            </a>

            
        </div>

        



        @foreach($userMemberships as $userMembership)
            <x-membersCard :userMembership="$userMembership">
            </x-membersCard>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $userMemberships->links() }}
    </div>
</x-navigation>
