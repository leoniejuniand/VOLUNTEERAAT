<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VolunteerAAT - Yayasan AAT Indonesia</title>
    
    <!-- Memanggil Tailwind CSS bawaan Laravel -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50 text-gray-900">

    <!-- Navigasi Atas -->
    <header class="bg-white shadow-sm fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo / Nama Brand -->
                <div class="flex-shrink-0 flex items-center space-x-3">
                    <img class="h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo Yayasan AAT">
                    <span class="font-bold text-2xl text-indigo-600 tracking-wider">Volunteer<span class="text-gray-800">AAT</span></span>
                </div>
                
                
                <!-- Menu Login / Register -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">
                                Dashboard Saya &rarr;
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">
                                    REGISTER
                                </a>
                            @endif
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition">
                                LOGIN
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>

    </header>

    <!-- Hero Section (Konten Utama dengan Foto) -->
    <main class="relative pt-24 pb-16 sm:pt-32 sm:pb-24 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="lg:grid lg:grid-cols-12 lg:gap-16 items-center">
                
                <!-- Kolom Kiri: Teks & Tombol -->
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold text-indigo-600 bg-indigo-100 mb-6">
                        🌟 Bergabunglah Bersama Kami
                    </div>
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                        <span class="block">Wujudkan Kepedulian,</span>
                        <span class="block text-indigo-600 mt-1">Jadilah Relawan Sejati</span>
                    </h1>
                    <p class="mt-4 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Platform resmi manajemen relawan Yayasan AAT Indonesia. Daftarkan diri Anda, ikuti berbagai kegiatan sosial dan pendidikan, serta dapatkan e-sertifikat sebagai bentuk apresiasi atas dedikasi Anda.
                    </p>
                    
                    <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start">
                        <div class="rounded-md shadow">
                            <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg transition-transform hover:scale-105">
                                JOIN US NOW!
                            </a>
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3 text-center sm:text-left flex items-center">
                            <span class="text-sm text-gray-500 italic">"Satu tindakan kecil, berjuta senyuman."</span>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Foto Dokumentasi -->
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-2xl shadow-2xl lg:max-w-md overflow-hidden transform hover:scale-105 transition duration-500">
                        <!-- Ganti URL src di bawah ini jika Anda ingin menggunakan foto lokal dari folder public/images -->
                        <img class="w-full h-auto object-cover" src="{{ asset('images/landingpage.jpg') }}" alt="Relawan">                        
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6 text-white">
                            <p class="font-semibold text-lg">Langkah Nyata, Dampak Bermakna</p>
                            <p class="text-sm opacity-90">Setiap waktu yang Anda berikan adalah harapan baru bagi mereka.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
            
        <!-- Bagian Kegiatan -->
