@extends('layouts.admin')

@section('title', 'Edit Vendor')
@section('page-title', 'Edit Vendor: ' . $vendor->first_name . ' ' . $vendor->last_name)

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
        <h3 class="text-lg font-medium text-gray-900">Edit Vendor Information</h3>
    </div>
    
    <form method="POST" action="{{ route('admin.vendors.update', $vendor) }}" class="px-6 py-4">
        @csrf
        @method('PUT')
        
        <!-- Contact Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">Contact Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                    <input type="text" name="first_name" id="first_name" required maxlength="50"
                           value="{{ old('first_name', $vendor->first_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" required maxlength="50"
                           value="{{ old('last_name', $vendor->last_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('last_name') border-red-500 @enderror">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email *</label>
                    <input type="email" name="contact_email" id="contact_email" required
                           value="{{ old('contact_email', $vendor->contact_email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_email') border-red-500 @enderror">
                    @error('contact_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="contact_mobile" class="block text-sm font-medium text-gray-700 mb-2">Contact Mobile *</label>
                    <input type="text" name="contact_mobile" id="contact_mobile" required
                           value="{{ old('contact_mobile', $vendor->contact_mobile) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_mobile') border-red-500 @enderror">
                    @error('contact_mobile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                    <input type="text" name="company_name" id="company_name" required
                           value="{{ old('company_name', $vendor->company_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_name') border-red-500 @enderror">
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="company_email" class="block text-sm font-medium text-gray-700 mb-2">Company Email *</label>
                    <input type="email" name="company_email" id="company_email" required
                           value="{{ old('company_email', $vendor->company_email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_email') border-red-500 @enderror">
                    @error('company_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                    <textarea name="address" id="address" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror">{{ old('address', $vendor->address) }}</textarea>
                    @error('address')
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
                Update Vendor
            </button>
        </div>
    </form>
</div>
@endsection
