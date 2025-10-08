<x-navigation>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Membership Plan Details</h1>

        <p class="text-lg text-gray-700 mb-2">
            <span class="font-semibold">Name:</span> {{ $membershipPlan->name }}
        </p>
        <p class="text-lg text-gray-700 mb-2">
            <span class="font-semibold">Price:</span> Php{{ number_format($membershipPlan->price, 2) }}
        </p>
        <p class="text-lg text-gray-700 mb-2">
            <span class="font-semibold">Duration:</span> {{ $membershipPlan->duration }} months
        </p>
        <p class="text-lg text-gray-700">
            <span class="font-semibold">Description:</span> {{ $membershipPlan->description }}
        </p>
    </div>
</x-navigation>
