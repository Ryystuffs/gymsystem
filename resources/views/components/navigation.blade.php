<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex">
        <div class="navbar">
            <h2 class="text-white font-semibold text-center mt-5 mb-10 text-4xl p-1 ">Gym System</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('admin.membershipPlan') }}" class="nav-link">Membership Plans</a>
                <a href="#" class="nav-link">Sessions</a>
                <a href="#" class="nav-link">Walk-in</a>
                <a href="#" class="nav-link">Members</a>
                <a href="#" class="nav-link">Payment Records</a>
                <a href="#" class="nav-link">QR Code Scanner</a>
                <a href="#" class="nav-link">Create an Account</a>
                <a href="#" class="nav-link">Accounts</a>

                <a href="#" class="nav-link border-b-2">Logout</a>
            </nav>
        </div>

        <main class="content w-full">
            {{ $slot }}
        </main>
    </div>
</body>
</html>