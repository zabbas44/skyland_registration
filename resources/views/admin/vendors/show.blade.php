@extends('layouts.admin')

@section('title', 'Vendor Details')
@section('page-title', 'Vendor Details: ' . $vendor->first_name . ' ' . $vendor->last_name)

@section('admin-content')
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.vendors.index') }}" 
           class="text-gray-600 hover:text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Vendors
        </a>
    </div>
    
    <div class="flex items-center space-x-3">
        <button onclick="openContactModal()" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            Send Email to Vendor
        </button>
        
        <a href="{{ route('admin.vendors.edit', $vendor) }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Edit Vendor
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Contact Information -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->first_name }} {{ $vendor->last_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Designation</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->contact_designation ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $vendor->contact_email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $vendor->contact_email }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Mobile</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->contact_mobile }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Company Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->contact_company_name }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Company Information -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Company Information</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Company Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->company_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Business Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->business_type ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Contact Person</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->company_contact_person }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Designation</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->company_designation }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Company Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $vendor->company_email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $vendor->company_email }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Company Phone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->company_phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Year Established</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->year_of_establishment ?: 'Not specified' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Website</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($vendor->website)
                                <a href="{{ $vendor->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $vendor->website }}
                                </a>
                            @else
                                Not specified
                            @endif
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Nature of Business</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->nature_of_business ?: 'Not specified' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->address }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Legal/Compliance Information -->
        @if($vendor->trade_license_number || $vendor->tax_id)
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Legal & Compliance</h3>
                </div>
                <div class="px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($vendor->trade_license_number)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Trade License Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $vendor->trade_license_number }}</dd>
                            </div>
                        @endif
                        @if($vendor->tax_id)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tax ID</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $vendor->tax_id }}</dd>
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
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Quick Info</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Registration Date</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->created_at->format('F j, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $vendor->updated_at->format('F j, Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($vendor->status === 'approved') bg-green-100 text-green-800
                                @elseif($vendor->status === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $vendor->status_display }}
                            </span>
                        </dd>
                    </div>
                    @if($vendor->status_updated_at)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $vendor->status_updated_at->format('F j, Y g:i A') }}</dd>
                        </div>
                    @endif
                    @if($vendor->statusUpdatedBy)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Updated By</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $vendor->statusUpdatedBy->name }}</dd>
                        </div>
                    @endif
                    @if($vendor->status_reason)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Reason</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $vendor->status_reason }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Approval Actions -->
        @if($vendor->status === 'pending')
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Approval Actions</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div class="flex flex-col space-y-3">
                        <button onclick="openApprovalModal('approve')" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Approve Vendor
                        </button>
                        
                        <button onclick="openApprovalModal('reject')" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reject Vendor
                        </button>
                    </div>
                </div>
            </div>
        @elseif($vendor->status === 'approved')
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Approval Actions</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="text-center">
                        <div class="text-green-600 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-green-800">Vendor Approved</p>
                        <button onclick="openApprovalModal('reject')" 
                                class="mt-3 w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Change to Rejected
                        </button>
                    </div>
                </div>
            </div>
        @elseif($vendor->status === 'rejected')
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Approval Actions</h3>
                </div>
                <div class="px-6 py-4">
                    <div class="text-center">
                        <div class="text-red-600 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-red-800">Vendor Rejected</p>
                        <button onclick="openApprovalModal('approve')" 
                                class="mt-3 w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Change to Approved
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Recent Communications -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Recent Communications</h3>
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
                            <div class="text-sm border-b border-gray-200 pb-3 last:border-b-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-900">{{ $comm->subject }}</p>
                                        <p class="text-gray-600 text-xs mt-1">{{ Str::limit($comm->message_preview, 100) }}</p>
                                        <div class="flex items-center mt-2 space-x-2">
                                            <p class="text-gray-500 text-xs">{{ $comm->sent_at->format('M j, Y g:i A') }}</p>
                                            @if($comm->adminUser)
                                                <span class="text-gray-400 text-xs">by {{ $comm->adminUser->name }}</span>
                                            @endif
                                        </div>
                                        @if($comm->hasAttachments())
                                            <div class="mt-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-blue-100 text-blue-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                    </svg>
                                                    {{ $comm->attachment_count }} file(s)
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $comm->status === 'sent' ? 'bg-green-100 text-green-800' : ($comm->status === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($comm->status) }}
                                    </span>
                                </div>
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

