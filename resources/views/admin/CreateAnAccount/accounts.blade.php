<x-navigation>


    <div class="p-4 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-black">
        <h1 class="text-2xl font-bold mb-3 md:mb-0">Accounts</h1>

        <form action="/search" method="get"
            class="flex items-center space-x-2 bg-white rounded-lg px-3 py-1 shadow-sm w-full md:w-auto">
            <input class="border-none outline-none text-gray-700 placeholder-gray-400 bg-transparent w-full md:w-64"
                type="search" id="search-input" name="q" placeholder="Search accounts...">
            <button type="submit"
                class="bg-[#1f2122] hover:bg-[#3f3233] text-white font-semibold px-3 py-1 rounded-md transition">
                Search
            </button>
        </form>
    </div>

    <table class="min-w-full bg-white border border-gray-300 mb-3 rounded-lg overflow-hidden">
        <thead class="bg-[#1f2122] text-xl text-white h-16 ">
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