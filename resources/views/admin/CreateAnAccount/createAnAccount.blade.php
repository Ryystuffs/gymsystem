<x-navigation>
    <div class="p-1">
        <div class="flex justify-between p-5 ">
            <h1 class="title-text">Create New Account</h1>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md">

            <form method="POST" action="{{ route('admin.createAnAccount.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" id="fname" name="name" placeholder="Enter Full Name" class="input-design"
                        required value="{{ old('name') }}">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Enter Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Email" class="input-design" required value="{{ old('email') }}">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password"
                        class="input-design" required>
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm
                        Password</label>
                    <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password"
                        class="input-design" required>
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
                    </script>
                @endif

                @if ($errors->any())
                    <div id="validation-errors">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Password Error alert message --}}
                <script>
                    document.querySelector('form').addEventListener('submit', function (e) {
                        const password = document.getElementById('password').value;
                        const confirm = document.getElementById('confirm_password').value;

                        if (password !== confirm) {
                            Swal.fire({
                                title: 'Validation Error',
                                text: 'Passwords do not match.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#e3342f'
                            });
                        }

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

                <button type="submit" class="submit-design"> Create Account </button>
            </form>
        </div>
    </div>
</x-navigation>