<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0 text-gray-800">
                {{ __('Settings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- General Settings -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">General Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">System Configuration</h6>
                                    <div class="mb-3">
                                        <label for="system_name" class="form-label">System Name</label>
                                        <input type="text" class="form-control" id="system_name" name="system_name" 
                                            value="{{ old('system_name', $settings->system_name ?? 'CarRent') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="system_logo" class="form-label">System Logo</label>
                                        <input type="file" class="form-control" id="system_logo" name="system_logo">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Regional Settings</h6>
                                    <div class="mb-3">
                                        <label for="timezone" class="form-label">Timezone</label>
                                        <select class="form-select" id="timezone" name="timezone">
                                            <option value="UTC" {{ old('timezone', $settings->timezone ?? 'UTC') === 'UTC' ? 'selected' : '' }}>UTC</option>
                                            <option value="EST" {{ old('timezone', $settings->timezone ?? 'UTC') === 'EST' ? 'selected' : '' }}>Eastern Time</option>
                                            <option value="CST" {{ old('timezone', $settings->timezone ?? 'UTC') === 'CST' ? 'selected' : '' }}>Central Time</option>
                                            <option value="PST" {{ old('timezone', $settings->timezone ?? 'UTC') === 'PST' ? 'selected' : '' }}>Pacific Time</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_format" class="form-label">Date Format</label>
                                        <select class="form-select" id="date_format" name="date_format">
                                            <option value="Y-m-d" {{ old('date_format', $settings->date_format ?? 'Y-m-d') === 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                                            <option value="d/m/Y" {{ old('date_format', $settings->date_format ?? 'Y-m-d') === 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
                                            <option value="m/d/Y" {{ old('date_format', $settings->date_format ?? 'Y-m-d') === 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="currency" class="form-label">Currency</label>
                                        <select class="form-select" id="currency" name="currency">
                                            <option value="USD" {{ old('currency', $settings->currency ?? 'USD') === 'USD' ? 'selected' : '' }}>USD ($)</option>
                                            <option value="ETB" {{ old('currency', $settings->currency ?? 'USD') === 'ETB' ? 'selected' : '' }}>ETB (Br)</option>
                                            <option value="EUR" {{ old('currency', $settings->currency ?? 'USD') === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="language" class="form-label">Language</label>
                                        <select class="form-select" id="language" name="language">
                                            <option value="en" {{ old('language', $settings->language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                                            <option value="es" {{ old('language', $settings->language ?? 'en') === 'es' ? 'selected' : '' }}>Spanish</option>
                                            <option value="fr" {{ old('language', $settings->language ?? 'en') === 'fr' ? 'selected' : '' }}>French</option>
                                            <option value="de" {{ old('language', $settings->language ?? 'en') === 'de' ? 'selected' : '' }}>German</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-gear me-2"></i>Save General Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- User Management Settings -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">User Management Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Registration & Verification</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="require_email_verification" 
                                            name="require_email_verification" {{ old('require_email_verification', $settings->require_email_verification ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="require_email_verification">
                                            Require email verification
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="manual_approval" 
                                            name="manual_approval" {{ old('manual_approval', $settings->manual_approval ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="manual_approval">
                                            Manual account approval required
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Security Settings</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_2fa" 
                                            name="enable_2fa" {{ old('enable_2fa', $settings->enable_2fa ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_2fa">
                                            Enable two-factor authentication
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="session_timeout" class="form-label">Session Timeout (minutes)</label>
                                        <input type="number" class="form-control" id="session_timeout" name="session_timeout" 
                                            value="{{ old('session_timeout', $settings->session_timeout ?? 30) }}" min="5" max="120">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-shield-lock me-2"></i>Save User Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Vehicle Management Settings -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Vehicle Management Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Pricing Configuration</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_hourly_pricing" 
                                            name="enable_hourly_pricing" {{ old('enable_hourly_pricing', $settings->enable_hourly_pricing ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_hourly_pricing">
                                            Enable hourly pricing
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_daily_pricing" 
                                            name="enable_daily_pricing" {{ old('enable_daily_pricing', $settings->enable_daily_pricing ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_daily_pricing">
                                            Enable daily pricing
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="enable_weekly_pricing" 
                                            name="enable_weekly_pricing" {{ old('enable_weekly_pricing', $settings->enable_weekly_pricing ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_weekly_pricing">
                                            Enable weekly pricing
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Fuel & Mileage Policy</h6>
                                    <div class="mb-3">
                                        <label for="fuel_policy" class="form-label">Fuel Policy</label>
                                        <select class="form-select" id="fuel_policy" name="fuel_policy">
                                            <option value="full_to_full" {{ old('fuel_policy', $settings->fuel_policy ?? 'full_to_full') === 'full_to_full' ? 'selected' : '' }}>Full to Full</option>
                                            <option value="same_as_received" {{ old('fuel_policy', $settings->fuel_policy ?? 'full_to_full') === 'same_as_received' ? 'selected' : '' }}>Same as Received</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mileage_limit" class="form-label">Daily Mileage Limit (km)</label>
                                        <input type="number" class="form-control" id="mileage_limit" name="mileage_limit" 
                                            value="{{ old('mileage_limit', $settings->mileage_limit ?? 200) }}" min="0">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-car-front me-2"></i>Save Vehicle Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Booking & Rental Settings -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Booking & Rental Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Booking Rules</h6>
                                    <div class="mb-3">
                                        <label for="min_rental_duration" class="form-label">Minimum Rental Duration (hours)</label>
                                        <input type="number" class="form-control" id="min_rental_duration" name="min_rental_duration" 
                                            value="{{ old('min_rental_duration', $settings->min_rental_duration ?? 24) }}" min="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="max_rental_duration" class="form-label">Maximum Rental Duration (days)</label>
                                        <input type="number" class="form-control" id="max_rental_duration" name="max_rental_duration" 
                                            value="{{ old('max_rental_duration', $settings->max_rental_duration ?? 30) }}" min="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="advance_booking_days" class="form-label">Advance Booking Period (days)</label>
                                        <input type="number" class="form-control" id="advance_booking_days" name="advance_booking_days" 
                                            value="{{ old('advance_booking_days', $settings->advance_booking_days ?? 30) }}" min="1">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Cancellation Policy</h6>
                                    <div class="mb-3">
                                        <label for="cancellation_fee_percentage" class="form-label">Cancellation Fee (%)</label>
                                        <input type="number" class="form-control" id="cancellation_fee_percentage" name="cancellation_fee_percentage" 
                                            value="{{ old('cancellation_fee_percentage', $settings->cancellation_fee_percentage ?? 10) }}" min="0" max="100">
                                    </div>
                                    <div class="mb-3">
                                        <label for="cancellation_hours" class="form-label">Free Cancellation Period (hours)</label>
                                        <input type="number" class="form-control" id="cancellation_hours" name="cancellation_hours" 
                                            value="{{ old('cancellation_hours', $settings->cancellation_hours ?? 24) }}" min="0">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-calendar-check me-2"></i>Save Booking Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Payment & Invoicing Settings -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Payment & Invoicing Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Payment Methods</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_paypal" 
                                            name="enable_paypal" {{ old('enable_paypal', $settings->enable_paypal ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_paypal">
                                            Enable PayPal
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_stripe" 
                                            name="enable_stripe" {{ old('enable_stripe', $settings->enable_stripe ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_stripe">
                                            Enable Stripe
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_bank_transfer" 
                                            name="enable_bank_transfer" {{ old('enable_bank_transfer', $settings->enable_bank_transfer ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_bank_transfer">
                                            Enable Bank Transfer
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="enable_cash" 
                                            name="enable_cash" {{ old('enable_cash', $settings->enable_cash ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_cash">
                                            Enable Cash on Delivery
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Security Deposit & Fees</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="require_security_deposit" 
                                            name="require_security_deposit" {{ old('require_security_deposit', $settings->require_security_deposit ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="require_security_deposit">
                                            Require security deposit
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="security_deposit_amount" class="form-label">Security Deposit Amount</label>
                                        <input type="number" class="form-control" id="security_deposit_amount" name="security_deposit_amount" 
                                            value="{{ old('security_deposit_amount', $settings->security_deposit_amount ?? 200) }}" min="0">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Tax & Discounts</h6>
                                    <div class="mb-3">
                                        <label for="vat_percentage" class="form-label">VAT Percentage</label>
                                        <input type="number" class="form-control" id="vat_percentage" name="vat_percentage" 
                                            value="{{ old('vat_percentage', $settings->vat_percentage ?? 15) }}" min="0" max="100">
                                    </div>
                                    <div class="mb-3">
                                        <label for="service_charge_percentage" class="form-label">Service Charge (%)</label>
                                        <input type="number" class="form-control" id="service_charge_percentage" name="service_charge_percentage" 
                                            value="{{ old('service_charge_percentage', $settings->service_charge_percentage ?? 5) }}" min="0" max="100">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-credit-card me-2"></i>Save Payment Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Insurance & Damage Policy -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Insurance & Damage Policy</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Insurance Settings</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="require_insurance" 
                                            name="require_insurance" {{ old('require_insurance', $settings->require_insurance ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="require_insurance">
                                            Require insurance coverage
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="insurance_coverage_amount" class="form-label">Insurance Coverage Amount</label>
                                        <input type="number" class="form-control" id="insurance_coverage_amount" name="insurance_coverage_amount" 
                                            value="{{ old('insurance_coverage_amount', $settings->insurance_coverage_amount ?? 1000) }}" min="0">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Damage & Penalties</h6>
                                    <div class="mb-3">
                                        <label for="late_return_fee" class="form-label">Late Return Fee (per hour)</label>
                                        <input type="number" class="form-control" id="late_return_fee" name="late_return_fee" 
                                            value="{{ old('late_return_fee', $settings->late_return_fee ?? 25) }}" min="0">
                                    </div>
                                    <div class="mb-3">
                                        <label for="damage_deposit_amount" class="form-label">Damage Deposit Amount</label>
                                        <input type="number" class="form-control" id="damage_deposit_amount" name="damage_deposit_amount" 
                                            value="{{ old('damage_deposit_amount', $settings->damage_deposit_amount ?? 500) }}" min="0">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-shield-check me-2"></i>Save Insurance Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Notification & Alerts -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Notification & Alerts</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Email Notifications</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="email_booking_confirmation" 
                                            name="email_booking_confirmation" {{ old('email_booking_confirmation', $settings->email_booking_confirmation ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="email_booking_confirmation">
                                            Booking confirmation
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="email_reminders" 
                                            name="email_reminders" {{ old('email_reminders', $settings->email_reminders ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="email_reminders">
                                            Rental reminders
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="email_promotions" 
                                            name="email_promotions" {{ old('email_promotions', $settings->email_promotions ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="email_promotions">
                                            Special offers and promotions
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">SMS Notifications</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="sms_booking_confirmation" 
                                            name="sms_booking_confirmation" {{ old('sms_booking_confirmation', $settings->sms_booking_confirmation ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sms_booking_confirmation">
                                            Booking confirmation
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="sms_reminders" 
                                            name="sms_reminders" {{ old('sms_reminders', $settings->sms_reminders ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sms_reminders">
                                            Rental reminders
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Push Notifications</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="push_booking_updates" 
                                            name="push_booking_updates" {{ old('push_booking_updates', $settings->push_booking_updates ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="push_booking_updates">
                                            Booking status updates
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="push_promotions" 
                                            name="push_promotions" {{ old('push_promotions', $settings->push_promotions ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="push_promotions">
                                            Special offers and promotions
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-bell me-2"></i>Save Notification Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- API & Integration Settings -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-4">API & Integration Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Google Maps Integration</h6>
                                    <div class="mb-3">
                                        <label for="google_maps_api_key" class="form-label">Google Maps API Key</label>
                                        <input type="text" class="form-control" id="google_maps_api_key" name="google_maps_api_key" 
                                            value="{{ old('google_maps_api_key', $settings->google_maps_api_key ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Payment Gateway Integration</h6>
                                    <div class="mb-3">
                                        <label for="stripe_public_key" class="form-label">Stripe Public Key</label>
                                        <input type="text" class="form-control" id="stripe_public_key" name="stripe_public_key" 
                                            value="{{ old('stripe_public_key', $settings->stripe_public_key ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="stripe_secret_key" class="form-label">Stripe Secret Key</label>
                                        <input type="password" class="form-control" id="stripe_secret_key" name="stripe_secret_key" 
                                            value="{{ old('stripe_secret_key', $settings->stripe_secret_key ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="paypal_client_id" class="form-label">PayPal Client ID</label>
                                        <input type="text" class="form-control" id="paypal_client_id" name="paypal_client_id" 
                                            value="{{ old('paypal_client_id', $settings->paypal_client_id ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="paypal_secret" class="form-label">PayPal Secret</label>
                                        <input type="password" class="form-control" id="paypal_secret" name="paypal_secret" 
                                            value="{{ old('paypal_secret', $settings->paypal_secret ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">SMS Gateway Integration</h6>
                                    <div class="mb-3">
                                        <label for="sms_api_key" class="form-label">SMS API Key</label>
                                        <input type="text" class="form-control" id="sms_api_key" name="sms_api_key" 
                                            value="{{ old('sms_api_key', $settings->sms_api_key ?? '') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sms_api_secret" class="form-label">SMS API Secret</label>
                                        <input type="password" class="form-control" id="sms_api_secret" name="sms_api_secret" 
                                            value="{{ old('sms_api_secret', $settings->sms_api_secret ?? '') }}">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plug me-2"></i>Save API Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security & Backup Settings -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Security & Backup Settings</h5>
                            
                            <form method="post" action="{{ route('settings.update') }}">
                                @csrf
                                @method('patch')

                                <div class="mb-4">
                                    <h6 class="mb-3">Database Backup</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_auto_backup" 
                                            name="enable_auto_backup" {{ old('enable_auto_backup', $settings->enable_auto_backup ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_auto_backup">
                                            Enable automatic database backup
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="backup_frequency" class="form-label">Backup Frequency</label>
                                        <select class="form-select" id="backup_frequency" name="backup_frequency">
                                            <option value="daily" {{ old('backup_frequency', $settings->backup_frequency ?? 'daily') === 'daily' ? 'selected' : '' }}>Daily</option>
                                            <option value="weekly" {{ old('backup_frequency', $settings->backup_frequency ?? 'daily') === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                            <option value="monthly" {{ old('backup_frequency', $settings->backup_frequency ?? 'daily') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="backup_retention_days" class="form-label">Backup Retention Period (days)</label>
                                        <input type="number" class="form-control" id="backup_retention_days" name="backup_retention_days" 
                                            value="{{ old('backup_retention_days', $settings->backup_retention_days ?? 30) }}" min="1">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-3">Access Logs</h6>
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="form-check-input" id="enable_access_logs" 
                                            name="enable_access_logs" {{ old('enable_access_logs', $settings->enable_access_logs ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="enable_access_logs">
                                            Enable access logging
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="log_retention_days" class="form-label">Log Retention Period (days)</label>
                                        <input type="number" class="form-control" id="log_retention_days" name="log_retention_days" 
                                            value="{{ old('log_retention_days', $settings->log_retention_days ?? 90) }}" min="1">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-shield-check me-2"></i>Save Security Settings
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