<body class="bg-[#010001] px-4">
    <x-navigation>
        <div class="mb-5 mt-5 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-[#fdfdfd]">
            <h1 class="text-3xl font-bold mb-3 md:mb-0">Accounts</h1>
        </div>

        <div
            class="flex flex-col md:flex-row justify-between items-center md:items-end mb-5 mt-7 space-y-4 md:space-y-0">

            <div class="flex flex-wrap items-center gap-2">

                <form method="GET" class="flex flex-col space-x-1 mb-0">

                    <div class="mb-3">
                        <span class="text-white">Filter By: </span>
                        <input type="text" name="name" value="{{ $filters['user'] ?? '' }}" placeholder="Search name..."
                            class="ml-3 h-8 w-52 px-3 py-2 rounded-lg bg-[#403c3c] text-white placeholder-gray-300 border border-[#505050] focus:border-[#7a7adb] focus:outline-none transition">
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
                            <a href="{{ route('admin.createAnAccount.index') }}">
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