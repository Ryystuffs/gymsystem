<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="login-page">
        <h1 class="text-red-600 text-center text-[min(10vw,3rem)] my-10 font-bold mx-auto dark:text-[#8E1616]">Gym Management System</h1>
        <p class="text-[min(1rem,4vw)] text-center dark:text-white">Log in to track progress, manage memberships, and stay on top of your fitness journey."</p>
        <div class="flex flex-col h-150 bg-[#fff8f0] dark:bg-gray-900 text-center p-5 rounded-lg shadow-lg my-5 w-auto">
            <p class="text-red-600 dark:text-[#8E1616] text-[min(1.5rem,10vw)] font-semibold">Login</p>
            <div class="bg-[#FFFFFF] dark:bg-gray-800 h-100 w-65 sm:w-150 md:w-180 mx-auto mt-5 rounded-lg shadow-md"></div>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn">Submit</a>
    </div>

</body>
</html>