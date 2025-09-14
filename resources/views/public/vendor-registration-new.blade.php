@extends('layouts.app')

@section('content')
<style>
    /* Animation for floating blobs */
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    /* Custom backdrop blur for better browser support */
    .backdrop-blur-xl {
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 py-8 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute top-40 left-40 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="w-16 h-16 flex items-center justify-center mr-4">
                <img src="{{ asset('images/SKYLAND_Logo.webp') }}" alt="SKY LAND CONSTRUCTION LLC OPC Logo" class="w-16 h-16 object-contain">
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
                    <!-- Step 1 - Contact -->
                    <div class="flex items-center step-indicator" data-step="1">
                        <div class="w-8 h-8 step-circle rounded-full flex items-center justify-center text-white text-sm font-semibold transition-all duration-300" style="background-color: rgb(255,94,20);">1</div>
                        <span class="ml-2 step-label text-white font-medium">Contact</span>
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
                    
                    <!-- Step 3 - Legal -->
                    <div class="flex items-center step-indicator" data-step="3">
                        <div class="w-8 h-8 step-circle bg-slate-600 rounded-full flex items-center justify-center text-slate-400 text-sm font-semibold transition-all duration-300">3</div>
                        <span class="ml-2 step-label text-slate-400 font-medium">Legal</span>
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
            <form id="vendor-wizard-form" method="POST" action="{{ route('supplier.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <!-- Step 1: Contact Information -->
                <div class="step-content active" data-step="1">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Contact Information</h2>

                    <div class="space-y-6">
                        <!-- 1st Row: First Name and Last Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    First Name *
                                </label>
                                <input type="text" name="first_name" id="first_name" required
                                       value="{{ old('first_name') }}"
                                       placeholder="Enter your first name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('first_name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('first_name')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-slate-300 mb-2">
                                    Last Name *
                                </label>
                                <input type="text" name="last_name" id="last_name" required
                                       value="{{ old('last_name') }}"
                                       placeholder="Enter your last name"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('last_name') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('last_name')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- 2nd Row: Email Address -->
                        <div class="grid grid-cols-1 gap-6">
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
                        
                        <!-- 3rd Row: Mobile Number -->
                        <div class="grid grid-cols-1 gap-6">
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
                        </div>
                        
                        <!-- 4th Row: Office Landline -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="office_landline" class="block text-sm font-medium text-slate-300 mb-2">
                                    Office LandLine Number *
                                </label>
                                <div class="flex">
                                    <select name="landline_country_code" 
                                            class="w-24 px-3 py-3 bg-slate-700 border border-r-0 border-slate-600 rounded-l-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 text-sm @error('office_landline') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
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
                                    <input type="tel" name="office_landline" id="office_landline" required
                                           value="{{ old('office_landline') }}"
                                           placeholder="4 555 4567"
                                           class="flex-1 px-4 py-3 bg-slate-700 border border-l-0 border-slate-600 rounded-r-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('office_landline') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                </div>
                                @error('office_landline')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- 5th Row: Designation -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="designation" class="block text-sm font-medium text-slate-300 mb-2">
                                    Designation
                                </label>
                                <input type="text" name="designation" id="designation"
                                       value="{{ old('designation') }}"
                                       placeholder="Enter your designation"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('designation') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('designation')
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

                    <!-- Help Text -->
                    <div class="mt-6 text-center">
                        <p class="text-slate-400 text-sm">
                            Need help with your application? <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> or call us at <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
                        </p>
                    </div>
                </div>

                <!-- Step 2: Company Information -->
                <div class="step-content" data-step="2">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Company Information</h2>
                    
                    <div class="space-y-6">
                        <!-- Company Name and Business Type -->
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
                                    Business Type
                                </label>
                                <select name="business_type" id="business_type"
                                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 @error('business_type') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                    <option value="">Select Business Type</option>
                                    <option value="sole_proprietorship" {{ old('business_type') === 'sole_proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                                    <option value="partnership" {{ old('business_type') === 'partnership' ? 'selected' : '' }}>Partnership</option>
                                    <option value="llc" {{ old('business_type') === 'llc' ? 'selected' : '' }}>LLC</option>
                                    <option value="corporation" {{ old('business_type') === 'corporation' ? 'selected' : '' }}>Corporation</option>
                                    <option value="non_profit" {{ old('business_type') === 'non_profit' ? 'selected' : '' }}>Non-Profit</option>
                                    <option value="other" {{ old('business_type') === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('business_type')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Person and Company Email -->
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
                                <label for="company_email" class="block text-sm font-medium text-slate-300 mb-2">
                                    Company Email *
                                </label>
                                <input type="email" name="company_email" id="company_email" required
                                       value="{{ old('company_email') }}"
                                       placeholder="Enter company email"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_email') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('company_email')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Company Website -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="company_website" class="block text-sm font-medium text-slate-300 mb-2">
                                    Company Website
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

                        <!-- Company Phone -->
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="company_phone" class="block text-sm font-medium text-slate-300 mb-2">
                                    Company Phone *
                                </label>
                                <div class="flex">
                                    <select name="company_phone_country_code" 
                                            class="w-24 px-3 py-3 bg-slate-700 border border-r-0 border-slate-600 rounded-l-lg text-white focus:outline-none focus:ring-2 transition-all duration-200 text-sm @error('company_phone') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                        <option value="+971" {{ old('company_phone_country_code', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                        <option value="+1" {{ old('company_phone_country_code') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                        <option value="+44" {{ old('company_phone_country_code') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                        <option value="+91" {{ old('company_phone_country_code') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                        <option value="+86" {{ old('company_phone_country_code') === '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                        <option value="+33" {{ old('company_phone_country_code') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                        <option value="+49" {{ old('company_phone_country_code') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                        <option value="+81" {{ old('company_phone_country_code') === '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                        <option value="+82" {{ old('company_phone_country_code') === '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                        <option value="+61" {{ old('company_phone_country_code') === '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                        <option value="+55" {{ old('company_phone_country_code') === '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                        <option value="+7" {{ old('company_phone_country_code') === '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                        <option value="+34" {{ old('company_phone_country_code') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                        <option value="+39" {{ old('company_phone_country_code') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                        <option value="+31" {{ old('company_phone_country_code') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                        <option value="+41" {{ old('company_phone_country_code') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                        <option value="+46" {{ old('company_phone_country_code') === '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                        <option value="+47" {{ old('company_phone_country_code') === '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                        <option value="+45" {{ old('company_phone_country_code') === '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                        <option value="+90" {{ old('company_phone_country_code') === '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                        <option value="+966" {{ old('company_phone_country_code') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                        <option value="+965" {{ old('company_phone_country_code') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                        <option value="+974" {{ old('company_phone_country_code') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                        <option value="+973" {{ old('company_phone_country_code') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                        <option value="+968" {{ old('company_phone_country_code') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                        <option value="+962" {{ old('company_phone_country_code') === '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                        <option value="+961" {{ old('company_phone_country_code') === '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                        <option value="+20" {{ old('company_phone_country_code') === '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                        <option value="+60" {{ old('company_phone_country_code') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                        <option value="+65" {{ old('company_phone_country_code') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                        <option value="+66" {{ old('company_phone_country_code') === '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                        <option value="+84" {{ old('company_phone_country_code') === '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                        <option value="+63" {{ old('company_phone_country_code') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                        <option value="+62" {{ old('company_phone_country_code') === '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                    </select>
                                    <input type="tel" name="company_phone" id="company_phone" required
                                           value="{{ old('company_phone') }}"
                                           placeholder="555 123 4567"
                                           class="flex-1 px-4 py-3 bg-slate-700 border border-l-0 border-slate-600 rounded-r-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('company_phone') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                </div>
                                @error('company_phone')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Year of Establishment and Nature of Business -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="year_established" class="block text-sm font-medium text-slate-300 mb-2">
                                    Year of Establishment
                                </label>
                                <input type="number" name="year_established" id="year_established" min="1900" max="{{ date('Y') }}"
                                       value="{{ old('year_established') }}"
                                       placeholder="2020"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('year_established') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('year_established')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="nature_of_business" class="block text-sm font-medium text-slate-300 mb-2">
                                    Nature of Business
                                </label>
                                <input type="text" name="nature_of_business" id="nature_of_business"
                                       value="{{ old('nature_of_business') }}"
                                       placeholder="Enter nature of business"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('nature_of_business') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('nature_of_business')
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

                    <!-- Step Navigation -->
                    <div class="flex justify-between mt-8">
                        <button type="button" id="prev-btn-2" class="px-6 py-3 bg-slate-600 text-white rounded-lg hover:bg-slate-500 transition-colors duration-200">
                            Previous
                        </button>
                        <button type="button" id="next-btn-2" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Next
                        </button>
                    </div>

                    <!-- Help Text -->
                    <div class="mt-6 text-center">
                        <p class="text-slate-400 text-sm">
                            Need help with your application? <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> or call us at <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
                        </p>
                    </div>
                </div>

                <!-- Step 3: Legal & Compliance -->
                <div class="step-content" data-step="3">
                    <h2 class="text-xl font-semibold mb-6" style="color: rgb(255,94,20);">Legal & Compliance</h2>
                    
                    <div class="space-y-6">
                        <!-- Trade License and Tax ID -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="trade_license_number" class="block text-sm font-medium text-slate-300 mb-2">
                                    Trade License Number
                                </label>
                                <input type="text" name="trade_license_number" id="trade_license_number"
                                       value="{{ old('trade_license_number') }}"
                                       placeholder="Enter trade license number"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('trade_license_number') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('trade_license_number')
                                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tax_id" class="block text-sm font-medium text-slate-300 mb-2">
                                    Tax ID / VAT Number
                                </label>
                                <input type="text" name="tax_id" id="tax_id"
                                       value="{{ old('tax_id') }}"
                                       placeholder="Enter tax ID or VAT number"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 transition-all duration-200 @error('tax_id') border-red-400 @enderror" style="--tw-ring-color: rgb(255,94,20); --tw-border-opacity: 1;" onfocus="this.style.borderColor='rgb(255,94,20)'" onblur="this.style.borderColor='rgb(71,85,105)'">
                                @error('tax_id')
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

                    <!-- Help Text -->
                    <div class="mt-6 text-center">
                        <p class="text-slate-400 text-sm">
                            Need help with your application? <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> or call us at <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
                        </p>
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

                    <!-- Help Text -->
                    <div class="mt-6 text-center">
                        <p class="text-slate-400 text-sm">
                            Need help with your application? <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> or call us at <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
                        </p>
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
                        <button type="submit" id="submit-btn" class="px-6 py-3 text-white rounded-lg transition-colors duration-200" style="background-color: rgb(255,94,20);" onmouseover="this.style.backgroundColor='rgb(230,80,15)'" onmouseout="this.style.backgroundColor='rgb(255,94,20)'">
                            Submit Vendor Application
                        </button>
                    </div>

                    <!-- Help Text -->
                    <div class="mt-6 text-center">
                        <p class="text-slate-400 text-sm">
                            Need help with your application? <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300">Email our team</a> or call us at <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300">+971 7243 5757</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 5;
    const progressBar = document.getElementById('progress-bar');
    const progressPercentageText = document.getElementById('progress-percentage-text');

    // Initialize step visibility
    showStep(currentStep);
    updateProgress();

    // Step navigation event listeners
    for (let i = 1; i <= totalSteps; i++) {
        const nextBtn = document.getElementById(`next-btn-${i}`);
        const prevBtn = document.getElementById(`prev-btn-${i}`);

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (validateCurrentStep()) {
                    if (i < totalSteps) {
                        currentStep = i + 1;
                        showStep(currentStep);
                        updateProgress();
                    }
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (i > 1) {
                    currentStep = i - 1;
                    showStep(currentStep);
                    updateProgress();
                }
            });
        }
    }

    function showStep(step) {
        // Hide all steps
        const allSteps = document.querySelectorAll('.step-content');
        allSteps.forEach(stepElement => {
            stepElement.classList.remove('active');
            stepElement.style.display = 'none';
        });

        // Show current step with animation
        const currentStepElement = document.querySelector(`[data-step="${step}"]`);
        if (currentStepElement) {
            currentStepElement.style.display = 'block';
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
        const currentStepElement = document.querySelector(`[data-step="${currentStep}"]`);
        if (!currentStepElement) return false;

        const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = 'rgb(239,68,68)';
                isValid = false;
            } else {
                field.style.borderColor = 'rgb(71,85,105)';
            }
        });

        return isValid;
    }

    // Add CSS for step transitions
    const style = document.createElement('style');
    style.textContent = `
        .step-content {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.3s ease-in-out;
        }
        .step-content.active {
            opacity: 1;
            transform: translateX(0);
        }
        .step-content:not(.active) {
            display: none;
        }
    `;
    document.head.appendChild(style);
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
