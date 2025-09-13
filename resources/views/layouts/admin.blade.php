@extends('layouts.app')

@section('content')
<div class="flex h-screen relative">
    <!-- Glass Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800"></div>
    <div class="fixed inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Ccircle cx="60" cy="60" r="8"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] bg-repeat"></div>
    
    <!-- Sidebar with Glass Effect -->
    <div class="relative w-64 bg-white/10 backdrop-blur-md border-r border-white/20 shadow-xl">
        <div class="flex items-center justify-center h-16 bg-gradient-to-r from-orange-600/80 to-red-600/80 backdrop-blur-md border-b border-white/20">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('logo-light-trimmed.webp') }}" alt="Sky Land Construction" class="w-8 h-auto">
                <span class="text-white text-lg font-bold font-['Inter',_'system-ui',_sans-serif]">Admin Console</span>
            </div>
        </div>
        
        <nav class="mt-5 space-y-2">
            <div class="px-3">
                <a href="{{ route('admin.dashboard') }}" 
                   class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500/20 text-orange-200 shadow-lg backdrop-blur-sm border border-orange-400/30' : 'text-slate-300 hover:bg-white/10 hover:text-white hover:backdrop-blur-sm hover:border hover:border-white/20' }}">
                    <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                    Dashboard
                </a>
            </div>
            
            <div class="px-3">
                <a href="{{ route('admin.clients.index') }}" 
                   class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.clients.*') ? 'bg-blue-500/20 text-blue-200 shadow-lg backdrop-blur-sm border border-blue-400/30' : 'text-slate-300 hover:bg-white/10 hover:text-white hover:backdrop-blur-sm hover:border hover:border-white/20' }}">
                    <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Clients
                </a>
            </div>
            
            <div class="px-3">
                <a href="{{ route('admin.vendors.index') }}" 
                   class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.vendors.*') ? 'bg-emerald-500/20 text-emerald-200 shadow-lg backdrop-blur-sm border border-emerald-400/30' : 'text-slate-300 hover:bg-white/10 hover:text-white hover:backdrop-blur-sm hover:border hover:border-white/20' }}">
                    <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Vendors
                </a>
            </div>
            
            <div class="px-3">
                <a href="{{ route('email-conversations.index') }}" 
                   class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('email-conversations.*') ? 'bg-purple-500/20 text-purple-200 shadow-lg backdrop-blur-sm border border-purple-400/30' : 'text-slate-300 hover:bg-white/10 hover:text-white hover:backdrop-blur-sm hover:border hover:border-white/20' }}">
                    <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email Conversations
                    {{-- Unread messages badge (optional) --}}
                    {{-- <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span> --}}
                </a>
            </div>
            
            <div class="px-3">
                <a href="{{ route('admin.email.test') }}" 
                   class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.email.*') ? 'bg-yellow-500/20 text-yellow-200 shadow-lg backdrop-blur-sm border border-yellow-400/30' : 'text-slate-300 hover:bg-white/10 hover:text-white hover:backdrop-blur-sm hover:border hover:border-white/20' }}">
                    <svg class="w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Email Test
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="relative flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation with Glass Effect -->
        <header class="bg-white/10 backdrop-blur-md border-b border-white/20 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-xl font-bold text-white font-['Inter',_'system-ui',_sans-serif]">@yield('page-title')</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-slate-300 font-medium">Welcome, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 text-red-300 hover:text-red-200 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 backdrop-blur-sm border border-red-400/30 hover:border-red-400/50">
                                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="relative flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">
                @if(session('success'))
                    <div class="bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 text-emerald-200 px-6 py-4 rounded-xl mb-6 shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-500/20 backdrop-blur-md border border-red-400/30 text-red-200 px-6 py-4 rounded-xl mb-6 shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif

                @yield('admin-content')
            </div>
        </main>
    </div>
</div>
@endsection
