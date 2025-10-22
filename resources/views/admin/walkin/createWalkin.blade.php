<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="title-text">Add Walk-In Guest</h1>
            <a href="{{ route('admin.walkin.index') }}" class="back-button">
                Back to Walk-In Session List
            </a>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="POST" action="{{ route('admin.walkin.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name </label>
                    <input type="text" id="fname" name="name" placeholder="Enter Full Name" class="input-design"
                        required>
                </div>

                <div class="mb-4">
                    <label for="check_in" class="block text-sm font-medium text-gray-700">Date </label>
                    <input type="datetime-local" id="date-time" name="check_in" placeholder="Enter Date"
                        class="input-design" required readonly>
                </div>

                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="input-design" required>
                        <option value="Gcash">Gcash</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" id="amount" name="amount_paid" placeholder="Amount" class="input-design" required>
                </div>
                <button type="submit" class="submit-design"> Add Walk-In </button>

            </form>

                    <script>

                        

                        setInterval(() => {
                            const now = new Date();
                            const dateTimeInput = document.getElementById('date-time');
                            const year = now.getFullYear();
                            const month = String(now.getMonth() + 1).padStart(2, '0');  // Months are 0-based
                            const day = String(now.getDate()).padStart(2, '0');
                            const hours = String(now.getHours()).padStart(2, '0');
                            const minutes = String(now.getMinutes()).padStart(2, '0');
                            const seconds = String(now.getSeconds()).padStart(2, '0');

                            const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

                            dateTimeInput.value = formattedDate;
                        }, 1000); // Update every second
                    </script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                
        </div>
    </div>
</x-navigation>