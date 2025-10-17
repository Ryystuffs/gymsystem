<x-navigation>
    <div>
        <x-intronav name="Membership Plan" button="Create a new Plan">
        </x-intronav>

        @foreach($membershipPlans as $membershipPlan)
            <x-membershipPlanCard :membershipPlan="$membershipPlan">
            </x-membershipPlanCard>
        @endforeach
    </div>
</x-navigation>