<!DOCTYPE html>
<html lang="en">

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
                    class="fixed inset-y-0 left-0 z-50 bg-[#242424] shadow-2xl flex flex-col transition-all duration-300 ease-in-out h-screen lg:sticky lg:top-0"
                >
                    <button 
                        @click="window.innerWidth > 1024 ? sideBarCollapsed = !sideBarCollapsed : sideBarOpen = !sideBarOpen" 
                        type="button" 
                        class="hidden lg:flex absolute -right-6 top-6 bg-[#242424] hover:bg-[#716a6a] text-white rounded-full p-1.5 shadow-lg border-4 border-[#515050] z-50 transition-transform active:scale-90"
                        :class="(sideBarCollapsed || sideBarOpen) && 'rotate-180'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <div class="py-6 px-4 mb-4 border-b border-white/5">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 w-10 h-10 flex items-center justify-center shadow-inner">
                                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="w-full">
                            </div>
                            <div x-show="!sideBarCollapsed || sideBarOpen" x-transition.opacity class="nav-title">
                                <h1 class="text-white font-bold tracking-tight leading-none truncate text-xl w-32">GAINLAB</h1>
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
                                <svg stroke="currentColor" class="h-5 w-5 {{ request()->routeIs('admin.membership.index') ? 'nav-active' : 'nav' }}" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.4 7H4.6C4.26863 7 4 7.26863 4 7.6V16.4C4 16.7314 4.26863 17 4.6 17H7.4C7.73137 17 8 16.7314 8 16.4V7.6C8 7.26863 7.73137 7 7.4 7Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.4 7H16.6C16.2686 7 16 7.26863 16 7.6V16.4C16 16.7314 16.2686 17 16.6 17H19.4C19.7314 17 20 16.7314 20 16.4V7.6C20 7.26863 19.7314 7 19.4 7Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M1 14.4V9.6C1 9.26863 1.26863 9 1.6 9H3.4C3.73137 9 4 9.26863 4 9.6V14.4C4 14.7314 3.73137 15 3.4 15H1.6C1.26863 15 1 14.7314 1 14.4Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M23 14.4V9.6C23 9.26863 22.7314 9 22.4 9H20.6C20.2686 9 20 9.26863 20 9.6V14.4C20 14.7314 20.2686 15 20.6 15H22.4C22.7314 15 23 14.7314 23 14.4Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 12H16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Membership Plans</span>
                        </a>

                        <a href="{{ route('admin.scan.scanner') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.scan.scanner')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.scan.scanner') ? 'nav-active' : 'nav' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">QR Code Scanner</span>
                        </a>

                        <a href="{{ route('admin.walkin.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.walkin.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.walkin.index') ? 'nav-active' : 'nav' }}" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M216.06,192v12A36,36,0,0,1,144,204V192a8,8,0,0,1,8-8h56A8,8,0,0,1,216.06,192ZM104,160h-56a8,8,0,0,0-8,8v12A36,36,0,0,0,112,180V168A8,8,0,0,0,104,160ZM76,16C64.36,16,53.07,26.31,44.2,45c-13.93,29.38-18.56,73,.29,96a8,8,0,0,0,6.2,2.93h50.55a8,8,0,0,0,6.2-2.93c18.85-23,14.22-66.65.29-96C98.85,26.31,87.57,16,76,16Zm78.8,152h50.55a8,8,0,0,0,6.2-2.93c18.85-23,14.22-66.65.29-96C202.93,50.31,191.64,40,180,40s-22.89,10.31-31.77,29c-13.93,29.38-18.56,73,.29,96A8,8,0,0,0,154.76,168Z"/>
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Walk-In Management</span>
                        </a>

                        <a href="{{ route('admin.members.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.members.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg stroke="currentColor" fill="none" class="h-5 w-5 {{ request()->routeIs('admin.members.index') ? 'nav-active' : 'nav' }}" xmlns="http://www.w3.org/2000/svg" id="mdi-wallet-membership" viewBox="0 0 24 24">
                                    <path d="M20,10H4V4H20M20,15H4V13H20M20,2H4C2.89,2 2,2.89 2,4V15C2,16.11 2.89,17 4,17H8V22L12,20L16,22V17H20C21.11,17 22,16.11 22,15V4C22,2.89 21.11,2 20,2Z" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Member Management</span>
                        </a>

                        <a href="{{ route('admin.sessions.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.sessions.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('admin.sessions.index') ? 'nav-active' : 'nav' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.984 12.53a9 9 0 1 0 -7.552 8.355" />
                                    <path d="M12 7v5l3 3" />
                                    <path d="M19 16l-2 3h4l-2 3" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Member Sessions</span>
                        </a>

                        <a href="{{ route('users.list') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('users.list')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs('users.list') ? 'nav-active' : 'nav' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                            </div>
                            <span x-show="!sideBarCollapsed || sideBarOpen" class="font-medium nav-title truncate">Users</span>
                        </a>

                        <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group/item {{ request()->routeIs('admin.payments.index')
                            ? ' bg-white/10 text-white  border border-white/10  hover:bg-white/20 ' 
                            : 'text-red-100/70 hover:text-white hover:bg-white/5' }}" >
                            <div class="shrink-0">
                                <svg class="h-5 w-5 {{ request()->routeIs('admin.payments.index') ? 'nav-active' : 'nav' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.5795 8.60699L2 8.45417C3.849 3.70488 9.15764 0.999849 14.3334 2.34477C19.8461 3.77722 23.1205 9.26153 21.647 14.5943C20.4283 19.0051 16.3433 21.9307 11.8479 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 22C6.5 22 2 17 2 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0.5 3"/>
                                    <path d="M13.6039 9.72177C13.2524 9.35267 12.3906 8.48536 11.0292 9.10111C9.66784 9.71686 9.45159 11.698 11.5108 11.9085C12.4416 12.0036 13.0484 11.7981 13.6039 12.3794C14.1595 12.9607 14.2627 14.5774 12.8425 15.013C11.4222 15.4487 10.502 14.7292 10.2545 14.5041M11.9078 8.01953V8.81056M11.9078 15.1471V16.0195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
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

                <main class="flex-1 min-w-0 min-h-screen bg-[#242424]">
                    <header class="h-20 bg-[#242424] border-b border-white/5 flex justify-between items-center px-8 sticky top-0 z-20">
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