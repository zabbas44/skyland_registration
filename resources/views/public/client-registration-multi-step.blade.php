@extends('layouts.app')

@section('title', 'Client Registration')

@section('content')
<div class="min-h-screen bg-slate-900 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center mr-4">
                <span class="text-white font-bold text-lg">SL</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-white" style="font-family: Teko, sans-serif;">Sky Land Construction — Client Registration</h1>
                <p class="text-slate-400">Create an account to request quotations, book site visits, and manage your projects with <span class="text-teal-400">Sky Land Construction</span>.</p>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <!-- Step 1 - Account -->
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">1</div>
                        <span class="ml-2 text-white font-medium">Account</span>
                    </div>
                    
                    <!-- Step 2 - Client (Active) -->
                    <div class="flex items-center">
                        <div class="w-16 h-1 bg-teal-500 mx-2"></div>
                        <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold border-2 border-teal-300">2</div>
                        <span class="ml-2 text-teal-400 font-medium">Client</span>
                    </div>
                    
                    <!-- Step 3 - Project -->
                    <div class="flex items-center">
                        <div class="w-16 h-1 bg-slate-600 mx-2"></div>
                        <div class="w-8 h-8 bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold">3</div>
                        <span class="ml-2 text-slate-400 font-medium">Project</span>
                    </div>
                    
                    <!-- Step 4 - Attachments -->
                    <div class="flex items-center">
                        <div class="w-16 h-1 bg-slate-600 mx-2"></div>
                        <div class="w-8 h-8 bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold">4</div>
                        <span class="ml-2 text-slate-400 font-medium">Attachments</span>
                    </div>
                    
                    <!-- Step 5 - Consents -->
                    <div class="flex items-center">
                        <div class="w-16 h-1 bg-slate-600 mx-2"></div>
                        <div class="w-8 h-8 bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold">5</div>
                        <span class="ml-2 text-slate-400 font-medium">Consents</span>
                    </div>
                    
                    <!-- Step 6 - Review -->
                    <div class="flex items-center">
                        <div class="w-16 h-1 bg-slate-600 mx-2"></div>
                        <div class="w-8 h-8 bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold">6</div>
                        <span class="ml-2 text-slate-400 font-medium">Review</span>
                    </div>
                </div>
            </div>
            
            <!-- Progress Line -->
            <div class="w-full bg-slate-700 h-1 rounded-full">
                <div class="w-1/6 bg-gradient-to-r from-teal-500 to-teal-400 h-1 rounded-full"></div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-slate-800 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <!-- Honeypot Field -->
                <div class="hidden">
                    <label for="website">Do not fill this field</label>
                    <input type="text" name="website" id="website" value="" class="w-full">
                </div>

                <!-- Step Content -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-teal-400 mb-6">Client & Company (optional for individuals)</h2>
                    
                    <div class="space-y-6">
                        <!-- Client Type -->
                        <div>
                            <label for="client_type" class="block text-sm font-medium text-slate-300 mb-2">
                                Client Type *
                            </label>
                            <select name="client_type" id="client_type" required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('client_type') border-red-400 @enderror">
                                <option value="">Select...</option>
                                <option value="individual" {{ old('client_type') === 'individual' ? 'selected' : '' }}>Individual</option>
                                <option value="company" {{ old('client_type') === 'company' ? 'selected' : '' }}>Company</option>
                                <option value="government" {{ old('client_type') === 'government' ? 'selected' : '' }}>Government</option>
                                <option value="developer" {{ old('client_type') === 'developer' ? 'selected' : '' }}>Developer</option>
                                <option value="consultant" {{ old('client_type') === 'consultant' ? 'selected' : '' }}>Consultant</option>
                            </select>
                            @error('client_type')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Two Column Layout -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Billing Address -->
                            <div>
                                <label for="billing_address" class="block text-sm font-medium text-slate-300 mb-2">
                                    Billing Address
                                </label>
                                <input type="text" name="billing_address" id="billing_address"
                                       value="{{ old('billing_address') }}"
                                       placeholder="Street, City, Country"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('billing_address') border-red-400 @enderror">
                                @error('billing_address')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Website -->
                            <div>
                                <label for="company_website" class="block text-sm font-medium text-slate-300 mb-2">
                                    Website
                                </label>
                                <input type="url" name="company_website" id="company_website"
                                       value="{{ old('company_website') }}"
                                       placeholder="https://example.com"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('company_website') border-red-400 @enderror">
                                @error('company_website')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Company Name -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-slate-300 mb-2">
                                Company Name *
                            </label>
                            <input type="text" name="company_name" id="company_name" required
                                   value="{{ old('company_name') }}"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('company_name') border-red-400 @enderror">
                            @error('company_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Registration Number -->
                        <div>
                            <label for="registration_number" class="block text-sm font-medium text-slate-300 mb-2">
                                Registration Number
                            </label>
                            <input type="text" name="registration_number" id="registration_number"
                                   value="{{ old('registration_number') }}"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('registration_number') border-red-400 @enderror">
                            @error('registration_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                    Email *
                                </label>
                                <input type="email" name="email" id="email" required
                                       value="{{ old('email') }}"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('email') border-red-400 @enderror">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">
                                    Phone *
                                </label>
                                <input type="tel" name="phone" id="phone" required
                                       value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('phone') border-red-400 @enderror">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- ID Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- ID Type -->
                            <div>
                                <label for="id_type" class="block text-sm font-medium text-slate-300 mb-2">
                                    ID Type *
                                </label>
                                <select name="id_type" id="id_type" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('id_type') border-red-400 @enderror">
                                    <option value="">Select ID Type</option>
                                    <option value="emirates_id" {{ old('id_type') === 'emirates_id' ? 'selected' : '' }}>Emirates ID</option>
                                    <option value="passport" {{ old('id_type') === 'passport' ? 'selected' : '' }}>Passport</option>
                                    <option value="trade_license" {{ old('id_type') === 'trade_license' ? 'selected' : '' }}>Trade License</option>
                                </select>
                                @error('id_type')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ID Number -->
                            <div>
                                <label for="id_number" class="block text-sm font-medium text-slate-300 mb-2">
                                    ID/License Number *
                                </label>
                                <input type="text" name="id_number" id="id_number" required
                                       value="{{ old('id_number') }}"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('id_number') border-red-400 @enderror">
                                @error('id_number')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-slate-700">
                    <!-- Save Draft -->
                    <button type="button" class="px-6 py-2 bg-slate-700 text-slate-300 rounded-lg hover:bg-slate-600 transition-colors duration-200">
                        Save Draft
                    </button>

                    <!-- Navigation -->
                    <div class="flex space-x-4">
                        <button type="button" class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors duration-200">
                            Back
                        </button>
                        <button type="submit" class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors duration-200">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="mt-6 text-center">
                    <p class="text-slate-400 text-sm">
                        Need help with your application? <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> or call us at <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Custom styling for select dropdowns */
select option {
    background-color: #374151;
    color: white;
}

select option:checked {
    background-color: #14b8a6;
}
</style>

@endsection
