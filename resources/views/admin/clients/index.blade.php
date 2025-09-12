@extends('layouts.admin')

@section('title', 'Clients')
@section('page-title', 'Clients Management')

@section('admin-content')
<div class="mb-8 flex flex-col lg:flex-row gap-4 lg:justify-between lg:items-center">
    <div class="flex items-center">
        <!-- Search Form with Glass Effect -->
        <form method="GET" action="{{ route('admin.clients.index') }}" class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search clients..." 
                       class="w-64 px-4 py-3 pl-12 pr-4 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-blue-500/30 hover:bg-blue-500/40 text-blue-200 hover:text-blue-100 rounded-xl text-sm font-medium backdrop-blur-sm border border-blue-400/30 hover:border-blue-400/50 transition-all duration-300 shadow-lg">
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('admin.clients.index') }}" class="px-6 py-3 bg-slate-500/30 hover:bg-slate-500/40 text-slate-200 hover:text-slate-100 rounded-xl text-sm font-medium backdrop-blur-sm border border-slate-400/30 hover:border-slate-400/50 transition-all duration-300 shadow-lg">
                    Clear
                </a>
            @endif
        </form>
    </div>
    
    <a href="{{ route('admin.clients.create') }}" 
       class="group bg-gradient-to-r from-blue-500/30 to-purple-500/30 hover:from-blue-500/40 hover:to-purple-500/40 text-white px-6 py-3 rounded-xl text-sm font-medium flex items-center backdrop-blur-sm border border-blue-400/30 hover:border-blue-400/50 transition-all duration-300 shadow-lg hover:shadow-xl">
        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add New Client
    </a>
</div>

<!-- Clients Table with Glass Effect -->
<div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden shadow-xl">
    <div class="px-6 py-6 border-b border-white/20">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white font-['Inter',_'system-ui',_sans-serif]">
                    All Clients
                </h3>
                <p class="text-slate-300 text-sm mt-1">
                    {{ number_format($clients->total()) }} total clients registered
                </p>
            </div>
        </div>
    </div>
    
    @if($clients->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10" id="clientsTable">
                <thead class="bg-white/5 backdrop-blur-sm">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Organization</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($clients as $client)
                        <tr class="hover:bg-white/5 transition-colors duration-200 group">
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-purple-500/30 to-blue-500/30 backdrop-blur-sm border border-purple-400/30 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                                            <span class="text-sm font-bold text-white">
                                                {{ strtoupper(substr($client->full_name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-white">
                                            {{ $client->full_name }}
                                        </div>
                                        <div class="text-sm text-slate-400">{{ $client->job_title ?: 'No job title' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-white font-medium">{{ $client->email }}</div>
                                <div class="text-sm text-slate-400">{{ $client->mobile }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-sm text-white font-medium">{{ $client->org_name ?: 'Individual' }}</div>
                                <div class="text-sm text-slate-400">{{ $client->industry ?: 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold backdrop-blur-sm border 
                                    @if($client->client_type === 'Individual') bg-blue-500/20 text-blue-200 border-blue-400/30
                                    @elseif($client->client_type === 'Corporate') bg-emerald-500/20 text-emerald-200 border-emerald-400/30
                                    @elseif($client->client_type === 'Government') bg-purple-500/20 text-purple-200 border-purple-400/30
                                    @else bg-slate-500/20 text-slate-200 border-slate-400/30 @endif">
                                    {{ $client->client_type }}
                                </span>
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm text-slate-400 font-medium">
                                {{ $client->created_at->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.clients.show', $client) }}" 
                                       class="p-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 hover:text-blue-200 rounded-lg transition-all duration-200 backdrop-blur-sm border border-blue-400/30 hover:border-blue-400/50 group" title="View">
                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('admin.clients.edit', $client) }}" 
                                       class="p-2 bg-indigo-500/20 hover:bg-indigo-500/30 text-indigo-300 hover:text-indigo-200 rounded-lg transition-all duration-200 backdrop-blur-sm border border-indigo-400/30 hover:border-indigo-400/50 group" title="Edit">
                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    
                                    <button onclick="openContactModal({{ $client->id }}, '{{ $client->full_name }}', '{{ $client->email }}')"
                                            class="p-2 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-300 hover:text-emerald-200 rounded-lg transition-all duration-200 backdrop-blur-sm border border-emerald-400/30 hover:border-emerald-400/50 group" title="Contact">
                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </button>
                                    
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" 
                                          class="inline" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-500/20 hover:bg-red-500/30 text-red-300 hover:text-red-200 rounded-lg transition-all duration-200 backdrop-blur-sm border border-red-400/30 hover:border-red-400/50 group" title="Delete">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        
        <!-- Pagination with Glass Effect -->
        <div class="px-6 py-6 border-t border-white/10">
            <div class="flex items-center justify-between">
                <div class="text-sm text-slate-400">
                    Showing {{ $clients->firstItem() ?? 0 }} to {{ $clients->lastItem() ?? 0 }} of {{ $clients->total() }} results
                </div>
                <div class="[&>nav]:flex [&>nav]:items-center [&>nav]:space-x-2 [&_a]:px-3 [&_a]:py-2 [&_a]:bg-white/10 [&_a]:backdrop-blur-sm [&_a]:border [&_a]:border-white/20 [&_a]:text-slate-300 [&_a]:rounded-lg [&_a]:transition-all [&_a]:duration-200 hover:[&_a]:bg-white/20 hover:[&_a]:text-white [&_span]:px-3 [&_span]:py-2 [&_span]:text-slate-500">
                    {{ $clients->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="px-6 py-16 text-center">
            <div class="w-16 h-16 mx-auto bg-slate-500/20 rounded-2xl flex items-center justify-center mb-6">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 715.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">No clients found</h3>
            <p class="text-slate-400 mb-8">Get started by creating your first client or adjust your search criteria.</p>
            <a href="{{ route('admin.clients.create') }}" 
               class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500/30 to-purple-500/30 hover:from-blue-500/40 hover:to-purple-500/40 text-white font-medium rounded-xl backdrop-blur-sm border border-blue-400/30 hover:border-blue-400/50 transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Your First Client
            </a>
        </div>
    @endif
</div>

<!-- Contact Modal -->
<div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 text-center mb-4">Contact Client</h3>
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
    function openContactModal(clientId, clientName, clientEmail) {
        document.getElementById('contactEmail').value = clientEmail;
        document.getElementById('contactForm').action = `/admin/clients/${clientId}/contact`;
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
