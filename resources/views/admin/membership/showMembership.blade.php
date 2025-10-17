<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="text-3xl font-bold text-gray-800">Membership Plan Details</h1>
            <a href="{{ route('admin.membership.index') }}"
               class="back-button">
                Back to Membership Plan
            </a>
        </div>
<!-- -->
        <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
            <p class="text-lg text-gray-700 mb-2">
                <span class="font-semibold">Name:</span> {{ $membershipPlans->name }}
            </p>
            <p class="text-lg text-gray-700 mb-2">
                <span class="font-semibold">Price:</span> Php {{ number_format($membershipPlans->price, 2) }}
            </p>
            <p class="text-lg text-gray-700 mb-2">
                <span class="font-semibold">Duration:</span> {{ $membershipPlans->duration }} days
            </p>
            <p class="text-lg text-gray-700">
                <span class="font-semibold">Description:</span> {{ $membershipPlans->description }}
            </p>
        </div>
    </div>
</x-navigation>