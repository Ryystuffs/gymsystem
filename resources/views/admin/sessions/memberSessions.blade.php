<body class="bg-[#010001] px-4">
    <x-navigation>
        <div class="px-2 mb-5 mt-5 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-[#fdfdfd]">
            <h1 class="text-3xl font-bold mb-3 md:mb-0">Member Sessions</h1>

            <form action="{{ route('admin.sessions.search')}}" method="GET"
                class="flex items-center space-x-2 bg-[#292626] rounded-lg px-3 py-1 shadow-sm w-full md:w-auto">
                <input
                    class="border-none outline-none text-[#fdfdfd] placeholder-[#fdfdfd] bg-transparent w-full md:w-64"
                    type="search" id="search-input" name="q" value="{{ request('q')}}" placeholder="Search members...">
                <button type="submit"
                    class="bg-[#292626] hover:bg-[#3f3233] text-white font-semibold px-3 py-1 rounded-md transition">
                    Search
                </button>
            </form>
        </div>

        <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mb-3 rounded-lg overflow-hidden">
            <thead class="bg-[#4d3d3d] text-xl text-white h-16">
                <tr class="text-center">
                    <th>Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>

            <tbody>
                @foreach($memberSessions as $memberSession)
                    <tr class="text-center border-t border-gray-300">
                        <td class="text-[#fdfdfd] font-bold p-4">
                            {{ $memberSession->userMembership->user->name ?? 'N/A' }}
                        </td>
                        <td class="text-[#fdfdfd]">
                            {{ $memberSession->check_in }}
                        </td>
                        <td class="text-[#fdfdfd]">{{ $memberSession->check_out }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            {{ $memberSessions->links() }}
        </div>
    </x-navigation>
</body>