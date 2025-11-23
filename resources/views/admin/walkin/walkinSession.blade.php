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
                <thead class="bg-[#403c3c] text-xl text-white h-16 ">
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
                                        class="p-2.5 rounded-lg bg-[#c3a06a] hover:bg-[#e0a752] btn-secondary transition edit-button"
                                        data-id="{{ $walkinSession->id }}" data-name="{{ $walkinSession->name }}"
                                        data-price="{{ $walkinSession->check_in }}"
                                        data-duration="{{ $walkinSession->check_out }}"
                                        data-description="{{ $walkinSession->amount_paid }}">
                                        <img src="{{ asset('/assets/edit.png') }}" alt="Edit"
                                            class="w-6 h-6 object-contain" />
                                    </button>

                                    <form action="{{ route('admin.walkin.checkout', $walkinSession->id) }}" method="POST"
                                        class="checkout-form">
                                        @csrf
                                        @method('PUT')
                                        <button id="submitBtn" type="submit"
                                            class="w-12 h-12 btn-delete bg-[#676fd4] hover:bg-[#525be0]"><img
                                                src="{{ asset('images/checkOut.png') }}" alt="Edit"
                                                class="w-full h-full object-contain" /></button>
                                    </form>

                                    <!-- Hidden form for edit -->
                                    <form method="POST" action="{{ route('admin.walkin.update', $walkinSession->id)}}"
                                                class=" edit-form bg-[#292626] hidden" id="edit-form-{{ $walkinSession->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name">
                                        <input type="hidden" name="checkin">
                                        <input type="hidden" name="checkout">
                                        <input type="hidden" name="amountpaid">
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
            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const currentName = this.dataset.name;
                    const currentCheckin = this.dataset.checkin;
                    const currentCheckout = this.dataset.checkout;
                    const currentAmountPaid = this.dataset.amountpaid;

                    Swal.fire({
                        title: `Edit Membership Plan`,
                        html: `
                <div class="text-left bg-[#292626] p-4 rounded-lg">
                    <label for="swal-name" class="block mb-1 font-medium text-[#fdfdfd]">Name</label>
                    <input id="swal-name" class="swal-input" value="${currentName}"><br><br>

                    <label for="swal-price" class="block mb-1 font-medium text-[#fdfdfd]">Check In</label>
                    <input id="swal-checkin" type="number" class="swal-input" value="${currentCheckin}"><br><br>

                    <label for="swal-duration" class="block mb-1 font-medium text-[#fdfdfd]">Check Out</label>
                    <input id="swal-checkout" type="number" class="swal-input" value="${currentCheckout}"><br><br>

                    <label for="swal-description" class="block mb-1 font-medium text-[#fdfdfd]">Amount Paid</label>
                    <input id="swal-amountpaid" class="swal-input">${currentAmountPaid}</input>
                </div>
            `,
                        preConfirm: () => ({
                            name: document.getElementById('swal-name').value,
                            price: document.getElementById('swal-checkin').value,
                            duration: document.getElementById('swal-checkout').value,
                            description: document.getElementById('swal-amountpaid').value,
                        }),
                        showCancelButton: true,
                        confirmButtonColor: '#4CAF50',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Edit',
                        background: '#292626',
                        color: '#fdfdfd'
                    }).then(result => {
                        if (result.isConfirmed) {
                            const form = document.getElementById(`edit-form-${id}`);
                            form.querySelector('input[name="name"]').value = result.value.name;
                            form.querySelector('input[name="checkin"]').value = result.value.checkin;
                            form.querySelector('input[name="checkout"]').value = result.value.checkout;
                            form.querySelector('input[name="amountpaid"]').value = result.value.amountpaid;
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