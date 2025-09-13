<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\User;
use App\Mail\ClientStatusUpdate;
use App\Mail\VendorStatusUpdate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    public function __construct()
    {
        // Will be protected by admin middleware in routes
    }

    /**
     * Approve a client
     */
    public function approveClient(Request $request, Client $client)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);

        return $this->updateClientStatus($client, 'approved', $request->reason);
    }

    /**
     * Reject a client
     */
    public function rejectClient(Request $request, Client $client)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        return $this->updateClientStatus($client, 'rejected', $request->reason);
    }

    /**
     * Approve a vendor
     */
    public function approveVendor(Request $request, Vendor $vendor)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);

        return $this->updateVendorStatus($vendor, 'approved', $request->reason);
    }

    /**
     * Reject a vendor
     */
    public function rejectVendor(Request $request, Vendor $vendor)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        return $this->updateVendorStatus($vendor, 'rejected', $request->reason);
    }

    /**
     * Update client status and send notification
     */
    private function updateClientStatus(Client $client, string $status, ?string $reason = null)
    {
        try {
            // Update client status
            $client->update([
                'status' => $status,
                'status_reason' => $reason,
                'status_updated_at' => now(),
                'status_updated_by' => Auth::id(),
            ]);

            // Send email notification to client
            $user = User::where('client_id', $client->id)->first();
            if ($user) {
                Mail::to($user->email)->send(new ClientStatusUpdate($client, $status, $reason));
                Log::info("Status update email sent to client: {$user->email}");
            }

            $message = $status === 'approved' 
                ? 'Client has been approved successfully!' 
                : 'Client has been rejected.';

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'status' => $client->status_display,
                    'status_color' => $client->status_color
                ]);
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error updating client status: ' . $e->getMessage());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the status.'
                ], 500);
            }

            return redirect()->back()->with('error', 'An error occurred while updating the status.');
        }
    }

    /**
     * Update vendor status and send notification
     */
    private function updateVendorStatus(Vendor $vendor, string $status, ?string $reason = null)
    {
        try {
            // Update vendor status
            $vendor->update([
                'status' => $status,
                'status_reason' => $reason,
                'status_updated_at' => now(),
                'status_updated_by' => Auth::id(),
            ]);

            // Send email notification to vendor
            $user = User::where('supplier_id', $vendor->id)->first();
            if ($user) {
                Mail::to($user->email)->send(new VendorStatusUpdate($vendor, $status, $reason));
                Log::info("Status update email sent to vendor: {$user->email}");
            }

            $message = $status === 'approved' 
                ? 'Vendor has been approved successfully!' 
                : 'Vendor has been rejected.';

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'status' => $vendor->status_display,
                    'status_color' => $vendor->status_color
                ]);
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error updating vendor status: ' . $e->getMessage());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while updating the status.'
                ], 500);
            }

            return redirect()->back()->with('error', 'An error occurred while updating the status.');
        }
    }
}
