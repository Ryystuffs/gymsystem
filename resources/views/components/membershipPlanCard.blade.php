<div class="flex justify justify-between bg-white rounded-lg shadow-md p-5 mb-5 w-11/12 mx-auto">
    <div >
        <a href="{{ route('admin.membership.showMembership', $membershipPlan->MembershipPlanID) }}"><h2 class="text-2xl font-semibold mb-3">{{ $membershipPlan->name }}</h2></a>
        <p class="text-gray-600 mb-2">Price: Php{{ $membershipPlan->price }}</p>
        <p class="text-gray-600 mb-2">Duration: {{ $membershipPlan->duration }} months</p>
        <p class="text-gray-600">Description: {{ $membershipPlan->description }}</p>
    </div>

    <div class="flex flex-col align-center w-15 h-15 space-y-1">
        <a href="#" class="btn-secondary"><img src="{{ asset('/assets/edit.png') }}" alt="Edit"></a>
        <a href="#" class="btn-delete"><img src="{{ asset('/assets/delete.png') }}" alt="Delete"></a>
    </div>

    {{ $slot }}
</div>