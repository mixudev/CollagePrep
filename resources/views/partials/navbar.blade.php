<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-900 mr-10 flex items-center">
                    @php
                        $siteIcon = \App\Models\Setting::getValue('site_icon');
                    @endphp
                    @if($siteIcon)
                        <img src="{{ asset('storage/' . $siteIcon) }}" alt="Logo" class="h-8 w-8 mr-2 object-contain">
                    @else
                        <svg class="h-8 w-8 mr-2 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    @endif
                    {{ \App\Models\Setting::getValue('site_name', 'Tryout UTBK') }}
                </a>
                <div class="hidden md:flex md:space-x-1 h-full">
                    <a href="{{ route('dashboard') }}" 
                        class="px-4 py-2 text-sm font-medium transition-colors flex items-center h-full relative {{ request()->routeIs('dashboard') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                        @if(request()->routeIs('dashboard'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900"></span>
                        @endif
                    </a>
                    
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.categories.index') }}" 
                            class="px-4 py-2 text-sm font-medium transition-colors flex items-center h-full relative {{ request()->routeIs('admin.categories.*') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori
                            @if(request()->routeIs('admin.categories.*'))
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('admin.modules.index') }}" 
                            class="px-4 py-2 text-sm font-medium transition-colors flex items-center h-full relative {{ request()->routeIs('admin.modules.*') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Modul
                            @if(request()->routeIs('admin.modules.*'))
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900"></span>
                            @endif
                        </a>
                    @endif
                    
                    <a href="{{ route('rankings.index') }}" 
                        class="px-4 py-2 text-sm font-medium transition-colors flex items-center h-full relative {{ request()->routeIs('rankings.*') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Ranking
                        @if(request()->routeIs('rankings.*'))
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900"></span>
                        @endif
                    </a>
                    
                    @if(auth()->user()->isStudent())
                        <a href="{{ route('tryout.index') }}" 
                            class="px-4 py-2 text-sm font-medium transition-colors flex items-center h-full relative {{ request()->routeIs('tryout.*') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Tryout
                            @if(request()->routeIs('tryout.*'))
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900"></span>
                            @endif
                        </a>
                        
                        <a href="{{ route('history.index') }}" 
                            class="px-4 py-2 text-sm font-medium transition-colors flex items-center h-full relative {{ request()->routeIs('history.*') ? 'text-gray-900' : 'text-gray-600 hover:text-gray-900' }}">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Riwayat
                            @if(request()->routeIs('history.*'))
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900"></span>
                            @endif
                        </a>
                    @endif
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- User Dropdown Menu -->
                <div class="relative group">
                    <button class="flex items-center space-x-3 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 rounded-lg px-2 py-1.5 hover:bg-gray-50 transition-colors">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                        @else
                            <div class="h-10 w-10 rounded-full bg-gray-900 flex items-center justify-center border border-gray-200">
                                <span class="text-white text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        @endif
                        <div class="text-left hidden sm:block">
                            <div class="text-sm font-semibold text-gray-900 leading-tight">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500 font-medium">{{ ucfirst(auth()->user()->role) }}</div>
                        </div>
                        <svg class="h-4 w-4 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-200">
                        <!-- User Info -->
                        <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <div class="flex items-center space-x-3">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="h-10 w-10 rounded-full object-cover border border-gray-200">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-900 flex items-center justify-center border border-gray-200">
                                        <span class="text-white text-sm font-semibold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-1.5">
                            <a href="{{ route('profile.edit') }}" 
                                class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors {{ request()->routeIs('profile.*') ? 'bg-gray-50 text-gray-900' : '' }}">
                                <svg class="h-4 w-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="font-medium">Edit Profile</span>
                            </a>
                            
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.users.index') }}" 
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-gray-50 text-gray-900' : '' }}">
                                    <svg class="h-4 w-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <span class="font-medium">Manajemen User</span>
                                </a>
                                
                                <a href="{{ route('admin.roles.index') }}" 
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors {{ request()->routeIs('admin.roles.*') ? 'bg-gray-50 text-gray-900' : '' }}">
                                    <svg class="h-4 w-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="font-medium">Kontrol Role</span>
                                </a>
                                
                                <a href="{{ route('admin.activity-logs.index') }}" 
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gray-50 text-gray-900' : '' }}">
                                    <svg class="h-4 w-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                    <span class="font-medium">Log Aktifitas</span>
                                </a>
                                
                                <a href="{{ route('admin.settings.index') }}" 
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-gray-50 text-gray-900' : '' }}">
                                    <svg class="h-4 w-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">Pengaturan Sistem</span>
                                </a>
                            @endif
                        </div>
                        
                        <!-- Logout -->
                        <div class="border-t border-gray-200 pt-1.5 mt-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                                    <svg class="h-4 w-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
