<x-navigation>
    <div>
        <div class="flex justify-between p-5 ">
            <div>
                <h1 class="title-text">Membership Plan</h1>
            </div>

            <a href="{{ route('admin.membership.create') }}"
                class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                Add a new Membership Tier
            </a>
    </div>

        @foreach($membershipPlans as $membershipPlan)
            <x-membershipPlanCard :membershipPlan="$membershipPlan">
            </x-membershipPlanCard>
        @endforeach
    </div>
</x-navigation>