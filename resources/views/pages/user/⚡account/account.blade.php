@section('pageTitle', 'Account Details')
@section('title', 'Walk-In Sessions | GainLab')
<div>
    <div class="min-h-screen bg-[#151f2f] p-5">

        <div class="max-w-md mt-8 mx-auto flex flex-col gap-6">

            <div class="bg-[#1f2839] text-white p-6 rounded-2xl shadow-xl flex items-center gap-4">
                <div class=" bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-20">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                            clip-rule="evenodd" />
                    </svg>

                </div>
                <div>
                    <h2 class="text-xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-white">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="bg-[#1f2839] text-white p-6 rounded-2xl shadow-lg space-y-3">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-lg font-semibold">Membership Details</h3>
                </div>

                <div class="flex justify-between text-sm text-gray-300">
                    <span>Start Date:</span>
                    <span class="font-semibold">{{ $membership->created_at->format('M d, Y') }}</span>
                </div>

                <div class="flex justify-between text-sm text-gray-300">
                    <span>Expiry Date:</span>
                    <span class="font-semibold">{{ $membership->expired_at->format('M d, Y') }}</span>
                </div>

                <div class="flex items-center mt-10 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="yellow"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                    </svg>

                    <h3 class="text-lg font-semibold">Active Plan</h3>
                </div>

                <p class="text-white font-semibold">{{ $membership->membershipPlan->name }}</p>
                <p class="text-gray-400 text-sm leading-relaxed"><span class="text-sm text-gray-300 font-bold">Exclusive Perks
                        Included: </span>{{ $membership->membershipPlan->description }}</p>

                <div class="mt-3 flex items-center gap-2 text-yellow-400">
                </div>
            </div>

        </div>
    </div>
</div>