@section('pageTitle', 'Dashboard')
@section('title', 'GainLab')
<div>
    <div class="mb-5 mt-5 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-[#fdfdfd]">
        <h1 class="text-3xl font-bold mb-3 md:mb-0">Payment Records</h1>
    </div>

    <div
        class="flex flex-col md:flex-row justify-between items-center md:items-end mb-5 mt-7 space-y-4 md:space-y-0">

        <div class="flex flex-wrap items-center gap-2">

            <form method="GET" class="flex flex-col space-x-1 mb-0">

                <div class="mb-3 flex flex-wrap gap-4">
                    <div>
                        <span class="text-white">Filter By: </span>
                        <input type="text" name="name" value="{{ $filters['user'] ?? '' }}"
                            placeholder="Search name..."
                            class="ml-3 h-10 w-52 px-3 py-2 rounded-lg bg-[#403c3c] text-white placeholder-gray-300 border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">
                    </div>
                    <div>
                        <select name="type"
                            class="h-10 w-38 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">
                            <option value="Payment Type" disabled selected>Payment Type</option>
                            <option value="">All</option>
                            <option value="Membership" {{ ($filters['type'] ?? '') == 'Membership' ? 'selected' : '' }}>Membership</option>
                            <option value="Walk-in" {{ ($filters['type'] ?? '') == 'Walk-in' ? 'selected' : '' }}>
                                Walk-in</option>
                        </select>

                        <select name="payment_method"
                            class="ml-3 h-10 w-44 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">
                            <option value="Payment Method" disabled selected>Payment Method</option>
                            <option value="">All</option>
                            <option value="Cash" {{ ($filters['payment_method'] ?? '') == 'Cash' ? 'selected' : '' }}>
                                Cash</option>
                            <option value="GCash" {{ ($filters['payment_method'] ?? '') == 'GCash' ? 'selected' : '' }}>GCash</option>
                        </select>

                    </div>

                </div>

                <div class="flex flex-row space-x-1 mb-0">
                    <span class="text-white">Start Date:</span>
                    <input type="date" name="start" value="{{ $filters['start'] ?? '' }}"
                        class="h-8 w-37 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                    <span class="text-white ml-3">End Date:</span>
                    <input type="date" name="end" value="{{ $filters['end'] ?? '' }}"
                        class="h-8 w-37 px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                    <button type="submit"
                        class="h-8 w-20  bg-[#403c3c] hover:bg-[#5d5a5a] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition rounded-lg">
                        Filter
                    </button>

                    <button
                        class="h-8 w-20 bg-[#292626] hover:bg-[#5d5a5a] text-white border border-[#393535] focus:border-[#7a7adb] focus:outline-none transition rounded-lg">
                        <a href="{{ route('admin.payments.index') }}">
                            Reset
                        </a>
                    </button>
                </div>
            </form>
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

</div>