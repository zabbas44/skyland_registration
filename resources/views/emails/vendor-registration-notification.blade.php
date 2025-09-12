<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vendor Registration - {{ $vendor->first_name }} {{ $vendor->last_name }}</title>
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
        
        .detail-item.full-width {
            grid-column: 1 / -1;
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
        
        /* Services Section */
        .services-section {
            background: #f0fdf4;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 32px;
            text-align: left;
        }
        
        .services-content {
            color: #374151;
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
        
        /* Follow-up Information */
        .followup-section {
            background: #dbeafe;
            border-radius: 8px;
            padding: 24px;
            text-align: left;
        }
        
        .tips-list {
            color: #374151;
            font-size: 0.875rem;
            margin: 16px 0;
            padding-left: 0;
            list-style: none;
        }
        
        .tips-list li {
            padding: 4px 0;
            position: relative;
            padding-left: 24px;
        }
        
        .tips-list li::before {
            content: '•';
            color: #3b82f6;
            font-weight: bold;
            position: absolute;
            left: 0;
        }
        
        /* Admin Note */
        .admin-note {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 16px;
            margin-top: 32px;
            text-align: left;
        }
        
        .admin-note h4 {
            color: #92400e;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.875rem;
        }
        
        .admin-note p {
            color: #451a03;
            font-size: 0.875rem;
            margin-bottom: 8px;
        }
        
        .admin-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }
        
        .admin-button {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            text-decoration: none;
            color: white;
        }
        
        .view-button {
            background: #3b82f6;
        }
        
        .contact-button-admin {
            background: #059669;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }
            
            .main-card {
                padding: 32px 24px;
            }
            
            .contact-buttons {
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
                <h1 class="main-title">🎉 New Vendor Registered!</h1>
                
                <div class="welcome-text">
                    <span class="vendor-name">{{ $vendor->first_name }} {{ $vendor->last_name }}</span> from <strong>{{ $vendor->company_name }}</strong> has just registered as a new vendor.
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
                            <span class="detail-label">Contact Person:</span>
                            <span class="detail-value">{{ $vendor->first_name }} {{ $vendor->last_name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Designation:</span>
                            <span class="detail-value">{{ $vendor->contact_designation ?? 'Not provided' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Contact Email:</span>
                            <span class="detail-value">{{ $vendor->contact_email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Contact Mobile:</span>
                            <span class="detail-value">{{ $vendor->contact_mobile }}</span>
                        </div>
                        <div class="detail-item full-width">
                            <span class="detail-label">Company Name:</span>
                            <span class="detail-value">{{ $vendor->company_name }}</span>
                        </div>
                        @if($vendor->business_type)
                        <div class="detail-item">
                            <span class="detail-label">Business Type:</span>
                            <span class="detail-value">{{ $vendor->business_type }}</span>
                        </div>
                        @endif
                        @if($vendor->nature_of_business)
                        <div class="detail-item">
                            <span class="detail-label">Nature of Business:</span>
                            <span class="detail-value">{{ $vendor->nature_of_business }}</span>
                        </div>
                        @endif
                        @if($vendor->year_of_establishment)
                        <div class="detail-item">
                            <span class="detail-label">Established:</span>
                            <span class="detail-value">{{ $vendor->year_of_establishment }}</span>
                        </div>
                        @endif
                        @if($vendor->trade_license_number)
                        <div class="detail-item">
                            <span class="detail-label">Trade License:</span>
                            <span class="detail-value">{{ $vendor->trade_license_number }}</span>
                        </div>
                        @endif
                        @if($vendor->address)
                        <div class="detail-item full-width">
                            <span class="detail-label">Address:</span>
                            <span class="detail-value">{{ $vendor->address }}</span>
                        </div>
                        @endif
                        @if($vendor->website)
                        <div class="detail-item full-width">
                            <span class="detail-label">Website:</span>
                            <span class="detail-value">{{ $vendor->website }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- What Happens Next -->
                <div class="next-steps">
                    <h3 class="section-title">Recommended Next Steps</h3>
                    <div class="steps-list">
                        <div class="step-item">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h4>Review Application</h4>
                                <p>Review the vendor's registration details and submitted documents within 2-3 business days.</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h4>Document Verification</h4>
                                <p>Verify the submitted documents (business license, tax certificates, company profile).</p>
                            </div>
                        </div>
                        
                        <div class="step-item">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h4>Approval & Onboarding</h4>
                                <p>Once approved, provide vendor portal access and send partnership agreement.</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($vendor->preferred_payment_method || $vendor->bank_name)
                <!-- Financial Information -->
                <div class="services-section">
                    <h3 class="section-title">Financial Information</h3>
                    <div class="services-content">
                        @if($vendor->preferred_payment_method)
                        <p><strong>Preferred Payment Method:</strong> {{ $vendor->preferred_payment_method }}</p>
                        @endif
                        @if($vendor->bank_name)
                        <p><strong>Bank:</strong> {{ $vendor->bank_name }}</p>
                        @endif
                        @if($vendor->bank_branch)
                        <p><strong>Branch:</strong> {{ $vendor->bank_branch }}</p>
                        @endif
                        @if($vendor->bank_account_number)
                        <p><strong>Account Number:</strong> {{ $vendor->bank_account_number }}</p>
                        @endif
                        @if($vendor->iban)
                        <p><strong>IBAN:</strong> {{ $vendor->iban }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Contact Information -->
                <div class="contact-section">
                    <h3 class="section-title">Vendor Contact Information</h3>
                    <p class="contact-subtitle">
                        Reach out to {{ $vendor->first_name }} {{ $vendor->last_name }} using the contact details below.
                    </p>
                    <div class="contact-buttons">
                        <a href="mailto:{{ $vendor->contact_email }}" class="contact-button email-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email Vendor
                        </a>
                        @if($vendor->contact_mobile)
                        <a href="tel:{{ $vendor->contact_mobile }}" class="contact-button phone-button">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Call Vendor
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Follow-up Information -->
                <div class="followup-section">
                    <h3 class="section-title">💡 Pro Tips for Vendor Engagement</h3>
                    <ul class="tips-list">
                        <li>Respond within 2-3 business days to show professionalism</li>
                        <li>Verify all submitted documents for authenticity</li>
                        <li>Check trade license validity and business registration status</li>
                        <li>Conduct initial capability assessment based on their business type</li>
                        <li>Set up a vendor profile in the system once approved</li>
                    </ul>
                </div>
            </div>

            <!-- Admin Action Note -->
            <div class="admin-note">
                <h4>🔧 Admin Panel Actions</h4>
                <p>You can view this vendor's full profile and contact them directly through the admin panel.</p>
                <div class="admin-actions">
                    <a href="http://localhost:8000/admin/vendors/{{ $vendor->id }}" class="admin-button view-button">View Profile</a>
                    <a href="http://localhost:8000/admin/vendors" class="admin-button contact-button-admin">Manage Vendors</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
