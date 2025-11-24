<x-membernav>
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 p-5 text-white">

        <div class="mb-6 mt-8">
            <h1 class="text-xl md:text-xl font-bold">Welcome back, {{ Auth::user()->name }}</h1>
        </div>

        <div class="flex flex-col mt-7 gap-4">

            <h2 class="text-lg font-semibold text-gray-300 flex items-center gap-2">
                My Sessions
            </h2>

            <div class="flex flex-col gap-4">
                @foreach($sessions as $session)
                    <div
                        class="bg-gray-800 p-4 rounded-2xl shadow-md flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">

                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-200 text-sm font-medium">
                                <span>Date: </span>{{ $session->check_in->format('M d, Y') }}
                            </span>
                        </div>

                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-200 text-sm">
                                <span>Check-In: </span>{{ $session->check_in->format('H:i:s') }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>

                            <span class="text-gray-200 text-sm">
                                <span>Check-Out: </span> {{ optional($session->check_out)->format('H:i:s') ?? 'Working out...' }}
                                </span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $sessions->links() }}
            </div>

        </div>

    </div>
</x-membernav>