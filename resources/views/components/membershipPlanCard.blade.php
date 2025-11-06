

<div class="relative min-h-[300px] bg-white rounded-lg shadow-md p-5 mb-5 min-w-full mx-auto">
    <!-- Title -->
    <div class="flex justify-between items-center mb-2">
        <div>
            <h2 class="text-3xl font-semibold text-[#2d2eb4]">
                {{ $membershipPlan->name }}
            </h2>
        </div>

        <!-- Edit/Delete buttons -->
        <div class="top-3 right-4 flex space-x-2">
                <button type="button" class="w-12 h-12 btn-secondary edit-button"
                    data-id="{{ $membershipPlan->id }}"
                    data-name="{{ $membershipPlan->name }}"
                    data-price="{{ $membershipPlan->price }}"
                    data-duration="{{ $membershipPlan->duration }}"
                    data-description="{{ $membershipPlan->description }}">
                <img src="{{ asset('/assets/edit.png') }}" alt="Edit" class="w-full h-full object-contain" />
            </button>


                <!-- Hidden form for update -->
            <form method="POST" action="{{ route('admin.membership.update', $membershipPlan->id) }}" class="edit-form hidden" id="edit-form-{{ $membershipPlan->id }}">
                @csrf
                @method('PUT')
                    <input type="hidden" name="name">
                    <input type="hidden" name="price">
                    <input type="hidden" name="duration">
                    <input type="hidden" name="description">
            </form>
            <form action="{{ route('admin.membership.destroy', $membershipPlan->id )}}" method="POST">
            @csrf
            @method('DELETE')
                <button type="button" class="w-12 h-12 btn-delete cursor-pointer">
                    <img src="{{ asset('/assets/delete.png') }}" alt="Delete" class="w-full h-full object-contain" />
                </button>
            </form>
        </div>
    
    </div>
    <div class="border-1 rounded-2xl min-h-[80%] p-4 bg-gray-50">
        <p class="text-lg text-gray-700 mb-2">
            <span class="font-semibold">Price:</span> Php {{ number_format($membershipPlan->price, 2) }}
        </p>
        <p class="text-lg text-gray-700 mb-2">
            <span class="font-semibold">Duration:</span> {{ $membershipPlan->duration }} days
        </p>
        <p class="text-lg text-gray-700">
            <span class="font-semibold">Description:</span> {{ $membershipPlan->description }}
        </p>
    </div>


    <script>
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const currentName = this.dataset.name;
                const currentPrice = this.dataset.price;
                const currentDuration = this.dataset.duration;
                const currentDescription = this.dataset.description;

                Swal.fire({
                    title: `Edit Membership Plan`,
                    html: `
                    <div class="mb-4">
                        <label for="swal-name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input id="swal-name" class="input-design" placeholder="Name" value="${currentName}">
                    </div>
                    <div class="mb-4">
                        <label for="swal-price" class="block text-sm font-medium text-gray-700">Price</label>
                        <input id="swal-price" type="number" class="input-design" placeholder="Price" value="${currentPrice}">
                    </div>    
                    <div class="mb-4">
                        <label for="swal-duration" class="block text-sm font-medium text-gray-700">Duration in Days</label>
                        <input id="swal-duration" type="number" class="input-design" placeholder="Duration (days)" value="${currentDuration}">
                    </div>
                    <div class="mb-4">
                        <label for="swal-description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="swal-description" class="input-design" placeholder="Description">${currentDescription}</textarea>
                    </div
                    `,
                    focusConfirm: false,
                    preConfirm: () => {
                        return {
                            name: document.getElementById('swal-name').value,
                            price: document.getElementById('swal-price').value,
                            duration: document.getElementById('swal-duration').value,
                            description: document.getElementById('swal-description').value,
                        };
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Edit',
                    confirmButtonColor: '#4CAF50',
                    cancelButtonText: 'Cancel',
                    cancelButtonColor: '#6c757d',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById(`edit-form-${id}`);
                        form.querySelector('input[name="name"]').value = result.value.name;
                        form.querySelector('input[name="price"]').value = result.value.price;
                        form.querySelector('input[name="duration"]').value = result.value.duration;
                        form.querySelector('input[name="description"]').value = result.value.description;
                        form.submit();
                    }
                });
            });
        });
        document.querySelectorAll('.btn-delete').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('form');

                    Swal.fire({
                        title: `Delete this Membership Plan?`,
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
