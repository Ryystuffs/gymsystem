<div class="flex justify justify-between bg-white rounded-lg shadow-md p-5 mb-5 w-11/12 mx-auto">
    <div >
        <h2 class="text-2xl font-semibold mb-3">{{ $membershipPlan->name }}</h2>
        <p class="text-gray-600 mb-2">Price: Php{{ $membershipPlan->price }}</p>
        <p class="text-gray-600 mb-2">Duration: {{ $membershipPlan->duration }} months</p>
        <p class="text-gray-600">Description: {{ $membershipPlan->description }}</p>
    </div>

    <div>
        <a href="#" class="btn-secondary">Edit</a>
        <a href="#" class="btn-delete">Delete</a>
    </div>

    {{ $slot }}
</div>