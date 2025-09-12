@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 page-3d-background">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="w-16 h-16 flex items-center justify-center mr-4">
                <img src="{{ asset('images/logo-light-trimmed.webp') }}" alt="Sky Land Construction Logo" class="w-16 h-17 object-contain">
            </div>
            <div>
                <h1 class="text-2xl font-normal text-white" style="font-family: Teko, sans-serif;">Vendor Registration</h1>
                <p class="text-slate-400">Become a part of our trusted vendor network and unlock new business opportunities with <span style="color: rgb(255,94,20);">SKY LAND CONSTRUCTION LLC OPC</span>. Kindly complete the form below with accurate and up-to-date information.</p>
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
                    
                    <!-- Step 2 - Company -->
                    <div class="flex items-center step-indicator" data-step="2">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">2</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Company</span>
                    </div>
                    
                    <!-- Connector Line 2 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="2"></div>
                    
                    <!-- Step 3 - Bank Details -->
                    <div class="flex items-center step-indicator" data-step="3">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">3</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Bank Details</span>
                    </div>
                    
                    <!-- Connector Line 3 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="3"></div>
                    
                    <!-- Step 4 - Documents -->
                    <div class="flex items-center step-indicator" data-step="4">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">4</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Documents</span>
                    </div>
                    
                    <!-- Connector Line 4 -->
                    <div class="flex-1 h-1 step-connector bg-slate-600 mx-2 transition-all duration-500" data-connector="4"></div>
                    
                    <!-- Step 5 - Consent -->
                    <div class="flex items-center step-indicator" data-step="5">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">5</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Consent</span>
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
                <div id="progress-bar" class="h-6 rounded-full transition-all duration-500 relative overflow-hidden flex items-center justify-center" style="width: 20%; background: linear-gradient(to right, rgb(255,94,20), rgb(255,120,50));">
                    <span id="progress-percentage-text" class="text-xs font-bold text-white z-10">20%</span>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-3d-container bg-slate-800 rounded-lg shadow-xl">
            <form id="vendor-wizard-form" method="POST" action="{{ route('supplier.store') }}" enctype="multipart/form-data" class="p-8" novalidate>
                @csrf

                <!-- Step 1: Account Information -->
                <div class="step-content active" data-step="1">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Account Information</h2>

                    <div class="space-y-6">
                        <!-- 1st Row: Name and Email Address -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Name *
                                </label>
                                <input type="text" name="full_name" id="full_name" required
                                       value="{{ old('full_name') }}"
                                       placeholder="Enter your full name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('full_name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('full_name')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
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
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                    Password *
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" required
                                           placeholder="Enter your password"
                                           class="w-full px-4 py-3 pr-12 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('password') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center w-12 h-full text-slate-400 hover:text-white transition-colors duration-200" onclick="togglePassword('password')">
                                        <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">
                                    Confirm Password *
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                           placeholder="Confirm your password"
                                           class="w-full px-4 py-3 pr-12 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('password_confirmation') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <button type="button" class="absolute inset-y-0 right-0 flex items-center justify-center w-12 h-full text-slate-400 hover:text-white transition-colors duration-200" onclick="togglePassword('password_confirmation')">
                                        <svg id="password_confirmation-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-1" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200 opacity-50 cursor-not-allowed" disabled>
                            Previous
                        </button>
                        <button type="button" id="next-btn-1" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 2: Company Information -->
                <div class="step-content" data-step="2">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Company Information</h2>
                    
                    <div class="space-y-6">
                        <!-- 1st Row: Company Name and Business Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Company Name *
                                </label>
                                <input type="text" name="company_name" id="company_name" required
                                       value="{{ old('company_name') }}"
                                       placeholder="Enter company name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('company_name')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="business_type" class="block text-sm font-medium text-slate-300 mb-2">
                                    Business Type *
                                </label>
                                <select name="business_type" id="business_type" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 @error('business_type') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Business Type</option>
                                    <option value="building_material" {{ old('business_type') === 'building_material' ? 'selected' : '' }}>Building Material</option>
                                    <option value="sub_contractor" {{ old('business_type') === 'sub_contractor' ? 'selected' : '' }}>Sub Contractor</option>
                                    <option value="transport_rental" {{ old('business_type') === 'transport_rental' ? 'selected' : '' }}>Transport Rental</option>
                                </select>
                                @error('business_type')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 2nd Row: Contact Person and Designation -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_person" class="block text-sm font-medium text-slate-300 mb-2">
                                    Contact Person *
                                </label>
                                <input type="text" name="contact_person" id="contact_person" required
                                       value="{{ old('contact_person') }}"
                                       placeholder="Enter contact person name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('contact_person') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('contact_person')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="designation" class="block text-sm font-medium text-slate-300 mb-2">
                                    Designation *
                                </label>
                                <input type="text" name="designation" id="designation" required
                                       value="{{ old('designation') }}"
                                       placeholder="Enter designation"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('designation') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('designation')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 3rd Row: Mobile Number and Landline Number -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="mobile_number" class="block text-sm font-medium text-slate-300 mb-2">
                                    Mobile Number *
                                </label>
                                <div class="flex">
                                    <select name="mobile_country_code" 
                                            class="w-24 px-3 py-3 bg-slate-700 border border-r-0 border-slate-600 rounded-l-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 text-sm @error('mobile_number') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="+971" {{ old('mobile_country_code', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                        <option value="+1" {{ old('mobile_country_code') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                        <option value="+44" {{ old('mobile_country_code') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                        <option value="+91" {{ old('mobile_country_code') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                        <option value="+86" {{ old('mobile_country_code') === '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                        <option value="+33" {{ old('mobile_country_code') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                        <option value="+49" {{ old('mobile_country_code') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                        <option value="+81" {{ old('mobile_country_code') === '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                        <option value="+82" {{ old('mobile_country_code') === '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                        <option value="+61" {{ old('mobile_country_code') === '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                        <option value="+55" {{ old('mobile_country_code') === '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                        <option value="+7" {{ old('mobile_country_code') === '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                        <option value="+34" {{ old('mobile_country_code') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                        <option value="+39" {{ old('mobile_country_code') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                        <option value="+31" {{ old('mobile_country_code') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                        <option value="+41" {{ old('mobile_country_code') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                        <option value="+46" {{ old('mobile_country_code') === '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                        <option value="+47" {{ old('mobile_country_code') === '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                        <option value="+45" {{ old('mobile_country_code') === '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                        <option value="+90" {{ old('mobile_country_code') === '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                        <option value="+966" {{ old('mobile_country_code') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                        <option value="+965" {{ old('mobile_country_code') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                        <option value="+974" {{ old('mobile_country_code') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                        <option value="+973" {{ old('mobile_country_code') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                        <option value="+968" {{ old('mobile_country_code') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                        <option value="+962" {{ old('mobile_country_code') === '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                        <option value="+961" {{ old('mobile_country_code') === '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                        <option value="+20" {{ old('mobile_country_code') === '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                        <option value="+60" {{ old('mobile_country_code') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                        <option value="+65" {{ old('mobile_country_code') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                        <option value="+66" {{ old('mobile_country_code') === '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                        <option value="+84" {{ old('mobile_country_code') === '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                        <option value="+63" {{ old('mobile_country_code') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                        <option value="+62" {{ old('mobile_country_code') === '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                    </select>
                                    <input type="tel" name="mobile_number" id="mobile_number" required
                                           value="{{ old('mobile_number') }}"
                                           placeholder="555 123 4567"
                                           class="flex-1 px-4 py-3 bg-slate-700 border border-l-0 border-slate-600 rounded-r-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('mobile_number') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                </div>
                                @error('mobile_number')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="landline_number" class="block text-sm font-medium text-slate-300 mb-2">
                                    Landline Number *
                                </label>
                                <div class="flex">
                                    <select name="landline_country_code" 
                                            class="w-24 px-3 py-3 bg-slate-700 border border-r-0 border-slate-600 rounded-l-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 text-sm @error('landline_number') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="+971" {{ old('landline_country_code', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                        <option value="+1" {{ old('landline_country_code') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                        <option value="+44" {{ old('landline_country_code') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                        <option value="+91" {{ old('landline_country_code') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                        <option value="+86" {{ old('landline_country_code') === '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                        <option value="+33" {{ old('landline_country_code') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                        <option value="+49" {{ old('landline_country_code') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                        <option value="+81" {{ old('landline_country_code') === '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                        <option value="+82" {{ old('landline_country_code') === '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                        <option value="+61" {{ old('landline_country_code') === '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                        <option value="+55" {{ old('landline_country_code') === '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                        <option value="+7" {{ old('landline_country_code') === '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                        <option value="+34" {{ old('landline_country_code') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                        <option value="+39" {{ old('landline_country_code') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                        <option value="+31" {{ old('landline_country_code') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                        <option value="+41" {{ old('landline_country_code') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                        <option value="+46" {{ old('landline_country_code') === '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                        <option value="+47" {{ old('landline_country_code') === '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                        <option value="+45" {{ old('landline_country_code') === '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                        <option value="+90" {{ old('landline_country_code') === '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                        <option value="+966" {{ old('landline_country_code') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                        <option value="+965" {{ old('landline_country_code') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                        <option value="+974" {{ old('landline_country_code') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                        <option value="+973" {{ old('landline_country_code') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                        <option value="+968" {{ old('landline_country_code') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                        <option value="+962" {{ old('landline_country_code') === '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                        <option value="+961" {{ old('landline_country_code') === '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                        <option value="+20" {{ old('landline_country_code') === '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                        <option value="+60" {{ old('landline_country_code') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                        <option value="+65" {{ old('landline_country_code') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                        <option value="+66" {{ old('landline_country_code') === '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                        <option value="+84" {{ old('landline_country_code') === '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                        <option value="+63" {{ old('landline_country_code') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                        <option value="+62" {{ old('landline_country_code') === '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                    </select>
                                    <input type="tel" name="landline_number" id="landline_number" required
                                           value="{{ old('landline_number') }}"
                                           placeholder="4 555 4567"
                                           class="flex-1 px-4 py-3 bg-slate-700 border border-l-0 border-slate-600 rounded-r-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('landline_number') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                </div>
                                @error('landline_number')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 4th Row: Email and Website -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company_email" class="block text-sm font-medium text-slate-300 mb-2">
                                    Email *
                                </label>
                                <input type="email" name="company_email" id="company_email" required
                                       value="{{ old('company_email') }}"
                                       placeholder="Enter company email"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_email') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('company_email')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="company_website" class="block text-sm font-medium text-slate-300 mb-2">
                                    Website
                                </label>
                                <input type="url" name="company_website" id="company_website"
                                       value="{{ old('company_website') }}"
                                       placeholder="https://www.yourcompany.com"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_website') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('company_website')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Billing Address Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold mb-4" style="color: rgb(255,94,20);">Billing Address</h3>
                            
                            <!-- Emirates and Country -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="emirates" class="block text-sm font-medium text-slate-300 mb-2">
                                        Emirates *
                                    </label>
                                    <select name="emirates" id="emirates" required
                                            class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 @error('emirates') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="">Select Emirates</option>
                                        <option value="abu_dhabi" {{ old('emirates') === 'abu_dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                                        <option value="dubai" {{ old('emirates') === 'dubai' ? 'selected' : '' }}>Dubai</option>
                                        <option value="sharjah" {{ old('emirates') === 'sharjah' ? 'selected' : '' }}>Sharjah</option>
                                        <option value="ajman" {{ old('emirates') === 'ajman' ? 'selected' : '' }}>Ajman</option>
                                        <option value="umm_al_quwain" {{ old('emirates') === 'umm_al_quwain' ? 'selected' : '' }}>Umm Al Quwain</option>
                                        <option value="ras_al_khaimah" {{ old('emirates') === 'ras_al_khaimah' ? 'selected' : '' }}>Ras Al Khaimah</option>
                                        <option value="fujairah" {{ old('emirates') === 'fujairah' ? 'selected' : '' }}>Fujairah</option>
                                    </select>
                                    @error('emirates')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="country" class="block text-sm font-medium text-slate-300 mb-2">
                                        Country *
                                    </label>
                                    <select name="country" id="country" required
                                            class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 @error('country') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="">Select Country</option>
                                        <option value="uae" {{ old('country', 'uae') === 'uae' ? 'selected' : '' }}>United Arab Emirates</option>
                                        <option value="saudi_arabia" {{ old('country') === 'saudi_arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="qatar" {{ old('country') === 'qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="kuwait" {{ old('country') === 'kuwait' ? 'selected' : '' }}>Kuwait</option>
                                        <option value="bahrain" {{ old('country') === 'bahrain' ? 'selected' : '' }}>Bahrain</option>
                                        <option value="oman" {{ old('country') === 'oman' ? 'selected' : '' }}>Oman</option>
                                    </select>
                                    @error('country')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Company Address -->
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="company_address" class="block text-sm font-medium text-slate-300 mb-2">
                                        Company Address *
                                    </label>
                                    <textarea name="company_address" id="company_address" rows="3" required
                                              placeholder="Enter complete company address"
                                              class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_address') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">{{ old('company_address') }}</textarea>
                                    @error('company_address')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-2" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200">
                            Previous
                        </button>
                        <button type="button" id="next-btn-2" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 3: Financial & Banking Details -->
                <div class="step-content" data-step="3">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Financial & Banking Details</h2>
                    
                    <div class="space-y-6">
                        <!-- 1st Row: Payment Terms and Bank Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="payment_terms" class="block text-sm font-medium text-slate-300 mb-2">
                                    Payment Terms *
                                </label>
                                <select name="payment_terms" id="payment_terms" required
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 @error('payment_terms') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Payment Terms</option>
                                    <option value="30_days" {{ old('payment_terms') === '30_days' ? 'selected' : '' }}>30 Days</option>
                                    <option value="60_days" {{ old('payment_terms') === '60_days' ? 'selected' : '' }}>60 Days</option>
                                    <option value="90_days" {{ old('payment_terms') === '90_days' ? 'selected' : '' }}>90 Days</option>
                                </select>
                                @error('payment_terms')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="bank_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Bank Name *
                                </label>
                                <input type="text" name="bank_name" id="bank_name" required
                                       value="{{ old('bank_name') }}"
                                       placeholder="Enter bank name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('bank_name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('bank_name')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 2nd Row: IBAN and Swift Code -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="iban" class="block text-sm font-medium text-slate-300 mb-2">
                                    IBAN *
                                </label>
                                <input type="text" name="iban" id="iban" required
                                       value="{{ old('iban') }}"
                                       placeholder="Enter IBAN number"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('iban') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('iban')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="swift_code" class="block text-sm font-medium text-slate-300 mb-2">
                                    Swift Code *
                                </label>
                                <input type="text" name="swift_code" id="swift_code" required
                                       value="{{ old('swift_code') }}"
                                       placeholder="Enter Swift code"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('swift_code') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('swift_code')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- 3rd Row: Branch Address and VAT Registration No -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="branch_address" class="block text-sm font-medium text-slate-300 mb-2">
                                    Branch Address *
                                </label>
                                <textarea name="branch_address" id="branch_address" rows="3" required
                                          placeholder="Enter bank branch address"
                                          class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('branch_address') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">{{ old('branch_address') }}</textarea>
                                @error('branch_address')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="vat_registration_no" class="block text-sm font-medium text-slate-300 mb-2">
                                    VAT Registration No *
                                </label>
                                <input type="text" name="vat_registration_no" id="vat_registration_no" required
                                       value="{{ old('vat_registration_no') }}"
                                       placeholder="Enter VAT registration number"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('vat_registration_no') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('vat_registration_no')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-3" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200">
                            Previous
                        </button>
                        <button type="button" id="next-btn-3" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 4: Document Upload -->
                <div class="step-content" data-step="4">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Document Upload <span class="text-sm text-red-400">(Required*)</span></h2>
                    
                    <div class="space-y-6">
                        <!-- Business License and VAT Certificate -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="business_license" class="block text-sm font-medium text-slate-300 mb-2">
                                    Business License *
                                </label>
                                <input type="file" name="business_license" id="business_license" required
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600 focus:outline-none focus:ring-2 transition-all duration-200 @error('business_license') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG (max 2MB)</p>
                                @error('business_license')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="vat_certificate" class="block text-sm font-medium text-slate-300 mb-2">
                                    VAT Certificate *
                                </label>
                                <input type="file" name="vat_certificate" id="vat_certificate" required
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600 focus:outline-none focus:ring-2 transition-all duration-200 @error('vat_certificate') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG (max 2MB)</p>
                                @error('vat_certificate')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Company Profile -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="company_profile" class="block text-sm font-medium text-slate-300 mb-2">
                                    Company Profile
                                </label>
                                <input type="file" name="company_profile" id="company_profile"
                                       accept=".pdf,.doc,.docx"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_profile') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                <p class="mt-1 text-xs text-slate-400">PDF, DOC, DOCX (max 5MB)</p>
                                @error('company_profile')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-4" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200">
                            Previous
                        </button>
                        <button type="button" id="next-btn-4" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 5: Consent & Agreement -->
                <div class="step-content" data-step="5">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Consent & Agreement</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <p class="text-slate-300 mb-4">By submitting this Vendor Registration Form, I hereby acknowledge and agree to the following terms:</p>
                            
                            <div class="space-y-4 text-sm text-slate-400">
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">1. Accuracy of Information</h4>
                                    <p>I affirm that all information provided in this application is true, accurate, and complete to the best of my knowledge.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">2. Verification & Due Diligence</h4>
                                    <p>I authorize the Company to verify any information provided, including conducting background, financial, or compliance checks as deemed necessary.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">3. Consequences of Misrepresentation</h4>
                                    <p>I understand that providing false, incomplete, or misleading information may result in disqualification from the vendor registration process or termination of any existing engagement.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">4. Data Privacy & Protection</h4>
                                    <p>I consent to the collection, processing, and secure storage of my personal and business data in accordance with applicable data protection and privacy laws.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">5. Confidentiality</h4>
                                    <p>I agree to maintain the confidentiality of any proprietary, sensitive, or privileged information shared with me during the registration or evaluation process.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">6. No Guarantee of Engagement</h4>
                                    <p>I understand that submission of this form does not constitute an offer, contract, or guarantee of acceptance as an approved vendor.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">7. Compliance with Company Policies</h4>
                                    <p>If accepted, I agree to comply with all applicable company policies, procedures, standards, and contractual obligations.</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-slate-300 mb-2">8. Validity of Consent</h4>
                                    <p>This consent shall remain valid until I withdraw it in writing or until the conclusion of the vendor registration process, whichever occurs first.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Consent Checkbox -->
                        <div class="flex items-start">
                            <input type="checkbox" name="consent_agreement" id="consent_agreement" required
                                   class="mt-1 h-4 w-4 rounded border-slate-600 bg-slate-700 text-orange-500 focus:ring-orange-500 focus:ring-offset-slate-800">
                            <label for="consent_agreement" class="ml-3 text-sm text-slate-300">
                                I have read and understood the above consent terms. I agree to the Terms of Service and Privacy Policy. I confirm that all information provided is accurate and complete. *
                            </label>
                        </div>
                        @error('consent_agreement')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-5" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200">
                            Previous
                        </button>
                        <button type="button" id="next-btn-5" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Next
                        </button>
                    </div>
                </div>

                <!-- Step 6: Review & Submit -->
                <div class="step-content" data-step="6">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Review & Submit</h2>
                    
                    <div class="space-y-6">
                        <!-- Review Information Message -->
                        <div class="bg-slate-700 p-6 rounded-lg border border-orange-500">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-orange-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-green-400">Ready to Submit</h3>
                                    <p class="text-green-300">Please review all information above and submit your registration.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Account Information Review -->
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-white">Account Information</h3>
                                <button type="button" class="text-orange-500 hover:text-orange-400 text-sm font-medium edit-step-btn" data-target-step="1">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Name:</span>
                                    <span class="text-white ml-2" id="review-full-name">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Email:</span>
                                    <span class="text-white ml-2" id="review-email">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Company Information Review -->
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-white">Company Information</h3>
                                <button type="button" class="text-orange-500 hover:text-orange-400 text-sm font-medium edit-step-btn" data-target-step="2">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Company Name:</span>
                                    <span class="text-white ml-2" id="review-company-name">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Business Type:</span>
                                    <span class="text-white ml-2" id="review-business-type">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Contact Person:</span>
                                    <span class="text-white ml-2" id="review-contact-person">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Designation:</span>
                                    <span class="text-white ml-2" id="review-designation">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Mobile Number:</span>
                                    <span class="text-white ml-2" id="review-mobile-number">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Company Email:</span>
                                    <span class="text-white ml-2" id="review-company-email">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Emirates:</span>
                                    <span class="text-white ml-2" id="review-emirates">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Country:</span>
                                    <span class="text-white ml-2" id="review-country">-</span>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="text-slate-400">Company Address:</span>
                                    <span class="text-white ml-2" id="review-company-address">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Financial & Banking Details Review -->
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-white">Financial & Banking Details</h3>
                                <button type="button" class="text-orange-500 hover:text-orange-400 text-sm font-medium edit-step-btn" data-target-step="3">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Payment Terms:</span>
                                    <span class="text-white ml-2" id="review-payment-terms">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Bank Name:</span>
                                    <span class="text-white ml-2" id="review-bank-name">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">IBAN:</span>
                                    <span class="text-white ml-2" id="review-iban">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Swift Code:</span>
                                    <span class="text-white ml-2" id="review-swift-code">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">VAT Registration No:</span>
                                    <span class="text-white ml-2" id="review-vat-registration-no">-</span>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="text-slate-400">Branch Address:</span>
                                    <span class="text-white ml-2" id="review-branch-address">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Document Upload Review -->
                        <div class="bg-slate-700 p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-white">Documents</h3>
                                <button type="button" class="text-orange-500 hover:text-orange-400 text-sm font-medium edit-step-btn" data-target-step="4">
                                    Edit
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-slate-400">Business License:</span>
                                    <span class="text-white ml-2" id="review-business-license">-</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">VAT Certificate:</span>
                                    <span class="text-white ml-2" id="review-vat-certificate">-</span>
                                </div>
                                <div class="md:col-span-2">
                                    <span class="text-slate-400">Company Profile:</span>
                                    <span class="text-white ml-2" id="review-company-profile">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-6" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200">
                            Previous
                        </button>
                        <button type="submit" id="submit-btn" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Submit Vendor Application
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Help Section -->
        <div class="mt-8 text-center text-slate-400">
            <p>Need help with your application? 
                <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> 
                or call us at 
                <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
            </p>
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
                    <h3 class="text-xl font-semibold text-white mb-3">Registration Successful!</h3>
                    <p class="text-slate-300 mb-6">Thank you for registering with <span style="color: rgb(255,94,20);">SKY LAND CONSTRUCTION LLC OPC</span>. Your supplier registration has been successfully submitted and is currently under review.</p>
                    
                    <div class="bg-slate-700 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h4 class="text-sm font-semibold text-slate-200">What's Next?</h4>
                        </div>
                        <ul class="text-sm text-slate-400 space-y-2">
                            <li class="flex items-center">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-3 flex-shrink-0"></span>
                                Our team will review your application within 2-3 business days
                            </li>
                            <li class="flex items-center">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-3 flex-shrink-0"></span>
                                We'll contact you via email for any additional information needed
                            </li>
                            <li class="flex items-center">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-3 flex-shrink-0"></span>
                                Once approved, you'll receive supplier portal access credentials
                            </li>
                        </ul>
                    </div>

                    <button onclick="closeSuccessModal()" class="w-full px-4 py-3 text-white rounded-lg font-medium transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                        Continue
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 6;
    const progressBar = document.getElementById('progress-bar');
    const progressPercentageText = document.getElementById('progress-percentage-text');

    // Ensure all steps are properly initialized
    const allSteps = document.querySelectorAll('.step-content');
    allSteps.forEach(stepElement => {
        stepElement.classList.remove('active');
    });

    // Initialize step visibility
    showStep(currentStep);
    updateProgress();
    
    // Test validation immediately on page load
    console.log('=== INITIALIZATION TEST ===');
    console.log('Current step:', currentStep);
    console.log('Total steps:', totalSteps);
    
    // Test if we can find Step 1 content (not indicator)
    const step1Element = document.querySelector('.step-content[data-step="1"]');
    console.log('Step 1 content found:', step1Element);
    
    if (step1Element) {
        const requiredFields = step1Element.querySelectorAll('input[required], select[required], textarea[required]');
        console.log('Required fields in Step 1:', requiredFields.length);
        requiredFields.forEach((field, index) => {
            console.log(`Field ${index + 1}: ${field.name || field.id} (type: ${field.type}, required: ${field.required})`);
        });
    } else {
        console.log('ERROR: Could not find Step 1 content element!');
    }
    
    // Add a manual test function to window for debugging
    window.testValidation = function() {
        console.log('=== MANUAL VALIDATION TEST ===');
        const result = validateCurrentStep();
        console.log('Manual validation result:', result);
        return result;
    };

    // Navigation functions
    function goToNextStep() {
        const isValid = validateCurrentStep();
        
        if (isValid) {
            if (currentStep < totalSteps) {
                currentStep = currentStep + 1;
                showStep(currentStep);
                updateProgress();
            }
        }
        // If validation fails, the validateCurrentStep function will handle showing errors
    }
    
    function goToPrevStep() {
        if (currentStep > 1) {
            currentStep = currentStep - 1;
            showStep(currentStep);
            updateProgress();
        }
    }

    // Step navigation event listeners
    for (let i = 1; i <= totalSteps; i++) {
        const nextBtn = document.getElementById(`next-btn-${i}`);
        const prevBtn = document.getElementById(`prev-btn-${i}`);

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                // Only process if this is the current step's next button
                if (i === currentStep) {
                    goToNextStep();
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                // Only process if this is the current step's prev button
                if (i === currentStep) {
                    goToPrevStep();
                }
            });
        }
    }

    function showStep(step) {
        // Hide all steps
        const allSteps = document.querySelectorAll('.step-content');
        allSteps.forEach(stepElement => {
            stepElement.classList.remove('active');
        });

        // Show current step with animation
        const currentStepElement = document.querySelector(`.step-content[data-step="${step}"]`);
        if (currentStepElement) {
            setTimeout(() => {
                currentStepElement.classList.add('active');
            }, 50);
        }

        // Update step indicators
        updateStepIndicators(step);
    }

    function updateStepIndicators(activeStep) {
        for (let i = 1; i <= totalSteps; i++) {
            const stepCircle = document.querySelector(`[data-step="${i}"] .step-circle`);
            const stepLabel = document.querySelector(`[data-step="${i}"] .step-label`);
            const connector = document.querySelector(`[data-connector="${i}"]`);

            if (stepCircle && stepLabel) {
                if (i < activeStep) {
                    // Completed steps
                    stepCircle.style.backgroundColor = 'rgb(255,94,20)';
                    stepCircle.style.color = 'white';
                    stepLabel.style.color = 'rgb(255,94,20)';
                    stepCircle.classList.add('completed');
                    stepLabel.classList.add('completed');
                } else if (i === activeStep) {
                    // Active step
                    stepCircle.style.backgroundColor = 'rgb(255,94,20)';
                    stepCircle.style.color = 'white';
                    stepLabel.style.color = 'rgb(255,120,50)';
                    stepCircle.classList.remove('completed');
                    stepLabel.classList.remove('completed');
                    stepLabel.classList.add('active');
                } else {
                    // Future steps
                    stepCircle.style.backgroundColor = 'rgb(71,85,105)';
                    stepCircle.style.color = 'rgb(148,163,184)';
                    stepLabel.style.color = 'rgb(148,163,184)';
                    stepCircle.classList.remove('completed');
                    stepLabel.classList.remove('completed', 'active');
                }
            }

            if (connector) {
                if (i < activeStep) {
                    connector.style.backgroundColor = 'rgb(255,94,20)';
                    connector.classList.add('completed');
                } else {
                    connector.style.backgroundColor = 'rgb(71,85,105)';
                    connector.classList.remove('completed');
                }
            }
        }
    }

    function updateProgress() {
        const progressPercentage = (currentStep / totalSteps) * 100;
        progressBar.style.width = progressPercentage + '%';
        progressPercentageText.textContent = Math.round(progressPercentage) + '%';
    }

    function validateCurrentStep() {
        const currentStepElement = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        if (!currentStepElement) {
            return false;
        }

        const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
        
        let isValid = true;
        let firstInvalidField = null;
        let invalidFields = [];

        requiredFields.forEach((field, index) => {
            let fieldValid = true;
            let fieldName = field.name || field.id || `field-${index}`;
            
            // Check different field types
            if (field.type === 'file') {
                fieldValid = field.files && field.files.length > 0;
            } else if (field.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                fieldValid = field.value.trim() && emailRegex.test(field.value.trim());
            } else if (field.type === 'password') {
                fieldValid = field.value && field.value.length >= 8;
            } else if (field.type === 'checkbox' || field.type === 'radio') {
                fieldValid = field.checked;
            } else {
                fieldValid = field.value && field.value.trim() !== '';
            }

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
                invalidFields.push(fieldName);
                isValid = false;
            } else {
                field.style.borderColor = 'rgb(71,85,105)';
                field.style.boxShadow = 'none';
                field.classList.remove('validation-error-field');
            }
        });

        // Focus on first invalid field and show error message
        if (!isValid && firstInvalidField) {
            // Only focus if the field is actually visible and focusable
            const fieldRect = firstInvalidField.getBoundingClientRect();
            const isVisible = fieldRect.width > 0 && fieldRect.height > 0 && 
                             getComputedStyle(firstInvalidField).visibility !== 'hidden' &&
                             getComputedStyle(firstInvalidField).display !== 'none';
            
            if (isVisible) {
                try {
                    firstInvalidField.focus();
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
            errorDiv.className = 'mt-4 p-3 bg-red-900 border border-red-600 rounded-lg text-red-200 text-sm animate-pulse';
            errorDiv.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <strong>Please fill in all required fields before proceeding.</strong>
                        <br><small>Missing fields: ${invalidFields.join(', ')}</small>
                    </div>
                </div>
            `;
            
            const stepHeader = currentStepElement.querySelector('h2');
            if (stepHeader) {
                stepHeader.parentNode.insertBefore(errorDiv, stepHeader.nextSibling);
                
                // Scroll to error message
                errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            // Remove error message after 10 seconds
            setTimeout(() => {
                if (document.getElementById('validation-error')) {
                    document.getElementById('validation-error').remove();
                }
            }, 10000);
        } else {
            // Remove any existing error message
            const existingError = document.getElementById('validation-error');
            if (existingError) {
                existingError.remove();
            }
        }

        return isValid;
    }

    // Add CSS for step transitions
    const style = document.createElement('style');
    style.textContent = `
        .step-content {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease-in-out;
            display: none !important;
        }
        .step-content.active {
            opacity: 1;
            transform: translateX(0);
            display: block !important;
        }
        
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
    `;
    document.head.appendChild(style);
    // Function to populate review content
    function populateReviewContent() {
        const form = document.getElementById('vendor-wizard-form');
        
        // Account Information
        const fullName = form.querySelector('[name="full_name"]')?.value || '-';
        const email = form.querySelector('[name="email"]')?.value || '-';
        
        document.getElementById('review-full-name').textContent = fullName;
        document.getElementById('review-email').textContent = email;
        
        // Company Information
        const companyName = form.querySelector('[name="company_name"]')?.value || '-';
        const businessType = form.querySelector('[name="business_type"]')?.value || '-';
        const contactPerson = form.querySelector('[name="contact_person"]')?.value || '-';
        const designation = form.querySelector('[name="designation"]')?.value || '-';
        const mobileCountryCode = form.querySelector('[name="mobile_country_code"]')?.value || '';
        const mobileNumber = form.querySelector('[name="mobile_number"]')?.value || '';
        const companyEmail = form.querySelector('[name="company_email"]')?.value || '-';
        const emirates = form.querySelector('[name="emirates"]')?.value || '-';
        const country = form.querySelector('[name="country"]')?.value || '-';
        const companyAddress = form.querySelector('[name="company_address"]')?.value || '-';
        
        document.getElementById('review-company-name').textContent = companyName;
        document.getElementById('review-business-type').textContent = businessType;
        document.getElementById('review-contact-person').textContent = contactPerson;
        document.getElementById('review-designation').textContent = designation;
        document.getElementById('review-mobile-number').textContent = mobileCountryCode + ' ' + mobileNumber;
        document.getElementById('review-company-email').textContent = companyEmail;
        document.getElementById('review-emirates').textContent = emirates;
        document.getElementById('review-country').textContent = country;
        document.getElementById('review-company-address').textContent = companyAddress;
        
        // Financial & Banking Details
        const paymentTerms = form.querySelector('[name="payment_terms"]')?.value || '-';
        const bankName = form.querySelector('[name="bank_name"]')?.value || '-';
        const iban = form.querySelector('[name="iban"]')?.value || '-';
        const swiftCode = form.querySelector('[name="swift_code"]')?.value || '-';
        const vatRegistrationNo = form.querySelector('[name="vat_registration_no"]')?.value || '-';
        const branchAddress = form.querySelector('[name="branch_address"]')?.value || '-';
        
        document.getElementById('review-payment-terms').textContent = paymentTerms;
        document.getElementById('review-bank-name').textContent = bankName;
        document.getElementById('review-iban').textContent = iban;
        document.getElementById('review-swift-code').textContent = swiftCode;
        document.getElementById('review-vat-registration-no').textContent = vatRegistrationNo;
        document.getElementById('review-branch-address').textContent = branchAddress;
        
        // Document Upload
        const businessLicense = form.querySelector('[name="business_license"]');
        const vatCertificate = form.querySelector('[name="vat_certificate"]');
        const companyProfile = form.querySelector('[name="company_profile"]');
        
        document.getElementById('review-business-license').textContent = 
            businessLicense?.files?.length > 0 ? businessLicense.files[0].name : 'No file selected';
        document.getElementById('review-vat-certificate').textContent = 
            vatCertificate?.files?.length > 0 ? vatCertificate.files[0].name : 'No file selected';
        document.getElementById('review-company-profile').textContent = 
            companyProfile?.files?.length > 0 ? companyProfile.files[0].name : 'No file selected';
    }
    
    // Handle edit buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-step-btn')) {
            const targetStep = parseInt(e.target.getAttribute('data-target-step'));
            if (targetStep >= 1 && targetStep <= totalSteps) {
                currentStep = targetStep;
                showStep(currentStep);
                updateProgress();
            }
        }
    });
    
    // Update the goToNextStep function to populate review content when entering step 6
    const originalGoToNextStep = goToNextStep;
    goToNextStep = function() {
        const wasStep5 = currentStep === 5;
        originalGoToNextStep();
        
        // If we just moved to step 6, populate the review content
        if (wasStep5 && currentStep === 6) {
            populateReviewContent();
        }
    };

    // Form submission handler
    document.getElementById('vendor-wizard-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission for demo
        
        // Validate final step
        if (!validateCurrentStep()) {
            return false;
        }
        
        // Show success modal
        showSuccessModal();
        
        // In a real application, you would submit the form here:
        // this.submit();
    });
});

// Password toggle functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eyeIcon = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L5.64 5.64m4.242 4.242L15.12 15.12M15.12 15.12l4.243 4.243"></path>
        `;
    } else {
        field.type = 'password';
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
        `;
    }
}

// Success Modal Functions
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

// Handle form submission
// Close modal when clicking outside
document.getElementById('success-modal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuccessModal();
    }
});
</script>

<style>
/* Custom logo styles */
.object-contain {
    object-fit: contain;
}

.w-16 {
    width: 14rem;
}

/* 3D Background Effects */
.page-3d-background {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #1e293b 75%, #0f172a 100%);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
}

.page-3d-background::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 25% 25%, rgba(255, 94, 20, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.page-3d-background::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}

/* Form 3D Container Effects */
.form-3d-container {
    position: relative;
    background: linear-gradient(145deg, #1e293b, #0f172a);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 
        0 25px 50px -12px rgba(0, 0, 0, 0.8),
        0 0 0 1px rgba(255, 255, 255, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    transform: perspective(1000px) rotateX(2deg);
    transition: all 0.3s ease;
}

.form-3d-container::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(135deg, rgba(255, 94, 20, 0.2), rgba(59, 130, 246, 0.1), rgba(255, 94, 20, 0.2));
    border-radius: inherit;
    z-index: -1;
    opacity: 0.5;
    filter: blur(8px);
}

.form-3d-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(255, 94, 20, 0.05) 50%, transparent 100%);
    border-radius: inherit;
    pointer-events: none;
}

.form-3d-container:hover {
    transform: perspective(1000px) rotateX(0deg) translateY(-5px);
    box-shadow: 
        0 35px 60px -12px rgba(0, 0, 0, 0.9),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
}

/* Enhanced form styling */
.form-3d-container form {
    position: relative;
    z-index: 1;
}

/* 3D Input Effects - Override all input styling */
.form-3d-container input[type="text"],
.form-3d-container input[type="email"],
.form-3d-container input[type="tel"],
.form-3d-container input[type="url"],
.form-3d-container input[type="number"],
.form-3d-container input[type="file"],
.form-3d-container textarea,
.form-3d-container select {
    background: linear-gradient(145deg, #334155, #1e293b) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    box-shadow: 
        inset 2px 2px 5px rgba(0, 0, 0, 0.3),
        inset -2px -2px 5px rgba(255, 255, 255, 0.05) !important;
    transition: all 0.3s ease !important;
}

.form-3d-container input[type="text"]:focus,
.form-3d-container input[type="email"]:focus,
.form-3d-container input[type="tel"]:focus,
.form-3d-container input[type="url"]:focus,
.form-3d-container input[type="number"]:focus,
.form-3d-container input[type="file"]:focus,
.form-3d-container textarea:focus,
.form-3d-container select:focus {
    border-color: rgb(255, 94, 20) !important;
    box-shadow: 
        inset 2px 2px 5px rgba(0, 0, 0, 0.3),
        inset -2px -2px 5px rgba(255, 255, 255, 0.05),
        0 0 0 3px rgba(255, 94, 20, 0.1) !important;
    transform: translateY(-1px);
}

/* 3D Button Effects */
.form-3d-container button[type="submit"],
.form-3d-container button[type="button"] {
    background: linear-gradient(145deg, rgb(255, 94, 20), rgb(234, 88, 12)) !important;
    border: none !important;
    box-shadow: 
        0 4px 15px rgba(255, 94, 20, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
    transform: perspective(500px) rotateX(5deg);
    transition: all 0.2s ease !important;
}

.form-3d-container button[type="submit"]:hover,
.form-3d-container button[type="button"]:hover {
    background: linear-gradient(145deg, rgb(234, 88, 12), rgb(255, 94, 20)) !important;
    box-shadow: 
        0 6px 20px rgba(255, 94, 20, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
    transform: perspective(500px) rotateX(0deg) translateY(-2px);
}

.form-3d-container button[type="submit"]:active,
.form-3d-container button[type="button"]:active {
    transform: perspective(500px) rotateX(2deg) translateY(1px);
    box-shadow: 
        0 2px 10px rgba(255, 94, 20, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
}

/* Enhanced Progress Bar 3D Effect */
#progress-bar {
    background: linear-gradient(145deg, rgb(255, 94, 20), rgb(255, 120, 50)) !important;
    box-shadow: 
        inset 0 2px 4px rgba(0, 0, 0, 0.2),
        0 2px 8px rgba(255, 94, 20, 0.3);
    border-radius: inherit;
}

/* Step Indicators 3D Effect */
.step-circle {
    box-shadow: 
        0 2px 8px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.step-circle:hover {
    transform: translateY(-1px);
    box-shadow: 
        0 4px 12px rgba(0, 0, 0, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
}

/* Label styling */
.form-3d-container label {
    color: rgb(203, 213, 225) !important;
    font-weight: 500;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

/* File upload button styling */
input[type="file"]::file-selector-button {
    background: rgb(255,94,20) !important;
    color: white !important;
    border: none !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    cursor: pointer !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    margin-right: 12px !important;
    transition: background-color 0.2s ease !important;
}

input[type="file"]::file-selector-button:hover {
    background: rgb(234,88,12) !important;
}

input[type="file"]::-webkit-file-upload-button {
    background: rgb(255,94,20) !important;
    color: white !important;
    border: none !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    cursor: pointer !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    margin-right: 12px !important;
    transition: background-color 0.2s ease !important;
}

input[type="file"]::-webkit-file-upload-button:hover {
    background: rgb(234,88,12) !important;
}

input[type="file"]::-moz-file-upload-button {
    background: rgb(255,94,20) !important;
    color: white !important;
    border: none !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    cursor: pointer !important;
    font-size: 12px !important;
    font-weight: 600 !important;
    margin-right: 12px !important;
    transition: background-color 0.2s ease !important;
}

input[type="file"]::-moz-file-upload-button:hover {
    background: rgb(234,88,12) !important;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}
</style>
@endsection
