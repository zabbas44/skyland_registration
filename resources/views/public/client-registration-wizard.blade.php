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
                <div class="flex items-center space-x-4 w-full">
                    <!-- Step 1 - Account -->
                    <div class="flex items-center step-indicator" data-step="1">
                        <div class="w-8 h-8 step-circle bg-teal-500 rounded-full flex items-center justify-center text-white text-sm font-semibold transition-all duration-300">1</div>
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
            <div class="w-full bg-slate-700 h-1 rounded-full">
                <div id="progress-bar" class="bg-gradient-to-r from-teal-500 to-teal-400 h-1 rounded-full transition-all duration-500" style="width: 16.67%"></div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-slate-800 rounded-lg shadow-xl">
            <form id="wizard-form" method="POST" action="{{ route('client.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <!-- Honeypot Field -->
                <div class="hidden">
                    <label for="website">Do not fill this field</label>
                    <input type="text" name="website" id="website" value="" class="w-full">
                </div>

                <!-- Step 1: Account -->
                <div class="step-content active" data-step="1">
                    <h2 class="text-xl font-semibold text-teal-400 mb-6">Account Information</h2>
                    
                    <div class="space-y-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">
                                Email Address *
                            </label>
                            <input type="email" name="email" id="email" required
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('email') border-red-400 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">
                                Password *
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('password') border-red-400 @enderror">
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-2">
                                Confirm Password *
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Client & Company -->
                <div class="step-content" data-step="2">
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

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-300 mb-2">
                                Phone Number *
                            </label>
                            <input type="tel" name="phone" id="phone" required
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 @error('phone') border-red-400 @enderror">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 3: Project -->
                <div class="step-content" data-step="3">
                    <h2 class="text-xl font-semibold text-teal-400 mb-6">Project Requirements</h2>
                    
                    <div class="space-y-6">
                        <!-- Project Type -->
                        <div>
                            <label for="project_type" class="block text-sm font-medium text-slate-300 mb-2">
                                Project Type *
                            </label>
                            <select name="project_type" id="project_type" required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                                <option value="">Select Project Type</option>
                                <option value="residential_villa">Residential Villa</option>
                                <option value="commercial_retail">Commercial Retail</option>
                                <option value="industrial_warehouse">Industrial Warehouse</option>
                                <option value="fitout_renovation">Fit-out Renovation</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <!-- Service Needed -->
                        <div>
                            <label for="service_needed" class="block text-sm font-medium text-slate-300 mb-2">
                                Service Needed *
                            </label>
                            <select name="service_needed" id="service_needed" required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                                <option value="">Select Service Needed</option>
                                <option value="design_approval">Design Approval</option>
                                <option value="civil_construction">Civil Construction</option>
                                <option value="mep_works">MEP Works</option>
                                <option value="interior_joinery">Interior and Joinery</option>
                                <option value="landscaping">Landscaping</option>
                                <option value="maintenance_amc">Maintenance AMC</option>
                            </select>
                        </div>

                        <!-- Estimated Budget -->
                        <div>
                            <label for="estimated_budget" class="block text-sm font-medium text-slate-300 mb-2">
                                Estimated Budget *
                            </label>
                            <select name="estimated_budget" id="estimated_budget" required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">
                                <option value="">Select Budget Range</option>
                                <option value="under_50k">Under AED 50,000</option>
                                <option value="50k_100k">AED 50,000 - 100,000</option>
                                <option value="100k_250k">AED 100,000 - 250,000</option>
                                <option value="250k_500k">AED 250,000 - 500,000</option>
                                <option value="500k_1m">AED 500,000 - 1,000,000</option>
                                <option value="1m_5m">AED 1,000,000 - 5,000,000</option>
                                <option value="over_5m">Over AED 5,000,000</option>
                            </select>
                        </div>

                        <!-- Project Brief -->
                        <div>
                            <label for="project_brief" class="block text-sm font-medium text-slate-300 mb-2">
                                Project Brief *
                            </label>
                            <textarea name="project_brief" id="project_brief" rows="4" required
                                      placeholder="Please describe your project requirements, goals, and any specific details..."
                                      class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200">{{ old('project_brief') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Attachments -->
                <div class="step-content" data-step="4">
                    <h2 class="text-xl font-semibold text-teal-400 mb-6">Attachments (Optional)</h2>
                    
                    <div class="space-y-6">
                        <!-- Site Plans -->
                        <div>
                            <label for="site_plans" class="block text-sm font-medium text-slate-300 mb-2">
                                Site Plans
                            </label>
                            <input type="file" name="site_plans" id="site_plans" accept=".pdf,.jpg,.jpeg,.png,.dwg"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-slate-400">PDF, JPG, PNG, DWG (max 5MB)</p>
                        </div>

                        <!-- Additional Documents -->
                        <div>
                            <label for="additional_documents" class="block text-sm font-medium text-slate-300 mb-2">
                                Additional Documents
                            </label>
                            <input type="file" name="additional_documents" id="additional_documents" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                   class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-1 text-xs text-slate-400">PDF, DOC, Images (max 5MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Consents -->
                <div class="step-content" data-step="5">
                    <h2 class="text-xl font-semibold text-teal-400 mb-6">Consents & Agreements</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-slate-700 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-slate-200 mb-4">Terms & Conditions</h4>
                            
                            <div class="space-y-4 text-sm">
                                <p class="text-slate-300">
                                    By submitting this Client Registration Form, I hereby acknowledge and agree to the following terms:
                                </p>
                                
                                <div class="space-y-3 max-h-60 overflow-y-auto">
                                    <div>
                                        <h5 class="font-bold mb-1 text-teal-400">1. Accuracy of Information</h5>
                                        <p class="text-slate-300">I affirm that all information provided in this application is true, accurate, and complete to the best of my knowledge.</p>
                                    </div>
                                    
                                    <div>
                                        <h5 class="font-bold mb-1 text-teal-400">2. Verification & Due Diligence</h5>
                                        <p class="text-slate-300">I authorize the Company to verify any information provided, including conducting background, financial, or compliance checks as deemed necessary.</p>
                                    </div>
                                    
                                    <div>
                                        <h5 class="font-bold mb-1 text-teal-400">3. Data Privacy & Protection</h5>
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
                                <a href="#" class="text-teal-400 hover:text-teal-300 underline">Terms of Service</a> 
                                and <a href="#" class="text-teal-400 hover:text-teal-300 underline">Privacy Policy</a>. 
                                I confirm that all information provided is accurate and complete. *
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Review -->
                <div class="step-content" data-step="6">
                    <h2 class="text-xl font-semibold text-teal-400 mb-6">Review & Submit</h2>
                    
                    <div class="space-y-6">
                        <div class="bg-slate-700 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-slate-200 mb-4">Registration Summary</h4>
                            <p class="text-slate-300">Please review your information before submitting your registration.</p>
                        </div>

                        <div class="bg-green-900/20 border border-green-500/30 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-lg font-medium text-green-400">Ready to Submit</h3>
                                    <p class="text-green-300">Your registration is complete and ready for submission.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-slate-700 mt-8">
                    <!-- Save Draft -->
                    <button type="button" id="save-draft" class="px-6 py-2 bg-slate-700 text-slate-300 rounded-lg hover:bg-slate-600 transition-colors duration-200">
                        Save Draft
                    </button>

                    <!-- Navigation -->
                    <div class="flex space-x-4">
                        <button type="button" id="prev-btn" class="px-6 py-2 bg-slate-700 text-white rounded-lg hover:bg-slate-600 transition-colors duration-200 hidden">
                            Back
                        </button>
                        <button type="button" id="next-btn" class="px-6 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition-colors duration-200">
                            Next
                        </button>
                        <button type="submit" id="submit-btn" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hidden">
                            Submit Registration
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
    background-color: #14b8a6 !important;
    color: white !important;
    transform: scale(1.1);
}

