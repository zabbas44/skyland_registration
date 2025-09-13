<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Registration Status Update</title>
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
        .status-approved {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .status-rejected {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .status-pending {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .status-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .status-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }
        .status-message {
            font-size: 16px;
            margin: 0;
        }
        .info-section {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ff5e14;
        }
        .info-title {
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .reason-box {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .reason-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 8px;
        }
        .reason-text {
            color: #78350f;
            line-height: 1.5;
        }
        .dashboard-section {
            background: #eff6ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        .dashboard-button {
            display: inline-block;
            background: linear-gradient(135deg, #ff5e14, #ea580c);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            margin: 10px 0;
            transition: transform 0.3s ease;
        }
        .dashboard-button:hover {
            transform: translateY(-2px);
            color: white;
        }
        .contact-section {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
            color: #6b7280;
        }
        .next-steps {
            background: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #0ea5e9;
        }
        .next-steps ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin: 8px 0;
        }
        .partnership-benefits {
            background: #f0fdf4;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #22c55e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/SKYLAND_Logo.webp') }}" alt="Sky Land Construction" class="logo">
            <h1 style="color: #ff5e14; margin: 0;">Supplier Registration Status Update</h1>
        </div>

        @if($status === 'approved')
            <div class="status-approved">
                <div class="status-icon">🎉</div>
                <h2 class="status-title">Welcome to Our Network!</h2>
                <p class="status-message">Your supplier registration has been approved!</p>
            </div>

            <div class="info-section">
                <div class="info-title">Congratulations!</div>
                <p>We're thrilled to welcome {{ $vendor->company_name }} to the Sky Land Construction supplier network! Your registration has been reviewed and approved by our procurement team.</p>
            </div>

            <div class="partnership-benefits">
                <div class="info-title">🤝 Partnership Benefits</div>
                <ul>
                    <li><strong>Project Opportunities:</strong> Access to our construction projects and tenders</li>
                    <li><strong>Preferred Supplier Status:</strong> Priority consideration for relevant projects</li>
                    <li><strong>Streamlined Procurement:</strong> Faster processing of purchase orders</li>
                    <li><strong>Business Growth:</strong> Expand your business with our growing project portfolio</li>
                </ul>
            </div>

            <div class="next-steps">
                <div class="info-title">🚀 Next Steps</div>
                <ul>
                    <li><strong>Dashboard Access:</strong> Log in to view your supplier profile</li>
                    <li><strong>Update Information:</strong> Keep your company details current</li>
                    <li><strong>Project Notifications:</strong> Stay updated on relevant opportunities</li>
                    <li><strong>Document Management:</strong> Upload and manage your certificates</li>
                </ul>
            </div>

            @if($reason)
                <div class="reason-box">
                    <div class="reason-title">📝 Admin Notes:</div>
                    <div class="reason-text">{{ $reason }}</div>
                </div>
            @endif

        @elseif($status === 'rejected')
            <div class="status-rejected">
                <div class="status-icon">❌</div>
                <h2 class="status-title">Application Status</h2>
                <p class="status-message">We need to discuss your registration</p>
            </div>

            <div class="info-section">
                <div class="info-title">Registration Review</div>
                <p>Thank you for your interest in joining the Sky Land Construction supplier network. After reviewing your application, we need to address some items before we can proceed with your registration.</p>
            </div>

            @if($reason)
                <div class="reason-box">
                    <div class="reason-title">📋 Details:</div>
                    <div class="reason-text">{{ $reason }}</div>
                </div>
            @endif

            <div class="next-steps">
                <div class="info-title">📞 Next Steps</div>
                <ul>
                    <li><strong>Contact Our Team:</strong> Please reach out to discuss the details</li>
                    <li><strong>Provide Additional Documentation:</strong> We may need additional certificates or information</li>
                    <li><strong>Address Requirements:</strong> Meet the specific requirements mentioned above</li>
                    <li><strong>Resubmit Application:</strong> You may be able to resubmit after addressing the issues</li>
                </ul>
            </div>

        @else
            <div class="status-pending">
                <div class="status-icon">⏳</div>
                <h2 class="status-title">Under Review</h2>
                <p class="status-message">Your supplier registration is being processed</p>
            </div>

            <div class="info-section">
                <div class="info-title">Review in Progress</div>
                <p>Thank you for submitting your supplier registration. Our procurement team is currently reviewing your application and will update you soon.</p>
            </div>
        @endif

        <!-- Dashboard Access Section -->
        <div class="dashboard-section">
            <h3 style="color: #1f2937; margin-top: 0;">🔐 Your Supplier Dashboard</h3>
            <p>Access your personal dashboard to view your registration details and track updates:</p>
            <a href="https://registration.skylandconstruction.com/login" class="dashboard-button">
                Access Dashboard
            </a>
            <p style="font-size: 14px; color: #6b7280; margin-top: 15px;">
                <strong>Login:</strong> {{ $vendor->contact_email }}<br>
                <strong>Password:</strong> Use the password you created during registration
            </p>
        </div>

        <!-- Contact Information -->
        <div class="contact-section">
            <div class="info-title">📞 Procurement Team Contact</div>
            <p>For supplier-related inquiries and support:</p>
            <p>
                <strong>Email:</strong> procurement@skylandconstruction.com<br>
                <strong>Phone:</strong> +971 XX XXX XXXX<br>
                <strong>Website:</strong> <a href="https://skylandconstruction.com" style="color: #ff5e14;">skylandconstruction.com</a>
            </p>
        </div>

        <!-- Vendor Details Summary -->
        <div class="info-section">
            <div class="info-title">📋 Registration Summary</div>
            <p><strong>Company:</strong> {{ $vendor->company_name }}</p>
            <p><strong>Contact Person:</strong> {{ $vendor->first_name }} {{ $vendor->last_name }}</p>
            <p><strong>Email:</strong> {{ $vendor->contact_email }}</p>
            <p><strong>Business Type:</strong> {{ $vendor->business_type }}</p>
            <p><strong>Phone:</strong> {{ $vendor->contact_mobile }}</p>
            <p><strong>Registration Date:</strong> {{ $vendor->created_at->format('F j, Y') }}</p>
        </div>

        <div class="footer">
            <p>This is an automated message from Sky Land Construction LLC OPC.</p>
            <p>© {{ date('Y') }} Sky Land Construction. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
