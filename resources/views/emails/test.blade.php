<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Land Construction - Email Test</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'system-ui', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #581c87 50%, #0f172a 100%);
            min-height: 100vh;
            padding: 48px 16px;
            line-height: 1.6;
        }
        
        /* Background Pattern */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="3"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
            opacity: 0.2;
            z-index: 1;
        }
        
        .email-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 10;
        }
        
        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .logo {
            width: 160px;
            height: auto;
            margin: 0 auto 24px;
            display: block;
        }
        
        .title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
            font-family: 'Inter', 'system-ui', sans-serif;
        }
        
        .subtitle {
            font-size: 1.25rem;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* Main Content Card */
        .content-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(24px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }
        
        .card-header {
            padding: 32px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
        }
        
        .card-subtitle {
            color: #94a3b8;
        }
        
        .card-content {
            padding: 32px;
        }
        
        /* Success Icon */
        .success-icon {
            width: 128px;
            height: 128px;
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            box-shadow: 0 20px 25px -5px rgba(139, 92, 246, 0.3);
        }
        
        .success-icon svg {
            width: 64px;
            height: 64px;
            color: white;
        }
        
        /* Welcome Message */
        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #f1f5f9;
            text-align: center;
            margin-bottom: 16px;
        }
        
        .welcome-subtitle {
            font-size: 1.25rem;
            color: #cbd5e1;
            text-align: center;
            margin-bottom: 32px;
        }
        
        /* Info Sections */
        .info-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 24px;
            margin: 24px 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
        }
        
        .section-icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            color: #fbbf24;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            font-size: 0.875rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .info-label {
            color: #94a3b8;
        }
        
        .info-value {
            color: #f1f5f9;
            font-weight: 500;
        }
        
        /* Success Badge */
        .success-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            border: 1px solid rgba(34, 197, 94, 0.3);
            margin-bottom: 16px;
        }
        
        /* Message Text */
        .message-text {
            color: #e2e8f0;
            line-height: 1.7;
            margin: 24px 0;
        }
        
        .feature-list {
            color: #cbd5e1;
            margin: 16px 0;
            padding-left: 0;
            list-style: none;
        }
        
        .feature-list li {
            padding: 4px 0;
            position: relative;
            padding-left: 24px;
        }
        
        .feature-list li::before {
            content: '•';
            color: #fbbf24;
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        
        /* Contact Section */
        .contact-section {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 32px;
        }
        
        .company-name {
            font-size: 1.125rem;
            font-weight: 700;
            color: #f1f5f9;
            margin-bottom: 8px;
        }
        
        .company-tagline {
            color: #94a3b8;
            margin-bottom: 24px;
        }
        
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 20px 0;
        }
        
        .contact-link {
            color: #fbbf24;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .contact-link:hover {
            color: #f59e0b;
            text-decoration: underline;
        }
        
        .footer-note {
            margin-top: 24px;
            font-size: 0.75rem;
            color: #64748b;
            opacity: 0.8;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .title {
                font-size: 2rem;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .card-content,
            .card-header {
                padding: 24px;
            }
            
            .success-icon {
                width: 96px;
                height: 96px;
            }
            
            .success-icon svg {
                width: 48px;
                height: 48px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div style="background: white; padding: 8px; border-radius: 8px; display: inline-block; margin-bottom: 24px;">
                <div style="color: #ea580c; font-size: 1.5rem; font-weight: 900;">🏗️ SKY LAND CONSTRUCTION</div>
            </div>
            
            <h1 class="title">Email Configuration Test</h1>
            <p class="subtitle">
                Your Sky Land Construction email system is working perfectly and ready to communicate with clients and vendors.
            </p>
        </div>

        <!-- Main Content Card -->
        <div class="content-card">
            <div class="card-header">
                <h2 class="card-title">System Test Results</h2>
                <p class="card-subtitle">SMTP Configuration Verification</p>
            </div>

            <div class="card-content">
                <!-- Success Icon -->
                <div class="success-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Welcome Message -->
                <h1 class="welcome-title">🎉 System Ready!</h1>
                <div class="welcome-subtitle">
                    Hello <strong style="color: #fbbf24;">{{ $testData['recipient_name'] }}</strong>! Your email configuration is working perfectly.
                </div>

                <!-- Test Results -->
                <div class="info-section">
                    <h3 class="section-title">
                        <svg class="section-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Email Test Results
                    </h3>
                    
                    <div class="success-badge">
                        ✅ SMTP Connection Successful
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">SMTP Server:</span>
                            <span class="info-value">smtp.office365.com:587</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Encryption:</span>
                            <span class="info-value">TLS/STARTTLS</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">From Address:</span>
                            <span class="info-value">info@skylandconstruction.com</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Test Time:</span>
                            <span class="info-value">{{ $testData['timestamp'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- System Capabilities -->
                <div class="info-section">
                    <h3 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        System Ready For
                    </h3>
                    
                    <div class="message-text">
                        Your email system is now fully configured and ready to handle all communications:
                    </div>
                    
                    <ul class="feature-list">
                        <li>Client notifications and project updates</li>
                        <li>Vendor communications and partnerships</li>
                        <li>System alerts and confirmations</li>
                        <li>Professional business correspondence</li>
                        <li>Automated registration confirmations</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="contact-section">
            <div class="company-name">Sky Land Construction</div>
            <div class="company-tagline">Building Excellence, Delivering Dreams</div>
            
            <div class="contact-info">
                <div>📧 <a href="mailto:info@skylandconstruction.com" class="contact-link">info@skylandconstruction.com</a></div>
                <div>📞 <a href="tel:+97172435757" class="contact-link">+971 7243 5757</a></div>
                <div>🌐 <a href="https://skylandconstruction.com" class="contact-link">www.skylandconstruction.com</a></div>
            </div>
            
            <div class="footer-note">
                This is an automated test email from Sky Land Construction admin system.
            </div>
        </div>
    </div>
</body>
</html>
