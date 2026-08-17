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