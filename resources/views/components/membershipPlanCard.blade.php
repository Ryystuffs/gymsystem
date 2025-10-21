

<div class="relative min-h-[300px] bg-white rounded-lg shadow-md p-5 mb-5 min-w-full mx-auto">
    <!-- Title -->
    <div class="flex justify-between items-center mb-2">
        <div>
            <h2 class="text-2xl font-semibold hover:text-blue-600 transition text-red-500">
                {{ $membershipPlan->name }}
            </h2>
        </div>

        <!-- Edit/Delete buttons -->
        <div class="top-3 right-4 flex space-x-2">
            <a href="#" class="w-12 h-12 btn-secondary">
                <img src="{{ asset('/assets/edit.png') }}" alt="Edit" class="w-full h-full object-contain" />
            </a>

            <form action="{{ route('admin.membership.destroy', $membershipPlan->id )}}" method="POST">
            @csrf

            @method('DELETE')
                <button type="submit" class="w-12 h-12 btn-delete">
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
    <!-- Slot for extra content -->
    {{ $slot }}
</div>
