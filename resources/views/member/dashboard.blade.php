<x-membernav>

    <div class="px-3 pt-10">

        <div class="mb-6 ">
            <h1 class="text-2xl ">Welcome back, {{Auth::user()->name}}</h1>
        </div>

        <div class="flex flex-col items-center justify-center">
            <div class="p-2 md:flex-row md:items-center md:justify-between bg-none text-black">
                <h1 class="text-black text-xl font-bold md:mb-0">My Sessions</h1>
            </div>
            <table class="m-3 min-w-[90%] bg-white mb-7 border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-[#1f2122] text-white h-12">
                    <tr class="text-center text-sm">
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($sessions as $session)
                    <tr class="text-center border-t border-gray-300 bg-[#f3f3f3]">
                        <td class="text-[#2d2eb4] text-xs p-3">
                            {{ $session->check_in->format('M d, Y') }}
                        </td>
                        <td class="text-[#2d2eb4] text-xs p-3">
                            {{ $session->check_in->format('H:m:s') }}
                        </td>
                        <td class="text-[#2d2eb4] text-xs">
                            {{ optional($session->check_out)->format('H:m:s') ?? 'Working out...' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="min-w-full">
                {{ $sessions->links()}}
            </div>
        </div>
    </div>
</x-membernav>
