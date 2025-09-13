<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Email Conversations - SKYLAND</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Email background gradient */
        .email-bg {
            background: linear-gradient(135deg, 
                rgba(74, 144, 226, 0.1) 0%, 
                rgba(80, 200, 120, 0.1) 50%, 
                rgba(255, 206, 84, 0.1) 100%);
        }
        
        /* Message bubbles */
        .message-sent {
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white !important;
        }
        
        .message-received {
            background: rgba(255, 255, 255, 0.95);
            color: #1f2937 !important;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        /* Text readability */
        .email-text-primary {
            color: #1f2937 !important;
        }
        
        .email-text-secondary {
            color: #4b5563 !important;
        }
        
        .sidebar-text-primary {
            color: #f9fafb !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }
        
        .sidebar-text-secondary {
            color: #d1d5db !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        /* Scrollbar styling */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen email-bg">
    <!-- Header -->
    <div class="glass-dark p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/SKYLAND_Logo.webp') }}" alt="SKYLAND" class="h-10">
                <h1 class="text-2xl font-bold sidebar-text-primary">📧 Email Conversations</h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="sidebar-text-secondary">{{ $user->name }} ({{ $user->isClient() ? 'Client' : 'Vendor' }})</span>
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="glass rounded-2xl p-6 min-h-[80vh]">
            
            @if($conversations->count() > 0)
                <!-- Conversations List -->
                <div class="space-y-6">
                    @foreach($conversations as $conversation)
                        <div class="conversation-item glass-dark rounded-xl p-6 fade-in {{ !$conversation->client_read ? 'ring-2 ring-blue-400' : '' }}">
                            <!-- Conversation Header -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-blue-400 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">A</span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold sidebar-text-primary">SKYLAND Administration</h3>
                                        <p class="text-sm sidebar-text-secondary">
                                            {{ $conversation->admin_sent_at->format('M j, Y g:i A') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if(!$conversation->client_read)
                                        <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">New</span>
                                    @endif
                                    <span class="text-xs px-2 py-1 rounded-full {{ $conversation->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $conversation->hasReply() ? 'Replied' : 'Pending Reply' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Subject -->
                            <h4 class="font-medium sidebar-text-primary text-lg mb-4">{{ $conversation->subject }}</h4>
                            
                            <!-- Admin Message -->
                            <div class="message-received rounded-2xl p-4 mb-4 max-w-4xl">
                                <div class="text-sm font-medium mb-2 email-text-secondary">📨 Message from SKYLAND:</div>
                                <div class="whitespace-pre-wrap email-text-primary">{{ $conversation->admin_message }}</div>
                                
                                @if($conversation->admin_attachments && count($conversation->admin_attachments) > 0)
                                    <div class="mt-3 space-y-1">
                                        <div class="text-sm font-medium email-text-secondary">📎 Attachments:</div>
                                        @foreach($conversation->getFormattedAdminAttachments() as $index => $attachment)
                                            <div class="flex items-center gap-2 bg-black/5 rounded-lg p-2">
                                                <span>📄</span>
                                                <span class="text-sm email-text-primary">{{ $attachment['name'] }}</span>
                                                <a href="{{ route('email-conversations.download', ['conversation' => $conversation, 'type' => 'admin', 'index' => $index]) }}" class="text-blue-600 hover:text-blue-800 text-sm ml-auto">Download</a>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Your Reply -->
                            @if($conversation->hasReply())
                                <div class="message-sent rounded-2xl p-4 mb-4 max-w-4xl ml-auto">
                                    <div class="text-sm font-medium mb-2">📤 Your Reply:</div>
                                    <div class="whitespace-pre-wrap">{{ $conversation->client_reply }}</div>
                                    
                                    @if($conversation->client_attachments && count($conversation->client_attachments) > 0)
                                        <div class="mt-3 space-y-1">
                                            <div class="text-sm font-medium">📎 Attachments:</div>
                                            @foreach($conversation->getFormattedClientAttachments() as $index => $attachment)
                                                <div class="flex items-center gap-2 bg-black/10 rounded-lg p-2">
                                                    <span>📄</span>
                                                    <span class="text-sm">{{ $attachment['name'] }}</span>
                                                    <a href="{{ route('email-conversations.download', ['conversation' => $conversation, 'type' => 'client', 'index' => $index]) }}" class="text-blue-200 hover:text-white text-sm ml-auto">Download</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <div class="text-xs mt-2 text-right opacity-70">
                                        {{ $conversation->client_replied_at ? $conversation->client_replied_at->format('M j, Y g:i A') : '' }}
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Reply Form -->
                            @if(!$conversation->hasReply())
                                <div class="mt-6 p-4 glass rounded-xl">
                                    <h5 class="font-medium email-text-primary mb-3">💬 Reply to this message:</h5>
                                    
                                    <form class="reply-form" data-conversation-id="{{ $conversation->id }}">
                                        <div class="space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium email-text-primary mb-2">Your Reply</label>
                                                <textarea name="reply" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Type your reply..." required></textarea>
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium email-text-primary mb-2">Attachments (Optional)</label>
                                                <input type="file" name="attachments[]" multiple class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" accept="*/*">
                                                <p class="text-sm email-text-secondary mt-1">Max 10MB per file</p>
                                            </div>
                                            
                                            <div class="flex justify-end gap-3">
                                                @if(!$conversation->client_read)
                                                    <button type="button" onclick="markAsRead({{ $conversation->id }})" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                                                        ✓ Mark as Read
                                                    </button>
                                                @endif
                                                <button type="submit" class="px-6 py-2 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-lg hover:from-blue-600 hover:to-green-600 transition-colors">
                                                    📤 Send Reply
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <!-- Mark as Read Button -->
                                @if(!$conversation->client_read)
                                    <div class="flex justify-end mt-4">
                                        <button onclick="markAsRead({{ $conversation->id }})" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                            ✓ Mark as Read
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-6 text-gray-300">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 email-text-primary">No Email Conversations Yet</h3>
                    <p class="text-lg email-text-secondary">You'll receive emails from SKYLAND administration here</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Handle reply form submission
        document.querySelectorAll('.reply-form').forEach(form => {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const conversationId = this.dataset.conversationId;
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.textContent;
                
                submitButton.disabled = true;
                submitButton.textContent = '📤 Sending...';
                
                try {
                    const response = await fetch(`/email-conversations/${conversationId}/reply`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (response.ok) {
                        alert('✅ Reply sent successfully!');
                        // Refresh page to show reply
                        window.location.reload();
                    } else {
                        alert('❌ Error: ' + (result.error || 'Failed to send reply'));
                    }
                } catch (error) {
                    console.error('Error sending reply:', error);
                    alert('❌ Error sending reply. Please try again.');
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = originalText;
                }
            });
        });
        
        // Mark conversation as read
        async function markAsRead(conversationId) {
            try {
                const response = await fetch(`/email-conversations/${conversationId}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    // Remove the "New" badge and unread styling
                    const conversationElement = document.querySelector(`.conversation-item:has(button[onclick="markAsRead(${conversationId})"])`);
                    if (conversationElement) {
                        conversationElement.classList.remove('ring-2', 'ring-blue-400');
                        const newBadge = conversationElement.querySelector('.bg-blue-500');
                        if (newBadge) newBadge.remove();
                        const markReadButton = conversationElement.querySelector(`button[onclick="markAsRead(${conversationId})"]`);
                        if (markReadButton) markReadButton.remove();
                    }
                } else {
                    console.error('Failed to mark as read');
                }
            } catch (error) {
                console.error('Error marking as read:', error);
            }
        }
        
        // Auto-refresh for new messages (every 30 seconds)
        setInterval(() => {
            const currentUrl = window.location.href;
            if (!currentUrl.includes('#')) {
                window.location.reload();
            }
        }, 30000);
    </script>
</body>
</html>
