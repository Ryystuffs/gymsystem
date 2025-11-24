<body class="bg-[#010001] px-4">
    <x-navigation>
        <div class="mb-5 mt-5 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-[#fdfdfd]">
            <h1 class="text-3xl font-bold mb-3 md:mb-0">Accounts</h1>
        </div>

        <div class="flex justify-between items-start mb-3 mt-7">

            <div class="flex flex-row space-x-1">

                <input type="text" id="filter-name"
                    class="h-auto w-full px-3 py-2 rounded-lg bg-[#403c3c] text-white placeholder-gray-300 border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition"
                    placeholder="Search name...">

                <input type="date" id="filter-start"
                    class="h-auto w-full px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                <input type="date" id="filter-end"
                    class="h-auto w-full px-3 py-2 rounded-lg bg-[#403c3c] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">

                <button id="clearFilters"
                    class="w-sm px-6 py-2 bg-[#403c3c] hover:bg-[#5d5a5a] text-white border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition rounded-lg">
                    Clear Filters
                </button>
            </div>
        </div>

        <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mb-3 rounded-lg overflow-hidden">
            <thead class="bg-[#403c3c] font-bold text-white h-14">
                <tr class="text-center">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="text-center border-t border-gray-600">
                        <td class="text-[#fdfdfd] font-bold p-4">
                            {{ $user->name }}
                        </td>
                        <td class="text-[#fdfdfd]">{{ $user->email }}</td>
                        <td class="text-[#fdfdfd]">{{ $user->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-5">
            {{ $users->links() }}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4CAF50',
                        background: '#292626',
                        color: '#fdfdfd',
                    });
                });


            </script>

        @endif

    </x-navigation>
</body>