<div class="relative grid grid-cols-4 bg-white rounded-lg shadow-md p-5 mb-5 max-w-1xl mx-auto">
    <!-- Title -->
    <div>
        <h2 class="text-3xl font-semibold hover:text-blue-600 transition">{{ $userMembership->user->name }}</h2>

        <p class="text-red-600 text-2xl">
            {{  $userMembership->membershipPlan ? $userMembership->membershipPlan->name : 'N/A' }}
        </p>
        <p>Membership Start: {{ $userMembership->created_at}}</p>
        <p>Membership End: {{ $userMembership->expired_at }}</p>
        <p>@if($userMembership->is_active) Status: Active
        @else Status: Inactive @endif</p>
    </div>


    <!-- Edit/Delete buttons -->
    <div class="absolute top-3 right-4 flex space-x-2">
        
        <!-- Edit Button -->
        <button type="button" class="w-12 h-12 btn-secondary edit-button"
            data-member="{{ $userMembership->user->name }}"
            data-id="{{ $userMembership->id }}"
            data-name="{{ $userMembership->membershipPlan->name ?? '' }}"
            data-expired="{{ \Carbon\Carbon::parse($userMembership->expired_at)->format('Y-m-d') }}"
        >
            <img src="{{ asset('/assets/edit.png') }}" alt="Edit" class="w-full h-full object-contain" />
        </button>

        <!-- Hidden form for update -->
        <form method="POST" action="{{ route('admin.members.update', $userMembership->id) }}" class="edit-form hidden" id="edit-form-{{ $userMembership->id }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="name">
            <input type="hidden" name="membership_plan">
            <input type="hidden" name="expired_at">
        </form>

        <!-- Delete Button -->
        <form method="POST" action="{{ route('admin.members.destroy', $userMembership->id) }}" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="button" class="w-12 h-12 btn-delete" data-member="{{ $userMembership->user->name }}">
                <img src="{{ asset('/assets/delete.png') }}" alt="Delete" class="w-full h-full object-contain" />
            </button>
        </form>


        <script>

            document.querySelectorAll('.edit-button').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const currentPlan = this.dataset.name;
                    const currentExpired = this.dataset.expired;
                    const memberName = this.dataset.member;

                    Swal.fire({
                        title: `Edit ${memberName} Membership`,
                        html: `
                    <input id="swal-plan" class="swal2-input" placeholder="Membership Plan" value="${currentPlan}">
                    <input id="swal-expired" type="date" class="swal2-input" value="${currentExpired}" readonly>
                `,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        cancelButtonText: 'Cancel',
                        focusConfirm: false,
                        preConfirm: () => {
                            const plan = document.getElementById('swal-plan').value;
                            const expired = document.getElementById('swal-expired').value;

                            if (!plan || !expired) {
                                Swal.showValidationMessage('All fields are required.');
                                return false;
                            }

                            return { plan, expired};
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            const form = document.getElementById(`edit-form-${id}`);
                            form.querySelector('input[name="membership_plan"]').value = result.value.plan;
                            form.querySelector('input[name="expired_at"]').value = result.value.expired;

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </div>

    <!-- Slot for extra content -->
    {{ $slot }}
</div>