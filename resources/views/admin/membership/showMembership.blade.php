<x-navigation>
    <h1>Membership Plan Details</h1>
<p>{{ $membershipPlan->name }}</p>
<p>Price: Php{{ $membershipPlan->price }}</p>
<p>Duration: {{ $membershipPlan->duration }} months</p>
<p>Description: {{ $membershipPlan->description }}</p>
</x-navigation>