<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="title-text">Add Walk-In Guest</h1>
            <a href="{{ route('admin.walkin.index') }}" class="back-button">
                Back to Walk-In Session List
            </a>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="POST" action="{{ route('admin.createAnAccount.create') }}">
                @csrf

                <div class="mb-4">
                    <label for="fname" class="block text-sm font-medium text-gray-700">Full Name </label>
                    <input type="text" id="fname" name="fname" placeholder="Enter Full Name" class="input-design"
                        required>
                </div>

                <div class="mb-4">
                    <label for="date-time" class="block text-sm font-medium text-gray-700">Date </label>
                    <input type="datetime-local" id="date-time" name="date-time" placeholder="Enter Date"
                        class="input-design" required readonly>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="input-design" required>
                        <option value="Gcash">Gcash</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="text" id="amount" name="amount" placeholder="Amount" class="input-design" required
                        readonly>
                </div>

                {{-- Success alert message --}}
                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            Swal.fire({
                                title: 'Success!',
                                text: "{{ session('success') }}",
                                icon: 'success',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#4CAF50'
                            });
                        });


                        const date = new Date();
                        const amount = { value: 80.00 };

                        document.getElementById("amount").value = amount.value;

                    </script>
                @endif
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <button type="submit" class="submit-design"> Add Walk-In </button>
            </form>
        </div>
    </div>
</x-navigation>