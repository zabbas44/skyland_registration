@extends('layouts.admin-dark')

@section('title', 'Advanced Analytics')
@section('page-title', 'Advanced Analytics')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Advanced Analytics</h1>
        <div class="flex items-center space-x-4">
            <div class="bg-white/5 backdrop-blur-sm rounded-lg px-4 py-2 border border-white/10">
                <div class="text-white text-sm font-medium">Last Updated: Just now</div>
            </div>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="flex-1 flex overflow-hidden">
    <!-- Main Dashboard Content -->
    <div class="flex-1 p-6 overflow-y-auto custom-scrollbar">
        
        <!-- Main Dashboard Layout with Right Sidebar -->
        <div class="flex gap-6">
            
            <!-- Main Content Area -->
            <div class="flex-1 space-y-6">
                
                <!-- Top Row Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Pending Clients -->
                    <div class="bg-gradient-to-br from-blue-500/15 to-cyan-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                        <h3 class="text-white font-semibold text-lg mb-4">Pending Clients</h3>
                        <div class="text-5xl font-bold text-white mb-2">1,250</div>
                        <div class="flex items-center text-green-400 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            12.3% this month
                        </div>
                    </div>

                    <!-- Pending Vendors -->
                    <div class="bg-gradient-to-br from-purple-500/15 to-pink-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 relative">
                        <h3 class="text-white font-semibold text-lg mb-4">Pending Vendors</h3>
                        <div class="text-5xl font-bold text-white mb-2">218</div>
                        <div class="flex items-center text-green-400 text-sm mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            Pending
                        </div>

                        <!-- Chart positioned in bottom right -->
                        <div class="absolute bottom-4 right-4 w-24 h-16">
                            <svg class="w-full h-full" viewBox="0 0 96 64">
                                <defs>
                                    <linearGradient id="conversationGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#ec4899;stop-opacity:0.8"/>
                                        <stop offset="100%" style="stop-color:#ec4899;stop-opacity:0.2"/>
                                    </linearGradient>
                                </defs>
                                <path d="M 0 50 Q 24 35 48 25 T 96 15" stroke="#ec4899" stroke-width="2" fill="none"/>
                                <path d="M 0 50 Q 24 35 48 25 T 96 15 L 96 64 L 0 64 Z" fill="url(#conversationGradient)"/>
                            </svg>
                        </div>

                        <!-- Chart labels -->
                        <div class="absolute bottom-0 right-0 flex space-x-2 text-xs text-purple-300 p-2">
                            <span>Apr</span>
                            <span>May</span>
                            <span>Jun</span>
                        </div>
                    </div>
                    
                </div>

                <!-- Growth Analytics -->
                <div class="bg-gradient-to-br from-indigo-500/15 to-purple-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                    <h3 class="text-white font-semibold text-lg mb-6">Growth Analytics</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <!-- Client Growth Chart -->
                        <div class="lg:col-span-1">
                            <h4 class="text-white font-medium text-sm mb-4">Client Growth</h4>
                            <div class="h-32 relative">
                                <svg class="w-full h-full" viewBox="0 0 200 128">
                                    <defs>
                                        <linearGradient id="clientGrowthGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.6"/>
                                            <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0.1"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M 0 100 Q 50 85 100 70 T 200 45" stroke="#3b82f6" stroke-width="2" fill="none"/>
                                    <path d="M 0 100 Q 50 85 100 70 T 200 45 L 200 128 L 0 128 Z" fill="url(#clientGrowthGradient)"/>
                                    <!-- Data Points -->
                                    <circle cx="0" cy="100" r="3" fill="#3b82f6"/>
                                    <circle cx="100" cy="70" r="3" fill="#3b82f6"/>
                                    <circle cx="200" cy="45" r="3" fill="#3b82f6"/>
                                </svg>
                                <div class="absolute bottom-1 left-0 right-0 flex justify-between text-xs text-blue-300 px-2">
                                    <span>Apr</span>
                                    <span>May</span>
                                    <span>Jun</span>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <div class="text-2xl font-bold text-blue-400">1,250</div>
                                <div class="text-xs text-blue-300">Total Clients</div>
                                <div class="text-xs text-green-400 flex items-center justify-center mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    +15.2%
                                </div>
                            </div>
                        </div>

                        <!-- Vendor Growth Chart -->
                        <div class="lg:col-span-1">
                            <h4 class="text-white font-medium text-sm mb-4">Vendor Growth</h4>
                            <div class="h-32 relative">
                                <svg class="w-full h-full" viewBox="0 0 200 128">
                                    <defs>
                                        <linearGradient id="vendorGrowthGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.6"/>
                                            <stop offset="100%" style="stop-color:#10b981;stop-opacity:0.1"/>
                                        </linearGradient>
                                    </defs>
                                    <path d="M 0 110 Q 50 95 100 75 T 200 55" stroke="#10b981" stroke-width="2" fill="none"/>
                                    <path d="M 0 110 Q 50 95 100 75 T 200 55 L 200 128 L 0 128 Z" fill="url(#vendorGrowthGradient)"/>
                                    <!-- Data Points -->
                                    <circle cx="0" cy="110" r="3" fill="#10b981"/>
                                    <circle cx="100" cy="75" r="3" fill="#10b981"/>
                                    <circle cx="200" cy="55" r="3" fill="#10b981"/>
                                </svg>
                                <div class="absolute bottom-1 left-0 right-0 flex justify-between text-xs text-emerald-300 px-2">
                                    <span>Apr</span>
                                    <span>May</span>
                                    <span>Jun</span>
                                </div>
                            </div>
                            <div class="mt-2 text-center">
                                <div class="text-2xl font-bold text-emerald-400">847</div>
                                <div class="text-xs text-emerald-300">Total Vendors</div>
                                <div class="text-xs text-green-400 flex items-center justify-center mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    +12.8%
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Pie Chart -->
                        <div class="lg:col-span-1">
                            <h4 class="text-white font-medium text-sm mb-4">Registration Distribution</h4>
                            <div class="flex items-center justify-center h-32">
                                <div class="relative">
                                    <!-- Outer glow effect -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-emerald-500/20 rounded-full blur-md scale-110"></div>
                                    
                                    <!-- Main pie chart -->
                                    <div class="relative">
                                        <svg class="w-32 h-32 transform -rotate-90 drop-shadow-xl" viewBox="0 0 120 120">
                                            <defs>
                                                <linearGradient id="clientPieGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:1"/>
                                                    <stop offset="100%" style="stop-color:#1d4ed8;stop-opacity:1"/>
                                                </linearGradient>
                                                <linearGradient id="vendorPieGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#10b981;stop-opacity:1"/>
                                                    <stop offset="100%" style="stop-color:#059669;stop-opacity:1"/>
                                                </linearGradient>
                                                <filter id="pieGlow" x="-50%" y="-50%" width="200%" height="200%">
                                                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                                    <feMerge> 
                                                        <feMergeNode in="coloredBlur"/>
                                                        <feMergeNode in="SourceGraphic"/>
                                                    </feMerge>
                                                </filter>
                                            </defs>
                                            
                                            <!-- Background circle -->
                                            <circle cx="60" cy="60" r="45" fill="none" stroke="#1f2937" stroke-width="8" opacity="0.3"/>
                                            
                                            <!-- Clients segment (59.6%) -->
                                            <circle cx="60" cy="60" r="45" fill="none" stroke="url(#clientPieGradient)" 
                                                    stroke-width="8" stroke-dasharray="168.3 282.6" stroke-dashoffset="0" 
                                                    filter="url(#pieGlow)" stroke-linecap="round"/>
                                            
                                            <!-- Vendors segment (40.4%) -->
                                            <circle cx="60" cy="60" r="45" fill="none" stroke="url(#vendorPieGradient)" 
                                                    stroke-width="8" stroke-dasharray="114.2 282.6" stroke-dashoffset="-168.3" 
                                                    filter="url(#pieGlow)" stroke-linecap="round"/>
                                        </svg>
                                        
                                        <!-- Center content -->
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="text-center bg-black/20 backdrop-blur-sm rounded-full w-16 h-16 flex items-center justify-center border border-white/10">
                                                <div>
                                                    <div class="text-lg font-bold text-white">2,097</div>
                                                    <div class="text-xs text-purple-300">Total</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Percentage labels -->
                                        <div class="absolute top-2 right-2 bg-gradient-to-r from-blue-500/90 to-blue-600/90 backdrop-blur-sm px-2 py-1 rounded-md border border-blue-400/30 shadow-lg">
                                            <div class="text-white font-bold text-xs">59.6%</div>
                                        </div>

                                        <div class="absolute bottom-2 left-2 bg-gradient-to-r from-emerald-500/90 to-emerald-600/90 backdrop-blur-sm px-2 py-1 rounded-md border border-emerald-400/30 shadow-lg">
                                            <div class="text-white font-bold text-xs">40.4%</div>
                                        </div>
                                    </div>
                                </div>

                            <!-- Compact Legend -->
                            <div class="mt-2 space-y-1">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                        <span class="text-blue-300">Clients</span>
                                    </div>
                                    <span class="text-white font-medium">1,250</span>
                                </div>
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                                        <span class="text-emerald-300">Vendors</span>
                                    </div>
                                    <span class="text-white font-medium">847</span>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Live Registration Map -->
                <!-- Global Registration Map -->
                <div class="bg-gradient-to-br from-slate-500/10 to-gray-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-6 relative overflow-hidden">
                    <!-- Background decorative elements -->
                    <div class="absolute top-0 left-0 w-40 h-40 bg-gradient-to-br from-blue-400/5 to-cyan-400/5 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tr from-emerald-400/5 to-green-400/5 rounded-full blur-2xl"></div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-white font-bold text-xl mb-2">Live Registration Map</h3>
                                <p class="text-slate-300 text-sm">Real-time global registration activity</p>
                            </div>
                            <div class="flex items-center space-x-2 bg-white/5 rounded-lg p-2">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-green-400 text-xs font-medium">Live Updates</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-center">
                            
                            <!-- World Map -->
                            <div class="lg:col-span-3">
                                <div class="rounded-2xl p-6 border border-slate-700/30 relative overflow-hidden shadow-2xl">
                                    <!-- Modern Header with Controls -->
                                    <div class="flex items-center justify-between mb-4 relative z-20">
                                        <div class="flex items-center space-x-4">
                                            <h3 class="text-white font-bold text-lg">Global Registration Activity</h3>
                                            <div class="flex items-center space-x-2 bg-slate-800/50 rounded-lg px-3 py-1">
                                                <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                                <span class="text-emerald-400 text-xs font-medium">Real-time</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button class="bg-slate-800/50 hover:bg-slate-700/50 transition-colors px-3 py-1 rounded-md text-slate-300 text-xs">
                                                Today
                                            </button>
                                            <button class="bg-blue-600/20 hover:bg-blue-500/30 transition-colors px-3 py-1 rounded-md text-blue-300 text-xs">
                                                This Week
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Stylized World Map -->
                                    <div class="relative h-64 rounded-xl overflow-hidden">
                                        <svg class="w-full h-full" viewBox="0 0 800 400" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                                            <defs>
                                                <filter id="markerGlow" x="-50%" y="-50%" width="200%" height="200%">
                                                    <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                                                    <feMerge> 
                                                        <feMergeNode in="coloredBlur"/>
                                                        <feMergeNode in="SourceGraphic"/>
                                                    </feMerge>
                                                </filter>
                                                <radialGradient id="pulseGradient" cx="50%" cy="50%" r="50%">
                                                    <stop offset="0%" style="stop-color:white;stop-opacity:0.8"/>
                                                    <stop offset="100%" style="stop-color:white;stop-opacity:0"/>
                                                </radialGradient>
                                            </defs>
                                            
                                            <!-- Continents (simplified outlines) -->
                                            <g fill="#334155" stroke="#475569" stroke-width="0.5" opacity="0.7">
                                                <!-- North America -->
                                                <path d="M 50 80 Q 100 60 150 80 L 180 120 Q 160 150 120 140 L 80 160 Q 40 140 50 80 Z"/>
                                                <!-- Europe -->
                                                <path d="M 350 70 Q 380 60 400 80 L 420 100 Q 400 120 380 110 L 360 120 Q 340 100 350 70 Z"/>
                                                <!-- Asia -->
                                                <path d="M 450 60 Q 550 50 650 80 L 700 120 Q 680 160 620 150 L 500 140 Q 430 120 450 60 Z"/>
                                                <!-- Africa -->
                                                <path d="M 380 140 Q 420 130 450 160 L 460 220 Q 440 280 400 270 L 370 250 Q 360 200 380 140 Z"/>
                                                <!-- South America -->
                                                <path d="M 200 180 Q 230 170 250 200 L 260 280 Q 240 320 210 310 L 190 280 Q 180 230 200 180 Z"/>
                                                <!-- Australia -->
                                                <path d="M 620 280 Q 660 270 680 290 L 690 310 Q 670 330 640 320 L 610 310 Q 600 290 620 280 Z"/>
                                            </g>
                                            
                                            <!-- Registration markers with pulsing animation -->
                                            <!-- Dubai, UAE -->
                                            <g class="live-marker">
                                                <circle cx="480" cy="150" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;8;2" dur="2s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="480" cy="150" r="3" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- Mumbai, India -->
                                            <g class="live-marker">
                                                <circle cx="520" cy="160" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;6;2" dur="1.5s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="520" cy="160" r="2" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- New York, USA -->
                                            <g class="live-marker">
                                                <circle cx="120" cy="100" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;7;2" dur="1.8s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="120" cy="100" r="2" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- London, UK -->
                                            <g class="live-marker">
                                                <circle cx="370" cy="90" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;5;2" dur="2.2s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="370" cy="90" r="2" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- Tokyo, Japan -->
                                            <g class="live-marker">
                                                <circle cx="680" cy="110" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;6;2" dur="1.7s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="680" cy="110" r="2" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- Sydney, Australia -->
                                            <g class="live-marker">
                                                <circle cx="670" cy="300" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;5;2" dur="2.1s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="670" cy="300" r="2" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- São Paulo, Brazil -->
                                            <g class="live-marker">
                                                <circle cx="230" cy="250" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;6;2" dur="1.6s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="230" cy="250" r="2" fill="white" opacity="1"/>
                                            </g>
                                            
                                            <!-- Lagos, Nigeria -->
                                            <g class="live-marker">
                                                <circle cx="400" cy="180" r="2" fill="white" opacity="0.2" filter="url(#markerGlow)">
                                                    <animate attributeName="r" values="2;6;2" dur="1.9s" repeatCount="indefinite"/>
                                                </circle>
                                                <circle cx="400" cy="180" r="2" fill="white" opacity="1"/>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Statistics -->
                            <div class="lg:col-span-1 space-y-4">
                                <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                                    <h4 class="text-white font-semibold mb-3">Top Locations</h4>
                                    
                                    <!-- Location list -->
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                                <span class="text-white text-sm">UAE</span>
                                            </div>
                                            <span class="text-blue-400 font-semibold text-sm">342</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                                <span class="text-white text-sm">India</span>
                                            </div>
                                            <span class="text-emerald-400 font-semibold text-sm">298</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                                <span class="text-white text-sm">USA</span>
                                            </div>
                                            <span class="text-blue-400 font-semibold text-sm">156</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                                <span class="text-white text-sm">Canada</span>
                                            </div>
                                            <span class="text-emerald-400 font-semibold text-sm">89</span>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                                <span class="text-white text-sm">UK</span>
                                            </div>
                                            <span class="text-blue-400 font-semibold text-sm">67</span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                                <span class="text-white text-sm">Australia</span>
                                            </div>
                                            <span class="text-emerald-400 font-semibold text-sm">43</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Legend -->
                                <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                                    <h4 class="text-white font-semibold mb-3">Legend</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                            <span class="text-blue-300 text-xs">Client Registrations</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                            <span class="text-emerald-300 text-xs">Vendor Registrations</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Live Activity Status -->
                                <div class="bg-gradient-to-br from-green-500/10 to-emerald-500/10 rounded-lg p-4 border border-green-500/20">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-white font-semibold text-sm">Live Activity</h4>
                                        <div class="flex items-center space-x-1">
                                            <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                            <span class="text-slate-300 text-xs">Live Activity</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Registration Tracking Table -->
                <!-- Registration Tracking Table -->
                <div class="bg-gradient-to-br from-gray-500/10 to-slate-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-white font-semibold text-lg">Registration Tracking</h3>
                        <div class="flex items-center bg-red-500/20 text-red-300 px-3 py-1 rounded-lg text-sm">
                            <span>Name</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Table Header -->
                    <div class="grid grid-cols-4 gap-4 mb-4 text-purple-300 text-sm font-medium">
                        <div>Name</div>
                        <div>Type</div>
                        <div>Status</div>
                        <div>Date</div>
                    </div>

                    <!-- Table Rows -->
                    <div class="space-y-2">
                        <div class="grid grid-cols-4 gap-4 items-center py-2 text-sm">
                            <div class="text-white font-medium">Tom Smith</div>
                            <div class="text-purple-300">Client</div>
                            <div><span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-xs">Approved</span></div>
                            <div class="text-purple-300">02/14/2024</div>
                        </div>
                        <div class="grid grid-cols-4 gap-4 items-center py-2 text-sm">
                            <div class="text-white font-medium">Acme Corp</div>
                            <div class="text-purple-300">Vendor</div>
                            <div><span class="px-3 py-1 bg-orange-500/20 text-orange-300 rounded-full text-xs">Pending</span></div>
                            <div class="text-purple-300">02/16/2024</div>
                        </div>
                        <div class="grid grid-cols-4 gap-4 items-center py-2 text-sm">
                            <div class="text-white font-medium">Jane Williams</div>
                            <div class="text-purple-300">Vendor</div>
                            <div><span class="px-3 py-1 bg-green-500/20 text-green-300 rounded-full text-xs">Approved</span></div>
                            <div class="text-purple-300">02/15/2024</div>
                        </div>
                        <div class="grid grid-cols-4 gap-4 items-center py-2 text-sm">
                            <div class="text-white font-medium">Sarah Brown</div>
                            <div class="text-purple-300">Build-It LLC</div>
                            <div><span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-xs">View</span></div>
                            <div class="text-purple-300">02/13/2024</div>
                        </div>
                        <div class="grid grid-cols-4 gap-4 items-center py-2 text-sm">
                            <div class="text-white font-medium">Sarah Brown</div>
                            <div class="text-purple-300">Vendor</div>
                            <div class="flex items-center">
                                <span class="text-white font-medium text-xs">A</span>
                                <svg class="w-3 h-3 text-purple-300 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                            <div class="text-purple-300">02/16/2024</div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <!-- Right Sidebar -->
            <div class="w-80 flex-shrink-0 space-y-6">
                
                <!-- Conversations Box -->
                <div class="bg-gradient-to-br from-purple-500/15 to-pink-500/15 backdrop-blur-xl border border-white/10 rounded-xl p-4">
                    <!-- Header -->
                    <div class="mb-4">
                        <h3 class="text-white font-semibold text-sm">Conversations</h3>
                    </div>

                    <!-- Client Messages List -->
                    <div class="space-y-3">
                        @forelse($recentConversations as $conversation)
                            @php
                                $entity = $conversation->getEntity();
                                $entityName = 'Unknown';
                                $entityType = ucfirst($conversation->entity_type);
                                
                                if ($entity) {
                                    if ($conversation->entity_type === 'client') {
                                        $entityName = $entity->full_name ?? ($entity->first_name . ' ' . $entity->last_name) ?? 'Unknown Client';
                                    } else {
                                        $entityName = ($entity->first_name . ' ' . $entity->last_name) ?? $entity->company_name ?? 'Unknown Vendor';
                                    }
                                }
                                
                                // Generate a consistent color based on entity name
                                $colors = [
                                    ['from-orange-400', 'to-orange-600'],
                                    ['from-pink-400', 'to-pink-600'],
                                    ['from-amber-400', 'to-orange-500'],
                                    ['from-blue-400', 'to-blue-600'],
                                    ['from-green-400', 'to-green-600'],
                                    ['from-purple-400', 'to-purple-600'],
                                    ['from-indigo-400', 'to-indigo-600'],
                                    ['from-cyan-400', 'to-cyan-600'],
                                ];
                                $colorIndex = abs(crc32($entityName)) % count($colors);
                                $selectedColor = $colors[$colorIndex];
                                
                                // Format the timestamp
                                $timeAgo = $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : 'New conversation';
                            @endphp
                            
                            <div class="bg-white/5 border border-white/10 rounded-lg p-3 hover:bg-white/10 transition-colors">
                                <div class="flex items-start space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ $selectedColor[0] }} {{ $selectedColor[1] }} flex items-center justify-center overflow-hidden">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($entityName) }}&background={{ substr(md5($entityName), 0, 6) }}&color=fff&size=32" 
                                             alt="{{ $entityName }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <div class="text-white font-medium text-xs">{{ $entityName }}</div>
                                            <div class="text-purple-200 text-xs">{{ $timeAgo }}</div>
                                        </div>
                                        <div class="text-purple-100 text-xs leading-tight mb-1">
                                            <span class="text-purple-300 text-xs">{{ $entityType }}:</span>
                                            {{ Str::limit($conversation->last_message_preview ?? 'No message preview available', 50) }}
                                        </div>
                                        @if($conversation->unread_count_admin > 0)
                                            <div class="mb-2">
                                                <span class="bg-red-500/20 text-red-300 px-2 py-1 rounded-full text-xs">
                                                    {{ $conversation->unread_count_admin }} unread
                                                </span>
                                            </div>
                                        @endif
                                        <div class="flex items-center justify-end">
                                            <button class="bg-purple-500/20 hover:bg-purple-500/40 transition-colors px-2 py-1 rounded text-purple-300 text-xs flex items-center space-x-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                </svg>
                                                <span>Reply</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <!-- Show recent clients/vendors if no conversations exist -->
                            @if($recentClients->isNotEmpty() || $recentVendors->isNotEmpty())
                                <div class="space-y-3">
                                    <div class="text-center py-2">
                                        <div class="text-purple-300 text-sm mb-1">No conversations yet</div>
                                        <div class="text-purple-400 text-xs">Recent registrations:</div>
                                    </div>
                                    
                                    @foreach($recentClients->take(3) as $client)
                                        @php
                                            $clientName = $client->full_name ?? ($client->first_name . ' ' . $client->last_name) ?? 'Unknown Client';
                                            $colors = [
                                                ['from-blue-400', 'to-blue-600'],
                                                ['from-green-400', 'to-green-600'],
                                                ['from-purple-400', 'to-purple-600'],
                                            ];
                                            $colorIndex = abs(crc32($clientName)) % count($colors);
                                            $selectedColor = $colors[$colorIndex];
                                        @endphp
                                        <div class="bg-white/5 border border-white/10 rounded-lg p-3 hover:bg-white/10 transition-colors">
                                            <div class="flex items-start space-x-2">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ $selectedColor[0] }} {{ $selectedColor[1] }} flex items-center justify-center overflow-hidden">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($clientName) }}&background={{ substr(md5($clientName), 0, 6) }}&color=fff&size=32" 
                                                         alt="{{ $clientName }}" 
                                                         class="w-full h-full object-cover">
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <div class="text-white font-medium text-xs">{{ $clientName }}</div>
                                                        <div class="text-purple-200 text-xs">{{ $client->created_at->diffForHumans() }}</div>
                                                    </div>
                                                    <div class="text-purple-100 text-xs leading-tight mb-2">
                                                        <span class="text-blue-300 text-xs">Client:</span>
                                                        New registration - no messages yet
                                                    </div>
                                                    <div class="flex items-center justify-end">
                                                        <button class="bg-blue-500/20 hover:bg-blue-500/40 transition-colors px-2 py-1 rounded text-blue-300 text-xs flex items-center space-x-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                            </svg>
                                                            <span>Start Chat</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @foreach($recentVendors->take(2) as $vendor)
                                        @php
                                            $vendorName = ($vendor->first_name . ' ' . $vendor->last_name) ?? $vendor->company_name ?? 'Unknown Vendor';
                                            $colors = [
                                                ['from-orange-400', 'to-orange-600'],
                                                ['from-pink-400', 'to-pink-600'],
                                                ['from-amber-400', 'to-orange-500'],
                                            ];
                                            $colorIndex = abs(crc32($vendorName)) % count($colors);
                                            $selectedColor = $colors[$colorIndex];
                                        @endphp
                                        <div class="bg-white/5 border border-white/10 rounded-lg p-3 hover:bg-white/10 transition-colors">
                                            <div class="flex items-start space-x-2">
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br {{ $selectedColor[0] }} {{ $selectedColor[1] }} flex items-center justify-center overflow-hidden">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($vendorName) }}&background={{ substr(md5($vendorName), 0, 6) }}&color=fff&size=32" 
                                                         alt="{{ $vendorName }}" 
                                                         class="w-full h-full object-cover">
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <div class="text-white font-medium text-xs">{{ $vendorName }}</div>
                                                        <div class="text-purple-200 text-xs">{{ $vendor->created_at->diffForHumans() }}</div>
                                                    </div>
                                                    <div class="text-purple-100 text-xs leading-tight mb-2">
                                                        <span class="text-orange-300 text-xs">Vendor:</span>
                                                        New registration - no messages yet
                                                    </div>
                                                    <div class="flex items-center justify-end">
                                                        <button class="bg-orange-500/20 hover:bg-orange-500/40 transition-colors px-2 py-1 rounded text-orange-300 text-xs flex items-center space-x-1">
                                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                            </svg>
                                                            <span>Start Chat</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="text-purple-300 text-sm mb-2">No conversations yet</div>
                                    <div class="text-purple-400 text-xs">New conversations will appear here</div>
                                </div>
                            @endif
                        @endforelse
                    </div>
                </div>

                <!-- AI Assistant Box -->
                <div class="bg-gradient-to-br from-indigo-500/15 to-blue-500/15 backdrop-blur-xl border border-white/10 rounded-xl p-4">
                    <!-- Header -->
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-white font-bold text-sm">AI Assistant</h3>
                        <div class="ml-auto">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                    
                    <!-- AI Response -->
                    <div class="bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-lg p-3 border border-indigo-400/20 mb-3">
                        <div class="text-purple-100 text-sm leading-relaxed">
                            Sure, let's schedule a meeting. I can help you with registration processes and answer any questions you have.
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="flex items-center space-x-2">
                        <button class="bg-blue-500/20 hover:bg-blue-500/30 transition-colors px-3 py-1 rounded-md text-blue-300 text-xs">
                            Ask Question
                        </button>
                        <button class="bg-purple-500/20 hover:bg-purple-500/30 transition-colors px-3 py-1 rounded-md text-purple-300 text-xs">
                            Get Help
                        </button>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>

@endsection