<x-navigation>
    <div>
        <div class="flex justify-between p-5 text-2xl mb-5">
            <div>
                <h1>Membership Plans</h1>
            </div>
            <div>
                <a href="{{route ("admin.membership.createMembership")}}" class="bg-red-600 text-white py-2 px-4 rounded-lg shadow-md 
                hover:bg-red-700 hover:scale-105 transform transition-transform duration-300">Create New Membership Tier</a>
            </div>
        </div>

            @foreach($membershipPlans as $membershipPlan)
                <x-membershipPlanCard :membershipPlan="$membershipPlan">
                </x-membershipPlanCard>
            @endforeach
    </div>
</x-navigation>