<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Mail\ClientRegistrationNotification;
use App\Mail\ClientWelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PublicClientController extends Controller
{
    /**
     * Show the client registration form.
     */
    public function create()
    {
        return view('public.client-registration-new');
    }

    /**
     * Handle client registration submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Account Information (Step 1)
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email|max:255',
            'password' => 'required|string|min:8|confirmed',
            
            // Client & Company section (Step 2)
            'client_type' => 'required|in:individual,company,government,developer,consultant',
            'company_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'street_address' => 'required|string|max:255',
            'emirate' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'mobile_country_code' => 'required|string|max:10',
            'phone' => 'required|string|max:255',
            'landline_country_code' => 'nullable|string|max:10',
            'landline' => 'nullable|string|max:255',
            
            // Project & Service Requirements section (Step 3)
            'project_type' => 'required|string|max:255',
            'project_title' => 'required|string|max:255',
            'service_needed' => 'required|string|max:255',
            'timeline' => 'required|string|max:255',
            'estimated_budget' => 'required|string|max:255',
            'project_location' => 'required|string|max:255',
            'project_brief' => 'required|string|min:10',
            
            // File uploads (Step 4)
            'trade_license_step4' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'vat_certificate_step4' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'drawings_step4' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:5120',
            'boq_step4' => 'nullable|file|mimes:pdf,xlsx,xls,doc,docx|max:5120',
            
            // Terms consent (Step 5)
            'terms' => 'required|accepted',
        ]);

        // Handle file uploads
        if ($request->hasFile('trade_license_step4')) {
            $validated['trade_license_path'] = $request->file('trade_license_step4')->store('client-documents', 'public');
        }
        
        if ($request->hasFile('vat_certificate_step4')) {
            $validated['vat_certificate_path'] = $request->file('vat_certificate_step4')->store('client-documents', 'public');
        }
        
        if ($request->hasFile('drawings_step4')) {
            $validated['drawings_path'] = $request->file('drawings_step4')->store('client-documents', 'public');
        }
        
        if ($request->hasFile('boq_step4')) {
            $validated['boq_path'] = $request->file('boq_step4')->store('client-documents', 'public');
        }

        // Store the original name for both fields
        $originalName = $validated['name'];
        
        // Map form fields to database columns for compatibility
        $validated['full_name'] = $originalName;
        $validated['mobile'] = $validated['mobile_country_code'] . ' ' . $validated['phone'];
        $validated['office_phone'] = $validated['landline_country_code'] ? $validated['landline_country_code'] . ' ' . $validated['landline'] : $validated['landline'];
        
        // Use client_email as the main email for database storage
        $validated['email'] = $validated['client_email'];
        
        // Add password hashing
        $validated['password'] = bcrypt($validated['password']);
        
        // Combine address components for the required address field
        $validated['address'] = $validated['street_address'] . ', ' . $validated['emirate'] . ', ' . $validated['country'];
        
        // Map client type to database enum values
        $clientTypeMapping = [
            'individual' => 'Individual',
            'company' => 'Corporate',
            'government' => 'Government',
            'developer' => 'Corporate', // Map developer to Corporate
            'consultant' => 'Corporate' // Map consultant to Corporate
        ];
        $validated['client_type'] = $clientTypeMapping[$validated['client_type']] ?? 'Individual';
        
        // Add required fields with default values for database compatibility
        // Note: $validated['name'] already contains the form input, no need to reassign
        $validated['primary_contact_person'] = $validated['full_name']; // Use the person's name as primary contact
        $validated['official_email'] = $validated['email']; // Use same email as official email
        $validated['contact_mobile'] = $validated['mobile']; // Use same mobile as contact mobile
        $validated['physical_address'] = $validated['address']; // Use same address as physical address
        $validated['services_required'] = json_encode([$validated['service_needed']]); // Convert to JSON array
        $validated['selection_reason'] = $validated['project_brief']; // Use project brief as selection reason
        $validated['preferred_payment_method'] = 'Bank Transfer'; // Default payment method
        
        // Remove form field names that don't match database columns
        unset(
            $validated['mobile_country_code'],
            $validated['phone'], 
            $validated['landline_country_code'],
            $validated['landline'],
            $validated['client_email'],
            $validated['street_address'],
            $validated['password_confirmation'],
            $validated['trade_license_step4'],
            $validated['vat_certificate_step4'],
            $validated['drawings_step4'],
            $validated['boq_step4']
        );

        // Create the client
        $client = Client::create($validated);

        // Send email notifications
        try {
            // Send notification to admin
            Mail::to('info@skylandconstruction.com') // Admin email for system notifications
                ->send(new ClientRegistrationNotification($client));
            
            // Send welcome email to client
            Mail::to($client->email)
                ->send(new ClientWelcomeEmail($client));
        } catch (\Exception $e) {
            // Log the error but don't fail the registration
            Log::error('Failed to send client registration emails: ' . $e->getMessage());
        }

        // Redirect to thank you page
        return redirect()->route('client.thank-you', ['id' => $client->id])
                         ->with('success', 'Thank you for your client registration! We will review your application and contact you soon.');
    }

    /**
     * Show thank you page after successful registration.
     */
    public function thankYou($id)
    {
        $client = Client::findOrFail($id);
        return view('public.client-thank-you', compact('client'));
    }
}
