@extends('layouts.app')

@section('title', 'Supplier Registration')

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
            <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight font-['Inter',_'system-ui',_sans-serif]">Vendor Registration</h1>
            <p class="text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Become a part of our trusted vendor network and unlock new business opportunities with <span class="text-orange-400">Sky Land Construction</span>. Kindly complete the form below with accurate and up-to-date information.
            </p>
        </div>

        <!-- Form Container -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <div class="px-8 py-6 backdrop-blur-sm border-b border-white/10">
                <h2 class="text-2xl font-semibold text-white">Supplier Application Form</h2>
                <p class="text-slate-300 mt-2">Please complete all required fields marked with *</p>
            </div>

            <form method="POST" action="{{ route('supplier.store') }}" enctype="multipart/form-data" class="px-8 py-6">
                @csrf

                <!-- Contact Information Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Contact Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-slate-200 mb-2">
                                First Name *
                            </label>
                            <input type="text" name="first_name" id="first_name" required maxlength="50"
                                   value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('first_name') border-red-400 @enderror">
                            @error('first_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-slate-200 mb-2">
                                Last Name *
                            </label>
                            <input type="text" name="last_name" id="last_name" required maxlength="50"
                                   value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('last_name') border-red-400 @enderror">
                            @error('last_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-slate-200 mb-2">
                                Email Address *
                            </label>
                            <input type="email" name="contact_email" id="contact_email" required
                                   value="{{ old('contact_email') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('contact_email') border-red-400 @enderror">
                            @error('contact_email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_mobile" class="block text-sm font-medium text-slate-200 mb-2">
                                Mobile Number *
                            </label>
                            <div class="flex">
                                <select name="contact_mobile_country" id="contact_mobile_country" required
                                        class="w-24 px-3 py-3 bg-white/10 backdrop-blur-md border border-r-0 border-white/30 rounded-l-xl text-slate-200 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg text-sm @error('contact_mobile') border-red-400 @enderror">
                                    <option value="+971" {{ old('contact_mobile_country', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                    <option value="+1" {{ old('contact_mobile_country') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                    <option value="+44" {{ old('contact_mobile_country') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                    <option value="+91" {{ old('contact_mobile_country') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                    <option value="+86" {{ old('contact_mobile_country') === '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                    <option value="+33" {{ old('contact_mobile_country') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                    <option value="+49" {{ old('contact_mobile_country') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                    <option value="+81" {{ old('contact_mobile_country') === '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                    <option value="+82" {{ old('contact_mobile_country') === '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                    <option value="+61" {{ old('contact_mobile_country') === '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                    <option value="+55" {{ old('contact_mobile_country') === '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                    <option value="+7" {{ old('contact_mobile_country') === '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                    <option value="+34" {{ old('contact_mobile_country') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                    <option value="+39" {{ old('contact_mobile_country') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                    <option value="+31" {{ old('contact_mobile_country') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                    <option value="+41" {{ old('contact_mobile_country') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                    <option value="+46" {{ old('contact_mobile_country') === '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                    <option value="+47" {{ old('contact_mobile_country') === '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                    <option value="+45" {{ old('contact_mobile_country') === '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                    <option value="+90" {{ old('contact_mobile_country') === '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                    <option value="+966" {{ old('contact_mobile_country') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                    <option value="+965" {{ old('contact_mobile_country') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                    <option value="+974" {{ old('contact_mobile_country') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                    <option value="+973" {{ old('contact_mobile_country') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                    <option value="+968" {{ old('contact_mobile_country') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                    <option value="+962" {{ old('contact_mobile_country') === '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                    <option value="+961" {{ old('contact_mobile_country') === '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                    <option value="+20" {{ old('contact_mobile_country') === '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                    <option value="+60" {{ old('contact_mobile_country') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                    <option value="+65" {{ old('contact_mobile_country') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                    <option value="+66" {{ old('contact_mobile_country') === '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                    <option value="+84" {{ old('contact_mobile_country') === '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                    <option value="+63" {{ old('contact_mobile_country') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                    <option value="+62" {{ old('contact_mobile_country') === '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                </select>
                                <input type="text" name="contact_mobile" id="contact_mobile" required
                                       value="{{ old('contact_mobile') }}"
                                       placeholder="555 123 4567"
                                       class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-md border border-l-0 border-white/30 rounded-r-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('contact_mobile') border-red-400 @enderror">
                            </div>
                            @error('contact_mobile')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="office_landline" class="block text-sm font-medium text-slate-200 mb-2">
                                Office LandLine Number *
                            </label>
                            <div class="flex">
                                <select name="office_landline_country" id="office_landline_country" required
                                        class="w-24 px-3 py-3 bg-white/10 backdrop-blur-md border border-r-0 border-white/30 rounded-l-xl text-slate-200 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg text-sm @error('office_landline') border-red-400 @enderror">
                                    <option value="+971" {{ old('office_landline_country', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                    <option value="+1" {{ old('office_landline_country') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                    <option value="+44" {{ old('office_landline_country') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                    <option value="+91" {{ old('office_landline_country') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                    <option value="+86" {{ old('office_landline_country') === '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                    <option value="+33" {{ old('office_landline_country') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                    <option value="+49" {{ old('office_landline_country') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                    <option value="+81" {{ old('office_landline_country') === '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                    <option value="+82" {{ old('office_landline_country') === '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                    <option value="+61" {{ old('office_landline_country') === '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                    <option value="+55" {{ old('office_landline_country') === '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                    <option value="+7" {{ old('office_landline_country') === '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                    <option value="+34" {{ old('office_landline_country') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                    <option value="+39" {{ old('office_landline_country') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                    <option value="+31" {{ old('office_landline_country') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                    <option value="+41" {{ old('office_landline_country') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                    <option value="+46" {{ old('office_landline_country') === '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                    <option value="+47" {{ old('office_landline_country') === '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                    <option value="+45" {{ old('office_landline_country') === '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                    <option value="+90" {{ old('office_landline_country') === '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                    <option value="+966" {{ old('office_landline_country') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                    <option value="+965" {{ old('office_landline_country') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                    <option value="+974" {{ old('office_landline_country') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                    <option value="+973" {{ old('office_landline_country') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                    <option value="+968" {{ old('office_landline_country') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                    <option value="+962" {{ old('office_landline_country') === '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                    <option value="+961" {{ old('office_landline_country') === '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                    <option value="+20" {{ old('office_landline_country') === '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                    <option value="+60" {{ old('office_landline_country') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                    <option value="+65" {{ old('office_landline_country') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                    <option value="+66" {{ old('office_landline_country') === '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                    <option value="+84" {{ old('office_landline_country') === '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                    <option value="+63" {{ old('office_landline_country') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                    <option value="+62" {{ old('office_landline_country') === '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                </select>
                                <input type="text" name="office_landline" id="office_landline" required
                                       value="{{ old('office_landline') }}"
                                       placeholder="4 555 4567"
                                       class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-md border border-l-0 border-white/30 rounded-r-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('office_landline') border-red-400 @enderror">
                            </div>
                            @error('office_landline')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_designation" class="block text-sm font-medium text-slate-200 mb-2">
                                Designation
                            </label>
                            <input type="text" name="contact_designation" id="contact_designation"
                                   value="{{ old('contact_designation') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('contact_designation') border-red-400 @enderror">
                            @error('contact_designation')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Company Information Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Company Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Name *
                            </label>
                            <input type="text" name="company_name" id="company_name" required
                                   value="{{ old('company_name') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_name') border-red-400 @enderror">
                            @error('company_name')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="business_type" class="block text-sm font-medium text-slate-200 mb-2">
                                Business Type
                            </label>
                            <select name="business_type" id="business_type"
                                    class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('business_type') border-red-400 @enderror">
                                <option value="">Select Business Type</option>
                                <option value="Sole Proprietorship" {{ old('business_type') === 'Sole Proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                                <option value="Partnership" {{ old('business_type') === 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                <option value="LLC" {{ old('business_type') === 'LLC' ? 'selected' : '' }}>LLC</option>
                                <option value="Corporation" {{ old('business_type') === 'Corporation' ? 'selected' : '' }}>Corporation</option>
                                <option value="Non-Profit" {{ old('business_type') === 'Non-Profit' ? 'selected' : '' }}>Non-Profit</option>
                                <option value="Other" {{ old('business_type') === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('business_type')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_contact_person" class="block text-sm font-medium text-slate-200 mb-2">
                                Contact Person *
                            </label>
                            <input type="text" name="company_contact_person" id="company_contact_person" required
                                   value="{{ old('company_contact_person') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_contact_person') border-red-400 @enderror">
                            @error('company_contact_person')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_email" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Email *
                            </label>
                            <input type="email" name="company_email" id="company_email" required
                                   value="{{ old('company_email') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_email') border-red-400 @enderror">
                            @error('company_email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_website" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Website
                            </label>
                            <input type="url" name="company_website" id="company_website"
                                   value="{{ old('company_website') }}"
                                   placeholder="https://www.example.com"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_website') border-red-400 @enderror">
                            @error('company_website')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_phone" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Phone *
                            </label>
                            <div class="flex">
                                <select name="company_phone_country" id="company_phone_country" required
                                        class="w-24 px-3 py-3 bg-white/10 backdrop-blur-md border border-r-0 border-white/30 rounded-l-xl text-slate-200 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg text-sm @error('company_phone') border-red-400 @enderror">
                                    <option value="+971" {{ old('company_phone_country', '+971') === '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                    <option value="+1" {{ old('company_phone_country') === '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                                    <option value="+44" {{ old('company_phone_country') === '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                    <option value="+91" {{ old('company_phone_country') === '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                    <option value="+86" {{ old('company_phone_country') === '+86' ? 'selected' : '' }}>🇨🇳 +86</option>
                                    <option value="+33" {{ old('company_phone_country') === '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                                    <option value="+49" {{ old('company_phone_country') === '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                                    <option value="+81" {{ old('company_phone_country') === '+81' ? 'selected' : '' }}>🇯🇵 +81</option>
                                    <option value="+82" {{ old('company_phone_country') === '+82' ? 'selected' : '' }}>🇰🇷 +82</option>
                                    <option value="+61" {{ old('company_phone_country') === '+61' ? 'selected' : '' }}>🇦🇺 +61</option>
                                    <option value="+55" {{ old('company_phone_country') === '+55' ? 'selected' : '' }}>🇧🇷 +55</option>
                                    <option value="+7" {{ old('company_phone_country') === '+7' ? 'selected' : '' }}>🇷🇺 +7</option>
                                    <option value="+34" {{ old('company_phone_country') === '+34' ? 'selected' : '' }}>🇪🇸 +34</option>
                                    <option value="+39" {{ old('company_phone_country') === '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                                    <option value="+31" {{ old('company_phone_country') === '+31' ? 'selected' : '' }}>🇳🇱 +31</option>
                                    <option value="+41" {{ old('company_phone_country') === '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                                    <option value="+46" {{ old('company_phone_country') === '+46' ? 'selected' : '' }}>🇸🇪 +46</option>
                                    <option value="+47" {{ old('company_phone_country') === '+47' ? 'selected' : '' }}>🇳🇴 +47</option>
                                    <option value="+45" {{ old('company_phone_country') === '+45' ? 'selected' : '' }}>🇩🇰 +45</option>
                                    <option value="+90" {{ old('company_phone_country') === '+90' ? 'selected' : '' }}>🇹🇷 +90</option>
                                    <option value="+966" {{ old('company_phone_country') === '+966' ? 'selected' : '' }}>🇸🇦 +966</option>
                                    <option value="+965" {{ old('company_phone_country') === '+965' ? 'selected' : '' }}>🇰🇼 +965</option>
                                    <option value="+974" {{ old('company_phone_country') === '+974' ? 'selected' : '' }}>🇶🇦 +974</option>
                                    <option value="+973" {{ old('company_phone_country') === '+973' ? 'selected' : '' }}>🇧🇭 +973</option>
                                    <option value="+968" {{ old('company_phone_country') === '+968' ? 'selected' : '' }}>🇴🇲 +968</option>
                                    <option value="+962" {{ old('company_phone_country') === '+962' ? 'selected' : '' }}>🇯🇴 +962</option>
                                    <option value="+961" {{ old('company_phone_country') === '+961' ? 'selected' : '' }}>🇱🇧 +961</option>
                                    <option value="+20" {{ old('company_phone_country') === '+20' ? 'selected' : '' }}>🇪🇬 +20</option>
                                    <option value="+60" {{ old('company_phone_country') === '+60' ? 'selected' : '' }}>🇲🇾 +60</option>
                                    <option value="+65" {{ old('company_phone_country') === '+65' ? 'selected' : '' }}>🇸🇬 +65</option>
                                    <option value="+66" {{ old('company_phone_country') === '+66' ? 'selected' : '' }}>🇹🇭 +66</option>
                                    <option value="+84" {{ old('company_phone_country') === '+84' ? 'selected' : '' }}>🇻🇳 +84</option>
                                    <option value="+63" {{ old('company_phone_country') === '+63' ? 'selected' : '' }}>🇵🇭 +63</option>
                                    <option value="+62" {{ old('company_phone_country') === '+62' ? 'selected' : '' }}>🇮🇩 +62</option>
                                </select>
                                <input type="text" name="company_phone" id="company_phone" required
                                       value="{{ old('company_phone') }}"
                                       placeholder="555 123 4567"
                                       class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-md border border-l-0 border-white/30 rounded-r-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('company_phone') border-red-400 @enderror">
                            </div>
                            @error('company_phone')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="year_of_establishment" class="block text-sm font-medium text-slate-200 mb-2">
                                Year of Establishment
                            </label>
                            <input type="number" name="year_of_establishment" id="year_of_establishment" min="1800" max="{{ date('Y') }}"
                                   value="{{ old('year_of_establishment') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('year_of_establishment') border-red-400 @enderror">
                            @error('year_of_establishment')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="md:col-span-2">
                            <label for="nature_of_business" class="block text-sm font-medium text-slate-200 mb-2">
                                Nature of Business
                            </label>
                            <textarea name="nature_of_business" id="nature_of_business" rows="4"
                                      placeholder="Describe your business activities, products, and services..."
                                      class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('nature_of_business') border-red-400 @enderror">{{ old('nature_of_business') }}</textarea>
                            @error('nature_of_business')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Address *
                            </label>
                            <textarea name="address" id="address" rows="3" required
                                      placeholder="Enter your complete business address..."
                                      class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('address') border-red-400 @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Legal & Compliance Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Legal & Compliance</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="trade_license_number" class="block text-sm font-medium text-slate-200 mb-2">
                                Trade License Number
                            </label>
                            <input type="text" name="trade_license_number" id="trade_license_number"
                                   value="{{ old('trade_license_number') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('trade_license_number') border-red-400 @enderror">
                            @error('trade_license_number')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tax_id" class="block text-sm font-medium text-slate-200 mb-2">
                                Tax ID / VAT Number
                            </label>
                            <input type="text" name="tax_id" id="tax_id"
                                   value="{{ old('tax_id') }}"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg @error('tax_id') border-red-400 @enderror">
                            @error('tax_id')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Document Upload Section -->
                <div class="mb-10 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl flex items-center justify-center mr-4 shadow-lg" style="background-color: #051538">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Document Upload</h3>
                        <span class="ml-2 text-sm text-red-400">(Required*)</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="business_license" class="block text-sm font-medium text-slate-200 mb-2">
                                Business License *
                            </label>
                            <input type="file" name="business_license" id="business_license" accept=".pdf,.jpg,.jpeg,.png" required
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('business_license') border-red-400 @enderror">
                            <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (max 2MB)</p>
                            @error('business_license')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tax_certificate" class="block text-sm font-medium text-slate-200 mb-2">
                                VAT Certificate *
                            </label>
                            <input type="file" name="tax_certificate" id="tax_certificate" accept=".pdf,.jpg,.jpeg,.png" required
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('tax_certificate') border-red-400 @enderror">
                            <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (max 2MB)</p>
                            @error('tax_certificate')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="company_profile" class="block text-sm font-medium text-slate-200 mb-2">
                                Company Profile
                            </label>
                            <input type="file" name="company_profile" id="company_profile" accept=".pdf,.doc,.docx"
                                   class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-slate-200 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('company_profile') border-red-400 @enderror">
                            <p class="mt-1 text-xs text-gray-500">PDF, DOC, DOCX (max 5MB)</p>
                            @error('company_profile')
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
                                By submitting this Vendor Registration Form, I hereby acknowledge and agree to the following terms:
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
                                    <p class="text-white">I understand that providing false, incomplete, or misleading information may result in disqualification from the vendor registration process or termination of any existing engagement.</p>
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
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">6. No Guarantee of Engagement</h5>
                                    <p class="text-white">I understand that submission of this form does not constitute an offer, contract, or guarantee of acceptance as an approved vendor.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">7. Compliance with Company Policies</h5>
                                    <p class="text-white">If accepted, I agree to comply with all applicable company policies, procedures, standards, and contractual obligations.</p>
                                </div>
                                
                                <div>
                                    <h5 class="font-bold mb-1" style="color: #ff5e15 !important;">8. Validity of Consent</h5>
                                    <p class="text-white">This consent shall remain valid until I withdraw it in writing or until the conclusion of the vendor registration process, whichever occurs first.</p>
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

                    <div class="flex justify-center">
                        <button type="submit" 
                                class="bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-semibold py-4 px-8 rounded-lg transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Submit Vendor Application
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Help Text -->
        <div class="mt-8 text-center">
            <p class="text-slate-300">
                Need help with your application? 
                <a href="mailto:info@skylandconstruction.com" class="text-cyan-400 hover:text-cyan-300 underline">
                    Email our team
                </a>
                 or call us at 
                <a href="tel:+97172435757" class="text-cyan-400 hover:text-cyan-300 underline">
                    +971 7243 5757
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    // Auto-fill company contact person if same as contact person
    document.addEventListener('DOMContentLoaded', function() {
        const firstName = document.getElementById('first_name');
        const lastName = document.getElementById('last_name');
        const companyContactPerson = document.getElementById('company_contact_person');
        
        function updateCompanyContact() {
            if (firstName.value && lastName.value && !companyContactPerson.value) {
                companyContactPerson.value = firstName.value + ' ' + lastName.value;
            }
        }
        
        firstName.addEventListener('blur', updateCompanyContact);
        lastName.addEventListener('blur', updateCompanyContact);
    });
</script>
@endsection
