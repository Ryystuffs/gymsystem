<div class="relative grid grid-cols-4 bg-white rounded-lg shadow-md p-5 mb-5 max-w-1xl mx-auto">
    <!-- Title -->
    <div>
            <h2 class="text-3xl font-semibold hover:text-blue-600 transition">{{ $userMembership->user->name }}</h2>
            <p class="text-red-600 text-2xl">
                {{ $userMembership->membershipPlan ? $userMembership->membershipPlan->name : 'N/A' }}
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
        <form action="{{ route('admin.members.destroy', $userMembership->id) }}" method="POST">
        @csrf
        @method('DELETE')
            <button type="submit" class="w-12 h-12 btn-delete">
                <img src="{{ asset('/assets/delete.png') }}" alt="Delete" class="w-full h-full object-contain" />
            </button>
        </form>
    </div>

    <!-- Slot for extra content -->
    {{ $slot }}
</div>
