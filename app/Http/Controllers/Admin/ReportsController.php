<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Vendor;
use App\Models\EmailConversation;
use App\Models\CommunicationLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        // Registration Reports
        $registrationStats = $this->getRegistrationStats();
        
        // Communication Reports
        $communicationStats = $this->getCommunicationStats();
        
        // Status Distribution
        $statusDistribution = $this->getStatusDistribution();
        
        // Monthly Growth
        $monthlyGrowth = $this->getMonthlyGrowth();
        
        // Recent Activities
        $recentActivities = $this->getRecentActivities();
        
        return view('admin.reports.index', compact(
            'registrationStats',
            'communicationStats', 
            'statusDistribution',
            'monthlyGrowth',
            'recentActivities'
        ));
    }
    
    private function getRegistrationStats()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        $thisYear = Carbon::now()->startOfYear();
        
        return [
            'clients' => [
                'total' => Client::count(),
                'today' => Client::whereDate('created_at', $today)->count(),
                'this_week' => Client::where('created_at', '>=', $thisWeek)->count(),
                'this_month' => Client::where('created_at', '>=', $thisMonth)->count(),
                'this_year' => Client::where('created_at', '>=', $thisYear)->count(),
            ],
            'vendors' => [
                'total' => Vendor::count(),
                'today' => Vendor::whereDate('created_at', $today)->count(),
                'this_week' => Vendor::where('created_at', '>=', $thisWeek)->count(),
                'this_month' => Vendor::where('created_at', '>=', $thisMonth)->count(),
                'this_year' => Vendor::where('created_at', '>=', $thisYear)->count(),
            ]
        ];
    }
    
    private function getCommunicationStats()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();
        
        return [
            'email_conversations' => [
                'total' => EmailConversation::count(),
                'today' => EmailConversation::whereDate('created_at', $today)->count(),
                'this_week' => EmailConversation::where('created_at', '>=', $thisWeek)->count(),
                'this_month' => EmailConversation::where('created_at', '>=', $thisMonth)->count(),
                'replied' => EmailConversation::where('status', 'replied')->count(),
                'pending' => EmailConversation::where('status', 'sent')->count(),
            ],
            'communication_logs' => [
                'total' => CommunicationLog::count(),
                'today' => CommunicationLog::whereDate('created_at', $today)->count(),
                'this_week' => CommunicationLog::where('created_at', '>=', $thisWeek)->count(),
                'this_month' => CommunicationLog::where('created_at', '>=', $thisMonth)->count(),
            ]
        ];
    }
    
    private function getStatusDistribution()
    {
        try {
            $clientStatus = Client::select(
                DB::raw('CASE WHEN status IS NULL THEN "pending" ELSE status END as status'),
                DB::raw('COUNT(*) as count')
            )->groupBy('status')->get();
            
            $vendorStatus = Vendor::select(
                DB::raw('CASE WHEN status IS NULL THEN "pending" ELSE status END as status'),
                DB::raw('COUNT(*) as count')
            )->groupBy('status')->get();
            
            return [
                'clients' => $clientStatus,
                'vendors' => $vendorStatus
            ];
        } catch (\Exception $e) {
            return [
                'clients' => collect([]),
                'vendors' => collect([])
            ];
        }
    }
    
    private function getMonthlyGrowth()
    {
        try {
            $months = [];
            $clientData = [];
            $vendorData = [];
            
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $months[] = $date->format('M Y');
                
                $clientCount = Client::whereYear('created_at', $date->year)
                                   ->whereMonth('created_at', $date->month)
                                   ->count();
                $clientData[] = $clientCount;
                
                $vendorCount = Vendor::whereYear('created_at', $date->year)
                                   ->whereMonth('created_at', $date->month)
                                   ->count();
                $vendorData[] = $vendorCount;
            }
            
            return [
                'months' => $months,
                'clients' => $clientData,
                'vendors' => $vendorData
            ];
        } catch (\Exception $e) {
            return [
                'months' => [],
                'clients' => [],
                'vendors' => []
            ];
        }
    }
    
    private function getRecentActivities()
    {
        $activities = collect();
        
        // Recent client registrations
        $recentClients = Client::latest()->take(5)->get();
        foreach ($recentClients as $client) {
            $activities->push([
                'type' => 'client_registration',
                'title' => 'New Client Registration',
                'description' => $client->company_name . ' registered',
                'date' => $client->created_at,
                'status' => $client->status ?? 'pending'
            ]);
        }
        
        // Recent vendor registrations
        $recentVendors = Vendor::latest()->take(5)->get();
        foreach ($recentVendors as $vendor) {
            $activities->push([
                'type' => 'vendor_registration',
                'title' => 'New Vendor Registration',
                'description' => $vendor->company_name . ' registered',
                'date' => $vendor->created_at,
                'status' => $vendor->status ?? 'pending'
            ]);
        }
        
        // Recent email conversations
        $recentConversations = EmailConversation::latest()->take(5)->get();
        foreach ($recentConversations as $conversation) {
            $entityName = $conversation->getEntityName();
            $activities->push([
                'type' => 'email_conversation',
                'title' => 'Email Conversation',
                'description' => 'Conversation with ' . $entityName,
                'date' => $conversation->created_at,
                'status' => $conversation->status
            ]);
        }
        
        return $activities->sortByDesc('date')->take(15);
    }
    
    public function exportClients(Request $request)
    {
        $format = $request->get('format', 'csv');
        $status = $request->get('status');
        
        $query = Client::query();
        if ($status) {
            $query->where('status', $status);
        }
        
        $clients = $query->get();
        
        if ($format === 'csv') {
            return $this->exportToCsv($clients, 'clients');
        }
        
        return back()->with('error', 'Unsupported export format.');
    }
    
    public function exportVendors(Request $request)
    {
        $format = $request->get('format', 'csv');
        $status = $request->get('status');
        
        $query = Vendor::query();
        if ($status) {
            $query->where('status', $status);
        }
        
        $vendors = $query->get();
        
        if ($format === 'csv') {
            return $this->exportToCsv($vendors, 'vendors');
        }
        
        return back()->with('error', 'Unsupported export format.');
    }
    
    private function exportToCsv($data, $type)
    {
        $filename = $type . '_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($data, $type) {
            $file = fopen('php://output', 'w');
            
            if ($type === 'clients') {
                fputcsv($file, ['ID', 'Company Name', 'Contact Person', 'Email', 'Phone', 'Status', 'Created At']);
                foreach ($data as $client) {
                    fputcsv($file, [
                        $client->id,
                        $client->company_name,
                        $client->contact_person_name,
                        $client->email,
                        $client->phone,
                        $client->status ?? 'pending',
                        $client->created_at->format('Y-m-d H:i:s')
                    ]);
                }
            } else {
                fputcsv($file, ['ID', 'Company Name', 'Contact Person', 'Email', 'Phone', 'Status', 'Created At']);
                foreach ($data as $vendor) {
                    fputcsv($file, [
                        $vendor->id,
                        $vendor->company_name,
                        $vendor->contact_person_name,
                        $vendor->email,
                        $vendor->phone,
                        $vendor->status ?? 'pending',
                        $vendor->created_at->format('Y-m-d H:i:s')
                    ]);
                }
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}
