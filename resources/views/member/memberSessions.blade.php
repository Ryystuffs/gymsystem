<x-membernav>

    <div class="p-7 flex flex-col items-center">
        <div class="p-4 md:flex-row md:items-center md:justify-between bg-none text-black">
            <h1 class="text-white text-3xl font-bold md:mb-0">My Sessions</h1>
        </div>
        <table class="m-7 min-w-[90%] bg-white mb-3 rounded-lg">
            <thead class="bg-[#1f2122] text-white h-12">
                <tr class="text-center text-lg">
                    <th>Name</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>

            <tbody>
                @foreach($sessions as $session)
                <tr class="text-center border-t border-gray-300 bg-[#f3f3f3]">
                    <td class="font-bold p-3">
                        {{ $user->name ?? 'N/A' }}
                    </td>
                    <td class="text-[#2d2eb4] text-xs">
                        {{ $session->check_in }}
                    </td>
                    <td class="text-[#2d2eb4] text-xs">{{ $session->check_out }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="min-w-full">
            {{ $sessions->links()}}
        </div>
    </div>
</x-membernav>
