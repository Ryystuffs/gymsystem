<x-navigation>
    <div class="p-1">

        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="POST" action="{{ route('admin.createAnAccount.create') }}">
                @csrf

                <div class="mb-4">
                    <label for="fname" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter Full Name" class="input-design" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Enter Email</label>
                    <input type="email" id="price" name="price" placeholder="Enter Email" class="input-design" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" class="input-design" required>
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="input-design" required>
                </div>

                <script>
                    document.querySelector('form').addEventListener('submit', function (e) {
                        const password = document.getElementById('password').value;
                        const confirm = document.getElementById('confirm_password').value;

                        if (password !== confirm) {
                            e.preventDefault();
                            alert('Password do not match!');
                        }
                    });
                </script>

                <button type="submit" class="submit-design"> Create Account </button>
            </form>
        </div>
    </div>
</x-navigation>