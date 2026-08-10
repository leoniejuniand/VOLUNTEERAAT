<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Selamat Datang & Info Akun -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 border-l-4 border-indigo-500">
                    <h3 class="text-2xl font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-600">
                        Anda masuk sebagai <span class="font-bold uppercase text-indigo-600">{{ Auth::user()->getRoleNames()->first() ?? 'Relawan' }}</span> 
                        di Sekretariat: <span class="font-bold">{{ Auth::user()->secretariat ? Auth::user()->secretariat->name : 'Pusat' }}</span>
                    </p>
                </div>
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @hasanyrole('super_admin|admin_sekre')
                    <!-- Kartu Untuk Admin -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Relawan</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_relawan'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Kegiatan</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_kegiatan'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Pendaftaran</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_pendaftar'] }}</p>
                        </div>
                    </div>
                @else
                    <!-- Kartu Untuk Relawan -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Kegiatan Tersedia</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['kegiatan_tersedia'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Kegiatan Diikuti</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_diikuti'] }}</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Diterima</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_diterima'] }}</p>
                        </div>
                    </div>
                @endhasanyrole
            </div>

        </div>
    </div>
</x-app-layout>