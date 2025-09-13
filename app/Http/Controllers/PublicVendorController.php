<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
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

            // Handle file uploads
            if ($request->hasFile('business_license')) {
                $validated['business_license_path'] = $request->file('business_license')->store('vendor-documents', 'public');
            }
            
            if ($request->hasFile('vat_certificate')) {
                $validated['vat_certificate_path'] = $request->file('vat_certificate')->store('vendor-documents', 'public');
            }
            
            if ($request->hasFile('company_profile')) {
                $validated['company_profile_path'] = $request->file('company_profile')->store('vendor-documents', 'public');
            }

            // Hash the password
            $validated['password'] = bcrypt($validated['password']);
            
            // Map new form fields to database fields
            $validated['contact_email'] = $validated['email'];
            $validated['contact_designation'] = $validated['designation'];
            $validated['contact_mobile'] = $validated['mobile_country_code'] . ' ' . $validated['mobile_number'];
            $validated['contact_company_name'] = $validated['landline_country_code'] . ' ' . $validated['landline_number']; // Note: Using contact_company_name for landline storage
            $validated['company_contact_person'] = $validated['contact_person'];
            $validated['address'] = $validated['company_address'];
            $validated['website'] = $validated['company_website'];
            
            // Split full_name into first_name and last_name for database compatibility
            $nameParts = explode(' ', $validated['full_name'], 2);
            $validated['first_name'] = $nameParts[0];
            $validated['last_name'] = isset($nameParts[1]) ? $nameParts[1] : '';
            
            // Map vat_certificate to tax_certificate for database compatibility
            if (isset($validated['vat_certificate_path'])) {
                $validated['tax_certificate_path'] = $validated['vat_certificate_path'];
                unset($validated['vat_certificate_path']);
            }
            
            // Map VAT registration number to tax_id for database compatibility
            $validated['tax_id'] = $validated['vat_registration_no'];
            
            // Remove form-specific fields that don't match database columns
            unset(
                $validated['full_name'],
                $validated['email'], 
                $validated['designation'],
                $validated['mobile_country_code'],
                $validated['mobile_number'],
                $validated['landline_country_code'],
                $validated['landline_number'],
                $validated['contact_person'],
                $validated['company_address'],
                $validated['company_website'],
                $validated['emirates'],
                $validated['country'],
                $validated['vat_registration_no'],
                $validated['consent_agreement']
            );

            // Create the vendor
            $vendor = Vendor::create($validated);

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
