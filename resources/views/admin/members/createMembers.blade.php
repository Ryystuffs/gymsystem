<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="text-3xl font-bold text-gray-800">Add New Member</h1>
            <a href="{{ route('admin.members.index') }}"
               class="inline-block text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Back to Members List
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="" action="">
                @csrf

                <div class="mb-4"> 
                    <label for="fname" class="block text-sm font-medium text-gray-700">Full Name</label> 
                    <input type="text" id="fname" name="fname" placeholder="Enter Full Name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required> 
                </div>

                <ul id="namelist" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md 
                mt-1 max-h-40 overflow-y-auto hidden">
                </ul>

                <div class="mb-4">
                    <label for="membershipPlan" class="block text-sm font-medium text-gray-700">Choose a Membership Plan</label>
                    <select id="membershipPlan" name="membershipPlan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                    <option value="" disabled selected>Select a Membership Plan</option>
                        @foreach($membershipPlans as $membershipPlan)
                            <option value="{{ $membershipPlan->id }}">{{ $membershipPlan->name }}</option>
                        @endforeach 
                    </select>
                </div>

                <div class="mb-4">
                    <!--Duration dito edit nalang pag nalagay na yung membership Plan, bali magaauto na to-->
                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                    <input type="number" id="duration" name="duration" placeholder="Duration in days" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" value="" required readonly>
                </div>

                <div class="mb-6">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required>
                        <option value="Gcash">Gcash</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="amount_paid" class="block text-sm font-medium text-gray-700">Amount Paid</label>
                    <input type="number" id="amount_paid" name="amount_paid" placeholder="Amount Paid" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" required readonly>
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition duration-200">
                    Create Member
                </button>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const membershipPlanSelect = document.getElementById('membershipPlan');
                        const durationInput = document.getElementById('duration');
                        const amountPaidInput = document.getElementById('amount_paid');

                        // Pass membership plans data to JS
                        const membershipPlans = @json($membershipPlans);

                        membershipPlanSelect.addEventListener('change', function () {
                            const selectedPlanName = parseInt(this.value);
                            const selectedPlan = membershipPlans.find(membershipPlan => membershipPlan.id === selectedPlanName);

                            if (selectedPlan) {
                                durationInput.value = selectedPlan.duration ?? '';
                                amountPaidInput.value = selectedPlan.price ?? '';
                            } else {
                                durationInput.value = '';
                                amountPaidInput.value = '';
                            }
                        });
                    });


                const users = @json($userMemberships->map(fn($membership)=>[
                    'name' => $membership->user->name,
                ])
                );

                const input = document.getElementById('fname');
                const nameList = document.getElementById('namelist');

                input.addEventListener('input', function () {
                    const query = this.value.toLowerCase();
                    nameList.innerHTML = ''; // clear old results

                    if (query.length === 0) {
                        nameList.classList.add('hidden');
                        return;
                    }

                    // Filter names that match
                    const filtered = users.filter(user => user.name.toLowerCase().includes(query));

                    if (filtered.length === 0) {
                        nameList.classList.add('hidden');
                        return;
                    }

                    filtered.forEach(user => {
                        const li = document.createElement('li');
                        li.textContent = user.name;
                        li.className = 'px-4 py-2 hover:bg-indigo-100 cursor-pointer';
                        li.addEventListener('click', () => {
                            input.value = user.name;
                            nameList.classList.add('hidden');
                        });
                        nameList.appendChild(li);
                    });

                    nameList.classList.remove('hidden');
                });

                // Hide dropdown when clicking outside
                document.addEventListener('click', function (e) {
                    if (!e.target.closest('#fname') && !e.target.closest('#namelist')) {
                        nameList.classList.add('hidden');
                    }
                });
                </script>

            </form>
        </div>
    </div>
</x-navigation>