@extends('layouts.admin')

@section('title', 'Vendors')
@section('page-title', 'Vendors Management')

@section('admin-content')
<div class="mb-6 flex justify-between items-center">
    <div class="flex items-center">
        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.vendors.index') }}" class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search vendors..." 
                       class="w-64 px-4 py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('admin.vendors.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 text-sm">
                    Clear
                </a>
            @endif
        </form>
    </div>
    
    <a href="{{ route('admin.vendors.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add New Vendor
    </a>
</div>

<!-- Vendors Table -->
<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">
            All Vendors 
            <span class="text-sm font-normal text-gray-500">({{ $vendors->total() }} total)</span>
        </h3>
    </div>
    
    @if($vendors->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200" id="vendorsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($vendors as $vendor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">
                                                {{ strtoupper(substr($vendor->first_name, 0, 1) . substr($vendor->last_name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $vendor->first_name }} {{ $vendor->last_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $vendor->contact_designation }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $vendor->contact_email }}</div>
                                <div class="text-sm text-gray-500">{{ $vendor->contact_mobile }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $vendor->company_name }}</div>
                                <div class="text-sm text-gray-500">{{ $vendor->business_type }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $vendor->created_at->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.vendors.show', $vendor) }}" 
                                       class="text-blue-600 hover:text-blue-900" title="View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('admin.vendors.edit', $vendor) }}" 
                                       class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    
                                    <button onclick="openContactModal({{ $vendor->id }}, '{{ $vendor->first_name }} {{ $vendor->last_name }}', '{{ $vendor->contact_email }}')"
                                            class="text-green-600 hover:text-green-900" title="Contact">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    
                                    <form method="POST" action="{{ route('admin.vendors.destroy', $vendor) }}" 
                                          class="inline" onsubmit="return confirm('Are you sure you want to delete this vendor?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $vendors->appends(request()->query())->links() }}
        </div>
    @else
        <div class="px-6 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No vendors found</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating a new vendor.</p>
            <div class="mt-6">
                <a href="{{ route('admin.vendors.create') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Vendor
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Contact Vendor</h3>
            <form id="contactForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">To:</label>
                    <input type="text" id="contactEmail" readonly 
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
    function openContactModal(vendorId, vendorName, vendorEmail) {
        document.getElementById('contactEmail').value = vendorEmail;
        document.getElementById('contactForm').action = `/admin/vendors/${vendorId}/contact`;
        document.getElementById('subject').value = '';
        document.getElementById('message').value = '';
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
