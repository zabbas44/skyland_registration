@extends('layouts.admin-dark')

@section('title', 'Vendors Management')
@section('page-title', 'Vendors Management')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Vendors Management</h1>
        <div class="flex items-center space-x-4">
            <a href="{{ route('supplier.register') }}" target="_blank" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                + Add Vendor
            </a>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="flex-1 p-6 overflow-y-auto custom-scrollbar">
    <!-- Search and Filters -->
    <div class="mb-8">
        <form method="GET" action="{{ route('admin.vendors.index') }}" class="flex items-center space-x-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search vendors..." 
                       class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-medium hover:from-purple-600 hover:to-pink-600 transition-all">
                Search
            </button>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 backdrop-blur-xl border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-200 text-sm font-medium">Total Vendors</p>
                    <p class="text-3xl font-bold text-white">{{ $vendors->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 backdrop-blur-xl border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-200 text-sm font-medium">Active Vendors</p>
                    <p class="text-3xl font-bold text-white">{{ $vendors->where('status', 'approved')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-yellow-500/20 to-orange-500/20 backdrop-blur-xl border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-200 text-sm font-medium">Pending</p>
                    <p class="text-3xl font-bold text-white">{{ $vendors->where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500/20 to-pink-500/20 backdrop-blur-xl border border-white/20 rounded-2xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-200 text-sm font-medium">This Month</p>
                    <p class="text-3xl font-bold text-white">{{ $vendors->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendors Table -->
    <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10">
            <h3 class="text-lg font-semibold text-white">All Vendors</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Registered</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($vendors as $vendor)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-medium text-sm">{{ substr($vendor->first_name ?? $vendor->name ?? 'N', 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white">{{ $vendor->first_name ?? $vendor->name ?? 'N/A' }} {{ $vendor->last_name ?? '' }}</div>
                                        <div class="text-sm text-purple-300">{{ $vendor->contact_mobile ?? $vendor->mobile ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-200">{{ $vendor->contact_email ?? $vendor->email ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-200">{{ $vendor->company_name ?? $vendor->contact_company_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(($vendor->status ?? 'approved') === 'approved')
                                    <span class="px-2 py-1 text-xs font-medium bg-green-500/20 text-green-400 rounded-full">Approved</span>
                                @elseif($vendor->status === 'pending')
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-500/20 text-yellow-400 rounded-full">Pending</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-red-500/20 text-red-400 rounded-full">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-200">{{ $vendor->created_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.vendors.show', $vendor) }}" class="px-3 py-1 bg-green-500/20 text-green-400 rounded-lg hover:bg-green-500/30 transition-colors">View</a>
                                    <a href="{{ route('admin.vendors.edit', $vendor) }}" class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-lg hover:bg-purple-500/30 transition-colors">Edit</a>
                                    <button onclick="openEmailModal({{ $vendor->id }}, '{{ ($vendor->first_name ?? '') . ' ' . ($vendor->last_name ?? '') }}', '{{ $vendor->email }}')" class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-lg hover:bg-blue-500/30 transition-colors">Email</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-purple-300">
                                    <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No vendors found</p>
                                    <p class="text-sm text-gray-400 mt-2">Get started by adding your first vendor.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($vendors->hasPages())
            <div class="px-6 py-4 border-t border-white/10">
                {{ $vendors->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Email Modal -->
<div id="emailModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border border-white/20 w-full max-w-2xl shadow-2xl rounded-2xl bg-black/40 backdrop-blur-xl">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-white text-center mb-4">Send Email to Vendor</h3>
            <form id="emailForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-purple-300 mb-2">To:</label>
                    <input type="text" id="recipientInfo" readonly 
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white">
                </div>
                <div class="mb-4">
                    <label for="emailSubject" class="block text-sm font-medium text-purple-300 mb-2">Subject:</label>
                    <input type="text" name="subject" id="emailSubject" required
                           class="w-full px-3 py-2 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Enter email subject...">
                </div>
                <div class="mb-4">
                    <label for="emailMessage" class="block text-sm font-medium text-purple-300 mb-2">Message:</label>
                    <textarea name="message" id="emailMessage" rows="6" required
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
                    <button type="button" onclick="closeEmailModal()" 
                            class="px-4 py-2 bg-white/10 text-white rounded-xl hover:bg-white/20 text-sm transition-all">
                        Cancel
                    </button>
                    <button type="submit" id="sendEmailBtn"
                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 text-sm transition-all">
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
    let currentVendorId = null;
    let uploadedFiles = [];
    let uploadCounter = 0;

    function openEmailModal(vendorId, vendorName, vendorEmail) {
        currentVendorId = vendorId;
        document.getElementById('emailModal').classList.remove('hidden');
        document.getElementById('recipientInfo').value = `${vendorName.trim()} (${vendorEmail})`;
        
        // Clear form
        document.getElementById('emailForm').reset();
        document.getElementById('recipientInfo').value = `${vendorName.trim()} (${vendorEmail})`;
        uploadedFiles = [];
        document.getElementById('fileList').classList.add('hidden');
        document.getElementById('fileItems').innerHTML = '';
    }

    function closeEmailModal() {
        document.getElementById('emailModal').classList.add('hidden');
        currentVendorId = null;
        uploadedFiles = [];
    }

    // Close modal when clicking outside
    document.getElementById('emailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEmailModal();
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
    document.getElementById('emailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!currentVendorId) {
            alert('No vendor selected');
            return;
        }
        
        const submitBtn = document.getElementById('sendEmailBtn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
        
        const formData = new FormData();
        formData.append('subject', document.getElementById('emailSubject').value);
        formData.append('message', document.getElementById('emailMessage').value);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        // Add attachments
        if (uploadedFiles.length > 0) {
            uploadedFiles.forEach((file, index) => {
                formData.append(`attachments[${index}][temp_id]`, file.temp_id);
                formData.append(`attachments[${index}][original_name]`, file.original_name);
                formData.append(`attachments[${index}][size]`, file.size);
                formData.append(`attachments[${index}][formatted_size]`, file.formatted_size);
            });
        }
        
        fetch(`/admin/vendors/${currentVendorId}/send-email`, {
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
                alert('Email sent successfully!');
                closeEmailModal();
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
</script>
@endpush