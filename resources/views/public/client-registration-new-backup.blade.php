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
                            <label for="registration_number" class="block text-sm font-medium text-slate-200 mb-2">
                                Registration Number
                            </label>
                            <input type="text" name="registration_number" id="registration_number"
                                   value="{{ old('registration_number') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('registration_number') border-red-400 @enderror">
                            @error('registration_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ID Type -->
                        <div>
                            <label for="id_type" class="block text-sm font-medium text-slate-200 mb-2">
                                ID Type *
                            </label>
                            <select name="id_type" id="id_type" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('id_type') border-red-400 @enderror">
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
                        <div class="md:col-span-2">
                            <label for="id_number" class="block text-sm font-medium text-slate-200 mb-2">
                                ID/License Number *
                            </label>
                            <input type="text" name="id_number" id="id_number" required
                                   value="{{ old('id_number') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('id_number') border-red-400 @enderror">
                            @error('id_number')
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
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('project_type') border-red-400 @enderror">
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
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('service_needed') border-red-400 @enderror">
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
                        <div class="md:col-span-2">
                            <label for="estimated_budget" class="block text-sm font-medium text-slate-200 mb-2">
                                Estimated Budget *
                            </label>
                            <select name="estimated_budget" id="estimated_budget" required
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('estimated_budget') border-red-400 @enderror">
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
                    </div>
                </div>

                <!-- Address Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Address</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Street -->
                        <div>
                            <label for="street" class="block text-sm font-medium text-slate-200 mb-2">
                                Street *
                            </label>
                            <input type="text" name="street" id="street" required
                                   value="{{ old('street') }}"
                                   placeholder="Street Name"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('street') border-red-400 @enderror">
                            @error('street')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Community -->
                        <div>
                            <label for="community" class="block text-sm font-medium text-slate-200 mb-2">
                                Community *
                            </label>
                            <input type="text" name="community" id="community" required
                                   value="{{ old('community') }}"
                                   placeholder="Community Name"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('community') border-red-400 @enderror">
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
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('emirate') border-red-400 @enderror">
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
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('plot_unit_number') border-red-400 @enderror">
                            @error('plot_unit_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Timeline</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Target Start Date -->
                        <div>
                            <label for="target_start_date" class="block text-sm font-medium text-slate-200 mb-2">
                                Target Start Date *
                            </label>
                            <input type="date" name="target_start_date" id="target_start_date" required
                                   value="{{ old('target_start_date') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('target_start_date') border-red-400 @enderror">
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
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('desired_timeline') border-red-400 @enderror">
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
                                      class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('project_brief') border-red-400 @enderror">{{ old('project_brief') }}</textarea>
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
                            <span class="text-white font-bold text-sm">5</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Attachments</h3>
                        <span class="ml-2 text-sm text-slate-400">(Optional)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Site Plans -->
                        <div>
                            <label for="site_plans" class="block text-sm font-medium text-slate-200 mb-2">
                                Site Plans
                            </label>
                            <input type="file" name="site_plans" id="site_plans" accept=".pdf,.jpg,.jpeg,.png,.dwg"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 @error('site_plans') border-red-400 @enderror">
                            <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG, DWG (max 5MB)</p>
                            @error('site_plans')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Documents -->
                        <div>
                            <label for="additional_documents" class="block text-sm font-medium text-slate-200 mb-2">
                                Additional Documents
                            </label>
                            <input type="file" name="additional_documents" id="additional_documents" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 @error('additional_documents') border-red-400 @enderror">
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
                               class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="terms" class="ml-3 text-sm text-slate-200">
                            I have read and understood the above consent terms. I agree to the 
                            <a href="#" class="text-blue-600 hover:text-blue-500 underline">Terms of Service</a> 
                            and <a href="#" class="text-blue-600 hover:text-blue-500 underline">Privacy Policy</a>. 
                            I confirm that all information provided is accurate and complete. *
                        </label>
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
                        Need help? Email <a href="mailto:info@skylandconstruction.com" class="text-teal-400 hover:text-teal-300">info@skylandconstruction.com</a>
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
