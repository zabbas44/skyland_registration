<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Sky Land Construction - {{ $vendor->first_name }} {{ $vendor->last_name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', 'system-ui', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dbeafe 100%);
            min-height: 100vh;
            padding: 48px 16px;
            line-height: 1.6;
        }
        
        .email-container {
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 96px);
        }
        
        .content-wrapper {
            max-width: 512px;
            width: 100%;
            text-align: center;
        }
        
        /* Success Icon */
        .success-icon {
            width: 128px;
            height: 128px;
            background: linear-gradient(135deg, #22c55e 0%, #3b82f6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            box-shadow: 0 20px 25px -5px rgba(34, 197, 94, 0.3);
        }
        
        .success-icon svg {
            width: 64px;
            height: 64px;
            color: white;
        }
        
        /* Main Content Card */
        .main-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 40px 32px;
            text-align: center;
        }
        
        .main-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }
        
        .welcome-text {
            font-size: 1.25rem;
            color: #4b5563;
            margin-bottom: 32px;
        }
        
        .vendor-name {
            color: #111827;
            font-weight: 600;
        }
        
        /* Registration Details */
        .details-section {
            background: #f9fafb;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: left;
        }
        
        .section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            font-size: 0.875rem;
        }
        
        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        
        .detail-label {
            color: #6b7280;
        }
        
        .detail-value {
            color: #111827;
            font-weight: 500;
        }
        
        /* What Happens Next */
        .next-steps {
            text-align: left;
            margin-bottom: 32px;
        }
        
        .steps-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        
        .step-item {
            display: flex;
            align-items: flex-start;
        }
        
        .step-number {
            flex-shrink: 0;
            width: 32px;
            height: 32px;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            margin-right: 16px;
            margin-top: 4px;
        }
        
        .step-content h4 {
            font-weight: 500;
            color: #111827;
            margin-bottom: 4px;
        }
        
        .step-content p {
            color: #4b5563;
            font-size: 0.875rem;
        }
        
        /* Contact Section */
        .contact-section {
            background: #dbeafe;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: center;
        }
        
        .contact-subtitle {
            color: #4b5563;
            font-size: 0.875rem;
            margin-bottom: 16px;
        }
        
        .contact-buttons {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
        }
        
        .contact-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            min-width: 140px;
        }
        
        .email-button {
            background: #2563eb;
            color: white;
        }
        
        .phone-button {
            background: #16a34a;
            color: white;
        }
        
        .contact-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .contact-button svg {
            width: 16px;
            height: 16px;
            margin-right: 8px;
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
            margin-bottom: 32px;
        }
        
        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            min-width: 200px;
        }
        
        .register-button {
            background: #4b5563;
            color: white;
        }
        
        .client-button {
            background: #7c3aed;
            color: white;
        }
        
        .action-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .action-button svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }
        
        /* Additional Information */
        .additional-info {
            margin-top: 32px;
            font-size: 0.875rem;
            color: #4b5563;
            text-align: center;
            line-height: 1.6;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }
            
            .main-card {
                padding: 32px 24px;
            }
            
            .contact-buttons, .action-buttons {
                flex-direction: column;
            }
            
            .details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="content-wrapper">
            <!-- Success Icon -->
            <div class="success-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Main Content -->
            <div class="main-card">
                <h1 class="main-title">🎉 Welcome to Our Vendor Family!</h1>
                
                <div class="welcome-text">
                    Thank you for registering with us, <span class="vendor-name">{{ $vendor->first_name }} {{ $vendor->last_name }}</span>!
                </div>

                <!-- Registration Details -->
                <div class="details-section">
                    <h3 class="section-title">Registration Details</h3>
                    <div class="details-grid">
                        <div class="detail-item">
                            <span class="detail-label">Registration ID:</span>
                            <span class="detail-value">#VND{{ str_pad($vendor->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Date:</span>
                            <span class="detail-value">{{ $vendor->created_at->format('F j, Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Business Type:</span>
                            <span class="detail-value">{{ $vendor->business_type }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Contact Email:</span>
                            <span class="detail-value">{{ $vendor->contact_email }}</span>
                        </div>
                    </div>
                </div>

                <!-- What Happens Next -->
                <div class="next-steps">
                    <h3 class="section-title">What Happens Next?</h3>
                    <div class="steps-list">
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h4>Application Review</h4>
                                <p>Our team will review your vendor application within 2-3 business days.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h4>Verification Process</h4>
                                <p>We may contact you for additional information or document verification.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h4>Approval & Onboarding</h4>
                                <p>Once approved, you'll receive access to our vendor portal and partnership details.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="contact-section">
                    <h3 class="section-title">Need Assistance?</h3>
                    <p class="contact-subtitle">
                        If you have any questions about your application or need to update any information, please don't hesitate to contact us.
                    </p>
                    <div class="contact-buttons">
                        <a href="mailto:info@skylandconstruction.com" class="contact-button email-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email Our Team
                        </a>
                        <a href="tel:+97172435757" class="contact-button phone-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Schedule a Call
                        </a>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="https://registration.skylandconstruction.com/supplier" class="action-button register-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Register Another Supplier
                    </a>
                    <a href="https://registration.skylandconstruction.com/client" class="action-button client-button">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Register as Client
                    </a>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="additional-info">
                <p>
                    We value partnerships and look forward to working with quality vendors like you. 
                    Your registration helps us maintain a diverse and capable vendor network.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
