@section('pageTitle', 'Member List')
@section('title', 'GainLab')
<div>
    <div class="mt-5">

        <div class="ml-1 flex flex-col md:flex-row md:items-center md:justify-between bg-none text-black">
            <h1 class="title-text">Members</h1>
        </div>

        <div
            class="flex flex-col md:flex-row justify-between items-center md:items-end mb-5 mt-7 space-y-4 md:space-y-0">

            <div class="flex flex-wrap items-center gap-2">

                <form method="GET" class="flex flex-col space-x-1 mb-0">

                    <div class="mb-3">
                        <span class="text-white">Filter By: </span>
                        <input type="text" name="name" value="{{ $filters['user'] ?? '' }}"
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

                        <button
                            class="h-8 w-20 bg-[#292626] hover:bg-[#5d5a5a] text-white border border-[#393535] focus:border-[#7a7adb] focus:outline-none transition rounded-lg">
                            <a href="{{ route('admin.members.index') }}">
                                Reset
                            </a>
                        </button>
                    </div>
                </form>
            </div>

            <button
                class="back-button px-5 py-2 bg-[#676fd4] hover:bg-[#7d85ff] text-white font-semibold rounded-lg transition">
                <a href=" {{ route('admin.members.create') }}">
                    <span class="text-sm">Add New Member</span>
                </a>
            </button>

        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full bg-[#292626] border border-[#2d2eb4] mt-0 mb-0 rounded-lg overflow-hidden">
                <thead class="bg-[#403c3c] font-bold text-white h-14">
                    <tr class="text-center ">
                        <th>Name</th>
                        <th>Membership Plan</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($userMemberships as $userMembership)
                        <tr class="text-center border-t border-gray-600">
                            <td class="font-bold text-[#fdfdfd]">
                                {{ $userMembership->user->name }}
                            </td>

                            <td class="text-[#c9caff]">
                                {{ $userMembership->membershipPlan->name ?? 'N/A' }}
                            </td>

                            <td class="text-[#fdfdfd]">
                                {{ $userMembership->created_at->format('M d, Y') }}
                            </td>

                            <td class="text-[#fdfdfd]">
                                {{ $userMembership->expired_at->format('M d, Y') }}
                            </td>

                            <td class="">
                                @if($userMembership->is_active)
                                    <span class="text-green-400 font-semibold">Active</span>
                                @else
                                    <span class="text-red-400 font-semibold">Inactive</span>
                                @endif
                            </td>

                            <td>
                                <div class="flex justify-center items-center space-x-2 p-2">
                                    <!-- Edit -->
                                    <button
                                        class="p-2.5 rounded-lg bg-[#c3a06a] hover:bg-[#e0a752] btn-secondary transition edit-button"
                                        data-member="{{ $userMembership->user->name }}"
                                        data-id="{{ $userMembership->id }}"
                                        data-name="{{ $userMembership->membershipPlan->name ?? '' }}"
                                        data-expired="{{ \Carbon\Carbon::parse($userMembership->expired_at)->format('Y-m-d') }}"
                                        data-amount="{{ $userMembership->membershipPlan->amount }}"
                                        data-payment="{{ $userMembership->membershipPlan->payment_method }}"
                                        data-user_id="{{ $userMembership->user_id }}">
                                        <img src="{{ asset('/assets/edit.png') }}" class="w-6 h-6">
                                    </button>

                                    <!-- Hidden Edit Form -->
                                    <form method="POST"
                                        action="{{ route('admin.members.update', $userMembership->id) }}"
                                        class="edit-form hidden" id="edit-form-{{ $userMembership->id }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="membership_plan_id">
                                        <input type="hidden" name="expired_at">
                                        <input type="hidden" name="amount">
                                        <input type="hidden" name="payment_method">
                                        <input type="hidden" name="user_id">
                                    </form>

                                    <!-- Delete -->
                                    <form method="POST"
                                        action="{{ route('admin.members.destroy', $userMembership->id) }}"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="p-2.5 rounded-lg hover:bg-[#ad1f26] btn-secondary transition btn-delete"
                                            data-member="{{ $userMembership->user->name }}">
                                            <img src="{{ asset('/assets/delete.png') }}" class="w-6 h-6">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">
        {{ $userMemberships->links() }}
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('created'))
        <div class="flex justify-center items-center text-center text-3xl text-green-500 p-5 mb-5 max-w-1xl">
            {{session('created')}}
        </div>
    @endif

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

    @if(session('deleted'))
        <div id="deleted-message">
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    Swal.fire({
                        title: 'Success!',
                        text: "{{ session('deleted') }}",
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4CAF50',
                        background: '#292626',
                        color: '#fdfdfd',
                    });
                });
            </script>
        </div>
    @endif

    @if ($errors->any())
        <div id="validation-errors" class="hidden">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <script>
        const errorContainer = document.getElementById('validation-errors');
        if (errorContainer) {
            const messages = Array.from(errorContainer.querySelectorAll('p')).map(p => p.textContent);
            if (messages.length > 0) {
                Swal.fire({
                    title: 'Validation Error',
                    html: messages.join('<br>'),
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e3342f',
                    background: '#292626',
                    color: '#fdfdfd',
                });
            }
        }
    </script>


    {{-- Members script --}}
    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const currentPlan = this.dataset.name;
                const currentExpired = this.dataset.expired;
                const memberName = this.dataset.member;
                const currentAmount = this.dataset.amount;
                const currentPayment = this.dataset.payment;
                const membershipPlans = @json($membershipPlans);
                const userId = this.dataset.user_id;
                const payments = @json($payments);
                Swal.fire({
                    title: `Edit ${memberName} Membership`,
                    html: `
                <div class="text-left p-4">
                    <label for="swal-expired" class="block mb-1 font-medium text-[#fdfdfd]">Membership Expiration Date</label>
                    <input id="swal-expired" type="date" class="swal-input" value="${currentExpired}" readonly><br>

                    <label for="swal-plan" class="block mb-1 font-medium text-[#fdfdfd]">Membership Plan</label>
                    <select id="swal-plan" class="swal-input">
                        <option value="" disabled class="bg-[#292626]">Select Membership Plan</option>
                        @foreach($membershipPlans as $plan)
                            <option class="bg-[#292626]" value="{{ $plan->id }}" ${currentPlan === '{{ $plan->name }}' ? 'selected' : ''}>{{ $plan->name }}</option>
                        @endforeach
                    </select><br>

                    <label for="swal-payment" class="block mb-1 font-medium text-[#fdfdfd]">Payment Method</label>
                    <select id="swal-payment" class="swal-input">
                        <option value="" disabled Selected class="bg-[#292626]">Select Payment Method</option>
                        @foreach($payments->unique('payment_method') as $payment)
                            <option class="bg-[#292626]" value="{{ $payment->payment_method }}">{{ $payment->payment_method }}</option>
                        @endforeach
                    </select><br>

                    <label for="swal-amount" class="block mb-1 font-medium text-[#fdfdfd]">Amount</label>
                    <input id="swal-amount" type="number" class="swal-input" value="${currentAmount}" readonly>
                </div>
            `,
                    showCancelButton: true,
                    confirmButtonText: 'Edit',
                    confirmButtonColor: '#4CAF50',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#6c757d',
                    focusConfirm: false,
                    background: '#292626',
                    color: '#fdfdfd',
                    preConfirm: () => {
                        const plan = document.getElementById('swal-plan').value;
                        const expired = document.getElementById('swal-expired').value;

                        if (!plan || !expired || !document.getElementById('swal-payment').value) {
                            Swal.showValidationMessage('All fields are required.');
                            
                            const validationMsg = document.querySelector('.swal2-validation-message');
                            if (validationMsg) {
                                validationMsg.style.backgroundColor = '#292626'; // red background
                                validationMsg.style.color = '#fdfdfd'; // white text
                                validationMsg.style.padding = '5px 10px';
                                validationMsg.style.borderRadius = '5px';
                                validationMsg.style.textAlign = 'center';
                            }
                            return false;
                        }

                        return { plan, expired };

                    },
                    didOpen: () => {
                        //changing the swal-expired according to the selected plan
                        const swalPlan = document.getElementById('swal-plan');
                        const swalExpired = document.getElementById('swal-expired');

                        swalPlan.addEventListener('change', function () {
                            const selectedPlanId = this.value;
                            const selectedPlan = membershipPlans.find(plan => plan.id == selectedPlanId);
                            if (selectedPlan) {
                                const currentDate = new Date();
                                currentDate.setDate(currentDate.getDate() + selectedPlan.duration);
                                const year = currentDate.getFullYear();
                                const month = String(currentDate.getMonth() + 1).padStart(2, '0');
                                const day = String(currentDate.getDate()).padStart(2, '0');
                                swalExpired.value = `${year}-${month}-${day}`;

                                //update the amount field
                                const swalAmount = document.getElementById('swal-amount');
                                swalAmount.value = selectedPlan.price ?? '';
                                console.log('Amount updated to:', swalAmount.value);
                            }
                        });
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(`edit-form-${id}`);
                        form.querySelector('input[name="membership_plan_id"]').value = result.value.plan;
                        form.querySelector('input[name="expired_at"]').value = result.value.expired;
                        form.querySelector('input[name="amount"]').value = document.getElementById('swal-amount').value;
                        form.querySelector('input[name="payment_method"]').value = document.getElementById('swal-payment').value;
                        form.querySelector('input[name="user_id"]').value = userId;
                        console.log('User ID:', userId); // To verify it's being passed correctly
                        form.submit();
                    }
                });

            });
        });
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const memberName = this.dataset.member;

                Swal.fire({
                    title: `Delete ${memberName} Membership?`,
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true,
                    background: '#292626',
                    color: '#fdfdfd',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    </script>
</div>