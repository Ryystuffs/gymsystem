<div class="flex flex-col justify-between relative bg-white rounded-lg shadow-md p-5 mb-5 min-w-full mx-auto">
    <!-- Title -->
    <div class="flex flex-col">
        <h2 class="text-3xl font-semibold hover:text-blue-600 transition">{{ $userMembership->user->name }}</h2>

        <p class="text-red-600 text-2xl ">
            {{  $userMembership->membershipPlan ? $userMembership->membershipPlan->name : 'N/A' }}
        </p>
        <p>Membership Start: {{ $userMembership->created_at->format('M d, Y') }}</p>
        <p>Membership End: {{ $userMembership->expired_at->format('M d, Y') }}</p>
        <p>@if($userMembership->is_active) Status: Active
        @else Status: Inactive @endif</p>
    </div>


    <!-- Edit/Delete buttons -->
    <div class="flex justify-end space-x-2">        
        <!-- Edit Button -->
        <button type="button" class="w-12 h-12 btn-secondary edit-button"
            data-member="{{ $userMembership->user->name }}"
            data-id="{{ $userMembership->id }}"
            data-name="{{ $userMembership->membershipPlan->name ?? '' }}"
            data-expired="{{ \Carbon\Carbon::parse($userMembership->expired_at)->format('Y-m-d') }}"
            data-amount="{{ $userMembership->membershipPlan->amount }}"
            data-payment="{{ $userMembership->membershipPlan->payment_method }}"
            data-user_id="{{ $userMembership->user_id }}"
        >
            <img src="{{ asset('/assets/edit.png') }}" alt="Edit" class="w-full h-full object-contain" />
        </button>

        <!-- Hidden form for update -->
        <form method="POST" action="{{ route('admin.members.update', $userMembership->id) }}" class="edit-form hidden" id="edit-form-{{ $userMembership->id }}">
            @csrf
            @method('PUT')  
                <input type="hidden" name="name">
                <input type="hidden" name="membership_plan_id">
                <input type="hidden" name="expired_at">
                <input type="hidden" name="amount">
                <input type="hidden" name="payment_method">
                <input type="hidden" name="user_id">
        </form>
        <!-- Delete Button -->
        <form method="POST" action="{{ route('admin.members.destroy', $userMembership->id) }}" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="button" class="w-12 h-12 btn-delete" data-member="{{ $userMembership->user->name }}">
                <img src="{{ asset('/assets/delete.png') }}" alt="Delete" class="w-full h-full object-contain" />
            </button>
        </form>
    </div>

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
                    <input id="swal-expired" type="date" class="swal2-input" value="${currentExpired}" readonly>
                    <select id="swal-plan" class="swal2-input">
                        <option value="" disabled>Select Membership Plan</option>
                        @foreach($membershipPlans as $plan)
                            <option value="{{ $plan->id }}" ${currentPlan === '{{ $plan->name }}' ? 'selected' : ''}>{{ $plan->name }}</option>
                        @endforeach
                    </select>
                    <select id="swal-payment" class="swal2-input">
                        <option value="" disabled Selected>Select Payment Method</option>
                        @foreach($payments->unique('payment_method') as $payment)
                            <option value="{{ $payment->payment_method }}">{{ $payment->payment_method }}</option>
                        @endforeach
                    </select>
                    <input id="swal-amount" type="hidden" class="swal2-input" value="${currentAmount}" readonly>
                `, 
                        showCancelButton: true,
                        confirmButtonText: 'Edit',
                        confirmButtonColor: '#4CAF50',
                        cancelButtonText: 'Cancel',
                        cancelButtonColor: '#6c757d',
                        focusConfirm: false,
                        preConfirm: () => {
                            const plan = document.getElementById('swal-plan').value;
                            const expired = document.getElementById('swal-expired').value;

                            if (!plan || !expired || !document.getElementById('swal-payment').value) {
                                Swal.showValidationMessage('All fields are required.');
                                return false;
                            }
                            
                            return { plan, expired};
                        },
                        didOpen: () => {
                            //changing the swal-expired according to the selected plan
                        const swalPlan = document.getElementById('swal-plan');
                        const swalExpired = document.getElementById('swal-expired');
                        
                        swalPlan.addEventListener('change', function() {
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
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    }); 
                });
            });

    </script>
    <!-- Slot for extra content -->
    {{ $slot }}
</div>