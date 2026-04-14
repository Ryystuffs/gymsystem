<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

    <body 
        @auth
            x-cloak
            x-data="{ sideBarOpen: false, sideBarCollapsed: false }"
            x-init="
                    sideBarCollapsed = localStorage.getItem('sideBarCollapsed') === 'true';
                    
                    $watch('sideBarCollapsed', value =>localStorage.setItem('sideBarCollapsed', value));

                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024) {
                            sideBarOpen = false
                            }
                        }
                    );
                    "
        @endauth
        class="bg-slate-50 min-h-screen font-sans antialiased text-slate-900"
    >
    @auth()
            @php
                $user = auth()->user();
            @endphp
            <div class="flex min-h-screen relative">
                <aside 
                    id="sidebar-menu" 
                    {{-- Logic: Change width on desktop, change position on mobile --}}
                    :class="[
                        sideBarCollapsed ? 'lg:w-20' : 'lg:w-64',
                        sideBarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
                    ]"
                    class="fixed inset-y-0 left-0 z-50 bg-gradient-to-b from-red-700 via-blue-800 to-violet-900 shadow-2xl flex flex-col transition-all duration-300 ease-in-out h-screen lg:sticky lg:top-0"
                >
                    <button 
                        @click="window.innerWidth > 1024 ? sideBarCollapsed = !sideBarCollapsed : sideBarOpen = !sideBarOpen" 
                        type="button" 
                        class="hidden lg:flex absolute -right-6 top-6 bg-red-600 hover:bg-red-700 text-white rounded-full p-1.5 shadow-lg border-4 border-slate-50 z-50 transition-transform active:scale-90"
                        :class="(sideBarCollapsed || sideBarOpen) && 'rotate-180'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <div class="py-6 px-4 mb-4 border-b border-white/5">
                        <div class="flex items-center gap-3 px-2">
                            <div class="shrink-0 w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center p-2 border border-white/20 shadow-inner">
                                <img src="{{ asset('assets/images/ppi-logo-white.png') }}" alt="Logo" class="w-full">
                            </div>
                            <div x-show="!sideBarCollapsed || sideBarOpen" x-transition.opacity class="nav-title">
                                <h1 class="text-white font-bold tracking-tight leading-none truncate w-32">GainLab</h1>
                                <span class="text-blue-300 text-[10px] uppercase tracking-widest font-bold truncate block mt-1">{{ $user->designation }}</span>
                            </div>
                        </div>
                    </div>

                    <nav class="flex-1 px-4 space-y-2">
                        
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.dashboard')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('dashboard') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Dashboard</span>
                        </a>

                        <a href="{{ route('admin.membership.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.membership.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.membership.index') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Membership Plans</span>
                        </a>

                        <a href="{{ route('admin.scan.scanner') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.scan.scanner')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.scan.scanner') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">QR Code Scanner</span>
                        </a>

                        <a href="{{ route('admin.walkin.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.walkin.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.walkin.index') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Walk-In Management</span>
                        </a>

                        <a href="{{ route('admin.members.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.members.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.members.index') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Member Management</span>
                        </a>

                        <a href="{{ route('admin.sessions.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.sessions.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.sessions.index') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Member Sessions</span>
                        </a>

                        <a href="{{ route('admin.createAnAccount.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.createAnAccount.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.createAnAccount.index') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Users</span>
                        </a>

                        <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.payments.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.payments.index') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Payment Records</span>
                        </a>
                    </nav>

                    {{-- <div class="p-4 mt-auto border-t border-white/10 bg-black/10">
                        <div class="flex items-center gap-3 p-1 rounded-xl">
                            <div class="shrink-0 w-9 h-9 rounded-full overflow-hidden bg-gradient-to-tr from-red-600 to-red-400 flex items-center justify-center text-xs font-bold text-white shadow-lg ring-2 ring-white/10">
                                <img src="{{ route('users.photo' , ['user' => $user->id]) }}"
                                        onerror="this.src='{{ asset('assets/images/default-photo.jpg') }}'"
                                        class="w-full h-full object-cover">
                            </div>
                            <div x-show="!sideBarCollapsed || sideBarOpen" class="flex-1 overflow-hidden nav-title">
                                <p class="text-xs font-bold text-white truncate">{{ $user->name }}</p>
                                <p class="text-xs font-bold text-blue-300 truncate">{{ $user->email }}</p>
                                <p class="text-[10px] text-blue-300 truncate opacity-80">{{ $user->contact_number }}</p>
                            </div>
                        </div>
                    </div> --}}
                </aside>

                <div x-show="sideBarOpen" @click="sideBarOpen = false" class="fixed inset-0 bg-slate-900/50 z-40 lg:hidden" x-cloak></div>

                <main class="flex-1 min-w-0 min-h-screen bg-slate-50">
                    <header class="h-20 bg-white border-b border-slate-200 flex justify-between items-center px-8 sticky top-0 z-20">
                        {{-- <button @click="sideBarOpen = true" class="lg:hidden mr-4 p-2 text-slate-600 hover:bg-slate-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        </button>
                        <h2 class="text-xl font-bold text-slate-800"> @yield('pageTitle', '')</h2>                        
                        <div>
                            <x-dropdown title="Settings">
                                <a href="{{ route('users.profile') }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Profile
                                </a>

                                <a href="{{ route('users.password-reset') }}" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Change Password
                                </a>

                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="px-2 lg:py-1.5 py-2 w-full flex items-center rounded-md transition-colors text-left text-gray-800 hover:bg-gray-50 focus-visible:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Logout</button>
                                </form>
                            </x-dropdown>
                        </div> --}}
                        
                    </header>

                    <div class="p-4 md:p-8">
                        {{ $slot ?? '' }}
                    </div>
                </main>
            </div>
        @else
            {{ $slot ?? '' }}
        @endauth
    
        @livewireScripts

    </body>
</html>