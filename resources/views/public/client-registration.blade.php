@extends('layouts.app')

@section('title', 'Client Registration')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-800 via-blue-900 to-slate-900 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23F97316" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="3"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    
    <div class="max-w-4xl mx-auto relative z-10">
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="mb-2">
                <img src="{{ asset('logo-light-trimmed.webp') }}" alt="Sky Land Construction" class="w-40 h-auto mx-auto">
            </div>
            <br/>
            <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight font-['Inter',_'system-ui',_sans-serif]">Client Registration</h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Register today to request quotations, schedule site visits, and seamlessly manage your projects with <span class="text-orange-400">Sky Land Construction</span>.
            </p>
        </div>

        <!-- Form Container -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <div class="px-8 py-6 backdrop-blur-sm border-b border-white/10">
                <h2 class="text-2xl font-semibold text-white">Client Application Form</h2>
                <p class="text-slate-300 mt-2">Please complete all required fields marked with *</p>
            </div>

            <form method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data" class="px-8 py-6">
                @csrf

                <!-- Client & Company Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Client & Company</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- 1. Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-200 mb-2">
                                Name *
                            </label>
                            <input type="text" name="name" id="name" required
                                   value="{{ old('name') }}"
                                   placeholder="Full Name"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('name') border-red-400 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 2. Company Name -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Name *
                            </label>
                            <input type="text" name="company_name" id="company_name" required
                                   value="{{ old('company_name') }}"
                                   placeholder="Company Name"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_name') border-red-400 @enderror">
                            @error('company_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 3. Mobile Number -->
                        <div>
                            <label for="mobile_number" class="block text-sm font-medium text-slate-200 mb-2">
                                Mobile Number *
                            </label>
                            <div class="flex">
                                <select name="mobile_country" id="mobile_country" required
                                        class="px-3 py-3 bg-white/10 backdrop-blur-md border border-white/30 border-r-0 rounded-l-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('mobile_country') border-red-400 @enderror">
                                    <option value="+971" {{ old('mobile_country') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                    <option value="+1" {{ old('mobile_country') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                    <option value="+44" {{ old('mobile_country') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                    <option value="+91" {{ old('mobile_country') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                    <option value="+92" {{ old('mobile_country') === '+92' ? 'selected' : '' }}>🇵🇰 +92</option>
                                    <option value="+880" {{ old('mobile_country') === '+880' ? 'selected' : '' }}>🇧🇩 +880</option>
                                    <option value="+94" {{ old('mobile_country') === '+94' ? 'selected' : '' }}>🇱🇰 +94</option>
                                    <option value="+63" {{ old('mobile_country') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                    <option value="+966" {{ old('mobile_country') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                    <option value="+965" {{ old('mobile_country') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                    <option value="+974" {{ old('mobile_country') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                    <option value="+973" {{ old('mobile_country') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                    <option value="+968" {{ old('mobile_country') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                </select>
                                <input type="tel" name="mobile_number" id="mobile_number" required
                                       value="{{ old('mobile_number') }}"
                                       placeholder="Mobile Number"
                                       class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 border-l-0 rounded-r-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('mobile_number') border-red-400 @enderror">
                            </div>
                            @error('mobile_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            @error('mobile_country')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 4. LandLine Number -->
                        <div>
                            <label for="landline_number" class="block text-sm font-medium text-slate-200 mb-2">
                                LandLine Number
                            </label>
                            <div class="flex">
                                <select name="landline_country" id="landline_country"
                                        class="px-3 py-3 bg-white/10 backdrop-blur-md border border-white/30 border-r-0 rounded-l-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('landline_country') border-red-400 @enderror">
                                    <option value="+971" {{ old('landline_country', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                    <option value="+1" {{ old('landline_country') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                    <option value="+44" {{ old('landline_country') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                    <option value="+91" {{ old('landline_country') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                    <option value="+92" {{ old('landline_country') === '+92' ? 'selected' : '' }}>🇵🇰 +92</option>
                                    <option value="+880" {{ old('landline_country') === '+880' ? 'selected' : '' }}>🇧🇩 +880</option>
                                    <option value="+94" {{ old('landline_country') === '+94' ? 'selected' : '' }}>🇱🇰 +94</option>
                                    <option value="+63" {{ old('landline_country') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                    <option value="+966" {{ old('landline_country') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                    <option value="+965" {{ old('landline_country') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                    <option value="+974" {{ old('landline_country') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                    <option value="+973" {{ old('landline_country') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                    <option value="+968" {{ old('landline_country') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                </select>
                                <input type="tel" name="landline_number" id="landline_number"
                                       value="{{ old('landline_number') }}"
                                       placeholder="LandLine Number"
                                       class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 border-l-0 rounded-r-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('landline_number') border-red-400 @enderror">
                            </div>
                            @error('landline_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            @error('landline_country')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 5. Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-200 mb-2">
                                Email Address *
                            </label>
                            <input type="email" name="email" id="email" required
                                   value="{{ old('email') }}"
                                   placeholder="Email Address"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('email') border-red-400 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 6. Company Website -->
                        <div>
                            <label for="company_website" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Website
                            </label>
                            <input type="url" name="company_website" id="company_website"
                                   value="{{ old('company_website') }}"
                                   placeholder="https://example.com"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_website') border-red-400 @enderror">
                            @error('company_website')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 7. Client Type -->
                        <div>
                            <label for="client_type" class="block text-sm font-medium text-slate-200 mb-2">
                                Client Type *
                            </label>
                            <select name="client_type" id="client_type" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('client_type') border-red-400 @enderror">
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

                        <!-- 8. License Number -->
                        <div>
                            <label for="license_number" class="block text-sm font-medium text-slate-200 mb-2">
                                License Number *
                            </label>
                            <input type="text" name="license_number" id="license_number" required
                                   value="{{ old('license_number') }}"
                                   placeholder="License Number"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('license_number') border-red-400 @enderror">
                            @error('license_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Project & Service Requirements Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Project & Service Requirements</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Type -->
                        <div>
                            <label for="project_type" class="block text-sm font-medium text-slate-200 mb-2">
                                Project Type *
                            </label>
                            <select name="project_type" id="project_type" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('project_type') border-red-400 @enderror">
                                <option value="">Select Project Type</option>
                                <option value="residential_villa" {{ old('project_type') === 'residential_villa' ? 'selected' : '' }}>Residential Villa</option>
                                <option value="commercial_retail" {{ old('project_type') === 'commercial_retail' ? 'selected' : '' }}>Commercial Retail</option>
                                <option value="industrial_warehouse" {{ old('project_type') === 'industrial_warehouse' ? 'selected' : '' }}>Industrial Warehouse</option>
                                <option value="fitout_renovation" {{ old('project_type') === 'fitout_renovation' ? 'selected' : '' }}>Fit-out Renovation</option>
                                <option value="maintenance" {{ old('project_type') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="others" {{ old('project_type') === 'others' ? 'selected' : '' }}>Others</option>
                            </select>
                            @error('project_type')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service Needed -->
                        <div>
                            <label for="service_needed" class="block text-sm font-medium text-slate-200 mb-2">
                                Service Needed *
                            </label>
                            <select name="service_needed" id="service_needed" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('service_needed') border-red-400 @enderror">
                                <option value="">Select Service Needed</option>
                                <option value="design_approval" {{ old('service_needed') === 'design_approval' ? 'selected' : '' }}>Design Approval</option>
                                <option value="civil_construction" {{ old('service_needed') === 'civil_construction' ? 'selected' : '' }}>Civil Construction</option>
                                <option value="mep_works" {{ old('service_needed') === 'mep_works' ? 'selected' : '' }}>MEP Works</option>
                                <option value="interior_joinery" {{ old('service_needed') === 'interior_joinery' ? 'selected' : '' }}>Interior and Joinery</option>
                                <option value="landscaping" {{ old('service_needed') === 'landscaping' ? 'selected' : '' }}>Landscaping</option>
                                <option value="maintenance_amc" {{ old('service_needed') === 'maintenance_amc' ? 'selected' : '' }}>Maintenance AMC</option>
                            </select>
                            @error('service_needed')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estimated Budget -->
                        <div>
                            <label for="estimated_budget" class="block text-sm font-medium text-slate-200 mb-2">
                                Estimated Budget *
                            </label>
                            <select name="estimated_budget" id="estimated_budget" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('estimated_budget') border-red-400 @enderror">
                                <option value="">Select Budget Range</option>
                                <option value="under_50k" {{ old('estimated_budget') === 'under_50k' ? 'selected' : '' }}>Under AED 50,000</option>
                                <option value="50k_100k" {{ old('estimated_budget') === '50k_100k' ? 'selected' : '' }}>AED 50,000 - 100,000</option>
                                <option value="100k_250k" {{ old('estimated_budget') === '100k_250k' ? 'selected' : '' }}>AED 100,000 - 250,000</option>
                                <option value="250k_500k" {{ old('estimated_budget') === '250k_500k' ? 'selected' : '' }}>AED 250,000 - 500,000</option>
                                <option value="500k_1m" {{ old('estimated_budget') === '500k_1m' ? 'selected' : '' }}>AED 500,000 - 1,000,000</option>
                                <option value="1m_5m" {{ old('estimated_budget') === '1m_5m' ? 'selected' : '' }}>AED 1,000,000 - 5,000,000</option>
                                <option value="over_5m" {{ old('estimated_budget') === 'over_5m' ? 'selected' : '' }}>Over AED 5,000,000</option>
                            </select>
                            @error('estimated_budget')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Project Location -->
                        <div>
                            <label for="street" class="block text-sm font-medium text-slate-200 mb-2">
                                Project Location *
                            </label>
                            <input type="text" name="street" id="street" required
                                   value="{{ old('street') }}"
                                   placeholder="Project Location"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('street') border-red-400 @enderror">
                            @error('street')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plot No -->
                        <div>
                            <label for="community" class="block text-sm font-medium text-slate-200 mb-2">
                                Plot No *
                            </label>
                            <input type="text" name="community" id="community" required
                                   value="{{ old('community') }}"
                                   placeholder="Plot Number"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('community') border-red-400 @enderror">
                            @error('community')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Emirate -->
                        <div>
                            <label for="emirate" class="block text-sm font-medium text-slate-200 mb-2">
                                Emirate *
                            </label>
                            <select name="emirate" id="emirate" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('emirate') border-red-400 @enderror">
                                <option value="">Select Emirate</option>
                                <option value="abu_dhabi" {{ old('emirate') === 'abu_dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                                <option value="dubai" {{ old('emirate') === 'dubai' ? 'selected' : '' }}>Dubai</option>
                                <option value="sharjah" {{ old('emirate') === 'sharjah' ? 'selected' : '' }}>Sharjah</option>
                                <option value="ajman" {{ old('emirate') === 'ajman' ? 'selected' : '' }}>Ajman</option>
                                <option value="umm_al_quwain" {{ old('emirate') === 'umm_al_quwain' ? 'selected' : '' }}>Umm Al Quwain</option>
                                <option value="ras_al_khaimah" {{ old('emirate') === 'ras_al_khaimah' ? 'selected' : '' }}>Ras Al Khaimah</option>
                                <option value="fujairah" {{ old('emirate') === 'fujairah' ? 'selected' : '' }}>Fujairah</option>
                            </select>
                            @error('emirate')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plot/Unit Number -->
                        <div>
                            <label for="plot_unit_number" class="block text-sm font-medium text-slate-200 mb-2">
                                Plot/Unit Number
                            </label>
                            <input type="text" name="plot_unit_number" id="plot_unit_number"
                                   value="{{ old('plot_unit_number') }}"
                                   placeholder="Plot or Unit Number"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('plot_unit_number') border-red-400 @enderror">
                            @error('plot_unit_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Target Start Date -->
                        <div>
                            <label for="target_start_date" class="block text-sm font-medium text-slate-200 mb-2">
                                Target Start Date *
                            </label>
                            <input type="date" name="target_start_date" id="target_start_date" required
                                   value="{{ old('target_start_date') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('target_start_date') border-red-400 @enderror">
                            @error('target_start_date')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Desired Timeline -->
                        <div>
                            <label for="desired_timeline" class="block text-sm font-medium text-slate-200 mb-2">
                                Desired Timeline *
                            </label>
                            <select name="desired_timeline" id="desired_timeline" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('desired_timeline') border-red-400 @enderror">
                                <option value="">Select Timeline</option>
                                <option value="urgent_0_4_weeks" {{ old('desired_timeline') === 'urgent_0_4_weeks' ? 'selected' : '' }}>Urgent (0-4 weeks)</option>
                                <option value="short_1_3_months" {{ old('desired_timeline') === 'short_1_3_months' ? 'selected' : '' }}>Short (1-3 months)</option>
                                <option value="medium_3_6_months" {{ old('desired_timeline') === 'medium_3_6_months' ? 'selected' : '' }}>Medium (3-6 months)</option>
                                <option value="long_6_plus_months" {{ old('desired_timeline') === 'long_6_plus_months' ? 'selected' : '' }}>Long (6+ months)</option>
                            </select>
                            @error('desired_timeline')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Project Brief -->
                        <div class="md:col-span-2">
                            <label for="project_brief" class="block text-sm font-medium text-slate-200 mb-2">
                                Project Brief *
                            </label>
                            <textarea name="project_brief" id="project_brief" rows="4" required
                                      placeholder="Please describe your project requirements, goals, and any specific details..."
                                      class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('project_brief') border-red-400 @enderror">{{ old('project_brief') }}</textarea>
                            @error('project_brief')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Attachments Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Attachments</h3>
                        <span class="ml-2 text-sm text-slate-400">(Optional)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Drawings -->
                        <div>
                            <label for="site_plans" class="block text-sm font-medium text-slate-200 mb-2">
                                Project Drawings
                            </label>
                            <input type="file" name="site_plans" id="site_plans" accept=".pdf,.jpg,.jpeg,.png,.dwg"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 @error('site_plans') border-red-400 @enderror">
                            <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG, DWG (max 5MB)</p>
                            @error('site_plans')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Trade License -->
                        <div>
                            <label for="additional_documents" class="block text-sm font-medium text-slate-200 mb-2">
                                Trade License
                            </label>
                            <input type="file" name="additional_documents" id="additional_documents" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 @error('additional_documents') border-red-400 @enderror">
                            <p class="mt-1 text-xs text-slate-400">PDF, DOC, Images (max 5MB)</p>
                            @error('additional_documents')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Consent & Agreement Section -->
                <div class="border-t border-gray-200 pt-8">
                    <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 mb-6 border border-white/10">
                        <h4 class="text-lg font-semibold text-slate-200 mb-4">Consent & Agreement</h4>
                        
                        <div class="space-y-4 text-sm">
                            <p class="font-medium text-white">
                                By submitting this Client Registration Form, I hereby acknowledge and agree to the following terms:
                            </p>
                            
                            <div class="space-y-4">
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">1. Accuracy of Information</h5>
                                    <p class="text-white">I affirm that all information provided in this application is true, accurate, and complete to the best of my knowledge.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">2. Verification & Due Diligence</h5>
                                    <p class="text-white">I authorize the Company to verify any information provided, including conducting background, financial, or compliance checks as deemed necessary.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">3. Consequences of Misrepresentation</h5>
                                    <p class="text-white">I understand that providing false, incomplete, or misleading information may result in disqualification from the client registration process or termination of any existing engagement.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">4. Data Privacy & Protection</h5>
                                    <p class="text-white">I consent to the collection, processing, and secure storage of my personal and business data in accordance with applicable data protection and privacy laws.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">5. Confidentiality</h5>
                                    <p class="text-white">I agree to maintain the confidentiality of any proprietary, sensitive, or privileged information shared with me during the registration or evaluation process.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">6. No Guarantee of Service</h5>
                                    <p class="text-white">I understand that submission of this form does not constitute an offer, contract, or guarantee of acceptance as an approved client or provision of services.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">7. Compliance with Company Policies</h5>
                                    <p class="text-white">If accepted, I agree to comply with all applicable company policies, procedures, standards, and contractual obligations.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">8. Validity of Consent</h5>
                                    <p class="text-white">This consent shall remain valid until I withdraw it in writing or until the conclusion of the client registration process, whichever occurs first.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start mb-6">
                        <input type="checkbox" id="terms" name="terms" required
                               class="mt-1 h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="terms" class="ml-3 text-sm text-slate-200">
                            I have read and understood the above consent terms. I agree to the 
                            <a href="#" class="text-orange-400 hover:text-orange-300 underline">Terms of Service</a> 
                            and <a href="#" class="text-orange-400 hover:text-orange-300 underline">Privacy Policy</a>. 
                            I confirm that all information provided is accurate and complete. *
                        </label>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" 
                                class="bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-semibold py-4 px-8 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Submit Client Application
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Help Text -->
        <div class="mt-8 text-center">
            <p class="text-slate-300">
                Need help with your application? 
                 <a href="mailto:info@skylandconstruction.com" class="text-orange-400 hover:text-orange-300 underline">
                    Email our team
                </a>
                 or call us at 
                 <a href="tel:+97172435757" class="text-orange-400 hover:text-orange-300 underline">
                    +971 7243 5757
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
