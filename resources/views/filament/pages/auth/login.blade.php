@extends('filament::layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 flex items-center justify-center px-4">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Card Container -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 border border-gray-100">
            <!-- Brand/Logo -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-2xl">AL</span>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-1">ALiNE</h1>
                <p class="text-sm text-gray-600 font-semibold tracking-widest">EMPLOYEE PORTAL</p>
                <div class="h-1 w-16 bg-gradient-to-r from-blue-600 to-blue-400 mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Welcome Text -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600 text-sm">Sign in to your admin account</p>
            </div>

            <!-- Login Form -->
            <form method="post" action="{{ route('filament.admin.auth.login') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-900 placeholder-gray-400 font-medium"
                        placeholder="admin@alineglobalbd.com"
                    />
                    @error('email')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-900 placeholder-gray-400 font-medium"
                        placeholder="••••••••"
                    />
                    @error('password')
                        <p class="text-red-500 text-xs font-semibold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-200 cursor-pointer"
                    />
                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer font-medium">
                        Keep me signed in
                    </label>
                </div>

                <!-- Error Alert -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-700 font-semibold text-sm">Login Failed</p>
                        <p class="text-red-600 text-xs mt-1">Please check your credentials and try again.</p>
                    </div>
                @endif

                <!-- Sign In Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:shadow-lg active:scale-95 shadow-md"
                >
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
            </div>

            <!-- Demo Credentials -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-xs font-semibold text-blue-900 mb-2">Demo Credentials</p>
                <div class="space-y-1 text-xs text-blue-800 font-mono">
                    <p><span class="font-semibold">Email:</span> admin@alineglobalbd.com</p>
                    <p><span class="font-semibold">Password:</span> password</p>
                </div>
                <p class="text-xs text-blue-600 mt-3 italic">⚠️ Change password after first login</p>
            </div>

            <!-- Footer -->
            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-600">
                    ALiNE GLOBAL Management System
                </p>
                <p class="text-xs text-gray-500 mt-2">
                    © {{ now()->year }} ALiNE GLOBAL. All rights reserved.
                </p>
            </div>
        </div>

        <!-- Support Info -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-600">
                Having trouble? Contact your administrator
            </p>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #eff6ff 0%, #ffffff 25%, #f0f9ff 75%, #e0f2fe 100%);
    }
</style>
@endsection
