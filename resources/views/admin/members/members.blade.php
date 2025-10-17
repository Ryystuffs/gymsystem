<x-navigation>

    @if(session('created'))
        <div class="flex justify-center items-center text-center text-3xl text-green-500 p-5 mb-5 max-w-1xl">
            {{session('created')}}
        </div>
    @endif
    @if(session('deleted'))
        <div id="deleted-message"
            class="flex justify-center items-center text-center text-3xl text-red-500 p-5 mb-5 max-w-1xl">
            {{ session('deleted') }}
        </div>

        <script>
            setTimeout(() => {
                const msg = document.getElementById('deleted-message');
                if (msg) {
                    msg.style.display = 'none';
                }
            }, 6000);
        </script>
    @endif
    <div>
        <x-intronav name="Members" button="Add a New Member">
        </x-intronav>
        
        @foreach($userMemberships as $userMembership)
            <x-membersCard :userMembership="$userMembership">
            </x-membersCard>
        @endforeach
    </div>

    <div class="mt-5">
        {{ $userMemberships->links() }}
    </div>
</x-navigation>
