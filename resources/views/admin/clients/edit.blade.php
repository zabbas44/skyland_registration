@extends('layouts.admin-dark')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Edit Client</h1>
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
            <a href="{{ route('admin.clients.show', $client) }}" 
               class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                View Details
            </a>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="flex-1 p-6 overflow-y-auto custom-scrollbar">
    <form method="POST" action="{{ route('admin.clients.update', $client) }}" class="max-w-4xl mx-auto">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-white mb-6">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $client->full_name) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('full_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $client->email) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Mobile</label>
                    <input type="text" name="mobile" value="{{ old('mobile', $client->mobile) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('mobile')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Client Type</label>
                    <select name="client_type" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Individual" {{ old('client_type', $client->client_type) === 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Corporate" {{ old('client_type', $client->client_type) === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                        <option value="Government" {{ old('client_type', $client->client_type) === 'Government' ? 'selected' : '' }}>Government</option>
                    </select>
                    @error('client_type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Company Information -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-white mb-6">Company Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Organization Name</label>
                    <input type="text" name="org_name" value="{{ old('org_name', $client->org_name) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('org_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $client->job_title) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('job_title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Industry</label>
                    <input type="text" name="industry" value="{{ old('industry', $client->industry) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('industry')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Website</label>
                    <input type="url" name="website" value="{{ old('website', $client->website) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('website')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Address</label>
                <textarea name="address" rows="3" 
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('address', $client->address) }}</textarea>
                @error('address')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Project Information -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-white mb-6">Project Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Project Type</label>
                    <input type="text" name="project_type" value="{{ old('project_type', $client->project_type) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('project_type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Budget Range</label>
                    <input type="text" name="budget_range" value="{{ old('budget_range', $client->budget_range) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('budget_range')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Target Start Date</label>
                    <input type="date" name="target_start_date" value="{{ old('target_start_date', $client->target_start_date) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('target_start_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Referral Source</label>
                    <input type="text" name="referral_source" value="{{ old('referral_source', $client->referral_source) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('referral_source')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Project Brief</label>
                <textarea name="project_brief" rows="4" 
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('project_brief', $client->project_brief) }}</textarea>
                @error('project_brief')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Status Management -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-white mb-6">Status Management</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="pending" {{ old('status', $client->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $client->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $client->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $client->nationality) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('nationality')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Status Reason</label>
                <textarea name="status_reason" rows="3" 
                          placeholder="Reason for status change (optional)"
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('status_reason', $client->status_reason) }}</textarea>
                @error('status_reason')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.clients.show', $client) }}" 
               class="px-6 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-purple-600 transition-all">
                Update Client
            </button>
        </div>
    </form>
</div>
@endsection