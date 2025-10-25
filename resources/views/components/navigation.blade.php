<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="somerandomtoken">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for toggling sidebar -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800" x-data="{ sidebarOpen: false }">
    <!-- Responsive Design -->
    <header class="bg-white shadow md:hidden fixed top-0 left-0 right-0 z-20">
        <div class="flex items-center justify-between px-4 py-3">
            <button @click="sidebarOpen = true" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <span class="text-lg font-semibold text-red-600">Gym System</span>
        </div>
    </header>

    <div class="flex min-h-screen pt-14 md:pt-0">
        <!-- Sidebar -->
        <aside class=" inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-30 transform transition-transform duration-200 ease-in-out
            md:translate-x-0 md:static md:inset-0"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
            <div class="p-6 border-b border-gray-200 text-center md:hidden">
                <button @click="sidebarOpen = false" class="text-gray-500 float-right">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <span class="text-xl font-semibold text-red-600">Menu</span>
            </div>
            <div class="p-6 border-b border-gray-200 text-center hidden md:block">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-semibold text-red-600">Gym System</a>
            </div>
            <nav class="px-4 py-6 space-y-2">

                <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Dashboard</a>

                <a href="{{ route('admin.membership.index') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/membership.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Membership Plans</a>

                <a href="{{ route('admin.members.index') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/member.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Members</a>
                
                <a href="{{ route('admin.payments.index') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/payment.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Payment Records</a>

                <div class="pt-4 border-t border-gray-200"></div>

                <a href="{{ route('admin.scan.scanner') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/scanner.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">QR Code Scanner</a>

                <a href="{{route('admin.sessions.index')}}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/session.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Sessions</a>

                <a href="{{ route('admin.walkin.index') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/walkin.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Walk-in Guest</a>

                <div class="pt-4 border-t border-gray-200"></div>

                <a href="{{ route('admin.createAnAccount.create') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/createAccount.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Add Account</a>

                <a href="{{ route('admin.createAnAccount.index') }}" @click="sidebarOpen = false"
                    class="block px-4 py-2 rounded hover:bg-red-50 hover:text-red-600 transition">
                    <img src="{{ asset('images/account.png') }}" alt="Dashboard Icon"
                        class="w-5 h-5 inline mr-5">Accounts</a>

                <div class="pt-4 border-t border-gray-200">
                    <a href="#" @click="sidebarOpen = false"
                        class="block px-4 py-2 text-red-600 hover:bg-red-100 rounded transition font-medium">
                        <img src="{{ asset('images/logout.png') }}" alt="Dashboard Icon"
                            class="w-5 h-5 inline mr-5">Logout</a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-4 py-6 md:ml-4">
            {{ $slot }}
        </main>


        @stack('scripts')
    </div>
</body>

</html>