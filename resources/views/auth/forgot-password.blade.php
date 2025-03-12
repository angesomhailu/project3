<x-guest-layout>
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://images.unsplash.com/photo-1552519507-da3b142c6e3d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: white;
        }

        .card {
            background: rgba(45, 45, 45, 0.9);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            background: linear-gradient(45deg, #2d2d2d, #3d3d3d);
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .card-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 1rem 1.2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
            width: 100%;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            background: #4a4a4a;
            border: 2px solid #5a5a5a;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            width: 100%;
            font-weight: 600;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: #5a5a5a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .back-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
            font-weight: 500;
        }

        .back-link:hover {
            color: white;
            transform: translateX(-5px);
        }

        .alert {
            background: rgba(45, 45, 45, 0.9);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 1.2rem;
            margin-bottom: 1.5rem;
            color: white;
            font-weight: 500;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.3);
            border-color: rgba(40, 167, 69, 0.4);
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.3);
            border-color: rgba(220, 53, 69, 0.4);
        }

        .invalid-feedback {
            color: #ff6b6b;
            font-size: 0.9rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('Forgot Password') }}</h2>
                    <p class="card-subtitle">{{ __('Enter your email address and we will send you a password reset link.') }}</p>
                </div>

                <div class="p-6">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email">
                                {{ __('Email') }}
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email address">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Send Reset Link') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="back-link">
                                <i class="bi bi-arrow-left"></i>
                                {{ __('Back to Login') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
