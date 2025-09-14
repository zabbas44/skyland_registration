<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Conversations - SKY LAND CONSTRUCTION LLC OPC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
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
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
</head>
<body class="overflow-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -top-40 left-20 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 h-screen flex">
        <!-- Left Sidebar -->
        <div class="w-80 glass-effect border-r border-white/20 flex flex-col">
            <!-- Header -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/SKYLAND_Logo.webp') }}" alt="SKY LAND CONSTRUCTION LLC OPC" class="w-12 h-12 rounded-lg">
                    <div>
                        <h1 class="text-white text-xl font-bold">Conversations</h1>
                        <p class="text-purple-200 text-sm">
                            @if($user->isClient())
                                Client Portal
                            @elseif($user->isSupplier())
                                Vendor Portal
                            @else
                                Portal
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-semibold">
                        @if($user->isClient())
                            {{ substr($user->client->first_name ?? 'C', 0, 1) }}{{ substr($user->client->last_name ?? '', 0, 1) }}
                        @elseif($user->isSupplier())
                            {{ substr($user->vendor->first_name ?? 'V', 0, 1) }}{{ substr($user->vendor->last_name ?? '', 0, 1) }}
                        @else
                            U
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-medium truncate">
                            @if($user->isClient())
                                {{ $user->client->first_name ?? '' }} {{ $user->client->last_name ?? '' }}
                            @elseif($user->isSupplier())
                                {{ $user->vendor->first_name ?? '' }} {{ $user->vendor->last_name ?? '' }}
                            @else
                                User
                            @endif
                        </p>
                        <p class="text-purple-200 text-xs truncate">
                            @if($user->isClient())
                                {{ $user->client->org_name ?? $user->client->company_name ?? 'Individual' }}
                            @elseif($user->isSupplier())
                                {{ $user->vendor->company_name ?? 'No Company' }}
                            @else
                                Portal User
                            @endif
                        </p>
                    </div>
                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                </div>
            </div>

            <!-- Conversations List -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-4">
                <div class="space-y-2">
                    @forelse($conversations as $conversation)
                        <div class="conversation-item p-3 rounded-lg hover:bg-white/10 transition-all duration-200 cursor-pointer border-l-2 {{ $activeConversation && $activeConversation->id == $conversation->id ? 'border-l-blue-400 bg-white/10' : 'border-transparent' }}" 
                             data-conversation-id="{{ $conversation->id }}">
                            <div class="flex items-center space-x-3">
                                <div class="relative flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white font-semibold">
                                        A
                                    </div>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-white font-medium text-sm">Admin</h4>
                                        <span class="text-purple-300 text-xs">
                                            {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : 'No messages' }}
                                        </span>
                                    </div>
                                    <p class="text-purple-200 text-xs truncate mt-0.5">
                                        {{ $conversation->last_message_preview ?? 'Start a conversation...' }}
                                    </p>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100/20 text-blue-300">
                                            {{ ucfirst($conversation->status) }}
                                        </span>
                                        @if($conversation->getUnreadCountForUser($user->isAdmin() ? 'admin' : 'client') > 0)
                                            <span class="bg-red-500 text-white text-xs rounded-full px-2 py-0.5 font-medium">
                                                {{ $conversation->getUnreadCountForUser($user->isAdmin() ? 'admin' : 'client') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"></path>
                                </svg>
                            </div>
                            <p class="text-purple-200 text-xs">No conversations yet</p>
                            <button id="start-conversation-btn" class="mt-2 bg-blue-500/20 hover:bg-blue-500/30 text-blue-300 text-xs py-2 px-4 rounded-lg transition-colors">
                                Start Conversation
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="border-t border-white/20 p-4">
                <div class="space-y-2">
                    <button onclick="window.location.href='/dashboard'" class="w-full bg-white/10 hover:bg-white/20 text-white text-xs py-2 px-3 rounded-lg transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                        <span>Back to Dashboard</span>
                    </button>
                    <button onclick="location.reload()" class="w-full bg-white/10 hover:bg-white/20 text-white text-xs py-2 px-3 rounded-lg transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Refresh</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Conversation Area -->
        <div class="flex-1 flex flex-col">
            <!-- Conversation Header -->
            <div class="glass-effect border-b border-white/20 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center text-white font-semibold">
                            A
                        </div>
                        <div>
                            <h2 class="text-white font-semibold">Admin</h2>
                            <p class="text-purple-200 text-sm">SKY LAND CONSTRUCTION LLC OPC</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                        <span class="text-purple-200 text-sm">Online</span>
                    </div>
                </div>
            </div>

            <!-- Messages Area -->
            <div id="messages-container" class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-4">
                @if($activeConversation)
                    <!-- Messages will be loaded here via JavaScript -->
                @else
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-white text-lg font-medium mb-2">Welcome to Conversations</h3>
                            <p class="text-purple-200 text-sm mb-4">Select a conversation to start messaging with our admin team</p>
                            @if($conversations->isEmpty())
                                <button id="start-new-conversation" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                                    Start New Conversation
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Message Input Area -->
            <div class="glass-effect border-t border-white/20 p-4">
                <div class="flex items-center space-x-3">
                    <input type="text" id="message-input" placeholder="Type your message..." 
                           class="flex-1 bg-white/10 border border-white/20 rounded-full px-4 py-3 text-white placeholder-purple-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                           {{ $activeConversation ? '' : 'disabled' }}>
                    <button id="attach-btn" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors" {{ $activeConversation ? '' : 'disabled' }}>
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </button>
                    <button id="send-btn" class="w-10 h-10 bg-blue-500 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors" {{ $activeConversation ? '' : 'disabled' }}>
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
                <input type="file" id="file-input" class="hidden" multiple>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let activeConversationId = {{ $activeConversation ? $activeConversation->id : 'null' }};
        let currentUser = @json($user);
        let isPolling = false;

        // CSRF token setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // DOM elements
        const messageInput = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        const attachBtn = document.getElementById('attach-btn');
        const fileInput = document.getElementById('file-input');
        const messagesContainer = document.getElementById('messages-container');
        const startConversationBtn = document.getElementById('start-conversation-btn');
        const startNewConversationBtn = document.getElementById('start-new-conversation');

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            if (activeConversationId) {
                loadMessages(activeConversationId);
                startPolling();
            }
        });

        function setupEventListeners() {
            // Send message on button click
            sendBtn.addEventListener('click', sendMessage);

            // Send message on Enter key
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // File attachment
            attachBtn.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    // Handle file upload
                    console.log('Files selected:', e.target.files);
                }
            });

            // Conversation selection
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.addEventListener('click', function() {
                    const conversationId = this.dataset.conversationId;
                    selectConversation(conversationId);
                });
            });

            // Start new conversation
            if (startConversationBtn) {
                startConversationBtn.addEventListener('click', createNewConversation);
            }
            
            if (startNewConversationBtn) {
                startNewConversationBtn.addEventListener('click', createNewConversation);
            }
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            if (!message || !activeConversationId) return;

            // Disable input while sending
            messageInput.disabled = true;
            sendBtn.disabled = true;

            fetch('/conversations/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    conversation_id: activeConversationId,
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageInput.value = '';
                    loadMessages(activeConversationId);
                } else {
                    alert('Failed to send message: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to send message');
            })
            .finally(() => {
                messageInput.disabled = false;
                sendBtn.disabled = false;
                messageInput.focus();
            });
        }

        function loadMessages(conversationId) {
            fetch(`/conversations/${conversationId}/messages`)
                .then(response => response.json())
                .then(data => {
                    displayMessages(data.messages);
                    scrollToBottom();
                })
                .catch(error => {
                    console.error('Error loading messages:', error);
                });
        }

        function displayMessages(messages) {
            messagesContainer.innerHTML = '';
            
            messages.forEach(message => {
                const messageDiv = document.createElement('div');
                const isFromCurrentUser = message.sender_id === currentUser.id;
                
                messageDiv.className = `flex ${isFromCurrentUser ? 'justify-end' : 'justify-start'}`;
                
                messageDiv.innerHTML = `
                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                        isFromCurrentUser 
                            ? 'bg-blue-500 text-white' 
                            : 'bg-white/20 text-white'
                    }">
                        <p class="text-sm">${escapeHtml(message.message)}</p>
                        <p class="text-xs mt-1 opacity-70">
                            ${new Date(message.created_at).toLocaleTimeString()}
                        </p>
                    </div>
                `;
                
                messagesContainer.appendChild(messageDiv);
            });
        }

        function selectConversation(conversationId) {
            // Update active conversation
            activeConversationId = conversationId;
            
            // Update UI
            document.querySelectorAll('.conversation-item').forEach(item => {
                if (item.dataset.conversationId === conversationId) {
                    item.classList.add('border-l-blue-400', 'bg-white/10');
                    item.classList.remove('border-transparent');
                } else {
                    item.classList.remove('border-l-blue-400', 'bg-white/10');
                    item.classList.add('border-transparent');
                }
            });

            // Enable input
            messageInput.disabled = false;
            sendBtn.disabled = false;
            attachBtn.disabled = false;

            // Load messages
            loadMessages(conversationId);
            
            // Start polling
            startPolling();
        }

        function createNewConversation() {
            fetch('/conversations/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    message: 'Hello, I would like to start a conversation.',
                    create_new: true
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Refresh to show new conversation
                } else {
                    alert('Failed to create conversation: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to create conversation');
            });
        }

        function startPolling() {
            if (isPolling) return;
            isPolling = true;
            
            setInterval(() => {
                if (activeConversationId) {
                    loadMessages(activeConversationId);
                }
            }, 3000); // Poll every 3 seconds
        }

        function scrollToBottom() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }
    </script>
</body>
</html>


