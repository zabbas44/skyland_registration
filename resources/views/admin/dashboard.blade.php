@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('admin-content')
<!-- Filter Buttons with Glass Effect -->
<div class="mb-8">
    <div class="flex space-x-4">
        <a href="{{ route('admin.dashboard', ['filter' => 'daily']) }}" 
           class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm border shadow-lg {{ $filter === 'daily' ? 'bg-orange-500/30 text-orange-200 border-orange-400/50 shadow-orange-500/20' : 'bg-white/10 text-slate-300 border-white/20 hover:bg-white/20 hover:text-white hover:border-white/30' }}">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
            </svg>
            Daily
        </a>
        <a href="{{ route('admin.dashboard', ['filter' => 'monthly']) }}" 
           class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm border shadow-lg {{ $filter === 'monthly' ? 'bg-orange-500/30 text-orange-200 border-orange-400/50 shadow-orange-500/20' : 'bg-white/10 text-slate-300 border-white/20 hover:bg-white/20 hover:text-white hover:border-white/30' }}">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Monthly
        </a>
        <a href="{{ route('admin.dashboard', ['filter' => 'yearly']) }}" 
           class="px-6 py-3 rounded-xl text-sm font-medium transition-all duration-300 backdrop-blur-sm border shadow-lg {{ $filter === 'yearly' ? 'bg-orange-500/30 text-orange-200 border-orange-400/50 shadow-orange-500/20' : 'bg-white/10 text-slate-300 border-white/20 hover:bg-white/20 hover:text-white hover:border-white/30' }}">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Yearly
        </a>
    </div>
</div>

