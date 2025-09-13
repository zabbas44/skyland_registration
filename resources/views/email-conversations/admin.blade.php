<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Email Conversations - SKYLAND Admin</title>
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
                <span class="sidebar-text-secondary">{{ $user->name }} (Admin)</span>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="glass rounded-2xl p-6 min-h-[80vh]">
            
            <!-- New Email Form -->
            <div class="mb-8 p-6 glass-dark rounded-xl">
                <h2 class="text-xl font-semibold sidebar-text-primary mb-4">✉️ Send New Email</h2>
                
                <form id="new-email-form" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Entity Type -->
                        <div>
                            <label for="entity-type" class="block text-sm font-medium sidebar-text-primary mb-2">Send To</label>
                            <select id="entity-type" name="entity_type" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select type...</option>
                                <option value="client">Client</option>
                                <option value="vendor">Vendor</option>
                            </select>
                        </div>
                        
                        <!-- Entity Select -->
                        <div>
                            <label for="entity-select" class="block text-sm font-medium sidebar-text-primary mb-2">Select Person</label>
                            <select id="entity-select" name="entity_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" disabled>
                                <option value="">Select type first...</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label for="email-subject" class="block text-sm font-medium sidebar-text-primary mb-2">Subject</label>
                        <input type="text" id="email-subject" name="subject" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter email subject..." required>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="email-message" class="block text-sm font-medium sidebar-text-primary mb-2">Message</label>
                        <textarea id="email-message" name="message" rows="6" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Type your message..." required></textarea>
                    </div>
                    
                    <!-- Attachments -->
                    <div>
                        <label for="email-attachments" class="block text-sm font-medium sidebar-text-primary mb-2">Attachments (Optional)</label>
                        <input type="file" id="email-attachments" name="attachments[]" multiple class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent" accept="*/*">
                        <p class="text-sm sidebar-text-secondary mt-1">Max 10MB per file</p>
                    </div>
                    
                    <!-- Send Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-xl hover:from-blue-600 hover:to-green-600 transition-colors font-medium">
                            📤 Send Email
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Conversations List -->
            <div>
                <h2 class="text-xl font-semibold email-text-primary mb-4">📬 Email Conversations</h2>
                
                @if($conversations->count() > 0)
                    <div class="space-y-4">
                        @foreach($conversations as $conversation)
                            <div class="conversation-item glass-dark rounded-xl p-6 fade-in {{ !$conversation->admin_read ? 'ring-2 ring-blue-400' : '' }}">
                                <!-- Conversation Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-green-400 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold">{{ substr($conversation->getEntityName(), 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h3 class="font-semibold sidebar-text-primary">{{ $conversation->getEntityName() }}</h3>
                                            <p class="text-sm sidebar-text-secondary">
                                                {{ ucfirst($conversation->getEntityType()) }} • 
                                                {{ $conversation->created_at->format('M j, Y g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if(!$conversation->admin_read)
                                            <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">New</span>
                                        @endif
                                        <span class="text-xs px-2 py-1 rounded-full {{ $conversation->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst(str_replace('_', ' ', $conversation->status)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Subject -->
                                <h4 class="font-medium sidebar-text-primary text-lg mb-3">{{ $conversation->subject }}</h4>
                                
                                <!-- Admin Message -->
                                <div class="message-sent rounded-2xl p-4 mb-4 max-w-4xl">
                                    <div class="text-sm font-medium mb-2">📤 Your Message:</div>
                                    <div class="whitespace-pre-wrap">{{ $conversation->admin_message }}</div>
                                    
                                    @if($conversation->admin_attachments && count($conversation->admin_attachments) > 0)
                                        <div class="mt-3 space-y-1">
                                            <div class="text-sm font-medium">📎 Attachments:</div>
                                            @foreach($conversation->getFormattedAdminAttachments() as $index => $attachment)
                                                <div class="flex items-center gap-2 bg-black/10 rounded-lg p-2">
                                                    <span>📄</span>
                                                    <span class="text-sm">{{ $attachment['name'] }}</span>
                                                    <a href="{{ route('email-conversations.download', ['conversation' => $conversation, 'type' => 'admin', 'index' => $index]) }}" class="text-blue-200 hover:text-white text-sm ml-auto">Download</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Client Reply -->
                                @if($conversation->hasReply())
                                    <div class="message-received rounded-2xl p-4 max-w-4xl ml-auto">
                                        <div class="text-sm font-medium mb-2 email-text-secondary">💬 {{ $conversation->getEntityName() }} replied:</div>
                                        <div class="whitespace-pre-wrap">{{ $conversation->client_reply }}</div>
                                        
                                        @if($conversation->client_attachments && count($conversation->client_attachments) > 0)
                                            <div class="mt-3 space-y-1">
                                                <div class="text-sm font-medium email-text-secondary">📎 Attachments:</div>
                                                @foreach($conversation->getFormattedClientAttachments() as $index => $attachment)
                                                    <div class="flex items-center gap-2 bg-black/5 rounded-lg p-2">
                                                        <span>📄</span>
                                                        <span class="text-sm email-text-primary">{{ $attachment['name'] }}</span>
                                                        <a href="{{ route('email-conversations.download', ['conversation' => $conversation, 'type' => 'client', 'index' => $index]) }}" class="text-blue-600 hover:text-blue-800 text-sm ml-auto">Download</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                        
                                        <div class="text-xs email-text-secondary mt-2 text-right">
                                            {{ $conversation->client_replied_at ? $conversation->client_replied_at->format('M j, Y g:i A') : '' }}
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <p class="sidebar-text-secondary">⏳ Waiting for reply...</p>
                                    </div>
                                @endif
                                
                                <!-- Mark as Read Button -->
                                @if(!$conversation->admin_read)
                                    <div class="flex justify-end mt-4">
                                        <button onclick="markAsRead({{ $conversation->id }})" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                            ✓ Mark as Read
                                        </button>
                                    </div>
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
                        <p class="text-lg email-text-secondary">Send your first email using the form above</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Load entities when entity type changes
        document.getElementById('entity-type').addEventListener('change', async function() {
            const entitySelect = document.getElementById('entity-select');
            const entityType = this.value;
            
            if (!entityType) {
                entitySelect.disabled = true;
                entitySelect.innerHTML = '<option value="">Select type first...</option>';
                return;
            }
            
            try {
                const response = await fetch('/email-conversations/entities', {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    const entities = entityType === 'client' ? data.clients : data.vendors;
                    
                    entitySelect.innerHTML = '<option value="">Select person...</option>';
                    entities.forEach(entity => {
                        const option = document.createElement('option');
                        option.value = entity.id;
                        option.textContent = `${entity.name} (${entity.email}) - ${entity.status}`;
                        entitySelect.appendChild(option);
                    });
                    
                    entitySelect.disabled = false;
                } else {
                    console.error('Failed to load entities');
                }
            } catch (error) {
                console.error('Error loading entities:', error);
            }
        });
        
        // Handle form submission
        document.getElementById('new-email-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            
            submitButton.disabled = true;
            submitButton.textContent = '📤 Sending...';
            
            try {
                const response = await fetch('/email-conversations/send', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    alert('✅ Email sent successfully!');
                    this.reset();
                    document.getElementById('entity-select').disabled = true;
                    document.getElementById('entity-select').innerHTML = '<option value="">Select type first...</option>';
                    
                    // Refresh page to show new conversation
                    window.location.reload();
                } else {
                    alert('❌ Error: ' + (result.error || 'Failed to send email'));
                }
            } catch (error) {
                console.error('Error sending email:', error);
                alert('❌ Error sending email. Please try again.');
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
            }
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