<!-- Enhanced Contact Modal with Attachments -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Send Email to Vendor</h3>
            <form id="contactForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">To:</label>
                    <input type="text" value="{{ $vendor->first_name }} {{ $vendor->last_name }} ({{ $vendor->contact_email }})" readonly 
                           class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm">
                </div>
                <div class="mb-4">
                    <label for="contactSubject" class="block text-sm font-medium text-gray-700 mb-2">Subject:</label>
                    <input type="text" name="subject" id="contactSubject" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="contactMessage" class="block text-sm font-medium text-gray-700 mb-2">Message:</label>
                    <textarea name="message" id="contactMessage" rows="6" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Type your message here..."></textarea>
                </div>
                
                <!-- Attachments Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attachments (Optional):</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="mt-4">
                                <label for="fileInput" class="cursor-pointer">
                                    <span class="mt-2 block text-sm font-medium text-gray-900">
                                        Click to upload files or drag and drop
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-500">
                                        Max 10MB per file. Multiple files allowed.
                                    </span>
                                </label>
                                <input id="fileInput" name="files[]" type="file" class="hidden" multiple>
                            </div>
                        </div>
                    </div>
                    
                    <!-- File List -->
                    <div id="fileList" class="mt-3 space-y-2 hidden">
                        <h4 class="text-sm font-medium text-gray-700">Selected Files:</h4>
                        <div id="fileItems"></div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeContactModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                        Cancel
                    </button>
                    <button type="submit" id="sendEmailBtn"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                        Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 id="approvalModalTitle" class="text-lg font-medium text-gray-900 text-center mb-4"></h3>
            <form id="approvalForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                        <span id="reasonLabel">Reason:</span>
                    </label>
                    <textarea name="reason" id="reason" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Enter reason for this action..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">This reason will be included in the email notification to the vendor.</p>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeApprovalModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                        Cancel
                    </button>
                    <button type="submit" id="approvalSubmitBtn"
                            class="px-4 py-2 rounded-md text-white text-sm font-medium">
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

    // File Upload Functionality (same as client)
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
        dropZone.classList.add('border-blue-400', 'bg-blue-50');
    }

    function unhighlight(e) {
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');
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

        // Upload file
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
        div.className = 'flex items-center justify-between p-2 bg-gray-50 rounded border';
        
        const sizeText = formatFileSize(fileSize);
        const statusClass = status === 'uploading' ? 'text-blue-600' : status === 'uploaded' ? 'text-green-600' : 'text-red-600';
        const statusText = status === 'uploading' ? 'Uploading...' : status === 'uploaded' ? 'Uploaded' : 'Failed';
        
        div.innerHTML = `
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <div>
                    <div class="text-sm font-medium text-gray-900">${fileName}</div>
                    <div class="text-xs text-gray-500">${sizeText}</div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-xs ${statusClass} mr-2">${statusText}</span>
                ${status !== 'uploading' ? `<button onclick="removeFile('${tempId}')" class="text-red-600 hover:text-red-800 text-xs">Remove</button>` : ''}
            </div>
        `;
        
        return div;
    }

    function updateFileItem(tempId, status, sizeOrError) {
        const fileItem = document.getElementById(`file-${tempId}`);
        if (!fileItem) return;

        const statusClass = status === 'uploaded' ? 'text-green-600' : 'text-red-600';
        const statusText = status === 'uploaded' ? 'Uploaded' : 'Failed';
        
        const statusSpan = fileItem.querySelector('.text-xs.text-blue-600, .text-xs.text-green-600, .text-xs.text-red-600');
        if (statusSpan) {
            statusSpan.className = `text-xs ${statusClass} mr-2`;
            statusSpan.textContent = statusText;
        }

        // Add remove button if not uploading
        if (status !== 'uploading') {
            const buttonContainer = fileItem.querySelector('.flex.items-center:last-child');
            if (!buttonContainer.querySelector('button')) {
                buttonContainer.innerHTML += `<button onclick="removeFile('${tempId}')" class="text-red-600 hover:text-red-800 text-xs ml-2">Remove</button>`;
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
        
        fetch('{{ route("admin.vendors.send-email", $vendor) }}', {
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
            title.textContent = 'Approve Vendor Registration';
            reasonLabel.textContent = 'Approval Notes (Optional):';
            submitBtn.textContent = 'Approve Vendor';
            submitBtn.className = 'px-4 py-2 bg-green-600 hover:bg-green-700 rounded-md text-white text-sm font-medium';
            form.action = '{{ route("admin.vendors.approve", $vendor) }}';
            reasonField.required = false;
            reasonField.placeholder = 'Add any notes about the approval (optional)...';
        } else {
            title.textContent = 'Reject Vendor Registration';
            reasonLabel.textContent = 'Rejection Reason (Required):';
            submitBtn.textContent = 'Reject Vendor';
            submitBtn.className = 'px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md text-white text-sm font-medium';
            form.action = '{{ route("admin.vendors.reject", $vendor) }}';
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
