<body class="bg-[#010001]">
    <x-navigation>
        <div class="pt-2 mt-2 pb-0 p-6">
            <div class="ml-1 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-black">
                <h1 class="title-text">Walk-In Sessions</h1>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center md:items-end mb-5 mt-7 space-y-4 md:space-y-0">

                <div class="flex flex-wrap items-center gap-2">

                    <form method="GET" class="flex flex-col space-x-1 mb-0">

                        <div class="mb-3">
                            <span class="text-white">Filter By: </span>
                            <input type="text" name="name" value="{{ $filters['name'] ?? '' }}"
                                placeholder="Search name..."
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

                            <button class="h-8 w-20 bg-[#292626] hover:bg-[#5d5a5a] text-white border border-[#393535] focus:border-[#7a7adb] focus:outline-none transition rounded-lg">
                                <a href="{{ route('admin.walkin.index') }}"
                                    class="">
                                    Reset
                                </a>
                            </button>
                        </div>
                    </form>
                </div>

                <button
                    class="back-button px-5 py-2 bg-[#676fd4] hover:bg-[#7d85ff] text-white font-semibold rounded-lg transition">
                    <a href="{{ route('admin.walkin.create') }}">
                        <span class="text-sm">Add Walk-In Guest</span>
                    </a>
                </button>

            </div>


            <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mt-0 mb-0 rounded-lg overflow-hidden">
                <thead class="bg-[#403c3c] font-bold text-white h-14">
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
                        <tr class="text-center border-t border-gray-600">
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
                            <td class="text-[#fdfdfd]">{{ optional($walkinSession->check_out)->format('M d, Y h:i A') }}
                            </td>
                            <td>

                                <div class="flex justify-center items-center space-x-2 p-2">
                                    <button type="button"
                                        class="p-2.5 rounded-lg bg-[#c3a06a] hover:bg-[#e0a752] btn-secondary transition walkin-edit"
                                        data-id="{{ $walkinSession->id }}" data-name="{{ $walkinSession->name }}"
                                        data-amount_paid="{{ $walkinSession->amount_paid }}"
                                        data-payment_id="{{ $walkinSession->payment_id }}">
                                        <img src="{{ asset('/assets/edit.png') }}" alt="Edit"
                                            class="w-6 h-6 object-contain" />
                                    </button>

                                    <form action="{{ route('admin.walkin.checkout', $walkinSession->id) }}" method="POST"
                                        class="checkout-form">
                                        @csrf
                                        @method('PUT')
                                        <button id="submitBtn" type="submit"
                                            class="w-12 h-12 btn-delete bg-[#676fd4] hover:bg-[#525be0]"><img
                                                src="{{ asset('images/checkOut.png') }}" alt="Check Out"
                                                class="w-full h-full object-contain" /></button>
                                    </form>

                                    <!-- Hidden form for edit -->
                                    <form method="POST" action="{{ route('admin.walkin.update', $walkinSession->id)}}"
                                        class=" edit-form bg-[#292626] hidden" id="edit-form-{{ $walkinSession->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name">
                                        <input type="hidden" name="amount_paid">
                                        <input type="hidden" name="payment_id">
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
        <script>
            document.querySelectorAll('.walkin-edit').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const currentName = this.dataset.name;
                    const currentAmountPaid = this.dataset.amount_paid;
                    const currentPaymentId = this.dataset.payment_id;

                    Swal.fire({
                        title: `Edit ${currentName} Membership`,
                        html: `
                <div class="text-left bg-[#292626] p-4 rounded-lg">
                    <label for="swal-name" class="block mb-1 font-medium text-[#fdfdfd]">Name</label>
                    <input id="swal-name" class="swal-input" value="${currentName}"><br>

                    <label for="swal-amount_paid" class="block mb-1 font-medium text-[#fdfdfd]">Amount Paid</label>
                    <input id="swal-amount_paid" class="swal-input" value="${currentAmountPaid}"></input>
                    <input id="swal-payment_id" class="swal-input" value="${currentPaymentId}" hidden></input>
                </div>
            `,
                        preConfirm: () => ({
                            name: document.getElementById('swal-name').value,
                            amount_paid: document.getElementById('swal-amount_paid').value,
                            payment_id: document.getElementById('swal-payment_id').value
                        }),
                        showCancelButton: true,
                        confirmButtonColor: '#4CAF50',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Edit',
                        background: '#292626',
                        color: '#fdfdfd',
                    }).then(result => {
                        if (result.isConfirmed) {
                            const form = document.getElementById(`edit-form-${id}`);
                            form.querySelector('input[name="name"]').value = result.value.name;
                            form.querySelector('input[name="amount_paid"]').value = result.value.amount_paid;
                            form.querySelector('input[name="payment_id"]').value = result.value.payment_id;
                            form.submit();
                        }
                    });
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
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

        @if(session('checkout'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Success!',
                        text: "{{ session('checkout') }}",
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4CAF50',
                        background: '#292626',
                        color: '#fdfdfd',
                    });
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Error!',
                        text: "{{ session('error') }}",
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33',
                        background: '#292626',
                        color: '#fdfdfd',
                    });
                });
            </script>
        @endif

    </x-navigation>
</body>