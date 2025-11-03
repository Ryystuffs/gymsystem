<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('images/admin.png') }}" type="image/png">
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
        <aside class="fixed inset-y-0 left-0 w-80 bg-black border-r border-gray-200 z-30 transform transition-transform duration-200 ease-in-out
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
            <div class="p-1 border-b border-[#0e608f] text-center hidden md:block">
                <img src="{{ asset('images/gainlabWhite.png') }}" alt="">
            </div>
            <nav class="px-2 py-3 space-y-2">

                <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Dashboard</a>

                <a href="{{ route('admin.membership.index') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/membership.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Membership Plans</a>

                <a href="{{ route('admin.members.index') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/member.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Members</a>
                
                <a href="{{ route('admin.payments.index') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/payment.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Payment Records</a>

                

                <a href="{{ route('admin.scan.scanner') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/scanner.png') }}" alt="Dashboard Icon"
                        class="nav-icon">QR Code Scanner</a>

                <a href="{{route('admin.sessions.index')}}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/session.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Sessions</a>

                <a href="{{ route('admin.walkin.index') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/walkin.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Walk-in Guest</a>



                <a href="{{ route('admin.createAnAccount.create') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/createAccount.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Add Account</a>

                <a href="{{ route('admin.createAnAccount.index') }}" @click="sidebarOpen = false"
                    class="nav-text">
                    <img src="{{ asset('images/account.png') }}" alt="Dashboard Icon"
                        class="nav-icon">Accounts</a>

                <div class="pt-4 border-t border-[#0e608f]">

                    <form action="{{ route('admin.logout')}}" method="POST"  @click="sidebarOpen = false" class="nav-text">
                    @csrf   
                            <button type="submit">
                                <img src="{{ asset('images/logout.png') }}" alt="Dashboard Icon"
                                    class="nav-icon">
                                Logout
                            </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            {{ $slot }}
        </main>


        @stack('scripts')
    </div>
</body>

</html>