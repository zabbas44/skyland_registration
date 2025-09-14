<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - SKYLAND Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom backdrop blur for better browser support */
        .backdrop-blur-xl {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
        
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
        
        /* Animation for floating blobs */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        /* Custom scrollbar for webkit browsers */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.5);
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 92, 246, 0.7);
        }
        
        /* Firefox scrollbar */
        .custom-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgba(139, 92, 246, 0.5) rgba(255, 255, 255, 0.1);
        }
        
        /* Glass morphism effects */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Chart.js responsive container */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        /* Ensure proper text rendering */
        * {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Fix for mobile viewport */
        @media (max-width: 768px) {
            .backdrop-blur-xl {
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
        }
    </style>
    <script>
        // Configure Tailwind
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body>
<div class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 relative">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative z-10 flex min-h-screen">
        <!-- Left Sidebar -->
        <div class="w-64 bg-black/20 backdrop-blur-xl border-r border-white/10 flex-shrink-0">
            <!-- Logo -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center mr-3">
                        <img src="{{ asset('images/logo-light-trimmed.webp') }}" alt="SKY LAND CONSTRUCTION LLC OPC" class="w-6 h-6 object-contain">
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">SKY LAND</h1>
                        <p class="text-xs text-purple-300">CONSTRUCTION</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 px-4">
                <div class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-purple-300 hover:text-white hover:bg-white/5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'text-white bg-white/10 backdrop-blur-sm border border-white/20' : '' }}">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mr-3 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-400' : '' }}"></div>
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-purple-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.clients.index') }}" class="flex items-center px-4 py-3 text-purple-300 hover:text-white hover:bg-white/5 rounded-xl transition-all {{ request()->routeIs('admin.clients.*') ? 'text-white bg-white/10 backdrop-blur-sm border border-white/20' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.clients.*') ? 'text-white' : 'text-purple-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Clients
                    </a>

                    <a href="{{ route('admin.vendors.index') }}" class="flex items-center px-4 py-3 text-purple-300 hover:text-white hover:bg-white/5 rounded-xl transition-all {{ request()->routeIs('admin.vendors.*') ? 'text-white bg-white/10 backdrop-blur-sm border border-white/20' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.vendors.*') ? 'text-white' : 'text-purple-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                        Vendors
                    </a>

                    <a href="{{ route('email-conversations.index') }}" class="flex items-center px-4 py-3 text-purple-300 hover:text-white hover:bg-white/5 rounded-xl transition-all {{ request()->routeIs('email-conversations.*') ? 'text-white bg-white/10 backdrop-blur-sm border border-white/20' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('email-conversations.*') ? 'text-white' : 'text-purple-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Conversations
                    </a>

                    <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 text-purple-300 hover:text-white hover:bg-white/5 rounded-xl transition-all {{ request()->routeIs('admin.reports.*') ? 'text-white bg-white/10 backdrop-blur-sm border border-white/20' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.reports.*') ? 'text-white' : 'text-purple-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Reports
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-purple-300 hover:text-white hover:bg-white/5 rounded-xl transition-all {{ request()->routeIs('admin.settings.*') ? 'text-white bg-white/10 backdrop-blur-sm border border-white/20' : '' }}">
                        <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-purple-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            @yield('admin-content')
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>