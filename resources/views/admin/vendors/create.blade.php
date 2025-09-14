@extends('layouts.admin-dark')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Create New Vendor</h1>
            <p class="text-purple-300">Add a new vendor to the system</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.vendors.index') }}" 
               class="px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-xl hover:bg-white/20 transition-all flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Vendors
            </a>
            <a href="{{ route('supplier.register') }}" target="_blank"
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
    <div class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 backdrop-blur-xl border border-white/20 rounded-2xl p-6 mb-8">
        <div class="flex items-start">
            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-white mb-2">Recommended: Use Full Registration Form</h3>
                <p class="text-purple-300 mb-4">For the best experience and to capture all necessary vendor information, we recommend using the complete multi-step registration form.</p>
                <a href="{{ route('supplier.register') }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
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
            <h3 class="text-xl font-semibold text-white mb-2">Quick Vendor Creation</h3>
            <p class="text-purple-300">Create a basic vendor entry with essential information only.</p>
        </div>

        <form method="POST" action="{{ route('admin.vendors.store') }}" class="max-w-4xl">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">First Name *</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('first_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Last Name *</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('last_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Email *</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('contact_email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Mobile *</label>
                    <input type="text" name="contact_mobile" value="{{ old('contact_mobile') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('contact_mobile')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Vendor Type</label>
                    <select name="vendor_type" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Individual" {{ old('vendor_type') === 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Company" {{ old('vendor_type') === 'Company' ? 'selected' : '' }}>Company</option>
                        <option value="Partnership" {{ old('vendor_type') === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                    </select>
                    @error('vendor_type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('company_name')
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

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Business Type</label>
                    <input type="text" name="business_type" value="{{ old('business_type') }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('business_type')
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
                <label class="block text-sm font-medium text-purple-300 mb-2">Services Offered</label>
                <textarea name="services_offered" rows="3" 
                          placeholder="List the services you offer..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('services_offered') }}</textarea>
                @error('services_offered')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Company Description</label>
                <textarea name="company_description" rows="4" 
                          placeholder="Brief description of your company or services..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('company_description') }}</textarea>
                @error('company_description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.vendors.index') }}" 
                   class="px-6 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                    Create Vendor
                </button>
            </div>
        </form>
    </div>
</div>
@endsection