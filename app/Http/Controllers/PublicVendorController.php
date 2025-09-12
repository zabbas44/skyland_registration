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
        $validated = $request->validate([
            // Contact section
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'office_landline_country' => 'required|string',
            'office_landline' => 'required|string',
            'contact_mobile_country' => 'required|string',
            'contact_mobile' => 'required|string',
            'contact_email' => 'required|email|unique:vendors,contact_email',
            'contact_designation' => 'nullable|string',
            
            // Company Information section
            'company_contact_person' => 'required|string',
            'company_email' => 'required|email',
            'company_website' => 'nullable|url',
            'company_phone_country' => 'required|string',
            'company_phone' => 'required|string',
            'company_name' => 'required|string',
            'trade_license_number' => 'nullable|string',
            'business_type' => 'nullable|string',
            'nature_of_business' => 'nullable|string',
            'year_of_establishment' => 'nullable|integer|min:1800|max:' . date('Y'),
            'website' => 'nullable|url',
            'address' => 'required|string',
            'tax_id' => 'nullable|string',
            
            // File uploads
            'business_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'tax_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'company_profile' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            
            // Captcha validation (placeholder for now)
            // 'g-recaptcha-response' => 'required',
        ]);

        // Handle file uploads
        if ($request->hasFile('business_license')) {
            $validated['business_license_path'] = $request->file('business_license')->store('vendor-documents', 'public');
        }
        
        if ($request->hasFile('tax_certificate')) {
            $validated['tax_certificate_path'] = $request->file('tax_certificate')->store('vendor-documents', 'public');
        }
        
        if ($request->hasFile('company_profile')) {
            $validated['company_profile_path'] = $request->file('company_profile')->store('vendor-documents', 'public');
        }

        // Combine country codes with phone numbers
        $validated['contact_mobile'] = $validated['contact_mobile_country'] . ' ' . $validated['contact_mobile'];
        $validated['company_phone'] = $validated['company_phone_country'] . ' ' . $validated['company_phone'];
        
        // Map office landline to contact_company_name field (since we changed the form field but kept the database field)
        $validated['contact_company_name'] = $validated['office_landline_country'] . ' ' . $validated['office_landline'];
        
        // Remove the separate country code fields and office_landline fields
        unset($validated['contact_mobile_country'], $validated['company_phone_country'], $validated['office_landline_country'], $validated['office_landline']);

        // Create the vendor
        $vendor = Vendor::create($validated);

        // Send email notifications
        try {
            // Send notification to admin
            Mail::to('info@skylandconstruction.com') // Admin email for system notifications
                ->send(new VendorRegistrationNotification($vendor));
            
            // Send welcome email to vendor
            Mail::to($vendor->contact_email)
                ->send(new VendorWelcomeEmail($vendor));
        } catch (\Exception $e) {
            // Log the error but don't fail the registration
            Log::error('Failed to send vendor registration emails: ' . $e->getMessage());
        }

        // Redirect to thank you page
        return redirect()->route('vendor.thank-you', ['id' => $vendor->id])
                         ->with('success', 'Thank you for your vendor registration! We will review your application and contact you soon.');
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
