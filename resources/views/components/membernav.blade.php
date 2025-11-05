<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>

    <body class="bg-[#121212] font-sans text-gray-800" x-data="{ sidebarOpen: false }">
        <!-- Responsive Design -->
        <header class="bg-black shadow md:hidden fixed top-0 left-0 right-0 z-20">
            <div class="flex items-center justify-between px-4 py-3">
                <button @click="sidebarOpen = true" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-lg font-semibold text-white">GainLab</span>
            </div>
        </header>

        <div class="flex min-h-screen pt-14 md:pt-0">
            <!-- Sidebar -->
            <aside class="fixed inset-y-0 left-0 w-72 bg-black border-r border-gray-200 z-30 transform transition-transform duration-200 ease-in-out
            md:translate-x-0 md:static md:inset-0 flex flex-col"
                :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

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
                    <img src="{{ asset('images/gainlabWhite.png') }}" alt="" class="p-2 w-42">
                </div>

                <nav class="px-2 py-3 space-y-2 flex-1 overflow-y-auto">

                    <a href="{{ route('member.dashboard') }}" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard Icon"
                            class="nav-icon">Dashboard</a>

                    <a href="" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/scanner.png') }}" alt="Dashboard Icon" class="nav-icon">My sessions
                        </a>

                    <a href="{{ route('member.showAccount') }}" @click="sidebarOpen = false" class="nav-text">
                        <img src="{{ asset('images/account.png') }}" alt="Dashboard Icon" class="nav-icon">Account</a>

                </nav>
                
                <div class="p-4 mt-auto">
                    <form action="{{ route('admin.logout')}}" method="POST" @click="sidebarOpen = false"
                        class="nav-text">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center">
                            <img src="{{ asset('images/logout.png') }}" alt="Dashboard Icon" class="nav-icon">
                            Logout
                        </button>
                    </form>
                </div>

            </aside>

            <main class="w-screen">
                {{ $slot }}
            </main>
        </div>
    </body>

</html>