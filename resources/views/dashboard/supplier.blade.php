@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4 rounded-2xl mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome back, {{ explode(' ', $supplier->first_name)[0] }}! 🤝</h1>
                    <p class="text-slate-300">Your supplier partnership dashboard with real-time analytics</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-green-500 text-white rounded-full text-sm font-medium shadow-lg">
                        Supplier ID: #SUP{{ str_pad($supplier->id, 6, '0', STR_PAD_LEFT) }}
                    </span>
                    
                    <!-- Email Conversations Button -->
                    <a href="{{ route('email-conversations.index') }}" 
                       class="relative px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white rounded-xl font-medium transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Messages</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/30 backdrop-blur-sm rounded-lg px-4 py-2 border border-red-400/20 text-red-300 hover:text-red-200 transition-all duration-200 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="text-sm font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Status Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Partnership Status Card -->
            <div class="bg-gradient-to-br from-emerald-500/15 to-green-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl @if($supplier->status === 'approved') bg-green-500/20 @elseif($supplier->status === 'rejected') bg-red-500/20 @else bg-yellow-500/20 @endif">
                        @if($supplier->status === 'approved')
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @elseif($supplier->status === 'rejected')
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                    </div>
                    <span class="text-2xl">
                        @if($supplier->status === 'approved') 🤝
                        @elseif($supplier->status === 'rejected') 📞
                        @else ⏳ @endif
                    </span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Partnership Status</h3>
                <p class="text-3xl font-bold @if($supplier->status === 'approved') text-green-400 @elseif($supplier->status === 'rejected') text-red-400 @else text-yellow-400 @endif mb-1">
                    {{ $supplier->status_display }}
                </p>
                @if($supplier->status_updated_at)
                    <p class="text-sm text-slate-400">Updated {{ $supplier->status_updated_at->diffForHumans() }}</p>
                @endif
            </div>

            <!-- Trade License Status Card -->
            <div class="bg-gradient-to-br from-orange-500/15 to-red-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:shadow-xl transition-all duration-200">
                @php
                    // Mock trade license expiration date (you can get this from database)
                    $licenseExpiry = now()->addMonths(3); // Example: expires in 3 months
                    $daysUntilExpiry = now()->diffInDays($licenseExpiry);
                    $isExpiringSoon = $daysUntilExpiry <= 30;
                    $isExpired = $licenseExpiry->isPast();
                @endphp
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl @if($isExpired) bg-red-500/20 @elseif($isExpiringSoon) bg-orange-500/20 @else bg-green-500/20 @endif">
                        @if($isExpired)
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @elseif($isExpiringSoon)
                            <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        @endif
                    </div>
                    <span class="text-2xl">
                        @if($isExpired) ❌
                        @elseif($isExpiringSoon) ⚠️
                        @else ✅ @endif
                    </span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Trade License</h3>
                <p class="text-2xl font-bold @if($isExpired) text-red-400 @elseif($isExpiringSoon) text-orange-400 @else text-green-400 @endif mb-1">
                    @if($isExpired) Expired
                    @elseif($isExpiringSoon) {{ $daysUntilExpiry }} Days Left
                    @else Valid @endif
                </p>
                <p class="text-sm text-slate-400">Expires {{ $licenseExpiry->format('M j, Y') }}</p>
                
                @if($isExpired || $isExpiringSoon)
                <div class="mt-3">
                    <button onclick="openLicenseUploadModal()" class="w-full px-3 py-2 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-lg text-sm font-medium transition-all">
                        Update License
                    </button>
                </div>
                @endif
            </div>

            <!-- Business Performance Card -->
            <div class="bg-gradient-to-br from-purple-500/15 to-pink-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-500/20 rounded-xl">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl">📈</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Business Performance</h3>
                <p class="text-2xl font-bold text-purple-400 mb-1">{{ $supplier->status === 'approved' ? '85%' : '45%' }}</p>
                <p class="text-sm text-slate-400">Overall Score</p>
            </div>
        </div>

        <!-- Analytics Dashboard -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Partnership Timeline -->
            <div class="bg-gradient-to-br from-indigo-500/15 to-blue-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                <h3 class="text-white font-semibold text-lg mb-6">Partnership Timeline</h3>
                
                <!-- Timeline Chart -->
                <div class="h-48 relative mb-4">
                    <svg class="w-full h-full" viewBox="0 0 400 200">
                        <defs>
                            <linearGradient id="partnershipGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#10b981;stop-opacity:0.6"/>
                                <stop offset="100%" style="stop-color:#10b981;stop-opacity:0.1"/>
                            </linearGradient>
                        </defs>
                        
                        <!-- Grid lines -->
                        <line x1="0" y1="40" x2="400" y2="40" stroke="#ffffff10" stroke-width="1"/>
                        <line x1="0" y1="80" x2="400" y2="80" stroke="#ffffff10" stroke-width="1"/>
                        <line x1="0" y1="120" x2="400" y2="120" stroke="#ffffff10" stroke-width="1"/>
                        <line x1="0" y1="160" x2="400" y2="160" stroke="#ffffff10" stroke-width="1"/>
                        
                        <!-- Partnership path -->
                        <path d="M 50 150 Q 100 130 150 110 T 250 90 Q 300 85 350 80" stroke="#10b981" stroke-width="3" fill="none"/>
                        <path d="M 50 150 Q 100 130 150 110 T 250 90 Q 300 85 350 80 L 350 180 L 50 180 Z" fill="url(#partnershipGradient)"/>
                        
                        <!-- Milestone points -->
                        <circle cx="50" cy="150" r="4" fill="#10b981" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="150" cy="110" r="4" fill="#10b981" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="250" cy="90" r="4" fill="#10b981" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="350" cy="80" r="4" fill="#3b82f6" stroke="#ffffff" stroke-width="2"/>
                    </svg>
                    
                    <!-- Timeline labels -->
                    <div class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-emerald-300 px-4">
                        <span>Application</span>
                        <span>Documents</span>
                        <span>Verification</span>
                        <span>{{ $supplier->status === 'approved' ? 'Partnership' : 'Current' }}</span>
                    </div>
                </div>
                
                <!-- Timeline stats -->
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-emerald-400">{{ $supplier->created_at->diffInDays(now()) }}</div>
                        <div class="text-xs text-emerald-300">Days Since Application</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-blue-400">{{ $supplier->status === 'approved' ? '100' : '75' }}%</div>
                        <div class="text-xs text-blue-300">Process Complete</div>
                    </div>
                </div>
            </div>

            <!-- License & Documents Analytics -->
            <div class="bg-gradient-to-br from-orange-500/15 to-red-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                <h3 class="text-white font-semibold text-lg mb-6">License & Documents</h3>
                
                <!-- Document Status Chart -->
                <div class="h-48 relative flex items-center justify-center">
                    <div class="relative">
                        <!-- Outer glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-orange-500/20 to-red-500/20 rounded-full blur-md scale-110"></div>
                        
                        <!-- Main donut chart -->
                        <div class="relative">
                            @php
                                $documentsCount = 0;
                                $documentsCount += $supplier->trade_license_path ? 1 : 0;
                                $documentsCount += $supplier->vat_certificate_path ? 1 : 0;
                                $documentsCount += $supplier->company_profile_path ? 1 : 0;
                                $totalDocuments = 3;
                                $completionRate = ($documentsCount / $totalDocuments) * 100;
                                $circumference = 220;
                                $completionArc = ($completionRate / 100) * $circumference;
                            @endphp
                            <svg class="w-32 h-32 transform -rotate-90 drop-shadow-xl" viewBox="0 0 100 100">
                                <defs>
                                    <linearGradient id="documentGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#f97316;stop-opacity:1"/>
                                        <stop offset="100%" style="stop-color:#ef4444;stop-opacity:1"/>
                                    </linearGradient>
                                </defs>
                                <circle cx="50" cy="50" r="35" fill="none" stroke="#ffffff10" stroke-width="8"/>
                                <circle cx="50" cy="50" r="35" fill="none" stroke="url(#documentGradient)" stroke-width="8" 
                                        stroke-dasharray="{{ $completionArc }} {{ $circumference }}" stroke-dashoffset="0" stroke-linecap="round"/>
                                <text x="50" y="55" text-anchor="middle" class="text-xs fill-white font-bold">{{ number_format($completionRate, 0) }}%</text>
                            </svg>
                        </div>
                        
                        <!-- Center content -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center bg-black/20 backdrop-blur-sm rounded-full w-16 h-16 flex items-center justify-center border border-white/10">
                                <div>
                                    <div class="text-lg font-bold text-white">{{ $documentsCount }}/{{ $totalDocuments }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Document stats -->
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-orange-400">{{ $documentsCount }}</div>
                        <div class="text-xs text-orange-300">Documents Uploaded</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-red-400">{{ $isExpired ? 'Expired' : ($isExpiringSoon ? 'Soon' : 'Valid') }}</div>
                        <div class="text-xs text-red-300">License Status</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- License Expiration Alert -->
        @if($isExpired || $isExpiringSoon)
        <div class="bg-gradient-to-r from-orange-500/20 to-red-500/20 backdrop-blur-xl border border-orange-500/30 rounded-2xl p-6 mb-8">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="p-3 @if($isExpired) bg-red-500/20 @else bg-orange-500/20 @endif rounded-xl">
                        @if($isExpired)
                            <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        @endif
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-white mb-2">
                        @if($isExpired) 🚨 Trade License Expired
                        @else ⚠️ Trade License Expiring Soon @endif
                    </h3>
                    <p class="text-slate-300 mb-4">
                        @if($isExpired)
                            Your trade license has expired on {{ $licenseExpiry->format('F j, Y') }}. Please update it immediately to maintain your partnership status.
                        @else
                            Your trade license will expire in {{ $daysUntilExpiry }} days ({{ $licenseExpiry->format('F j, Y') }}). Please update it before expiration.
                        @endif
                    </p>
                    <button onclick="openLicenseUploadModal()" class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white rounded-xl font-medium transition-all duration-200 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span>Update License Now</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Status Details Section -->
        @if($supplier->status_reason || $supplier->status === 'approved' || $supplier->status === 'rejected' || $supplier->status === 'pending')
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 mb-8">
            @if($supplier->status === 'approved')
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500/20 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">🤝 Welcome Partner!</h2>
                    <p class="text-slate-300">Your supplier registration has been approved. Welcome to our partner network!</p>
                </div>
                <div class="bg-green-500/10 rounded-xl p-6 border border-green-500/20">
                    <h4 class="text-lg font-semibold text-green-400 mb-3">🚀 Partnership Benefits</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">1</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Project Access</p>
                                <p class="text-green-300 text-sm">Access to construction projects & tenders</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">2</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Priority Status</p>
                                <p class="text-green-300 text-sm">Priority consideration for relevant projects</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">3</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Streamlined Process</p>
                                <p class="text-green-300 text-sm">Efficient procurement workflows</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">4</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Growth Opportunities</p>
                                <p class="text-green-300 text-sm">Business expansion possibilities</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($supplier->status === 'rejected')
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-500/20 rounded-full mb-4">
                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">📞 Let's Discuss This</h2>
                    <p class="text-slate-300">Your application needs attention. Please contact our procurement team to resolve any issues.</p>
                </div>
                <div class="bg-red-500/10 rounded-xl p-6 border border-red-500/20">
                    <h4 class="text-lg font-semibold text-red-400 mb-3">📞 Procurement Team Contact</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-red-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-400 font-medium">Email Support</p>
                                <p class="text-red-300">procurement@skylandconstruction.com</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-red-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-400 font-medium">Phone Support</p>
                                <p class="text-red-300">+971 XX XXX XXXX</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-500/20 rounded-full mb-4">
                        <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">⏳ Review in Progress</h2>
                    <p class="text-slate-300">Our procurement team is reviewing your supplier application. You'll be notified once complete.</p>
                </div>
                <div class="bg-yellow-500/10 rounded-xl p-6 border border-yellow-500/20">
                    <h4 class="text-lg font-semibold text-yellow-400 mb-3">⏳ What's Happening?</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">1</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Credential Verification</p>
                                <p class="text-yellow-300 text-sm">Verifying business credentials</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">2</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Document Review</p>
                                <p class="text-yellow-300 text-sm">Reviewing submitted documentation</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">3</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Email Notification</p>
                                <p class="text-yellow-300 text-sm">You'll receive updates via email</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">4</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Typical Timeline</p>
                                <p class="text-yellow-300 text-sm">2-3 business days</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($supplier->status_reason)
                <div class="mt-6 p-4 bg-white/5 rounded-xl border border-white/10">
                    <h4 class="text-sm font-semibold text-white mb-2">
                        @if($supplier->status === 'approved') Admin Notes:
                        @elseif($supplier->status === 'rejected') Reason for Status:
                        @else Additional Information: @endif
                    </h4>
                    <p class="text-slate-300 leading-relaxed">{{ $supplier->status_reason }}</p>
                </div>
            @endif
        </div>
        @endif

        <!-- Registration Details -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-lg mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Supplier Profile</h2>
                <div class="px-4 py-2 bg-emerald-500/20 text-emerald-300 rounded-xl text-sm font-medium border border-emerald-500/30">
                    Complete Profile
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Contact Information -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-blue-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Contact Information</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Contact Person</label>
                            <p class="text-white font-medium">{{ $supplier->first_name }} {{ $supplier->last_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Designation</label>
                            <p class="text-white font-medium">{{ $supplier->contact_designation }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Contact Email</label>
                            <p class="text-white font-medium">{{ $supplier->contact_email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Mobile</label>
                            <p class="text-white font-medium">{{ $supplier->contact_mobile }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Registration Date</label>
                            <p class="text-white font-medium">{{ $supplier->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-emerald-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Company Information</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Company Name</label>
                            <p class="text-white font-medium">{{ $supplier->company_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Business Type</label>
                            <p class="text-white font-medium">{{ $supplier->business_type }}</p>
                        </div>
                        @if($supplier->nature_of_business)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Nature of Business</label>
                            <p class="text-white font-medium">{{ $supplier->nature_of_business }}</p>
                        </div>
                        @endif
                        @if($supplier->year_of_establishment)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Established</label>
                            <p class="text-white font-medium">{{ $supplier->year_of_establishment }}</p>
                        </div>
                        @endif
                        @if($supplier->website)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Website</label>
                            <a href="{{ $supplier->website }}" target="_blank" class="text-emerald-400 hover:text-emerald-300 font-medium underline">
                                {{ $supplier->website }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Business Details -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-purple-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m-2 0v6a2 2 0 002 2h6a2 2 0 002-2v-6m0 0V9a2 2 0 00-2-2h-2m0 0V5a2 2 0 00-2-2H9v2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Business Details</h3>
                    </div>
                    <div class="space-y-4">
                        @if($supplier->trade_license_number)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Trade License</label>
                            <p class="text-white font-medium">{{ $supplier->trade_license_number }}</p>
                        </div>
                        @endif
                        @if($supplier->tax_id)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Tax ID</label>
                            <p class="text-white font-medium">{{ $supplier->tax_id }}</p>
                        </div>
                        @endif
                        @if($supplier->company_phone)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Company Phone</label>
                            <p class="text-white font-medium">{{ $supplier->company_phone }}</p>
                        </div>
                        @endif
                        @if($supplier->company_email)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Company Email</label>
                            <p class="text-white font-medium">{{ $supplier->company_email }}</p>
                        </div>
                        @endif
                        @if($supplier->address)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Address</label>
                            <p class="text-white font-medium">{{ $supplier->address }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Financial Information -->
            @if($supplier->bank_name || $supplier->iban || $supplier->swift_code || $supplier->accepted_payment_terms)
            <div class="mt-8 pt-8 border-t border-white/20">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 bg-indigo-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 0h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Financial Information</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if($supplier->bank_name)
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">Bank Name</label>
                        <p class="text-white font-medium">{{ $supplier->bank_name }}</p>
                    </div>
                    @endif
                    @if($supplier->iban)
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">IBAN</label>
                        <p class="text-white font-medium">{{ $supplier->iban }}</p>
                    </div>
                    @endif
                    @if($supplier->swift_code)
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">Swift Code</label>
                        <p class="text-white font-medium">{{ $supplier->swift_code }}</p>
                    </div>
                    @endif
                    @if($supplier->accepted_payment_terms)
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">Payment Terms</label>
                        <p class="text-white font-medium">{{ $supplier->accepted_payment_terms }} Days</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Documents Section -->
            <div class="mt-8 pt-8 border-t border-white/20">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 bg-orange-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Submitted Documents</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if($supplier->trade_license_path)
                    <div class="flex items-center space-x-3 p-4 bg-green-500/10 rounded-xl border border-green-500/20">
                        <div class="p-2 bg-green-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-green-400 font-medium">Trade License</p>
                            <p class="text-green-300 text-sm">Uploaded ✓</p>
                        </div>
                    </div>
                    @endif
                    @if($supplier->vat_certificate_path)
                    <div class="flex items-center space-x-3 p-4 bg-green-500/10 rounded-xl border border-green-500/20">
                        <div class="p-2 bg-green-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-green-400 font-medium">VAT Certificate</p>
                            <p class="text-green-300 text-sm">Uploaded ✓</p>
                        </div>
                    </div>
                    @endif
                    @if($supplier->company_profile_path)
                    <div class="flex items-center space-x-3 p-4 bg-green-500/10 rounded-xl border border-green-500/20">
                        <div class="p-2 bg-green-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-green-400 font-medium">Company Profile</p>
                            <p class="text-green-300 text-sm">Uploaded ✓</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Support & Contact -->
        <div class="bg-gradient-to-r from-emerald-600/20 to-green-600/20 backdrop-blur-xl border border-white/10 rounded-2xl p-8 text-white">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Procurement Support 🤝</h3>
                    <p class="text-slate-300 mb-6">Our procurement team is here to assist with your partnership needs.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-white/10 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold">Procurement Email</p>
                                    <a href="mailto:info@skylandconstruction.com" class="text-emerald-300 hover:text-white transition-colors">info@skylandconstruction.com</a>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="p-3 bg-white/10 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold">Direct Line</p>
                                    <p class="text-emerald-300">+971 7 243 5757</p>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="text-6xl">🏢</div>
            </div>
        </div>
    </div>
</div>

<!-- License Upload Modal -->
<div id="licenseUploadModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border border-white/20 w-full max-w-2xl shadow-2xl rounded-2xl bg-black/40 backdrop-blur-xl">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-white text-center mb-4">Update Trade License</h3>
            <form id="licenseUploadForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-purple-300 mb-2">License Expiration Date:</label>
                    <input type="date" name="license_expiry_date" id="licenseExpiryDate" required
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                
                <!-- License Upload Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-purple-300 mb-2">Upload New License:</label>
                    <div class="border-2 border-dashed border-white/20 rounded-xl p-4 bg-white/5">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4">
                                <label for="licenseFileInput" class="cursor-pointer">
                                    <span class="mt-2 block text-sm font-medium text-white">
                                        Click to upload license or drag and drop
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-400">
                                        PDF, JPG, PNG up to 10MB
                                    </span>
                                </label>
                                <input id="licenseFileInput" name="license_file" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- File Preview -->
                    <div id="licenseFilePreview" class="mt-3 space-y-2 hidden">
                        <h4 class="text-sm font-medium text-purple-300">Selected File:</h4>
                        <div id="licenseFileItem"></div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeLicenseUploadModal()" 
                            class="px-4 py-2 bg-white/10 text-white rounded-xl hover:bg-white/20 text-sm transition-all">
                        Cancel
                    </button>
                    <button type="submit" id="uploadLicenseBtn"
                            class="px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl hover:from-orange-600 hover:to-red-600 text-sm transition-all">
                        Update License
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openLicenseUploadModal() {
        document.getElementById('licenseUploadModal').classList.remove('hidden');
    }

    function closeLicenseUploadModal() {
        document.getElementById('licenseUploadModal').classList.add('hidden');
        document.getElementById('licenseUploadForm').reset();
        document.getElementById('licenseFilePreview').classList.add('hidden');
        document.getElementById('licenseFileItem').innerHTML = '';
    }

    // Close modal when clicking outside
    document.getElementById('licenseUploadModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLicenseUploadModal();
        }
    });

    // File Upload Functionality
    document.getElementById('licenseFileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            displayLicenseFile(file);
        }
    });

    function displayLicenseFile(file) {
        const fileSize = formatFileSize(file.size);
        const fileItem = `
            <div class="flex items-center justify-between p-2 bg-white/5 rounded border border-white/10">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div>
                        <div class="text-sm font-medium text-white">${file.name}</div>
                        <div class="text-xs text-gray-400">${fileSize}</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="text-xs text-green-400 mr-2">Ready</span>
                </div>
            </div>
        `;
        
        document.getElementById('licenseFileItem').innerHTML = fileItem;
        document.getElementById('licenseFilePreview').classList.remove('hidden');
    }

    function formatFileSize(bytes) {
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;
        
        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex++;
        }
        
        return Math.round(size * 100) / 100 + ' ' + units[unitIndex];
    }

    // Handle license form submission
    document.getElementById('licenseUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('uploadLicenseBtn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Uploading...';
        
        // Simulate upload process (replace with actual upload logic)
        setTimeout(() => {
            alert('License updated successfully!');
            closeLicenseUploadModal();
            // Refresh the page to show updated status
            window.location.reload();
        }, 2000);
    });
</script>
@endpush