<!-- Statistics Cards with Glass Effect -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Clients -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center group-hover:bg-blue-500/30 transition-colors duration-300">
                        <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-300 truncate">Total Clients</dt>
                        <dd class="text-2xl font-bold text-white mt-1">{{ number_format($clientStats['total']) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Vendors -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-emerald-500/20 rounded-xl flex items-center justify-center group-hover:bg-emerald-500/30 transition-colors duration-300">
                        <svg class="h-6 w-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-300 truncate">Total Vendors</dt>
                        <dd class="text-2xl font-bold text-white mt-1">{{ number_format($vendorStats['total']) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Period Clients -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center group-hover:bg-purple-500/30 transition-colors duration-300">
                        <svg class="h-6 w-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        @if($filter === 'daily')
                            <dt class="text-sm font-medium text-slate-300 truncate">Today's Clients</dt>
                            <dd class="text-2xl font-bold text-white mt-1">{{ number_format($clientStats['today'] ?? 0) }}</dd>
                        @elseif($filter === 'monthly')
                            <dt class="text-sm font-medium text-slate-300 truncate">This Month's Clients</dt>
                            <dd class="text-2xl font-bold text-white mt-1">{{ number_format($clientStats['this_month'] ?? 0) }}</dd>
                        @else
                            <dt class="text-sm font-medium text-slate-300 truncate">This Year's Clients</dt>
                            <dd class="text-2xl font-bold text-white mt-1">{{ number_format($clientStats['this_year'] ?? 0) }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Period Vendors -->
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 group">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center group-hover:bg-orange-500/30 transition-colors duration-300">
                        <svg class="h-6 w-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        @if($filter === 'daily')
                            <dt class="text-sm font-medium text-slate-300 truncate">Today's Vendors</dt>
                            <dd class="text-2xl font-bold text-white mt-1">{{ number_format($vendorStats['today'] ?? 0) }}</dd>
                        @elseif($filter === 'monthly')
                            <dt class="text-sm font-medium text-slate-300 truncate">This Month's Vendors</dt>
                            <dd class="text-2xl font-bold text-white mt-1">{{ number_format($vendorStats['this_month'] ?? 0) }}</dd>
                        @else
                            <dt class="text-sm font-medium text-slate-300 truncate">This Year's Vendors</dt>
                            <dd class="text-2xl font-bold text-white mt-1">{{ number_format($vendorStats['this_year'] ?? 0) }}</dd>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Chart with Glass Effect -->
<div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl mb-8">
    <div class="px-6 py-6">
        <div class="flex items-center mb-6">
            <div class="w-10 h-10 bg-gradient-to-r from-orange-500/20 to-red-500/20 rounded-xl flex items-center justify-center mr-4">
                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white font-['Inter',_'system-ui',_sans-serif]">
                    Registration Trends
                </h3>
                <p class="text-slate-300 text-sm">
                    @if($filter === 'daily')
                        Last 7 Days Performance
                    @elseif($filter === 'monthly')
                        Last 12 Months Performance
                    @else
                        Last 5 Years Performance
                    @endif
                </p>
            </div>
        </div>
        <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10">
            <canvas id="registrationChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Quick Actions with Glass Effect -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl">
        <div class="px-6 py-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white font-['Inter',_'system-ui',_sans-serif]">Quick Actions</h3>
            </div>
            <div class="flex flex-col space-y-4">
                <a href="{{ route('admin.clients.index') }}" 
                   class="group flex items-center px-5 py-4 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-400/30 hover:border-blue-400/50 text-blue-200 hover:text-blue-100 rounded-xl transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    View All Clients
                </a>
                <a href="{{ route('admin.vendors.index') }}" 
                   class="group flex items-center px-5 py-4 bg-emerald-500/20 hover:bg-emerald-500/30 border border-emerald-400/30 hover:border-emerald-400/50 text-emerald-200 hover:text-emerald-100 rounded-xl transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    View All Vendors
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-xl">
        <div class="px-6 py-6">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-purple-500/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white font-['Inter',_'system-ui',_sans-serif]">System Status</h3>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-white/5 rounded-xl border border-white/10">
                    <span class="text-slate-300 font-medium">Total Entities</span>
                    <span class="text-white font-bold text-lg">{{ number_format($clientStats['total'] + $vendorStats['total']) }}</span>
                </div>
                <div class="flex items-center p-4 bg-emerald-500/10 rounded-xl border border-emerald-400/20">
                    <svg class="w-5 h-5 text-emerald-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-emerald-200 font-medium">System Running Smoothly</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Modern Chart.js configuration with glass theme
    const ctx = document.getElementById('registrationChart').getContext('2d');
    
    // Create gradients
    const clientGradient = ctx.createLinearGradient(0, 0, 0, 400);
    clientGradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
    clientGradient.addColorStop(1, 'rgba(59, 130, 246, 0.05)');
    
    const vendorGradient = ctx.createLinearGradient(0, 0, 0, 400);
    vendorGradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
    vendorGradient.addColorStop(1, 'rgba(16, 185, 129, 0.05)');
    
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [
                {
                    label: '👥 Clients',
                    data: {!! json_encode($chartData['clients']) !!},
                    borderColor: 'rgba(59, 130, 246, 0.9)',
                    backgroundColor: clientGradient,
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                    pointBorderColor: 'rgba(255, 255, 255, 0.8)',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    tension: 0.4,
                    fill: true,
                    shadowColor: 'rgba(59, 130, 246, 0.3)',
                    shadowBlur: 10
                },
                {
                    label: '🏢 Vendors',
                    data: {!! json_encode($chartData['vendors']) !!},
                    borderColor: 'rgba(16, 185, 129, 0.9)',
                    backgroundColor: vendorGradient,
                    borderWidth: 3,
                    pointBackgroundColor: 'rgba(16, 185, 129, 1)',
                    pointBorderColor: 'rgba(255, 255, 255, 0.8)',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    tension: 0.4,
                    fill: true,
                    shadowColor: 'rgba(16, 185, 129, 0.3)',
                    shadowBlur: 10
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        borderColor: 'rgba(255, 255, 255, 0.2)'
                    },
                    ticks: {
                        color: 'rgba(255, 255, 255, 0.8)',
                        font: {
                            family: 'Inter, system-ui, sans-serif',
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)',
                        borderColor: 'rgba(255, 255, 255, 0.2)'
                    },
                    ticks: {
                        stepSize: 1,
                        color: 'rgba(255, 255, 255, 0.8)',
                        font: {
                            family: 'Inter, system-ui, sans-serif',
                            size: 12
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'rgba(255, 255, 255, 0.9)',
                        font: {
                            family: 'Inter, system-ui, sans-serif',
                            size: 14,
                            weight: '500'
                        },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    backdropFilter: 'blur(10px)',
                    titleColor: 'rgba(255, 255, 255, 0.9)',
                    bodyColor: 'rgba(255, 255, 255, 0.8)',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 12,
                    titleFont: {
                        family: 'Inter, system-ui, sans-serif',
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        family: 'Inter, system-ui, sans-serif',
                        size: 13
                    }
                }
            },
            elements: {
                point: {
                    hoverBorderWidth: 3
                },
                line: {
                    borderJoinStyle: 'round',
                    borderCapStyle: 'round'
                }
            }
        }
    });
</script>
@endpush
