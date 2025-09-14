@extends('layouts.admin-dark')

@section('admin-content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Settings</h1>
        <p class="text-purple-300">Manage system settings, user preferences, and configurations</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-xl text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-xl text-red-300">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Profile Settings -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Profile Settings</h2>
            </div>

            <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Current Password</label>
                    <input type="password" name="current_password" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Enter current password to change">
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">New Password</label>
                    <input type="password" name="password" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Leave blank to keep current password">
                </div>

                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                           placeholder="Confirm new password">
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-medium hover:from-purple-600 hover:to-pink-600 transition-all">
                    Update Profile
                </button>
            </form>
        </div>

        <!-- System Statistics -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">System Statistics</h2>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-2xl font-bold text-white">{{ $stats['total_clients'] }}</div>
                    <div class="text-sm text-purple-300">Total Clients</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-2xl font-bold text-white">{{ $stats['total_vendors'] }}</div>
                    <div class="text-sm text-purple-300">Total Vendors</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-2xl font-bold text-white">{{ $stats['pending_clients'] }}</div>
                    <div class="text-sm text-purple-300">Pending Clients</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-2xl font-bold text-white">{{ $stats['pending_vendors'] }}</div>
                    <div class="text-sm text-purple-300">Pending Vendors</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-2xl font-bold text-white">{{ $stats['approved_clients'] }}</div>
                    <div class="text-sm text-purple-300">Approved Clients</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-2xl font-bold text-white">{{ $stats['approved_vendors'] }}</div>
                    <div class="text-sm text-purple-300">Approved Vendors</div>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-emerald-400 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Email Configuration</h2>
            </div>

            <div class="space-y-4 mb-6">
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-sm text-purple-300 mb-1">Mail Driver</div>
                    <div class="text-white">{{ $emailSettings['mail_driver'] ?? 'Not configured' }}</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-sm text-purple-300 mb-1">SMTP Host</div>
                    <div class="text-white">{{ $emailSettings['mail_host'] ?? 'Not configured' }}</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                    <div class="text-sm text-purple-300 mb-1">From Address</div>
                    <div class="text-white">{{ $emailSettings['mail_from_address'] ?? 'Not configured' }}</div>
                </div>
            </div>

            <!-- Test Email -->
            <form action="{{ route('admin.settings.test-email') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-purple-300 mb-2">Test Email Address</label>
                    <input type="email" name="test_email" 
                           class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                           placeholder="Enter email to test">
                </div>
                <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition-all">
                    Send Test Email
                </button>
            </form>
        </div>

        <!-- System Actions -->
        <div class="bg-black/20 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">System Actions</h2>
            </div>

            <div class="space-y-4">
                <form action="{{ route('admin.settings.clear-cache') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-xl font-medium hover:from-blue-600 hover:to-indigo-600 transition-all">
                        Clear All Caches
                    </button>
                </form>

                <form action="{{ route('admin.settings.backup') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-xl font-medium hover:from-purple-600 hover:to-indigo-600 transition-all">
                        Backup Database
                    </button>
                </form>

                <div class="bg-yellow-500/20 border border-yellow-500/30 rounded-xl p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div class="text-yellow-300 text-sm">
                            <strong>Note:</strong> System actions may take a few moments to complete.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
