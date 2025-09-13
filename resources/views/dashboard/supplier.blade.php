@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Supplier Dashboard</h1>
                    <p class="text-slate-300">Welcome back, {{ $supplier->first_name }} {{ $supplier->last_name }}!</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 bg-green-500 text-white rounded-full text-sm font-medium">
                        Supplier ID: #SUP{{ str_pad($supplier->id, 6, '0', STR_PAD_LEFT) }}
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
                            <p class="text-white font-medium">{{ $supplier->first_name }} {{ $supplier->last_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Email</label>
                            <p class="text-white font-medium">{{ $supplier->contact_email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Registration Date</label>
                            <p class="text-white font-medium">{{ $supplier->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Company Information</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm text-slate-300">Company Name</label>
                            <p class="text-white font-medium">{{ $supplier->company_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Business Type</label>
                            <p class="text-white font-medium">{{ $supplier->business_type }}</p>
                        </div>
                        @if($supplier->website)
                        <div>
                            <label class="block text-sm text-slate-300">Website</label>
                            <p class="text-white font-medium">
                                <a href="{{ $supplier->website }}" target="_blank" class="text-orange-400 hover:text-orange-300 underline">
                                    {{ $supplier->website }}
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
                        <div>
                            <label class="block text-sm text-slate-300">Contact Person</label>
                            <p class="text-white font-medium">{{ $supplier->company_contact_person }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Designation</label>
                            <p class="text-white font-medium">{{ $supplier->contact_designation }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300">Mobile</label>
                            <p class="text-white font-medium">{{ $supplier->contact_mobile }}</p>
                        </div>
                        @if($supplier->company_phone)
                        <div>
                            <label class="block text-sm text-slate-300">Company Phone</label>
                            <p class="text-white font-medium">{{ $supplier->company_phone }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm text-slate-300">Company Email</label>
                            <p class="text-white font-medium">{{ $supplier->company_email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Address Information</h3>
                    <div class="space-y-3">
                        @if($supplier->address)
                        <div>
                            <label class="block text-sm text-slate-300">Company Address</label>
                            <p class="text-white font-medium">{{ $supplier->address }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-orange-400 border-b border-orange-400/30 pb-2">Financial Information</h3>
                    <div class="space-y-3">
                        @if($supplier->bank_name)
                        <div>
                            <label class="block text-sm text-slate-300">Bank Name</label>
                            <p class="text-white font-medium">{{ $supplier->bank_name }}</p>
                        </div>
                        @endif
                        @if($supplier->iban)
                        <div>
                            <label class="block text-sm text-slate-300">IBAN</label>
                            <p class="text-white font-medium">{{ $supplier->iban }}</p>
                        </div>
                        @endif
                        @if($supplier->swift_code)
                        <div>
                            <label class="block text-sm text-slate-300">Swift Code</label>
                            <p class="text-white font-medium">{{ $supplier->swift_code }}</p>
                        </div>
                        @endif
                        @if($supplier->accepted_payment_terms)
                        <div>
                            <label class="block text-sm text-slate-300">Payment Terms</label>
                            <p class="text-white font-medium">{{ $supplier->accepted_payment_terms }} Days</p>
                        </div>
                        @endif
                    </div>
                </div>

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
                            <p class="text-white font-medium">Vendor verification process</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Section -->
            <div class="mt-6 pt-6 border-t border-white/20">
                <h3 class="text-lg font-medium text-orange-400 mb-4">Submitted Documents</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if($supplier->trade_license_path)
                    <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-white">Trade License</span>
                    </div>
                    @endif
                    @if($supplier->vat_certificate_path)
                    <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-white">VAT Certificate</span>
                    </div>
                    @endif
                    @if($supplier->company_profile_path)
                    <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-white">Company Profile</span>
                    </div>
                    @endif
                </div>
            </div>
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
                        <p>• Your supplier registration is currently under review by our team.</p>
                        <p>• We will verify your documents and business credentials within 3-5 business days.</p>
                        <p>• You will receive an email notification once your application is approved.</p>
                        <p>• You can view your registration details here anytime, but cannot modify them.</p>
                        <p>• For any urgent queries, contact us at <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300 underline">info@skylandconstruction.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
