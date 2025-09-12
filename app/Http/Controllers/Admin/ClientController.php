<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\CommunicationLog;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('org_name', 'like', "%{$search}%")
                  ->orWhere('client_type', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }
        
        $clients = $query->latest()->paginate(15);
        
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'org_name' => 'nullable|string|max:255',
            'client_type' => 'required|in:Individual,Corporate,Government,NGOs',
            'industry' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:255',
            'office_phone' => 'nullable|string|max:255',
            'address' => 'required|string',
            'website' => 'nullable|url|max:255',
            'nature_of_business' => 'nullable|string',
            'core_services' => 'nullable|string',
            'budget_range' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'trade_license_number' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'primary_contact_person' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'official_email' => 'nullable|email|max:255',
            'official_phone' => 'nullable|string|max:255',
            'linkedin_profile' => 'nullable|url|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
        ]);

        Client::create($validated);

        return redirect()->route('admin.clients.index')
                         ->with('success', 'Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'org_name' => 'nullable|string|max:255',
            'client_type' => 'required|in:Individual,Corporate,Government,NGOs',
            'industry' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:255',
            'office_phone' => 'nullable|string|max:255',
            'address' => 'required|string',
            'website' => 'nullable|url|max:255',
            'nature_of_business' => 'nullable|string',
            'core_services' => 'nullable|string',
            'budget_range' => 'nullable|string|max:255',
            'referral_source' => 'nullable|string|max:255',
            'trade_license_number' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'primary_contact_person' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'official_email' => 'nullable|email|max:255',
            'official_phone' => 'nullable|string|max:255',
            'linkedin_profile' => 'nullable|url|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')
                         ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('admin.clients.index')
                         ->with('success', 'Client deleted successfully.');
    }

    /**
     * Send email to client
     */
    public function contact(Request $request, Client $client)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Implement actual email sending
        // For now, just log the communication
        CommunicationLog::create([
            'entity_type' => 'client',
            'entity_id' => $client->id,
            'admin_user_id' => auth()->id(),
            'subject' => $validated['subject'],
            'message_preview' => substr($validated['message'], 0, 200),
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
