@extends('layouts.app')

@section('title', 'Client Registration')

@section('content')
<div class="min-h-screen bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 page-3d-background">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="w-16 h-16 flex items-center justify-center mr-4">
                <img src="{{ asset('images/logo-light-trimmed.webp') }}" alt="Sky Land Construction Logo" class="w-16 h-17 object-contain">
            </div>
            <div>
                <h1 class="text-2xl font-normal text-white" style="font-family: Teko, sans-serif;">Client Registration</h1>
                <p class="text-slate-400">Join our client portal to manage your construction needs efficiently with <span style="color: rgb(255,94,20);">SKY LAND CONSTRUCTION LLC OPC</span>. From quotation requests and site visit bookings to real-time project updates, everything is available at your fingertips.</p>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-4 flex-1">
                    <!-- Step 1 - Account -->
                    <div class="flex items-center step-indicator" data-step="1">
                        <div class="w-8 h-8 step-circle rounded-full flex items-center justify-center text-white text-sm font-semibold transition-all duration-300" style="background-color: rgb(255,94,20);">1</div>
                        <span class="ml-2 step-label text-white font-medium">Account</span>
            </div>

                    <!-- Connector Line 1 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="1"></div>
                    
                    <!-- Step 2 - Client -->
                    <div class="flex items-center step-indicator" data-step="2">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">2</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Client</span>
                    </div>
                    
                    <!-- Connector Line 2 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="2"></div>
                    
                    <!-- Step 3 - Project -->
                    <div class="flex items-center step-indicator" data-step="3">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">3</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Project</span>
                    </div>
                    
                    <!-- Connector Line 3 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="3"></div>
                    
                    <!-- Step 4 - Attachments -->
                    <div class="flex items-center step-indicator" data-step="4">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">4</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Attachments</span>
                    </div>
                    
                    <!-- Connector Line 4 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="4"></div>
                    
                    <!-- Step 5 - Consents -->
                    <div class="flex items-center step-indicator" data-step="5">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">5</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Consents</span>
                    </div>
                    
                    <!-- Connector Line 5 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="5"></div>
                    
                    <!-- Step 6 - Review -->
                    <div class="flex items-center step-indicator" data-step="6">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">6</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Review</span>
                    </div>
                </div>
            </div>
            
            <!-- Progress Line -->
            <div class="w-full bg-slate-700 h-6 rounded-full relative">
                <div id="progress-bar" class="h-6 rounded-full transition-all duration-500 relative overflow-hidden flex items-center justify-center" style="width: 16.67%; background: linear-gradient(to right, rgb(255,94,20), rgb(255,120,50));">
                    <span id="progress-percentage-text" class="text-xs font-bold text-white z-10">17%</span>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-3d-container bg-slate-800 rounded-lg shadow-xl">
            <form id="wizard-form" method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <!-- Honeypot Field -->
                <div class="hidden">
                    <label for="website">Do not fill this field</label>
                    <input type="text" name="website" id="website" value="" class="w-full">
                        </div>

                <!-- Step 1: Account -->
                <div class="step-content active" data-step="1">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Account Information</h2>
                    
                    <div class="space-y-6">
                        <!-- 1st Row: Name and Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Full Name *
                                </label>
                                <input type="text" name="name" id="name" required
                                       value="{{ old('name') }}"
                                       placeholder="Enter your full name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                    </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                    Email Address *
                                </label>
                                <input type="email" name="email" id="email" required
                                       value="{{ old('email') }}"
                                       placeholder="Enter your email address"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('email') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 2nd Row: Password and Confirm Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                    Password *
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" required
                                           placeholder="Enter your password"
                                           class="w-full px-4 py-3 pr-12 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('password') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <button type="button" class="absolute inset-y-0 right-0 w-12 flex items-center justify-center text-slate-400 hover:text-white transition-colors duration-200" onclick="togglePasswordVisibility('password', this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">
                                    Confirm Password *
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                           placeholder="Confirm your password"
                                           class="w-full px-4 py-3 pr-12 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <button type="button" class="absolute inset-y-0 right-0 w-12 flex items-center justify-center text-slate-400 hover:text-white transition-colors duration-200" onclick="togglePasswordVisibility('password_confirmation', this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Client & Company -->
                <div class="step-content" data-step="2">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Client & Company (optional for individuals)</h2>
                    
                    <div class="space-y-6">
                        <!-- Row 1: Client Type and Company Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Client Type -->
                        <div>
                                <label for="client_type" class="block text-sm font-medium text-slate-300 mb-2">
                                Client Type *
                            </label>
                            <select name="client_type" id="client_type" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('client_type') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <option value="">Select Client Type</option>
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

                        <!-- Company Name -->
                        <div>
                                <label for="company_name" class="block text-sm font-medium text-slate-300 mb-2">
                                Company Name *
                            </label>
                            <input type="text" name="company_name" id="company_name" required
                                   value="{{ old('company_name') }}"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                            @error('company_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>

                        <!-- Row 2: Email and Website -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Email -->
                        <div>
                                <label for="client_email" class="block text-sm font-medium text-slate-300 mb-2">
                                    Email Address *
                            </label>
                                <input type="email" name="client_email" id="client_email" required
                                       value="{{ old('client_email') }}"
                                       placeholder="client@example.com"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('client_email') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('client_email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- Website -->
                        <div>
                                <label for="website" class="block text-sm font-medium text-slate-300 mb-2">
                                    Website
                            </label>
                                <input type="url" name="website" id="website"
                                       value="{{ old('website') }}"
                                       placeholder="https://example.com"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('website') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('website')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium" style="color: rgb(255,94,20);">Billing Address</h3>
                            
                            <!-- Street Address -->
                            <div>
                                <label for="street_address" class="block text-sm font-medium text-slate-300 mb-2">
                                    Street Address *
                            </label>
                                <textarea name="street_address" id="street_address" rows="2" required
                                          placeholder="Building name, street name, area, city"
                                          class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 resize-none @error('street_address') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">{{ old('street_address') }}</textarea>
                                @error('street_address')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                </div>

                            <!-- Emirates and Country -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                                    <label for="emirate" class="block text-sm font-medium text-slate-300 mb-2">
                                        Emirate *
                            </label>
                                    <select name="emirate" id="emirate" required
                                            class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 @error('emirate') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="" class="bg-slate-700">Select Emirate</option>
                                        <option value="Abu Dhabi" class="bg-slate-700" {{ old('emirate') == 'Abu Dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                                        <option value="Dubai" class="bg-slate-700" {{ old('emirate') == 'Dubai' ? 'selected' : '' }}>Dubai</option>
                                        <option value="Sharjah" class="bg-slate-700" {{ old('emirate') == 'Sharjah' ? 'selected' : '' }}>Sharjah</option>
                                        <option value="Ajman" class="bg-slate-700" {{ old('emirate') == 'Ajman' ? 'selected' : '' }}>Ajman</option>
                                        <option value="Umm Al Quwain" class="bg-slate-700" {{ old('emirate') == 'Umm Al Quwain' ? 'selected' : '' }}>Umm Al Quwain</option>
                                        <option value="Ras Al Khaimah" class="bg-slate-700" {{ old('emirate') == 'Ras Al Khaimah' ? 'selected' : '' }}>Ras Al Khaimah</option>
                                        <option value="Fujairah" class="bg-slate-700" {{ old('emirate') == 'Fujairah' ? 'selected' : '' }}>Fujairah</option>
                            </select>
                                    @error('emirate')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                                    <label for="country" class="block text-sm font-medium text-slate-300 mb-2">
                                        Country *
                            </label>
                                    <input type="text" name="country" id="country" required
                                           value="{{ old('country', 'United Arab Emirates') }}"
                                           placeholder="United Arab Emirates"
                                           class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('country') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    @error('country')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Mobile and Landline Numbers -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Mobile Number -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">
                                    Mobile Number *
                            </label>
                                <div class="flex">
                                    <select name="mobile_country_code" class="px-3 py-3 bg-slate-700 border border-slate-600 rounded-l-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 w-24 text-sm appearance-none bg-no-repeat bg-right" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1; background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 4 5\"><path fill=\"%23ffffff\" d=\"m0 0 2 2 2-2z\"/></svg>'); background-position: right 4px center; background-size: 10px;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="+971" {{ old('mobile_country_code', '+971') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                        <option value="+93" {{ old('mobile_country_code') == '+93' ? 'selected' : '' }}>🇦🇫 +93</option>
                                        <option value="+355" {{ old('mobile_country_code') == '+355' ? 'selected' : '' }}>🇦🇱 +355</option>
                                        <option value="+213" {{ old('mobile_country_code') == '+213' ? 'selected' : '' }}>🇩🇿 +213</option>
                                        <option value="+1684" {{ old('mobile_country_code') == '+1684' ? 'selected' : '' }}>🇦🇸 +1684</option>
                                        <option value="+376" {{ old('mobile_country_code') == '+376' ? 'selected' : '' }}>🇦🇩 +376</option>
                                        <option value="+244" {{ old('mobile_country_code') == '+244' ? 'selected' : '' }}>🇦🇴 +244</option>
                                        <option value="+1264" {{ old('mobile_country_code') == '+1264' ? 'selected' : '' }}>🇦🇮 +1264</option>
                                        <option value="+1268" {{ old('mobile_country_code') == '+1268' ? 'selected' : '' }}>🇦🇬 +1268</option>
                                        <option value="+54" {{ old('mobile_country_code') == '+54' ? 'selected' : '' }}>🇦🇷 +54</option>
                                        <option value="+374" {{ old('mobile_country_code') == '+374' ? 'selected' : '' }}>🇦🇲 +374</option>
                                        <option value="+297" {{ old('mobile_country_code') == '+297' ? 'selected' : '' }}>🇦🇼 +297</option>
                                        <option value="+61" {{ old('mobile_country_code') == '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                        <option value="+43" {{ old('mobile_country_code') == '+43' ? 'selected' : '' }}>🇦🇹 +43</option>
                                        <option value="+994" {{ old('mobile_country_code') == '+994' ? 'selected' : '' }}>🇦🇿 +994</option>
                                        <option value="+1242" {{ old('mobile_country_code') == '+1242' ? 'selected' : '' }}>🇧🇸 +1242</option>
                                        <option value="+973" {{ old('mobile_country_code') == '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                        <option value="+880" {{ old('mobile_country_code') == '+880' ? 'selected' : '' }}>🇧🇩 +880</option>
                                        <option value="+1246" {{ old('mobile_country_code') == '+1246' ? 'selected' : '' }}>🇧🇧 +1246</option>
                                        <option value="+375" {{ old('mobile_country_code') == '+375' ? 'selected' : '' }}>🇧🇾 +375</option>
                                        <option value="+32" {{ old('mobile_country_code') == '+32' ? 'selected' : '' }}>🇧🇪 +32</option>
                                        <option value="+501" {{ old('mobile_country_code') == '+501' ? 'selected' : '' }}>🇧🇿 +501</option>
                                        <option value="+229" {{ old('mobile_country_code') == '+229' ? 'selected' : '' }}>🇧🇯 +229</option>
                                        <option value="+1441" {{ old('mobile_country_code') == '+1441' ? 'selected' : '' }}>🇧🇲 +1441</option>
                                        <option value="+975" {{ old('mobile_country_code') == '+975' ? 'selected' : '' }}>🇧🇹 +975</option>
                                        <option value="+591" {{ old('mobile_country_code') == '+591' ? 'selected' : '' }}>🇧🇴 +591</option>
                                        <option value="+387" {{ old('mobile_country_code') == '+387' ? 'selected' : '' }}>🇧🇦 +387</option>
                                        <option value="+267" {{ old('mobile_country_code') == '+267' ? 'selected' : '' }}>🇧🇼 +267</option>
                                        <option value="+55" {{ old('mobile_country_code') == '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                        <option value="+246" {{ old('mobile_country_code') == '+246' ? 'selected' : '' }}>🇮🇴 +246</option>
                                        <option value="+673" {{ old('mobile_country_code') == '+673' ? 'selected' : '' }}>🇧🇳 +673</option>
                                        <option value="+359" {{ old('mobile_country_code') == '+359' ? 'selected' : '' }}>🇧🇬 +359</option>
                                        <option value="+226" {{ old('mobile_country_code') == '+226' ? 'selected' : '' }}>🇧🇫 +226</option>
                                        <option value="+257" {{ old('mobile_country_code') == '+257' ? 'selected' : '' }}>🇧🇮 +257</option>
                                        <option value="+855" {{ old('mobile_country_code') == '+855' ? 'selected' : '' }}>🇰🇭 +855</option>
                                        <option value="+237" {{ old('mobile_country_code') == '+237' ? 'selected' : '' }}>🇨🇲 +237</option>
                                        <option value="+1" {{ old('mobile_country_code') == '+1' ? 'selected' : '' }}>🇨🇦 +1</option>
                                        <option value="+238" {{ old('mobile_country_code') == '+238' ? 'selected' : '' }}>🇨🇻 +238</option>
                                        <option value="+1345" {{ old('mobile_country_code') == '+1345' ? 'selected' : '' }}>🇰🇾 +1345</option>
                                        <option value="+236" {{ old('mobile_country_code') == '+236' ? 'selected' : '' }}>🇨🇫 +236</option>
                                        <option value="+235" {{ old('mobile_country_code') == '+235' ? 'selected' : '' }}>🇹🇩 +235</option>
                                        <option value="+56" {{ old('mobile_country_code') == '+56' ? 'selected' : '' }}>🇨🇱 +56</option>
                                        <option value="+86" {{ old('mobile_country_code') == '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                        <option value="+57" {{ old('mobile_country_code') == '+57' ? 'selected' : '' }}>🇨🇴 +57</option>
                                        <option value="+269" {{ old('mobile_country_code') == '+269' ? 'selected' : '' }}>🇰🇲 +269</option>
                                        <option value="+242" {{ old('mobile_country_code') == '+242' ? 'selected' : '' }}>🇨🇬 +242</option>
                                        <option value="+243" {{ old('mobile_country_code') == '+243' ? 'selected' : '' }}>🇨🇩 +243</option>
                                        <option value="+682" {{ old('mobile_country_code') == '+682' ? 'selected' : '' }}>🇨🇰 +682</option>
                                        <option value="+506" {{ old('mobile_country_code') == '+506' ? 'selected' : '' }}>🇨🇷 +506</option>
                                        <option value="+225" {{ old('mobile_country_code') == '+225' ? 'selected' : '' }}>🇨🇮 +225</option>
                                        <option value="+385" {{ old('mobile_country_code') == '+385' ? 'selected' : '' }}>🇭🇷 +385</option>
                                        <option value="+53" {{ old('mobile_country_code') == '+53' ? 'selected' : '' }}>🇨🇺 +53</option>
                                        <option value="+599" {{ old('mobile_country_code') == '+599' ? 'selected' : '' }}>🇨🇼 +599</option>
                                        <option value="+357" {{ old('mobile_country_code') == '+357' ? 'selected' : '' }}>🇨🇾 +357</option>
                                        <option value="+420" {{ old('mobile_country_code') == '+420' ? 'selected' : '' }}>🇨🇿 +420</option>
                                        <option value="+45" {{ old('mobile_country_code') == '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                        <option value="+253" {{ old('mobile_country_code') == '+253' ? 'selected' : '' }}>🇩🇯 +253</option>
                                        <option value="+1767" {{ old('mobile_country_code') == '+1767' ? 'selected' : '' }}>🇩🇲 +1767</option>
                                        <option value="+1809" {{ old('mobile_country_code') == '+1809' ? 'selected' : '' }}>🇩🇴 +1809</option>
                                        <option value="+593" {{ old('mobile_country_code') == '+593' ? 'selected' : '' }}>🇪🇨 +593</option>
                                        <option value="+20" {{ old('mobile_country_code') == '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                        <option value="+503" {{ old('mobile_country_code') == '+503' ? 'selected' : '' }}>🇸🇻 +503</option>
                                        <option value="+240" {{ old('mobile_country_code') == '+240' ? 'selected' : '' }}>🇬🇶 +240</option>
                                        <option value="+291" {{ old('mobile_country_code') == '+291' ? 'selected' : '' }}>🇪🇷 +291</option>
                                        <option value="+372" {{ old('mobile_country_code') == '+372' ? 'selected' : '' }}>🇪🇪 +372</option>
                                        <option value="+268" {{ old('mobile_country_code') == '+268' ? 'selected' : '' }}>🇸🇿 +268</option>
                                        <option value="+251" {{ old('mobile_country_code') == '+251' ? 'selected' : '' }}>🇪🇹 +251</option>
                                        <option value="+500" {{ old('mobile_country_code') == '+500' ? 'selected' : '' }}>🇫🇰 +500</option>
                                        <option value="+298" {{ old('mobile_country_code') == '+298' ? 'selected' : '' }}>🇫🇴 +298</option>
                                        <option value="+679" {{ old('mobile_country_code') == '+679' ? 'selected' : '' }}>🇫🇯 +679</option>
                                        <option value="+358" {{ old('mobile_country_code') == '+358' ? 'selected' : '' }}>🇫🇮 +358</option>
                                        <option value="+33" {{ old('mobile_country_code') == '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                        <option value="+594" {{ old('mobile_country_code') == '+594' ? 'selected' : '' }}>🇬🇫 +594</option>
                                        <option value="+689" {{ old('mobile_country_code') == '+689' ? 'selected' : '' }}>🇵🇫 +689</option>
                                        <option value="+241" {{ old('mobile_country_code') == '+241' ? 'selected' : '' }}>🇬🇦 +241</option>
                                        <option value="+220" {{ old('mobile_country_code') == '+220' ? 'selected' : '' }}>🇬🇲 +220</option>
                                        <option value="+995" {{ old('mobile_country_code') == '+995' ? 'selected' : '' }}>🇬🇪 +995</option>
                                        <option value="+49" {{ old('mobile_country_code') == '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                        <option value="+233" {{ old('mobile_country_code') == '+233' ? 'selected' : '' }}>🇬🇭 +233</option>
                                        <option value="+350" {{ old('mobile_country_code') == '+350' ? 'selected' : '' }}>🇬🇮 +350</option>
                                        <option value="+30" {{ old('mobile_country_code') == '+30' ? 'selected' : '' }}>🇬🇷 +30</option>
                                        <option value="+299" {{ old('mobile_country_code') == '+299' ? 'selected' : '' }}>🇬🇱 +299</option>
                                        <option value="+1473" {{ old('mobile_country_code') == '+1473' ? 'selected' : '' }}>🇬🇩 +1473</option>
                                        <option value="+590" {{ old('mobile_country_code') == '+590' ? 'selected' : '' }}>🇬🇵 +590</option>
                                        <option value="+1671" {{ old('mobile_country_code') == '+1671' ? 'selected' : '' }}>🇬🇺 +1671</option>
                                        <option value="+502" {{ old('mobile_country_code') == '+502' ? 'selected' : '' }}>🇬🇹 +502</option>
                                        <option value="+44" {{ old('mobile_country_code') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                        <option value="+224" {{ old('mobile_country_code') == '+224' ? 'selected' : '' }}>🇬🇳 +224</option>
                                        <option value="+245" {{ old('mobile_country_code') == '+245' ? 'selected' : '' }}>🇬🇼 +245</option>
                                        <option value="+592" {{ old('mobile_country_code') == '+592' ? 'selected' : '' }}>🇬🇾 +592</option>
                                        <option value="+509" {{ old('mobile_country_code') == '+509' ? 'selected' : '' }}>🇭🇹 +509</option>
                                        <option value="+504" {{ old('mobile_country_code') == '+504' ? 'selected' : '' }}>🇭🇳 +504</option>
                                        <option value="+852" {{ old('mobile_country_code') == '+852' ? 'selected' : '' }}>🇭🇰 +852</option>
                                        <option value="+36" {{ old('mobile_country_code') == '+36' ? 'selected' : '' }}>🇭🇺 +36</option>
                                        <option value="+354" {{ old('mobile_country_code') == '+354' ? 'selected' : '' }}>🇮🇸 +354</option>
                                        <option value="+91" {{ old('mobile_country_code') == '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                        <option value="+62" {{ old('mobile_country_code') == '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                        <option value="+98" {{ old('mobile_country_code') == '+98' ? 'selected' : '' }}>🇮🇷 +98</option>
                                        <option value="+964" {{ old('mobile_country_code') == '+964' ? 'selected' : '' }}>🇮🇶 +964</option>
                                        <option value="+353" {{ old('mobile_country_code') == '+353' ? 'selected' : '' }}>🇮🇪 +353</option>
                                        <option value="+972" {{ old('mobile_country_code') == '+972' ? 'selected' : '' }}>🇮🇱 +972</option>
                                        <option value="+39" {{ old('mobile_country_code') == '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                        <option value="+1876" {{ old('mobile_country_code') == '+1876' ? 'selected' : '' }}>🇯🇲 +1876</option>
                                        <option value="+81" {{ old('mobile_country_code') == '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                        <option value="+962" {{ old('mobile_country_code') == '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                        <option value="+7" {{ old('mobile_country_code') == '+7' ? 'selected' : '' }}>🇰🇿 +7</option>
                                        <option value="+254" {{ old('mobile_country_code') == '+254' ? 'selected' : '' }}>🇰🇪 +254</option>
                                        <option value="+686" {{ old('mobile_country_code') == '+686' ? 'selected' : '' }}>🇰🇮 +686</option>
                                        <option value="+850" {{ old('mobile_country_code') == '+850' ? 'selected' : '' }}>🇰🇵 +850</option>
                                        <option value="+82" {{ old('mobile_country_code') == '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                        <option value="+965" {{ old('mobile_country_code') == '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                        <option value="+996" {{ old('mobile_country_code') == '+996' ? 'selected' : '' }}>🇰🇬 +996</option>
                                        <option value="+856" {{ old('mobile_country_code') == '+856' ? 'selected' : '' }}>🇱🇦 +856</option>
                                        <option value="+371" {{ old('mobile_country_code') == '+371' ? 'selected' : '' }}>🇱🇻 +371</option>
                                        <option value="+961" {{ old('mobile_country_code') == '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                        <option value="+266" {{ old('mobile_country_code') == '+266' ? 'selected' : '' }}>🇱🇸 +266</option>
                                        <option value="+231" {{ old('mobile_country_code') == '+231' ? 'selected' : '' }}>🇱🇷 +231</option>
                                        <option value="+218" {{ old('mobile_country_code') == '+218' ? 'selected' : '' }}>🇱🇾 +218</option>
                                        <option value="+423" {{ old('mobile_country_code') == '+423' ? 'selected' : '' }}>🇱🇮 +423</option>
                                        <option value="+370" {{ old('mobile_country_code') == '+370' ? 'selected' : '' }}>🇱🇹 +370</option>
                                        <option value="+352" {{ old('mobile_country_code') == '+352' ? 'selected' : '' }}>🇱🇺 +352</option>
                                        <option value="+853" {{ old('mobile_country_code') == '+853' ? 'selected' : '' }}>🇲🇴 +853</option>
                                        <option value="+389" {{ old('mobile_country_code') == '+389' ? 'selected' : '' }}>🇲🇰 +389</option>
                                        <option value="+261" {{ old('mobile_country_code') == '+261' ? 'selected' : '' }}>🇲🇬 +261</option>
                                        <option value="+265" {{ old('mobile_country_code') == '+265' ? 'selected' : '' }}>🇲🇼 +265</option>
                                        <option value="+60" {{ old('mobile_country_code') == '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                        <option value="+960" {{ old('mobile_country_code') == '+960' ? 'selected' : '' }}>🇲🇻 +960</option>
                                        <option value="+223" {{ old('mobile_country_code') == '+223' ? 'selected' : '' }}>🇲🇱 +223</option>
                                        <option value="+356" {{ old('mobile_country_code') == '+356' ? 'selected' : '' }}>🇲🇹 +356</option>
                                        <option value="+692" {{ old('mobile_country_code') == '+692' ? 'selected' : '' }}>🇲🇭 +692</option>
                                        <option value="+596" {{ old('mobile_country_code') == '+596' ? 'selected' : '' }}>🇲🇶 +596</option>
                                        <option value="+222" {{ old('mobile_country_code') == '+222' ? 'selected' : '' }}>🇲🇷 +222</option>
                                        <option value="+230" {{ old('mobile_country_code') == '+230' ? 'selected' : '' }}>🇲🇺 +230</option>
                                        <option value="+262" {{ old('mobile_country_code') == '+262' ? 'selected' : '' }}>🇾🇹 +262</option>
                                        <option value="+52" {{ old('mobile_country_code') == '+52' ? 'selected' : '' }}>🇲🇽 +52</option>
                                        <option value="+691" {{ old('mobile_country_code') == '+691' ? 'selected' : '' }}>🇫🇲 +691</option>
                                        <option value="+373" {{ old('mobile_country_code') == '+373' ? 'selected' : '' }}>🇲🇩 +373</option>
                                        <option value="+377" {{ old('mobile_country_code') == '+377' ? 'selected' : '' }}>🇲🇨 +377</option>
                                        <option value="+976" {{ old('mobile_country_code') == '+976' ? 'selected' : '' }}>🇲🇳 +976</option>
                                        <option value="+382" {{ old('mobile_country_code') == '+382' ? 'selected' : '' }}>🇲🇪 +382</option>
                                        <option value="+1664" {{ old('mobile_country_code') == '+1664' ? 'selected' : '' }}>🇲🇸 +1664</option>
                                        <option value="+212" {{ old('mobile_country_code') == '+212' ? 'selected' : '' }}>🇲🇦 +212</option>
                                        <option value="+258" {{ old('mobile_country_code') == '+258' ? 'selected' : '' }}>🇲🇿 +258</option>
                                        <option value="+95" {{ old('mobile_country_code') == '+95' ? 'selected' : '' }}>🇲🇲 +95</option>
                                        <option value="+264" {{ old('mobile_country_code') == '+264' ? 'selected' : '' }}>🇳🇦 +264</option>
                                        <option value="+674" {{ old('mobile_country_code') == '+674' ? 'selected' : '' }}>🇳🇷 +674</option>
                                        <option value="+977" {{ old('mobile_country_code') == '+977' ? 'selected' : '' }}>🇳🇵 +977</option>
                                        <option value="+31" {{ old('mobile_country_code') == '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                        <option value="+687" {{ old('mobile_country_code') == '+687' ? 'selected' : '' }}>🇳🇨 +687</option>
                                        <option value="+64" {{ old('mobile_country_code') == '+64' ? 'selected' : '' }}>🇳🇿 +64</option>
                                        <option value="+505" {{ old('mobile_country_code') == '+505' ? 'selected' : '' }}>🇳🇮 +505</option>
                                        <option value="+227" {{ old('mobile_country_code') == '+227' ? 'selected' : '' }}>🇳🇪 +227</option>
                                        <option value="+234" {{ old('mobile_country_code') == '+234' ? 'selected' : '' }}>🇳🇬 +234</option>
                                        <option value="+683" {{ old('mobile_country_code') == '+683' ? 'selected' : '' }}>🇳🇺 +683</option>
                                        <option value="+672" {{ old('mobile_country_code') == '+672' ? 'selected' : '' }}>🇳🇫 +672</option>
                                        <option value="+1670" {{ old('mobile_country_code') == '+1670' ? 'selected' : '' }}>🇲🇵 +1670</option>
                                        <option value="+47" {{ old('mobile_country_code') == '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                        <option value="+968" {{ old('mobile_country_code') == '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                        <option value="+92" {{ old('mobile_country_code') == '+92' ? 'selected' : '' }}>🇵🇰 +92</option>
                                        <option value="+680" {{ old('mobile_country_code') == '+680' ? 'selected' : '' }}>🇵🇼 +680</option>
                                        <option value="+970" {{ old('mobile_country_code') == '+970' ? 'selected' : '' }}>🇵🇸 +970</option>
                                        <option value="+507" {{ old('mobile_country_code') == '+507' ? 'selected' : '' }}>🇵🇦 +507</option>
                                        <option value="+675" {{ old('mobile_country_code') == '+675' ? 'selected' : '' }}>🇵🇬 +675</option>
                                        <option value="+595" {{ old('mobile_country_code') == '+595' ? 'selected' : '' }}>🇵🇾 +595</option>
                                        <option value="+51" {{ old('mobile_country_code') == '+51' ? 'selected' : '' }}>🇵🇪 +51</option>
                                        <option value="+63" {{ old('mobile_country_code') == '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                        <option value="+48" {{ old('mobile_country_code') == '+48' ? 'selected' : '' }}>🇵🇱 +48</option>
                                        <option value="+351" {{ old('mobile_country_code') == '+351' ? 'selected' : '' }}>🇵🇹 +351</option>
                                        <option value="+1787" {{ old('mobile_country_code') == '+1787' ? 'selected' : '' }}>🇵🇷 +1787</option>
                                        <option value="+974" {{ old('mobile_country_code') == '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                        <option value="+262" {{ old('mobile_country_code') == '+262' ? 'selected' : '' }}>🇷🇪 +262</option>
                                        <option value="+40" {{ old('mobile_country_code') == '+40' ? 'selected' : '' }}>🇷🇴 +40</option>
                                        <option value="+7" {{ old('mobile_country_code') == '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                        <option value="+250" {{ old('mobile_country_code') == '+250' ? 'selected' : '' }}>🇷🇼 +250</option>
                                        <option value="+590" {{ old('mobile_country_code') == '+590' ? 'selected' : '' }}>🇧🇱 +590</option>
                                        <option value="+290" {{ old('mobile_country_code') == '+290' ? 'selected' : '' }}>🇸🇭 +290</option>
                                        <option value="+1869" {{ old('mobile_country_code') == '+1869' ? 'selected' : '' }}>🇰🇳 +1869</option>
                                        <option value="+1758" {{ old('mobile_country_code') == '+1758' ? 'selected' : '' }}>🇱🇨 +1758</option>
                                        <option value="+590" {{ old('mobile_country_code') == '+590' ? 'selected' : '' }}>🇲🇫 +590</option>
                                        <option value="+508" {{ old('mobile_country_code') == '+508' ? 'selected' : '' }}>🇵🇲 +508</option>
                                        <option value="+1784" {{ old('mobile_country_code') == '+1784' ? 'selected' : '' }}>🇻🇨 +1784</option>
                                        <option value="+685" {{ old('mobile_country_code') == '+685' ? 'selected' : '' }}>🇼🇸 +685</option>
                                        <option value="+378" {{ old('mobile_country_code') == '+378' ? 'selected' : '' }}>🇸🇲 +378</option>
                                        <option value="+239" {{ old('mobile_country_code') == '+239' ? 'selected' : '' }}>🇸🇹 +239</option>
                                        <option value="+966" {{ old('mobile_country_code') == '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                        <option value="+221" {{ old('mobile_country_code') == '+221' ? 'selected' : '' }}>🇸🇳 +221</option>
                                        <option value="+381" {{ old('mobile_country_code') == '+381' ? 'selected' : '' }}>🇷🇸 +381</option>
                                        <option value="+248" {{ old('mobile_country_code') == '+248' ? 'selected' : '' }}>🇸🇨 +248</option>
                                        <option value="+232" {{ old('mobile_country_code') == '+232' ? 'selected' : '' }}>🇸🇱 +232</option>
                                        <option value="+65" {{ old('mobile_country_code') == '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                        <option value="+1721" {{ old('mobile_country_code') == '+1721' ? 'selected' : '' }}>🇸🇽 +1721</option>
                                        <option value="+421" {{ old('mobile_country_code') == '+421' ? 'selected' : '' }}>🇸🇰 +421</option>
                                        <option value="+386" {{ old('mobile_country_code') == '+386' ? 'selected' : '' }}>🇸🇮 +386</option>
                                        <option value="+677" {{ old('mobile_country_code') == '+677' ? 'selected' : '' }}>🇸🇧 +677</option>
                                        <option value="+252" {{ old('mobile_country_code') == '+252' ? 'selected' : '' }}>🇸🇴 +252</option>
                                        <option value="+27" {{ old('mobile_country_code') == '+27' ? 'selected' : '' }}>🇿🇦 +27</option>
                                        <option value="+500" {{ old('mobile_country_code') == '+500' ? 'selected' : '' }}>🇬🇸 +500</option>
                                        <option value="+211" {{ old('mobile_country_code') == '+211' ? 'selected' : '' }}>🇸🇸 +211</option>
                                        <option value="+34" {{ old('mobile_country_code') == '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                        <option value="+94" {{ old('mobile_country_code') == '+94' ? 'selected' : '' }}>🇱🇰 +94</option>
                                        <option value="+249" {{ old('mobile_country_code') == '+249' ? 'selected' : '' }}>🇸🇩 +249</option>
                                        <option value="+597" {{ old('mobile_country_code') == '+597' ? 'selected' : '' }}>🇸🇷 +597</option>
                                        <option value="+47" {{ old('mobile_country_code') == '+47' ? 'selected' : '' }}>🇸🇯 +47</option>
                                        <option value="+46" {{ old('mobile_country_code') == '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                        <option value="+41" {{ old('mobile_country_code') == '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                        <option value="+963" {{ old('mobile_country_code') == '+963' ? 'selected' : '' }}>🇸🇾 +963</option>
                                        <option value="+886" {{ old('mobile_country_code') == '+886' ? 'selected' : '' }}>🇹🇼 +886</option>
                                        <option value="+992" {{ old('mobile_country_code') == '+992' ? 'selected' : '' }}>🇹🇯 +992</option>
                                        <option value="+255" {{ old('mobile_country_code') == '+255' ? 'selected' : '' }}>🇹🇿 +255</option>
                                        <option value="+66" {{ old('mobile_country_code') == '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                        <option value="+670" {{ old('mobile_country_code') == '+670' ? 'selected' : '' }}>🇹🇱 +670</option>
                                        <option value="+228" {{ old('mobile_country_code') == '+228' ? 'selected' : '' }}>🇹🇬 +228</option>
                                        <option value="+690" {{ old('mobile_country_code') == '+690' ? 'selected' : '' }}>🇹🇰 +690</option>
                                        <option value="+676" {{ old('mobile_country_code') == '+676' ? 'selected' : '' }}>🇹🇴 +676</option>
                                        <option value="+1868" {{ old('mobile_country_code') == '+1868' ? 'selected' : '' }}>🇹🇹 +1868</option>
                                        <option value="+216" {{ old('mobile_country_code') == '+216' ? 'selected' : '' }}>🇹🇳 +216</option>
                                        <option value="+90" {{ old('mobile_country_code') == '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                        <option value="+993" {{ old('mobile_country_code') == '+993' ? 'selected' : '' }}>🇹🇲 +993</option>
                                        <option value="+1649" {{ old('mobile_country_code') == '+1649' ? 'selected' : '' }}>🇹🇨 +1649</option>
                                        <option value="+688" {{ old('mobile_country_code') == '+688' ? 'selected' : '' }}>🇹🇻 +688</option>
                                        <option value="+256" {{ old('mobile_country_code') == '+256' ? 'selected' : '' }}>🇺🇬 +256</option>
                                        <option value="+380" {{ old('mobile_country_code') == '+380' ? 'selected' : '' }}>🇺🇦 +380</option>
                                        <option value="+1" {{ old('mobile_country_code') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                        <option value="+598" {{ old('mobile_country_code') == '+598' ? 'selected' : '' }}>🇺🇾 +598</option>
                                        <option value="+998" {{ old('mobile_country_code') == '+998' ? 'selected' : '' }}>🇺🇿 +998</option>
                                        <option value="+678" {{ old('mobile_country_code') == '+678' ? 'selected' : '' }}>🇻🇺 +678</option>
                                        <option value="+39" {{ old('mobile_country_code') == '+39' ? 'selected' : '' }}>🇻🇦 +39</option>
                                        <option value="+58" {{ old('mobile_country_code') == '+58' ? 'selected' : '' }}>🇻🇪 +58</option>
                                        <option value="+84" {{ old('mobile_country_code') == '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                        <option value="+1284" {{ old('mobile_country_code') == '+1284' ? 'selected' : '' }}>🇻🇬 +1284</option>
                                        <option value="+1340" {{ old('mobile_country_code') == '+1340' ? 'selected' : '' }}>🇻🇮 +1340</option>
                                        <option value="+681" {{ old('mobile_country_code') == '+681' ? 'selected' : '' }}>🇼🇫 +681</option>
                                        <option value="+212" {{ old('mobile_country_code') == '+212' ? 'selected' : '' }}>🇪🇭 +212</option>
                                        <option value="+967" {{ old('mobile_country_code') == '+967' ? 'selected' : '' }}>🇾🇪 +967</option>
                                        <option value="+260" {{ old('mobile_country_code') == '+260' ? 'selected' : '' }}>🇿🇲 +260</option>
                                        <option value="+263" {{ old('mobile_country_code') == '+263' ? 'selected' : '' }}>🇿🇼 +263</option>
                            </select>
                                    <input type="tel" name="phone" id="phone" required
                                           value="{{ old('phone') }}"
                                           placeholder="50 123 4567"
                                           class="flex-1 px-4 py-3 bg-slate-700 border border-slate-600 border-l-0 rounded-r-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('phone') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                </div>
                                @error('phone')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- Landline Number -->
                            <div>
                                <label for="landline" class="block text-sm font-medium text-slate-300 mb-2">
                                    Landline Number
                                </label>
                                <div class="flex">
                                    <select name="landline_country_code" class="px-3 py-3 bg-slate-700 border border-slate-600 rounded-l-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 w-24 text-sm appearance-none bg-no-repeat bg-right" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1; background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 4 5\"><path fill=\"%23ffffff\" d=\"m0 0 2 2 2-2z\"/></svg>'); background-position: right 4px center; background-size: 10px;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="+971" {{ old('landline_country_code', '+971') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                        <option value="+93" {{ old('landline_country_code') == '+93' ? 'selected' : '' }}>🇦🇫 +93</option>
                                        <option value="+355" {{ old('landline_country_code') == '+355' ? 'selected' : '' }}>🇦🇱 +355</option>
                                        <option value="+213" {{ old('landline_country_code') == '+213' ? 'selected' : '' }}>🇩🇿 +213</option>
                                        <option value="+1684" {{ old('landline_country_code') == '+1684' ? 'selected' : '' }}>🇦🇸 +1684</option>
                                        <option value="+376" {{ old('landline_country_code') == '+376' ? 'selected' : '' }}>🇦🇩 +376</option>
                                        <option value="+244" {{ old('landline_country_code') == '+244' ? 'selected' : '' }}>🇦🇴 +244</option>
                                        <option value="+1264" {{ old('landline_country_code') == '+1264' ? 'selected' : '' }}>🇦🇮 +1264</option>
                                        <option value="+1268" {{ old('landline_country_code') == '+1268' ? 'selected' : '' }}>🇦🇬 +1268</option>
                                        <option value="+54" {{ old('landline_country_code') == '+54' ? 'selected' : '' }}>🇦🇷 +54</option>
                                        <option value="+374" {{ old('landline_country_code') == '+374' ? 'selected' : '' }}>🇦🇲 +374</option>
                                        <option value="+297" {{ old('landline_country_code') == '+297' ? 'selected' : '' }}>🇦🇼 +297</option>
                                        <option value="+61" {{ old('landline_country_code') == '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                        <option value="+43" {{ old('landline_country_code') == '+43' ? 'selected' : '' }}>🇦🇹 +43</option>
                                        <option value="+994" {{ old('landline_country_code') == '+994' ? 'selected' : '' }}>🇦🇿 +994</option>
                                        <option value="+1242" {{ old('landline_country_code') == '+1242' ? 'selected' : '' }}>🇧🇸 +1242</option>
                                        <option value="+973" {{ old('landline_country_code') == '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                        <option value="+880" {{ old('landline_country_code') == '+880' ? 'selected' : '' }}>🇧🇩 +880</option>
                                        <option value="+1246" {{ old('landline_country_code') == '+1246' ? 'selected' : '' }}>🇧🇧 +1246</option>
                                        <option value="+375" {{ old('landline_country_code') == '+375' ? 'selected' : '' }}>🇧🇾 +375</option>
                                        <option value="+32" {{ old('landline_country_code') == '+32' ? 'selected' : '' }}>🇧🇪 +32</option>
                                        <option value="+501" {{ old('landline_country_code') == '+501' ? 'selected' : '' }}>🇧🇿 +501</option>
                                        <option value="+229" {{ old('landline_country_code') == '+229' ? 'selected' : '' }}>🇧🇯 +229</option>
                                        <option value="+1441" {{ old('landline_country_code') == '+1441' ? 'selected' : '' }}>🇧🇲 +1441</option>
                                        <option value="+975" {{ old('landline_country_code') == '+975' ? 'selected' : '' }}>🇧🇹 +975</option>
                                        <option value="+591" {{ old('landline_country_code') == '+591' ? 'selected' : '' }}>🇧🇴 +591</option>
                                        <option value="+387" {{ old('landline_country_code') == '+387' ? 'selected' : '' }}>🇧🇦 +387</option>
                                        <option value="+267" {{ old('landline_country_code') == '+267' ? 'selected' : '' }}>🇧🇼 +267</option>
                                        <option value="+55" {{ old('landline_country_code') == '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                        <option value="+246" {{ old('landline_country_code') == '+246' ? 'selected' : '' }}>🇮🇴 +246</option>
                                        <option value="+673" {{ old('landline_country_code') == '+673' ? 'selected' : '' }}>🇧🇳 +673</option>
                                        <option value="+359" {{ old('landline_country_code') == '+359' ? 'selected' : '' }}>🇧🇬 +359</option>
                                        <option value="+226" {{ old('landline_country_code') == '+226' ? 'selected' : '' }}>🇧🇫 +226</option>
                                        <option value="+257" {{ old('landline_country_code') == '+257' ? 'selected' : '' }}>🇧🇮 +257</option>
                                        <option value="+855" {{ old('landline_country_code') == '+855' ? 'selected' : '' }}>🇰🇭 +855</option>
                                        <option value="+237" {{ old('landline_country_code') == '+237' ? 'selected' : '' }}>🇨🇲 +237</option>
                                        <option value="+1" {{ old('landline_country_code') == '+1' ? 'selected' : '' }}>🇨🇦 +1</option>
                                        <option value="+238" {{ old('landline_country_code') == '+238' ? 'selected' : '' }}>🇨🇻 +238</option>
                                        <option value="+1345" {{ old('landline_country_code') == '+1345' ? 'selected' : '' }}>🇰🇾 +1345</option>
                                        <option value="+236" {{ old('landline_country_code') == '+236' ? 'selected' : '' }}>🇨🇫 +236</option>
                                        <option value="+235" {{ old('landline_country_code') == '+235' ? 'selected' : '' }}>🇹🇩 +235</option>
                                        <option value="+56" {{ old('landline_country_code') == '+56' ? 'selected' : '' }}>🇨🇱 +56</option>
                                        <option value="+86" {{ old('landline_country_code') == '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                        <option value="+57" {{ old('landline_country_code') == '+57' ? 'selected' : '' }}>🇨🇴 +57</option>
                                        <option value="+269" {{ old('landline_country_code') == '+269' ? 'selected' : '' }}>🇰🇲 +269</option>
                                        <option value="+242" {{ old('landline_country_code') == '+242' ? 'selected' : '' }}>🇨🇬 +242</option>
                                        <option value="+243" {{ old('landline_country_code') == '+243' ? 'selected' : '' }}>🇨🇩 +243</option>
                                        <option value="+682" {{ old('landline_country_code') == '+682' ? 'selected' : '' }}>🇨🇰 +682</option>
                                        <option value="+506" {{ old('landline_country_code') == '+506' ? 'selected' : '' }}>🇨🇷 +506</option>
                                        <option value="+225" {{ old('landline_country_code') == '+225' ? 'selected' : '' }}>🇨🇮 +225</option>
                                        <option value="+385" {{ old('landline_country_code') == '+385' ? 'selected' : '' }}>🇭🇷 +385</option>
                                        <option value="+53" {{ old('landline_country_code') == '+53' ? 'selected' : '' }}>🇨🇺 +53</option>
                                        <option value="+599" {{ old('landline_country_code') == '+599' ? 'selected' : '' }}>🇨🇼 +599</option>
                                        <option value="+357" {{ old('landline_country_code') == '+357' ? 'selected' : '' }}>🇨🇾 +357</option>
                                        <option value="+420" {{ old('landline_country_code') == '+420' ? 'selected' : '' }}>🇨🇿 +420</option>
                                        <option value="+45" {{ old('landline_country_code') == '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                        <option value="+253" {{ old('landline_country_code') == '+253' ? 'selected' : '' }}>🇩🇯 +253</option>
                                        <option value="+1767" {{ old('landline_country_code') == '+1767' ? 'selected' : '' }}>🇩🇲 +1767</option>
                                        <option value="+1809" {{ old('landline_country_code') == '+1809' ? 'selected' : '' }}>🇩🇴 +1809</option>
                                        <option value="+593" {{ old('landline_country_code') == '+593' ? 'selected' : '' }}>🇪🇨 +593</option>
                                        <option value="+20" {{ old('landline_country_code') == '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                        <option value="+503" {{ old('landline_country_code') == '+503' ? 'selected' : '' }}>🇸🇻 +503</option>
                                        <option value="+240" {{ old('landline_country_code') == '+240' ? 'selected' : '' }}>🇬🇶 +240</option>
                                        <option value="+291" {{ old('landline_country_code') == '+291' ? 'selected' : '' }}>🇪🇷 +291</option>
                                        <option value="+372" {{ old('landline_country_code') == '+372' ? 'selected' : '' }}>🇪🇪 +372</option>
                                        <option value="+268" {{ old('landline_country_code') == '+268' ? 'selected' : '' }}>🇸🇿 +268</option>
                                        <option value="+251" {{ old('landline_country_code') == '+251' ? 'selected' : '' }}>🇪🇹 +251</option>
                                        <option value="+500" {{ old('landline_country_code') == '+500' ? 'selected' : '' }}>🇫🇰 +500</option>
                                        <option value="+298" {{ old('landline_country_code') == '+298' ? 'selected' : '' }}>🇫🇴 +298</option>
                                        <option value="+679" {{ old('landline_country_code') == '+679' ? 'selected' : '' }}>🇫🇯 +679</option>
                                        <option value="+358" {{ old('landline_country_code') == '+358' ? 'selected' : '' }}>🇫🇮 +358</option>
                                        <option value="+33" {{ old('landline_country_code') == '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                        <option value="+594" {{ old('landline_country_code') == '+594' ? 'selected' : '' }}>🇬🇫 +594</option>
                                        <option value="+689" {{ old('landline_country_code') == '+689' ? 'selected' : '' }}>🇵🇫 +689</option>
                                        <option value="+241" {{ old('landline_country_code') == '+241' ? 'selected' : '' }}>🇬🇦 +241</option>
                                        <option value="+220" {{ old('landline_country_code') == '+220' ? 'selected' : '' }}>🇬🇲 +220</option>
                                        <option value="+995" {{ old('landline_country_code') == '+995' ? 'selected' : '' }}>🇬🇪 +995</option>
                                        <option value="+49" {{ old('landline_country_code') == '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                        <option value="+233" {{ old('landline_country_code') == '+233' ? 'selected' : '' }}>🇬🇭 +233</option>
                                        <option value="+350" {{ old('landline_country_code') == '+350' ? 'selected' : '' }}>🇬🇮 +350</option>
                                        <option value="+30" {{ old('landline_country_code') == '+30' ? 'selected' : '' }}>🇬🇷 +30</option>
                                        <option value="+299" {{ old('landline_country_code') == '+299' ? 'selected' : '' }}>🇬🇱 +299</option>
                                        <option value="+1473" {{ old('landline_country_code') == '+1473' ? 'selected' : '' }}>🇬🇩 +1473</option>
                                        <option value="+590" {{ old('landline_country_code') == '+590' ? 'selected' : '' }}>🇬🇵 +590</option>
                                        <option value="+1671" {{ old('landline_country_code') == '+1671' ? 'selected' : '' }}>🇬🇺 +1671</option>
                                        <option value="+502" {{ old('landline_country_code') == '+502' ? 'selected' : '' }}>🇬🇹 +502</option>
                                        <option value="+44" {{ old('landline_country_code') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                        <option value="+224" {{ old('landline_country_code') == '+224' ? 'selected' : '' }}>🇬🇳 +224</option>
                                        <option value="+245" {{ old('landline_country_code') == '+245' ? 'selected' : '' }}>🇬🇼 +245</option>
                                        <option value="+592" {{ old('landline_country_code') == '+592' ? 'selected' : '' }}>🇬🇾 +592</option>
                                        <option value="+509" {{ old('landline_country_code') == '+509' ? 'selected' : '' }}>🇭🇹 +509</option>
                                        <option value="+504" {{ old('landline_country_code') == '+504' ? 'selected' : '' }}>🇭🇳 +504</option>
                                        <option value="+852" {{ old('landline_country_code') == '+852' ? 'selected' : '' }}>🇭🇰 +852</option>
                                        <option value="+36" {{ old('landline_country_code') == '+36' ? 'selected' : '' }}>🇭🇺 +36</option>
                                        <option value="+354" {{ old('landline_country_code') == '+354' ? 'selected' : '' }}>🇮🇸 +354</option>
                                        <option value="+91" {{ old('landline_country_code') == '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                        <option value="+62" {{ old('landline_country_code') == '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                        <option value="+98" {{ old('landline_country_code') == '+98' ? 'selected' : '' }}>🇮🇷 +98</option>
                                        <option value="+964" {{ old('landline_country_code') == '+964' ? 'selected' : '' }}>🇮🇶 +964</option>
                                        <option value="+353" {{ old('landline_country_code') == '+353' ? 'selected' : '' }}>🇮🇪 +353</option>
                                        <option value="+972" {{ old('landline_country_code') == '+972' ? 'selected' : '' }}>🇮🇱 +972</option>
                                        <option value="+39" {{ old('landline_country_code') == '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                        <option value="+1876" {{ old('landline_country_code') == '+1876' ? 'selected' : '' }}>🇯🇲 +1876</option>
                                        <option value="+81" {{ old('landline_country_code') == '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                        <option value="+962" {{ old('landline_country_code') == '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                        <option value="+7" {{ old('landline_country_code') == '+7' ? 'selected' : '' }}>🇰🇿 +7</option>
                                        <option value="+254" {{ old('landline_country_code') == '+254' ? 'selected' : '' }}>🇰🇪 +254</option>
                                        <option value="+686" {{ old('landline_country_code') == '+686' ? 'selected' : '' }}>🇰🇮 +686</option>
                                        <option value="+850" {{ old('landline_country_code') == '+850' ? 'selected' : '' }}>🇰🇵 +850</option>
                                        <option value="+82" {{ old('landline_country_code') == '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                        <option value="+965" {{ old('landline_country_code') == '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                        <option value="+996" {{ old('landline_country_code') == '+996' ? 'selected' : '' }}>🇰🇬 +996</option>
                                        <option value="+856" {{ old('landline_country_code') == '+856' ? 'selected' : '' }}>🇱🇦 +856</option>
                                        <option value="+371" {{ old('landline_country_code') == '+371' ? 'selected' : '' }}>🇱🇻 +371</option>
                                        <option value="+961" {{ old('landline_country_code') == '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                        <option value="+266" {{ old('landline_country_code') == '+266' ? 'selected' : '' }}>🇱🇸 +266</option>
                                        <option value="+231" {{ old('landline_country_code') == '+231' ? 'selected' : '' }}>🇱🇷 +231</option>
                                        <option value="+218" {{ old('landline_country_code') == '+218' ? 'selected' : '' }}>🇱🇾 +218</option>
                                        <option value="+423" {{ old('landline_country_code') == '+423' ? 'selected' : '' }}>🇱🇮 +423</option>
                                        <option value="+370" {{ old('landline_country_code') == '+370' ? 'selected' : '' }}>🇱🇹 +370</option>
                                        <option value="+352" {{ old('landline_country_code') == '+352' ? 'selected' : '' }}>🇱🇺 +352</option>
                                        <option value="+853" {{ old('landline_country_code') == '+853' ? 'selected' : '' }}>🇲🇴 +853</option>
                                        <option value="+389" {{ old('landline_country_code') == '+389' ? 'selected' : '' }}>🇲🇰 +389</option>
                                        <option value="+261" {{ old('landline_country_code') == '+261' ? 'selected' : '' }}>🇲🇬 +261</option>
                                        <option value="+265" {{ old('landline_country_code') == '+265' ? 'selected' : '' }}>🇲🇼 +265</option>
                                        <option value="+60" {{ old('landline_country_code') == '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                        <option value="+960" {{ old('landline_country_code') == '+960' ? 'selected' : '' }}>🇲🇻 +960</option>
                                        <option value="+223" {{ old('landline_country_code') == '+223' ? 'selected' : '' }}>🇲🇱 +223</option>
                                        <option value="+356" {{ old('landline_country_code') == '+356' ? 'selected' : '' }}>🇲🇹 +356</option>
                                        <option value="+692" {{ old('landline_country_code') == '+692' ? 'selected' : '' }}>🇲🇭 +692</option>
                                        <option value="+596" {{ old('landline_country_code') == '+596' ? 'selected' : '' }}>🇲🇶 +596</option>
                                        <option value="+222" {{ old('landline_country_code') == '+222' ? 'selected' : '' }}>🇲🇷 +222</option>
                                        <option value="+230" {{ old('landline_country_code') == '+230' ? 'selected' : '' }}>🇲🇺 +230</option>
                                        <option value="+262" {{ old('landline_country_code') == '+262' ? 'selected' : '' }}>🇾🇹 +262</option>
                                        <option value="+52" {{ old('landline_country_code') == '+52' ? 'selected' : '' }}>🇲🇽 +52</option>
                                        <option value="+691" {{ old('landline_country_code') == '+691' ? 'selected' : '' }}>🇫🇲 +691</option>
                                        <option value="+373" {{ old('landline_country_code') == '+373' ? 'selected' : '' }}>🇲🇩 +373</option>
                                        <option value="+377" {{ old('landline_country_code') == '+377' ? 'selected' : '' }}>🇲🇨 +377</option>
                                        <option value="+976" {{ old('landline_country_code') == '+976' ? 'selected' : '' }}>🇲🇳 +976</option>
                                        <option value="+382" {{ old('landline_country_code') == '+382' ? 'selected' : '' }}>🇲🇪 +382</option>
                                        <option value="+1664" {{ old('landline_country_code') == '+1664' ? 'selected' : '' }}>🇲🇸 +1664</option>
                                        <option value="+212" {{ old('landline_country_code') == '+212' ? 'selected' : '' }}>🇲🇦 +212</option>
                                        <option value="+258" {{ old('landline_country_code') == '+258' ? 'selected' : '' }}>🇲🇿 +258</option>
                                        <option value="+95" {{ old('landline_country_code') == '+95' ? 'selected' : '' }}>🇲🇲 +95</option>
                                        <option value="+264" {{ old('landline_country_code') == '+264' ? 'selected' : '' }}>🇳🇦 +264</option>
                                        <option value="+674" {{ old('landline_country_code') == '+674' ? 'selected' : '' }}>🇳🇷 +674</option>
                                        <option value="+977" {{ old('landline_country_code') == '+977' ? 'selected' : '' }}>🇳🇵 +977</option>
                                        <option value="+31" {{ old('landline_country_code') == '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                        <option value="+687" {{ old('landline_country_code') == '+687' ? 'selected' : '' }}>🇳🇨 +687</option>
                                        <option value="+64" {{ old('landline_country_code') == '+64' ? 'selected' : '' }}>🇳🇿 +64</option>
                                        <option value="+505" {{ old('landline_country_code') == '+505' ? 'selected' : '' }}>🇳🇮 +505</option>
                                        <option value="+227" {{ old('landline_country_code') == '+227' ? 'selected' : '' }}>🇳🇪 +227</option>
                                        <option value="+234" {{ old('landline_country_code') == '+234' ? 'selected' : '' }}>🇳🇬 +234</option>
                                        <option value="+683" {{ old('landline_country_code') == '+683' ? 'selected' : '' }}>🇳🇺 +683</option>
                                        <option value="+672" {{ old('landline_country_code') == '+672' ? 'selected' : '' }}>🇳🇫 +672</option>
                                        <option value="+1670" {{ old('landline_country_code') == '+1670' ? 'selected' : '' }}>🇲🇵 +1670</option>
                                        <option value="+47" {{ old('landline_country_code') == '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                        <option value="+968" {{ old('landline_country_code') == '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                        <option value="+92" {{ old('landline_country_code') == '+92' ? 'selected' : '' }}>🇵🇰 +92</option>
                                        <option value="+680" {{ old('landline_country_code') == '+680' ? 'selected' : '' }}>🇵🇼 +680</option>
                                        <option value="+970" {{ old('landline_country_code') == '+970' ? 'selected' : '' }}>🇵🇸 +970</option>
                                        <option value="+507" {{ old('landline_country_code') == '+507' ? 'selected' : '' }}>🇵🇦 +507</option>
                                        <option value="+675" {{ old('landline_country_code') == '+675' ? 'selected' : '' }}>🇵🇬 +675</option>
                                        <option value="+595" {{ old('landline_country_code') == '+595' ? 'selected' : '' }}>🇵🇾 +595</option>
                                        <option value="+51" {{ old('landline_country_code') == '+51' ? 'selected' : '' }}>🇵🇪 +51</option>
                                        <option value="+63" {{ old('landline_country_code') == '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                        <option value="+48" {{ old('landline_country_code') == '+48' ? 'selected' : '' }}>🇵🇱 +48</option>
                                        <option value="+351" {{ old('landline_country_code') == '+351' ? 'selected' : '' }}>🇵🇹 +351</option>
                                        <option value="+1787" {{ old('landline_country_code') == '+1787' ? 'selected' : '' }}>🇵🇷 +1787</option>
                                        <option value="+974" {{ old('landline_country_code') == '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                        <option value="+262" {{ old('landline_country_code') == '+262' ? 'selected' : '' }}>🇷🇪 +262</option>
                                        <option value="+40" {{ old('landline_country_code') == '+40' ? 'selected' : '' }}>🇷🇴 +40</option>
                                        <option value="+7" {{ old('landline_country_code') == '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                        <option value="+250" {{ old('landline_country_code') == '+250' ? 'selected' : '' }}>🇷🇼 +250</option>
                                        <option value="+590" {{ old('landline_country_code') == '+590' ? 'selected' : '' }}>🇧🇱 +590</option>
                                        <option value="+290" {{ old('landline_country_code') == '+290' ? 'selected' : '' }}>🇸🇭 +290</option>
                                        <option value="+1869" {{ old('landline_country_code') == '+1869' ? 'selected' : '' }}>🇰🇳 +1869</option>
                                        <option value="+1758" {{ old('landline_country_code') == '+1758' ? 'selected' : '' }}>🇱🇨 +1758</option>
                                        <option value="+590" {{ old('landline_country_code') == '+590' ? 'selected' : '' }}>🇲🇫 +590</option>
                                        <option value="+508" {{ old('landline_country_code') == '+508' ? 'selected' : '' }}>🇵🇲 +508</option>
                                        <option value="+1784" {{ old('landline_country_code') == '+1784' ? 'selected' : '' }}>🇻🇨 +1784</option>
                                        <option value="+685" {{ old('landline_country_code') == '+685' ? 'selected' : '' }}>🇼🇸 +685</option>
                                        <option value="+378" {{ old('landline_country_code') == '+378' ? 'selected' : '' }}>🇸🇲 +378</option>
                                        <option value="+239" {{ old('landline_country_code') == '+239' ? 'selected' : '' }}>🇸🇹 +239</option>
                                        <option value="+966" {{ old('landline_country_code') == '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                        <option value="+221" {{ old('landline_country_code') == '+221' ? 'selected' : '' }}>🇸🇳 +221</option>
                                        <option value="+381" {{ old('landline_country_code') == '+381' ? 'selected' : '' }}>🇷🇸 +381</option>
                                        <option value="+248" {{ old('landline_country_code') == '+248' ? 'selected' : '' }}>🇸🇨 +248</option>
                                        <option value="+232" {{ old('landline_country_code') == '+232' ? 'selected' : '' }}>🇸🇱 +232</option>
                                        <option value="+65" {{ old('landline_country_code') == '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                        <option value="+1721" {{ old('landline_country_code') == '+1721' ? 'selected' : '' }}>🇸🇽 +1721</option>
                                        <option value="+421" {{ old('landline_country_code') == '+421' ? 'selected' : '' }}>🇸🇰 +421</option>
                                        <option value="+386" {{ old('landline_country_code') == '+386' ? 'selected' : '' }}>🇸🇮 +386</option>
                                        <option value="+677" {{ old('landline_country_code') == '+677' ? 'selected' : '' }}>🇸🇧 +677</option>
                                        <option value="+252" {{ old('landline_country_code') == '+252' ? 'selected' : '' }}>🇸🇴 +252</option>
                                        <option value="+27" {{ old('landline_country_code') == '+27' ? 'selected' : '' }}>🇿🇦 +27</option>
                                        <option value="+500" {{ old('landline_country_code') == '+500' ? 'selected' : '' }}>🇬🇸 +500</option>
                                        <option value="+211" {{ old('landline_country_code') == '+211' ? 'selected' : '' }}>🇸🇸 +211</option>
                                        <option value="+34" {{ old('landline_country_code') == '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                        <option value="+94" {{ old('landline_country_code') == '+94' ? 'selected' : '' }}>🇱🇰 +94</option>
                                        <option value="+249" {{ old('landline_country_code') == '+249' ? 'selected' : '' }}>🇸🇩 +249</option>
                                        <option value="+597" {{ old('landline_country_code') == '+597' ? 'selected' : '' }}>🇸🇷 +597</option>
                                        <option value="+47" {{ old('landline_country_code') == '+47' ? 'selected' : '' }}>🇸🇯 +47</option>
                                        <option value="+46" {{ old('landline_country_code') == '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                        <option value="+41" {{ old('landline_country_code') == '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                        <option value="+963" {{ old('landline_country_code') == '+963' ? 'selected' : '' }}>🇸🇾 +963</option>
                                        <option value="+886" {{ old('landline_country_code') == '+886' ? 'selected' : '' }}>🇹🇼 +886</option>
                                        <option value="+992" {{ old('landline_country_code') == '+992' ? 'selected' : '' }}>🇹🇯 +992</option>
                                        <option value="+255" {{ old('landline_country_code') == '+255' ? 'selected' : '' }}>🇹🇿 +255</option>
                                        <option value="+66" {{ old('landline_country_code') == '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                        <option value="+670" {{ old('landline_country_code') == '+670' ? 'selected' : '' }}>🇹🇱 +670</option>
                                        <option value="+228" {{ old('landline_country_code') == '+228' ? 'selected' : '' }}>🇹🇬 +228</option>
                                        <option value="+690" {{ old('landline_country_code') == '+690' ? 'selected' : '' }}>🇹🇰 +690</option>
                                        <option value="+676" {{ old('landline_country_code') == '+676' ? 'selected' : '' }}>🇹🇴 +676</option>
                                        <option value="+1868" {{ old('landline_country_code') == '+1868' ? 'selected' : '' }}>🇹🇹 +1868</option>
                                        <option value="+216" {{ old('landline_country_code') == '+216' ? 'selected' : '' }}>🇹🇳 +216</option>
                                        <option value="+90" {{ old('landline_country_code') == '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                        <option value="+993" {{ old('landline_country_code') == '+993' ? 'selected' : '' }}>🇹🇲 +993</option>
                                        <option value="+1649" {{ old('landline_country_code') == '+1649' ? 'selected' : '' }}>🇹🇨 +1649</option>
                                        <option value="+688" {{ old('landline_country_code') == '+688' ? 'selected' : '' }}>🇹🇻 +688</option>
                                        <option value="+256" {{ old('landline_country_code') == '+256' ? 'selected' : '' }}>🇺🇬 +256</option>
                                        <option value="+380" {{ old('landline_country_code') == '+380' ? 'selected' : '' }}>🇺🇦 +380</option>
                                        <option value="+1" {{ old('landline_country_code') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                        <option value="+598" {{ old('landline_country_code') == '+598' ? 'selected' : '' }}>🇺🇾 +598</option>
                                        <option value="+998" {{ old('landline_country_code') == '+998' ? 'selected' : '' }}>🇺🇿 +998</option>
                                        <option value="+678" {{ old('landline_country_code') == '+678' ? 'selected' : '' }}>🇻🇺 +678</option>
                                        <option value="+39" {{ old('landline_country_code') == '+39' ? 'selected' : '' }}>🇻🇦 +39</option>
                                        <option value="+58" {{ old('landline_country_code') == '+58' ? 'selected' : '' }}>🇻🇪 +58</option>
                                        <option value="+84" {{ old('landline_country_code') == '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                        <option value="+1284" {{ old('landline_country_code') == '+1284' ? 'selected' : '' }}>🇻🇬 +1284</option>
                                        <option value="+1340" {{ old('landline_country_code') == '+1340' ? 'selected' : '' }}>🇻🇮 +1340</option>
                                        <option value="+681" {{ old('landline_country_code') == '+681' ? 'selected' : '' }}>🇼🇫 +681</option>
                                        <option value="+212" {{ old('landline_country_code') == '+212' ? 'selected' : '' }}>🇪🇭 +212</option>
                                        <option value="+967" {{ old('landline_country_code') == '+967' ? 'selected' : '' }}>🇾🇪 +967</option>
                                        <option value="+260" {{ old('landline_country_code') == '+260' ? 'selected' : '' }}>🇿🇲 +260</option>
                                        <option value="+263" {{ old('landline_country_code') == '+263' ? 'selected' : '' }}>🇿🇼 +263</option>
                                    </select>
                                    <input type="tel" name="landline" id="landline"
                                           value="{{ old('landline') }}"
                                           placeholder="4 123 4567"
                                           class="flex-1 px-4 py-3 bg-slate-700 border border-slate-600 border-l-0 rounded-r-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('landline') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                </div>
                                @error('landline')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                    </div>
                </div>

                        </div>
                    </div>

                <!-- Step 3: Project -->
                <div class="step-content" data-step="3">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Project Requirements</h2>
                    
                    <div class="space-y-6">
                        <!-- 1st Row: Project Type and Project Title -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Project Type -->
                        <div>
                                <label for="project_type" class="block text-sm font-medium text-slate-300 mb-2">
                                    Project Type *
                            </label>
                                <select name="project_type" id="project_type" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('project_type') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Project Type</option>
                                    <option value="residential_villa" {{ old('project_type') == 'residential_villa' ? 'selected' : '' }}>Residential Villa</option>
                                    <option value="commercial_retail" {{ old('project_type') == 'commercial_retail' ? 'selected' : '' }}>Commercial Retail</option>
                                    <option value="industrial_warehouse" {{ old('project_type') == 'industrial_warehouse' ? 'selected' : '' }}>Industrial Warehouse</option>
                                    <option value="fitout_renovation" {{ old('project_type') == 'fitout_renovation' ? 'selected' : '' }}>Fit-out Renovation</option>
                                    <option value="maintenance" {{ old('project_type') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="others" {{ old('project_type') == 'others' ? 'selected' : '' }}>Others</option>
                                </select>
                                @error('project_type')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- Project Title -->
                        <div>
                                <label for="project_title" class="block text-sm font-medium text-slate-300 mb-2">
                                    Project Title *
                            </label>
                                <input type="text" name="project_title" id="project_title" required
                                       value="{{ old('project_title') }}"
                                       placeholder="Enter project title"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('project_title') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('project_title')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>

                        <!-- 2nd Row: Service Needed and Timeline -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Service Needed -->
                        <div>
                                <label for="service_needed" class="block text-sm font-medium text-slate-300 mb-2">
                                    Service Needed *
                            </label>
                                <select name="service_needed" id="service_needed" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('service_needed') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Service Needed</option>
                                    <option value="design_approval" {{ old('service_needed') == 'design_approval' ? 'selected' : '' }}>Design Approval</option>
                                    <option value="civil_construction" {{ old('service_needed') == 'civil_construction' ? 'selected' : '' }}>Civil Construction</option>
                                    <option value="mep_works" {{ old('service_needed') == 'mep_works' ? 'selected' : '' }}>MEP Works</option>
                                    <option value="interior_joinery" {{ old('service_needed') == 'interior_joinery' ? 'selected' : '' }}>Interior and Joinery</option>
                                    <option value="landscaping" {{ old('service_needed') == 'landscaping' ? 'selected' : '' }}>Landscaping</option>
                                    <option value="maintenance_amc" {{ old('service_needed') == 'maintenance_amc' ? 'selected' : '' }}>Maintenance AMC</option>
                            </select>
                                @error('service_needed')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- Timeline -->
                        <div>
                                <label for="timeline" class="block text-sm font-medium text-slate-300 mb-2">
                                    Timeline *
                            </label>
                                <select name="timeline" id="timeline" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('timeline') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Timeline</option>
                                    <option value="urgent" {{ old('timeline') == 'urgent' ? 'selected' : '' }}>Urgent (Within 1 Month)</option>
                                    <option value="1_3_months" {{ old('timeline') == '1_3_months' ? 'selected' : '' }}>1-3 Months</option>
                                    <option value="3_6_months" {{ old('timeline') == '3_6_months' ? 'selected' : '' }}>3-6 Months</option>
                                    <option value="6_12_months" {{ old('timeline') == '6_12_months' ? 'selected' : '' }}>6-12 Months</option>
                                    <option value="over_12_months" {{ old('timeline') == 'over_12_months' ? 'selected' : '' }}>Over 12 Months</option>
                                    <option value="flexible" {{ old('timeline') == 'flexible' ? 'selected' : '' }}>Flexible</option>
                                </select>
                                @error('timeline')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                    </div>
                </div>

                        <!-- 3rd Row: Estimated Budget and Project Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Estimated Budget -->
                        <div>
                                <label for="estimated_budget" class="block text-sm font-medium text-slate-300 mb-2">
                                    Estimated Budget *
                            </label>
                                <select name="estimated_budget" id="estimated_budget" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('estimated_budget') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Budget Range</option>
                                    <option value="under_50k" {{ old('estimated_budget') == 'under_50k' ? 'selected' : '' }}>Under AED 50,000</option>
                                    <option value="50k_100k" {{ old('estimated_budget') == '50k_100k' ? 'selected' : '' }}>AED 50,000 - 100,000</option>
                                    <option value="100k_250k" {{ old('estimated_budget') == '100k_250k' ? 'selected' : '' }}>AED 100,000 - 250,000</option>
                                    <option value="250k_500k" {{ old('estimated_budget') == '250k_500k' ? 'selected' : '' }}>AED 250,000 - 500,000</option>
                                    <option value="500k_1m" {{ old('estimated_budget') == '500k_1m' ? 'selected' : '' }}>AED 500,000 - 1,000,000</option>
                                    <option value="1m_5m" {{ old('estimated_budget') == '1m_5m' ? 'selected' : '' }}>AED 1,000,000 - 5,000,000</option>
                                    <option value="over_5m" {{ old('estimated_budget') == 'over_5m' ? 'selected' : '' }}>Over AED 5,000,000</option>
                                </select>
                                @error('estimated_budget')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- Project Location -->
                        <div>
                                <label for="project_location" class="block text-sm font-medium text-slate-300 mb-2">
                                    Project Location *
                            </label>
                                <input type="text" name="project_location" id="project_location" required
                                       value="{{ old('project_location') }}"
                                       placeholder="Enter project location"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('project_location') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('project_location')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>

                        <!-- 4th Row: Project Brief -->
                        <div>
                            <label for="project_brief" class="block text-sm font-medium text-slate-300 mb-2">
                                Project Brief *
                            </label>
                            <textarea name="project_brief" id="project_brief" rows="4" required
                                      placeholder="Please describe your project requirements, goals, and any specific details..."
                                      class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('project_brief') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">{{ old('project_brief') }}</textarea>
                            @error('project_brief')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Step 4: Attachments -->
                <div class="step-content" data-step="4">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Attachments</h2>
                    
                    <div class="space-y-6">
                        <!-- 1st Row: Trade License and VAT Certificate -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Trade License -->
                            <div>
                                <label for="trade_license_step4" class="block text-sm font-medium text-slate-300 mb-2">
                                    Trade License *
                                </label>
                                <input type="file" name="trade_license_step4" id="trade_license_step4" required accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:text-white file:bg-orange-500 hover:file:bg-orange-600 @error('trade_license_step4') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG (max 5MB)</p>
                                @error('trade_license_step4')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                        </div>

                            <!-- VAT Certificate -->
                            <div>
                                <label for="vat_certificate_step4" class="block text-sm font-medium text-slate-300 mb-2">
                                    VAT Certificate *
                                </label>
                                <input type="file" name="vat_certificate_step4" id="vat_certificate_step4" required accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:text-white file:bg-orange-500 hover:file:bg-orange-600 @error('vat_certificate_step4') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG (max 5MB)</p>
                                @error('vat_certificate_step4')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                    </div>

                        <!-- 2nd Row: Drawings and BOQ -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Drawings -->
                        <div>
                                <label for="drawings_step4" class="block text-sm font-medium text-slate-300 mb-2">
                                    Drawings
                            </label>
                                <input type="file" name="drawings_step4" id="drawings_step4" accept=".pdf,.jpg,.jpeg,.png,.dwg"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:text-white file:bg-orange-500 hover:file:bg-orange-600 @error('drawings_step4') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                            <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG, DWG (max 5MB)</p>
                                @error('drawings_step4')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                            <!-- BOQ -->
                        <div>
                                <label for="boq_step4" class="block text-sm font-medium text-slate-300 mb-2">
                                    BOQ (Bill of Quantities)
                            </label>
                                <input type="file" name="boq_step4" id="boq_step4" accept=".pdf,.xlsx,.xls,.doc,.docx"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:text-white file:bg-orange-500 hover:file:bg-orange-600 @error('boq_step4') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <p class="mt-1 text-xs text-slate-400">PDF, Excel, Word (max 5MB)</p>
                                @error('boq_step4')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Consents -->
                <div class="step-content" data-step="5">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Consents & Agreements</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-slate-700 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-slate-200 mb-4">Terms & Conditions</h4>
                        
                        <div class="space-y-4 text-sm">
                                <p class="text-slate-300">
                                By submitting this Client Registration Form, I hereby acknowledge and agree to the following terms:
                            </p>
                            
                                <div class="space-y-3 max-h-60 overflow-y-auto">
                                <div>
                                        <h5 class="font-bold mb-1" style="color: rgb(255,94,20);">1. Accuracy of Information</h5>
                                        <p class="text-slate-300">I affirm that all information provided in this application is true, accurate, and complete to the best of my knowledge.</p>
                                </div>
                                
                                <div>
                                        <h5 class="font-bold mb-1" style="color: rgb(255,94,20);">2. Verification & Due Diligence</h5>
                                        <p class="text-slate-300">I authorize the Company to verify any information provided, including conducting background, financial, or compliance checks as deemed necessary.</p>
                                </div>
                                
                                <div>
                                        <h5 class="font-bold mb-1" style="color: rgb(255,94,20);">3. Data Privacy & Protection</h5>
                                        <p class="text-slate-300">I consent to the collection, processing, and secure storage of my personal and business data in accordance with applicable data protection and privacy laws.</p>
                                    </div>
                                </div>
                            </div>
                                </div>
                                
                        <div class="flex items-start">
                            <input type="checkbox" id="terms" name="terms" required
                                   class="mt-1 h-4 w-4 text-teal-600 focus:ring-teal-500 border-slate-600 rounded bg-slate-700">
                            <label for="terms" class="ml-3 text-sm text-slate-300">
                                I have read and understood the above consent terms. I agree to the 
                                <a href="#" class="underline hover:opacity-80" style="color: rgb(255,94,20);">Terms of Service</a> 
                                and <a href="#" class="underline hover:opacity-80" style="color: rgb(255,94,20);">Privacy Policy</a>. 
                                I confirm that all information provided is accurate and complete. *
                            </label>
                        </div>
                    </div>
                                </div>
                                
                <!-- Step 6: Review -->
                <div class="step-content" data-step="6">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Review & Submit</h2>
                    
                    <div class="space-y-6">
                        <!-- Account Information Review -->
                        <div class="bg-slate-700 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-slate-200">Account Information</h4>
                                <button type="button" class="edit-section-btn px-3 py-1 text-sm rounded-md border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-colors duration-200" data-step="1">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Full Name:</span>
                                    <span class="text-slate-200 ml-2" id="review-name">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Email:</span>
                                    <span class="text-slate-200 ml-2" id="review-email">-</span>
                                </div>
                            </div>
                                </div>
                                
                        <!-- Client & Company Information Review -->
                        <div class="bg-slate-700 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-slate-200">Client & Company Information</h4>
                                <button type="button" class="edit-section-btn px-3 py-1 text-sm rounded-md border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-colors duration-200" data-step="2">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Client Type:</span>
                                    <span class="text-slate-200 ml-2" id="review-client-type">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Company Name:</span>
                                    <span class="text-slate-200 ml-2" id="review-company-name">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Email Address:</span>
                                    <span class="text-slate-200 ml-2" id="review-email-address">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Website:</span>
                                    <span class="text-slate-200 ml-2" id="review-website">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Mobile Number:</span>
                                    <span class="text-slate-200 ml-2" id="review-mobile">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Landline Number:</span>
                                    <span class="text-slate-200 ml-2" id="review-landline">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Street Address:</span>
                                    <span class="text-slate-200 ml-2" id="review-street">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Emirates:</span>
                                    <span class="text-slate-200 ml-2" id="review-emirates">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Country:</span>
                                    <span class="text-slate-200 ml-2" id="review-country">-</span>
                                </div>
                            </div>
                                </div>
                                
                        <!-- Project Requirements Review -->
                        <div class="bg-slate-700 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-slate-200">Project Requirements</h4>
                                <button type="button" class="edit-section-btn px-3 py-1 text-sm rounded-md border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-colors duration-200" data-step="3">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Project Type:</span>
                                    <span class="text-slate-200 ml-2" id="review-project-type">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Project Title:</span>
                                    <span class="text-slate-200 ml-2" id="review-project-title">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Service Needed:</span>
                                    <span class="text-slate-200 ml-2" id="review-service-needed">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Timeline:</span>
                                    <span class="text-slate-200 ml-2" id="review-timeline">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Estimated Budget:</span>
                                    <span class="text-slate-200 ml-2" id="review-budget">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Project Location:</span>
                                    <span class="text-slate-200 ml-2" id="review-project-location">-</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-slate-400">Project Brief:</span>
                                <p class="text-slate-200 mt-2" id="review-project-brief">-</p>
                            </div>
                                </div>
                                
                        <!-- Attachments Review -->
                        <div class="bg-slate-700 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-slate-200">Attachments</h4>
                                <button type="button" class="edit-section-btn px-3 py-1 text-sm rounded-md border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-colors duration-200" data-step="4">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Trade License:</span>
                                    <span class="text-slate-200 ml-2" id="review-trade-license">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">VAT Certificate:</span>
                                    <span class="text-slate-200 ml-2" id="review-vat-certificate">-</span>
                            </div>
                                <div>
                                    <span class="text-slate-400">Drawings:</span>
                                    <span class="text-slate-200 ml-2" id="review-drawings">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">BOQ:</span>
                                    <span class="text-slate-200 ml-2" id="review-boq">-</span>
                                </div>
                        </div>
                    </div>

                        <!-- Consents Review -->
                        <div class="bg-slate-700 rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-semibold text-slate-200">Consents & Agreements</h4>
                                <button type="button" class="edit-section-btn px-3 py-1 text-sm rounded-md border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white transition-colors duration-200" data-step="5">
                                    Edit
                                </button>
                            </div>
                            <div class="text-sm">
                                <div class="flex items-center">
                                    <span class="text-slate-400">Terms & Conditions:</span>
                                    <span class="text-green-400 ml-2" id="review-terms">
                                        <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Accepted
                                    </span>
                                </div>
                            </div>
                    </div>

                        <!-- Final Status -->
                        <div class="bg-green-900/20 border border-green-500/30 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-green-400">Ready to Submit</h3>
                                    <p class="text-green-300">Please review all information above and submit your registration.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between mt-8">
                    <button type="button" id="prev-btn" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200 opacity-50 cursor-not-allowed" disabled>
                        Previous
                    </button>
                    <button type="button" id="next-btn" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                        Next
                    </button>
                    <button type="submit" id="submit-btn" class="px-6 py-3 text-white rounded-lg transition-colors duration-200 hidden" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                        Submit Registration
                        </button>
                    </div>

                <!-- Help Section -->
                <div class="mt-6 text-center">
                    <p class="text-slate-400 text-sm">
                        Need help with your application? <a href="mailto:info@skylandconstruction.com" style="color: rgb(255,94,20);" onmouseover="this.style.color='rgb(255,120,50)'" onmouseout="this.style.color='rgb(255,94,20)'">Email our team</a> or call us at <a href="tel:+97172435757" style="color: rgb(255,94,20);" onmouseover="this.style.color='rgb(255,120,50)'" onmouseout="this.style.color='rgb(255,94,20)'">+971 7243 5757</a>
                    </p>
                </div>
            </form>
        </div>
        </div>

    <!-- Success Modal -->
    <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-slate-800 rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
            <div class="p-6">
                <!-- Success Icon -->
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full" style="background-color: rgba(34, 197, 94, 0.1);">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
        </div>

                <!-- Modal Content -->
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-white mb-2">Registration Submitted Successfully!</h3>
                    <p class="text-slate-300 mb-6">Thank you for registering with <span style="color: rgb(255,94,20);">SKY LAND CONSTRUCTION LLC OPC</span>. Your registration has been successfully submitted and is currently under review.</p>
                    
                    <div class="bg-slate-700 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h4 class="text-sm font-semibold text-slate-200">What's Next?</h4>
    </div>
                        <ul class="text-sm text-slate-400 space-y-2">
                            <li class="flex items-center">
                                <span class="w-2 h-2 rounded-full mr-3" style="background-color: rgb(255,94,20);"></span>
                                Our team will review your application within 24-48 hours
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 rounded-full mr-3" style="background-color: rgb(255,94,20);"></span>
                                You'll receive an email confirmation with next steps
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 rounded-full mr-3" style="background-color: rgb(255,94,20);"></span>
                                Access to client portal will be activated upon approval
                            </li>
                        </ul>
</div>

                    <!-- Action Button -->
                    <button type="button" onclick="closeSuccessModal()" class="w-full px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                        Continue
                    </button>
                </div>
            </div>
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
    background-color: rgb(255,94,20);
}

/* Custom styling for file input buttons */
input[type="file"]::file-selector-button {
    background-color: rgb(255,94,20) !important;
    border: none !important;
    color: white !important;
    padding: 8px 16px !important;
    border-radius: 9999px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    margin-right: 16px !important;
    cursor: pointer !important;
    transition: background-color 0.2s ease !important;
}

input[type="file"]::file-selector-button:hover {
    background-color: rgb(234,88,12) !important;
}

/* Firefox support */
input[type="file"]::-moz-file-upload-button {
    background-color: rgb(255,94,20) !important;
    border: none !important;
    color: white !important;
    padding: 8px 16px !important;
    border-radius: 9999px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    margin-right: 16px !important;
    cursor: pointer !important;
}

/* WebKit support */
input[type="file"]::-webkit-file-upload-button {
    background-color: rgb(255,94,20) !important;
    border: none !important;
    color: white !important;
    padding: 8px 16px !important;
    border-radius: 9999px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    margin-right: 16px !important;
    cursor: pointer !important;
    transition: background-color 0.2s ease !important;
}

input[type="file"]::-webkit-file-upload-button:hover {
    background-color: rgb(234,88,12) !important;
}

/* Step animations */
.step-content {
    display: none;
    opacity: 0;
    transform: translateX(20px);
    transition: all 0.3s ease-in-out;
}

.step-content.active {
    display: block;
    opacity: 1;
    transform: translateX(0);
}

.step-content.slide-out-left {
    transform: translateX(-20px);
    opacity: 0;
}

.step-content.slide-in-right {
    transform: translateX(20px);
    opacity: 0;
}

/* Progress animations */
.step-circle.completed {
    background-color: rgb(255,94,20) !important;
    color: white !important;
    transform: scale(1.1);
}

.step-circle.active {
    background-color: rgb(255,94,20) !important;
    color: white !important;
    border: 2px solid rgb(255,120,50);
    box-shadow: 0 0 0 4px rgba(255,94,20, 0.2);
}

.step-connector.completed {
    background-color: rgb(255,94,20) !important;
}

.step-label.completed {
    color: rgb(255,94,20) !important;
}

.step-label.active {
    color: rgb(255,120,50) !important;
}

/* Custom logo styles */
.object-contain {
    object-fit: contain;
}

.w-16 {
    width: 14rem;
}

/* 3D Background Effects */
.page-3d-background {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #1e293b 75%, #0f172a 100%);
    position: relative;
    overflow: hidden;
}

.page-3d-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 94, 20, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 120, 50, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
}

.page-3d-background::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(45deg, rgba(255, 255, 255, 0.02) 25%, transparent 25%),
        linear-gradient(-45deg, rgba(255, 255, 255, 0.02) 25%, transparent 25%),
        linear-gradient(45deg, transparent 75%, rgba(255, 255, 255, 0.02) 75%),
        linear-gradient(-45deg, transparent 75%, rgba(255, 255, 255, 0.02) 75%);
    background-size: 60px 60px;
    background-position: 0 0, 0 30px, 30px -30px, -30px 0px;
    pointer-events: none;
    z-index: 0;
    opacity: 0.3;
}

/* Form 3D Container Effects */
.form-3d-container {
    position: relative;
    background: linear-gradient(145deg, #1e293b, #0f172a);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.8),
        0 0 0 1px rgba(255, 255, 255, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.1),
        inset 0 -1px 0 rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    transform: perspective(1000px) rotateX(2deg);
    transition: all 0.3s ease;
    z-index: 1;
}

.form-3d-container::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, 
        rgba(255, 94, 20, 0.2) 0%, 
        rgba(59, 130, 246, 0.1) 25%, 
        rgba(16, 185, 129, 0.1) 50%, 
        rgba(139, 92, 246, 0.1) 75%, 
        rgba(255, 94, 20, 0.2) 100%);
    border-radius: inherit;
    z-index: -1;
    opacity: 0.6;
    filter: blur(6px);
}

.form-3d-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 20%, rgba(255, 94, 20, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 80%, rgba(59, 130, 246, 0.08) 0%, transparent 50%);
    border-radius: inherit;
    pointer-events: none;
    z-index: 0;
}

.form-3d-container:hover {
    transform: perspective(1000px) rotateX(1deg) translateY(-5px);
    box-shadow: 
        0 35px 70px -12px rgba(0, 0, 0, 0.9),
        0 0 0 1px rgba(255, 255, 255, 0.08),
        inset 0 1px 0 rgba(255, 255, 255, 0.15),
        inset 0 -1px 0 rgba(0, 0, 0, 0.3);
}

/* Enhanced form styling */
.form-3d-container form {
    position: relative;
    z-index: 2;
}

/* 3D Input Effects */
.form-3d-container input[type="text"],
.form-3d-container input[type="email"],
.form-3d-container input[type="password"],
.form-3d-container input[type="tel"],
.form-3d-container input[type="url"],
.form-3d-container select,
.form-3d-container textarea {
    background: linear-gradient(145deg, #374151, #1f2937);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 
        inset 2px 2px 5px rgba(0, 0, 0, 0.3),
        inset -2px -2px 5px rgba(255, 255, 255, 0.02);
    transition: all 0.3s ease;
}

.form-3d-container input[type="text"]:focus,
.form-3d-container input[type="email"]:focus,
.form-3d-container input[type="password"]:focus,
.form-3d-container input[type="tel"]:focus,
.form-3d-container input[type="url"]:focus,
.form-3d-container select:focus,
.form-3d-container textarea:focus {
    background: linear-gradient(145deg, #4b5563, #374151);
    border-color: rgba(255, 94, 20, 0.5);
    box-shadow: 
        inset 2px 2px 5px rgba(0, 0, 0, 0.2),
        inset -2px -2px 5px rgba(255, 255, 255, 0.03),
        0 0 20px rgba(255, 94, 20, 0.2);
    transform: translateY(-1px);
}

/* 3D Button Effects */
.form-3d-container button {
    background: linear-gradient(145deg, rgb(255, 94, 20), rgb(230, 80, 15));
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 
        0 4px 15px rgba(255, 94, 20, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2),
        inset 0 -1px 0 rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    transform: translateY(0);
}

.form-3d-container button:hover {
    background: linear-gradient(145deg, rgb(230, 80, 15), rgb(255, 94, 20));
    box-shadow: 
        0 6px 20px rgba(255, 94, 20, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.3),
        inset 0 -1px 0 rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.form-3d-container button:active {
    transform: translateY(1px);
    box-shadow: 
        0 2px 10px rgba(255, 94, 20, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1),
        inset 0 -1px 0 rgba(0, 0, 0, 0.3);
}

/* Enhanced Progress Bar 3D Effect */
#progress-bar {
    box-shadow: 
        0 4px 15px rgba(255, 94, 20, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2),
        inset 0 -1px 0 rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 94, 20, 0.3);
}

/* Step Indicators 3D Effect */
.step-circle {
    box-shadow: 
        0 4px 10px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2),
        inset 0 -1px 0 rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.step-circle:hover {
    transform: translateY(-1px);
    box-shadow: 
        0 6px 15px rgba(0, 0, 0, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.3),
        inset 0 -1px 0 rgba(0, 0, 0, 0.3);
}

/* Validation Animation Effects */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
    20%, 40%, 60%, 80% { transform: translateX(5px); }
}

.validation-error-field {
    animation: fieldShake 0.3s ease-in-out;
}

@keyframes fieldShake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-3px); }
    75% { transform: translateX(3px); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 6;
    
    // Form persistence functionality
    const STORAGE_KEY = 'client_registration_form_data';
    const CURRENT_STEP_KEY = 'client_registration_current_step';
    
    // Save form data to localStorage
    function saveFormData() {
        const formData = {};
        const form = document.getElementById('wizard-form');
        
        if (!form) {
            console.error('Form element not found');
            return;
        }
        
        // Get all form inputs, selects, and textareas
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            if (input.type === 'checkbox' || input.type === 'radio') {
                formData[input.name] = input.checked;
            } else if (input.type === 'file') {
                // Don't save file inputs to localStorage (not possible)
                formData[input.name] = null;
            } else {
                formData[input.name] = input.value;
            }
        });
        
        localStorage.setItem(STORAGE_KEY, JSON.stringify(formData));
        localStorage.setItem(CURRENT_STEP_KEY, currentStep.toString());
        console.log('Form data saved to localStorage');
        
        // Show save indicator
        showSaveIndicator();
    }
    
    // Load form data from localStorage
    function loadFormData() {
        try {
            const savedData = localStorage.getItem(STORAGE_KEY);
            const savedStep = localStorage.getItem(CURRENT_STEP_KEY);
            
            if (savedData) {
                const formData = JSON.parse(savedData);
                const form = document.getElementById('wizard-form');
                
                if (!form) {
                    console.error('Form element not found during restore');
                    return;
                }
                
                // Restore form field values
                Object.keys(formData).forEach(fieldName => {
                    const field = form.querySelector(`[name="${fieldName}"]`);
                    if (field && formData[fieldName] !== null) {
                        if (field.type === 'checkbox' || field.type === 'radio') {
                            field.checked = formData[fieldName];
                        } else if (field.type !== 'file') {
                            field.value = formData[fieldName];
                        }
                    }
                });
                
                console.log('Form data restored from localStorage');
                
                // Show restore notification
                showRestoreNotification();
            }
            
            // Restore current step
            if (savedStep) {
                const stepNumber = parseInt(savedStep);
                if (stepNumber >= 1 && stepNumber <= totalSteps) {
                    currentStep = stepNumber;
                    
                    // Hide all step contents
                    const allSteps = document.querySelectorAll('.step-content');
                    allSteps.forEach(step => {
                        step.classList.remove('active');
                    });
                    
                    // Show current step content
                    const currentStepElement = document.querySelector(`.step-content[data-step="${currentStep}"]`);
                    if (currentStepElement) {
                        currentStepElement.classList.add('active');
                    }
                    
                    updateStepDisplay();
                    console.log(`Restored to step ${currentStep}`);
                }
            }
        } catch (error) {
            console.error('Error loading form data:', error);
        }
    }
    
    // Clear saved form data
    function clearSavedData() {
        localStorage.removeItem(STORAGE_KEY);
        localStorage.removeItem(CURRENT_STEP_KEY);
        console.log('Saved form data cleared');
    }
    
    // Auto-save form data on input changes
    function setupAutoSave() {
        const form = document.getElementById('wizard-form');
        
        if (!form) {
            console.error('Form element not found during auto-save setup');
            return;
        }
        
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            // Save data on input change
            input.addEventListener('input', saveFormData);
            input.addEventListener('change', saveFormData);
        });
        
        console.log('Auto-save setup complete');
    }
    
    // Show save indicator
    function showSaveIndicator() {
        // Remove existing indicator
        const existingIndicator = document.getElementById('save-indicator');
        if (existingIndicator) {
            existingIndicator.remove();
        }
        
        // Create new indicator
        const indicator = document.createElement('div');
        indicator.id = 'save-indicator';
        indicator.className = 'fixed top-4 right-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
        indicator.innerHTML = '✓ Data saved automatically';
        
        document.body.appendChild(indicator);
        
        // Fade out after 2 seconds
        setTimeout(() => {
            indicator.style.opacity = '0';
            setTimeout(() => {
                if (indicator.parentNode) {
                    indicator.parentNode.removeChild(indicator);
                }
            }, 300);
        }, 2000);
    }
    
    // Show restore notification
    function showRestoreNotification() {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 transition-all duration-300';
        notification.innerHTML = '🔄 Previous form data restored';
        
        document.body.appendChild(notification);
        
        // Fade out after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    
    console.log('=== INITIALIZING CLIENT FORM ===');
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit-btn');
    const progressBar = document.getElementById('progress-bar');
    
    console.log('Next button found:', nextBtn);
    console.log('Previous button found:', prevBtn);
    console.log('Submit button found:', submitBtn);
    console.log('Progress bar found:', progressBar);
    
    // Initialize form persistence
    loadFormData(); // Load saved data first
    setupAutoSave(); // Setup auto-save listeners
    
    // Initialize first step
    updateStepDisplay();
    
    nextBtn.addEventListener('click', function() {
        console.log('=== NEXT BUTTON CLICKED ===');
        console.log('Next button clicked, current step:', currentStep);
        console.log('Total steps:', totalSteps);
        console.log('Next button element:', nextBtn);
        
        const isValid = validateCurrentStep();
        console.log('Validation result:', isValid);
        
        if (isValid) {
            if (currentStep < totalSteps) {
                console.log('Moving to next step from', currentStep, 'to', currentStep + 1);
                saveFormData(); // Save current step data
                animateToNextStep();
            } else {
                console.log('Already at last step');
            }
        } else {
            console.log('Validation failed, staying on current step');
        }
    });
    
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
            saveFormData(); // Save current step data
            animateToPrevStep();
        }
    });
    
    function animateToNextStep() {
        const currentStepElement = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        const nextStepElement = document.querySelector(`.step-content[data-step="${currentStep + 1}"]`);
        
        // Animate current step out
        currentStepElement.classList.add('slide-out-left');
        
        setTimeout(() => {
            currentStepElement.classList.remove('active', 'slide-out-left');
            currentStep++;
            
            // Animate next step in
            nextStepElement.classList.add('slide-in-right');
            nextStepElement.classList.add('active');
            
            setTimeout(() => {
                nextStepElement.classList.remove('slide-in-right');
            }, 50);
            
            updateStepDisplay();
            saveFormData(); // Save after step change
        }, 150);
    }
    
    function animateToPrevStep() {
        const currentStepElement = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        const prevStepElement = document.querySelector(`.step-content[data-step="${currentStep - 1}"]`);
        
        // Animate current step out
        currentStepElement.classList.add('slide-in-right');
        
        setTimeout(() => {
            currentStepElement.classList.remove('active', 'slide-in-right');
            currentStep--;
            
            // Animate previous step in
            prevStepElement.classList.add('slide-out-left');
            prevStepElement.classList.add('active');
            
            setTimeout(() => {
                prevStepElement.classList.remove('slide-out-left');
            }, 50);
            
            updateStepDisplay();
            saveFormData(); // Save after step change
        }, 150);
    }
    
    function updateStepDisplay() {
        // Update progress bar
        const progressPercentage = (currentStep / totalSteps) * 100;
        progressBar.style.width = progressPercentage + '%';
        
        // Update progress percentage text
        const progressPercentageElement = document.getElementById('progress-percentage-text');
        progressPercentageElement.textContent = Math.round(progressPercentage) + '%';
        
        // Update step indicators
        for (let i = 1; i <= totalSteps; i++) {
            const stepIndicator = document.querySelector(`.step-indicator[data-step="${i}"]`);
            const stepCircle = stepIndicator.querySelector('.step-circle');
            const stepLabel = stepIndicator.querySelector('.step-label');
            const connector = document.querySelector(`.step-connector[data-connector="${i}"]`);
            
            // Remove all classes
            stepCircle.classList.remove('completed', 'active');
            stepLabel.classList.remove('completed', 'active');
            if (connector) {
                connector.classList.remove('completed');
            }
            
            if (i < currentStep) {
                // Completed steps
                stepCircle.classList.add('completed');
                stepLabel.classList.add('completed');
                if (connector) {
                    connector.classList.add('completed');
                }
            } else if (i === currentStep) {
                // Current step
                stepCircle.classList.add('active');
                stepLabel.classList.add('active');
            }
        }
        
        // Update navigation buttons
        if (currentStep === 1) {
            prevBtn.disabled = true;
            prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
            prevBtn.classList.remove('hover:bg-slate-500');
        } else {
            prevBtn.disabled = false;
            prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            prevBtn.classList.add('hover:bg-slate-500');
        }
        
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
        
        // If we're on the review step, populate the review data
        if (currentStep === 6) {
            populateReviewData();
        }
    }
    
    function populateReviewData() {
        console.log('=== POPULATING REVIEW DATA ===');
        
        // Account Information
        const nameField = document.getElementById('name');
        const emailField = document.getElementById('email');
        console.log('Name field:', nameField, 'Value:', nameField?.value);
        console.log('Email field:', emailField, 'Value:', emailField?.value);
        
        document.getElementById('review-name').textContent = nameField?.value || '-';
        document.getElementById('review-email').textContent = emailField?.value || '-';
        
        // Client & Company Information
        const clientTypeField = document.getElementById('client_type');
        const companyNameField = document.getElementById('company_name');
        const clientEmailField = document.getElementById('client_email');
        const websiteField = document.getElementById('website');
        
        console.log('Client Type field:', clientTypeField, 'Selected text:', getSelectText('client_type'));
        console.log('Company Name field:', companyNameField, 'Value:', companyNameField?.value);
        console.log('Client Email field:', clientEmailField, 'Value:', clientEmailField?.value);
        console.log('Website field:', websiteField, 'Value:', websiteField?.value);
        
        document.getElementById('review-client-type').textContent = getSelectText('client_type') || '-';
        document.getElementById('review-company-name').textContent = companyNameField?.value || '-';
        document.getElementById('review-email-address').textContent = clientEmailField?.value || '-';
        document.getElementById('review-website').textContent = websiteField?.value || '-';
        
        // Mobile and Landline with country codes
        const mobileCountryCode = getSelectText('mobile_country_code') || '';
        const mobileNumber = document.getElementById('phone')?.value || '';
        document.getElementById('review-mobile').textContent = mobileCountryCode && mobileNumber ? `${mobileCountryCode} ${mobileNumber}` : '-';
        
        const landlineCountryCode = getSelectText('landline_country_code') || '';
        const landlineNumber = document.getElementById('landline')?.value || '';
        document.getElementById('review-landline').textContent = landlineCountryCode && landlineNumber ? `${landlineCountryCode} ${landlineNumber}` : '-';
        
        document.getElementById('review-street').textContent = document.getElementById('street_address')?.value || '-';
        document.getElementById('review-emirates').textContent = getSelectText('emirate') || '-';
        document.getElementById('review-country').textContent = document.getElementById('country')?.value || '-';
        
        // Project Requirements
        document.getElementById('review-project-type').textContent = getSelectText('project_type') || '-';
        document.getElementById('review-project-title').textContent = document.getElementById('project_title')?.value || '-';
        document.getElementById('review-service-needed').textContent = getSelectText('service_needed') || '-';
        document.getElementById('review-timeline').textContent = getSelectText('timeline') || '-';
        document.getElementById('review-budget').textContent = getSelectText('estimated_budget') || '-';
        document.getElementById('review-project-location').textContent = document.getElementById('project_location')?.value || '-';
        document.getElementById('review-project-brief').textContent = document.getElementById('project_brief')?.value || '-';
        
        // Attachments
        document.getElementById('review-trade-license').textContent = getFileName('trade_license_step4') || 'Not uploaded';
        document.getElementById('review-vat-certificate').textContent = getFileName('vat_certificate_step4') || 'Not uploaded';
        document.getElementById('review-drawings').textContent = getFileName('drawings_step4') || 'Not uploaded';
        document.getElementById('review-boq').textContent = getFileName('boq_step4') || 'Not uploaded';
    }
    
    function getSelectText(selectId) {
        const select = document.getElementById(selectId);
        if (select && select.selectedIndex > 0) {
            return select.options[select.selectedIndex].text;
        }
        return '';
    }
    
    function getFileName(fileInputId) {
        const fileInput = document.getElementById(fileInputId);
        if (fileInput && fileInput.files.length > 0) {
            return fileInput.files[0].name;
        }
        return '';
    }
    
    function validateCurrentStep() {
        console.log(`Validating step ${currentStep}`);
        const currentStepElement = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        console.log('Current step element:', currentStepElement);
        
        if (!currentStepElement) {
            console.log('ERROR: No step element found');
            return false;
        }
        
        const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
        console.log(`Found ${requiredFields.length} required fields:`, requiredFields);
        
        let isValid = true;
        let firstInvalidField = null;
        let invalidFields = [];
        
        requiredFields.forEach((field, index) => {
            const fieldValue = field.value ? field.value.trim() : '';
            console.log(`Field ${index + 1}: ${field.name || field.id} (${field.type || field.tagName}) = "${fieldValue}"`);
            
            let fieldValid = true;
            
            // Special handling for select elements
            if (field.tagName.toLowerCase() === 'select') {
                if (!field.value || field.value === '') {
                    console.log(`❌ Select field ${field.name || field.id} is empty`);
                    fieldValid = false;
                } else {
                    console.log(`✅ Select field ${field.name || field.id} is valid`);
                }
            } else {
                // Handle input and textarea elements
                if (!fieldValue) {
                    console.log(`❌ Field ${field.name || field.id} is empty`);
                    fieldValid = false;
                } else {
                    console.log(`✅ Field ${field.name || field.id} is valid`);
                }
            }
            
            // Apply visual feedback and animations
            if (!fieldValid) {
                field.style.borderColor = 'rgb(239,68,68)';
                field.style.boxShadow = '0 0 0 1px rgb(239,68,68)';
                
                // Add shake animation to invalid field
                field.classList.add('validation-error-field');
                setTimeout(() => {
                    field.classList.remove('validation-error-field');
                }, 300);
                
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
                invalidFields.push(field.name || field.id);
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
                field.style.borderColor = '';
                field.style.boxShadow = '';
            }
            
            // Remove error styling after user starts interacting
            const eventType = field.tagName.toLowerCase() === 'select' ? 'change' : 'input';
            field.addEventListener(eventType, function() {
                this.classList.remove('border-red-500');
                this.style.borderColor = '';
                this.style.boxShadow = '';
            }, { once: true });
        });
        
        // Special validation for step 1 (password confirmation)
        if (currentStep === 1) {
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password_confirmation');
            
            if (password.value !== passwordConfirm.value) {
                passwordConfirm.classList.add('border-red-500');
                isValid = false;
            }
        }
        
        // Special validation for step 5 (terms checkbox)
        if (currentStep === 5) {
            const termsCheckbox = document.getElementById('terms');
            if (!termsCheckbox.checked) {
                termsCheckbox.classList.add('ring-2', 'ring-red-500');
                isValid = false;
            }
        }
        
        // If validation failed, add additional effects
        if (!isValid) {
            console.log(`Validation failed. Invalid fields: ${invalidFields.join(', ')}`);
            
            // Focus on the first invalid field
            if (firstInvalidField) {
                try {
                    firstInvalidField.focus();
                    console.log(`Focused on first invalid field: ${firstInvalidField.name || firstInvalidField.id}`);
                } catch (e) {
                    console.log('Could not focus field:', firstInvalidField.name, e.message);
                }
            }
            
            // Add shake animation to the form container
            const formContainer = document.querySelector('.form-3d-container');
            if (formContainer) {
                formContainer.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    formContainer.style.animation = '';
                }, 500);
            }
            
            // Show a temporary error message
            const existingError = document.getElementById('validation-error');
            if (existingError) {
                existingError.remove();
            }
            
            const errorDiv = document.createElement('div');
            errorDiv.id = 'validation-error';
            errorDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 transform transition-all duration-300';
            errorDiv.textContent = `Please fill in all required fields: ${invalidFields.join(', ')}`;
            document.body.appendChild(errorDiv);
            
            // Remove error message after 5 seconds
            setTimeout(() => {
                if (errorDiv && errorDiv.parentNode) {
                    errorDiv.style.opacity = '0';
                    errorDiv.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        errorDiv.remove();
                    }, 300);
                }
            }, 5000);
        }
        
        console.log(`=== VALIDATION SUMMARY ===`);
        console.log(`Step ${currentStep} validation result: ${isValid}`);
        console.log(`Required fields found: ${requiredFields.length}`);
        console.log(`Invalid fields: ${invalidFields.length}`);
        console.log(`========================`);
        return isValid;
    }
    
    
    // Edit section functionality
    document.querySelectorAll('.edit-section-btn').forEach(button => {
        button.addEventListener('click', function() {
            const targetStep = parseInt(this.getAttribute('data-step'));
            currentStep = targetStep;
            updateStepDisplay();
            
            // Scroll to top of form
            document.querySelector('.bg-slate-800').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        });
    });

    // Handle form submission
    document.getElementById('wizard-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        console.log('Form submission triggered via AJAX');
        
        // Validate final step before submitting
        if (currentStep === totalSteps && !validateCurrentStep()) {
            console.log('Final validation failed, preventing submission');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.getElementById('submit-btn');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Submitting...';
        submitBtn.disabled = true;
        
        // Prepare form data
        const formData = new FormData(this);
        
        // Send AJAX request
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            console.log('Form submitted successfully:', data);
            
            // Clear saved form data on successful submission
            const STORAGE_KEY = 'client_registration_form_data';
            const CURRENT_STEP_KEY = 'client_registration_current_step';
            localStorage.removeItem(STORAGE_KEY);
            localStorage.removeItem(CURRENT_STEP_KEY);
            console.log('Form data cleared');
            
            // Show success modal
            showSuccessModal();
        })
        .catch(error => {
            console.error('Form submission error:', error);
            
            // Reset button state
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
            
            // Show error message
            let errorMessage = 'There was an error submitting your registration. Please try again.';
            if (error.errors) {
                // Handle validation errors
                const firstError = Object.values(error.errors)[0];
                if (firstError && firstError[0]) {
                    errorMessage = firstError[0];
                }
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            // Show error notification
            const errorDiv = document.createElement('div');
            errorDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 max-w-md';
            errorDiv.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>${errorMessage}</span>
                </div>
            `;
            document.body.appendChild(errorDiv);
            
            // Remove error message after 5 seconds
            setTimeout(() => {
                if (errorDiv && errorDiv.parentNode) {
                    errorDiv.remove();
                }
            }, 5000);
        });
    });

});

// Password visibility toggle function
function togglePasswordVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    const svg = button.querySelector('svg');
    
    if (input.type === 'password') {
        input.type = 'text';
        // Change to eye-slash icon (hidden)
        svg.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m0 0l3.121-3.121M12 12l0 0m0 0l3.121 3.121M12 12l-3.121 3.121"></path>
        `;
    } else {
        input.type = 'password';
        // Change to eye icon (visible)
        svg.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
}

// Success modal functions
function showSuccessModal() {
    const modal = document.getElementById('success-modal');
    const modalContent = document.getElementById('modal-content');
    
    modal.classList.remove('hidden');
    
    // Trigger animation
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeSuccessModal() {
    const modal = document.getElementById('success-modal');
    const modalContent = document.getElementById('modal-content');
    
    // Animate out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        // Redirect to home page or refresh
        window.location.href = '/';
    }, 300);
}

// Close modal when clicking outside
document.getElementById('success-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuccessModal();
    }
});
</script>

@endsection
