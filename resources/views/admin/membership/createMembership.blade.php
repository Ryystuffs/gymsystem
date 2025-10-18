<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="text-3xl font-bold text-gray-800">Add New Membership Plan</h1>

            <a href="{{ route('admin.membership.index') }}" class="back-button">Back to Membership Plan</a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="POST" action="{{ route('admin.members.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="PlanName" class="block text-sm font-medium text-gray-700">Plan Name</label>
                    <input type="text" id="PlanName" name="PlanName" placeholder="Enter Plan Name"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="text" id="price" name="price" placeholder="Enter Price"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        required>
                </div>

                <div class="mb-4">
                    <label for="expired_at" class="block text-sm font-medium text-gray-700">Duration</label>
                    <input type="number" id="duration" name="expired_at" placeholder="Duration in Days"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        value="" required>
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" placeholder="Description"
                        class="resize-y-8 mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        required></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                    Create Member
                </button>
            </form>
        </div>
    </div>
</x-navigation>