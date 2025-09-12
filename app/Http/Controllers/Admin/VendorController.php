<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\CommunicationLog;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vendor::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_company_name', 'like', "%{$search}%");
            });
        }
        
        $vendors = $query->latest()->paginate(15);
        
        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'contact_company_name' => 'required|string|max:100',
            'contact_mobile' => 'required|string',
            'contact_email' => 'required|email',
            'contact_designation' => 'nullable|string',
            'company_contact_person' => 'required|string',
            'company_designation' => 'required|string',
            'company_email' => 'required|email',
            'company_phone' => 'required|string',
            'company_name' => 'required|string',
            'trade_license_number' => 'nullable|string',
            'business_type' => 'nullable|string',
            'nature_of_business' => 'nullable|string',
            'year_of_establishment' => 'nullable|integer',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'tax_id' => 'nullable|string',
        ]);

        Vendor::create($validated);

        return redirect()->route('admin.vendors.index')
                         ->with('success', 'Vendor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'contact_company_name' => 'required|string|max:100',
            'contact_mobile' => 'required|string',
            'contact_email' => 'required|email',
            'contact_designation' => 'nullable|string',
            'company_contact_person' => 'required|string',
            'company_designation' => 'required|string',
            'company_email' => 'required|email',
            'company_phone' => 'required|string',
            'company_name' => 'required|string',
            'trade_license_number' => 'nullable|string',
            'business_type' => 'nullable|string',
            'nature_of_business' => 'nullable|string',
            'year_of_establishment' => 'nullable|integer',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'tax_id' => 'nullable|string',
        ]);

        $vendor->update($validated);

        return redirect()->route('admin.vendors.index')
                         ->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()->route('admin.vendors.index')
                         ->with('success', 'Vendor deleted successfully.');
    }

    /**
     * Send email to vendor
     */
    public function contact(Request $request, Vendor $vendor)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Implement actual email sending
        // For now, just log the communication
        CommunicationLog::create([
            'entity_type' => 'vendor',
            'entity_id' => $vendor->id,
            'admin_user_id' => auth()->id(),
            'subject' => $validated['subject'],
            'message_preview' => substr($validated['message'], 0, 200),
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
