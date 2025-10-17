<x-navigation>

   <div class="flex justify-between p-5 ">
            <div>
                <h1 class="title-text">Walk-in Visitors</h1>
            </div>

            <a href="#"
                class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Add a new Visitor
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
                </tr>
            @endforeach
        </tbody>
    </table>

        <div>
            {{ $walkinSessions->links() }}
        </div>

</x-navigation>