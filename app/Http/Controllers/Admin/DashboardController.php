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
        // Get filter parameters
        $filter = $request->get('filter', 'daily');
        
        // Calculate date ranges based on filter
        $dateRanges = $this->getDateRanges($filter);
        
        // Get statistics for clients and vendors
        $clientStats = $this->getEntityStats(Client::class, $dateRanges);
        $vendorStats = $this->getEntityStats(Vendor::class, $dateRanges);
        
        // Get chart data for the selected filter
        $chartData = $this->getChartData($filter);
        
        return view('admin.dashboard', compact('clientStats', 'vendorStats', 'chartData', 'filter'));
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
}
