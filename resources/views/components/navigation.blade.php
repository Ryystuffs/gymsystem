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
        <div class="bg-red-500  w-90 h-screen fixed top-0 left-0sm:h-screen">
            <div class="p-5 text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-4xl text-white">Gym System</a>
            </div>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                <a href="{{ route('admin.membership.membershipPlan') }}" class="nav-link">Membership Plans</a>
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

        <main class="content ml-90 p-5 w-full">
            {{ $slot }}
        </main>
    </div>
</body>
</html>