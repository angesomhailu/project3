<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $car->brand }} {{ $car->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Car Image -->
                        <div class="relative">
                            @if($car->image)
                                <img src="{{ Storage::url($car->image) }}" alt="{{ $car->brand }} {{ $car->model }}" 
                                    class="w-full h-96 object-cover rounded-lg shadow-lg">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-lg">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Car Details -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $car->brand }} {{ $car->model }}</h3>
                                <p class="text-gray-600">{{ $car->year }} • {{ $car->color }}</p>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-3xl font-bold text-blue-600">${{ number_format($car->price_per_day, 2) }}<span class="text-sm text-gray-600">/day</span></p>
                                <p class="text-sm text-gray-500 mt-1">Status: <span class="font-semibold capitalize">{{ $car->status }}</span></p>
                            </div>

                            <div class="space-y-4">
                                <h4 class="text-lg font-semibold text-gray-900">Specifications</h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-sm text-gray-500">Transmission</p>
                                        <p class="font-medium capitalize">{{ $car->transmission }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-sm text-gray-500">Fuel Type</p>
                                        <p class="font-medium capitalize">{{ $car->fuel_type }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-sm text-gray-500">Seats</p>
                                        <p class="font-medium">{{ $car->seats }}</p>
                                    </div>
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-sm text-gray-500">Luggage</p>
                                        <p class="font-medium">{{ $car->luggage }} bags</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">Description</h4>
                                <p class="text-gray-600">{{ $car->description }}</p>
                            </div>

                            <div class="flex space-x-4">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Edit Car
                                    </a>
                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" 
                                            onclick="return confirm('Are you sure you want to delete this car?')">
                                            Delete Car
                                        </button>
                                    </form>
                                @else
                                    @if($car->status === 'available')
                                        <a href="{{ route('rentals.create', ['car' => $car->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Rent Now
                                        </a>
                                    @endif
                                @endif
                                <a href="{{ route('cars.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Back to Cars
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>