<!-- Bagian Kegiatan -->
<section class="py-16 bg-gray-50" id="kegiatan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Heading -->
        <div class="text-center mb-12">
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold text-indigo-600 bg-indigo-100">
                🌟 Kegiatan Kami
            </span>

            <h2 class="mt-4 text-3xl md:text-4xl font-extrabold text-gray-900">
                Kegiatan Volunteer Terbaru
            </h2>

            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500">
                Temukan berbagai kegiatan sosial dan pendidikan yang dapat kamu ikuti
                untuk memberikan dampak positif bersama Yayasan AAT Indonesia.
            </p>
        </div>


        <!-- Grid Kegiatan -->
        @if($kegiatan->count() > 0)

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($kegiatan as $item)

                    <div class="bg-white rounded-2xl shadow-md overflow-hidden
                                border border-gray-100
                                hover:shadow-xl hover:-translate-y-1
                                transition-all duration-300">

                        <!-- ========================= -->
                        <!-- POSTER -->
                        <!-- ========================= -->

                        <div class="relative h-56 bg-indigo-100 overflow-hidden">

                            @if($item->cover_image)

                                <img
                                    src="{{ asset('storage/' . $item->cover_image) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover
                                           hover:scale-105 transition-transform duration-500"
                                >

                            @else

                                <div class="w-full h-full flex flex-col
                                            items-center justify-center
                                            text-indigo-400">

                                    <span class="text-5xl">📸</span>

                                    <span class="mt-2 text-sm font-medium">
                                        Poster belum tersedia
                                    </span>

                                </div>

                            @endif


                            <!-- STATUS -->
                            <div class="absolute top-4 right-4">

                                @if($item->status === 'Buka')

                                    <span class="inline-flex items-center px-3 py-1
                                                 rounded-full text-xs font-bold
                                                 bg-green-100 text-green-700
                                                 shadow-sm">

                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>

                                        Buka

                                    </span>

                                @elseif($item->status === 'Selesai')

                                    <span class="inline-flex items-center px-3 py-1
                                                 rounded-full text-xs font-bold
                                                 bg-gray-100 text-gray-600
                                                 shadow-sm">

                                        <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>

                                        Selesai

                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1
                                                 rounded-full text-xs font-bold
                                                 bg-yellow-100 text-yellow-700
                                                 shadow-sm">

                                        {{ $item->status }}

                                    </span>

                                @endif

                            </div>

                        </div>


                        <!-- ========================= -->
                        <!-- INFORMASI EVENT -->
                        <!-- ========================= -->

                        <div class="p-6">

                            <!-- TITLE -->
                            <h3 class="text-xl font-bold text-gray-900 leading-snug">

                                {{ $item->title }}

                            </h3>


                            <!-- DESCRIPTION -->
                            <p class="mt-3 text-sm text-gray-500 leading-relaxed line-clamp-2">

                                {{ $item->description }}

                            </p>


                            <!-- INFO -->
                            <div class="mt-5 space-y-3">

                                <!-- Tanggal -->
                                <div class="flex items-center text-sm text-gray-600">

                                    <div class="w-8 h-8 rounded-lg bg-indigo-50
                                                flex items-center justify-center
                                                text-indigo-600">

                                        📅

                                    </div>

                                    <div class="ml-3">

                                        <p class="text-xs text-gray-400">
                                            Tanggal
                                        </p>

                                        <p class="font-medium">

                                            {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d F Y') }}

                                        </p>

                                    </div>

                                </div>


                                <!-- Lokasi -->
                                <div class="flex items-center text-sm text-gray-600">

                                    <div class="w-8 h-8 rounded-lg bg-indigo-50
                                                flex items-center justify-center
                                                text-indigo-600">

                                        📍

                                    </div>

                                    <div class="ml-3 min-w-0">

                                        <p class="text-xs text-gray-400">
                                            Lokasi
                                        </p>

                                        <p class="font-medium truncate">

                                            {{ $item->location }}

                                        </p>

                                    </div>

                                </div>


                                <!-- Kuota -->
                                <div class="flex items-center text-sm text-gray-600">

                                    <div class="w-8 h-8 rounded-lg bg-indigo-50
                                                flex items-center justify-center
                                                text-indigo-600">

                                        👥

                                    </div>

                                    <div class="ml-3">

                                        <p class="text-xs text-gray-400">
                                            Kuota Relawan
                                        </p>

                                        <p class="font-medium">

                                            {{ $item->quota }} orang

                                        </p>

                                    </div>

                                </div>

                            </div>


                            <!-- ========================= -->
                            <!-- BUTTON -->
                            <!-- ========================= -->

                            <div class="mt-6 pt-5 border-t border-gray-100
                                        flex items-center gap-3">

                                <!-- LIHAT DETAIL -->

                                <a
                                    href="{{ route('home.event.show', $item) }}"
                                    class="flex-1 inline-flex items-center
                                           justify-center px-4 py-2.5
                                           rounded-lg border border-indigo-600
                                           text-sm font-semibold
                                           text-indigo-600
                                           hover:bg-indigo-50
                                           transition"
                                >

                                    Lihat Detail

                                </a>


                                <!-- DAFTAR -->

                                @if($item->status === 'Buka')

                                    @auth

                                        @if(auth()->user()->hasRole('relawan'))

                                            <form
                                                action="{{ route('volunteer.events.register', $item) }}"
                                                method="POST"
                                                class="flex-1"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="w-full inline-flex items-center
                                                           justify-center px-4 py-2.5
                                                           rounded-lg
                                                           bg-indigo-600
                                                           text-white
                                                           text-sm font-semibold
                                                           hover:bg-indigo-700
                                                           transition"
                                                >

                                                    Daftar

                                                </button>

                                            </form>

                                        @endif

                                    @else

                                        <a
                                            href="{{ route('login') }}"
                                            class="flex-1 inline-flex items-center
                                                   justify-center px-4 py-2.5
                                                   rounded-lg
                                                   bg-indigo-600
                                                   text-white
                                                   text-sm font-semibold
                                                   hover:bg-indigo-700
                                                   transition"
                                        >

                                            Daftar

                                        </a>

                                    @endauth

                                @else

                                    <span
                                        class="flex-1 inline-flex items-center
                                               justify-center px-4 py-2.5
                                               rounded-lg
                                               bg-gray-100
                                               text-gray-400
                                               text-sm font-semibold"
                                    >

                                        Tidak Tersedia

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <!-- EMPTY STATE -->

            <div class="text-center py-16 bg-white rounded-2xl
                        border border-dashed border-gray-300">

                <div class="text-5xl">
                    📅
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-800">

                    Belum Ada Kegiatan

                </h3>

                <p class="mt-2 text-sm text-gray-500">

                    Saat ini belum ada kegiatan volunteer yang tersedia.

                </p>

            </div>

        @endif


        <!-- LIHAT SEMUA -->
        @if($kegiatan->count() > 0)

            <div class="mt-10 text-center">

                <a
                    href="{{ route('volunteer.events.index') }}"
                    class="inline-flex items-center px-6 py-3
                           rounded-lg
                           bg-white
                           border border-indigo-600
                           text-indigo-600
                           font-semibold
                           hover:bg-indigo-50
                           transition"
                >

                    Lihat Semua Kegiatan

                    <span class="ml-2">
                        →
                    </span>

                </a>

            </div>

        @endif

    </div>
</section>

    <!-- Footer Simple -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Yayasan AAT Indonesia. Hak cipta dilindungi undang-undang.
            </p>
        </div>
    </footer>

</body>
</html>