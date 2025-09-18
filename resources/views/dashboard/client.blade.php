@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4 rounded-2xl mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome back, {{ explode(' ', $client->full_name)[0] }}! 👋</h1>
                    <p class="text-slate-300">Your client dashboard with real-time analytics</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-full text-sm font-medium shadow-lg">
                        Client ID: #CLT{{ str_pad($client->id, 6, '0', STR_PAD_LEFT) }}
                    </span>
                    
                    <!-- Email Conversations Button -->
                    <a href="{{ route('email-conversations.index') }}" 
                       class="relative px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-medium transition-all duration-200 flex items-center space-x-2 shadow-lg hover:shadow-xl">
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
            <!-- Registration Status Card -->
            <div class="bg-gradient-to-br from-blue-500/15 to-cyan-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 rounded-xl @if($client->status === 'approved') bg-green-500/20 @elseif($client->status === 'rejected') bg-red-500/20 @else bg-yellow-500/20 @endif">
                        @if($client->status === 'approved')
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @elseif($client->status === 'rejected')
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
                        @if($client->status === 'approved') 🎉
                        @elseif($client->status === 'rejected') 📞
                        @else ⏳ @endif
                    </span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Registration Status</h3>
                <p class="text-3xl font-bold @if($client->status === 'approved') text-green-400 @elseif($client->status === 'rejected') text-red-400 @else text-yellow-400 @endif mb-1">
                    {{ $client->status_display }}
                </p>
                @if($client->status_updated_at)
                    <p class="text-sm text-slate-400">Updated {{ $client->status_updated_at->diffForHumans() }}</p>
                @endif
            </div>

            <!-- Project Progress Card -->
            <div class="bg-gradient-to-br from-purple-500/15 to-pink-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-purple-500/20 rounded-xl">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl">📊</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Project Progress</h3>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="flex-1 bg-gray-700 rounded-full h-2">
                        <div class="@if($client->status === 'approved') bg-green-400 h-2 rounded-full w-full @elseif($client->status === 'rejected') bg-red-400 h-2 rounded-full w-1/4 @else bg-yellow-400 h-2 rounded-full w-3/4 @endif"></div>
                    </div>
                    <span class="text-white font-bold">
                        @if($client->status === 'approved') 100%
                        @elseif($client->status === 'rejected') 25%
                        @else 75% @endif
                    </span>
                </div>
                <p class="text-sm text-slate-400">
                    @if($client->status === 'approved') Ready to start projects
                    @elseif($client->status === 'rejected') Application review needed
                    @else Verification in progress @endif
                </p>
            </div>

            <!-- Account Activity Card -->
            <div class="bg-gradient-to-br from-emerald-500/15 to-green-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6 hover:shadow-xl transition-all duration-200">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-emerald-500/20 rounded-xl">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl">👤</span>
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Account Activity</h3>
                <p class="text-2xl font-bold text-emerald-400 mb-1">{{ $client->created_at->diffForHumans() }}</p>
                <p class="text-sm text-slate-400">Member since {{ $client->created_at->format('M Y') }}</p>
            </div>
        </div>

        <!-- Analytics Dashboard -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Registration Timeline -->
            <div class="bg-gradient-to-br from-indigo-500/15 to-blue-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                <h3 class="text-white font-semibold text-lg mb-6">Registration Timeline</h3>
                
                <!-- Timeline Chart -->
                <div class="h-48 relative mb-4">
                    <svg class="w-full h-full" viewBox="0 0 400 200">
                        <defs>
                            <linearGradient id="timelineGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#3b82f6;stop-opacity:0.6"/>
                                <stop offset="100%" style="stop-color:#3b82f6;stop-opacity:0.1"/>
                            </linearGradient>
                        </defs>
                        
                        <!-- Grid lines -->
                        <line x1="0" y1="40" x2="400" y2="40" stroke="#ffffff10" stroke-width="1"/>
                        <line x1="0" y1="80" x2="400" y2="80" stroke="#ffffff10" stroke-width="1"/>
                        <line x1="0" y1="120" x2="400" y2="120" stroke="#ffffff10" stroke-width="1"/>
                        <line x1="0" y1="160" x2="400" y2="160" stroke="#ffffff10" stroke-width="1"/>
                        
                        <!-- Timeline path -->
                        <path d="M 50 150 Q 100 120 150 100 T 250 80 Q 300 75 350 70" stroke="#3b82f6" stroke-width="3" fill="none"/>
                        <path d="M 50 150 Q 100 120 150 100 T 250 80 Q 300 75 350 70 L 350 180 L 50 180 Z" fill="url(#timelineGradient)"/>
                        
                        <!-- Milestone points -->
                        <circle cx="50" cy="150" r="4" fill="#3b82f6" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="150" cy="100" r="4" fill="#3b82f6" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="250" cy="80" r="4" fill="#3b82f6" stroke="#ffffff" stroke-width="2"/>
                        <circle cx="350" cy="70" r="4" fill="#10b981" stroke="#ffffff" stroke-width="2"/>
                    </svg>
                    
                    <!-- Timeline labels -->
                    <div class="absolute bottom-0 left-0 right-0 flex justify-between text-xs text-blue-300 px-4">
                        <span>Registration</span>
                        <span>Verification</span>
                        <span>Review</span>
                        <span>{{ $client->status === 'approved' ? 'Approved' : 'Current' }}</span>
                    </div>
                </div>
                
                <!-- Timeline stats -->
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-blue-400">{{ $client->created_at->diffInDays(now()) }}</div>
                        <div class="text-xs text-blue-300">Days Since Registration</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-emerald-400">{{ $client->status === 'approved' ? '100' : '75' }}%</div>
                        <div class="text-xs text-emerald-300">Process Complete</div>
                    </div>
                </div>
            </div>

            <!-- Project Analytics -->
            <div class="bg-gradient-to-br from-purple-500/15 to-pink-500/15 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                <h3 class="text-white font-semibold text-lg mb-6">Project Analytics</h3>
                
                <!-- Donut Chart -->
                <div class="h-48 relative flex items-center justify-center">
                    <div class="relative">
                        <!-- Outer glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-full blur-md scale-110"></div>
                        
                        <!-- Main donut chart -->
                        <div class="relative">
                            @php
                                $completionRate = $client->status === 'approved' ? 100 : ($client->status === 'rejected' ? 25 : 75);
                                $circumference = 220;
                                $completionArc = ($completionRate / 100) * $circumference;
                            @endphp
                            <svg class="w-32 h-32 transform -rotate-90 drop-shadow-xl" viewBox="0 0 100 100">
                                <defs>
                                    <linearGradient id="completionGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#8b5cf6;stop-opacity:1"/>
                                        <stop offset="100%" style="stop-color:#ec4899;stop-opacity:1"/>
                                    </linearGradient>
                                </defs>
                                <circle cx="50" cy="50" r="35" fill="none" stroke="#ffffff10" stroke-width="8"/>
                                <circle cx="50" cy="50" r="35" fill="none" stroke="url(#completionGradient)" stroke-width="8" 
                                        stroke-dasharray="{{ $completionArc }} {{ $circumference }}" stroke-dashoffset="0" stroke-linecap="round"/>
                                <text x="50" y="55" text-anchor="middle" class="text-xs fill-white font-bold">{{ $completionRate }}%</text>
                            </svg>
                        </div>
                        
                        <!-- Center content -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center bg-black/20 backdrop-blur-sm rounded-full w-16 h-16 flex items-center justify-center border border-white/10">
                                <div>
                                    <div class="text-lg font-bold text-white">{{ $completionRate }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Project stats -->
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div>
                        <div class="text-2xl font-bold text-purple-400">{{ $client->project_type ? '1' : '0' }}</div>
                        <div class="text-xs text-purple-300">Active Projects</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-pink-400">{{ $client->status === 'approved' ? '5' : '0' }}</div>
                        <div class="text-xs text-pink-300">Available Services</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Details Section -->
        @if($client->status_reason || $client->status === 'approved' || $client->status === 'rejected' || $client->status === 'pending')
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 mb-8">
            @if($client->status === 'approved')
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-500/20 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">🎉 Welcome to Sky Land!</h2>
                    <p class="text-slate-300">Your registration has been approved. You can now access all our services.</p>
                </div>
                <div class="bg-green-500/10 rounded-xl p-6 border border-green-500/20">
                    <h4 class="text-lg font-semibold text-green-400 mb-3">🚀 What's Next?</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">1</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Request Quotations</p>
                                <p class="text-green-300 text-sm">Start requesting quotes for your projects</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">2</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Schedule Site Visits</p>
                                <p class="text-green-300 text-sm">Book consultations with our team</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">3</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Track Progress</p>
                                <p class="text-green-300 text-sm">Monitor your project in real-time</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-green-400 text-sm font-bold">4</span>
                            </div>
                            <div>
                                <p class="text-green-400 font-medium">Access Resources</p>
                                <p class="text-green-300 text-sm">Use exclusive client tools</p>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($client->status === 'rejected')
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-500/20 rounded-full mb-4">
                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">📞 Let's Resolve This</h2>
                    <p class="text-slate-300">Your registration needs attention. Please contact us to resolve any issues.</p>
                </div>
                <div class="bg-red-500/10 rounded-xl p-6 border border-red-500/20">
                    <h4 class="text-lg font-semibold text-red-400 mb-3">📞 Contact Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-red-500/20 rounded-lg">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-400 font-medium">Email Support</p>
                                <p class="text-red-300">info@skylandconstruction.com</p>
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
                    <p class="text-slate-300">Our team is currently reviewing your registration. You'll be notified once complete.</p>
                </div>
                <div class="bg-yellow-500/10 rounded-xl p-6 border border-yellow-500/20">
                    <h4 class="text-lg font-semibold text-yellow-400 mb-3">⏳ What's Happening?</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">1</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Document Verification</p>
                                <p class="text-yellow-300 text-sm">Verifying your information</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">2</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Email Notification</p>
                                <p class="text-yellow-300 text-sm">You'll receive updates via email</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">3</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Typical Timeline</p>
                                <p class="text-yellow-300 text-sm">1-2 business days</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-yellow-500/20 rounded-full flex items-center justify-center mt-0.5">
                                <span class="text-yellow-400 text-sm font-bold">4</span>
                            </div>
                            <div>
                                <p class="text-yellow-400 font-medium">Status Updates</p>
                                <p class="text-yellow-300 text-sm">Check back here anytime</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($client->status_reason)
                <div class="mt-6 p-4 bg-white/5 rounded-xl border border-white/10">
                    <h4 class="text-sm font-semibold text-white mb-2">
                        @if($client->status === 'approved') Admin Notes:
                        @elseif($client->status === 'rejected') Reason for Status:
                        @else Additional Information: @endif
                    </h4>
                    <p class="text-slate-300 leading-relaxed">{{ $client->status_reason }}</p>
                </div>
            @endif
        </div>
        @endif

        <!-- Registration Details -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-lg mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Registration Details</h2>
                <div class="px-4 py-2 bg-blue-500/20 text-blue-300 rounded-xl text-sm font-medium border border-blue-500/30">
                    Complete Profile
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Personal Information -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-blue-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Personal Information</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Full Name</label>
                            <p class="text-white font-medium">{{ $client->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Email Address</label>
                            <p class="text-white font-medium">{{ $client->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Client Type</label>
                            <p class="text-white font-medium">{{ $client->client_type }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Registration Date</label>
                            <p class="text-white font-medium">{{ $client->created_at->format('F j, Y') }}</p>
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
                        @if($client->company_name)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Company Name</label>
                            <p class="text-white font-medium">{{ $client->company_name }}</p>
                        </div>
                        @endif
                        @if($client->website)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Website</label>
                            <a href="{{ $client->website }}" target="_blank" class="text-blue-400 hover:text-blue-300 font-medium underline">
                                {{ $client->website }}
                            </a>
                        </div>
                        @endif
                        @if($client->mobile)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Mobile</label>
                            <p class="text-white font-medium">{{ $client->mobile }}</p>
                        </div>
                        @endif
                        @if($client->office_phone)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Office Phone</label>
                            <p class="text-white font-medium">{{ $client->office_phone }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Project Information -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-purple-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0h2m-2 0v6a2 2 0 002 2h6a2 2 0 002-2v-6m0 0V9a2 2 0 00-2-2h-2m0 0V5a2 2 0 00-2-2H9v2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Project Details</h3>
                    </div>
                    <div class="space-y-4">
                        @if($client->project_type)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Project Type</label>
                            <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $client->project_type)) }}</p>
                        </div>
                        @endif
                        @if($client->service_needed)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Service Needed</label>
                            <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $client->service_needed)) }}</p>
                        </div>
                        @endif
                        @if($client->estimated_budget)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Estimated Budget</label>
                            <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $client->estimated_budget)) }}</p>
                        </div>
                        @endif
                        @if($client->address)
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Project Address</label>
                            <p class="text-white font-medium">{{ $client->address }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($client->project_brief)
            <div class="mt-8 pt-8 border-t border-white/20">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-2 bg-indigo-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Project Brief</h3>
                </div>
                <div class="bg-white/5 rounded-xl p-6 border border-white/10">
                    <p class="text-slate-300 leading-relaxed">{{ $client->project_brief }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Support & Contact -->
        <div class="bg-gradient-to-r from-blue-600/20 to-indigo-600/20 backdrop-blur-xl border border-white/10 rounded-2xl p-8 text-white">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-2">Need Help? 🤝</h3>
                    <p class="text-slate-300 mb-6">Our team is here to assist you with any questions or concerns.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Email Support</p>
                                <a href="mailto:info@skylandconstruction.com" class="text-blue-300 hover:text-white transition-colors">info@skylandconstruction.com</a>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="p-3 bg-white/10 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold">Phone Support</p>
                                <p class="text-blue-300">+971 XX XXX XXXX</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-6xl">📞</div>
            </div>
        </div>
    </div>
</div>
@endsection