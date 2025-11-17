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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</head>

<body class="bg-gray-100 font-sans text-gray-800" x-data="{ sidebarOpen: false }">
    <!-- Responsive Design -->
    <header class="bg-black shadow md:hidden fixed top-0 left-0 right-0 z-20">
        <div class="flex items-center justify-between px-4 py-3">
            <button @click="sidebarOpen = true" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="p-1 text-center md:block">
                <img src="{{ asset('images/gainlabWhite.png') }}" alt="" class="h-11">
            </div>
        </div>
    </header>

    <div class="flex min-h-screen pt-14 md:pt-0">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 w-72 bg-black border-r border-gray-200 z-30 transform transition-transform duration-200 ease-in-out
            md:translate-x-0 md:inset-0 flex flex-col justify-between"
            :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

            <div class="flex flex-col overflow-y-auto h-full pb-20">
                <!-- Mobile Design -->
                <div class="p-6 border-b border-gray-200 text-center md:hidden">
                    <button @click="sidebarOpen = false" class="text-gray-500 float-right">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <span class="text-xl font-semibold text-white">Menu</span>
                </div>

                <div class="p-1 pb-4 text-center hidden md:block">
                    <img src="{{ asset('images/gainlabWhite.png') }}" alt="gainlab logo" class="p-2 w-42">
                </div>

                <nav class="px-2 py-3 space-y-2 flex-1 overflow-y-auto">

                    <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard Icon"
                            class="nav-icon">Dashboard</a>

                    <a href="{{ route('admin.membership.index') }}" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/membership.png') }}" alt="Dashboard Icon" class="nav-icon">Membership
                        Plans</a>

                    <a href="{{ route('admin.scan.scanner') }}" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/scanner.png') }}" alt="Dashboard Icon" class="nav-icon">QR Code
                        Scanner</a>

                    <a href="{{ route('admin.walkin.index') }}" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/walkin.png') }}" alt="Dashboard Icon" class="nav-icon">Walk-In
                        Management</a>

                    <div x-data="{ open: false }" class="space-y-1">
                        <button @click="open = !open"
                            class="nav-text w-full flex items-center justify-between focus:outline-none">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('images/memberManage.png') }}" alt="Account Icon" class="nav-icon">
                                <span>Member Management</span>
                                <svg :class="{ 'rotate-180': open }"
                                    class="w-6 h-6 transform transition-transform duration-200 ml-auto" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </div>

                        </button>
                        <div x-show="open" x-collapse class="pl-5 space-y-1">
                            <a href="{{ route('admin.members.index') }}" @click="sidebarOpen = false" class="nav-text">
                                <img src="{{ asset('images/member.png') }}" alt="Dashboard Icon"
                                    class="nav-icon">Members</a>

                            <a href="{{ route('admin.sessions.index') }}" @click="sidebarOpen = false" class="nav-text">
                                <img src="{{ asset('images/session.png') }}" alt="Dashboard Icon"
                                    class="nav-icon">Sessions</a>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="space-y-1">
                        <button @click="open = !open"
                            class="nav-text w-full flex items-center justify-between focus:outline-none">
                            <div class="flex items-center space-x-2">
                                <img src="{{ asset('images/userManage.png') }}" alt="Account Icon" class="nav-icon">
                                <span>User Management</span>
                                <svg :class="{ 'rotate-180': open }"
                                    class="w-6 h-6 transform transition-transform duration-200 ml-auto" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </div>
                        </button>
                        <div x-show="open" x-collapse class="pl-5 space-y-1">
                            <a href="{{ route('admin.createAnAccount.create') }}" @click="sidebarOpen = false"
                                class="nav-text">
                                <img src="{{ asset('images/createAccount.png') }}" alt="Add Account Icon"
                                    class="nav-icon">Add Account
                            </a>

                            <a href="{{ route('admin.createAnAccount.index') }}" @click="sidebarOpen = false"
                                class="nav-text">
                                <img src="{{ asset('images/account.png') }}" alt="Accounts Icon"
                                    class="nav-icon">Accounts
                            </a>

                            <a href="{{ route('admin.payments.index') }}" @click="sidebarOpen = false" class="nav-text">
                                <img src="{{ asset('images/payment.png') }}" alt="Dashboard Icon"
                                    class="nav-icon">Payment
                                Records</a>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="absolute bottom-0 left-0 w-full p-4 bg-black border-t border-gray-700">
                <form action="{{ route('admin.logout')}}" method="POST" @click="sidebarOpen = false" class="nav-text">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center">
                        <img src="{{ asset('images/logout.png') }}" alt="Dashboard Icon" class="nav-icon">
                        Logout
                    </button>
                </form>
            </div>

        </aside>


        <!-- Main Content -->
        <main class="main-content">
            {{ $slot }}
        </main>


        @stack('scripts')
    </div>
</body>

</html>