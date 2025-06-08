<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>
    <style>
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 50%, #ff9a8b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .login-container {
            display: flex;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            min-height: 500px;
        }

        .welcome-section {
            flex: 1;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 50%, #ff9068 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 60px 40px;
            color: white;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -30%;
            width: 120%;
            height: 120%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: rotate(-15deg);
        }

        .welcome-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 80%;
            height: 80%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
        }

        .logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            z-index: 2;
            position: relative;
            font-size: 28px;
        }

        .welcome-title {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 15px;
            z-index: 2;
            position: relative;
        }

        .welcome-subtitle {
            font-size: 16px;
            opacity: 0.9;
            z-index: 2;
            position: relative;
        }

        .login-section {
            flex: 1;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            margin-bottom: 40px;
        }

        .login-title {
            font-size: 28px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-input:focus {
            outline: none;
            border-color: #ff6b35;
            background: white;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 4px;
        }

        .remember-section {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: #ff6b35;
        }

        .remember-label {
            font-size: 14px;
            color: #666;
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }

        .forgot-link {
            color: #ff6b35;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .signup-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e1e5e9;
        }

        .signup-text {
            color: #666;
            font-size: 14px;
        }

        .signup-link {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        .status-message {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 400px;
                margin: 20px auto;
            }

            .welcome-section {
                padding: 40px 30px;
                text-align: center;
                align-items: center;
            }

            .welcome-title {
                font-size: 32px;
            }

            .login-section {
                padding: 40px 30px;
            }

            .login-title {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .welcome-section {
                padding: 30px 20px;
            }

            .login-section {
                padding: 30px 20px;
            }

            .welcome-title {
                font-size: 28px;
            }

            .login-title {
                font-size: 22px;
            }
        }

        /* Animation */
        .login-container {
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-input, .login-button {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="logo">🚀</div>
                <h1 class="welcome-title">Welcome<br>Back!</h1>
                <p class="welcome-subtitle">Sign in to continue to your account</p>
            </div>

            <!-- Login Form Section -->
            <div class="login-section">
                <div class="login-header">
                    <h2 class="login-title">Login</h2>
                    <p class="login-subtitle">Welcome back! Please login to your account.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="status-message">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label class="form-label" for="email">{{ __('Email') }}</label>
                        <input 
                            class="form-input {{ $errors->get('email') ? 'error' : '' }}" 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="username@gmail.com"
                            required 
                            autofocus 
                            autocomplete="username"
                        />
                        @if ($errors->get('email'))
                            <div class="error-message">
                                @foreach ($errors->get('email') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                        <input 
                            class="form-input {{ $errors->get('password') ? 'error' : '' }}" 
                            id="password" 
                            type="password" 
                            name="password" 
                            placeholder="••••••••"
                            required 
                            autocomplete="current-password"
                        />
                        @if ($errors->get('password'))
                            <div class="error-message">
                                @foreach ($errors->get('password') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="remember-section">
                        <input class="checkbox" id="remember_me" type="checkbox" name="remember">
                        <label class="remember-label" for="remember_me">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Login Button -->
                    <button class="login-button" type="submit">
                        {{ __('Log in') }}
                    </button>

                    <!-- Forgot Password -->
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Sign Up -->
                    @if (Route::has('register'))
                        <div class="signup-section">
                            <p class="signup-text">
                                Don't have an account? 
                                <a class="signup-link" href="{{ route('register') }}">Sign up</a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</body>
</html>