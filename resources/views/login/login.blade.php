<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex items-center justify-center relative min-h-screen bg-cover bg-center bg-no-repeat bg-fixed bg-[url('/public/images/gymBG.jpg')]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-black-700 mb-4">WELCOME TO GYM SYSTEM!</h1>
        <form action="{{ route('admin.dashboard') }}" {{-- method="POST" --}} class="space-y-6">
            @csrf
            <h2 class="text-2xl font-semibold text-center text-gray-800">Login</h2>

            <div>
                <label for="uname" class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="uname" id="uname" placeholder="Enter Username" class="login-input" required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" class="login-input" required>
            </div>

            <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300"> 
                Login
            </button>

            <div class="text-center">
                <a href="#" class="text-sm text-gray-600 hover:underline">Forgot Password?</a>
            </div>
        </form>
    </div>
</body>
</html>