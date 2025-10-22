<x-navigation>
    <div class="flex justify-between p-5 ">
        <h1 class="title-text">WalkinSession</h1>
        <a href="{{ route('admin.walkin.create') }}" class="back-button">
            Add Walk-In Guest
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-300 mt-4 min-h-screen mb-3 rounded-lg overflow-hidden">
        <thead class="bg-blue-400 text-2xl text-white h-16 ">
            <tr class="text-center ">
                <th>Payment ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Check-in Time</th>
                <th>Check-out Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($walkinSessions as $walkinSession)
                <tr class="text-center border-t border-gray-300">
                    <td>
                        {{ $walkinSession->payment_id ?? 'N/A' }}
                    </td>
                    <td class="font-bold">
                        {{ $walkinSession->name }}
                    </td>
                    <td class="text-red-600">
                        {{ $walkinSession->amount_paid }}
                    </td>
                    <td>{{ $walkinSession->check_in }}</td>
                    <td>{{ $walkinSession->check_out }}</td>
                    <td>
                        <form action="`{{ route('admin.walkin.edit', $walkinSession->id) }}" method="POST">
                            @csrf
                            @method('GET')
                            
                            <button type="submit" class="text-blue-600 hover:underline">Edit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $walkinSessions->links() }}
    </div>

</x-navigation>