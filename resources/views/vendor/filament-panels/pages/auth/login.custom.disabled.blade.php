@php
    $user = filament()->auth()->user();
@endphp

<style>
    .fi-simple-main {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 25%, #f0f9ff 75%, #e0f2fe 100%) !important;
        box-shadow: none !important;
        ring: none !important;
        border: none !important;
    }

    .fi-simple-layout {
        background: white !important;
    }

    .login-card-inner {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.8);
        padding: 40px;
        max-width: 420px;
        margin: 0 auto;
    }

    .brand-section {
        text-align: center;
        margin-bottom: 30px;
    }

    .brand-logo {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border-radius: 50%;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
        font-size: 28px;
        font-weight: bold;
        color: white;
    }

    .brand-name {
        font-size: 28px;
        font-weight: bold;
        color: #111827;
        margin-bottom: 5px;
    }

    .brand-subtitle {
        font-size: 12px;
        color: #6b7280;
        font-weight: 600;
        letter-spacing: 2px;
    }

    .divider {
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

    .welcome-heading {
        font-size: 22px;
        font-weight: bold;
        color: #111827;
        margin-bottom: 5px;
    }

    .welcome-desc {
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
        color: #111827;
        transition: all 0.3s ease;
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

    .submit-btn {
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
        margin-top: 10px;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    .submit-btn:active {
        transform: scale(0.98);
    }

    .error-alert {
        background-color: #fee2e2;
        border: 1px solid #fecaca;
        border-radius: 10px;
        padding: 12px;
        margin-bottom: 20px;
        color: #dc2626;
        font-size: 13px;
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

<div class="login-card-inner">
    <!-- Brand -->
    <div class="brand-section">
        <div class="brand-logo">AL</div>
        <div class="brand-name">ALiNE</div>
        <div class="brand-subtitle">EMPLOYEE PORTAL</div>
        <div class="divider"></div>
    </div>

    <!-- Welcome -->
    <div class="welcome-text">
        <div class="welcome-heading">Welcome Back</div>
        <div class="welcome-desc">Sign in to your admin account</div>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="authenticate" class="space-y-6">
        @if ($errors->any())
            <div class="error-alert">
                <strong>Login Failed</strong><br>
                Please check your credentials and try again.
            </div>
        @endif

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input
                type="email"
                id="email"
                wire:model="data.email"
                class="form-input"
                placeholder="admin@alineglobalbd.com"
                required
                autofocus
            />
            @error('data.email')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                id="password"
                wire:model="data.password"
                class="form-input"
                placeholder="••••••••"
                required
            />
            @error('data.password')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="checkbox-group">
            <input
                type="checkbox"
                id="remember"
                wire:model="data.remember"
                class="checkbox-input"
            />
            <label for="remember" class="checkbox-label">Keep me signed in</label>
        </div>

        <button type="submit" class="submit-btn">
            Sign In
        </button>
    </form>

    <!-- Footer -->
    <div class="footer">
        <p>ALiNE GLOBAL Management System</p>
        <p>© {{ now()->year }} ALiNE GLOBAL. All rights reserved.</p>
    </div>
</div>
