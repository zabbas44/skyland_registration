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
        return view('public.client-registration');
    }

    /**
     * Handle client registration submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Client & Company section
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'mobile_country' => 'required|string|max:10',
            'mobile_number' => 'required|string|max:255',
            'landline_country' => 'nullable|string|max:10',
            'landline_number' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clients,email|max:255',
            'company_website' => 'nullable|url|max:255',
            'client_type' => 'required|in:individual,company,government,developer,consultant',
            'license_number' => 'required|string|max:255',
            
            // Project & Service Requirements section
            'project_type' => 'required|in:residential_villa,commercial_retail,industrial_warehouse,fitout_renovation,maintenance,others',
            'service_needed' => 'required|in:design_approval,civil_construction,mep_works,interior_joinery,landscaping,maintenance_amc',
            'estimated_budget' => 'required|in:under_50k,50k_100k,100k_250k,250k_500k,500k_1m,1m_5m,over_5m',
            
            // Address section
            'street' => 'required|string|max:255',
            'community' => 'required|string|max:255',
            'emirate' => 'required|in:abu_dhabi,dubai,sharjah,ajman,umm_al_quwain,ras_al_khaimah,fujairah',
            'plot_unit_number' => 'nullable|string|max:255',
            
            // Timeline section
            'target_start_date' => 'required|date|after:today',
            'desired_timeline' => 'required|in:urgent_0_4_weeks,short_1_3_months,medium_3_6_months,long_6_plus_months',
            'project_brief' => 'required|string|min:50',
            
            // File uploads
            'site_plans' => 'nullable|file|mimes:pdf,jpg,jpeg,png,dwg|max:5120',
            'additional_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            
            // Terms consent
            'terms' => 'required|accepted',
        ]);

        // Handle file uploads
        if ($request->hasFile('site_plans')) {
            $validated['site_plans_path'] = $request->file('site_plans')->store('client-documents', 'public');
        }
        
        if ($request->hasFile('additional_documents')) {
            $validated['additional_documents_path'] = $request->file('additional_documents')->store('client-documents', 'public');
        }

        // Store the original name for both fields
        $originalName = $validated['name'];
        
        // Map form fields to database columns for compatibility
        $validated['full_name'] = $originalName;
        $validated['mobile'] = $validated['mobile_country'] . ' ' . $validated['mobile_number'];
        $validated['office_phone'] = $validated['landline_country'] ? $validated['landline_country'] . ' ' . $validated['landline_number'] : $validated['landline_number'];
        $validated['website'] = $validated['company_website'];
        $validated['trade_license_number'] = $validated['license_number'];
        
        // Combine address components for the required address field
        $addressParts = array_filter([
            $validated['street'],
            $validated['community'],
            $validated['plot_unit_number'],
            $validated['emirate']
        ]);
        $validated['address'] = implode(', ', $addressParts);
        
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
            $validated['mobile_country'],
            $validated['mobile_number'], 
            $validated['landline_country'],
            $validated['landline_number'],
            $validated['company_website'],
            $validated['license_number']
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
