<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-gray-800">
                {{ __('Add New Car') }}
            </h2>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Cars
            </a>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                                        id="brand" name="brand" value="{{ old('brand') }}" required>
                                    @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                        id="model" name="model" value="{{ old('model') }}" required>
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                        id="year" name="year" value="{{ old('year') }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="sedan" {{ old('category') === 'sedan' ? 'selected' : '' }}>Sedan</option>
                                        <option value="suv" {{ old('category') === 'suv' ? 'selected' : '' }}>SUV</option>
                                        <option value="luxury" {{ old('category') === 'luxury' ? 'selected' : '' }}>Luxury</option>
                                        <option value="sports" {{ old('category') === 'sports' ? 'selected' : '' }}>Sports</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="transmission" class="form-label">Transmission</label>
                                    <select class="form-select @error('transmission') is-invalid @enderror" 
                                        id="transmission" name="transmission" required>
                                        <option value="">Select Transmission</option>
                                        <option value="automatic" {{ old('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                                        <option value="manual" {{ old('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                                    </select>
                                    @error('transmission')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fuel_type" class="form-label">Fuel Type</label>
                                    <select class="form-select @error('fuel_type') is-invalid @enderror" 
                                        id="fuel_type" name="fuel_type" required>
                                        <option value="">Select Fuel Type</option>
                                        <option value="petrol" {{ old('fuel_type') === 'petrol' ? 'selected' : '' }}>Petrol</option>
                                        <option value="diesel" {{ old('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="electric" {{ old('fuel_type') === 'electric' ? 'selected' : '' }}>Electric</option>
                                    </select>
                                    @error('fuel_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="seats" class="form-label">Number of Seats</label>
                                    <input type="number" class="form-control @error('seats') is-invalid @enderror" 
                                        id="seats" name="seats" value="{{ old('seats') }}" required>
                                    @error('seats')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="luggage_capacity" class="form-label">Luggage Capacity (bags)</label>
                                    <input type="number" class="form-control @error('luggage_capacity') is-invalid @enderror" 
                                        id="luggage_capacity" name="luggage_capacity" value="{{ old('luggage_capacity') }}" required>
                                    @error('luggage_capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price_per_day" class="form-label">Price per Day ($)</label>
                                    <input type="number" step="0.01" class="form-control @error('price_per_day') is-invalid @enderror" 
                                        id="price_per_day" name="price_per_day" value="{{ old('price_per_day') }}" required>
                                    @error('price_per_day')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Car Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                        id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>Add Car
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>