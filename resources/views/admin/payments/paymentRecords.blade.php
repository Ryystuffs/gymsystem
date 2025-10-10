<x-navigation>
    <h1>Payment Records</h1>
    <p>Welcome to the payment records page!</p>

    <table class="min-w-full bg-white border border-gray-300 mt-4 min-h-screen mb-3 rounded-lg overflow-hidden"> 
        <thead class="bg-blue-400 text-2xl text-white h-16 ">
            <tr class="text-center ">
                <th>Name</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Type</th>
                <th>Created At</th>
                <th>Membership Plan ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr class="text-center border-t border-gray-300">
                    <td class="font-bold">
                        {{ $payment->user->name ?? $payment->walkinSession->name ?? 'N/A' }}
                    </td>
                    <td class="text-red-600">
                        {{ $payment->amount ?? $payment->walkinSession->amount_paid ?? '0' }}
                    </td>
                    <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                    <td>{{ $payment->type ?? 'N/A' }}</td>
                    <td>{{ $payment->created_at }}</td>
                    <td>
                        {{ $payment->membership_plans_id ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <div>
            {{ $payments->links() }}
        </div>

    

</x-navigation>