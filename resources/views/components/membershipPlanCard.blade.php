<div class="bg-white rounded-lg shadow-md p-5 mb-5 w-11/12 mx-auto">
    <h2 class="text-2xl font-semibold mb-3">{{ $membershipPlan->name }}</h2>
    <p class="text-gray-600 mb-2">Price: Php{{ $membershipPlan->price }}</p>
    <p class="text-gray-600 mb-2">Duration: {{ $membershipPlan->duration }} months</p>
    <p class="text-gray-600">Description: {{ $membershipPlan->description }}</p>

    {{ $slot }}
</div>