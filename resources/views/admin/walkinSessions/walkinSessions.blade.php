<x-navigation>

    <table class="min-w-full bg-white border border-gray-300 mt-4 min-h-screen mb-3 rounded-lg overflow-hidden">
        <thead class="bg-blue-400 text-2xl text-white h-16">
        <tr class= "text-center">
            <td>ID</td>
            <td>name</td>
            <td>check_in</td>
            <td>check_out</td>
            <td>amount_paid</td>
            <td>payments_id</td>
        </tr>
        </thead>

        <tbody>
            @foreach($WalkinSessions as $WalkinSession)
            <tr class="text-center border-t border-gray-300">
                <td>{{$WalkinSession->id}}</td>
                <td class="font-bold">{{$WalkinSession->name}}</td>
                <td>{{$WalkinSession->check_in}}</td>
                <td>{{$WalkinSession->check_out}}</td>
                <td class="text-red-600">{{$WalkinSession->amount_paid}}</td>
                <td>{{$WalkinSession->payments_id}}</td>
            </tr>
                @endforeach
        </tbody>
    </table>
    <div>
        {{ $WalkinSessions->links() }}
    </div>
</x-navigation>