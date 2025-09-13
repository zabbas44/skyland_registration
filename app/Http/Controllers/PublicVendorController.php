<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\User;
use App\Mail\VendorRegistrationNotification;
use App\Mail\VendorWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PublicVendorController extends Controller
{
    /**
     * Show the vendor registration form.
     */
    public function create()
    {
        return view('public.vendor-registration');
    }

    /**
     * Handle vendor registration submission.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Account Information section
                'full_name' => 'required|string|max:100',
                'email' => 'required|email|unique:vendors,contact_email',
                'password' => 'required|string|min:8|confirmed',
                
                // Company Information section
                'company_name' => 'required|string',
                'business_type' => 'required|string',
                'contact_person' => 'required|string',
                'designation' => 'required|string',
                'mobile_country_code' => 'required|string',
                'mobile_number' => 'required|string',
                'landline_country_code' => 'required|string',
                'landline_number' => 'required|string',
                'company_email' => 'required|email',
                'company_website' => 'nullable|url',
                'emirates' => 'required|string',
                'country' => 'required|string',
                'company_address' => 'required|string',
                
                // Financial & Banking Details section
                'payment_terms' => 'required|string',
                'bank_name' => 'required|string',
                'iban' => 'required|string',
                'swift_code' => 'required|string',
                'branch_address' => 'required|string',
                'vat_registration_no' => 'required|string',
                
                // Document Upload section
                'business_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'vat_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'company_profile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                
                // Consent & Agreement
                'consent_agreement' => 'required|accepted',
            ]);

            // Map form fields to database columns for compatibility
            $vendorData = [
                // Basic contact information
                'contact_email' => $validated['email'],
                'contact_designation' => $validated['designation'],
                'contact_mobile' => $validated['mobile_country_code'] . ' ' . $validated['mobile_number'],
                'contact_company_name' => $validated['company_name'], // Required field - use company name
                
                // Split full_name into first_name and last_name for database compatibility
                'first_name' => explode(' ', $validated['full_name'], 2)[0],
                'last_name' => isset(explode(' ', $validated['full_name'], 2)[1]) ? explode(' ', $validated['full_name'], 2)[1] : '',
                
                // Company information
                'company_name' => $validated['company_name'],
                'business_type' => match($validated['business_type']) {
                    'building_material' => 'Supplier',
                    'sub_contractor' => 'Contractor', 
                    'transport_rental' => 'Service Provider',
                    default => 'Supplier'
                },
                'company_contact_person' => $validated['contact_person'],
                'company_designation' => $validated['designation'],
                'company_email' => $validated['company_email'],
                'company_phone' => $validated['landline_country_code'] . ' ' . $validated['landline_number'],
                'address' => $validated['company_address'],
                'website' => $validated['company_website'],
                
                // Financial & Banking Details
                'preferred_payment_method' => 'Bank Transfer', // Default since form has payment_terms
                'bank_name' => $validated['bank_name'],
                'iban' => $validated['iban'],
                'swift_code' => $validated['swift_code'],
                'tax_id' => $validated['vat_registration_no'],
                
                // Required fields with defaults
                'trade_license_number' => $validated['vat_registration_no'], // Use VAT as trade license for now
                'nature_of_business' => $validated['business_type'],
                'year_of_establishment' => date('Y'), // Default to current year
                'accepted_payment_terms' => $validated['payment_terms'] === '30_days' ? '30' : ($validated['payment_terms'] === '60_days' ? '60' : '90'),
                'worked_with_us_before' => false,
                'has_legal_dispute' => false,
                'bank_branch' => $validated['branch_address'],
                
                // Handle file uploads with correct field names
                'trade_license_path' => null, // Will be set below if uploaded
                'vat_certificate_path' => null, // Will be set below if uploaded  
                'company_profile_path' => null, // Will be set below if uploaded
            ];
            
            // Handle file uploads with correct database column names
            if ($request->hasFile('business_license')) {
                $vendorData['trade_license_path'] = $request->file('business_license')->store('vendor-documents', 'public');
            }
            
            if ($request->hasFile('vat_certificate')) {
                $vendorData['vat_certificate_path'] = $request->file('vat_certificate')->store('vendor-documents', 'public');
            }
            
            if ($request->hasFile('company_profile')) {
                $vendorData['company_profile_path'] = $request->file('company_profile')->store('vendor-documents', 'public');
            }

            // Create the vendor
            $vendor = Vendor::create($vendorData);

            // Create user account for vendor
            $user = User::create([
                'name' => $validated['full_name'],
                'email' => $validated['email'],
                'password' => $validated['password'], // Will be hashed by User model
                'user_type' => 'supplier',
                'supplier_id' => $vendor->id,
                'is_admin' => false,
            ]);

            // Send email notifications
            $emailsSent = false;
            try {
                // Send notification to admin
                Mail::to('info@skylandconstruction.com') // Admin email for system notifications
                    ->send(new VendorRegistrationNotification($vendor));
                
                // Send welcome email to vendor
                Mail::to($vendor->contact_email)
                    ->send(new VendorWelcomeEmail($vendor));
                    
                $emailsSent = true;
                Log::info('Vendor registration emails sent successfully for vendor ID: ' . $vendor->id);
            } catch (\Exception $e) {
                // Log the error but don't fail the registration
                Log::error('Failed to send vendor registration emails: ' . $e->getMessage());
            }

            // Handle AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for your vendor registration! We will review your application and contact you soon.',
                    'vendor_id' => $vendor->id,
                    'emails_sent' => $emailsSent
                ]);
            }

            // Redirect to thank you page for non-AJAX requests
            return redirect()->route('supplier.thank-you', ['id' => $vendor->id])
                             ->with('success', 'Thank you for your vendor registration! We will review your application and contact you soon.');
                             
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors for AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please correct the errors in your form.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            // Re-throw for non-AJAX requests (normal form handling)
            throw $e;
        } catch (\Exception $e) {
            // Handle general errors
            Log::error('Vendor registration error: ' . $e->getMessage());
            Log::error('Vendor registration stack trace: ' . $e->getTraceAsString());
            Log::error('Vendor registration line: ' . $e->getFile() . ':' . $e->getLine());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing your registration. Please try again.',
                    'error_details' => $e->getMessage(), // Temporary for debugging
                    'error_line' => $e->getFile() . ':' . $e->getLine() // Temporary for debugging
                ], 500);
            }
            
            // Re-throw for non-AJAX requests
            throw $e;
        }
    }

    /**
     * Show thank you page after successful registration.
     */
    public function thankYou($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('public.vendor-thank-you', compact('vendor'));
    }
}
