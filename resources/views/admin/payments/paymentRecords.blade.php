<body class="bg-[#010001] px-4">
    <x-navigation>
        <div class="pt-2 mt-5 pb-0 text-[#fdfdfd]">
            <div class="px-2 mb-5 mt-5 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-black">
                <h1 class="text-2xl font-bold mb-3 md:mb-0 text-[#fdfdfd]">Payment Records</h1>
                <form id="search-form" action="{{ route('admin.payments.search') }}" method="GET"
                    class="flex items-center space-x-2 bg-[#292626] rounded-lg px-3 py-1 shadow-sm w-full md:w-auto">
                    <div class="flex flex-row gap-2">
                        <div class="bg-[#292626] rounded-lg p-2 shadow-sm">
                            <input type="search" id="searchInput" name="q" value="" placeholder="Search payments..."
                                class="border-none outline-none text-[#fdfdfd] placeholder-[#fdfdfd] bg-transparent w-full md:w-64">
                            <a href="{{ route('admin.payments.index') }}"
                                class="bg-[#1f2122] hover:bg-[#3f3233] text-white font-semibold px-3 py-1 rounded-md mx-3 transition">
                                Clear
                            </a>
                            <select class="px-3 text-[#fdfdfd]" name="filters" id="type">
                                <option value="">All</option>
                                <option value="Membership">Member</option>
                                <option value="Walk-in">Walk-in</option>
                            </select>
                        </div>
                </form>
            </div>
        </div>


        <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mb-3 rounded-lg overflow-hidden">
            <thead class="bg-[#4d3d3d] text-xl text-white h-16">
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
                            {{ $payment->membershipPlan->name ?? 'Not a Member' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
        <div class="mt-6">
            {{ $payments->links() }}
        </div>


    </x-navigation>
</body>