<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Redirect admin users to admin dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Load the related entity (client or supplier)
        $entity = $user->getRelatedEntity();
        
        if ($user->isClient()) {
            return view('dashboard.client', [
                'user' => $user,
                'client' => $entity
            ]);
        }
        
        if ($user->isSupplier()) {
            return view('dashboard.supplier', [
                'user' => $user,
                'supplier' => $entity
            ]);
        }
        
        // Fallback - shouldn't happen
        return redirect()->route('login');
    }
}
