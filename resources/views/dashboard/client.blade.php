@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Client Dashboard</h1>
                    <p class="text-slate-300">Welcome back, {{ $client->full_name }}!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 bg-green-500 text-white rounded-full text-sm font-medium">
                        Client ID: #CLT{{ str_pad($client->id, 6, '0', STR_PAD_LEFT) }}
                    </span>
                    
                    <!-- Email Conversations Button -->
                    <a href="{{ route('email-conversations.index') }}" 
                       class="relative px-4 py-2 bg-gradient-to-r from-blue-500 to-green-500 hover:from-blue-600 hover:to-green-600 text-white rounded-lg transition-colors flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>Email Conversations</span>
                        <!-- Unread messages indicator (optional - you can implement this later) -->
                        {{-- <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span> --}}
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-white mb-2">Registration Status</h2>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                            @if($client->status === 'approved') bg-green-500/20 text-green-400 border border-green-500/30
                            @elseif($client->status === 'rejected') bg-red-500/20 text-red-400 border border-red-500/30
                            @else bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 @endif">
                            @if($client->status === 'approved')
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $client->status_display }}
                            @elseif($client->status === 'rejected')
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ $client->status_display }}
                            @else
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $client->status_display }}
                            @endif
                        </span>
                        @if($client->status_updated_at)
                            <span class="text-sm text-slate-400">
                                Updated: {{ $client->status_updated_at->format('M j, Y g:i A') }}
                            </span>
                        @endif
                    </div>
                </div>
                
                @if($client->status === 'approved')
                    <div class="text-right">
                        <div class="text-green-400 text-2xl mb-1">🎉</div>
                        <p class="text-sm text-green-400 font-medium">Welcome to Sky Land!</p>
                    </div>
                @elseif($client->status === 'rejected')
                    <div class="text-right">
                        <div class="text-red-400 text-2xl mb-1">📞</div>
                        <p class="text-sm text-red-400 font-medium">Please contact us</p>
                    </div>
                @else
                    <div class="text-right">
                        <div class="text-yellow-400 text-2xl mb-1">⏳</div>
                        <p class="text-sm text-yellow-400 font-medium">Review in progress</p>
                    </div>
                @endif
            </div>
            
            @if($client->status_reason)
                <div class="mt-4 p-4 bg-white/5 rounded-lg border border-white/10">
                    <h4 class="text-sm font-medium text-white mb-2">
                        @if($client->status === 'approved') Admin Notes:
                        @elseif($client->status === 'rejected') Reason for Status:
                        @else Additional Information: @endif
                    </h4>
                    <p class="text-sm text-slate-300 leading-relaxed">{{ $client->status_reason }}</p>
                </div>
            @endif

            @if($client->status === 'approved')
                <div class="mt-4 p-4 bg-green-500/10 rounded-lg border border-green-500/20">
                    <h4 class="text-sm font-medium text-green-400 mb-2">🚀 Next Steps</h4>
                    <ul class="text-sm text-slate-300 space-y-1">
                        <li>• Start requesting quotations for your projects</li>
                        <li>• Book site visits with our team</li>
                        <li>• Track your project progress in real-time</li>
                        <li>• Access exclusive client resources</li>
                    </ul>
                </div>
            @elseif($client->status === 'rejected')
                <div class="mt-4 p-4 bg-red-500/10 rounded-lg border border-red-500/20">
                    <h4 class="text-sm font-medium text-red-400 mb-2">📞 Contact Information</h4>
                    <p class="text-sm text-slate-300 mb-2">Please reach out to us to discuss your application:</p>
                    <ul class="text-sm text-slate-300 space-y-1">
                        <li>• Email: info@skylandconstruction.com</li>
                        <li>• Phone: +971 XX XXX XXXX</li>
                        <li>• We're here to help resolve any issues</li>
                    </ul>
                </div>
            @else
                <div class="mt-4 p-4 bg-yellow-500/10 rounded-lg border border-yellow-500/20">
                    <h4 class="text-sm font-medium text-yellow-400 mb-2">⏳ What's Next?</h4>
                    <p class="text-sm text-slate-300 mb-2">Our team is currently reviewing your registration:</p>
                    <ul class="text-sm text-slate-300 space-y-1">
                        <li>• We'll verify your information and documents</li>
                        <li>• You'll receive an email notification once complete</li>
                        <li>• Typical review time: 1-2 business days</li>
                        <li>• Check back here for status updates</li>
                    </ul>
                </div>
            @endif
        </div>

        <!-- Registration Details Card -->
        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl p-6 mb-8">
            <h2 class="text-2xl font-semibold text-white mb-6">Registration Details</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Account Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Account Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm text-slate-300">Full Name</label>
                            <p class="text-white font-medium">{{ $client->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Email</label>
                            <p class="text-white font-medium">{{ $client->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Registration Date</label>
                            <p class="text-white font-medium">{{ $client->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Company Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm text-slate-300">Client Type</label>
                            <p class="text-white font-medium">{{ $client->client_type }}</p>
                        </div>
                        @if($client->company_name)
                        <div>
                            <label class="block text-sm text-slate-300">Company Name</label>
                            <p class="text-white font-medium">{{ $client->company_name }}</p>
                        </div>
                        @endif
                        @if($client->website)
                        <div>
                            <label class="block text-sm text-slate-300">Website</label>
                            <p class="text-white font-medium">
                                <a href="{{ $client->website }}" target="_blank" class="text-orange-400 hover:text-orange-300 underline">
                                    {{ $client->website }}
                                </a>
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Contact Information</h3>
                    <div class="space-y-3">
                        @if($client->mobile)
                        <div>
                            <label class="block text-sm text-slate-300">Mobile</label>
                            <p class="text-white font-medium">{{ $client->mobile }}</p>
                        </div>
                        @endif
                        @if($client->office_phone)
                        <div>
                            <label class="block text-sm text-slate-300">Landline</label>
                            <p class="text-white font-medium">{{ $client->office_phone }}</p>
                        </div>
                        @endif
                        @if($client->address)
                        <div>
                            <label class="block text-sm text-slate-300">Address</label>
                            <p class="text-white font-medium">{{ $client->address }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Project Information -->
                @if($client->project_type || $client->service_needed)
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Project Information</h3>
                    <div class="space-y-3">
                        @if($client->project_type)
                        <div>
                            <label class="block text-sm text-slate-300">Project Type</label>
                            <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $client->project_type)) }}</p>
                        </div>
                        @endif
                        @if($client->service_needed)
                        <div>
                            <label class="block text-sm text-slate-300">Service Needed</label>
                            <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $client->service_needed)) }}</p>
                        </div>
                        @endif
                        @if($client->estimated_budget)
                        <div>
                            <label class="block text-sm text-slate-300">Estimated Budget</label>
                            <p class="text-white font-medium">{{ ucfirst(str_replace('_', ' ', $client->estimated_budget)) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Status Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Status</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm text-slate-300">Application Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/20 text-yellow-300">
                                Under Review
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Next Step</label>
                            <p class="text-white font-medium">Initial consultation call</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($client->project_brief)
            <div class="mt-6 pt-6 border-t border-white/20">
                <h3 class="text-lg font-medium text-orange-400 mb-3">Project Brief</h3>
                <p class="text-slate-200 leading-relaxed">{{ $client->project_brief }}</p>
            </div>
            @endif
        </div>

        <!-- Important Notice -->
        <div class="bg-orange-500/10 border border-orange-500/30 rounded-xl p-6">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-orange-400 mb-2">Important Information</h3>
                    <div class="text-slate-200 space-y-2">
                        <p>• Your registration is currently under review by our team.</p>
                        <p>• You will receive a call within 24-48 hours to discuss your project requirements.</p>
                        <p>• Please keep your contact information updated for smooth communication.</p>
                        <p>• You can view your registration details here anytime, but cannot modify them.</p>
                        <p>• For any urgent queries, contact us at <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300 underline">info@skylandconstruction.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
