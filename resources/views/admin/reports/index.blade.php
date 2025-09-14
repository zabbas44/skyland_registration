@extends('layouts.admin-dark')

@section('admin-content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Reports & Analytics</h1>
        <p class="text-purple-300">Comprehensive insights into registrations, communications, and system performance</p>
    </div>

    <!-- Registration Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-white">{{ $registrationStats['clients']['total'] }}</div>
                    <div class="text-sm text-purple-300">Total Clients</div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Today:</span>
                    <span class="text-white">{{ $registrationStats['clients']['today'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Week:</span>
                    <span class="text-white">{{ $registrationStats['clients']['this_week'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Month:</span>
                    <span class="text-white">{{ $registrationStats['clients']['this_month'] }}</span>
                </div>
            </div>
        </div>

        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-emerald-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-white">{{ $registrationStats['vendors']['total'] }}</div>
                    <div class="text-sm text-purple-300">Total Vendors</div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Today:</span>
                    <span class="text-white">{{ $registrationStats['vendors']['today'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Week:</span>
                    <span class="text-white">{{ $registrationStats['vendors']['this_week'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Month:</span>
                    <span class="text-white">{{ $registrationStats['vendors']['this_month'] }}</span>
                </div>
            </div>
        </div>

        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-white">{{ $communicationStats['email_conversations']['total'] }}</div>
                    <div class="text-sm text-purple-300">Email Conversations</div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Replied:</span>
                    <span class="text-green-400">{{ $communicationStats['email_conversations']['replied'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Pending:</span>
                    <span class="text-yellow-400">{{ $communicationStats['email_conversations']['pending'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Month:</span>
                    <span class="text-white">{{ $communicationStats['email_conversations']['this_month'] }}</span>
                </div>
            </div>
        </div>

        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-white">{{ $communicationStats['communication_logs']['total'] }}</div>
                    <div class="text-sm text-purple-300">Communication Logs</div>
                </div>
            </div>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Today:</span>
                    <span class="text-white">{{ $communicationStats['communication_logs']['today'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Week:</span>
                    <span class="text-white">{{ $communicationStats['communication_logs']['this_week'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">This Month:</span>
                    <span class="text-white">{{ $communicationStats['communication_logs']['this_month'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Monthly Growth Chart -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-6">Monthly Registration Growth</h3>
            <div class="h-80">
                <canvas id="monthlyGrowthChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-6">Status Distribution</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-lg font-semibold text-purple-300 mb-4">Clients</h4>
                    <div class="h-40">
                        <canvas id="clientStatusChart"></canvas>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-purple-300 mb-4">Vendors</h4>
                    <div class="h-40">
                        <canvas id="vendorStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Export Client Data</h3>
            <p class="text-purple-300 mb-4">Download client registration data in various formats</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.reports.export-clients', ['format' => 'csv']) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg font-medium hover:from-blue-600 hover:to-cyan-600 transition-all">
                    Export All Clients (CSV)
                </a>
                <a href="{{ route('admin.reports.export-clients', ['format' => 'csv', 'status' => 'approved']) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                    Export Approved (CSV)
                </a>
                <a href="{{ route('admin.reports.export-clients', ['format' => 'csv', 'status' => 'pending']) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg font-medium hover:from-yellow-600 hover:to-orange-600 transition-all">
                    Export Pending (CSV)
                </a>
            </div>
        </div>

        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <h3 class="text-xl font-bold text-white mb-4">Export Vendor Data</h3>
            <p class="text-purple-300 mb-4">Download vendor registration data in various formats</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.reports.export-vendors', ['format' => 'csv']) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-lg font-medium hover:from-blue-600 hover:to-cyan-600 transition-all">
                    Export All Vendors (CSV)
                </a>
                <a href="{{ route('admin.reports.export-vendors', ['format' => 'csv', 'status' => 'approved']) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-lg font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                    Export Approved (CSV)
                </a>
                <a href="{{ route('admin.reports.export-vendors', ['format' => 'csv', 'status' => 'pending']) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-lg font-medium hover:from-yellow-600 hover:to-orange-600 transition-all">
                    Export Pending (CSV)
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
        <h3 class="text-xl font-bold text-white mb-6">Recent Activities</h3>
        <div class="space-y-4">
            @forelse($recentActivities as $activity)
                <div class="flex items-center p-4 bg-white/5 rounded-xl">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-4
                        @if($activity['type'] === 'client_registration') bg-blue-500/20
                        @elseif($activity['type'] === 'vendor_registration') bg-green-500/20
                        @else bg-purple-500/20
                        @endif">
                        @if($activity['type'] === 'client_registration')
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        @elseif($activity['type'] === 'vendor_registration')
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="text-white font-medium">{{ $activity['title'] }}</div>
                        <div class="text-purple-300 text-sm">{{ $activity['description'] }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-gray-400 text-sm">{{ $activity['date']->format('M d, Y') }}</div>
                        <div class="text-xs px-2 py-1 rounded-full
                            @if($activity['status'] === 'approved') bg-green-500/20 text-green-400
                            @elseif($activity['status'] === 'rejected') bg-red-500/20 text-red-400
                            @elseif($activity['status'] === 'replied') bg-blue-500/20 text-blue-400
                            @else bg-yellow-500/20 text-yellow-400
                            @endif">
                            {{ ucfirst($activity['status']) }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <div class="text-gray-400">No recent activities found</div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Growth Chart
    const monthlyGrowthCtx = document.getElementById('monthlyGrowthChart').getContext('2d');
    new Chart(monthlyGrowthCtx, {
        type: 'line',
        data: {
            labels: @json($monthlyGrowth['months']),
            datasets: [{
                label: 'Clients',
                data: @json($monthlyGrowth['clients']),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4
            }, {
                label: 'Vendors',
                data: @json($monthlyGrowth['vendors']),
                borderColor: 'rgb(34, 197, 94)',
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: 'white'
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                y: {
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.7)'
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                }
            }
        }
    });

    // Client Status Chart
    const clientStatusCtx = document.getElementById('clientStatusChart').getContext('2d');
    const clientStatusData = @json($statusDistribution['clients']);
    new Chart(clientStatusCtx, {
        type: 'doughnut',
        data: {
            labels: clientStatusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(1)),
            datasets: [{
                data: clientStatusData.map(item => item.count),
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: 'white',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Vendor Status Chart
    const vendorStatusCtx = document.getElementById('vendorStatusChart').getContext('2d');
    const vendorStatusData = @json($statusDistribution['vendors']);
    new Chart(vendorStatusCtx, {
        type: 'doughnut',
        data: {
            labels: vendorStatusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(1)),
            datasets: [{
                data: vendorStatusData.map(item => item.count),
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',
                    'rgba(239, 68, 68, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: 'white',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection
