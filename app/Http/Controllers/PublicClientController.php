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
        try {
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

            // Map form fields to database columns for compatibility
            $clientData = [
                // Basic fields that match database columns
                'full_name' => $validated['name'], // Map 'name' to 'full_name'
                'email' => $validated['client_email'], // Use client_email as the main email
                'mobile' => $validated['mobile_country_code'] . ' ' . $validated['phone'],
                'office_phone' => !empty($validated['landline']) ? $validated['landline_country_code'] . ' ' . $validated['landline'] : null,
                'address' => $validated['street_address'] . ', ' . $validated['emirate'] . ', ' . $validated['country'],
                'website' => $validated['website'],
                'company_name' => $validated['company_name'],
                'project_type' => $validated['project_type'],
                'service_needed' => $validated['service_needed'],
                'estimated_budget' => $validated['estimated_budget'],
                'project_brief' => $validated['project_brief'],
                
                // Map client type to database enum values
                'client_type' => match($validated['client_type']) {
                    'individual' => 'Individual',
                    'company' => 'Corporate',
                    'government' => 'Government',
                    'developer' => 'Corporate',
                    'consultant' => 'Corporate',
                    default => 'Individual'
                },
                
                // Required fields with default values for database compatibility
                'primary_contact_person' => $validated['name'],
                'official_email' => $validated['client_email'],
                'contact_mobile' => $validated['mobile_country_code'] . ' ' . $validated['phone'],
                'physical_address' => $validated['street_address'] . ', ' . $validated['emirate'] . ', ' . $validated['country'],
                'services_required' => json_encode([$validated['service_needed']]),
                'selection_reason' => $validated['project_brief'],
                'preferred_payment_method' => 'Bank Transfer',
                
                // Add file paths if uploaded
                'site_plans_path' => $validated['trade_license_path'] ?? null,
                'additional_documents_path' => $validated['vat_certificate_path'] ?? null,
            ];
            
            // Add file paths to clientData if they exist
            if (isset($validated['trade_license_path'])) {
                $clientData['site_plans_path'] = $validated['trade_license_path'];
            }
            if (isset($validated['vat_certificate_path'])) {
                $clientData['additional_documents_path'] = $validated['vat_certificate_path'];
            }
            if (isset($validated['drawings_path'])) {
                $clientData['site_plans_path'] = $validated['drawings_path']; // Use drawings as site plans
            }
            if (isset($validated['boq_path'])) {
                $clientData['additional_documents_path'] = $validated['boq_path']; // Use BOQ as additional documents
            }

            // Create the client
            $client = Client::create($clientData);

            // Send email notifications
            $emailsSent = false;
            try {
                // Send notification to admin
                Mail::to('info@skylandconstruction.com') // Admin email for system notifications
                    ->send(new ClientRegistrationNotification($client));
                
                // Send welcome email to client
                Mail::to($client->email)
                    ->send(new ClientWelcomeEmail($client));
                    
                $emailsSent = true;
                Log::info('Client registration emails sent successfully for client ID: ' . $client->id);
            } catch (\Exception $e) {
                // Log the error but don't fail the registration
                Log::error('Failed to send client registration emails: ' . $e->getMessage());
            }

            // Handle AJAX requests
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for your client registration! We will review your application and contact you soon.',
                    'client_id' => $client->id,
                    'emails_sent' => $emailsSent
                ]);
            }

            // Redirect to thank you page for non-AJAX requests
            return redirect()->route('client.thank-you', ['id' => $client->id])
                             ->with('success', 'Thank you for your client registration! We will review your application and contact you soon.');
                             
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
            Log::error('Client registration error: ' . $e->getMessage());
            Log::error('Client registration stack trace: ' . $e->getTraceAsString());
            Log::error('Client registration line: ' . $e->getFile() . ':' . $e->getLine());
            
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
        $client = Client::findOrFail($id);
        return view('public.client-thank-you', compact('client'));
    }
}