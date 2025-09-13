<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Not Available - SKYLAND</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .chat-bg {
            background: linear-gradient(135deg, 
                rgba(74, 144, 226, 0.1) 0%, 
                rgba(80, 200, 120, 0.1) 50%, 
                rgba(255, 206, 84, 0.1) 100%);
        }
    </style>
</head>
<body class="chat-bg min-h-screen flex items-center justify-center">
    
    <div class="glass rounded-2xl p-8 w-full max-w-md mx-4 text-center">
        <!-- Icon -->
        <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        
        <!-- Title -->
        <h1 class="text-2xl font-bold text-white mb-4">Chat Not Available</h1>
        
        <!-- Message -->
        <p class="text-white/80 mb-6 leading-relaxed">
            Chat functionality is only available for approved clients and vendors. 
            Your registration is currently under review by our admin team.
        </p>
        
        <!-- Status Info -->
        <div class="bg-white/10 rounded-xl p-4 mb-6">
            <div class="flex items-center justify-center gap-2 text-yellow-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">Status: Pending Approval</span>
            </div>
            <p class="text-white/70 text-sm mt-2">
                You will receive an email notification once your registration is reviewed.
            </p>
        </div>
        
        <!-- Actions -->
        <div class="space-y-3">
            <a href="{{ route('dashboard') }}" 
               class="block w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-xl hover:from-blue-600 hover:to-green-600 transition-colors font-medium">
                Back to Dashboard
            </a>
            
            <p class="text-white/60 text-sm">
                Need help? Contact us at 
                <a href="mailto:support@skyland.com" class="text-blue-300 hover:text-blue-200">
                    support@skyland.com
                </a>
            </p>
        </div>
    </div>
    
</body>
</html>
