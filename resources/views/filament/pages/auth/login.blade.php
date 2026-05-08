@extends('filament::layouts.auth')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 25%, #f0f9ff 75%, #e0f2fe 100%);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .decorative-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.2;
        mix-blend-mode: multiply;
    }

    .blob-1 {
        width: 400px;
        height: 400px;
        background: #3b82f6;
        top: -100px;
        left: -100px;
    }

    .blob-2 {
        width: 400px;
        height: 400px;
        background: #818cf8;
        bottom: -100px;
        right: -100px;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 420px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        position: relative;
        z-index: 10;
    }

    .brand-logo {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
    }

    .brand-logo span {
        color: white;
        font-weight: bold;
        font-size: 28px;
    }

    .brand-name {
        text-align: center;
        margin-bottom: 30px;
    }

    .brand-name h1 {
        font-size: 28px;
        font-weight: bold;
        color: #111827;
        margin: 10px 0 5px;
    }

    .brand-name p {
        font-size: 12px;
        color: #6b7280;
        font-weight: 600;
        letter-spacing: 2px;
    }

    .brand-divider {
        height: 4px;
        width: 64px;
        background: linear-gradient(90deg, #2563eb 0%, #60a5fa 100%);
        margin: 15px auto;
        border-radius: 2px;
    }

    .welcome-text {
        text-align: center;
        margin-bottom: 30px;
    }

    .welcome-text h2 {
        font-size: 22px;
        font-weight: bold;
        color: #111827;
        margin-bottom: 5px;
    }

    .welcome-text p {
        font-size: 14px;
        color: #6b7280;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d1d5db;
        background-color: #f9fafb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        box-sizing: border-box;
        color: #111827;
    }

    .form-input:focus {
        outline: none;
        background-color: white;
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }

    .checkbox-input {
        width: 16px;
        height: 16px;
        border: 1px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
        accent-color: #2563eb;
    }

    .checkbox-label {
        margin-left: 8px;
        font-size: 14px;
        color: #6b7280;
        cursor: pointer;
        font-weight: 500;
    }

    .submit-button {
        width: 100%;
        padding: 12px 16px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    .submit-button:active {
        transform: scale(0.98);
    }

    .error-alert {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        border-radius: 10px;
        padding: 12px;
        margin: 20px 0;
        color: #dc2626;
        font-size: 13px;
    }

    .error-alert strong {
        display: block;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .demo-section {
        background-color: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 10px;
        padding: 16px;
        margin-top: 20px;
    }

    .demo-title {
        font-size: 12px;
        font-weight: 600;
        color: #075985;
        margin-bottom: 8px;
    }

    .demo-creds {
        font-family: 'Monaco', 'Courier New', monospace;
        font-size: 12px;
        color: #1e40af;
        line-height: 1.6;
    }

    .demo-warning {
        font-size: 11px;
        color: #0c63e4;
        margin-top: 8px;
        font-style: italic;
    }

    .footer {
        text-align: center;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
    }

    .footer p {
        font-size: 12px;
        color: #6b7280;
        margin: 4px 0;
    }
</style>

<div class="login-container">
    <div class="decorative-blob blob-1"></div>
    <div class="decorative-blob blob-2"></div>

    <div class="login-card">
        <!-- Brand -->
        <div class="brand-logo">
            <span>AL</span>
        </div>

        <div class="brand-name">
            <h1>ALiNE</h1>
            <p>EMPLOYEE PORTAL</p>
            <div class="brand-divider"></div>
        </div>

        <!-- Welcome Message -->
        <div class="welcome-text">
            <h2>Welcome Back</h2>
            <p>Sign in to your admin account</p>
        </div>

        <!-- Login Form -->
        <form method="post" action="{{ route('filament.admin.auth.login') }}">
            @csrf

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-alert">
                    <strong>Login Failed</strong>
                    Please check your credentials and try again.
                </div>
            @endif

            <!-- Email Field -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-input"
                    placeholder="admin@alineglobalbd.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="••••••••"
                    required
                />
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="checkbox-input"
                />
                <label for="remember" class="checkbox-label">Keep me signed in</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-button">Sign In</button>
        </form>

        <!-- Demo Credentials -->
        <div class="demo-section">
            <div class="demo-title">Demo Credentials</div>
            <div class="demo-creds">
                <div><strong>Email:</strong> admin@alineglobalbd.com</div>
                <div><strong>Password:</strong> password</div>
            </div>
            <div class="demo-warning">⚠️ Change password after first login</div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>ALiNE GLOBAL Management System</p>
            <p>© {{ now()->year }} ALiNE GLOBAL. All rights reserved.</p>
        </div>
    </div>
</div>
@endsection
