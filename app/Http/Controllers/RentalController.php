<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = auth()->user()->rentals()->latest()->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Car $car = null)
    {
        if (!$car) {
            return redirect()->route('cars.index')
                ->with('error', 'Please select a car first');
        }
        
        return view('rentals.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $car = Car::findOrFail($validated['car_id']);
        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $days = $startDate->diffInDays($endDate) + 1;
        $totalPrice = $car->price_per_day * $days;

        $rental = auth()->user()->rentals()->create([
            'user_id' => auth()->id(),
            'car_id' => $validated['car_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $totalPrice,
            'pickup_location' => $validated['pickup_location'],
            'dropoff_location' => $validated['dropoff_location'],
            'notes' => $validated['notes'],
        ]);

        $car->update(['status' => 'rented']);

        return redirect()->route('rentals.show', $rental)
            ->with('success', 'Rental created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        $this->authorize('view', $rental);
        return view('rentals.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        $this->authorize('update', $rental);
        return view('rentals.edit', compact('rental'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $this->authorize('update', $rental);

        $validated = $request->validate([
            'status' => 'required|in:pending,active,completed,cancelled',
        ]);

        $rental->update($validated);

        if ($validated['status'] === 'completed' || $validated['status'] === 'cancelled') {
            $rental->car->update(['status' => 'available']);
        }

        return redirect()->route('rentals.show', $rental)
            ->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $this->authorize('delete', $rental);

        $rental->car->update(['status' => 'available']);
        $rental->delete();

        return redirect()->route('rentals.index')
            ->with('success', 'Rental deleted successfully.');
    }
}
