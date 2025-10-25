<x-navigation>
    
    
    <h1 class="title-text text-center">Accounts</h1>

    <table class="min-w-full bg-white border border-gray-300 mt-4 mb-3 rounded-lg overflow-hidden"> 
        <thead class="bg-blue-400 text-2xl text-white h-16 ">
            <tr class="text-center">
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="text-center border-t border-gray-300">
                    <td class="font-bold p-4">
                        {{ $user->name }}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
        <div>
            {{ $users->links() }}
        </div>

</x-navigation>