@extends('layouts.admin')

@section('title', 'Add New Client')
@section('page-title', 'Add New Client')

@section('admin-content')
<div class="mb-6">
    <a href="{{ route('admin.clients.index') }}" 
       class="text-gray-600 hover:text-gray-900 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Clients
    </a>
</div>

<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Client Information</h3>
    </div>
    
    <form method="POST" action="{{ route('admin.clients.store') }}" class="px-6 py-4">
        @csrf
        
        <!-- General Information Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">General Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" id="full_name" required
                           value="{{ old('full_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('full_name') border-red-500 @enderror">
                    @error('full_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="org_name" class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                    <input type="text" name="org_name" id="org_name"
                           value="{{ old('org_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('org_name') border-red-500 @enderror">
                    @error('org_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="client_type" class="block text-sm font-medium text-gray-700 mb-2">Client Type *</label>
                    <select name="client_type" id="client_type" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('client_type') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="Individual" {{ old('client_type') === 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Corporate" {{ old('client_type') === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                        <option value="Government" {{ old('client_type') === 'Government' ? 'selected' : '' }}>Government</option>
                        <option value="NGOs" {{ old('client_type') === 'NGOs' ? 'selected' : '' }}>NGOs</option>
                    </select>
                    @error('client_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                    <input type="text" name="industry" id="industry"
                           value="{{ old('industry') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('industry') border-red-500 @enderror">
                    @error('industry')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="job_title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                    <input type="text" name="job_title" id="job_title"
                           value="{{ old('job_title') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('job_title') border-red-500 @enderror">
                    @error('job_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">Nationality</label>
                    <input type="text" name="nationality" id="nationality"
                           value="{{ old('nationality') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nationality') border-red-500 @enderror">
                    @error('nationality')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-2">Budget Range</label>
                    <select name="budget_range" id="budget_range"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('budget_range') border-red-500 @enderror">
                        <option value="">Select Range</option>
                        <option value="Under $10,000" {{ old('budget_range') === 'Under $10,000' ? 'selected' : '' }}>Under $10,000</option>
                        <option value="$10,000 - $50,000" {{ old('budget_range') === '$10,000 - $50,000' ? 'selected' : '' }}>$10,000 - $50,000</option>
                        <option value="$50,000 - $100,000" {{ old('budget_range') === '$50,000 - $100,000' ? 'selected' : '' }}>$50,000 - $100,000</option>
                        <option value="$100,000 - $500,000" {{ old('budget_range') === '$100,000 - $500,000' ? 'selected' : '' }}>$100,000 - $500,000</option>
                        <option value="Over $500,000" {{ old('budget_range') === 'Over $500,000' ? 'selected' : '' }}>Over $500,000</option>
                    </select>
                    @error('budget_range')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="referral_source" class="block text-sm font-medium text-gray-700 mb-2">Referral Source</label>
                    <input type="text" name="referral_source" id="referral_source"
                           value="{{ old('referral_source') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('referral_source') border-red-500 @enderror">
                    @error('referral_source')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Contact Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">Mobile *</label>
                    <input type="text" name="mobile" id="mobile" required
                           value="{{ old('mobile') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('mobile') border-red-500 @enderror">
                    @error('mobile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="office_phone" class="block text-sm font-medium text-gray-700 mb-2">Office Phone</label>
                    <input type="text" name="office_phone" id="office_phone"
                           value="{{ old('office_phone') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('office_phone') border-red-500 @enderror">
                    @error('office_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" name="website" id="website"
                           value="{{ old('website') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('website') border-red-500 @enderror">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                    <textarea name="address" id="address" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Business Information Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Business Information</h4>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="nature_of_business" class="block text-sm font-medium text-gray-700 mb-2">Nature of Business</label>
                    <textarea name="nature_of_business" id="nature_of_business" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nature_of_business') border-red-500 @enderror">{{ old('nature_of_business') }}</textarea>
                    @error('nature_of_business')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="core_services" class="block text-sm font-medium text-gray-700 mb-2">Core Services</label>
                    <textarea name="core_services" id="core_services" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('core_services') border-red-500 @enderror">{{ old('core_services') }}</textarea>
                    @error('core_services')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Legal Information Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Legal & Compliance</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="trade_license_number" class="block text-sm font-medium text-gray-700 mb-2">Trade License Number</label>
                    <input type="text" name="trade_license_number" id="trade_license_number"
                           value="{{ old('trade_license_number') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('trade_license_number') border-red-500 @enderror">
                    @error('trade_license_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="tax_id" class="block text-sm font-medium text-gray-700 mb-2">Tax ID</label>
                    <input type="text" name="tax_id" id="tax_id"
                           value="{{ old('tax_id') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tax_id') border-red-500 @enderror">
                    @error('tax_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Additional Contact Details Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Additional Contact Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="primary_contact_person" class="block text-sm font-medium text-gray-700 mb-2">Primary Contact Person</label>
                    <input type="text" name="primary_contact_person" id="primary_contact_person"
                           value="{{ old('primary_contact_person') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('primary_contact_person') border-red-500 @enderror">
                    @error('primary_contact_person')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="designation" class="block text-sm font-medium text-gray-700 mb-2">Designation</label>
                    <input type="text" name="designation" id="designation"
                           value="{{ old('designation') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('designation') border-red-500 @enderror">
                    @error('designation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="official_email" class="block text-sm font-medium text-gray-700 mb-2">Official Email</label>
                    <input type="email" name="official_email" id="official_email"
                           value="{{ old('official_email') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('official_email') border-red-500 @enderror">
                    @error('official_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="official_phone" class="block text-sm font-medium text-gray-700 mb-2">Official Phone</label>
                    <input type="text" name="official_phone" id="official_phone"
                           value="{{ old('official_phone') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('official_phone') border-red-500 @enderror">
                    @error('official_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="linkedin_profile" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn Profile</label>
                    <input type="url" name="linkedin_profile" id="linkedin_profile"
                           value="{{ old('linkedin_profile') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('linkedin_profile') border-red-500 @enderror">
                    @error('linkedin_profile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Emergency Contact Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Emergency Contact</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                           value="{{ old('emergency_contact_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('emergency_contact_name') border-red-500 @enderror">
                    @error('emergency_contact_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="emergency_contact_relationship" class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                    <input type="text" name="emergency_contact_relationship" id="emergency_contact_relationship"
                           value="{{ old('emergency_contact_relationship') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('emergency_contact_relationship') border-red-500 @enderror">
                    @error('emergency_contact_relationship')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="emergency_contact_phone" id="emergency_contact_phone"
                           value="{{ old('emergency_contact_phone') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('emergency_contact_phone') border-red-500 @enderror">
                    @error('emergency_contact_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.clients.index') }}" 
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                Create Client
            </button>
        </div>
    </form>
</div>
@endsection
