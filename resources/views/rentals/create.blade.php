<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rent a Car') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Car Information -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $car->brand }} {{ $car->model }}</h3>
                            <p class="text-gray-600 mt-1">{{ $car->year }} • {{ $car->color }}</p>

                            @if($car->image)
                                <img src="{{ Storage::url($car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" 
                                    class="mt-4 w-full h-64 object-cover rounded-lg shadow-md">
                            @endif

                            <div class="mt-6 space-y-4">
                                <h4 class="text-lg font-semibold text-gray-900">Car Specifications</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Transmission</p>
                                        <p class="font-medium capitalize">{{ $car->transmission }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Fuel Type</p>
                                        <p class="font-medium capitalize">{{ $car->fuel_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Seats</p>
                                        <p class="font-medium">{{ $car->seats }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Luggage</p>
                                        <p class="font-medium">{{ $car->luggage }} bags</p>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <p class="text-2xl font-bold text-blue-600">${{ number_format($car->price_per_day, 2) }}<span class="text-sm text-gray-600">/day</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Form -->
                        <div>
                            <form action="{{ route('rentals.store') }}" method="POST" class="space-y-6">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">

                                <div>
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-text-input id="start_date" name="start_date" type="datetime-local" class="mt-1 block w-full" 
                                        value="{{ old('start_date') }}" required min="{{ date('Y-m-d\TH:i') }}" />
                                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-text-input id="end_date" name="end_date" type="datetime-local" class="mt-1 block w-full" 
                                        value="{{ old('end_date') }}" required min="{{ date('Y-m-d\TH:i') }}" />
                                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="pickup_location" :value="__('Pickup Location')" />
                                    <x-text-input id="pickup_location" name="pickup_location" type="text" class="mt-1 block w-full" 
                                        value="{{ old('pickup_location') }}" required />
                                    <x-input-error :messages="$errors->get('pickup_location')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="dropoff_location" :value="__('Dropoff Location')" />
                                    <x-text-input id="dropoff_location" name="dropoff_location" type="text" class="mt-1 block w-full" 
                                        value="{{ old('dropoff_location') }}" required />
                                    <x-input-error :messages="$errors->get('dropoff_location')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="notes" :value="__('Notes (Optional)')" />
                                    <textarea id="notes" name="notes" rows="4" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('cars.show', $car) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Cancel
                                    </a>
                                    <x-primary-button>
                                        {{ __('Confirm Rental') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 