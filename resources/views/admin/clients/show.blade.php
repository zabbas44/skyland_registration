@extends('layouts.admin-dark')

@section('admin-content')
<div class="p-6">
<!-- Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Client Details</h1>
            <p class="text-purple-300">{{ $client->full_name }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.clients.index') }}" 
               class="px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/20 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Clients
            </a>
        </div>
    </div>
</div>

<div class="mb-6 flex justify-end items-center space-x-3">
    <button onclick="openContactModal()" 
            class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        Contact Client
    </button>
    
    <a href="{{ route('admin.clients.edit', $client) }}" 
       class="px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-cyan-600 transition-all flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Edit Client
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
                    @if($client->client_type === 'Individual') bg-blue-500/20 text-blue-300
                    @elseif($client->client_type === 'Corporate') bg-green-500/20 text-green-300
                    @elseif($client->client_type === 'Government') bg-purple-500/20 text-purple-300
                    @else bg-gray-500/20 text-gray-300 @endif">
                    {{ $client->client_type }}
                </span>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Full Name</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Job Title</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->job_title ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Organization</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->org_name ?: $client->company_name ?: 'Individual' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Industry</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->industry ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Nationality</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->nationality ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Budget Range</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->budget_range ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Referral Source</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->referral_source ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Website</dt>
                        <dd class="mt-1 text-sm text-white">
                            @if($client->website)
                                <a href="{{ $client->website }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                                    {{ $client->website }}
                                </a>
                            @else
                                Not specified
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-purple-300">Address</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->address }}</dd>
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
                            <a href="mailto:{{ $client->email }}" class="text-blue-400 hover:text-blue-300">
                                {{ $client->email }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Mobile</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->mobile }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Office Phone</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->office_phone ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Official Email</dt>
                        <dd class="mt-1 text-sm text-white">
                            @if($client->official_email)
                                <a href="mailto:{{ $client->official_email }}" class="text-blue-400 hover:text-blue-300">
                                    {{ $client->official_email }}
                                </a>
                            @else
                                Not provided
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Primary Contact Person</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->primary_contact_person ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Designation</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->designation ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Official Phone</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->official_phone ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">LinkedIn Profile</dt>
                        <dd class="mt-1 text-sm text-white">
                            @if($client->linkedin_profile)
                                <a href="{{ $client->linkedin_profile }}" target="_blank" class="text-blue-400 hover:text-blue-300">
                                    {{ $client->linkedin_profile }}
                                </a>
                            @else
                                Not provided
                            @endif
                        </dd>
                    </div>
                    @if($client->contact_mobile && $client->contact_mobile !== $client->mobile)
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Alternative Mobile</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->contact_mobile }}</dd>
                        </div>
                    @endif
                    @if($client->contact_landline)
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Landline</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->contact_landline }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Business Information -->
        @if($client->nature_of_business || $client->core_services || $client->services_required || $client->project_type)
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Business & Project Information</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($client->nature_of_business)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Nature of Business</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->nature_of_business }}</dd>
                            </div>
                        @endif
                        @if($client->core_services)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Core Services</dt>
                                <dd class="mt-1 text-sm text-white">{{ is_array($client->core_services) ? implode(', ', $client->core_services) : $client->core_services }}</dd>
                            </div>
                        @endif
                        @if($client->services_required)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Services Required</dt>
                                <dd class="mt-1 text-sm text-white">{{ is_array($client->services_required) ? implode(', ', $client->services_required) : $client->services_required }}</dd>
                            </div>
                        @endif
                        @if($client->project_type)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Project Type</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->project_type }}</dd>
                            </div>
                        @endif
                        @if($client->service_needed)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Service Needed</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->service_needed }}</dd>
                            </div>
                        @endif
                        @if($client->estimated_budget)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Estimated Budget</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->estimated_budget }}</dd>
                            </div>
                        @endif
                        @if($client->project_brief)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-purple-300">Project Brief</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->project_brief }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        @endif

        <!-- Legal/Compliance Information -->
        @if($client->trade_license_number || $client->tax_id)
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Legal & Compliance</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($client->trade_license_number)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Trade License Number</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->trade_license_number }}</dd>
                            </div>
                        @endif
                        @if($client->tax_id)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Tax ID</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->tax_id }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        @endif

        <!-- Timeline Information -->
        @if($client->target_start_date || $client->desired_timeline)
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Project Timeline</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($client->target_start_date)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Target Start Date</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->target_start_date }}</dd>
                            </div>
                        @endif
                        @if($client->desired_timeline)
                            <div>
                                <dt class="text-sm font-medium text-purple-300">Desired Timeline</dt>
                                <dd class="mt-1 text-sm text-white">{{ $client->desired_timeline }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        @endif

        <!-- Emergency Contact -->
        @if($client->emergency_contact_name)
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Emergency Contact</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Name</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->emergency_contact_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Relationship</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->emergency_contact_relationship ?: 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Phone</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->emergency_contact_phone ?: 'Not provided' }}</dd>
                        </div>
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
                        <dd class="mt-1 text-sm text-white">{{ $client->created_at->format('F j, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Last Updated</dt>
                        <dd class="mt-1 text-sm text-white">{{ $client->updated_at->format('F j, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-purple-300">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($client->status === 'approved') bg-green-500/20 text-green-300
                                @elseif($client->status === 'rejected') bg-red-500/20 text-red-300
                                @else bg-yellow-500/20 text-yellow-300 @endif">
                                {{ $client->status_display }}
                            </span>
                        </dd>
                    </div>
                    @if($client->status_updated_at)
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Status Updated</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->status_updated_at->format('F j, Y g:i A') }}</dd>
                        </div>
                    @endif
                    @if($client->statusUpdatedBy)
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Updated By</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->statusUpdatedBy->name }}</dd>
                        </div>
                    @endif
                    @if($client->status_reason)
                        <div>
                            <dt class="text-sm font-medium text-purple-300">Reason</dt>
                            <dd class="mt-1 text-sm text-white">{{ $client->status_reason }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Approval Actions -->
        @if($client->status === 'pending')
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Approval Actions</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div class="flex flex-col space-y-3">
                        <button onclick="openApprovalModal('approve')" 
                                class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-medium flex items-center justify-center transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approve Client
                        </button>
                        
                        <button onclick="openApprovalModal('reject')" 
                                class="w-full bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl text-sm font-medium flex items-center justify-center transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Client
                        </button>
                    </div>
                </div>
            </div>
        @elseif($client->status === 'approved')
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Approval Actions</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="text-center">
                        <div class="text-green-400 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-green-300">Client Approved</p>
                        <button onclick="openApprovalModal('reject')" 
                                class="mt-3 w-full bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-all">
                            Change to Rejected
                        </button>
                    </div>
                </div>
            </div>
        @elseif($client->status === 'rejected')
            <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl">
                <div class="px-6 py-4 border-b border-white/10">
                    <h3 class="text-lg font-medium text-white">Approval Actions</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="text-center">
                        <div class="text-red-400 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-red-300">Client Rejected</p>
                        <button onclick="openApprovalModal('approve')" 
                                class="mt-3 w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-medium transition-all">
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
                    $communications = \App\Models\CommunicationLog::where('entity_type', 'client')
                                        ->where('entity_id', $client->id)
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
                                            <p class="text-gray-400 text-xs">{{ $comm->sent_at->format('M j, Y g:i A') }}</p>
                                            @if($comm->adminUser)
                                                <span class="text-gray-400 text-xs">by {{ $comm->adminUser->name }}</span>
                                            @endif
                                        </div>
                                        @if($comm->hasAttachments())
                                            <div class="mt-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-blue-500/20 text-blue-300">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                    </svg>
                                                    {{ $comm->attachment_count }} file(s)
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                        @if($comm->status === 'sent') bg-green-500/20 text-green-300
                                        @elseif($comm->status === 'failed') bg-red-500/20 text-red-300
                                        @else bg-yellow-500/20 text-yellow-300 @endif">
                                        {{ ucfirst($comm->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-400">No communications yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

<!-- Enhanced Contact Modal with Attachments -->
<div id="contactModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border border-white/20 w-full max-w-2xl shadow-2xl rounded-2xl bg-black/40 backdrop-blur-xl">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-white text-center mb-4">Send Email to Client</h3>
            <form id="contactForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-purple-300 mb-2">To:</label>
                    <input type="text" value="{{ $client->full_name }} ({{ $client->email }})" readonly 
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white">
                </div>
                <div class="mb-4">
                    <label for="contactSubject" class="block text-sm font-medium text-purple-300 mb-2">Subject:</label>
                    <input type="text" name="subject" id="contactSubject" required
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="mb-4">
                    <label for="contactMessage" class="block text-sm font-medium text-purple-300 mb-2">Message:</label>
                    <textarea name="message" id="contactMessage" rows="6" required
                              class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Type your message here..."></textarea>
                </div>
                
                <!-- Attachments Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-purple-300 mb-2">Attachments (Optional):</label>
                    <div class="border-2 border-dashed border-white/20 rounded-xl p-4 bg-white/5">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4">
                                <label for="fileInput" class="cursor-pointer">
                                    <span class="mt-2 block text-sm font-medium text-white">
                                        Click to upload files or drag and drop
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-400">
                                        Max 10MB per file. Multiple files allowed.
                                    </span>
                                </label>
                                <input id="fileInput" name="files[]" type="file" class="hidden" multiple>
                            </div>
                        </div>
                    </div>
                    
                    <!-- File List -->
                    <div id="fileList" class="mt-3 space-y-2 hidden">
                        <h4 class="text-sm font-medium text-purple-300">Selected Files:</h4>
                        <div id="fileItems"></div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeContactModal()" 
                            class="px-4 py-2 bg-white/10 text-white rounded-xl hover:bg-white/20 text-sm transition-all">
                        Cancel
                    </button>
                    <button type="submit" id="sendEmailBtn"
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 text-sm transition-all">
                        Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border border-white/20 w-96 shadow-2xl rounded-2xl bg-black/40 backdrop-blur-xl">
        <div class="mt-3">
            <h3 id="approvalModalTitle" class="text-lg font-medium text-white text-center mb-4"></h3>
            <form id="approvalForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-purple-300 mb-2">
                        <span id="reasonLabel">Reason:</span>
                    </label>
                    <textarea name="reason" id="reason" rows="4" 
                              class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                              placeholder="Enter reason for this action..."></textarea>
                    <p class="text-xs text-gray-400 mt-1">This reason will be included in the email notification to the client.</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeApprovalModal()" 
                            class="px-4 py-2 bg-white/10 text-white rounded-xl hover:bg-white/20 text-sm transition-all">
                        Cancel
                    </button>
                    <button type="submit" id="approvalSubmitBtn"
                            class="px-4 py-2 rounded-xl text-white text-sm font-medium transition-all">
                        Confirm
                    </button>
                </div>
            </form>
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
        // Clear form
        document.getElementById('contactForm').reset();
        uploadedFiles = [];
        document.getElementById('fileList').classList.add('hidden');
        document.getElementById('fileItems').innerHTML = '';
    }

    function closeContactModal() {
        document.getElementById('contactModal').classList.add('hidden');
        // Clean up uploaded files
        uploadedFiles = [];
    }

    // Close modal when clicking outside
    document.getElementById('contactModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeContactModal();
        }
    });

    // File Upload Functionality
    document.getElementById('fileInput').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        files.forEach(file => uploadFile(file));
    });

    // Drag and drop functionality
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
        dropZone.classList.add('border-blue-400', 'bg-blue-500/10');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-blue-400', 'bg-blue-500/10');
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

        // Create file item in UI
        const fileItem = createFileItem(tempId, file.name, file.size, 'uploading');
        document.getElementById('fileItems').appendChild(fileItem);
        document.getElementById('fileList').classList.remove('hidden');

        // For now, just mark as uploaded (since we don't have the upload route)
        setTimeout(() => {
            uploadedFiles.push({
                temp_id: tempId,
                original_name: file.name,
                size: file.size,
                formatted_size: formatFileSize(file.size)
            });
            updateFileItem(tempId, 'uploaded', formatFileSize(file.size));
        }, 1000);
    }

    function createFileItem(tempId, fileName, fileSize, status) {
        const div = document.createElement('div');
        div.id = `file-${tempId}`;
        div.className = 'flex items-center justify-between p-2 bg-white/5 rounded border border-white/10';
        
        const sizeText = formatFileSize(fileSize);
        const statusClass = status === 'uploading' ? 'text-blue-400' : status === 'uploaded' ? 'text-green-400' : 'text-red-400';
        const statusText = status === 'uploading' ? 'Uploading...' : status === 'uploaded' ? 'Uploaded' : 'Failed';
        
        div.innerHTML = `
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div>
                    <div class="text-sm font-medium text-white">${fileName}</div>
                    <div class="text-xs text-gray-400">${sizeText}</div>
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

        // Add remove button if not uploading
        if (status !== 'uploading') {
            const buttonContainer = fileItem.querySelector('.flex.items-center:last-child');
            if (!buttonContainer.querySelector('button')) {
                buttonContainer.innerHTML += `<button onclick="removeFile('${tempId}')" class="text-red-400 hover:text-red-300 text-xs ml-2">Remove</button>`;
            }
        }
    }

    function removeFile(tempId) {
        // Remove from uploaded files array
        uploadedFiles = uploadedFiles.filter(file => file.temp_id !== tempId);
        
        // Remove from UI
        const fileItem = document.getElementById(`file-${tempId}`);
        if (fileItem) {
            fileItem.remove();
        }
        
        // Hide file list if no files
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

    // Handle email form submission
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
        
        // Add attachments
        if (uploadedFiles.length > 0) {
            formData.append('attachments', JSON.stringify(uploadedFiles));
        }
        
        fetch('{{ route("admin.clients.contact", $client) }}', {
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
                // Reload page to show updated communications
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

    // Approval Modal Functions
    function openApprovalModal(action) {
        const modal = document.getElementById('approvalModal');
        const form = document.getElementById('approvalForm');
        const title = document.getElementById('approvalModalTitle');
        const reasonLabel = document.getElementById('reasonLabel');
        const submitBtn = document.getElementById('approvalSubmitBtn');
        const reasonField = document.getElementById('reason');
        
        if (action === 'approve') {
            title.textContent = 'Approve Client Registration';
            reasonLabel.textContent = 'Approval Notes (Optional):';
            submitBtn.textContent = 'Approve Client';
            submitBtn.className = 'px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 rounded-xl text-white text-sm font-medium transition-all';
            form.action = '{{ route("admin.clients.update", $client) }}';
            reasonField.required = false;
            reasonField.placeholder = 'Add any notes about the approval (optional)...';
        } else {
            title.textContent = 'Reject Client Registration';
            reasonLabel.textContent = 'Rejection Reason (Required):';
            submitBtn.textContent = 'Reject Client';
            submitBtn.className = 'px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 rounded-xl text-white text-sm font-medium transition-all';
            form.action = '{{ route("admin.clients.update", $client) }}';
            reasonField.required = true;
            reasonField.placeholder = 'Please provide a reason for rejection...';
        }
        
        // Clear previous reason
        reasonField.value = '';
        
        modal.classList.remove('hidden');
    }

    function closeApprovalModal() {
        document.getElementById('approvalModal').classList.add('hidden');
    }

    // Close approval modal when clicking outside
    document.getElementById('approvalModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeApprovalModal();
        }
    });

    // Handle form submission with AJAX for better UX
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
                // Show success message and reload page
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