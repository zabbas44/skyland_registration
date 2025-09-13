<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat - SKYLAND</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
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
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Chat background gradient */
        .chat-bg {
            background: linear-gradient(135deg, 
                rgba(74, 144, 226, 0.1) 0%, 
                rgba(80, 200, 120, 0.1) 50%, 
                rgba(255, 206, 84, 0.1) 100%);
        }
        
        /* Message bubbles */
        .message-sent {
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white;
        }
        
        .message-received {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border: 1px solid rgba(0, 0, 0, 0.1);
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
        
        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-up {
            animation: slideUp 0.2s ease-out;
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        /* Emoji picker styles */
        .emoji-picker {
            display: none;
            position: absolute;
            bottom: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 16px;
            z-index: 1000;
        }
        
        .emoji-picker.show {
            display: block;
        }
        
        .emoji-grid {
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            gap: 8px;
            max-height: 200px;
            overflow-y: auto;
        }
        
        .emoji-item {
            padding: 8px;
            text-align: center;
            cursor: pointer;
            border-radius: 6px;
            transition: background 0.2s;
        }
        
        .emoji-item:hover {
            background: #f0f0f0;
        }
        
        /* File upload area */
        .file-drop-zone {
            border: 2px dashed rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .file-drop-zone.dragover {
            border-color: #4A90E2;
            background: rgba(74, 144, 226, 0.1);
        }
        
        /* Online status indicator */
        .online-indicator {
            width: 10px;
            height: 10px;
            background: #50C878;
            border-radius: 50%;
            border: 2px solid white;
            position: absolute;
            bottom: 0;
            right: 0;
        }
        
        /* Typing indicator */
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 18px;
            margin: 8px 0;
        }
        
        .typing-dot {
            width: 6px;
            height: 6px;
            background: #666;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }
        
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        
        @keyframes typing {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="chat-bg min-h-screen">
    
    <!-- Main Chat Container -->
    <div class="flex h-screen">
        
        <!-- Sidebar - Conversation List -->
        <div class="w-1/3 glass border-r border-white/20">
            <!-- Header -->
            <div class="p-6 border-b border-white/20">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-white">Messages</h1>
                    <div class="flex items-center gap-3">
                        <!-- Back to Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                           class="p-2 rounded-full glass-dark hover:bg-white/20 transition-colors"
                           title="Back to Dashboard">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        
                        @if($user->isAdmin())
                        <!-- New Chat Button for Admin -->
                        <button onclick="showNewChatModal()" 
                                class="p-2 rounded-full glass-dark hover:bg-white/20 transition-colors"
                                title="Start New Chat">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-green-400 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div class="online-indicator"></div>
                    </div>
                    <div>
                        <div class="font-medium text-white">{{ $user->name }}</div>
                        <div class="text-sm text-white/70">
                            {{ $user->isAdmin() ? 'Administrator' : ($user->isClient() ? 'Client' : 'Vendor') }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Conversations List -->
            <div class="flex-1 overflow-y-auto custom-scrollbar p-4">
                @forelse($conversations as $conversation)
                <div class="conversation-item mb-3 p-4 rounded-xl glass-dark hover:bg-white/10 transition-colors cursor-pointer {{ $activeConversation && $activeConversation->id === $conversation->id ? 'bg-white/20' : '' }}"
                     onclick="loadConversation({{ $conversation->id }})">
                    <div class="flex items-center gap-3">
                        <!-- Avatar -->
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ substr($conversation->getDisplayTitle(), 0, 1) }}
                                </span>
                            </div>
                            @if($conversation->getUnreadCountForUser($user->isAdmin() ? 'admin' : 'client') > 0)
                            <div class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $conversation->getUnreadCountForUser($user->isAdmin() ? 'admin' : 'client') }}
                            </div>
                            @endif
                        </div>
                        
                        <!-- Conversation Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <h3 class="font-medium text-white truncate">{{ $conversation->getDisplayTitle() }}</h3>
                                <span class="text-xs text-white/60">
                                    {{ $conversation->last_message_at ? $conversation->last_message_at->format('H:i') : '' }}
                                </span>
                            </div>
                            <p class="text-sm text-white/70 truncate">
                                {{ $conversation->last_message_preview ?: 'No messages yet' }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-white/60 py-8">
                    <svg class="w-16 h-16 mx-auto mb-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p>No conversations yet</p>
                    @if($user->isAdmin())
                    <button onclick="showNewChatModal()" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Start a conversation
                    </button>
                    @endif
                </div>
                @endforelse
            </div>
        </div>
        
        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col">
            @if($activeConversation)
            <!-- Chat Header -->
            <div class="p-6 glass border-b border-white/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <div class="w-12 h-12 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ substr($activeConversation->getDisplayTitle(), 0, 1) }}
                                </span>
                            </div>
                            <div class="online-indicator"></div>
                        </div>
                        <div>
                            <h2 class="font-semibold text-white text-lg">{{ $activeConversation->getDisplayTitle() }}</h2>
                            <p class="text-sm text-white/70">
                                {{ $activeConversation->entity_type === 'client' ? 'Client' : 'Vendor' }} • 
                                {{ $activeConversation->isEntityApproved() ? 'Approved' : 'Pending Approval' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <!-- More options -->
                        <button class="p-2 rounded-full glass-dark hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Messages Area -->
            <div id="messages-container" class="flex-1 overflow-y-auto custom-scrollbar p-6">
                <!-- Messages will be loaded here -->
                <div id="messages-list" class="space-y-4">
                    <!-- Loading placeholder -->
                    <div class="text-center text-white/60 py-8">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-white"></div>
                        <p class="mt-2">Loading messages...</p>
                    </div>
                </div>
            </div>
            
            <!-- Message Input Area -->
            <div class="p-6 glass border-t border-white/20">
                <!-- File Upload Area (Hidden by default) -->
                <div id="file-upload-area" class="hidden mb-4 p-4 file-drop-zone rounded-xl">
                    <div class="text-center text-white/70">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p>Drop files here or click to browse</p>
                        <p class="text-sm">Max 10MB per file</p>
                    </div>
                    <input type="file" id="file-input" multiple class="hidden" accept="*/*">
                </div>
                
                <!-- Attached Files Preview -->
                <div id="attached-files" class="hidden mb-4">
                    <div class="flex flex-wrap gap-2" id="attached-files-list">
                        <!-- Attached files will appear here -->
                    </div>
                </div>
                
                <!-- Message Input -->
                <form id="message-form" class="flex items-end gap-3">
                    <div class="flex-1">
                        <div class="relative">
                            <textarea id="message-input" 
                                      rows="1" 
                                      placeholder="Type a message..." 
                                      class="w-full p-4 pr-16 bg-white/90 rounded-2xl border-0 focus:ring-2 focus:ring-blue-400 resize-none max-h-32"
                                      style="min-height: 56px;"></textarea>
                            
                            <!-- Emoji Button -->
                            <div class="absolute bottom-4 right-4">
                                <button type="button" 
                                        onclick="toggleEmojiPicker()"
                                        class="p-1 text-gray-500 hover:text-gray-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </button>
                                
                                <!-- Emoji Picker -->
                                <div id="emoji-picker" class="emoji-picker">
                                    <div class="emoji-grid">
                                        <div class="emoji-item" onclick="insertEmoji('😀')">😀</div>
                                        <div class="emoji-item" onclick="insertEmoji('😃')">😃</div>
                                        <div class="emoji-item" onclick="insertEmoji('😄')">😄</div>
                                        <div class="emoji-item" onclick="insertEmoji('😁')">😁</div>
                                        <div class="emoji-item" onclick="insertEmoji('😅')">😅</div>
                                        <div class="emoji-item" onclick="insertEmoji('😂')">😂</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤣')">🤣</div>
                                        <div class="emoji-item" onclick="insertEmoji('😊')">😊</div>
                                        <div class="emoji-item" onclick="insertEmoji('😇')">😇</div>
                                        <div class="emoji-item" onclick="insertEmoji('🙂')">🙂</div>
                                        <div class="emoji-item" onclick="insertEmoji('🙃')">🙃</div>
                                        <div class="emoji-item" onclick="insertEmoji('😉')">😉</div>
                                        <div class="emoji-item" onclick="insertEmoji('😌')">😌</div>
                                        <div class="emoji-item" onclick="insertEmoji('😍')">😍</div>
                                        <div class="emoji-item" onclick="insertEmoji('🥰')">🥰</div>
                                        <div class="emoji-item" onclick="insertEmoji('😘')">😘</div>
                                        <div class="emoji-item" onclick="insertEmoji('😗')">😗</div>
                                        <div class="emoji-item" onclick="insertEmoji('😙')">😙</div>
                                        <div class="emoji-item" onclick="insertEmoji('😚')">😚</div>
                                        <div class="emoji-item" onclick="insertEmoji('😋')">😋</div>
                                        <div class="emoji-item" onclick="insertEmoji('😛')">😛</div>
                                        <div class="emoji-item" onclick="insertEmoji('😝')">😝</div>
                                        <div class="emoji-item" onclick="insertEmoji('😜')">😜</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤪')">🤪</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤨')">🤨</div>
                                        <div class="emoji-item" onclick="insertEmoji('🧐')">🧐</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤓')">🤓</div>
                                        <div class="emoji-item" onclick="insertEmoji('😎')">😎</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤩')">🤩</div>
                                        <div class="emoji-item" onclick="insertEmoji('🥳')">🥳</div>
                                        <div class="emoji-item" onclick="insertEmoji('😏')">😏</div>
                                        <div class="emoji-item" onclick="insertEmoji('😒')">😒</div>
                                        <div class="emoji-item" onclick="insertEmoji('😞')">😞</div>
                                        <div class="emoji-item" onclick="insertEmoji('😔')">😔</div>
                                        <div class="emoji-item" onclick="insertEmoji('😟')">😟</div>
                                        <div class="emoji-item" onclick="insertEmoji('😕')">😕</div>
                                        <div class="emoji-item" onclick="insertEmoji('🙁')">🙁</div>
                                        <div class="emoji-item" onclick="insertEmoji('☹️')">☹️</div>
                                        <div class="emoji-item" onclick="insertEmoji('😣')">😣</div>
                                        <div class="emoji-item" onclick="insertEmoji('😖')">😖</div>
                                        <div class="emoji-item" onclick="insertEmoji('😫')">😫</div>
                                        <div class="emoji-item" onclick="insertEmoji('😩')">😩</div>
                                        <div class="emoji-item" onclick="insertEmoji('🥺')">🥺</div>
                                        <div class="emoji-item" onclick="insertEmoji('😢')">😢</div>
                                        <div class="emoji-item" onclick="insertEmoji('😭')">😭</div>
                                        <div class="emoji-item" onclick="insertEmoji('😤')">😤</div>
                                        <div class="emoji-item" onclick="insertEmoji('😠')">😠</div>
                                        <div class="emoji-item" onclick="insertEmoji('😡')">😡</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤬')">🤬</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤯')">🤯</div>
                                        <div class="emoji-item" onclick="insertEmoji('😳')">😳</div>
                                        <div class="emoji-item" onclick="insertEmoji('🥵')">🥵</div>
                                        <div class="emoji-item" onclick="insertEmoji('🥶')">🥶</div>
                                        <div class="emoji-item" onclick="insertEmoji('😱')">😱</div>
                                        <div class="emoji-item" onclick="insertEmoji('😨')">😨</div>
                                        <div class="emoji-item" onclick="insertEmoji('😰')">😰</div>
                                        <div class="emoji-item" onclick="insertEmoji('😥')">😥</div>
                                        <div class="emoji-item" onclick="insertEmoji('😓')">😓</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤗')">🤗</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤔')">🤔</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤭')">🤭</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤫')">🤫</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤐')">🤐</div>
                                        <div class="emoji-item" onclick="insertEmoji('🥴')">🥴</div>
                                        <div class="emoji-item" onclick="insertEmoji('😵')">😵</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤢')">🤢</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤮')">🤮</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤧')">🤧</div>
                                        <div class="emoji-item" onclick="insertEmoji('😷')">😷</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤒')">🤒</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤕')">🤕</div>
                                        <div class="emoji-item" onclick="insertEmoji('👍')">👍</div>
                                        <div class="emoji-item" onclick="insertEmoji('👎')">👎</div>
                                        <div class="emoji-item" onclick="insertEmoji('👌')">👌</div>
                                        <div class="emoji-item" onclick="insertEmoji('✌️')">✌️</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤞')">🤞</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤟')">🤟</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤘')">🤘</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤙')">🤙</div>
                                        <div class="emoji-item" onclick="insertEmoji('👈')">👈</div>
                                        <div class="emoji-item" onclick="insertEmoji('👉')">👉</div>
                                        <div class="emoji-item" onclick="insertEmoji('👆')">👆</div>
                                        <div class="emoji-item" onclick="insertEmoji('🖕')">🖕</div>
                                        <div class="emoji-item" onclick="insertEmoji('👇')">👇</div>
                                        <div class="emoji-item" onclick="insertEmoji('☝️')">☝️</div>
                                        <div class="emoji-item" onclick="insertEmoji('👏')">👏</div>
                                        <div class="emoji-item" onclick="insertEmoji('🙌')">🙌</div>
                                        <div class="emoji-item" onclick="insertEmoji('👐')">👐</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤲')">🤲</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤝')">🤝</div>
                                        <div class="emoji-item" onclick="insertEmoji('🙏')">🙏</div>
                                        <div class="emoji-item" onclick="insertEmoji('❤️')">❤️</div>
                                        <div class="emoji-item" onclick="insertEmoji('🧡')">🧡</div>
                                        <div class="emoji-item" onclick="insertEmoji('💛')">💛</div>
                                        <div class="emoji-item" onclick="insertEmoji('💚')">💚</div>
                                        <div class="emoji-item" onclick="insertEmoji('💙')">💙</div>
                                        <div class="emoji-item" onclick="insertEmoji('💜')">💜</div>
                                        <div class="emoji-item" onclick="insertEmoji('🖤')">🖤</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤍')">🤍</div>
                                        <div class="emoji-item" onclick="insertEmoji('🤎')">🤎</div>
                                        <div class="emoji-item" onclick="insertEmoji('💔')">💔</div>
                                        <div class="emoji-item" onclick="insertEmoji('❣️')">❣️</div>
                                        <div class="emoji-item" onclick="insertEmoji('💕')">💕</div>
                                        <div class="emoji-item" onclick="insertEmoji('💞')">💞</div>
                                        <div class="emoji-item" onclick="insertEmoji('💓')">💓</div>
                                        <div class="emoji-item" onclick="insertEmoji('💗')">💗</div>
                                        <div class="emoji-item" onclick="insertEmoji('💖')">💖</div>
                                        <div class="emoji-item" onclick="insertEmoji('💘')">💘</div>
                                        <div class="emoji-item" onclick="insertEmoji('💝')">💝</div>
                                        <div class="emoji-item" onclick="insertEmoji('💟')">💟</div>
                                        <div class="emoji-item" onclick="insertEmoji('♥️')">♥️</div>
                                        <div class="emoji-item" onclick="insertEmoji('💯')">💯</div>
                                        <div class="emoji-item" onclick="insertEmoji('💢')">💢</div>
                                        <div class="emoji-item" onclick="insertEmoji('💥')">💥</div>
                                        <div class="emoji-item" onclick="insertEmoji('💫')">💫</div>
                                        <div class="emoji-item" onclick="insertEmoji('💦')">💦</div>
                                        <div class="emoji-item" onclick="insertEmoji('💨')">💨</div>
                                        <div class="emoji-item" onclick="insertEmoji('🕳️')">🕳️</div>
                                        <div class="emoji-item" onclick="insertEmoji('💣')">💣</div>
                                        <div class="emoji-item" onclick="insertEmoji('💬')">💬</div>
                                        <div class="emoji-item" onclick="insertEmoji('🗨️')">🗨️</div>
                                        <div class="emoji-item" onclick="insertEmoji('🗯️')">🗯️</div>
                                        <div class="emoji-item" onclick="insertEmoji('💭')">💭</div>
                                        <div class="emoji-item" onclick="insertEmoji('💤')">💤</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2">
                        <!-- File Upload Button -->
                        <button type="button" 
                                onclick="toggleFileUpload()"
                                class="p-3 glass-dark hover:bg-white/20 rounded-xl transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                            </svg>
                        </button>
                        
                        <!-- Send Button -->
                        <button type="submit" 
                                class="p-3 bg-gradient-to-r from-blue-500 to-green-500 hover:from-blue-600 hover:to-green-600 rounded-xl transition-colors">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
            
            @else
            <!-- No Conversation Selected -->
            <div class="flex-1 flex items-center justify-center">
                <div class="text-center text-white/60">
                    <svg class="w-24 h-24 mx-auto mb-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Welcome to SKYLAND Chat</h3>
                    <p class="text-lg">Select a conversation to start messaging</p>
                    @if($user->isAdmin())
                    <button onclick="showNewChatModal()" class="mt-6 px-6 py-3 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-xl hover:from-blue-600 hover:to-green-600 transition-colors">
                        Start New Conversation
                    </button>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- New Chat Modal (Admin Only) -->
    @if($user->isAdmin())
    <div id="newChatModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="glass rounded-2xl p-8 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Start New Chat</h3>
                <button onclick="hideNewChatModal()" class="text-white/60 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="newChatForm">
                <div class="mb-4">
                    <label class="block text-white/80 mb-2">Select Type</label>
                    <select id="entityType" class="w-full p-3 rounded-xl bg-white/90 border-0 focus:ring-2 focus:ring-blue-400">
                        <option value="">Choose...</option>
                        <option value="client">Client</option>
                        <option value="vendor">Vendor</option>
                    </select>
                </div>
                
                <div class="mb-6">
                    <label class="block text-white/80 mb-2">Select Person</label>
                    <select id="entitySelect" class="w-full p-3 rounded-xl bg-white/90 border-0 focus:ring-2 focus:ring-blue-400" disabled>
                        <option value="">Select type first...</option>
                    </select>
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="hideNewChatModal()" class="flex-1 px-4 py-3 glass-dark text-white rounded-xl hover:bg-white/20 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-xl hover:from-blue-600 hover:to-green-600 transition-colors">
                        Start Chat
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- JavaScript -->
    <script>
        // Global variables
        let currentConversationId = {{ $activeConversation ? $activeConversation->id : 'null' }};
        let attachedFiles = [];
        let isTyping = false;
        let typingTimeout = null;
        
        // CSRF token setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            if (currentConversationId) {
                loadMessages(currentConversationId);
            }
            
            // Auto-resize textarea
            const messageInput = document.getElementById('message-input');
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 128) + 'px';
            });
            
            // Load entities for new chat modal (admin only)
            @if($user->isAdmin())
            loadEntitiesForNewChat();
            @endif
        });
        
        // Setup event listeners
        function setupEventListeners() {
            // Message form submission
            document.getElementById('message-form').addEventListener('submit', handleMessageSubmit);
            
            // File input change
            document.getElementById('file-input').addEventListener('change', handleFileSelect);
            
            // Click outside to close emoji picker
            document.addEventListener('click', function(e) {
                const emojiPicker = document.getElementById('emoji-picker');
                const emojiButton = e.target.closest('button[onclick="toggleEmojiPicker()"]');
                
                if (!emojiButton && !emojiPicker.contains(e.target)) {
                    emojiPicker.classList.remove('show');
                }
            });
            
            // Drag and drop for files
            const fileDropZone = document.getElementById('file-upload-area');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, preventDefaults, false);
            });
            
            ['dragenter', 'dragover'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                fileDropZone.addEventListener(eventName, unhighlight, false);
            });
            
            fileDropZone.addEventListener('drop', handleDrop, false);
            fileDropZone.addEventListener('click', () => document.getElementById('file-input').click());
        }
        
        // Load conversation
        function loadConversation(conversationId) {
            currentConversationId = conversationId;
            
            // Update active state in sidebar
            document.querySelectorAll('.conversation-item').forEach(item => {
                item.classList.remove('bg-white/20');
            });
            event.currentTarget.classList.add('bg-white/20');
            
            // Load messages
            loadMessages(conversationId);
            
            // Update URL
            const url = new URL(window.location);
            url.searchParams.set('conversation', conversationId);
            window.history.pushState({}, '', url);
        }
        
        // Load messages for conversation
        async function loadMessages(conversationId) {
            try {
                const response = await fetch(`/chat/conversations/${conversationId}/messages`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (response.ok) {
                    const data = await response.json();
                    displayMessages(data.messages);
                } else {
                    console.error('Failed to load messages');
                }
            } catch (error) {
                console.error('Error loading messages:', error);
            }
        }
        
        // Display messages
        function displayMessages(messages) {
            const messagesList = document.getElementById('messages-list');
            messagesList.innerHTML = '';
            
            messages.forEach(message => {
                const messageElement = createMessageElement(message);
                messagesList.appendChild(messageElement);
            });
            
            scrollToBottom();
        }
        
        // Create message element
        function createMessageElement(message) {
            const isOwn = message.sender_id === {{ $user->id }};
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${isOwn ? 'justify-end' : 'justify-start'} fade-in`;
            
            const bubbleClass = isOwn ? 'message-sent' : 'message-received';
            const maxWidth = 'max-w-xs sm:max-w-md';
            
            let attachmentsHtml = '';
            if (message.attachments && message.attachments.length > 0) {
                attachmentsHtml = '<div class="mt-2 space-y-1">';
                message.attachments.forEach(attachment => {
                    attachmentsHtml += `
                        <div class="flex items-center gap-2 p-2 bg-black/10 rounded-lg">
                            <span>${getFileIcon(attachment.mime_type)}</span>
                            <span class="text-sm truncate">${attachment.original_filename}</span>
                            <a href="/chat/download/${attachment.id}" class="text-blue-300 hover:text-blue-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </a>
                        </div>
                    `;
                });
                attachmentsHtml += '</div>';
            }
            
            const createdAt = new Date(message.created_at);
            const timeString = createdAt.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            
            messageDiv.innerHTML = `
                <div class="${bubbleClass} ${maxWidth} rounded-2xl p-4 shadow-lg">
                    ${!isOwn ? `<div class="text-xs font-medium mb-1 opacity-70">${message.sender.name}</div>` : ''}
                    <div class="whitespace-pre-wrap">${message.message || ''}</div>
                    ${attachmentsHtml}
                    <div class="text-xs mt-2 opacity-70 text-right">
                        ${timeString}
                        ${message.is_edited ? ' (edited)' : ''}
                    </div>
                </div>
            `;
            
            return messageDiv;
        }
        
        // Handle message submission
        async function handleMessageSubmit(e) {
            e.preventDefault();
            
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();
            
            if (!message && attachedFiles.length === 0) {
                return;
            }
            
            if (!currentConversationId) {
                alert('Please select a conversation first');
                return;
            }
            
            try {
                const formData = {
                    conversation_id: currentConversationId,
                    message: message,
                    attachments: attachedFiles
                };
                
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
                
                if (response.ok) {
                    const data = await response.json();
                    
                    // Add message to UI
                    const messageElement = createMessageElement(data.message);
                    document.getElementById('messages-list').appendChild(messageElement);
                    scrollToBottom();
                    
                    // Clear input and attachments
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                    clearAttachedFiles();
                    
                    // Update conversation in sidebar
                    updateConversationPreview(currentConversationId, data.message);
                    
                } else {
                    const errorData = await response.json();
                    alert('Failed to send message: ' + (errorData.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('Error sending message:', error);
                alert('Failed to send message. Please try again.');
            }
        }
        
        // Scroll to bottom of messages
        function scrollToBottom() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        }
        
        // Toggle emoji picker
        function toggleEmojiPicker() {
            const picker = document.getElementById('emoji-picker');
            picker.classList.toggle('show');
        }
        
        // Insert emoji
        function insertEmoji(emoji) {
            const input = document.getElementById('message-input');
            const start = input.selectionStart;
            const end = input.selectionEnd;
            const text = input.value;
            
            input.value = text.substring(0, start) + emoji + text.substring(end);
            input.focus();
            input.setSelectionRange(start + emoji.length, start + emoji.length);
            
            // Hide emoji picker
            document.getElementById('emoji-picker').classList.remove('show');
        }
        
        // Toggle file upload area
        function toggleFileUpload() {
            const area = document.getElementById('file-upload-area');
            area.classList.toggle('hidden');
        }
        
        // File handling functions
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        function highlight(e) {
            document.getElementById('file-upload-area').classList.add('dragover');
        }
        
        function unhighlight(e) {
            document.getElementById('file-upload-area').classList.remove('dragover');
        }
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }
        
        function handleFileSelect(e) {
            const files = e.target.files;
            handleFiles(files);
        }
        
        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.size > 10 * 1024 * 1024) { // 10MB limit
                    alert(`File ${file.name} is too large. Maximum size is 10MB.`);
                    return;
                }
                
                uploadFile(file);
            });
        }
        
        async function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);
            
            try {
                const response = await fetch('/chat/upload-attachment', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });
                
                if (response.ok) {
                    const data = await response.json();
                    attachedFiles.push(data);
                    displayAttachedFiles();
                } else {
                    alert('Failed to upload file: ' + file.name);
                }
            } catch (error) {
                console.error('Error uploading file:', error);
                alert('Failed to upload file: ' + file.name);
            }
        }
        
        function displayAttachedFiles() {
            const container = document.getElementById('attached-files');
            const list = document.getElementById('attached-files-list');
            
            if (attachedFiles.length === 0) {
                container.classList.add('hidden');
                return;
            }
            
            container.classList.remove('hidden');
            list.innerHTML = '';
            
            attachedFiles.forEach((file, index) => {
                const fileDiv = document.createElement('div');
                fileDiv.className = 'flex items-center gap-2 p-2 glass-dark rounded-lg';
                fileDiv.innerHTML = `
                    <span>${getFileIcon(file.mime_type)}</span>
                    <span class="text-sm text-white truncate">${file.original_name}</span>
                    <button onclick="removeAttachedFile(${index})" class="text-red-300 hover:text-red-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                `;
                list.appendChild(fileDiv);
            });
        }
        
        function removeAttachedFile(index) {
            attachedFiles.splice(index, 1);
            displayAttachedFiles();
        }
        
        function clearAttachedFiles() {
            attachedFiles = [];
            displayAttachedFiles();
        }
        
        function getFileIcon(mimeType) {
            if (mimeType.startsWith('image/')) return '🖼️';
            if (mimeType.startsWith('video/')) return '🎥';
            if (mimeType.startsWith('audio/')) return '🎵';
            if (mimeType === 'application/pdf') return '📄';
            return '📎';
        }
        
        function updateConversationPreview(conversationId, message) {
            // Update conversation preview in sidebar
            const conversations = document.querySelectorAll('.conversation-item');
            conversations.forEach(conv => {
                const convId = conv.getAttribute('onclick').match(/\d+/)[0];
                if (convId == conversationId) {
                    const preview = conv.querySelector('p');
                    if (preview) {
                        preview.textContent = message.message || '📎 Attachment';
                    }
                }
            });
        }
        
        @if($user->isAdmin())
        // Admin-specific functions
        function showNewChatModal() {
            document.getElementById('newChatModal').classList.remove('hidden');
        }
        
        function hideNewChatModal() {
            document.getElementById('newChatModal').classList.add('hidden');
            document.getElementById('newChatForm').reset();
            document.getElementById('entitySelect').disabled = true;
            document.getElementById('entitySelect').innerHTML = '<option value="">Select type first...</option>';
        }
        
        async function loadEntitiesForNewChat() {
            const entityType = document.getElementById('entityType');
            const entitySelect = document.getElementById('entitySelect');
            
            entityType.addEventListener('change', async function() {
                if (!this.value) {
                    entitySelect.disabled = true;
                    entitySelect.innerHTML = '<option value="">Select type first...</option>';
                    return;
                }
                
                try {
                    const response = await fetch(`/admin/${this.value}s`, {
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });
                    
                    if (response.ok) {
                        const entities = await response.json();
                        entitySelect.innerHTML = '<option value="">Choose...</option>';
                        
                        entities.forEach(entity => {
                            const name = this.value === 'client' ? entity.full_name : entity.company_name;
                            entitySelect.innerHTML += `<option value="${entity.id}">${name} (${entity.status})</option>`;
                        });
                        
                        entitySelect.disabled = false;
                    }
                } catch (error) {
                    console.error('Error loading entities:', error);
                }
            });
        }
        
        document.getElementById('newChatForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const entityType = document.getElementById('entityType').value;
            const entityId = document.getElementById('entitySelect').value;
            
            if (!entityType || !entityId) {
                alert('Please select both type and person');
                return;
            }
            
            try {
                const response = await fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        entity_type: entityType,
                        entity_id: entityId,
                        message: 'Hello! I\'ve started this conversation to discuss your registration.'
                    })
                });
                
                if (response.ok) {
                    hideNewChatModal();
                    location.reload(); // Refresh to show new conversation
                } else {
                    alert('Failed to start conversation');
                }
            } catch (error) {
                console.error('Error starting conversation:', error);
                alert('Failed to start conversation');
            }
        });
        @endif
        
        // Real-time updates (simplified polling for now)
        setInterval(() => {
            if (currentConversationId) {
                loadMessages(currentConversationId);
            }
        }, 5000); // Poll every 5 seconds
    </script>
</body>
</html>
