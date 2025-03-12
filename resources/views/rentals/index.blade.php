<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-gray-800">
                {{ __('My Rentals') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4" style="background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%); min-height: calc(100vh - 64px);">
        <div class="container">
            <!-- Navigation Bar -->
            <div class="row mb-4">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="dashboardNav">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                            <i class="bi bi-house-door me-2"></i>Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('cars.*') ? 'active' : '' }}" href="{{ route('cars.index') }}">
                                            <i class="bi bi-car-front me-2"></i>Cars
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('rentals.*') ? 'active' : '' }}" href="{{ route('rentals.index') }}">
                                            <i class="bi bi-calendar-check me-2"></i>My Rentals
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                            <i class="bi bi-info-circle me-2"></i>About
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                                            <i class="bi bi-envelope me-2"></i>Contact Us
                                        </a>
                                    </li>
                                    @if(auth()->user()->isAdmin())
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                            <i class="bi bi-shield-lock me-2"></i>Admin Panel
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                    <i class="bi bi-person me-2"></i>Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('settings.index') }}">
                                                    <i class="bi bi-gear me-2"></i>Settings
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-900">Rental History</h3>
                                <a href="{{ route('cars.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Rent a Car
                                </a>
                            </div>

                            <div class="space-y-6">
                                @forelse($rentals as $rental)
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                        <div class="p-6">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h4 class="text-xl font-semibold text-gray-900">{{ $rental->car->brand }} {{ $rental->car->model }}</h4>
                                                    <p class="text-gray-600 mt-1">{{ $rental->car->year }} • {{ $rental->car->color }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                                        @if($rental->status === 'active') bg-green-100 text-green-800
                                                        @elseif($rental->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @elseif($rental->status === 'completed') bg-blue-100 text-blue-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ ucfirst($rental->status) }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4">
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
                                                    <p class="font-medium">${{ number_format($rental->total_price, 2) }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-500">Pickup Location</p>
                                                    <p class="font-medium">{{ $rental->pickup_location }}</p>
                                                </div>
                                            </div>

                                            @if($rental->notes)
                                                <div class="mt-4">
                                                    <p class="text-sm text-gray-500">Notes</p>
                                                    <p class="font-medium">{{ $rental->notes }}</p>
                                                </div>
                                            @endif

                                            <div class="mt-6 flex space-x-4">
                                                <a href="{{ route('rentals.show', $rental) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    View Details
                                                </a>
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
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <p class="text-gray-500 text-lg">You haven't made any rentals yet.</p>
                                        <a href="{{ route('cars.index') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Browse Available Cars
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 