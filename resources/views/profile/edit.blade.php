<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-gray-800">
                {{ __('Profile Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-md-3">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                    @if($user->profile_photo_path)
                                        <img src="{{ Storage::url($user->profile_photo_path) }}" alt="Profile" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <span class="h1 mb-0">{{ substr($user->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <form action="{{ route('profile.update-photo') }}" method="POST" enctype="multipart/form-data" class="position-absolute bottom-0 end-0">
                                    @csrf
                                    <label for="photo" class="btn btn-sm btn-light rounded-circle shadow-sm" style="width: 32px; height: 32px; cursor: pointer;">
                                        <i class="bi bi-camera"></i>
                                    </label>
                                    <input type="file" id="photo" name="photo" class="d-none" accept="image/*">
                                </form>
                            </div>
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-2">{{ $user->email }}</p>
                            @if($user->email_verified_at)
                                <span class="badge bg-success mb-2">Verified</span>
                            @endif
                            <p class="text-muted mb-0">{{ $user->role }}</p>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="list-group list-group-flush">
                            <a href="#profile-overview" class="list-group-item list-group-item-action active" data-bs-toggle="list">
                                <i class="bi bi-person me-2"></i>Profile Overview
                            </a>
                            <a href="#personal-info" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="bi bi-file-text me-2"></i>Personal Information
                            </a>
                            <a href="#rental-history" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="bi bi-calendar-check me-2"></i>Rental History
                            </a>
                            <a href="#payment-billing" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="bi bi-credit-card me-2"></i>Payment & Billing
                            </a>
                            <a href="#reviews-ratings" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="bi bi-star me-2"></i>Reviews & Ratings
                            </a>
                            <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="list">
                                <i class="bi bi-shield-lock me-2"></i>Security Settings
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- Profile Overview -->
                        <div class="tab-pane fade show active" id="profile-overview">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Profile Overview</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Full Name:</strong> {{ $user->name }}</p>
                                            <p class="mb-2">
                                                <strong>Email:</strong> {{ $user->email }}
                                                @if($user->email_verified_at)
                                                    <span class="badge bg-success ms-2">Verified</span>
                                                @endif
                                            </p>
                                            <p class="mb-2"><strong>Phone:</strong> {{ $user->phone ?? 'Not set' }}</p>
                                            <p class="mb-2"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                                            <p class="mb-2"><strong>Last Login:</strong> {{ $user->last_login_at ? $user->last_login_at->format('M d, Y H:i') : 'Never' }}</p>
                                            <p class="mb-2"><strong>Account Status:</strong> <span class="badge bg-success">Active</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="tab-pane fade" id="personal-info">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Personal Information</h5>
                                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                                        @csrf
                                        @method('patch')
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Gender</label>
                                                    <select class="form-select" name="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                        <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Street Address</label>
                                            <input type="text" class="form-control" name="street_address" value="{{ old('street_address', $user->street_address) }}">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">City</label>
                                                    <input type="text" class="form-control" name="city" value="{{ old('city', $user->city) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">State</label>
                                                    <input type="text" class="form-control" name="state" value="{{ old('state', $user->state) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">ZIP Code</label>
                                                    <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Driver's License Number</label>
                                                    <input type="text" class="form-control" name="drivers_license" value="{{ old('drivers_license', $user->drivers_license) }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">License Expiry Date</label>
                                                    <input type="date" class="form-control" name="license_expiry" value="{{ old('license_expiry', $user->license_expiry) }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Upload Documents</label>
                                            <input type="file" class="form-control" name="documents[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                                            <div class="form-text">You can upload multiple documents (PDF, JPG, PNG)</div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle me-2"></i>Save Changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Rental History -->
                        <div class="tab-pane fade" id="rental-history">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Rental History</h5>
                                    
                                    <!-- Active Rentals -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Active Rentals</h6>
                                        @if($activeRentals->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Car</th>
                                                            <th>Pickup Date</th>
                                                            <th>Return Date</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($activeRentals as $rental)
                                                            <tr>
                                                                <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                                                                <td>{{ $rental->pickup_date->format('M d, Y') }}</td>
                                                                <td>{{ $rental->return_date->format('M d, Y') }}</td>
                                                                <td><span class="badge bg-primary">{{ $rental->status }}</span></td>
                                                                <td>
                                                                    <a href="{{ route('rentals.show', $rental) }}" class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No active rentals found.</p>
                                        @endif
                                    </div>

                                    <!-- Completed Rentals -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Completed Rentals</h6>
                                        @if($completedRentals->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Car</th>
                                                            <th>Pickup Date</th>
                                                            <th>Return Date</th>
                                                            <th>Total Cost</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($completedRentals as $rental)
                                                            <tr>
                                                                <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                                                                <td>{{ $rental->pickup_date->format('M d, Y') }}</td>
                                                                <td>{{ $rental->return_date->format('M d, Y') }}</td>
                                                                <td>${{ number_format($rental->total_cost, 2) }}</td>
                                                                <td>
                                                                    <a href="{{ route('rentals.show', $rental) }}" class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route('rentals.invoice', $rental) }}" class="btn btn-sm btn-outline-secondary">
                                                                        <i class="bi bi-receipt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No completed rentals found.</p>
                                        @endif
                                    </div>

                                    <!-- Canceled Bookings -->
                                    <div>
                                        <h6 class="mb-3">Canceled Bookings</h6>
                                        @if($canceledBookings->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Car</th>
                                                            <th>Pickup Date</th>
                                                            <th>Return Date</th>
                                                            <th>Canceled On</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($canceledBookings as $booking)
                                                            <tr>
                                                                <td>{{ $booking->car->brand }} {{ $booking->car->model }}</td>
                                                                <td>{{ $booking->pickup_date->format('M d, Y') }}</td>
                                                                <td>{{ $booking->return_date->format('M d, Y') }}</td>
                                                                <td>{{ $booking->canceled_at->format('M d, Y') }}</td>
                                                                <td>
                                                                    <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-outline-primary">
                                                                        <i class="bi bi-eye"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No canceled bookings found.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment & Billing -->
                        <div class="tab-pane fade" id="payment-billing">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Payment & Billing</h5>

                                    <!-- Saved Payment Methods -->
                                    <div class="mb-4">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="mb-0">Saved Payment Methods</h6>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentMethod">
                                                <i class="bi bi-plus-circle me-2"></i>Add New
                                            </button>
                                        </div>
                                        @if($paymentMethods->count() > 0)
                                            <div class="row">
                                                @foreach($paymentMethods as $method)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <h6 class="mb-1">{{ $method->card_type }}</h6>
                                                                        <p class="mb-0 text-muted">**** **** **** {{ $method->last_four }}</p>
                                                                        <small class="text-muted">Expires {{ $method->expiry_month }}/{{ $method->expiry_year }}</small>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="default_payment" value="{{ $method->id }}" {{ $method->is_default ? 'checked' : '' }}>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No saved payment methods found.</p>
                                        @endif
                                    </div>

                                    <!-- Billing Address -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Billing Address</h6>
                                        <form method="post" action="{{ route('profile.update-billing') }}">
                                            @csrf
                                            @method('patch')
                                            <div class="mb-3">
                                                <label class="form-label">Street Address</label>
                                                <input type="text" class="form-control" name="billing_street" value="{{ old('billing_street', $user->billing_street) }}">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">City</label>
                                                        <input type="text" class="form-control" name="billing_city" value="{{ old('billing_city', $user->billing_city) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">State</label>
                                                        <input type="text" class="form-control" name="billing_state" value="{{ old('billing_state', $user->billing_state) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">ZIP Code</label>
                                                        <input type="text" class="form-control" name="billing_zip" value="{{ old('billing_zip', $user->billing_zip) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-check-circle me-2"></i>Save Billing Address
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Transaction History -->
                                    <div>
                                        <h6 class="mb-3">Transaction History</h6>
                                        @if($transactions->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Description</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($transactions as $transaction)
                                                            <tr>
                                                                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                                                                <td>{{ $transaction->description }}</td>
                                                                <td>${{ number_format($transaction->amount, 2) }}</td>
                                                                <td>
                                                                    <span class="badge bg-{{ $transaction->status_color }}">
                                                                        {{ $transaction->status }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No transactions found.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Reviews & Ratings -->
                        <div class="tab-pane fade" id="reviews-ratings">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Reviews & Ratings</h5>

                                    <!-- Reviews Given -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Reviews Given</h6>
                                        @if($reviews->count() > 0)
                                            <div class="row">
                                                @foreach($reviews as $review)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                                    <h6 class="mb-0">{{ $review->car->brand }} {{ $review->car->model }}</h6>
                                                                    <div class="text-warning">
                                                                        @for($i = 1; $i <= 5; $i++)
                                                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <p class="card-text">{{ $review->comment }}</p>
                                                                <small class="text-muted">Posted on {{ $review->created_at->format('M d, Y') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No reviews found.</p>
                                        @endif
                                    </div>

                                    <!-- Ratings Received -->
                                    <div>
                                        <h6 class="mb-3">Ratings Received</h6>
                                        @if($userRating)
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6">
                                                            <h3 class="mb-0">{{ number_format($userRating->average_rating, 1) }}</h3>
                                                            <div class="text-warning mb-2">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="bi bi-star{{ $i <= round($userRating->average_rating) ? '-fill' : '' }}"></i>
                                                                @endfor
                                                            </div>
                                                            <p class="text-muted mb-0">{{ $userRating->total_ratings }} ratings received</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($userRating->five_star / $userRating->total_ratings) * 100 }}%">
                                                                    5 stars ({{ $userRating->five_star }})
                                                                </div>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($userRating->four_star / $userRating->total_ratings) * 100 }}%">
                                                                    4 stars ({{ $userRating->four_star }})
                                                                </div>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($userRating->three_star / $userRating->total_ratings) * 100 }}%">
                                                                    3 stars ({{ $userRating->three_star }})
                                                                </div>
                                                            </div>
                                                            <div class="progress mb-2">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($userRating->two_star / $userRating->total_ratings) * 100 }}%">
                                                                    2 stars ({{ $userRating->two_star }})
                                                                </div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($userRating->one_star / $userRating->total_ratings) * 100 }}%">
                                                                    1 star ({{ $userRating->one_star }})
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No ratings received yet.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="tab-pane fade" id="security">
                            <div class="card shadow-sm mb-4">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Security Settings</h5>

                                    <!-- Change Password -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Change Password</h6>
                                        <form method="post" action="{{ route('profile.update-password') }}">
                                            @csrf
                                            @method('patch')
                                            <div class="mb-3">
                                                <label class="form-label">Current Password</label>
                                                <input type="password" class="form-control" name="current_password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">New Password</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-shield-lock me-2"></i>Update Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Two-Factor Authentication -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Two-Factor Authentication</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">Two-Factor Authentication</h6>
                                                <p class="text-muted mb-0">Add an extra layer of security to your account</p>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="twoFactorToggle" {{ $user->two_factor_enabled ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Recent Login Activity -->
                                    <div class="mb-4">
                                        <h6 class="mb-3">Recent Login Activity</h6>
                                        @if($loginHistory->count() > 0)
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date & Time</th>
                                                            <th>IP Address</th>
                                                            <th>Device</th>
                                                            <th>Location</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($loginHistory as $login)
                                                            <tr>
                                                                <td>{{ $login->created_at->format('M d, Y H:i') }}</td>
                                                                <td>{{ $login->ip_address }}</td>
                                                                <td>{{ $login->user_agent }}</td>
                                                                <td>{{ $login->location }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">No login history found.</p>
                                        @endif
                                    </div>

                                    <!-- Delete Account -->
                                    <div>
                                        <h6 class="mb-3">Delete Account</h6>
                                        <div class="alert alert-danger">
                                            <h6 class="alert-heading">Delete Account</h6>
                                            <p class="mb-0">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                                        </div>

                                        <form method="post" action="{{ route('profile.destroy') }}">
                                            @csrf
                                            @method('delete')
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" class="form-control" name="password_confirmation" required>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
                                                    <i class="bi bi-trash me-2"></i>Delete Account
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Confirmation Modal -->
    <div class="modal fade" id="confirm-user-deletion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payment Method Modal -->
    <div class="modal fade" id="addPaymentMethod" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('profile.add-payment-method') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <input type="text" class="form-control" name="card_number" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Expiry Month</label>
                                    <input type="text" class="form-control" name="expiry_month" placeholder="MM" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Expiry Year</label>
                                    <input type="text" class="form-control" name="expiry_year" placeholder="YY" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CVV</label>
                            <input type="text" class="form-control" name="cvv" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_default" id="defaultCard">
                            <label class="form-check-label" for="defaultCard">
                                Set as default payment method
                            </label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Add Card
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>