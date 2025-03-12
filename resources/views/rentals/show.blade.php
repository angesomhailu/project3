<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rental Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Car Information -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $rental->car->brand }} {{ $rental->car->model }}</h3>
                            <p class="text-gray-600 mt-1">{{ $rental->car->year }} • {{ $rental->car->color }}</p>

                            @if($rental->car->image)
                                <img src="{{ Storage::url($rental->car->image) }}" alt="{{ $rental->car->brand }} {{ $rental->car->model }}" 
                                    class="mt-4 w-full h-64 object-cover rounded-lg shadow-md">
                            @endif

                            <div class="mt-6 space-y-4">
                                <h4 class="text-lg font-semibold text-gray-900">Car Specifications</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Transmission</p>
                                        <p class="font-medium capitalize">{{ $rental->car->transmission }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Fuel Type</p>
                                        <p class="font-medium capitalize">{{ $rental->car->fuel_type }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Seats</p>
                                        <p class="font-medium">{{ $rental->car->seats }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Luggage</p>
                                        <p class="font-medium">{{ $rental->car->luggage }} bags</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Information -->
                        <div class="space-y-6">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Rental Status</h4>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2
                                    @if($rental->status === 'active') bg-green-100 text-green-800
                                    @elseif($rental->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($rental->status === 'completed') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($rental->status) }}
                                </span>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Rental Details</h4>
                                <div class="mt-4 space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Start Date</p>
                                        <p class="font-medium">{{ $rental->start_date->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">End Date</p>
                                        <p class="font-medium">{{ $rental->end_date->format('M d, Y') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Total Price</p>
                                        <p class="font-medium text-2xl text-blue-600">${{ number_format($rental->total_price, 2) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Pickup Location</p>
                                        <p class="font-medium">{{ $rental->pickup_location }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Dropoff Location</p>
                                        <p class="font-medium">{{ $rental->dropoff_location }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($rental->notes)
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Notes</h4>
                                    <p class="mt-2 text-gray-600">{{ $rental->notes }}</p>
                                </div>
                            @endif

                            <div class="flex space-x-4">
                                @if(auth()->user()->isAdmin())
                                    <form action="{{ route('rentals.update', $rental) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Mark as Completed
                                        </button>
                                    </form>
                                @endif

                                @if($rental->status === 'pending')
                                    <form action="{{ route('rentals.destroy', $rental) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
                                            onclick="return confirm('Are you sure you want to cancel this rental?')">
                                            Cancel Rental
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('rentals.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Back to Rentals
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 