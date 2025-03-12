<x-app-layout>
    <div class="py-4">
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

            <!-- Dashboard Content -->
            <div class="row">
                <!-- Statistics Cards -->
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-car-front text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Available Cars</h6>
                                    <h3 class="mb-0">{{ $availableCars }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-calendar-check text-success"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Active Rentals</h6>
                                    <h3 class="mb-0">{{ $activeRentals }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-currency-dollar text-info"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Total Revenue</h6>
                                    <h3 class="mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-people text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Total Customers</h6>
                                    <h3 class="mb-0">{{ $totalCustomers }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-8">
                    <!-- Recent Activity -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Recent Activity</h5>
                                <a href="{{ route('rentals.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            
                            @if($recentRentals->count() > 0)
                                <div class="list-group">
                                    @foreach($recentRentals as $rental)
                                        <a href="{{ route('rentals.show', $rental) }}" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">{{ $rental->car->brand }} {{ $rental->car->model }}</h6>
                                                    <p class="mb-1 text-muted">
                                                        <i class="bi bi-calendar me-2"></i>{{ $rental->start_date->format('M d, Y') }} - {{ $rental->end_date->format('M d, Y') }}
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-{{ $rental->status_color }} mb-2">{{ $rental->status }}</span>
                                                    <p class="mb-0 text-primary">${{ number_format($rental->total_price, 2) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-check text-muted mb-3" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">No recent rentals found.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Upcoming Rentals -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Upcoming Rentals</h5>
                                <a href="{{ route('rentals.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            
                            @if($upcomingRentals->count() > 0)
                                <div class="list-group">
                                    @foreach($upcomingRentals as $rental)
                                        <a href="{{ route('rentals.show', $rental) }}" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1">{{ $rental->car->brand }} {{ $rental->car->model }}</h6>
                                                    <p class="mb-1 text-muted">
                                                        <i class="bi bi-calendar me-2"></i>Starts {{ $rental->start_date->format('M d, Y') }}
                                                    </p>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-warning mb-2">Upcoming</span>
                                                    <p class="mb-0 text-primary">${{ number_format($rental->total_price, 2) }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-calendar-plus text-muted mb-3" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">No upcoming rentals.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Quick Actions -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Quick Actions</h5>
                            <div class="d-grid gap-2">
                                
                                <a href="{{ route('rentals.create') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-plus-circle me-2"></i>New Rental
                                </a>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-person me-2"></i>Update Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Notifications -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Recent Notifications</h5>
                            @if($notifications->isNotEmpty())
                                <div class="list-group">
                                    @foreach($notifications as $notification)
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">{{ $notification->title }}</h6>
                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1">{{ $notification->message }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-bell text-muted mb-3" style="font-size: 2rem;"></i>
                                    <p class="text-muted mb-0">No new notifications.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
