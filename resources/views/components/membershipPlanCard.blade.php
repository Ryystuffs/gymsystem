<div class="relative bg-[#292626] rounded-xl shadow-lg p-6 mb-6 w-full mx-auto text-[#fdfdfd]">

    <div class="flex justify-between items-center border-b border-[#3a3838] pb-3 mb-4">
        <h2 class="text-3xl font-semibold">{{ $membershipPlan->name }}</h2>

        <div class="flex items-center space-x-3">

            <button type="button" class="p-2.5 rounded-lg bg-[#c3a06a] hover:bg-[#e0a752] btn-secondary transition edit-button"
                data-id="{{ $membershipPlan->id }}"
                data-name="{{ $membershipPlan->name }}"
                data-price="{{ $membershipPlan->price }}"
                data-duration="{{ $membershipPlan->duration }}"
                data-description="{{ $membershipPlan->description }}">
                <img src="{{ asset('/assets/edit.png') }}"
                    alt="Edit"
                    class="w-6 h-6 object-contain" />
            </button>

            <!-- Hidden form -->
            <form method="POST" action="{{ route('admin.membership.update', $membershipPlan->id) }}"
                class="edit-form bg-[#292626] hidden" id="edit-form-{{ $membershipPlan->id }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="name">
                <input type="hidden" name="price">
                <input type="hidden" name="duration">
                <input type="hidden" name="description">
            </form>

            <form action="{{ route('admin.membership.destroy', $membershipPlan->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="p-2.5 rounded-lg hover:bg-[#ad1f26] transition btn-delete">
                    <img src="{{ asset('/assets/delete.png') }}"
                        alt="Delete"
                        class="w-6 h-6 object-contain" />
                </button>
            </form>
        </div>
    </div>

    <div class="space-y-4">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="p-4 bg-[#353232] rounded-lg shadow-sm">
                <p class="text-sm font-medium text-gray-300">PRICE</p>
                <p class="text-xl font-semibold mt-1">Php {{ number_format($membershipPlan->price, 2) }}</p>
            </div>

            <div class="p-4 bg-[#353232] rounded-lg shadow-sm">
                <p class="text-sm font-medium text-gray-300">DURATION</p>
                <p class="text-xl font-semibold mt-1">{{ $membershipPlan->duration }} days</p>
            </div>
        </div>

        <div class="p-4 bg-[#353232] rounded-lg shadow-sm">
            <p class="text-sm font-medium text-gray-300">DESCRIPTION</p>
            <p class="text-lg mt-1">{{ $membershipPlan->description }}</p>
        </div>

    </div>

    <!-- Slot -->
    <div class="mt-6">
        {{ $slot }}
    </div>

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
                <div class="text-left bg-[#292626] p-4 rounded-lg">
                    <label for="swal-name" class="block mb-1 font-medium text-[#fdfdfd]">Name</label>
                    <input id="swal-name" class="swal-input" value="${currentName}"><br>

                    <label for="swal-price" class="block mb-1 font-medium text-[#fdfdfd]">Price</label>
                    <input id="swal-price" type="number" class="swal-input" value="${currentPrice}"><br>

                    <label for="swal-duration" class="block mb-1 font-medium text-[#fdfdfd]">Duration (days)</label>
                    <input id="swal-duration" type="number" class="swal-input" value="${currentDuration}"><br>

                    <label for="swal-description" class="block mb-1 font-medium text-[#fdfdfd]">Description</label>
                    <textarea id="swal-description" class="swal-input">${currentDescription}</textarea>
                </div>
            `,
            preConfirm: () => ({
                name: document.getElementById('swal-name').value,
                price: document.getElementById('swal-price').value,
                duration: document.getElementById('swal-duration').value,
                description: document.getElementById('swal-description').value,
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
            background: '#292626',
            color: '#fdfdfd',
        }).then(result => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
