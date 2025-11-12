<x-navigation>
    <div class="p-3">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4">

            <div class="flex items-center gap-4 p-0 bg-white">
                <div class="p-3 bg-blue-200">
                    <img src="{{ asset('images/memberBlack.png') }}" alt="Members Icon" class="w-20 h-20">
                </div>
                <div class="m-2">
                    <h3 class="text-lg font-semibold text-gray-700">Total Members</h3>
                    <p class="text-2xl font-bold text-indigo-600">11</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-0 bg-white">
                <div class="p-3 bg-green-200">
                    <img src="{{ asset('images/accountBlack.png') }}" alt="User Accounts Icon" class="w-20 h-20">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total User</h3>
                    <p class="text-2xl font-bold text-green-600">14</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-0 bg-white">
                <div class="p-3 bg-violet-200">
                    <img src="{{ asset('images/membershipBlack.png') }}" alt="Plans Icon" class="w-20 h-20">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Membership Plans</h3>
                    <p class="text-2xl font-bold text-violet-600">5</p>
                </div>
            </div>

            <div class="flex items-center gap-4 p-0 bg-white">
                <div class="p-3 bg-yellow-200">
                    <img src="{{ asset('images/revenueBlack.png') }}" alt="Plans Icon" class="w-20 h-20">
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700">Total Revenue</h3>
                    <p class="text-2xl font-bold text-yellow-600">₱ 25,320</p>
                </div>
            </div>
            
        </div>
    </div>
</x-navigation>