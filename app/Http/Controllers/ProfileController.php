<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Rental;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $activeRentals = Rental::where('status', 'active')
                              ->orWhere('status', 'pending')
                              ->get();

        $completedRentals = Rental::where('status', 'completed')
                                 ->get();

        $canceledBookings = Rental::where('status', 'canceled')
                                 ->get();

        // Get payment methods for the authenticated user
        $paymentMethods = Auth::user()->paymentMethods ?? collect([]);

        // Add transactions - adjust the query based on your transaction model
        $transactions = Auth::user()->transactions ?? collect([]);
        // Or if you have a Transaction model:
        // $transactions = Transaction::where('user_id', Auth::id())->get();

        // Add reviews - adjust based on your Review model
        $reviews = Auth::user()->reviews ?? collect([]);
        // Or if you have a Review model:
        // $reviews = Review::where('user_id', Auth::id())->get();

        // Calculate user rating (average of all reviews)
        $userRating = $reviews->avg('rating') ?? 0;

        // Add login history - adjust based on your LoginHistory model
        $loginHistory = Auth::user()->loginHistory ?? collect([]);
        // Or if you have a LoginHistory model:
        // $loginHistory = LoginHistory::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('profile.edit', [
            'user' => Auth::user(),
            'activeRentals' => $activeRentals,
            'completedRentals' => $completedRentals,
            'canceledBookings' => $canceledBookings,
            'paymentMethods' => $paymentMethods,
            'transactions' => $transactions,
            'reviews' => $reviews,
            'userRating' => $userRating,
            'loginHistory' => $loginHistory,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle the photo upload logic here
        if ($request->hasFile('photo')) {
            // Your photo update logic
        }

        return back()->with('success', 'Profile photo updated successfully');
    }

    public function index()
    {
        $activeRentals = Rental::where('status', 'active')
                              ->orWhere('status', 'pending')
                              ->get();
        
        return view('your-view-name', compact('activeRentals'));
    }

    public function updateBilling(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            // Add any other validation rules you need
        ]);

        // Add your billing update logic here
        // This will depend on your payment provider (Stripe, PayPal, etc.)

        return back()->with('success', 'Billing information updated successfully');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function addPaymentMethod(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|string',
            'card_number' => 'required_if:payment_type,card',
            'expiry_date' => 'required_if:payment_type,card',
            'cvv' => 'required_if:payment_type,card',
            // Add other validation rules as needed
        ]);

        // Add your payment method logic here
        // This will depend on your payment provider (Stripe, PayPal, etc.)

        return back()->with('success', 'Payment method added successfully');
    }
}
