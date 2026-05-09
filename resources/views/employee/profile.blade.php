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
        <div class="bg-white border-b border-gray-200 py-4">
            <div class="max-w-md mx-auto px-4 flex items-center justify-center gap-3">
                @if($employee->company->logo_url)
                    <img src="{{ asset('storage/' . $employee->company->logo_url) }}" alt="{{ $employee->company->name }}" class="h-14 w-auto object-contain">
                @endif
                <h1 class="text-xl font-bold text-gray-900">{{ $employee->company->name }}</h1>
            </div>
        </div>

        <div class="flex-1 max-w-md mx-auto w-full px-4 py-8">
            @if($employee->show_photo && $employee->photo_url)
                <div class="text-center mb-6">
                    <img src="{{ asset('storage/' . $employee->photo_url) }}" alt="{{ $employee->full_name }}" class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-white shadow-lg">
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-md p-7 mb-6 border border-gray-100 max-w-xl mx-auto">
                <div class="text-center">
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-2 leading-tight">{{ $employee->full_name }}</h1>
                    @if($employee->designation)
                        <p class="text-xl sm:text-2xl text-[#8e1d56] font-semibold mb-2 leading-snug">{{ $employee->designation }}</p>
                    @endif
                    @if($employee->department)
                        <p class="text-base text-gray-600 mb-5">{{ $employee->department }}</p>
                    @endif
                    <p class="text-base text-gray-700 mb-2 font-medium">{{ $employee->company->name }}</p>
                </div>

                @if($employee->bio)
                    <p class="text-sm text-gray-600 mt-5 pt-4 border-t border-gray-200 text-center">{{ $employee->bio }}</p>
                @endif
            </div>

            <div class="max-w-xl mx-auto grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                @if($employee->show_phone && $employee->phone)
                    <a href="tel:{{ $employee->phone }}" class="bg-[#8e1d56] hover:bg-[#741646] text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        <span class="inline-flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6.62 10.79a15.53 15.53 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.4 11.4 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 5a1 1 0 011-1h3.5a1 1 0 011 1 11.4 11.4 0 00.57 3.58 1 1 0 01-.24 1.01l-2.2 2.2z"/>
                            </svg>
                            <span>Call</span>
                        </span>
                    </a>
                @endif

                @if($employee->show_whatsapp && ($employee->whatsapp || $employee->phone))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $employee->whatsapp ?: $employee->phone) }}" target="_blank" class="bg-[#8e1d56] hover:bg-[#741646] text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        <span class="inline-flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16.6 14.22l-.72.72a1.5 1.5 0 01-1.63.34 9.7 9.7 0 01-5.53-5.53 1.5 1.5 0 01.34-1.63l.72-.72a1 1 0 000-1.41l-1.7-1.7a1 1 0 00-1.42 0l-.72.72A4.5 4.5 0 005.17 9.3a12.7 12.7 0 007.53 7.53 4.5 4.5 0 004.29-.77l.72-.72a1 1 0 000-1.42l-1.7-1.7a1 1 0 00-1.41 0z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </span>
                    </a>
                @endif

                @if($employee->show_email && $employee->email)
                    <a href="mailto:{{ $employee->email }}" class="bg-[#a72667] hover:bg-[#8e1d56] text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        <span class="inline-flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M2.25 6.75A2.25 2.25 0 014.5 4.5h15A2.25 2.25 0 0121.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75zm2.4-.75L12 11.1 19.35 6H4.65z"/>
                            </svg>
                            <span>Email</span>
                        </span>
                    </a>
                @endif

                <a href="{{ route('employee.vcard', $employee->slug) }}" class="bg-[#b83280] hover:bg-[#a72667] text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                    <span class="inline-flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 12a5 5 0 100-10 5 5 0 000 10zM3 20.25A7.25 7.25 0 0110.25 13h3.5A7.25 7.25 0 0121 20.25a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75z"/>
                        </svg>
                        <span>Save Contact</span>
                    </span>
                </a>

                @if($employee->company->map_url)
                    <a href="{{ $employee->company->map_url }}" target="_blank" class="bg-[#6f123f] hover:bg-[#5a0f33] text-white font-semibold py-3 px-4 rounded-lg text-center text-sm transition">
                        <span class="inline-flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                            </svg>
                            <span>Map</span>
                        </span>
                    </a>
                @endif
            </div>

            <div class="text-center mb-8 max-w-xl mx-auto">
                <button onclick="shareProfile()" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-3 px-6 rounded-lg transition w-full">
                    <span class="inline-flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 8a3 3 0 10-2.83-4H15a3 3 0 00.17 1L8.91 8.13a3 3 0 100 7.74l6.26 3.13A3 3 0 1016 20a2.98 2.98 0 00-.17-1l-6.26-3.13a3 3 0 000-1.74l6.26-3.13c.5.63 1.27 1 2.17 1z"/>
                        </svg>
                        <span>Share Profile</span>
                    </span>
                </button>
            </div>

            @if($employee->show_company_address)
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $employee->company->name }}</h2>

                    @if($employee->company->tagline)
                        <p class="text-sm text-gray-600 mb-4">{{ $employee->company->tagline }}</p>
                    @endif

                    @if($employee->company->bangladesh_office_address)
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-800 text-sm mb-1">Bangladesh Office</h3>
                            <p class="text-sm text-gray-600 flex items-start gap-2">
                                <span class="text-red-500 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                                    </svg>
                                </span>
                                <span>{{ $employee->company->bangladesh_office_address }}</span>
                            </p>
                        </div>
                    @endif

                    @if($employee->company->uk_office_address)
                        <div class="mb-4">
                            <h3 class="font-semibold text-gray-800 text-sm mb-1">UK Office</h3>
                            <p class="text-sm text-gray-600 flex items-start gap-2">
                                <span class="text-red-500 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z"/>
                                    </svg>
                                </span>
                                <span>{{ $employee->company->uk_office_address }}</span>
                            </p>
                        </div>
                    @endif

                    @if($employee->company->main_email || $employee->company->phone)
                        <div class="pt-4 border-t border-gray-200">
                            @if($employee->company->main_email)
                                <p class="text-sm text-gray-600 mb-2 flex items-center gap-2">
                                    <span class="text-[#8e1d56]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M2.25 6.75A2.25 2.25 0 014.5 4.5h15A2.25 2.25 0 0121.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15A2.25 2.25 0 012.25 17.25V6.75zm2.4-.75L12 11.1 19.35 6H4.65z"/>
                                        </svg>
                                    </span>
                                    <strong>Email:</strong> {{ $employee->company->main_email }}
                                </p>
                            @endif
                            @if($employee->company->phone)
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <span class="text-[#8e1d56]">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M6.62 10.79a15.53 15.53 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24 11.4 11.4 0 003.58.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 5a1 1 0 011-1h3.5a1 1 0 011 1 11.4 11.4 0 00.57 3.58 1 1 0 01-.24 1.01l-2.2 2.2z"/>
                                        </svg>
                                    </span>
                                    <strong>Phone:</strong> {{ $employee->company->phone }}
                                </p>
                            @endif
                        </div>
                    @endif

                    @if($employee->company->website || $employee->company->facebook_url || $employee->company->linkedin_url || $employee->company->instagram_url || $employee->company->youtube_url)
                        <div class="flex flex-wrap gap-3 mt-4 pt-4 border-t border-gray-200 justify-center">
                            @if($employee->company->website)
                                <a href="{{ $employee->company->website }}" target="_blank" aria-label="Website" class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[#8e1d56]/20 bg-[#8e1d56]/10 text-[#8e1d56] hover:bg-[#8e1d56]/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm7.93 9h-3.04a15.7 15.7 0 00-1.38-5.03A8.02 8.02 0 0119.93 11zM12 4c.83 1.2 1.78 3.54 2.07 7H9.93c.29-3.46 1.24-5.8 2.07-7zM8.49 5.97A15.7 15.7 0 007.11 11H4.07a8.02 8.02 0 014.42-5.03zM4.07 13h3.04c.2 1.83.73 3.57 1.38 5.03A8.02 8.02 0 014.07 13zM12 20c-.83-1.2-1.78-3.54-2.07-7h4.14c-.29 3.46-1.24 5.8-2.07 7zm3.51-1.97A15.7 15.7 0 0016.89 13h3.04a8.02 8.02 0 01-4.42 5.03z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($employee->company->facebook_url)
                                <a href="{{ $employee->company->facebook_url }}" target="_blank" aria-label="Facebook" class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[#8e1d56]/20 bg-[#8e1d56]/10 text-[#8e1d56] hover:bg-[#8e1d56]/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.5-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0022 12z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($employee->company->linkedin_url)
                                <a href="{{ $employee->company->linkedin_url }}" target="_blank" aria-label="LinkedIn" class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[#8e1d56]/20 bg-[#8e1d56]/10 text-[#8e1d56] hover:bg-[#8e1d56]/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M6.94 8.5a1.56 1.56 0 110-3.12 1.56 1.56 0 010 3.12zM5.56 9.69h2.76V18H5.56V9.69zM10.25 9.69h2.65v1.14h.04c.37-.7 1.27-1.44 2.62-1.44 2.8 0 3.32 1.85 3.32 4.25V18h-2.76v-3.88c0-.93-.02-2.12-1.29-2.12-1.3 0-1.5 1.01-1.5 2.05V18h-2.76V9.69z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($employee->company->instagram_url)
                                <a href="{{ $employee->company->instagram_url }}" target="_blank" aria-label="Instagram" class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[#8e1d56]/20 bg-[#8e1d56]/10 text-[#8e1d56] hover:bg-[#8e1d56]/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm8.34 1.72h-8.18a4.2 4.2 0 00-4.2 4.2v8.18a4.2 4.2 0 004.2 4.2h8.18a4.2 4.2 0 004.2-4.2V7.92a4.2 4.2 0 00-4.2-4.2zm-4.09 3.9a4.38 4.38 0 110 8.76 4.38 4.38 0 010-8.76zm0 1.72a2.66 2.66 0 100 5.32 2.66 2.66 0 000-5.32zm4.56-2.05a1.03 1.03 0 110 2.06 1.03 1.03 0 010-2.06z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($employee->company->youtube_url)
                                <a href="{{ $employee->company->youtube_url }}" target="_blank" aria-label="YouTube" class="w-10 h-10 inline-flex items-center justify-center rounded-full border border-[#8e1d56]/20 bg-[#8e1d56]/10 text-[#8e1d56] hover:bg-[#8e1d56]/20 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21.58 7.19a2.82 2.82 0 00-1.98-1.99C17.86 4.73 12 4.73 12 4.73s-5.86 0-7.6.47a2.82 2.82 0 00-1.98 1.99A29.6 29.6 0 002 12a29.6 29.6 0 00.42 4.81 2.82 2.82 0 001.98 1.99c1.74.47 7.6.47 7.6.47s5.86 0 7.6-.47a2.82 2.82 0 001.98-1.99A29.6 29.6 0 0022 12a29.6 29.6 0 00-.42-4.81zM10 15.5v-7l6 3.5-6 3.5z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>

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
                navigator.clipboard.writeText(url).then(() => {
                    alert('Profile URL copied to clipboard!');
                });
            }
        }
    </script>
</body>
</html>
