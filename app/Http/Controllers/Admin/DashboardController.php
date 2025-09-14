<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Client;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get filter parameters
            $filter = $request->get('filter', 'daily');
            
            // Calculate date ranges based on filter
            $dateRanges = $this->getDateRanges($filter);
            
            // Get statistics for clients and vendors
            $clientStats = $this->getEntityStats(Client::class, $dateRanges);
            $vendorStats = $this->getEntityStats(Vendor::class, $dateRanges);
            
            // Get chart data for the selected filter
            $chartData = $this->getChartData($filter);
            
            // Get advanced statistics
            $advancedStats = $this->getAdvancedStats();
            
            // Get status distribution
            $statusDistribution = $this->getStatusDistribution();
            
            // Get growth metrics
            $growthMetrics = $this->getGrowthMetrics();
            
            // Extract simple variables for the view
            $totalClients = $clientStats['total'];
            $totalVendors = $vendorStats['total'];
            $pendingApprovals = ($statusDistribution['clients']['pending'] ?? 0) + ($statusDistribution['vendors']['pending'] ?? 0);
            $thisMonth = Client::where('created_at', '>=', Carbon::now()->startOfMonth())->count() + 
                        Vendor::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
            $avgClientsPerDay = $advancedStats['avg_clients_per_day'];
            $avgVendorsPerDay = $advancedStats['avg_vendors_per_day'];
            
            // Get recent entities for display
            $recentClients = Client::orderBy('created_at', 'desc')->take(5)->get();
            $recentVendors = Vendor::orderBy('created_at', 'desc')->take(5)->get();
            
            // Get approved clients and vendors for right sidebar
            $approvedClients = Client::where('status', 'approved')
                ->orderBy('updated_at', 'desc')
                ->limit(10)
                ->get();
            
            $approvedVendors = Vendor::where('status', 'approved')
                ->orderBy('updated_at', 'desc')
                ->limit(10)
                ->get();
                
            // Get recent conversations for dashboard (both chat and email communications)
            $recentConversations = $this->getRecentCommunications();
            
            // Prepare status distribution for charts
            $statusDistributionChart = [
                'approved' => ($statusDistribution['clients']['approved'] ?? 0) + ($statusDistribution['vendors']['approved'] ?? 0),
                'pending' => ($statusDistribution['clients']['pending'] ?? 0) + ($statusDistribution['vendors']['pending'] ?? 0),
                'rejected' => ($statusDistribution['clients']['rejected'] ?? 0) + ($statusDistribution['vendors']['rejected'] ?? 0),
            ];

            return view('admin.dashboard', compact(
                'clientStats', 
                'vendorStats', 
                'chartData', 
                'filter',
                'advancedStats',
                'growthMetrics',
                'totalClients',
                'totalVendors',
                'pendingApprovals',
                'thisMonth',
                'avgClientsPerDay',
                'avgVendorsPerDay',
                'recentClients',
                'recentVendors',
                'approvedClients',
                'approvedVendors',
                'recentConversations'
            ))->with('statusDistribution', $statusDistributionChart);
        } catch (\Exception $e) {
            // Log the error and provide fallback data
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            // Provide basic fallback data
            $filter = $request->get('filter', 'daily');
            $clientStats = ['total' => Client::count(), 'today' => 0, 'this_month' => 0, 'this_year' => 0];
            $vendorStats = ['total' => Vendor::count(), 'today' => 0, 'this_month' => 0, 'this_year' => 0];
            $chartData = ['labels' => [], 'clients' => [], 'vendors' => []];
            $advancedStats = [
                'total_entities' => $clientStats['total'] + $vendorStats['total'],
                'client_percentage' => 50,
                'vendor_percentage' => 50,
                'recent_clients' => 0,
                'recent_vendors' => 0,
                'client_growth_rate' => 0,
                'vendor_growth_rate' => 0,
                'avg_clients_per_day' => 0,
                'avg_vendors_per_day' => 0,
            ];
            $statusDistribution = ['clients' => [], 'vendors' => []];
            $growthMetrics = ['weekly' => [], 'hourly' => []];
            
            // Extract simple variables for the view (fallback)
            $totalClients = $clientStats['total'];
            $totalVendors = $vendorStats['total'];
            $pendingApprovals = 0;
            $thisMonth = 0;
            $avgClientsPerDay = $advancedStats['avg_clients_per_day'];
            $avgVendorsPerDay = $advancedStats['avg_vendors_per_day'];
            
            // Get recent entities for display (fallback)
            $recentClients = collect();
            $recentVendors = collect();
            
            // Get approved entities for right sidebar (fallback)
            $approvedClients = collect();
            $approvedVendors = collect();
            
            // Get conversations fallback
            $recentConversations = $this->getRecentCommunications();
            
            // Prepare status distribution for charts (fallback)
            $statusDistributionChart = [
                'approved' => 0,
                'pending' => 0,
                'rejected' => 0,
            ];
            
            return view('admin.dashboard', compact(
                'clientStats', 
                'vendorStats', 
                'chartData', 
                'filter',
                'advancedStats',
                'growthMetrics',
                'totalClients',
                'totalVendors',
                'pendingApprovals',
                'thisMonth',
                'avgClientsPerDay',
                'avgVendorsPerDay',
                'recentClients',
                'recentVendors',
                'approvedClients',
                'approvedVendors',
                'recentConversations'
            ))->with('statusDistribution', $statusDistributionChart);
        }
    }
    
    private function getDateRanges($filter)
    {
        $now = Carbon::now();
        
        switch ($filter) {
            case 'daily':
                return [
                    'today' => [$now->copy()->startOfDay(), $now->copy()->endOfDay()],
                    'yesterday' => [$now->copy()->subDay()->startOfDay(), $now->copy()->subDay()->endOfDay()],
                ];
            case 'monthly':
                return [
                    'this_month' => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
                    'last_month' => [$now->copy()->subMonth()->startOfMonth(), $now->copy()->subMonth()->endOfMonth()],
                ];
            case 'yearly':
                return [
                    'this_year' => [$now->copy()->startOfYear(), $now->copy()->endOfYear()],
                    'last_year' => [$now->copy()->subYear()->startOfYear(), $now->copy()->subYear()->endOfYear()],
                ];
            default:
                return $this->getDateRanges('daily');
        }
    }
    
    private function getEntityStats($model, $dateRanges)
    {
        $stats = [
            'total' => $model::count(),
        ];
        
        foreach ($dateRanges as $period => $range) {
            $stats[$period] = $model::whereBetween('created_at', $range)->count();
        }
        
        return $stats;
    }
    
    /**
     * Get recent communications combining both chat conversations and email communications
     */
    private function getRecentCommunications()
    {
        // Get recent chat conversations
        $chatConversations = \App\Models\ChatConversation::with(['client', 'vendor', 'lastMessageBy'])
            ->whereNotNull('last_message_at')
            ->get()
            ->map(function ($conversation) {
                return (object) [
                    'id' => $conversation->id,
                    'type' => 'chat',
                    'entity_type' => $conversation->entity_type,
                    'entity_id' => $conversation->entity_id,
                    'entityName' => $conversation->getEntity() ? $conversation->getEntity()->full_name ?? ($conversation->getEntity()->first_name . ' ' . $conversation->getEntity()->last_name) : 'Unknown',
                    'last_message_at' => $conversation->last_message_at,
                    'last_message_preview' => $conversation->last_message_preview,
                    'unread_count_admin' => $conversation->unread_count_admin ?? 0,
                    'created_at' => $conversation->created_at,
                ];
            });

        // Get recent email communications
        $emailCommunications = \App\Models\CommunicationLog::with(['adminUser'])
            ->where('status', 'sent')
            ->get()
            ->map(function ($communication) {
                // Get the entity (client or vendor)
                $entity = null;
                if ($communication->entity_type === 'client') {
                    $entity = \App\Models\Client::find($communication->entity_id);
                } elseif ($communication->entity_type === 'vendor') {
                    $entity = \App\Models\Vendor::find($communication->entity_id);
                }

                $entityName = 'Unknown';
                if ($entity) {
                    if ($communication->entity_type === 'client') {
                        $entityName = $entity->full_name ?? 'Unknown Client';
                    } else {
                        $entityName = ($entity->first_name . ' ' . $entity->last_name) ?? 'Unknown Vendor';
                    }
                }

                return (object) [
                    'id' => $communication->id,
                    'type' => 'email',
                    'entity_type' => $communication->entity_type,
                    'entity_id' => $communication->entity_id,
                    'entityName' => $entityName,
                    'last_message_at' => $communication->sent_at,
                    'last_message_preview' => $communication->message_preview,
                    'unread_count_admin' => 0, // Email communications don't have unread counts
                    'created_at' => $communication->created_at,
                    'subject' => $communication->subject,
                ];
            });

        // Combine both collections and sort by last_message_at
        $allCommunications = $chatConversations->concat($emailCommunications)
            ->sortByDesc('last_message_at')
            ->take(5);

        // If no recent communications, get any recent registrations
        if ($allCommunications->isEmpty()) {
            $recentClients = Client::orderBy('created_at', 'desc')->take(3)->get();
            $recentVendors = Vendor::orderBy('created_at', 'desc')->take(2)->get();
            
            $fallbackCommunications = collect();
            
            foreach ($recentClients as $client) {
                $fallbackCommunications->push((object) [
                    'id' => $client->id,
                    'type' => 'registration',
                    'entity_type' => 'client',
                    'entity_id' => $client->id,
                    'entityName' => $client->full_name ?? 'Unknown Client',
                    'last_message_at' => $client->created_at,
                    'last_message_preview' => 'New registration - no messages yet',
                    'unread_count_admin' => 0,
                    'created_at' => $client->created_at,
                ]);
            }
            
            foreach ($recentVendors as $vendor) {
                $fallbackCommunications->push((object) [
                    'id' => $vendor->id,
                    'type' => 'registration',
                    'entity_type' => 'vendor',
                    'entity_id' => $vendor->id,
                    'entityName' => ($vendor->first_name . ' ' . $vendor->last_name) ?? 'Unknown Vendor',
                    'last_message_at' => $vendor->created_at,
                    'last_message_preview' => 'New registration - no messages yet',
                    'unread_count_admin' => 0,
                    'created_at' => $vendor->created_at,
                ]);
            }
            
            return $fallbackCommunications->sortByDesc('last_message_at')->take(5);
        }

        return $allCommunications;
    }
    
    private function getChartData($filter)
    {
        $now = Carbon::now();
        $labels = [];
        $clientData = [];
        $vendorData = [];
        
        switch ($filter) {
            case 'daily':
                // Last 7 days
                for ($i = 6; $i >= 0; $i--) {
                    $date = $now->copy()->subDays($i);
                    $labels[] = $date->format('M j');
                    
                    $startOfDay = $date->copy()->startOfDay();
                    $endOfDay = $date->copy()->endOfDay();
                    
                    $clientData[] = Client::whereBetween('created_at', [$startOfDay, $endOfDay])->count();
                    $vendorData[] = Vendor::whereBetween('created_at', [$startOfDay, $endOfDay])->count();
                }
                break;
                
            case 'monthly':
                // Last 12 months
                for ($i = 11; $i >= 0; $i--) {
                    $date = $now->copy()->subMonths($i);
                    $labels[] = $date->format('M Y');
                    
                    $startOfMonth = $date->copy()->startOfMonth();
                    $endOfMonth = $date->copy()->endOfMonth();
                    
                    $clientData[] = Client::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
                    $vendorData[] = Vendor::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
                }
                break;
                
            case 'yearly':
                // Last 5 years
                for ($i = 4; $i >= 0; $i--) {
                    $year = $now->copy()->subYears($i)->year;
                    $labels[] = $year;
                    
                    $startOfYear = Carbon::createFromDate($year, 1, 1)->startOfYear();
                    $endOfYear = Carbon::createFromDate($year, 12, 31)->endOfYear();
                    
                    $clientData[] = Client::whereBetween('created_at', [$startOfYear, $endOfYear])->count();
                    $vendorData[] = Vendor::whereBetween('created_at', [$startOfYear, $endOfYear])->count();
                }
                break;
        }
        
        return [
            'labels' => $labels,
            'clients' => $clientData,
            'vendors' => $vendorData,
        ];
    }
    
    private function getAdvancedStats()
    {
        $now = Carbon::now();
        
        // Get total entities
        $totalClients = Client::count();
        $totalVendors = Vendor::count();
        $totalEntities = $totalClients + $totalVendors;
        
        // Get recent activity (last 30 days)
        $recentClients = Client::where('created_at', '>=', $now->copy()->subDays(30))->count();
        $recentVendors = Vendor::where('created_at', '>=', $now->copy()->subDays(30))->count();
        
        // Calculate growth rates
        $previousMonthClients = Client::whereBetween('created_at', [
            $now->copy()->subDays(60)->startOfDay(),
            $now->copy()->subDays(30)->endOfDay()
        ])->count();
        
        $previousMonthVendors = Vendor::whereBetween('created_at', [
            $now->copy()->subDays(60)->startOfDay(),
            $now->copy()->subDays(30)->endOfDay()
        ])->count();
        
        $clientGrowthRate = $previousMonthClients > 0 ? 
            (($recentClients - $previousMonthClients) / $previousMonthClients) * 100 : 
            ($recentClients > 0 ? 100 : 0);
            
        $vendorGrowthRate = $previousMonthVendors > 0 ? 
            (($recentVendors - $previousMonthVendors) / $previousMonthVendors) * 100 : 
            ($recentVendors > 0 ? 100 : 0);
        
        // Get average registrations per day (SQLite compatible)
        $avgClientsPerDay = 0;
        $avgVendorsPerDay = 0;
        
        if ($totalClients > 0) {
            $clientDateRange = Client::selectRaw('MIN(created_at) as min_date, MAX(created_at) as max_date')->first();
            if ($clientDateRange && $clientDateRange->min_date && $clientDateRange->max_date) {
                $daysDiff = Carbon::parse($clientDateRange->max_date)->diffInDays(Carbon::parse($clientDateRange->min_date)) + 1;
                $avgClientsPerDay = $daysDiff > 0 ? round($totalClients / $daysDiff, 1) : 0;
            }
        }
        
        if ($totalVendors > 0) {
            $vendorDateRange = Vendor::selectRaw('MIN(created_at) as min_date, MAX(created_at) as max_date')->first();
            if ($vendorDateRange && $vendorDateRange->min_date && $vendorDateRange->max_date) {
                $daysDiff = Carbon::parse($vendorDateRange->max_date)->diffInDays(Carbon::parse($vendorDateRange->min_date)) + 1;
                $avgVendorsPerDay = $daysDiff > 0 ? round($totalVendors / $daysDiff, 1) : 0;
            }
        }
        
        return [
            'total_entities' => $totalEntities,
            'client_percentage' => $totalEntities > 0 ? round(($totalClients / $totalEntities) * 100, 1) : 0,
            'vendor_percentage' => $totalEntities > 0 ? round(($totalVendors / $totalEntities) * 100, 1) : 0,
            'recent_clients' => $recentClients,
            'recent_vendors' => $recentVendors,
            'client_growth_rate' => round($clientGrowthRate, 1),
            'vendor_growth_rate' => round($vendorGrowthRate, 1),
            'avg_clients_per_day' => round($avgClientsPerDay, 1),
            'avg_vendors_per_day' => round($avgVendorsPerDay, 1),
        ];
    }
    
    private function getStatusDistribution()
    {
        // Get client status distribution (SQLite compatible)
        $clientStatuses = [];
        try {
            $clientStatuses = Client::selectRaw('CASE WHEN status IS NULL THEN "pending" ELSE status END as status, COUNT(*) as count')
                                    ->groupBy('status')
                                    ->pluck('count', 'status')
                                    ->toArray();
        } catch (\Exception $e) {
            // If status column doesn't exist, create default distribution
            $totalClients = Client::count();
            $clientStatuses = $totalClients > 0 ? ['pending' => $totalClients] : [];
        }
        
        // Get vendor status distribution (SQLite compatible)
        $vendorStatuses = [];
        try {
            $vendorStatuses = Vendor::selectRaw('CASE WHEN status IS NULL THEN "pending" ELSE status END as status, COUNT(*) as count')
                                    ->groupBy('status')
                                    ->pluck('count', 'status')
                                    ->toArray();
        } catch (\Exception $e) {
            // If status column doesn't exist, create default distribution
            $totalVendors = Vendor::count();
            $vendorStatuses = $totalVendors > 0 ? ['pending' => $totalVendors] : [];
        }
        
        return [
            'clients' => $clientStatuses,
            'vendors' => $vendorStatuses,
        ];
    }
    
    private function getGrowthMetrics()
    {
        $now = Carbon::now();
        
        // Get weekly growth for the last 8 weeks
        $weeklyData = [];
        for ($i = 7; $i >= 0; $i--) {
            $weekStart = $now->copy()->subWeeks($i)->startOfWeek();
            $weekEnd = $now->copy()->subWeeks($i)->endOfWeek();
            
            $weeklyData[] = [
                'week' => $weekStart->format('M j'),
                'clients' => Client::whereBetween('created_at', [$weekStart, $weekEnd])->count(),
                'vendors' => Vendor::whereBetween('created_at', [$weekStart, $weekEnd])->count(),
            ];
        }
        
        // Get hourly distribution for today
        $hourlyData = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $hourStart = $now->copy()->startOfDay()->addHours($hour);
            $hourEnd = $hourStart->copy()->addHour();
            
            $hourlyData[] = [
                'hour' => $hour,
                'clients' => Client::whereBetween('created_at', [$hourStart, $hourEnd])->count(),
                'vendors' => Vendor::whereBetween('created_at', [$hourStart, $hourEnd])->count(),
            ];
        }
        
        return [
            'weekly' => $weeklyData,
            'hourly' => $hourlyData,
        ];
    }
}
