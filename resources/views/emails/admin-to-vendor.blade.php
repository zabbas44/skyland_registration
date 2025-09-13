<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
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
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #ff5e14;
        }
        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .message-content {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ff5e14;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }
        .admin-signature {
            background: #eff6ff;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/SKYLAND_Logo.webp') }}" alt="Sky Land Construction" class="logo">
            <h1 style="color: #ff5e14; margin: 0;">{{ $subject }}</h1>
        </div>

        <div class="message-content">
            <p>Dear {{ $vendor->first_name }} {{ $vendor->last_name }},</p>
            <p><strong>Company:</strong> {{ $vendor->company_name }}</p>
            
            {!! nl2br(e($messageContent)) !!}
        </div>

        <div class="admin-signature">
            <p><strong>Best regards,</strong></p>
            <p>{{ $admin->name }}</p>
            <p>Sky Land Construction LLC OPC</p>
            <p>Email: {{ $admin->email }}</p>
        </div>

        <div class="footer">
            <p>This message was sent from Sky Land Construction Admin Panel.</p>
            <p>© {{ date('Y') }} Sky Land Construction. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
