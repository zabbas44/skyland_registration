<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending Approval - SKY LAND CONSTRUCTION LLC OPC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="glass-effect rounded-2xl p-8 max-w-md w-full mx-4 text-center">
        <div class="w-20 h-20 bg-yellow-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
        </div>
        
        <h1 class="text-white text-2xl font-bold mb-4">Account Pending Approval</h1>
        
        <p class="text-purple-200 text-sm mb-6">
            Your account is currently pending approval by our admin team. Once approved, you'll be able to access the conversation system and communicate with our team.
        </p>
        
        <div class="space-y-3">
            <button onclick="window.location.href='/dashboard'" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg transition-colors">
                Back to Dashboard
            </button>
            
            <button onclick="location.reload()" class="w-full bg-white/20 hover:bg-white/30 text-white py-2 px-4 rounded-lg transition-colors">
                Check Status
            </button>
        </div>
        
        <div class="mt-6 pt-6 border-t border-white/20">
            <p class="text-purple-300 text-xs">
                Need immediate assistance? Contact us at: 
                <a href="mailto:info@skylandconstruction.com" class="text-blue-300 hover:text-blue-200">
                    info@skylandconstruction.com
                </a>
            </p>
        </div>
    </div>
</body>
</html>


