<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Conversation Update</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .message-box {
            background: #f8fafc;
            border-left: 4px solid #4A90E2;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .reply-box {
            background: #f0f9ff;
            border-left: 4px solid #50C878;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #4A90E2 0%, #50C878 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .attachments {
            margin-top: 15px;
        }
        .attachment {
            display: inline-block;
            background: #e5e7eb;
            padding: 8px 12px;
            margin: 4px;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📧 Email Conversation</h1>
            <p>{{ $notificationType === 'new_message' ? 'New Message Received' : 'Reply Received' }}</p>
        </div>
        
        <div class="content">
            <h2>{{ $conversation->subject }}</h2>
            
            @if($notificationType === 'new_message')
                <p><strong>From:</strong> SKYLAND Administration</p>
                <p><strong>To:</strong> {{ $conversation->getEntityName() }} ({{ $conversation->getEntityEmail() }})</p>
                
                <div class="message-box">
                    <h3>📝 Admin Message:</h3>
                    <p>{{ $conversation->admin_message }}</p>
                    
                    @if($conversation->admin_attachments && count($conversation->admin_attachments) > 0)
                        <div class="attachments">
                            <strong>📎 Attachments:</strong><br>
                            @foreach($conversation->getFormattedAdminAttachments() as $attachment)
                                <span class="attachment">{{ $attachment['name'] }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <p>Please log in to your account to view the full message and reply:</p>
                
            @elseif($notificationType === 'reply_received')
                <p><strong>From:</strong> {{ $conversation->getEntityName() }}</p>
                <p><strong>Reply to:</strong> {{ $conversation->subject }}</p>
                
                <div class="message-box">
                    <h3>📝 Original Message:</h3>
                    <p>{{ Str::limit($conversation->admin_message, 200) }}</p>
                </div>
                
                <div class="reply-box">
                    <h3>💬 Reply:</h3>
                    <p>{{ $conversation->client_reply }}</p>
                    
                    @if($conversation->client_attachments && count($conversation->client_attachments) > 0)
                        <div class="attachments">
                            <strong>📎 Attachments:</strong><br>
                            @foreach($conversation->getFormattedClientAttachments() as $attachment)
                                <span class="attachment">{{ $attachment['name'] }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <p>Please log in to your admin panel to view the full conversation:</p>
            @endif
            
            <div style="text-align: center;">
                <a href="{{ url('/email-conversations') }}" class="button">
                    View Conversation
                </a>
            </div>
            
            <hr style="margin: 30px 0; border: none; border-top: 1px solid #e5e7eb;">
            
            <p><strong>Conversation Details:</strong></p>
            <ul>
                <li><strong>Subject:</strong> {{ $conversation->subject }}</li>
                <li><strong>Entity:</strong> {{ $conversation->getEntityName() }} ({{ ucfirst($conversation->getEntityType()) }})</li>
                <li><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $conversation->status)) }}</li>
                <li><strong>Date:</strong> {{ $conversation->created_at->format('F j, Y \a\t g:i A') }}</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>
                This is an automated notification from SKYLAND Construction.<br>
                Please do not reply directly to this email.
            </p>
            <p>
                <a href="{{ url('/') }}">Visit SKYLAND Construction</a>
            </p>
        </div>
    </div>
</body>
</html>
