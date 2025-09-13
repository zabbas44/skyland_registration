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
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
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
