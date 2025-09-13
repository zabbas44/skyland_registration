<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Chat Message</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #4A90E2;
        }
        .logo {
            max-width: 120px;
            height: auto;
            margin-bottom: 10px;
        }
        .company-name {
            color: #4A90E2;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .notification-icon {
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
        }
        .title {
            color: #333;
            font-size: 22px;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-align: center;
        }
        .subtitle {
            color: #666;
            font-size: 16px;
            text-align: center;
            margin-bottom: 30px;
        }
        .conversation-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #4A90E2;
        }
        .sender-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .sender-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 12px;
        }
        .sender-details h4 {
            margin: 0;
            color: #333;
            font-size: 16px;
        }
        .sender-details p {
            margin: 2px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        .message-content {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #e0e0e0;
            position: relative;
        }
        .message-content::before {
            content: '';
            position: absolute;
            top: 15px;
            left: -8px;
            width: 0;
            height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid white;
        }
        .message-text {
            color: #333;
            font-size: 15px;
            line-height: 1.5;
            margin: 0;
            white-space: pre-wrap;
        }
        .message-time {
            color: #999;
            font-size: 12px;
            margin-top: 10px;
            text-align: right;
        }
        .attachments {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .attachment-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background: #f0f8ff;
            border-radius: 6px;
            margin-bottom: 8px;
            border: 1px solid #d0e7ff;
        }
        .attachment-icon {
            margin-right: 8px;
            font-size: 16px;
        }
        .attachment-name {
            color: #4A90E2;
            text-decoration: none;
            font-size: 14px;
        }
        .cta-section {
            text-align: center;
            margin: 30px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            transition: transform 0.2s;
        }
        .cta-button:hover {
            transform: translateY(-2px);
        }
        .quick-preview {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #50C878;
        }
        .quick-preview h4 {
            margin: 0 0 8px 0;
            color: #333;
            font-size: 14px;
        }
        .quick-preview p {
            margin: 0;
            color: #666;
            font-size: 13px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 12px;
        }
        .footer p {
            margin: 5px 0;
        }
        .social-links {
            margin: 15px 0;
        }
        .social-links a {
            color: #4A90E2;
            text-decoration: none;
            margin: 0 10px;
        }
        .unsubscribe {
            margin-top: 20px;
            font-size: 11px;
            color: #999;
        }
        .unsubscribe a {
            color: #999;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h2 class="company-name">SKYLAND</h2>
            <p style="color: #666; margin: 5px 0 0 0;">Construction & Development</p>
        </div>

        <!-- Notification Icon -->
        <div class="notification-icon">
            💬
        </div>

        <!-- Title -->
        <h1 class="title">New Chat Message</h1>
        <p class="subtitle">You have received a new message in your conversation</p>

        <!-- Conversation Info -->
        <div class="conversation-info">
            <div class="sender-info">
                <div class="sender-avatar">
                    {{ substr($message->sender->name, 0, 1) }}
                </div>
                <div class="sender-details">
                    <h4>{{ $message->sender->name }}</h4>
                    <p>{{ $message->sender->isAdmin() ? 'SKYLAND Administrator' : ($conversation->entity_type === 'client' ? 'Client' : 'Vendor') }}</p>
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: #666;">
                <span>Conversation: {{ $conversation->getDisplayTitle() }}</span>
                <span>{{ $message->created_at->format('M j, Y g:i A') }}</span>
            </div>
        </div>

        <!-- Message Content -->
        <div class="message-content">
            @if($message->message)
            <p class="message-text">{{ $message->message }}</p>
            @endif
            
            @if($message->attachments && $message->attachments->count() > 0)
            <div class="attachments">
                <h4 style="margin: 0 0 10px 0; color: #333; font-size: 14px;">📎 Attachments ({{ $message->attachments->count() }})</h4>
                @foreach($message->attachments as $attachment)
                <div class="attachment-item">
                    <span class="attachment-icon">{{ $attachment->file_icon }}</span>
                    <span class="attachment-name">{{ $attachment->original_filename }}</span>
                    <span style="margin-left: auto; color: #999; font-size: 12px;">({{ $attachment->formatted_file_size }})</span>
                </div>
                @endforeach
            </div>
            @endif
            
            <div class="message-time">
                {{ $message->created_at->format('g:i A') }}
            </div>
        </div>

        <!-- Quick Preview -->
        @if(strlen($message->message) > 100)
        <div class="quick-preview">
            <h4>💡 Message Preview</h4>
            <p>{{ Str::limit($message->message, 150) }}</p>
        </div>
        @endif

        <!-- Call to Action -->
        <div class="cta-section">
            <a href="{{ route('chat.index') }}" class="cta-button">
                View & Reply in Chat
            </a>
            <p style="margin: 15px 0 0 0; color: #666; font-size: 14px;">
                Click the button above to open the chat and reply to this message
            </p>
        </div>

        <!-- Additional Info -->
        <div style="background: #f0f8ff; border-radius: 8px; padding: 20px; margin: 25px 0; border: 1px solid #d0e7ff;">
            <h4 style="margin: 0 0 10px 0; color: #4A90E2;">📱 Chat Features</h4>
            <ul style="margin: 0; padding-left: 20px; color: #666; font-size: 14px;">
                <li>Real-time messaging with instant notifications</li>
                <li>File attachments up to 10MB</li>
                <li>Message history and search</li>
                <li>Emoji support for better communication</li>
                @if($message->sender->isAdmin())
                <li>Direct line to SKYLAND admin team</li>
                @endif
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>SKYLAND Construction & Development</strong></p>
            <p>Building Your Dreams, Creating Your Future</p>
            
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">LinkedIn</a> |
                <a href="mailto:info@skylandconstruction.com">Contact</a>
            </div>
            
            <p style="margin-top: 20px; color: #999;">
                📧 This email was sent because you have an active conversation in SKYLAND Chat
            </p>
            
            <div class="unsubscribe">
                <p>
                    This is an automated message notification. To manage your chat preferences, 
                    <a href="{{ route('chat.index') }}">visit your chat settings</a>.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