.step-circle.active {
    background-color: #14b8a6 !important;
    color: white !important;
    border: 2px solid #5eead4;
    box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.2);
}

.step-connector.completed {
    background-color: #14b8a6 !important;
}

.step-label.completed {
    color: #14b8a6 !important;
}

.step-label.active {
    color: #5eead4 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 6;
    
    const nextBtn = document.getElementById('next-btn');
    const prevBtn = document.getElementById('prev-btn');
    const submitBtn = document.getElementById('submit-btn');
    const progressBar = document.getElementById('progress-bar');
    
    // Initialize first step
    updateStepDisplay();
    
    nextBtn.addEventListener('click', function() {
        if (validateCurrentStep()) {
            if (currentStep < totalSteps) {
                animateToNextStep();
            }
        }
    });
    
    prevBtn.addEventListener('click', function() {
        if (currentStep > 1) {
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
        }, 150);
    }
    
    function updateStepDisplay() {
        // Update progress bar
        const progressPercentage = (currentStep / totalSteps) * 100;
        progressBar.style.width = progressPercentage + '%';
        
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
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }
        
        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
        }
    }
    
    function validateCurrentStep() {
        const currentStepElement = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        const requiredFields = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
        
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
                
                // Remove error styling after user starts typing
                field.addEventListener('input', function() {
                    this.classList.remove('border-red-500');
                }, { once: true });
            } else {
                field.classList.remove('border-red-500');
            }
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
        
        return isValid;
    }
    
    // Save draft functionality
    document.getElementById('save-draft').addEventListener('click', function() {
        // Here you would typically save the current form data to local storage or send to server
        alert('Draft saved successfully!');
    });
});
</script>

@endsection
