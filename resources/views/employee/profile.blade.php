<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $employee->full_name }} - ALiNE GLOBAL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 py-4">
            <div class="max-w-md mx-auto px-4 flex justify-center">
                @if($employee->company->logo_url)
                    <img src="{{ asset('storage/' . $employee->company->logo_url) }}" alt="{{ $employee->company->name }}" class="h-12">
                @else
                    <h1 class="text-lg font-bold text-gray-900">{{ $employee->company->name }}</h1>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 max-w-md mx-auto w-full px-4 py-8">
            <!-- Employee Photo -->
            @if($employee->show_photo && $employee->photo_url)
                <div class="text-center mb-6">
                    <img src="{{ asset('storage/' . $employee->photo_url) }}" alt="{{ $employee->full_name }}" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-white shadow-lg">
                </div>
            @endif

            <!-- Employee Info Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ $employee->full_name }}</h1>
                @if($employee->designation)
                    <p class="text-lg text-blue-600 font-semibold mb-1">{{ $employee->designation }}</p>
                @endif
                @if($employee->department)
                    <p class="text-sm text-gray-600 mb-4">{{ $employee->department }}</p>
                @endif
                <p class="text-sm text-gray-700 mb-4">{{ $employee->company->name }}</p>

                @if($employee->bio)
                    <p class="text-sm text-gray-600 mt-4 pt-4 border-t border-gray-200">{{ $employee->bio }}</p>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-3 mb-6">
                @if($employee->show_phone && $employee->phone)
                    <a href="tel:{{ $employee->phone }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        📞 Call
                    </a>
                @endif

                @if($employee->show_whatsapp && ($employee->whatsapp || $employee->phone))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $employee->whatsapp ?: $employee->phone) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        💬 WhatsApp
                    </a>
                @endif

                @if($employee->show_email && $employee->email)
                    <a href="mailto:{{ $employee->email }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        ✉️ Email
                    </a>
                @endif

                <a href="{{ route('employee.vcard', $employee->slug) }}" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                    👤 Save Contact
                </a>

                @if($employee->company->website)
                    <a href="{{ $employee->company->website }}" target="_blank" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        🌐 Website
                    </a>
                @endif

                @if($employee->company->map_url)
                    <a href="{{ $employee->company->map_url }}" target="_blank" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        📍 Map
                    </a>
                @endif
            </div>

            <!-- Share Button -->
            <div class="text-center mb-8">
                <button onclick="shareProfile()" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-6 rounded-lg transition w-full">
                    📤 Share Profile
                </button>
            </div>

            <!-- Company Info Section -->
            @if($employee->show_company_address)
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $employee->company->name }}</h2>

                    @if($employee->company->tagline)
                        <p class="text-sm text-gray-600 mb-4">{{ $employee->company->tagline }}</p>
                    @endif

                    @if($employee->company->bangladesh_office_address)
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-800 text-sm mb-1">Bangladesh Office</h3>
                            <p class="text-sm text-gray-600">{{ $employee->company->bangladesh_office_address }}</p>
                        </div>
                    @endif

                    @if($employee->company->uk_office_address)
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-800 text-sm mb-1">UK Office</h3>
                            <p class="text-sm text-gray-600">{{ $employee->company->uk_office_address }}</p>
                        </div>
                    @endif

                    @if($employee->company->main_email || $employee->company->phone)
                        <div class="pt-4 border-t border-gray-200">
                            @if($employee->company->main_email)
                                <p class="text-sm text-gray-600 mb-1"><strong>Email:</strong> {{ $employee->company->main_email }}</p>
                            @endif
                            @if($employee->company->phone)
                                <p class="text-sm text-gray-600"><strong>Phone:</strong> {{ $employee->company->phone }}</p>
                            @endif
                        </div>
                    @endif

                    <!-- Social Links -->
                    @if($employee->company->facebook_url || $employee->company->linkedin_url || $employee->company->instagram_url || $employee->company->youtube_url)
                        <div class="flex gap-3 mt-4 pt-4 border-t border-gray-200 justify-center">
                            @if($employee->company->facebook_url)
                                <a href="{{ $employee->company->facebook_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Facebook</a>
                            @endif
                            @if($employee->company->linkedin_url)
                                <a href="{{ $employee->company->linkedin_url }}" target="_blank" class="text-blue-700 hover:text-blue-900 text-sm font-semibold">LinkedIn</a>
                            @endif
                            @if($employee->company->instagram_url)
                                <a href="{{ $employee->company->instagram_url }}" target="_blank" class="text-pink-600 hover:text-pink-800 text-sm font-semibold">Instagram</a>
                            @endif
                            @if($employee->company->youtube_url)
                                <a href="{{ $employee->company->youtube_url }}" target="_blank" class="text-red-600 hover:text-red-800 text-sm font-semibold">YouTube</a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="bg-gray-900 text-white py-6 text-center">
            <p class="text-xs text-gray-400">Powered by <strong>ALiNE GLOBAL</strong></p>
        </div>
    </div>

    <script>
        function shareProfile() {
            const url = '{{ route("employee.public.show", $employee->slug) }}';
            const title = '{{ $employee->full_name }} - {{ $employee->company->name }}';

            if (navigator.share) {
                navigator.share({
                    title: title,
                    text: 'Check out my professional profile at ALiNE GLOBAL',
                    url: url,
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    alert('Profile URL copied to clipboard!');
                });
            }
        }
    </script>
</body>
</html>
