<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get car statistics
        $availableCars = Car::where('status', 'available')->count();
        
        // Get rental statistics
        $recentRentals = $user->rentals()
            ->with('car')
            ->latest()
            ->take(5)
            ->get();
            
        $upcomingRentals = $user->rentals()
            ->with('car')
            ->where('start_date', '>', Carbon::now())
            ->where('status', 'pending')
            ->orderBy('start_date')
            ->take(5)
            ->get();
            
        $activeRentals = $user->rentals()->where('status', 'active')->count();
        
        // Calculate total revenue (for admin only)
        $totalRevenue = $user->isAdmin() 
            ? Rental::where('status', 'completed')->sum('total_price')
            : 0;
            
        // Get total customers (for admin only)
        $totalCustomers = $user->isAdmin() 
            ? User::where('role', 'customer')->count()
            : 0;
            
        // Get recent notifications (if notifications table exists)
        try {
            $notifications = $user->notifications()
                ->latest()
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            $notifications = collect([]); // Empty collection if notifications table doesn't exist
        }
            
        // Get system status
        $lastMaintenance = Carbon::now()->subDays(7)->format('M d, Y H:i');

        return view('dashboard', compact(
            'recentRentals',
            'upcomingRentals',
            'activeRentals',
            'availableCars',
            'totalRevenue',
            'totalCustomers',
            'notifications',
            'lastMaintenance'
        ));
    }
} 