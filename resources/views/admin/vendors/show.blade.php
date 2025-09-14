@extends('layouts.admin-dark')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Vendor Details</h1>
            <p class="text-purple-300">{{ $vendor->first_name }} {{ $vendor->last_name }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.vendors.index') }}" 
               class="px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/20 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Vendors
            </a>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="flex-1 p-6 overflow-y-auto custom-scrollbar">
    <div class="mb-6 flex justify-end items-center space-x-3">
        <button onclick="openContactModal()" 
                class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Contact Vendor
        </button>
        
        <a href="{{ route('admin.vendors.edit', $vendor) }}" 
           class="px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-cyan-600 transition-all flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Vendor
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- General Information -->
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-white">General Information</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                        @if($vendor->vendor_type === 'Individual') bg-blue-100 text-blue-800
                        @elseif($vendor->vendor_type === 'Company') bg-green-100 text-green-800
                        @elseif($vendor->vendor_type === 'Partnership') bg-purple-100 text-purple-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ $vendor->vendor_type ?? 'Individual' }}
                    </span>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-purple-300">First Name</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->first_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Last Name</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->last_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Company Name</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->company_name ?? $vendor->contact_company_name ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Job Title</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->job_title ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Nationality</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->nationality ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Experience Years</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->experience_years ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Website</dt>
                            <dd class="mt-1 text-sm text-white">
                                @if($vendor->website)
                                    <a href="{{ $vendor->website }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                                        {{ $vendor->website }}
                                    </a>
                                @else
                                    Not specified
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">LinkedIn Profile</dt>
                            <dd class="mt-1 text-sm text-white">
                                @if($vendor->linkedin_profile)
                                    <a href="{{ $vendor->linkedin_profile }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                                        {{ $vendor->linkedin_profile }}
                                    </a>
                                @else
                                    Not provided
                                @endif
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-purple-300">Address</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->address ?? $vendor->contact_address ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Contact Details -->
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Contact Details</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Email</dt>
                            <dd class="mt-1 text-sm text-white">
                                <a href="mailto:{{ $vendor->contact_email ?? $vendor->email }}" class="text-blue-400 hover:text-blue-300">
                                    {{ $vendor->contact_email ?? $vendor->email }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Mobile</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->contact_mobile ?? $vendor->mobile }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Office Phone</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->office_phone ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Landline</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->contact_landline ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">WhatsApp</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->whatsapp_number ?? 'Not provided' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Emergency Contact</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->emergency_contact ?? 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Business Information -->
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Business & Services Information</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Business Type</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->business_type ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Services Offered</dt>
                            <dd class="mt-1 text-sm text-white">
                                @if($vendor->services_offered)
                                    @if(is_array($vendor->services_offered))
                                        {{ implode(', ', $vendor->services_offered) }}
                                    @else
                                        {{ $vendor->services_offered }}
                                    @endif
                                @else
                                    Not specified
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Specializations</dt>
                            <dd class="mt-1 text-sm text-white">
                                @if($vendor->specializations)
                                    @if(is_array($vendor->specializations))
                                        {{ implode(', ', $vendor->specializations) }}
                                    @else
                                        {{ $vendor->specializations }}
                                    @endif
                                @else
                                    Not specified
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Service Areas</dt>
                            <dd class="mt-1 text-sm text-white">
                                @if($vendor->service_areas)
                                    @if(is_array($vendor->service_areas))
                                        {{ implode(', ', $vendor->service_areas) }}
                                    @else
                                        {{ $vendor->service_areas }}
                                    @endif
                                @else
                                    Not specified
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Team Size</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->team_size ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Pricing Structure</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->pricing_structure ?? 'Not specified' }}</dd>
                        </div>
                        @if($vendor->portfolio_website)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Portfolio Website</dt>
                                <dd class="mt-1 text-sm text-white">
                                    <a href="{{ $vendor->portfolio_website }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                                        {{ $vendor->portfolio_website }}
                                    </a>
                                </dd>
                            </div>
                        @endif
                        @if($vendor->company_description)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-purple-300">Company Description</dt>
                                <dd class="mt-1 text-sm text-white">{{ $vendor->company_description }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Legal/Compliance Information -->
            @if($vendor->trade_license_number || $vendor->tax_registration_number || $vendor->insurance_details)
                <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                    <div class="px-6 py-4 border-b border-white/10">
                        <h3 class="text-lg font-medium text-white">Legal & Compliance</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if($vendor->trade_license_number)
                                <div>
                                    <dt class="text-sm font-medium text-purple-300">Trade License Number</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $vendor->trade_license_number }}</dd>
                                </div>
                            @endif
                            @if($vendor->tax_registration_number)
                                <div>
                                    <dt class="text-sm font-medium text-purple-300">Tax Registration Number</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $vendor->tax_registration_number }}</dd>
                                </div>
                            @endif
                            @if($vendor->insurance_details)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-purple-300">Insurance Details</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $vendor->insurance_details }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            @endif

            <!-- Project Preferences -->
            @if($vendor->project_preferences || $vendor->availability_status || $vendor->preferred_project_size)
                <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                    <div class="px-6 py-4 border-b border-white/10">
                        <h3 class="text-lg font-medium text-white">Project Preferences</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @if($vendor->availability_status)
                                <div>
                                    <dt class="text-sm font-medium text-purple-300">Availability Status</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $vendor->availability_status }}</dd>
                                </div>
                            @endif
                            @if($vendor->preferred_project_size)
                                <div>
                                    <dt class="text-sm font-medium text-purple-300">Preferred Project Size</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $vendor->preferred_project_size }}</dd>
                                </div>
                            @endif
                            @if($vendor->project_preferences)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-purple-300">Project Preferences</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $vendor->project_preferences }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Quick Info</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Registration Date</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->created_at->format('F j, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Last Updated</dt>
                            <dd class="mt-1 text-sm text-white">{{ $vendor->updated_at->format('F j, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Status</dt>
                            <dd class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if(($vendor->status ?? 'approved') === 'approved') bg-green-500/20 text-green-400
                                    @elseif($vendor->status === 'rejected') bg-red-500/20 text-red-400
                                    @else bg-yellow-500/20 text-yellow-400 @endif">
                                    {{ ucfirst($vendor->status ?? 'approved') }}
                                </span>
                            </dd>
                        </div>
                        @if($vendor->status_updated_at)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Status Updated</dt>
                                <dd class="mt-1 text-sm text-white">{{ $vendor->status_updated_at->format('F j, Y g:i A') }}</dd>
                            </div>
                        @endif
                        @if($vendor->statusUpdatedBy)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Updated By</dt>
                                <dd class="mt-1 text-sm text-white">{{ $vendor->statusUpdatedBy->name }}</dd>
                            </div>
                        @endif
                        @if($vendor->status_reason)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Reason</dt>
                                <dd class="mt-1 text-sm text-white">{{ $vendor->status_reason }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Approval Actions -->
            @if(($vendor->status ?? 'approved') === 'pending')
                <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                    <div class="px-6 py-4 border-b border-white/10">
                        <h3 class="text-lg font-medium text-white">Approval Actions</h3>
                    </div>
                    <div class="px-6 py-4 space-y-4">
                        <div class="flex flex-col space-y-3">
                            <button onclick="openApprovalModal('approve')" 
                                    class="w-full px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approve Vendor
                            </button>
                            
                            <button onclick="openApprovalModal('reject')" 
                                    class="w-full px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-medium hover:from-red-600 hover:to-pink-600 transition-all flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reject Vendor
                            </button>
                        </div>
                    </div>
                </div>
            @elseif(($vendor->status ?? 'approved') === 'approved')
                <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                    <div class="px-6 py-4 border-b border-white/10">
                        <h3 class="text-lg font-medium text-white">Approval Actions</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="text-center">
                            <div class="text-green-600 mb-2">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-green-400">Vendor Approved</p>
                            <button onclick="openApprovalModal('reject')" 
                                    class="mt-3 w-full px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-xl font-medium hover:from-red-600 hover:to-pink-600 transition-all">
                                Change to Rejected
                            </button>
                        </div>
                    </div>
                </div>
            @elseif($vendor->status === 'rejected')
                <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                    <div class="px-6 py-4 border-b border-white/10">
                        <h3 class="text-lg font-medium text-white">Approval Actions</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="text-center">
                            <div class="text-red-600 mb-2">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-red-400">Vendor Rejected</p>
                            <button onclick="openApprovalModal('approve')" 
                                    class="mt-3 w-full px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                                Change to Approved
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Communications -->
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Recent Communications</h3>
                </div>
                <div class="px-6 py-4">
                    @php
                        $communications = \App\Models\CommunicationLog::where('entity_type', 'vendor')
                                            ->where('entity_id', $vendor->id)
                                            ->latest()
                                            ->take(5)
                                            ->get();
                    @endphp
                    
                    @if($communications->count() > 0)
                        <div class="space-y-3">
                            @foreach($communications as $comm)
                                <div class="text-sm border-b border-white/10 pb-3 last:border-b-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <p class="font-medium text-white">{{ $comm->subject }}</p>
                                            <p class="text-purple-300 text-xs mt-1">{{ Str::limit($comm->message_preview, 100) }}</p>
                                            <div class="flex items-center mt-2 space-x-2">
                                                <p class="text-purple-400 text-xs">{{ $comm->sent_at->format('M j, Y g:i A') }}</p>
                                                @if($comm->adminUser)
                                                    <span class="text-purple-400 text-xs">by {{ $comm->adminUser->name }}</span>
                                                @endif
                                            </div>
                                            @if($comm->hasAttachments())
                                                <div class="mt-1">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-blue-500/20 text-blue-400">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                        </svg>
                                                        {{ $comm->attachment_count }} file(s)
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $comm->status === 'sent' ? 'bg-green-500/20 text-green-400' : ($comm->status === 'failed' ? 'bg-red-500/20 text-red-400' : 'bg-yellow-500/20 text-yellow-400') }}">
                                            {{ ucfirst($comm->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-purple-400">No communications yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Contact Modal with Attachments -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-8 border border-white/10 w-full max-w-2xl shadow-lg rounded-2xl bg-black/20 backdrop-blur-xl">
            <div class="mt-3">
                <h3 class="text-2xl font-bold text-white text-center mb-6">Send Email to Vendor</h3>
                <form id="contactForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-purple-300 mb-2">To:</label>
                        <input type="text" value="{{ $vendor->first_name }} {{ $vendor->last_name }} ({{ $vendor->contact_email ?? $vendor->email }})" readonly 
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div class="mb-4">
                        <label for="contactSubject" class="block text-sm font-medium text-purple-300 mb-2">Subject:</label>
                        <input type="text" name="subject" id="contactSubject" required
                               class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                               placeholder="Enter email subject">
                    </div>
                    <div class="mb-4">
                        <label for="contactMessage" class="block text-sm font-medium text-purple-300 mb-2">Message:</label>
                        <textarea name="message" id="contactMessage" rows="6" required
                                  class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                                  placeholder="Type your message here..."></textarea>
                    </div>
                    
                    <!-- Attachments Section -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-purple-300 mb-2">Attachments (Optional):</label>
                        <div class="border-2 border-dashed border-white/20 rounded-xl p-6 text-center hover:border-purple-500 transition-colors">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-purple-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-4">
                                    <label for="fileInput" class="cursor-pointer">
                                        <span class="mt-2 block text-sm font-medium text-white">
                                            Click to upload files or drag and drop
                                        </span>
                                        <span class="mt-1 block text-xs text-purple-400">
                                            Max 10MB per file. Multiple files allowed.
                                        </span>
                                    </label>
                                    <input id="fileInput" name="files[]" type="file" class="hidden" multiple>
                                </div>
                            </div>
                        </div>
                        
                        <!-- File List -->
                        <div id="fileList" class="mt-4 space-y-2 hidden">
                            <h4 class="text-sm font-medium text-white">Selected Files:</h4>
                            <div id="fileItems"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeContactModal()" 
                                class="px-6 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" id="sendEmailBtn"
                                class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-purple-600 transition-all">
                            Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    <div id="approvalModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-8 border border-white/10 w-full max-w-md shadow-lg rounded-2xl bg-black/20 backdrop-blur-xl">
            <div class="mt-3">
                <h3 id="approvalModalTitle" class="text-2xl font-bold text-white text-center mb-6"></h3>
                <form id="approvalForm" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="reason" class="block text-sm font-medium text-purple-300 mb-2">
                            <span id="reasonLabel">Reason:</span>
                        </label>
                        <textarea name="reason" id="reason" rows="4" 
                                  class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-xl text-white text-sm focus:outline-none focus:ring-2 focus:ring-purple-500"
                                  placeholder="Enter reason for this action..."></textarea>
                        <p class="text-xs text-purple-400 mt-1">This reason will be included in the email notification to the vendor.</p>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeApprovalModal()" 
                                class="px-6 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" id="approvalSubmitBtn"
                                class="px-6 py-3 rounded-xl text-white text-sm font-medium">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let uploadedFiles = [];
    let uploadCounter = 0;

    function openContactModal() {
        document.getElementById('contactModal').classList.remove('hidden');
        document.getElementById('contactForm').reset();
        uploadedFiles = [];
        document.getElementById('fileList').classList.add('hidden');
        document.getElementById('fileItems').innerHTML = '';
    }

    function closeContactModal() {
        document.getElementById('contactModal').classList.add('hidden');
        uploadedFiles = [];
    }

    document.getElementById('contactModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeContactModal();
        }
    });

    document.getElementById('fileInput').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        files.forEach(file => uploadFile(file));
    });

    const dropZone = document.querySelector('.border-dashed');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.classList.add('border-purple-400', 'bg-white/5');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-purple-400', 'bg-white/5');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = Array.from(dt.files);
        files.forEach(file => uploadFile(file));
    }

    function uploadFile(file) {
        const tempId = 'file_' + (++uploadCounter);
        const maxSize = 10 * 1024 * 1024; // 10MB

        if (file.size > maxSize) {
            alert('File size must be less than 10MB: ' + file.name);
            return;
        }

        const fileItem = createFileItem(tempId, file.name, file.size, 'uploading');
        document.getElementById('fileItems').appendChild(fileItem);
        document.getElementById('fileList').classList.remove('hidden');

        const formData = new FormData();
        formData.append('file', file);
        formData.append('temp_id', tempId);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        fetch('{{ route("admin.email.upload-attachment") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                uploadedFiles.push(data.file_info);
                updateFileItem(tempId, 'uploaded', data.file_info.formatted_size);
            } else {
                updateFileItem(tempId, 'error', 'Upload failed');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            updateFileItem(tempId, 'error', 'Upload failed');
        });
    }

    function createFileItem(tempId, fileName, fileSize, status) {
        const div = document.createElement('div');
        div.id = `file-${tempId}`;
        div.className = 'flex items-center justify-between p-3 bg-white/5 rounded-xl border border-white/10';
        
        const sizeText = formatFileSize(fileSize);
        const statusClass = status === 'uploading' ? 'text-blue-400' : status === 'uploaded' ? 'text-green-400' : 'text-red-400';
        const statusText = status === 'uploading' ? 'Uploading...' : status === 'uploaded' ? 'Uploaded' : 'Failed';
        
        div.innerHTML = `
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div>
                    <div class="text-sm font-medium text-white">${fileName}</div>
                    <div class="text-xs text-purple-300">${sizeText}</div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-xs ${statusClass} mr-2">${statusText}</span>
                ${status !== 'uploading' ? `<button onclick="removeFile('${tempId}')" class="text-red-400 hover:text-red-300 text-xs">Remove</button>` : ''}
            </div>
        `;
        
        return div;
    }

    function updateFileItem(tempId, status, sizeOrError) {
        const fileItem = document.getElementById(`file-${tempId}`);
        if (!fileItem) return;

        const statusClass = status === 'uploaded' ? 'text-green-400' : 'text-red-400';
        const statusText = status === 'uploaded' ? 'Uploaded' : 'Failed';
        
        const statusSpan = fileItem.querySelector('.text-xs.text-blue-400, .text-xs.text-green-400, .text-xs.text-red-400');
        if (statusSpan) {
            statusSpan.className = `text-xs ${statusClass} mr-2`;
            statusSpan.textContent = statusText;
        }

        if (status !== 'uploading') {
            const buttonContainer = fileItem.querySelector('.flex.items-center:last-child');
            if (!buttonContainer.querySelector('button')) {
                buttonContainer.innerHTML += `<button onclick="removeFile('${tempId}')" class="text-red-400 hover:text-red-300 text-xs ml-2">Remove</button>`;
            }
        }
    }

    function removeFile(tempId) {
        uploadedFiles = uploadedFiles.filter(file => file.temp_id !== tempId);
        
        const fileItem = document.getElementById(`file-${tempId}`);
        if (fileItem) {
            fileItem.remove();
        }
        
        if (uploadedFiles.length === 0) {
            document.getElementById('fileList').classList.add('hidden');
        }
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

    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('sendEmailBtn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
        
        const formData = new FormData();
        formData.append('subject', document.getElementById('contactSubject').value);
        formData.append('message', document.getElementById('contactMessage').value);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        if (uploadedFiles.length > 0) {
            formData.append('attachments', JSON.stringify(uploadedFiles));
        }
        
        fetch('{{ route("admin.vendors.contact", $vendor) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeContactModal();
                window.location.reload();
            } else {
                alert(data.message || 'Failed to send email');
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        })
        .catch(error => {
            console.error('Email sending error:', error);
            alert('An error occurred while sending the email');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    });

    function openApprovalModal(action) {
        const modal = document.getElementById('approvalModal');
        const form = document.getElementById('approvalForm');
        const title = document.getElementById('approvalModalTitle');
        const reasonLabel = document.getElementById('reasonLabel');
        const submitBtn = document.getElementById('approvalSubmitBtn');
        const reasonField = document.getElementById('reason');
        
        if (action === 'approve') {
            title.textContent = 'Approve Vendor Registration';
            reasonLabel.textContent = 'Approval Notes (Optional):';
            submitBtn.textContent = 'Approve Vendor';
            submitBtn.className = 'px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 rounded-xl text-white text-sm font-medium';
            form.action = '{{ route("admin.vendors.approve", $vendor) }}';
            reasonField.required = false;
            reasonField.placeholder = 'Add any notes about the approval (optional)...';
        } else {
            title.textContent = 'Reject Vendor Registration';
            reasonLabel.textContent = 'Rejection Reason (Required):';
            submitBtn.textContent = 'Reject Vendor';
            submitBtn.className = 'px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl text-white text-sm font-medium';
            form.action = '{{ route("admin.vendors.reject", $vendor) }}';
            reasonField.required = true;
            reasonField.placeholder = 'Please provide a reason for rejection...';
        }
        
        reasonField.value = '';
        
        modal.classList.remove('hidden');
    }

    function closeApprovalModal() {
        document.getElementById('approvalModal').classList.add('hidden');
    }

    document.getElementById('approvalModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeApprovalModal();
        }
    });

    document.getElementById('approvalForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('approvalSubmitBtn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing...';
        
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                window.location.reload();
            } else {
                alert(data.message || 'An error occurred. Please try again.');
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    });
</script>
@endpush