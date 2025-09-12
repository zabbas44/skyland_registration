@extends('layouts.admin')

@section('title', 'Edit Client')
@section('page-title', 'Edit Client: ' . $client->full_name)

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
        <h3 class="text-lg font-medium text-gray-900">Edit Client Information</h3>
    </div>
    
    <form method="POST" action="{{ route('admin.clients.update', $client) }}" class="px-6 py-4">
        @csrf
        @method('PUT')
        
        <!-- General Information Section -->
        <div class="mb-8">
            <h4 class="text-md font-medium text-gray-900 mb-4">General Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" id="full_name" required
                           value="{{ old('full_name', $client->full_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('full_name') border-red-500 @enderror">
                    @error('full_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="org_name" class="block text-sm font-medium text-gray-700 mb-2">Organization Name</label>
                    <input type="text" name="org_name" id="org_name"
                           value="{{ old('org_name', $client->org_name) }}"
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
                        <option value="Individual" {{ old('client_type', $client->client_type) === 'Individual' ? 'selected' : '' }}>Individual</option>
                        <option value="Corporate" {{ old('client_type', $client->client_type) === 'Corporate' ? 'selected' : '' }}>Corporate</option>
                        <option value="Government" {{ old('client_type', $client->client_type) === 'Government' ? 'selected' : '' }}>Government</option>
                        <option value="NGOs" {{ old('client_type', $client->client_type) === 'NGOs' ? 'selected' : '' }}>NGOs</option>
                    </select>
                    @error('client_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                    <input type="text" name="industry" id="industry"
                           value="{{ old('industry', $client->industry) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('industry') border-red-500 @enderror">
                    @error('industry')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="email" required
                           value="{{ old('email', $client->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">Mobile *</label>
                    <input type="text" name="mobile" id="mobile" required
                           value="{{ old('mobile', $client->mobile) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('mobile') border-red-500 @enderror">
                    @error('mobile')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                    <textarea name="address" id="address" rows="3" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('address') border-red-500 @enderror">{{ old('address', $client->address) }}</textarea>
                    @error('address')
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
                Update Client
            </button>
        </div>
    </form>
</div>
@endsection
