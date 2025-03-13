<x-app-layout>

    <div class="py-4" style="background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%); min-height: calc(100vh - 64px);">
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

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Welcome to CarRent</h3>
                            
                            <div class="mb-4">
                                <h5>Our Story</h5>
                                <p class="text-muted">
                                    CarRent was founded with a simple mission: to make car rental easy, affordable, and accessible to everyone. 
                                    We understand that finding the right car for your needs can be a challenge, and we're here to simplify that process.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h5>Our Mission</h5>
                                <p class="text-muted">
                                    We strive to provide exceptional service and a wide range of vehicles to meet all your transportation needs. 
                                    Whether you're planning a family vacation, a business trip, or just need a temporary vehicle, we've got you covered.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h5>Why Choose Us?</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        Wide selection of vehicles
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        Competitive pricing
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        24/7 customer support
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        Easy booking process
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        Flexible pickup and drop-off options
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <h5>Get Started</h5>
                                <p class="text-muted">
                                    Ready to find your perfect rental car? Browse our selection of vehicles and start your journey with us today.
                                </p>
                                <a href="{{ route('cars.index') }}" class="btn btn-primary">
                                    <i class="bi bi-car-front me-2"></i>Browse Cars
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 