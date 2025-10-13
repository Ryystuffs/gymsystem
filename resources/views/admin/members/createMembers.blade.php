<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="text-3xl font-bold text-gray-800">Add New Member</h1>
            <a href="{{ route('admin.members.index') }}"
               class="inline-block text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Back to Members List
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md p-5">

            <form method="POST" action="#">
                @csrf

                <div class="mb-4">
                    <label for="fname" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter Full Name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="membershipPlan" class="block text-sm font-medium text-gray-700">Choose a Membership Plan</label>
                    <select id="membershipPlan" name="membershipPlan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                {{--    <option value="" disabled selected>Select a Membership Plan</option>
                        @foreach($membershipPlans as $plan)
                            <option value="{{ $plan->name }}">{{ $plan->name }}</option>
                        @endforeach 
                
                        DI KO MAAYOS TO DI LUMALABAS MGA MEMBERSHIP PLAN HAHAHAHAHA
                        --}}
                    </select>
                </div>

                <div class="mb-4">
                    <!--Duration dito edit nalang pag nalagay na yung membership Plan, bali magaauto na to-->
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <input type="date" id="duration" name="duration" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                </div>

                <div class="mb-6">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                        <option value="gcash">Gcash</option>
                        <option value="gcash">Cash</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="amount_paid" class="block text-sm font-medium text-gray-700">Amount Paid</label>
                    <input type="number" id="amount_paid" name="amount_paid" placeholder="Amount Paid" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                    Create Member
                </button>
            </form>
        </div>
    </div>
</x-navigation>