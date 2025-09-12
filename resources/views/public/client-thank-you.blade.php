@extends('layouts.app')

@section('title', 'Thank You - Client Registration')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Success Icon -->
        <div class="mx-auto flex items-center justify-center h-32 w-32 rounded-full bg-gradient-to-r from-purple-400 to-pink-500 mb-8">
            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-xl px-8 py-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                🎉 Welcome to Our Client Family!
            </h1>
            
            <div class="text-xl text-gray-600 mb-8">
                Thank you for registering with us, <strong class="text-gray-900">{{ $client->full_name }}</strong>!
            </div>

            <!-- Registration Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Registration Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Registration ID:</span>
                        <span class="font-medium text-gray-900 ml-2">#CLT{{ str_pad($client->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Date:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $client->created_at->format('F j, Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Client Type:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $client->client_type }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500">Email:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $client->email }}</span>
                    </div>
                    @if($client->org_name)
                    <div class="md:col-span-2">
                        <span class="text-gray-500">Organization:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $client->org_name }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- What Happens Next -->
            <div class="text-left mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">What Happens Next?</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-purple-600 font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Application Review</h4>
                            <p class="text-gray-600 text-sm">Our team will review your registration and project requirements within 24-48 hours.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-purple-600 font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Initial Consultation</h4>
                            <p class="text-gray-600 text-sm">We'll schedule a consultation call to understand your needs better and discuss next steps.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-purple-600 font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Proposal & Collaboration</h4>
                            <p class="text-gray-600 text-sm">You'll receive a detailed proposal and we'll begin our collaborative journey together.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Information -->
            @if($client->core_services)
            <div class="bg-purple-50 rounded-lg p-6 mb-8 text-left">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Services You're Interested In</h3>
                <p class="text-gray-700 text-sm">{{ $client->core_services }}</p>
            </div>
            @endif

            <!-- Contact Information -->
            <div class="bg-purple-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Get In Touch</h3>
                <p class="text-gray-600 text-sm mb-4">
                    Our team is here to help you succeed. Feel free to reach out if you have any questions or need immediate assistance.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:info@skylandconstruction.com" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Email Our Team
                    </a>
                    <a href="tel:+97172435757" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-pink-600 text-white text-sm font-medium rounded-lg hover:bg-pink-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Schedule a Call
                    </a>
                </div>
            </div>

            <!-- Follow-up Information -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8 text-left">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">💡 Pro Tips for New Clients</h3>
                <ul class="text-sm text-gray-700 space-y-2">
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2">•</span>
                        Keep your contact information updated for smooth communication
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2">•</span>
                        Prepare any additional project documents or requirements you may have
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2">•</span>
                        Check your email regularly for updates and important communications
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-500 mr-2">•</span>
                        Feel free to reach out with questions - we're here to help you succeed
                    </li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('client.register') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Register Another Project
                </a>
                <a href="{{ route('vendor.register') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Become a Vendor
                </a>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 text-sm text-gray-600">
            <p>
                Welcome to our community! We're excited to work with you and help bring your projects to life. 
                Your success is our priority, and we're committed to providing exceptional service.
            </p>
        </div>
    </div>
</div>
@endsection
