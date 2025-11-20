<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="title-text">Add New Member</h1>
            <a href="{{ route('admin.members.index') }}" class="back-button">
                Back to Members List
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="POST" action="{{ route('admin.members.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="fname" class="label-design">Full Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter Full Name" class="input-design" required>
                </div>

                <input type="hidden" id="user_id" name="user_id">

                <ul id="namelist" class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mr-5 mt-1 max-h-40 overflow-y-auto hidden"></ul>

                <div class="mb-4">
                    <label for="membershipPlan" class="label-design">Choose a Membership Plan</label>
                    <select id="membershipPlan" name="membership_plan_id" class="input-design" required>
                        <option value="" disabled selected>Select a Membership Plan</option>
                        @foreach($membershipPlans as $membershipPlan)
                            <option value="{{ $membershipPlan->id }}">{{ $membershipPlan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="expired_at" class="label-design">Duration</label>
                    <input type="date" id="duration" name="expired_at" placeholder="Duration in days" class="input-design" value="" required readonly>
                </div>

                <div class="mb-6">
                    <label for="payment_method" class="label-design">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="input-design" required>
                        <option value="Gcash">Gcash</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="amount_paid" class="label-design">Amount Paid</label>
                    <input type="number" id="amount_paid" name="amount" placeholder="Amount Paid" class="input-design" required readonly>
                </div>

                <button type="submit" class="submit-design" id="submit-btn">
                    Create Member
                </button>

                @if ($errors->any())
                    <div id="validation-errors" class="hidden">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const membershipPlanSelect = document.getElementById('membershipPlan');
                        const durationInput = document.getElementById('duration');
                        const amountPaidInput = document.getElementById('amount_paid');
                        

                        const membershipPlans = @json($membershipPlans);

                        membershipPlanSelect.addEventListener('change', function () {
                            const selectedPlanId = parseInt(this.value);
                            const selectedPlan = membershipPlans.find(plan => plan.id === selectedPlanId);

                            if (selectedPlan) {
                                const today = new Date();
                                today.setDate(today.getDate() + selectedPlan.duration);
                                const formattedDate = today.toISOString().split('T')[0];

                                durationInput.value = formattedDate;
                                amountPaidInput.value = selectedPlan.price ?? '';
                            } else {
                                durationInput.value = '';
                                amountPaidInput.value = '';
                            }
                        });

                        const users = @json(
                            $users->map(fn($user) => [
                                'name' => $user->name,
                                'id' => $user->id
                            ])
                        );

                        const input = document.getElementById('fname');
                        const nameList = document.getElementById('namelist');
                        const userIdInput = document.getElementById('user_id');

                        input.addEventListener('input', function () {
                            const query = this.value.toLowerCase();
                            nameList.innerHTML = '';

                            if (query.length === 0) {
                                nameList.classList.add('hidden');
                                return;
                            }

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
                                    userIdInput.value = user.id;
                                    nameList.classList.add('hidden');
                                });
                                nameList.appendChild(li);
                            });

                            nameList.classList.remove('hidden');
                        });

                        document.addEventListener('click', function (e) {
                            if (!e.target.closest('#fname') && !e.target.closest('#namelist')) {
                                nameList.classList.add('hidden');
                            }
                        });

                        // SweetAlert for Errors
                        const errorContainer = document.getElementById('validation-errors');
                        if (errorContainer) {
                            const messages = Array.from(errorContainer.querySelectorAll('p')).map(p => p.textContent);
                            if (messages.length > 0) {
                                Swal.fire({
                                    title: 'Validation Error',
                                    html: messages.join('<br>'),
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#e3342f'
                                });
                            }
                        }
                    });
                </script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            </form>
        </div>
    </div>
</x-navigation>
