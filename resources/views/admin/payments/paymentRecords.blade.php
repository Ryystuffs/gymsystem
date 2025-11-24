<body class="bg-[#010001] px-4">
    <x-navigation>
        <div class="mb-5 mt-5 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-[#fdfdfd]">
            <h1 class="text-3xl font-bold mb-3 md:mb-0">Payment Records</h1>
        </div>

        <div class="flex justify-between items-start mb-3 mt-7">

            <div class="flex flex-row space-x-1">

                <input type="text" id="filter-name"
                    class="h-auto w-full px-3 py-2 rounded-lg bg-[#403c3c] text-white placeholder-gray-300 border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition"
                    placeholder="Search name...">

                <input type="date" id="filter-start"
                    class="h-auto w-full px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                <input type="date" id="filter-end"
                    class="h-auto w-full px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                <button id="clearFilters"
                    class="w-sm px-6 py-2 bg-[#403c3c] hover:bg-[#5d5a5a] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition rounded-lg">
                    Clear Filters
                </button>
            </div>
        </div>

        <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mb-3 rounded-lg overflow-hidden">
            <thead class="bg-[#403c3c] font-bold text-white h-14">
                <tr class="text-center">
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Membership Plan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr class="text-center text-sm border-t border-gray-300">
                        <td class="text-[#fdfdfd] font-bold p-4">
                            {{ $payment->user->name ?? $payment->walkinSession->name ?? 'N/A' }}
                        </td>
                        <td class="text-[#fdfdfd]">
                            {{ $payment->amount ?? $payment->walkinSession->amount_paid ?? '0' }}
                        </td>
                        <td class="text-[#fdfdfd]">
                            {{ $payment->payment_method ?? 'N/A' }}
                        </td>
                        <td class="text-[#fdfdfd]">
                            {{ $payment->type ?? 'N/A' }}
                        </td>
                        <td class="text-[#fdfdfd]">
                            {{ $payment->created_at }}
                        </td>
                        <td class="text-[#fdfdfd]">
                            {{ $payment->membershipPlan->name ?? 'Walk-In Guest' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-5">
            {{ $payments->links() }}
        </div>


    </x-navigation>
</body>