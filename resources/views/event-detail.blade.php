<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $event->title }} - VolunteerAAT</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gradient-to-b from-indigo-50/40 via-white to-white text-gray-900">

    {{-- =========================================================
        NAVBAR
    ========================================================== --}}
    <header class="bg-white/80 backdrop-blur-md border-b border-gray-200/80 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center gap-4 h-16">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group min-w-0 flex-shrink-0">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Logo Yayasan AAT"
                        class="h-7 w-7 sm:h-8 sm:w-8 object-contain flex-shrink-0 transition-transform duration-200 group-hover:scale-105"
                    >

                    <span class="font-bold text-base sm:text-lg tracking-wide whitespace-nowrap">
                        <span class="text-indigo-600">Volunteer</span><span class="text-gray-800">AAT</span>
                    </span>

                </a>

                {{-- BACK --}}
                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center gap-1.5 flex-shrink-0
                           text-xs sm:text-sm font-semibold text-gray-600 whitespace-nowrap
                           hover:text-indigo-600 hover:-translate-x-0.5 transition-all duration-200"
                >
                    <span aria-hidden="true">←</span>
                    <span class="hidden sm:inline">Kembali ke Kegiatan</span>
                    <span class="sm:hidden">Kembali</span>
                </a>

            </div>

        </div>
    </header>


    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <main class="py-10 sm:py-14">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- BREADCRUMB --}}
            <nav class="mb-6 flex items-center text-sm" aria-label="Breadcrumb">

                <a
                    href="{{ route('home') }}"
                    class="text-gray-500 hover:text-indigo-600 transition"
                >
                    Beranda
                </a>

                <svg class="w-4 h-4 mx-2 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>

                <span class="text-gray-700 font-medium truncate max-w-[240px]">
                    {{ $event->title }}
                </span>

            </nav>


            {{-- =================================================
                EVENT CARD
            ================================================== --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-indigo-100/50 overflow-hidden border border-gray-100">

                {{-- =================================================
                    COVER IMAGE
                ================================================== --}}
                <div class="relative bg-indigo-100">

                    @if($event->cover_image)

                        <img
                            src="{{ asset('storage/' . $event->cover_image) }}"
                            alt="{{ $event->title }}"
                            class="w-full h-48 sm:h-64 lg:h-72 object-cover"
                        >

                        {{-- GRADIENT OVERLAY untuk kontras badge status --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/0 to-black/10 pointer-events-none"></div>

                    @else

                        <div class="w-full h-48 sm:h-64 lg:h-72
                                    flex items-center justify-center
                                    bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100
                                    relative overflow-hidden">

                            {{-- DEKORASI --}}
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-200/40 rounded-full blur-3xl"></div>
                            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-200/40 rounded-full blur-3xl"></div>

                            <div class="text-center relative">

                                <div class="text-4xl mb-2">
                                    📸
                                </div>

                                <p class="text-indigo-500 font-semibold text-base">
                                    Foto Kegiatan
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    Belum ada poster kegiatan
                                </p>

                            </div>

                        </div>

                    @endif


                    {{-- STATUS DI ATAS POSTER --}}
                    <div class="absolute top-5 left-5">

                        @if($event->status === 'Buka')

                            <span class="inline-flex items-center gap-2
                                         px-4 py-2
                                         rounded-full
                                         bg-green-500/95
                                         backdrop-blur-sm
                                         text-white
                                         text-sm
                                         font-bold
                                         shadow-lg
                                         ring-1 ring-white/20">

                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                </span>

                                Pendaftaran Dibuka

                            </span>

                        @elseif($event->status === 'Selesai')

                            <span class="inline-flex items-center gap-2
                                         px-4 py-2
                                         rounded-full
                                         bg-gray-800/90
                                         backdrop-blur-sm
                                         text-white
                                         text-sm
                                         font-bold
                                         shadow-lg
                                         ring-1 ring-white/20">

                                ⚪ Kegiatan Selesai

                            </span>

                        @else

                            <span class="inline-flex items-center gap-2
                                         px-4 py-2
                                         rounded-full
                                         bg-yellow-500/95
                                         backdrop-blur-sm
                                         text-white
                                         text-sm
                                         font-bold
                                         shadow-lg
                                         ring-1 ring-white/20">

                                {{ $event->status }}

                            </span>

                        @endif

                    </div>

                </div>


                {{-- =================================================
                    CONTENT
                ================================================== --}}
                <div class="p-6 sm:p-8 lg:p-10">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                        {{-- =================================================
                            LEFT CONTENT
                        ================================================== --}}
                        <div class="lg:col-span-2">

                            {{-- TITLE --}}
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl
                                       font-extrabold
                                       leading-tight
                                       text-gray-900
                                       tracking-tight">

                                {{ $event->title }}

                            </h1>


                            {{-- SHORT INTRO --}}
                            <p class="mt-4 text-gray-500 leading-relaxed text-base">

                                Yuk, ambil bagian dalam kegiatan sosial bersama
                                Yayasan AAT Indonesia dan berikan kontribusi
                                positif melalui aksi nyata.

                            </p>


                            {{-- =================================================
                                EVENT INFORMATION
                            ================================================== --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">

                                {{-- TANGGAL --}}
                                <div class="flex items-start gap-4
                                            p-5
                                            rounded-2xl
                                            bg-indigo-50/70
                                            border border-indigo-100
                                            transition-all duration-200
                                            hover:bg-indigo-50 hover:border-indigo-200 hover:shadow-sm">

                                    <div class="flex-shrink-0
                                                w-11 h-11
                                                rounded-xl
                                                bg-indigo-600
                                                text-white
                                                flex items-center justify-center
                                                text-xl
                                                shadow-sm shadow-indigo-300">

                                        📅

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-sm text-gray-500">
                                            Tanggal Kegiatan
                                        </p>

                                        <p class="mt-1 font-bold text-gray-900">

                                            {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('l, d F Y') }}

                                        </p>

                                    </div>

                                </div>


                                {{-- LOKASI --}}
                                <div class="flex items-start gap-4
                                            p-5
                                            rounded-2xl
                                            bg-indigo-50/70
                                            border border-indigo-100
                                            transition-all duration-200
                                            hover:bg-indigo-50 hover:border-indigo-200 hover:shadow-sm">

                                    <div class="flex-shrink-0
                                                w-11 h-11
                                                rounded-xl
                                                bg-indigo-600
                                                text-white
                                                flex items-center justify-center
                                                text-xl
                                                shadow-sm shadow-indigo-300">

                                        📍

                                    </div>

                                    <div class="min-w-0">

                                        <p class="text-sm text-gray-500">
                                            Lokasi
                                        </p>

                                        <p class="mt-1 font-bold text-gray-900 break-words">
                                            {{ $event->location }}
                                        </p>

                                    </div>

                                </div>


                                {{-- KUOTA --}}
                                <div class="flex items-start gap-4
                                            p-5
                                            rounded-2xl
                                            bg-indigo-50/70
                                            border border-indigo-100
                                            transition-all duration-200
                                            hover:bg-indigo-50 hover:border-indigo-200 hover:shadow-sm">

                                    <div class="flex-shrink-0
                                                w-11 h-11
                                                rounded-xl
                                                bg-indigo-600
                                                text-white
                                                flex items-center justify-center
                                                text-xl
                                                shadow-sm shadow-indigo-300">

                                        👥

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Kuota Relawan
                                        </p>

                                        <p class="mt-1 font-bold text-gray-900">
                                            {{ $event->quota }} Orang
                                        </p>

                                    </div>

                                </div>


                                {{-- STATUS --}}
                                <div class="flex items-start gap-4
                                            p-5
                                            rounded-2xl
                                            bg-indigo-50/70
                                            border border-indigo-100
                                            transition-all duration-200
                                            hover:bg-indigo-50 hover:border-indigo-200 hover:shadow-sm">

                                    <div class="flex-shrink-0
                                                w-11 h-11
                                                rounded-xl
                                                bg-indigo-600
                                                text-white
                                                flex items-center justify-center
                                                text-xl
                                                shadow-sm shadow-indigo-300">

                                        ✓

                                    </div>

                                    <div>

                                        <p class="text-sm text-gray-500">
                                            Status Kegiatan
                                        </p>

                                        <p class="mt-1 font-bold text-gray-900">
                                            {{ $event->status }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                DESCRIPTION
                            ================================================== --}}
                            <div class="mt-10 pt-8 border-t border-gray-200">

                                <h2 class="text-2xl font-extrabold text-gray-900 flex items-center gap-2">
                                    <span class="w-1.5 h-6 rounded-full bg-indigo-600 inline-block"></span>
                                    Tentang Kegiatan
                                </h2>

                                <div class="mt-5 text-gray-600 leading-8 whitespace-pre-line">

                                    {{ $event->description }}

                                </div>

                            </div>


                            {{-- =================================================
                                INFORMATION
                            ================================================== --}}
                            <div class="mt-8 p-5 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100/60 border border-gray-200">

                                <div class="flex gap-4">

                                    <div class="text-2xl">
                                        💡
                                    </div>

                                    <div>

                                        <h3 class="font-bold text-gray-900">
                                            Mengapa ikut menjadi relawan?
                                        </h3>

                                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">

                                            Dengan menjadi relawan, kamu dapat
                                            berkontribusi langsung dalam kegiatan
                                            sosial dan pendidikan, mendapatkan
                                            pengalaman baru, serta bertemu dengan
                                            orang-orang yang memiliki semangat
                                            kepedulian yang sama.

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                            RIGHT - REGISTRATION CARD
                        ================================================== --}}
                        <div class="lg:col-span-1">

                            <div class="lg:sticky lg:top-24">

                                <div class="rounded-2xl
                                            border border-gray-200
                                            bg-white
                                            shadow-lg shadow-indigo-100/40
                                            overflow-hidden">

                                    {{-- HEADER --}}
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white relative overflow-hidden">

                                        {{-- DEKORASI --}}
                                        <div class="absolute -top-6 -right-6 w-24 h-24 bg-white/10 rounded-full"></div>
                                        <div class="absolute -bottom-8 -left-4 w-20 h-20 bg-white/10 rounded-full"></div>

                                        <p class="text-sm opacity-90 relative">
                                            Tertarik mengikuti kegiatan ini?
                                        </p>

                                        <h3 class="mt-1 text-xl font-bold relative">
                                            Daftar sebagai Relawan
                                        </h3>

                                    </div>


                                    {{-- BODY --}}
                                    <div class="p-6">

                                        {{-- STATUS --}}
                                        <div class="flex items-center justify-between mb-5">

                                            <span class="text-sm text-gray-500">
                                                Status
                                            </span>

                                            @if($event->status === 'Buka')

                                                <span class="px-3 py-1
                                                             rounded-full
                                                             bg-green-100
                                                             text-green-700
                                                             text-xs
                                                             font-bold">

                                                    ● Dibuka

                                                </span>

                                            @elseif($event->status === 'Selesai')

                                                <span class="px-3 py-1
                                                             rounded-full
                                                             bg-gray-100
                                                             text-gray-600
                                                             text-xs
                                                             font-bold">

                                                    Selesai

                                                </span>

                                            @else

                                                <span class="px-3 py-1
                                                             rounded-full
                                                             bg-yellow-100
                                                             text-yellow-700
                                                             text-xs
                                                             font-bold">

                                                    {{ $event->status }}

                                                </span>

                                            @endif

                                        </div>


                                        {{-- DATE --}}
                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">

                                            <span class="text-sm text-gray-500">
                                                📅 Tanggal
                                            </span>

                                            <span class="text-sm font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                                            </span>

                                        </div>


                                        {{-- LOCATION --}}
                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">

                                            <span class="text-sm text-gray-500">
                                                📍 Lokasi
                                            </span>

                                            <span class="text-sm font-semibold text-gray-800 text-right ml-4">
                                                {{ $event->location }}
                                            </span>

                                        </div>


                                        {{-- QUOTA --}}
                                        <div class="flex items-center justify-between py-3">

                                            <span class="text-sm text-gray-500">
                                                👥 Kuota
                                            </span>

                                            <span class="text-sm font-bold text-indigo-600">
                                                {{ $event->quota }} Orang
                                            </span>

                                        </div>


                                        {{-- =================================================
                                            BUTTON
                                        ================================================== --}}
                                        <div class="mt-6">

                                            @if($event->status === 'Buka')

                                                @auth

                                                    @if(auth()->user()->hasRole('relawan'))

                                                        <form
                                                            action="{{ route('volunteer.events.register', $event) }}"
                                                            method="POST"
                                                        >

                                                            @csrf

                                                            <button
                                                                type="submit"
                                                                class="w-full
                                                                       inline-flex
                                                                       items-center
                                                                       justify-center
                                                                       gap-2
                                                                       px-6
                                                                       py-3.5
                                                                       rounded-xl
                                                                       bg-indigo-600
                                                                       text-white
                                                                       font-bold
                                                                       shadow-md shadow-indigo-200
                                                                       hover:bg-indigo-700
                                                                       hover:shadow-lg
                                                                       hover:-translate-y-0.5
                                                                       active:translate-y-0
                                                                       transition-all
                                                                       duration-200"
                                                            >

                                                                Daftar Sekarang
                                                                <span aria-hidden="true">→</span>

                                                            </button>

                                                        </form>

                                                        <p class="text-xs text-center text-gray-400 mt-3">
                                                            Pastikan data profil kamu sudah lengkap.
                                                        </p>

                                                    @else

                                                        <div class="p-4
                                                                    rounded-xl
                                                                    bg-yellow-50
                                                                    border
                                                                    border-yellow-200
                                                                    flex items-start gap-2">

                                                            <span class="text-yellow-500">⚠️</span>

                                                            <p class="text-sm text-yellow-700">
                                                                Akun Anda tidak dapat
                                                                mendaftar sebagai relawan.
                                                            </p>

                                                        </div>

                                                    @endif

                                                @else

                                                    <a
                                                        href="{{ route('login') }}"
                                                        class="w-full
                                                               inline-flex
                                                               items-center
                                                               justify-center
                                                               gap-2
                                                               px-6
                                                               py-3.5
                                                               rounded-xl
                                                               bg-indigo-600
                                                               text-white
                                                               font-bold
                                                               shadow-md shadow-indigo-200
                                                               hover:bg-indigo-700
                                                               hover:shadow-lg
                                                               hover:-translate-y-0.5
                                                               active:translate-y-0
                                                               transition-all
                                                               duration-200"
                                                    >

                                                        Login untuk Mendaftar
                                                        <span aria-hidden="true">→</span>

                                                    </a>

                                                    <p class="text-xs text-center text-gray-400 mt-3">
                                                        Belum punya akun?
                                                        <a
                                                            href="{{ route('register') }}"
                                                            class="text-indigo-600 font-semibold hover:underline"
                                                        >
                                                            Daftar sekarang
                                                        </a>
                                                    </p>

                                                @endauth

                                            @elseif($event->status === 'Selesai')

                                                <div class="w-full
                                                            px-6
                                                            py-3.5
                                                            rounded-xl
                                                            bg-gray-100
                                                            text-gray-500
                                                            text-center
                                                            font-bold">

                                                    Pendaftaran Ditutup

                                                </div>

                                            @else

                                                <div class="w-full
                                                            px-6
                                                            py-3.5
                                                            rounded-xl
                                                            bg-yellow-50
                                                            text-yellow-700
                                                            border
                                                            border-yellow-200
                                                            text-center
                                                            font-bold">

                                                    Pendaftaran Belum Dibuka

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </div>


                                {{-- HELP CARD --}}
                                <div class="mt-5 p-5
                                            rounded-2xl
                                            bg-indigo-50
                                            border border-indigo-100">

                                    <div class="flex gap-3">

                                        <span class="text-xl">
                                            💬
                                        </span>

                                        <div>

                                            <h4 class="font-bold text-gray-900">
                                                Butuh informasi?
                                            </h4>

                                            <p class="mt-1 text-xs text-gray-600 leading-relaxed">
                                                Pastikan membaca informasi kegiatan
                                                sebelum melakukan pendaftaran.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="bg-white border-t border-gray-200 mt-10">

        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

            <div class="text-center">

                <div class="flex justify-center items-center gap-2 mb-3">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Logo"
                        class="h-6 w-6 object-contain"
                    >

                    <span class="font-bold text-base">
                        <span class="text-indigo-600">Volunteer</span>AAT
                    </span>

                </div>

                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Yayasan AAT Indonesia.
                    Hak cipta dilindungi undang-undang.
                </p>

            </div>

        </div>

    </footer>

</body>

</html>