<x-navigation>
    <div class="flex justify-between p-5 ">
        <h1 class="title-text">WalkinSession</h1>
        <a href="{{ route('admin.walkin.create') }}" class="back-button">
            <h1 class="text-xl">Add Walk-In Guest</h1>
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-300 mt-0 mb-3 rounded-lg overflow-hidden">
        <thead class="bg-[#057dcd] text-2xl text-white h-16 ">
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
                        <div class="flex justify-center items-center space-x-2 p-2">
                            <form action="#" method="POST">
                                @csrf
                                @method('GET')
                                <button type="submit" class="ml-6 w-12 h-12 btn-secondary edit-button"><img
                                        src="{{ asset('/assets/edit.png') }}" alt="Edit"
                                        class="w-full h-full object-contain" /></button>
                            </form>
                            <form action="#" method="POST">
                                @csrf
                                @method('GET')
                                <button type="submit" class="w-12 h-12 btn-delete bg-[#4CAF50]"><img
                                        src="{{ asset('images/checkOut.png') }}" alt="Edit"
                                        class="w-full h-full object-contain" /></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $walkinSessions->links() }}
    </div>

</x-navigation>