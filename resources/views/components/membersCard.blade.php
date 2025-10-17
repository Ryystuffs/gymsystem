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
        <form action="">
            <button class="w-12 h-12 btn-secondary">
                <img src="{{ asset('/assets/edit.png') }}" alt="Edit" class="w-full h-full object-contain" />
            </button>
        </form>
        <form method="POST" action="{{ route('admin.members.destroy', $userMembership->id) }}" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="button" class="w-12 h-12 btn-delete delete-button"
                data-member="{{ $userMembership->user->name }}">
                <img src="{{ asset('/assets/delete.png') }}" alt="Delete" class="w-full h-full object-contain" />
            </button>
        </form>


        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
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