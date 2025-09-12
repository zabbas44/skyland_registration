@extends('layouts.admin')

@section('title', 'Add New Vendor')
@section('page-title', 'Add New Vendor')

@section('admin-content')
<div class="mb-6">
    <a href="{{ route('admin.vendors.index') }}" 
       class="text-gray-600 hover:text-gray-900 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Back to Vendors
    </a>
</div>

<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Vendor Information</h3>
    </div>
    
    <form method="POST" action="{{ route('admin.vendors.store') }}" class="px-6 py-4">
        @csrf
        
        <!-- Contact Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Contact Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                    <input type="text" name="first_name" id="first_name" required maxlength="50"
                           value="{{ old('first_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" required maxlength="50"
                           value="{{ old('last_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('last_name') border-red-500 @enderror">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="contact_company_name" class="block text-sm font-medium text-gray-700 mb-2">Contact Company Name *</label>
                    <input type="text" name="contact_company_name" id="contact_company_name" required maxlength="100"
                           value="{{ old('contact_company_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_company_name') border-red-500 @enderror">
                    @error('contact_company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="contact_designation" class="block text-sm font-medium text-gray-700 mb-2">Contact Designation</label>
                    <input type="text" name="contact_designation" id="contact_designation"
                           value="{{ old('contact_designation') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_designation') border-red-500 @enderror">
                    @error('contact_designation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email *</label>
                    <input type="email" name="contact_email" id="contact_email" required
                           value="{{ old('contact_email') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_email') border-red-500 @enderror">
                    @error('contact_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="contact_mobile" class="block text-sm font-medium text-gray-700 mb-2">Contact Mobile *</label>
                    <input type="text" name="contact_mobile" id="contact_mobile" required
                           value="{{ old('contact_mobile') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_mobile') border-red-500 @enderror">
                    @error('contact_mobile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Company Information Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Company Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                    <input type="text" name="company_name" id="company_name" required
                           value="{{ old('company_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_name') border-red-500 @enderror">
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="business_type" class="block text-sm font-medium text-gray-700 mb-2">Business Type</label>
                    <select name="business_type" id="business_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('business_type') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="Sole Proprietorship" {{ old('business_type') === 'Sole Proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                        <option value="Partnership" {{ old('business_type') === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="LLC" {{ old('business_type') === 'LLC' ? 'selected' : '' }}>LLC</option>
                        <option value="Corporation" {{ old('business_type') === 'Corporation' ? 'selected' : '' }}>Corporation</option>
                        <option value="Non-Profit" {{ old('business_type') === 'Non-Profit' ? 'selected' : '' }}>Non-Profit</option>
                        <option value="Other" {{ old('business_type') === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('business_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company_contact_person" class="block text-sm font-medium text-gray-700 mb-2">Company Contact Person *</label>
                    <input type="text" name="company_contact_person" id="company_contact_person" required
                           value="{{ old('company_contact_person') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_contact_person') border-red-500 @enderror">
                    @error('company_contact_person')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company_designation" class="block text-sm font-medium text-gray-700 mb-2">Company Designation *</label>
                    <input type="text" name="company_designation" id="company_designation" required
                           value="{{ old('company_designation') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_designation') border-red-500 @enderror">
                    @error('company_designation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company_email" class="block text-sm font-medium text-gray-700 mb-2">Company Email *</label>
                    <input type="email" name="company_email" id="company_email" required
                           value="{{ old('company_email') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_email') border-red-500 @enderror">
                    @error('company_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-2">Company Phone *</label>
                    <input type="text" name="company_phone" id="company_phone" required
                           value="{{ old('company_phone') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_phone') border-red-500 @enderror">
                    @error('company_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="year_of_establishment" class="block text-sm font-medium text-gray-700 mb-2">Year of Establishment</label>
                    <input type="number" name="year_of_establishment" id="year_of_establishment" min="1800" max="{{ date('Y') }}"
                           value="{{ old('year_of_establishment') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('year_of_establishment') border-red-500 @enderror">
                    @error('year_of_establishment')
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
                    <label for="nature_of_business" class="block text-sm font-medium text-gray-700 mb-2">Nature of Business</label>
                    <textarea name="nature_of_business" id="nature_of_business" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nature_of_business') border-red-500 @enderror">{{ old('nature_of_business') }}</textarea>
                    @error('nature_of_business')
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

        <!-- Submit Button -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.vendors.index') }}" 
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                Create Vendor
            </button>
        </div>
    </form>
</div>
@endsection
