<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::query();

        // Search by brand, model, or location
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }

        // Filter by transmission
        if ($request->has('transmission') && $request->transmission !== '') {
            $query->where('transmission', $request->transmission);
        }

        // Filter by fuel type
        if ($request->has('fuel_type') && $request->fuel_type !== '') {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter by price range
        if ($request->has('price_range') && $request->price_range !== '') {
            switch ($request->price_range) {
                case '0-50':
                    $query->where('price_per_day', '<=', 50);
                    break;
                case '51-100':
                    $query->whereBetween('price_per_day', [51, 100]);
                    break;
                case '101-200':
                    $query->whereBetween('price_per_day', [101, 200]);
                    break;
                case '201+':
                    $query->where('price_per_day', '>', 200);
                    break;
            }
        }

        // Get paginated results
        $cars = $query->paginate(9)->withQueryString();

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'seats' => 'required|integer|min:1',
            'luggage' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:available,rented,maintenance',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'seats' => 'required|integer|min:1',
            'luggage' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($validated);

        return redirect()->route('cars.index')
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully.');
    }
}
