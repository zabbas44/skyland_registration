@extends('layouts.admin')

@section('title', 'Client Details')
@section('page-title', 'Client Details: ' . $client->full_name)

@section('admin-content')
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.clients.index') }}" 
           class="text-gray-600 hover:text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Clients
        </a>
    </div>
    
    <div class="flex items-center space-x-3">
        <button onclick="openContactModal()" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Contact Client
        </button>
        
        <a href="{{ route('admin.clients.edit', $client) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Client
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- General Information -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">General Information</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                    @if($client->client_type === 'Individual') bg-blue-100 text-blue-800
                    @elseif($client->client_type === 'Corporate') bg-green-100 text-green-800
                    @elseif($client->client_type === 'Government') bg-purple-100 text-purple-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ $client->client_type }}
                </span>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Job Title</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->job_title ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Organization</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->org_name ?: 'Individual' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Industry</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->industry ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nationality</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->nationality ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Budget Range</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->budget_range ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Referral Source</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->referral_source ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Website</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($client->website)
                                <a href="{{ $client->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $client->website }}
                                </a>
                            @else
                                Not specified
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->address }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Contact Details -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Contact Details</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $client->email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $client->email }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Mobile</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->mobile }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Office Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->office_phone ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Official Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($client->official_email)
                                <a href="mailto:{{ $client->official_email }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $client->official_email }}
                                </a>
                            @else
                                Not provided
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Primary Contact Person</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->primary_contact_person ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Designation</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->designation ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Official Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->official_phone ?: 'Not provided' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">LinkedIn Profile</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($client->linkedin_profile)
                                <a href="{{ $client->linkedin_profile }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $client->linkedin_profile }}
                                </a>
                            @else
                                Not provided
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Business Information -->
        @if($client->nature_of_business || $client->core_services)
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Business Information</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 gap-4">
                        @if($client->nature_of_business)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nature of Business</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $client->nature_of_business }}</dd>
                            </div>
                        @endif
                        @if($client->core_services)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Core Services</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $client->core_services }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        @endif

        <!-- Legal/Compliance Information -->
        @if($client->trade_license_number || $client->tax_id)
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Legal & Compliance</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($client->trade_license_number)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Trade License Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $client->trade_license_number }}</dd>
                            </div>
                        @endif
                        @if($client->tax_id)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tax ID</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $client->tax_id }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        @endif

        <!-- Emergency Contact -->
        @if($client->emergency_contact_name)
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Emergency Contact</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Name</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $client->emergency_contact_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Relationship</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $client->emergency_contact_relationship ?: 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $client->emergency_contact_phone ?: 'Not provided' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Stats -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Quick Info</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Registration Date</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->created_at->format('F j, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $client->updated_at->format('F j, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Recent Communications -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Communications</h3>
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
                            <div class="text-sm">
                                <p class="font-medium text-gray-900">{{ $comm->subject }}</p>
                                <p class="text-gray-500">{{ $comm->sent_at->format('M j, Y g:i A') }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $comm->status === 'sent' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($comm->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No communications yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Contact Client</h3>
            <form method="POST" action="{{ route('admin.clients.contact', $client) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">To:</label>
                    <input type="text" value="{{ $client->email }}" readonly 
                           class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm">
                </div>
                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject:</label>
                    <input type="text" name="subject" id="subject" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message:</label>
                    <textarea name="message" id="message" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeContactModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                        Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openContactModal() {
        document.getElementById('contactModal').classList.remove('hidden');
    }

    function closeContactModal() {
        document.getElementById('contactModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('contactModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeContactModal();
        }
    });
</script>
@endpush
