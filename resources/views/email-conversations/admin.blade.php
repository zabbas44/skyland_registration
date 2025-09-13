<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Email Conversations - SKYLAND Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* 3D Background Effects - Same as registration forms */
        .page-3d-background {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #1e293b 75%, #0f172a 100%);
            position: relative;
            overflow: hidden;
        }

        .page-3d-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .page-3d-background::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.3;
        }

        /* Form 3D Container Effects - Same as registration forms */
        .form-3d-container {
            position: relative;
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.8),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                inset 0 -1px 0 rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            transform: perspective(1000px) rotateX(2deg);
            transition: all 0.3s ease;
            z-index: 1;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        /* Custom scrollbar for the container */
        .form-3d-container::-webkit-scrollbar {
            width: 8px;
        }
        
        .form-3d-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }
        
        .form-3d-container::-webkit-scrollbar-thumb {
            background: rgba(255, 94, 20, 0.6);
            border-radius: 4px;
        }
        
        .form-3d-container::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 94, 20, 0.8);
        }

        .form-3d-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(145deg, 
                rgba(255, 94, 20, 0.1), 
                rgba(59, 130, 246, 0.1),
                rgba(16, 185, 129, 0.1),
                rgba(139, 92, 246, 0.1)
            );
            border-radius: inherit;
            z-index: -1;
            opacity: 0.6;
            filter: blur(6px);
        }

        .form-3d-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.01));
            border-radius: inherit;
            pointer-events: none;
            z-index: 0;
        }

        .form-3d-container:hover {
            transform: perspective(1000px) rotateX(1deg) translateY(-5px);
            box-shadow: 
                0 35px 70px -12px rgba(0, 0, 0, 0.9),
                0 0 0 1px rgba(255, 255, 255, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.15),
                inset 0 -1px 0 rgba(0, 0, 0, 0.3);
        }

        /* Enhanced form styling */
        .form-3d-container form {
            position: relative;
            z-index: 2;
        }

        /* 3D Input Effects - Same as registration forms */
        .form-3d-container input[type="text"],
        .form-3d-container input[type="email"],
        .form-3d-container input[type="password"],
        .form-3d-container input[type="tel"],
        .form-3d-container input[type="url"],
        .form-3d-container select,
        .form-3d-container textarea {
            background: linear-gradient(145deg, #374151, #1f2937);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 
                inset 2px 2px 5px rgba(0, 0, 0, 0.3),
                inset -2px -2px 5px rgba(255, 255, 255, 0.02);
            transition: all 0.3s ease;
            color: #ffffff;
        }

        .form-3d-container input[type="text"]:focus,
        .form-3d-container input[type="email"]:focus,
        .form-3d-container input[type="password"]:focus,
        .form-3d-container input[type="tel"]:focus,
        .form-3d-container input[type="url"]:focus,
        .form-3d-container select:focus,
        .form-3d-container textarea:focus {
            background: linear-gradient(145deg, #4b5563, #374151);
            border-color: rgba(255, 94, 20, 0.5);
            box-shadow: 
                inset 2px 2px 5px rgba(0, 0, 0, 0.2),
                inset -2px -2px 5px rgba(255, 255, 255, 0.03),
                0 0 20px rgba(255, 94, 20, 0.2);
            transform: translateY(-1px);
            outline: none;
        }

        /* 3D Button Effects - Same as registration forms */
        .form-3d-container button {
            background: linear-gradient(145deg, rgb(255, 94, 20), rgb(230, 80, 15));
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 4px 15px rgba(255, 94, 20, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                inset 0 -1px 0 rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .form-3d-container button:hover {
            background: linear-gradient(145deg, rgb(230, 80, 15), rgb(255, 94, 20));
            box-shadow: 
                0 6px 20px rgba(255, 94, 20, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3),
                inset 0 -1px 0 rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .form-3d-container button:active {
            transform: translateY(1px);
            box-shadow: 
                0 2px 10px rgba(255, 94, 20, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                inset 0 -1px 0 rgba(0, 0, 0, 0.3);
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
<body class="min-h-screen bg-slate-900 py-8 px-4 sm:px-6 lg:px-8 page-3d-background">
    <div class="max-w-6xl mx-auto">
        <!-- Header - Same style as registration forms -->
        <div class="flex items-center mb-8">
            <div class="w-16 h-16 flex items-center justify-center mr-4">
                <img src="{{ asset('images/logo-light-trimmed.webp') }}" alt="Sky Land Construction Logo" class="w-16 h-17 object-contain">
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-normal text-white" style="font-family: Teko, sans-serif;">📧 Email Conversations - Admin Panel</h1>
                <p class="text-slate-400">Manage email communications with clients and vendors efficiently with <span style="color: rgb(255,94,20);">SKY LAND CONSTRUCTION LLC OPC</span>. Send messages, view replies, and maintain professional correspondence.</p>
            </div>
            <div class="flex items-center gap-4 ml-4">
                <span class="text-slate-300">{{ $user->name }} (Admin)</span>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Main Container - Same structure as registration forms -->
        <div class="form-3d-container">
            <div class="p-8">
            
            <!-- New Email Form -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-6 text-white" style="color: rgb(255,94,20);">✉️ Send New Email</h2>
                
                <form id="new-email-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Entity Type -->
                        <div>
                            <label for="entity-type" class="block text-sm font-medium text-slate-300 mb-2">Send To</label>
                            <select id="entity-type" name="entity_type" class="w-full px-4 py-3 rounded-lg text-white">
                                <option value="">Select type...</option>
                                <option value="client">Client</option>
                                <option value="vendor">Vendor</option>
                            </select>
                        </div>
                        
                        <!-- Entity Select -->
                        <div>
                            <label for="entity-select" class="block text-sm font-medium text-slate-300 mb-2">Select Person</label>
                            <select id="entity-select" name="entity_id" class="w-full px-4 py-3 rounded-lg text-white" disabled>
                                <option value="">Select type first...</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Subject -->
                    <div>
                        <label for="email-subject" class="block text-sm font-medium text-slate-300 mb-2">Subject</label>
                        <input type="text" id="email-subject" name="subject" class="w-full px-4 py-3 rounded-lg text-white" placeholder="Enter email subject..." required>
                    </div>
                    
                    <!-- Message -->
                    <div>
                        <label for="email-message" class="block text-sm font-medium text-slate-300 mb-2">Message</label>
                        <textarea id="email-message" name="message" rows="6" class="w-full px-4 py-3 rounded-lg text-white resize-none" placeholder="Type your message..." required></textarea>
                    </div>
                    
                    <!-- Attachments -->
                    <div>
                        <label for="email-attachments" class="block text-sm font-medium text-slate-300 mb-2">Attachments (Optional)</label>
                        <input type="file" id="email-attachments" name="attachments[]" multiple class="w-full px-4 py-3 rounded-lg text-white" accept="*/*">
                        <p class="text-sm text-slate-400 mt-2">Max 10MB per file</p>
                    </div>
                    
                    <!-- Send Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-8 py-3 text-white rounded-lg font-medium">
                            📤 Send Email
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Conversations List -->
            <div>
                <h2 class="text-xl font-semibold mb-6 text-white" style="color: rgb(255,94,20);">📬 Email Conversations</h2>
                
                @if($conversations->count() > 0)
                    <div class="space-y-4">
                        @foreach($conversations as $conversation)
                            <div class="conversation-item bg-slate-700/50 rounded-lg p-3 fade-in border border-slate-600/50 {{ !$conversation->admin_read ? 'ring-1 ring-orange-400/50' : '' }}">
                                <!-- Conversation Header -->
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-green-400 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium text-sm">{{ substr($conversation->getEntityName(), 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-white text-sm">{{ $conversation->getEntityName() }}</h3>
                                            <p class="text-xs text-slate-300">
                                                {{ ucfirst($conversation->getEntityType()) }} • 
                                                {{ $conversation->created_at->format('M j, g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        @if(!$conversation->admin_read)
                                            <span class="bg-orange-500 text-white text-xs px-1.5 py-0.5 rounded-full">New</span>
                                        @endif
                                        <span class="text-xs px-1.5 py-0.5 rounded-full {{ $conversation->status === 'replied' ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                            {{ ucfirst(str_replace('_', ' ', $conversation->status)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Subject -->
                                <h4 class="font-medium text-white text-base mb-2">{{ $conversation->subject }}</h4>
                                
                                <!-- Admin Message -->
                                <div class="message-sent rounded-lg p-2 mb-2 max-w-2xl">
                                    <div class="text-xs font-medium mb-1">📤 Your Message:</div>
                                    <div class="whitespace-pre-wrap text-sm">{{ Str::limit($conversation->admin_message, 100) }}</div>
                                    
                                    @if($conversation->admin_attachments && count($conversation->admin_attachments) > 0)
                                        <div class="mt-2 space-y-1">
                                            <div class="text-xs font-medium">📎 {{ count($conversation->admin_attachments) }} attachment(s)</div>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Client Reply -->
                                @if($conversation->hasReply())
                                    <div class="message-received rounded-lg p-2 max-w-2xl ml-auto">
                                        <div class="text-xs font-medium mb-1">💬 {{ $conversation->getEntityName() }} replied:</div>
                                        <div class="whitespace-pre-wrap text-sm">{{ Str::limit($conversation->client_reply, 100) }}</div>
                                        
                                        @if($conversation->client_attachments && count($conversation->client_attachments) > 0)
                                            <div class="mt-2">
                                                <div class="text-xs font-medium">📎 {{ count($conversation->client_attachments) }} attachment(s)</div>
                                            </div>
                                        @endif
                                        
                                        <div class="text-xs mt-1 text-right opacity-70">
                                            {{ $conversation->client_replied_at ? $conversation->client_replied_at->format('M j, g:i A') : '' }}
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-2">
                                        <p class="text-slate-400 text-sm">⏳ Waiting for reply...</p>
                                    </div>
                                @endif
                                
                                <!-- Mark as Read Button -->
                                @if(!$conversation->admin_read)
                                    <div class="flex justify-end mt-2">
                                        <button onclick="markAsRead({{ $conversation->id }})" class="px-3 py-1 bg-slate-600 hover:bg-slate-500 text-white rounded text-xs">
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
            </div>
        </div>
    </div>
</body>
</html>
