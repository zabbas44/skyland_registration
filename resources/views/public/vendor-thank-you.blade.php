@extends('layouts.app')

@section('title', 'Thank You - Vendor Registration')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Success Icon -->
        <div class="mx-auto flex items-center justify-center h-32 w-32 rounded-full bg-gradient-to-r from-green-400 to-blue-500 mb-8">
            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-xl px-8 py-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                🎉 Registration Successful!
            </h1>
            
            <div class="text-xl text-gray-600 mb-8">
                Thank you for registering as a vendor with us, <strong class="text-gray-900">{{ $vendor->first_name }} {{ $vendor->last_name }}</strong>!
            </div>

            <!-- Registration Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Registration Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Registration ID:</span>
                        <span class="font-medium text-gray-900 ml-2">#VND{{ str_pad($vendor->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Date:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $vendor->created_at->format('F j, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Company:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $vendor->company_name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Contact Email:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $vendor->contact_email }}</span>
                    </div>
                </div>
            </div>

            <!-- What Happens Next -->
            <div class="text-left mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">What Happens Next?</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-blue-600 font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Application Review</h4>
                            <p class="text-gray-600 text-sm">Our team will review your vendor application within 2-3 business days.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-blue-600 font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Verification Process</h4>
                            <p class="text-gray-600 text-sm">We may contact you for additional information or document verification.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-blue-600 font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Approval & Onboarding</h4>
                            <p class="text-gray-600 text-sm">Once approved, you'll receive access to our vendor portal and partnership details.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Need Assistance?</h3>
                <p class="text-gray-600 text-sm mb-4">
                    If you have any questions about your application or need to update any information, please don't hesitate to contact us.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:info@skylandconstruction.com" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Our Team
                    </a>
                    <a href="tel:+97172435757" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Schedule a Call
                    </a>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('vendor.register') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Register Another Vendor
                </a>
                <a href="{{ route('client.register') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Register as Client
                </a>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 text-sm text-gray-600">
            <p>
                We value partnerships and look forward to working with quality vendors like you. 
                Your registration helps us maintain a diverse and capable vendor network.
            </p>
        </div>
    </div>
</div>
@endsection
