<x-navigation>
    <h1 class="title-text text-center">Payment Records</h1>

    
        <table class="min-w-full bg-white border border-gray-300 mt-4 mb-3 rounded-lg overflow-hidden"> 
            <thead class="bg-blue-400 text-2xl text-white h-16 ">
                <tr class="text-center">
                        <th>Name</th>
                        <th>check In</th>
                        <th>check Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($memberSessions as $memberSession)
                    <tr class="text-center border-t border-gray-300">
                    <td class="font-bold p-4">
                        {{ $memberSession->userMembership->user->name ?? 'N/A' }}
                    </td>
                    <td class="text-red-600">
                        {{ $memberSession->check_in }}
                    </td>
                    <td>{{ $memberSession->check_out }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</x-navigation>