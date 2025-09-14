@extends('layouts.admin-dark')

@section('title', 'Interactive Registration Map')
@section('page-title', 'Interactive Registration Map')

@section('admin-content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white mb-2">Interactive Registration Map</h1>
        <p class="text-slate-300">Create and publish interactive maps with live registration data</p>
    </div>

    <!-- ZeeMaps Integration Container -->
    <div class="bg-gradient-to-br from-slate-500/10 to-gray-500/10 backdrop-blur-xl border border-white/10 rounded-2xl p-8">
        
        <!-- Map Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-semibold text-white">Global Registration Activity</h2>
                <p class="text-slate-300 text-sm">Powered by ZeeMaps - Interactive mapping solution</p>
            </div>
            <div class="flex items-center space-x-2 bg-green-500/20 text-green-300 px-3 py-1 rounded-lg text-sm">
                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                <span>Live Data</span>
            </div>
        </div>

        <!-- ZeeMaps Embed Container -->
        <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700/50 min-h-[500px] flex items-center justify-center">
            <div class="text-center">
                <div class="text-white text-lg mb-4">🗺️ ZeeMaps Integration Ready</div>
                <p class="text-slate-300 mb-4">
                    Integrate your ZeeMaps embed code here to display:
                </p>
                <ul class="text-slate-400 text-sm space-y-2 mb-6">
                    <li>• Unlimited registration markers</li>
                    <li>• Real-time location tracking</li>
                    <li>• Custom fields for client/vendor data</li>
                    <li>• Interactive map controls</li>
                    <li>• Mobile-friendly display</li>
                </ul>
                
                <!-- Placeholder for ZeeMaps embed -->
                <div class="bg-slate-800/50 border-2 border-dashed border-slate-600 rounded-lg p-8">
                    <p class="text-slate-400 text-sm">
                        Replace this section with your ZeeMaps embed code
                    </p>
                    <code class="text-green-400 text-xs block mt-2">
                        &lt;iframe src="https://www.zeemaps.com/map?group=..." width="100%" height="500"&gt;&lt;/iframe&gt;
                    </code>
                </div>
            </div>
        </div>

        <!-- Map Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <h3 class="text-white font-semibold mb-2">Total Locations</h3>
                <div class="text-2xl font-bold text-blue-400">2,097</div>
                <div class="text-slate-400 text-sm">Active markers</div>
            </div>
            
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <h3 class="text-white font-semibold mb-2">Countries</h3>
                <div class="text-2xl font-bold text-emerald-400">47</div>
                <div class="text-slate-400 text-sm">Global coverage</div>
            </div>
            
            <div class="bg-white/5 rounded-lg p-4 border border-white/10">
                <h3 class="text-white font-semibold mb-2">Live Updates</h3>
                <div class="text-2xl font-bold text-purple-400">Real-time</div>
                <div class="text-slate-400 text-sm">Data synchronization</div>
            </div>
        </div>
    </div>
</div>
@endsection
