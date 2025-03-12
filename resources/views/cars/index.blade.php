<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-gray-800">
                {{ __('Cars') }}
            </h2>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Car
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-4" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); min-height: calc(100vh - 64px);">
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

            <!-- Search and Filter Section -->
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-gray-800">
                {{ __('Cars') }}
            </h2>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Car
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-4" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); min-height: calc(100vh - 64px);">
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

            <!-- Search and Filter Section -->
            <div class="card shadow-lg border-0 mb-4" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-body">
                    <form method="GET" action="{{ route('cars.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                value="{{ request('search') }}" placeholder="Brand, model, or location">
                        </div>
                        <div class="col-md-2">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">All Categories</option>
                                <option value="sedan" {{ request('category') === 'sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="suv" {{ request('category') === 'suv' ? 'selected' : '' }}>SUV</option>
                                <option value="luxury" {{ request('category') === 'luxury' ? 'selected' : '' }}>Luxury</option>
                                <option value="sports" {{ request('category') === 'sports' ? 'selected' : '' }}>Sports</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="transmission" class="form-label">Transmission</label>
                            <select class="form-select" id="transmission" name="transmission">
                                <option value="">All Types</option>
                                <option value="automatic" {{ request('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                                <option value="manual" {{ request('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="fuel_type" class="form-label">Fuel Type</label>
                            <select class="form-select" id="fuel_type" name="fuel_type">
                                <option value="">All Types</option>
                                <option value="petrol" {{ request('fuel_type') === 'petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="diesel" {{ request('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="electric" {{ request('fuel_type') === 'electric' ? 'selected' : '' }}>Electric</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="price_range" class="form-label">Price Range</label>
                            <select class="form-select" id="price_range" name="price_range">
                                <option value="">All Prices</option>
                                <option value="0-50" {{ request('price_range') === '0-50' ? 'selected' : '' }}>$0 - $50/day</option>
                                <option value="51-100" {{ request('price_range') === '51-100' ? 'selected' : '' }}>$51 - $100/day</option>
                                <option value="101-200" {{ request('price_range') === '101-200' ? 'selected' : '' }}>$101 - $200/day</option>
                                <option value="201+" {{ request('price_range') === '201+' ? 'selected' : '' }}>$201+/day</option>
                            </select>
                        </div>
                        <div class="col-12">
                            
                            <a href="{{ route('cars.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-2"></i>Clear Filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cars Grid -->
            <div class="row">
                @forelse($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        @if($car->image)
                        <img src="{{ Storage::url($car->image) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}" style="height: 200px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-car-front text-muted" style="font-size: 3rem;"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $car->brand }} {{ $car->model }}</h5>
                                <span class="badge bg-{{ $car->status_color }}">{{ $car->status }}</span>
                            </div>
                            <p class="card-text text-muted mb-2">
                                <i class="bi bi-calendar me-2"></i>{{ $car->year }}
                                <i class="bi bi-gear me-2"></i>{{ $car->transmission }}
                                <i class="bi bi-fuel-pump me-2"></i>{{ $car->fuel_type }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <i class="bi bi-people me-2"></i>{{ $car->seats }} seats
                                    <i class="bi bi-briefcase me-2"></i>{{ $car->luggage_capacity }} bags
                                </div>
                                <h5 class="text-primary mb-0">${{ number_format($car->price_per_day, 2) }}/day</h5>
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('cars.show', $car) }}" class="btn btn-outline-primary">
                                    <i class="bi bi-eye me-2"></i>View Details
                                </a>
                                @if($car->isAvailable())
                                <a href="{{ route('rentals.create', ['car' => $car->id]) }}" class="btn btn-primary">
                                    <i class="bi bi-calendar-check me-2"></i>Rent Now
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-car-front text-muted mb-3" style="font-size: 3rem;"></i>
                            <h5 class="card-title">No Cars Found</h5>
                            <p class="card-text text-muted">Try adjusting your search or filters to find what you're looking for.</p>
                            @if(auth()->user()->isAdmin())
                            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Add New Car
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($cars->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if($cars->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $cars->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                            @if($page == $cars->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($cars->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $cars->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</x-app-layout> 