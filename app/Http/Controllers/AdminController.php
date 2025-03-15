<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_cars' => Car::count(),
            'available_cars' => Car::where('status', 'available')->count(),
            'total_users' => User::count(),
            'active_rentals' => Rental::where('status', 'active')->count(),
        ];

        $users = User::latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'users'));
    }

    public function cars()
    {
        $cars = Car::latest()->paginate(10);
        return view('admin.cars', compact('cars'));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function rentals()
    {
        $rentals = Rental::with(['user', 'car'])->latest()->paginate(10);
        return view('admin.rentals', compact('rentals'));
    }

    public function transactions()
    {
        $transactions = Transaction::with(['user', 'rental'])->latest()->paginate(10);
        return view('admin.transactions', compact('transactions'));
    }

    public function makeAdmin(User $user)
    {
        if (Auth::user()->is_admin && Auth::id() !== $user->id) {
            $user->is_admin = true;
            $user->save();
            return back()->with('success', 'User has been made an admin.');
        }
        return back()->with('error', 'Unauthorized action.');
    }

    public function removeAdmin(User $user)
    {
        if (Auth::user()->is_admin && Auth::id() !== $user->id) {
            $user->is_admin = false;
            $user->save();
            return back()->with('success', 'Admin privileges have been removed.');
        }
        return back()->with('error', 'Unauthorized action.');
    }
} 