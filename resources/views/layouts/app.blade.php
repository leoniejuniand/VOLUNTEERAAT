<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- CSS untuk DataTables -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

 <style>
            /* Mengatur kontainer agar sejajar penuh */
            .datatable-top, .dataTable-top, 
            .datatable-bottom, .dataTable-bottom {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                padding: 1rem 0 !important;
                width: 100% !important; /* 👇 Mencegah container menyusut */
            }
            
            /* Memperbaiki posisi teks */
            .datatable-dropdown label, .dataTable-dropdown label {
                display: flex !important;
                align-items: center !important;
                gap: 0.75rem !important;
                margin-bottom: 0 !important;
            }
            
            /* Kotak Angka (Sudah Sempurna) */
            select.datatable-selector, select.dataTable-selector {
                width: 80px !important; 
                min-width: 80px !important;
                padding-left: 12px !important;
                padding-right: 35px !important; 
                background-position: right 8px center !important;
                border: 1px solid #d1d5db !important;
                border-radius: 6px !important;
                background-color: white !important;
            }

            /* Kotak Pencarian */
            .datatable-search, .dataTable-search {
                margin-bottom: 0 !important;
                margin-left: auto !important; /* 👇 MENDORONG PAKSA KE POJOK KANAN MENTOK 👇 */
            }
            
            .datatable-search input, .dataTable-search input {
                padding: 0.4rem 1rem !important;
                border-radius: 0.375rem !important;
                border-color: #d1d5db !important;
                width: 250px !important; 
            }
            
            /* Agar bisa digeser di HP */
            .datatable-wrapper .datatable-container, 
            .dataTable-wrapper .dataTable-container {
                overflow-x: auto;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const FlashPill = Swal.mixin({
                toast: true,
                position: 'top', // Melayang di atas tengah
                showConfirmButton: false,
                timer: 3500,
                background: '#4f46e5', // Warna Indigo bawaan aplikasi
                color: '#ffffff', // Teks putih
                iconColor: '#ffffff', // Ikon putih
                customClass: {
                    // Memaksa sudutnya sangat melengkung (kapsul) dan memberi bayangan
                    popup: 'rounded-full mt-4 shadow-xl px-4 py-2' 
                }
            });

            @if(session('success'))
                FlashPill.fire({ icon: 'success', title: "{{ session('success') }}" });
            @endif

            @if(session('error'))
                FlashPill.fire({ 
                    icon: 'error', 
                    background: '#ef4444', // Berubah merah jika error
                    title: "{{ session('error') }}" 
                });
            @endif
            
            @if(session('status') === 'profile-updated')
                FlashPill.fire({ icon: 'success', title: 'Profil Diperbarui!' });
            @endif
        </script>

        <!-- Script untuk DataTables -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    </body>
</html>
