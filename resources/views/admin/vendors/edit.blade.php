@extends('layouts.admin-dark')

@section('admin-content')
<!-- Header -->
<header class="bg-black/20 backdrop-blur-xl border-b border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">Edit Vendor</h1>
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
            <a href="{{ route('admin.vendors.show', $vendor) }}" 
               class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all flex items-center">
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
    <form method="POST" action="{{ route('admin.vendors.update', $vendor) }}" class="max-w-4xl mx-auto">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-white mb-6">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $vendor->first_name) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('first_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $vendor->last_name) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('last_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $vendor->contact_email ?? $vendor->email) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('contact_email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Mobile</label>
                    <input type="text" name="contact_mobile" value="{{ old('contact_mobile', $vendor->contact_mobile ?? $vendor->mobile) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           required>
                    @error('contact_mobile')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Vendor Type</label>
                    <select name="vendor_type" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Individual" {{ old('vendor_type', $vendor->vendor_type) === 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Company" {{ old('vendor_type', $vendor->vendor_type) === 'Company' ? 'selected' : '' }}>Company</option>
                        <option value="Partnership" {{ old('vendor_type', $vendor->vendor_type) === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                    </select>
                    @error('vendor_type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Nationality</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $vendor->nationality) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('nationality')
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
                    <label class="block text-sm font-medium text-purple-300 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $vendor->company_name ?? $vendor->contact_company_name) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('company_name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $vendor->job_title) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('job_title')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Business Type</label>
                    <input type="text" name="business_type" value="{{ old('business_type', $vendor->business_type) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('business_type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Experience Years</label>
                    <input type="number" name="experience_years" value="{{ old('experience_years', $vendor->experience_years) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('experience_years')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Website</label>
                    <input type="url" name="website" value="{{ old('website', $vendor->website) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('website')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">LinkedIn Profile</label>
                    <input type="url" name="linkedin_profile" value="{{ old('linkedin_profile', $vendor->linkedin_profile) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('linkedin_profile')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Address</label>
                <textarea name="address" rows="3" 
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('address', $vendor->address ?? $vendor->contact_address) }}</textarea>
                @error('address')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Company Description</label>
                <textarea name="company_description" rows="4" 
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('company_description', $vendor->company_description) }}</textarea>
                @error('company_description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Services Information -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-white mb-6">Services Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Team Size</label>
                    <input type="text" name="team_size" value="{{ old('team_size', $vendor->team_size) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('team_size')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Pricing Structure</label>
                    <input type="text" name="pricing_structure" value="{{ old('pricing_structure', $vendor->pricing_structure) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('pricing_structure')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Availability Status</label>
                    <select name="availability_status" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Available" {{ old('availability_status', $vendor->availability_status) === 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Busy" {{ old('availability_status', $vendor->availability_status) === 'Busy' ? 'selected' : '' }}>Busy</option>
                        <option value="Unavailable" {{ old('availability_status', $vendor->availability_status) === 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    @error('availability_status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Preferred Project Size</label>
                    <select name="preferred_project_size" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <option value="Small" {{ old('preferred_project_size', $vendor->preferred_project_size) === 'Small' ? 'selected' : '' }}>Small</option>
                        <option value="Medium" {{ old('preferred_project_size', $vendor->preferred_project_size) === 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="Large" {{ old('preferred_project_size', $vendor->preferred_project_size) === 'Large' ? 'selected' : '' }}>Large</option>
                        <option value="Any" {{ old('preferred_project_size', $vendor->preferred_project_size) === 'Any' ? 'selected' : '' }}>Any</option>
                    </select>
                    @error('preferred_project_size')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Services Offered</label>
                <textarea name="services_offered" rows="3" 
                          placeholder="List the services you offer..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('services_offered', is_array($vendor->services_offered) ? implode(', ', $vendor->services_offered) : $vendor->services_offered) }}</textarea>
                @error('services_offered')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Specializations</label>
                <textarea name="specializations" rows="3" 
                          placeholder="List your specializations..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('specializations', is_array($vendor->specializations) ? implode(', ', $vendor->specializations) : $vendor->specializations) }}</textarea>
                @error('specializations')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Service Areas</label>
                <textarea name="service_areas" rows="3" 
                          placeholder="List the areas you serve..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('service_areas', is_array($vendor->service_areas) ? implode(', ', $vendor->service_areas) : $vendor->service_areas) }}</textarea>
                @error('service_areas')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Project Preferences</label>
                <textarea name="project_preferences" rows="4" 
                          placeholder="Describe your project preferences..."
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('project_preferences', $vendor->project_preferences) }}</textarea>
                @error('project_preferences')
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
                        <option value="pending" {{ old('status', $vendor->status ?? 'approved') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $vendor->status ?? 'approved') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $vendor->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Portfolio Website</label>
                    <input type="url" name="portfolio_website" value="{{ old('portfolio_website', $vendor->portfolio_website) }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    @error('portfolio_website')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-medium text-purple-300 mb-2">Status Reason</label>
                <textarea name="status_reason" rows="3" 
                          placeholder="Reason for status change (optional)"
                          class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('status_reason', $vendor->status_reason) }}</textarea>
                @error('status_reason')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.vendors.show', $vendor) }}" 
               class="px-6 py-3 bg-white/10 text-white rounded-xl hover:bg-white/20 transition-all">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                Update Vendor
            </button>
        </div>
    </form>
</div>
@endsection