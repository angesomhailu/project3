<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Car Management') }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('cars.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-300">
                    Add New Car
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors duration-300">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Car Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cars as $car)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300">
                        <!-- Car Image -->
                        <div class="relative h-48 overflow-hidden">
                            @if($car->images && count($car->images) > 0)
                                <img src="{{ Storage::url($car->images[0]) }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="absolute top-0 right-0 p-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $car->status === 'available' ? 'bg-green-100 text-green-800' : ($car->status === 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($car->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Car Details -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $car->make }} {{ $car->model }}</h3>
                                <p class="text-lg font-bold text-blue-600">${{ number_format($car->daily_rate, 2) }}/day</p>
                            </div>
                            <div class="text-sm text-gray-600 mb-4">
                                <p>Year: {{ $car->year }}</p>
                                <p>Color: {{ $car->color }}</p>
                                <p>License: {{ $car->license_plate }}</p>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $car->transmission }}</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $car->fuel_type }}</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $car->seats }} seats</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('cars.edit', $car) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Edit Details
                                </a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this car?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 