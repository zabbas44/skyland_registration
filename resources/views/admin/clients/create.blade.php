@extends('layouts.admin-dark')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Create New Client</h1>
            <p class="text-purple-300">Add a new client to the system</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.clients.index') }}" 
               class="px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/20 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Clients
            </a>
            <a href="{{ route('client.register') }}" target="_blank"
               class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Use Full Registration Form
            </a>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="flex-1 p-6 overflow-y-auto custom-scrollbar">
    <!-- Info Card -->
    <div class="bg-gradient-to-r from-blue-500/20 to-purple-500/20 backdrop-blur-xl border border-white/20 rounded-2xl p-6 mb-8">
        <div class="flex items-start">
            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-white mb-2">Recommended: Use Full Registration Form</h3>
                <p class="text-purple-300 mb-4">For the best experience and to capture all necessary client information, we recommend using the complete multi-step registration form.</p>
                <a href="{{ route('client.register') }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-purple-600 transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-1M10 6V5a2 2 0 112 0v1M10 6h2m0 0v3m0-3h3m-3 3l3-3"></path>
                    </svg>
                    Open Full Registration Form
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Create Form -->
    <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
        <div class="mb-6">
            <h3 class="text-xl font-semibold text-white mb-2">Quick Client Creation</h3>
            <p class="text-purple-300">Create a basic client entry with essential information only.</p>
        </div>

        <form method="POST" action="{{ route('admin.clients.store') }}" class="max-w-4xl">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Full Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('full_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Mobile *</label>
                    <input type="text" name="mobile" value="{{ old('mobile') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('mobile')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Client Type</label>
                    <select name="client_type" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Individual" {{ old('client_type') === 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Corporate" {{ old('client_type') === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                        <option value="Government" {{ old('client_type') === 'Government' ? 'selected' : '' }}>Government</option>
                    </select>
                    @error('client_type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Organization Name</label>
                    <input type="text" name="org_name" value="{{ old('org_name') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('org_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('job_title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Address</label>
                <textarea name="address" rows="3" 
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Project Brief</label>
                <textarea name="project_brief" rows="4" 
                          placeholder="Brief description of the project or service required..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('project_brief') }}</textarea>
                @error('project_brief')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.clients.index') }}" 
                   class="px-6 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-purple-600 transition-all">
                    Create Client
                </button>
            </div>
        </form>
    </div>
</div>
@endsection