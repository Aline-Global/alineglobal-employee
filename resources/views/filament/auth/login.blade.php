@extends('filament::auth.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <!-- Brand/Logo -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">ALiNE</h1>
                <p class="text-sm text-gray-600 font-semibold tracking-wide">EMPLOYEE PORTAL</p>
                <div class="h-1 w-12 bg-blue-600 mx-auto mt-3 rounded-full"></div>
            </div>

            <!-- Welcome Text -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-600 text-sm">Sign in to manage employee profiles</p>
            </div>

            <!-- Form -->
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
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-900 placeholder-gray-400"
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
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition text-gray-900 placeholder-gray-400"
                        placeholder="Enter your password"
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
                        class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer"
                    />
                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer">
                        Remember me
                    </label>
                </div>

                <!-- Sign In Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-105 active:scale-95 shadow-lg"
                >
                    Sign In
                </button>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <p class="font-semibold">Login Failed</p>
                        <p class="mt-1">Please check your email and password and try again.</p>
                    </div>
                @endif
            </form>

            <!-- Footer -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <p class="text-center text-xs text-gray-600">
                    ALiNE GLOBAL Employee Management System
                </p>
                <p class="text-center text-xs text-gray-500 mt-2">
                    © {{ now()->year }} ALiNE GLOBAL. All rights reserved.
                </p>
            </div>
        </div>

        <!-- Help Text -->
        <div class="text-center mt-6 text-sm text-gray-600">
            <p>Default credentials:</p>
            <p class="font-mono text-xs mt-2 bg-white bg-opacity-50 rounded px-3 py-2">
                admin@alineglobalbd.com / password
            </p>
            <p class="text-xs mt-3 text-gray-500">Change password after first login</p>
        </div>
    </div>

    <!-- Background Decoration -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 -z-10"></div>
</div>
@endsection
