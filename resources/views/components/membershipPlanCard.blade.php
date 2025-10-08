<div class="relative grid grid-cols-4 bg-white rounded-lg shadow-md p-5 mb-5 max-w-1xl mx-auto">
    <!-- Title -->
    <div>
        <a href="{{ route('admin.membership.showMembership', $membershipPlan->MembershipPlanID) }}">
            <h2 class="text-2xl font-semibold hover:text-blue-600 transition">
                {{ $membershipPlan->name }}
            </h2>
        </a>
    </div>

    <!-- Edit/Delete buttons -->
    <div class="absolute top-3 right-4 flex space-x-2">
        <a href="#" class="w-12 h-12 btn-secondary">
            <img src="{{ asset('/assets/edit.png') }}" alt="Edit" class="w-full h-full object-contain" />
        </a>
        <a href="#" class="w-12 h-12 btn-delete">
            <img src="{{ asset('/assets/delete.png') }}" alt="Delete" class="w-full h-full object-contain" />
        </a>
    </div>

    <!-- Slot for extra content -->
    {{ $slot }}
</div>
