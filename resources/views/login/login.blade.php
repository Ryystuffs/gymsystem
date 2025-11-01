<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-[#3A3838] md:flex-row">

    <div class="w-full md:w-1/2 bg-[#122D3D] flex flex-col justify-center items-center p-8 text-center">
        <img src="{{ asset('images/gainlabWhite.png') }}" alt="Gym Image" class="mb-6 rounded-lg max-w-xs md:max-w-sm">
        <h1 class="text-3xl md:text-4xl font-bold mb-2 text-white">Start Your Journey Now</h1>
        <hr class="border-white w-24 md:w-110 mb-2 mx-auto">
        <h2 class="text-xl md:text-2xl text-white">Achieve Your Dream Body</h2>
    </div>

    <div class="w-full md:w-1/2 flex justify-center items-center bg-[#3A3838] text-white p-8">
        <div class="w-full max-w-md rounded-lg">
            <h1 class="text-2xl md:text-3xl font-bold text-center mb-6">Login</h1>
            <form action="{{ route('admin.dashboard') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="uname" class="block font-medium mb-1">Username</label>
                    <input type="text" name="uname" id="uname" placeholder="Username"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-500 text-black" required>
                </div>

                <div>
                    <label for="password" class="block font-medium mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-gray-500 text-black" required>

                    <div class="flex items-center justify-between mt-2">
                        <label class="flex items-center space-x-2 text-gray-300 text-sm">
                            <input type="checkbox" onclick="togglePassword()" class="h-4 w-4">
                            <span>Show Password</span>
                        </label>
                        <a href="#" class="text-sm hover:underline text-gray-300">Forgot Password?</a>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#122D3D] hover:bg-[#133F4F] text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }

        document.addEventListener('DOMContentLoaded', function () {
            @if(session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f44336'
                });
            @endif
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            const password = document.getElementById('password').value;
            const minLength = 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasLowercase = /[a-z]/.test(password);
            const hasNumber = /[0-9]/.test(password);

            let errorMessages = [];
            if (password.length < minLength) errorMessages.push(`Password must be at least ${minLength} characters long.`);
            if (!hasUppercase) errorMessages.push('Password must contain at least one uppercase letter.');
            if (!hasLowercase) errorMessages.push('Password must contain at least one lowercase letter.');
            if (!hasNumber) errorMessages.push('Password must contain at least one number.');

            if (errorMessages.length > 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Password Error!',
                    html: errorMessages.join('<br>'),
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f44336'
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
