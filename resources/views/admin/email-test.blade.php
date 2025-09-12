@extends('layouts.admin')

@section('title', 'Email Test')
@section('page-title', 'Email Configuration Test')

@section('admin-content')
<div class="max-w-4xl mx-auto">
    <!-- Email Configuration Info -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl mb-8">
        <div class="px-6 py-6 border-b border-white/20">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white font-['Inter',_'system-ui',_sans-serif]">
                        SMTP Configuration
                    </h3>
                    <p class="text-slate-300 text-sm mt-1">
                        Sky Land Construction Email Settings
                    </p>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-slate-400 text-sm">SMTP Server</div>
                        <div class="text-white font-semibold">smtp.office365.com</div>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-slate-400 text-sm">Port</div>
                        <div class="text-white font-semibold">587</div>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-slate-400 text-sm">Encryption</div>
                        <div class="text-white font-semibold">TLS/STARTTLS</div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-slate-400 text-sm">From Address</div>
                        <div class="text-white font-semibold">info@skylandconstruction.com</div>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-slate-400 text-sm">From Name</div>
                        <div class="text-white font-semibold">Sky Land Construction</div>
                    </div>
                    <div class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <div class="text-slate-400 text-sm">Authentication</div>
                        <div class="text-white font-semibold">SMTP Auth Enabled</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Test Connection -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl mb-8">
        <div class="px-6 py-6 border-b border-white/20">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white font-['Inter',_'system-ui',_sans-serif]">
                            Connection Test
                        </h3>
                        <p class="text-slate-300 text-sm mt-1">
                            Test SMTP connection without sending email
                        </p>
                    </div>
                </div>
                <button id="testConnectionBtn" 
                        class="group bg-emerald-500/30 hover:bg-emerald-500/40 text-emerald-200 hover:text-emerald-100 px-6 py-3 rounded-xl font-medium backdrop-blur-sm border border-emerald-400/30 hover:border-emerald-400/50 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2 inline group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Test Connection
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <div id="connectionResult" class="hidden"></div>
        </div>
    </div>

    <!-- Send Test Email -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl">
        <div class="px-6 py-6 border-b border-white/20">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-orange-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white font-['Inter',_'system-ui',_sans-serif]">
                        Send Test Email
                    </h3>
                    <p class="text-slate-300 text-sm mt-1">
                        Send a sample email to verify configuration
                    </p>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <form id="testEmailForm" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="test_email" class="block text-sm font-medium text-slate-200 mb-2">
                            Email Address *
                        </label>
                        <input type="email" 
                               name="email" 
                               id="test_email" 
                               required
                               placeholder="Enter email address to test"
                               class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg">
                    </div>
                    
                    <div>
                        <label for="test_name" class="block text-sm font-medium text-slate-200 mb-2">
                            Recipient Name (Optional)
                        </label>
                        <input type="text" 
                               name="name" 
                               id="test_name" 
                               placeholder="Test User"
                               class="w-full px-4 py-3 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-white/50 focus:bg-white/15 transition-all duration-300 shadow-lg">
                    </div>
                </div>
                
                <div class="flex justify-center">
                    <button type="submit" 
                            id="sendTestBtn"
                            class="group bg-gradient-to-r from-orange-500/30 to-red-500/30 hover:from-orange-500/40 hover:to-red-500/40 text-white px-8 py-4 rounded-xl font-medium backdrop-blur-sm border border-orange-400/30 hover:border-orange-400/50 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2 inline group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Send Test Email
                    </button>
                </div>
            </form>
            
            <div id="emailResult" class="hidden mt-6"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Test Connection
    document.getElementById('testConnectionBtn').addEventListener('click', function() {
        const btn = this;
        const resultDiv = document.getElementById('connectionResult');
        
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="w-5 h-5 mr-2 inline animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Testing...
        `;
        
        fetch('/admin/email/test-connection', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            resultDiv.className = 'block';
            if (data.success) {
                resultDiv.innerHTML = `
                    <div class="bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 text-emerald-200 px-6 py-4 rounded-xl shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold">Connection Successful!</div>
                                <div class="text-sm opacity-90">${data.message}</div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="bg-red-500/20 backdrop-blur-md border border-red-400/30 text-red-200 px-6 py-4 rounded-xl shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold">Connection Failed</div>
                                <div class="text-sm opacity-90">${data.error}</div>
                            </div>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            resultDiv.className = 'block';
            resultDiv.innerHTML = `
                <div class="bg-red-500/20 backdrop-blur-md border border-red-400/30 text-red-200 px-6 py-4 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">Connection Error</div>
                            <div class="text-sm opacity-90">Network error occurred</div>
                        </div>
                    </div>
                </div>
            `;
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = `
                <svg class="w-5 h-5 mr-2 inline group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Test Connection
            `;
        });
    });

    // Send Test Email
    document.getElementById('testEmailForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('sendTestBtn');
        const resultDiv = document.getElementById('emailResult');
        const formData = new FormData(this);
        
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="w-5 h-5 mr-2 inline animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Sending...
        `;
        
        fetch('/admin/email/send-test', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            resultDiv.className = 'block mt-6';
            if (data.success) {
                resultDiv.innerHTML = `
                    <div class="bg-emerald-500/20 backdrop-blur-md border border-emerald-400/30 text-emerald-200 px-6 py-4 rounded-xl shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold">Email Sent Successfully!</div>
                                <div class="text-sm opacity-90">Test email sent to ${data.data.email}</div>
                                <div class="text-sm opacity-90">Sent at: ${data.data.sent_at}</div>
                            </div>
                        </div>
                    </div>
                `;
                // Clear form
                document.getElementById('test_email').value = '';
                document.getElementById('test_name').value = '';
            } else {
                resultDiv.innerHTML = `
                    <div class="bg-red-500/20 backdrop-blur-md border border-red-400/30 text-red-200 px-6 py-4 rounded-xl shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <div class="font-semibold">Email Failed</div>
                                <div class="text-sm opacity-90">${data.error}</div>
                            </div>
                        </div>
                    </div>
                `;
            }
        })
        .catch(error => {
            resultDiv.className = 'block mt-6';
            resultDiv.innerHTML = `
                <div class="bg-red-500/20 backdrop-blur-md border border-red-400/30 text-red-200 px-6 py-4 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <div class="font-semibold">Network Error</div>
                            <div class="text-sm opacity-90">Failed to send request</div>
                        </div>
                    </div>
                </div>
            `;
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = `
                <svg class="w-5 h-5 mr-2 inline group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                Send Test Email
            `;
        });
    });
});
</script>
@endsection
