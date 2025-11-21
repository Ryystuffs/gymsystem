<body class="bg-[#010001]">
    <x-navigation>
        <div class="pt-2 mt-2 pb-0 p-6">
            <div class="ml-2 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-black">
                <h1 class="title-text">Walk-In Sessions</h1>

                <div class="flex flex-row gap-2 mb-4">
                    <form action="{{ route('admin.walkin.search') }}" method="GET"
                        class="flex items-center space-x-2 bg-[#292626] rounded-lg px-3 py-1 shadow-sm w-full md:w-auto">
                        <input
                            class="border-none outline-none text-gray-700 placeholder-gray-400 bg-transparent w-full md:w-64"
                            type="search" id="search-input" name="q" placeholder="Search guest...">
                        <button type="submit"
                            class="bg-[#1f2122] hover:bg-[#3f3233] text-white font-semibold px-3 py-1 rounded-md transition">
                            Search
                        </button>
                    </form>

                    <a href="{{ route('admin.walkin.create') }}" class="back-button">
                        <h1 class="text-lg">Add Walk-In Guest</h1>
                    </a>
                </div>

            </div>

            <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mt-0 mb-0 rounded-lg overflow-hidden">
                <thead class="bg-[#4d3d3d] text-xl text-white h-16 ">
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
                            <td class="text-[#fdfdfd]">
                                {{ $walkinSession->payment_id ?? 'N/A' }}
                            </td>
                            <td class="font-bold text-[#fdfdfd]">
                                {{ $walkinSession->name }}
                            </td>
                            <td class="text-[#fdfdfd]">
                                {{ $walkinSession->amount_paid }}
                            </td>
                            <td class="text-[#fdfdfd]">{{ $walkinSession->check_in->format('M d, Y h:i A') }}</td>
                            <td class="text-[#fdfdfd]">{{ optional($walkinSession->check_out)->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="flex justify-center items-center space-x-2 p-2">
                                    <button type="submit" class="ml-6 w-12 h-12 btn-secondary edit-button"><img
                                            src="{{ asset('/assets/edit.png') }}" alt="Edit"
                                            class="w-full h-full object-contain" /></button>
                                    <form action="{{ route('admin.walkin.checkout', $walkinSession->id) }}" method="POST"
                                        class="checkout-form">
                                        @csrf
                                        @method('PUT')
                                        <button id="submitBtn" type="submit" class="w-12 h-12 btn-delete bg-[#4CAF50]"><img
                                                src="{{ asset('images/checkOut.png') }}" alt="Edit"
                                                class="w-full h-full object-contain" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 pt-5 bg-[#010001] text-white">
            {{ $walkinSessions->links('vendor.pagination.tailwind') }}
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4CAF50'
                    });
                });
            </script>
        @endif

        @if(session('checkout'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Success!',
                        text: "{{ session('checkout') }}",
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4CAF50'
                    });
                });
            </script>
        @endif

    </x-navigation>
</body>