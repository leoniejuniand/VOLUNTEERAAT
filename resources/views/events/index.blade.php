<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kegiatan Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses/Gagal -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($events as $event)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <!-- Menampilkan Gambar -->
                        @if($event->cover_image)
                            <img src="{{ asset('storage/' . $event->cover_image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 italic">
                                (Tidak ada poster kegiatan)
                            </div>
                        @endif
                        <div class="p-6 flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($event->description, 100) }}</p>
                            <div class="text-sm text-gray-700 space-y-1 mb-4">
                                <p>📅 <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                                <p>📍 <strong>Lokasi:</strong> {{ $event->location }}</p>
                                <p>🏢 <strong>Sekretariat:</strong> {{ $event->secretariat->name }}</p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 mt-auto border-t border-gray-100 pt-4">

                            <!-- Informasi Kuota dan Waktu -->
                            <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                <div>
                                    <span class="font-bold">Kuota:</span> 
                                    {{ $event->registrations_count }} / {{ $event->quota ?? 'Tidak Terbatas' }} Terisi
                                </div>
                                @if($event->registration_deadline)
                                    <div class="{{ now()->greaterThan($event->registration_deadline) ? 'text-red-500 font-bold' : '' }}">
                                        <span class="font-bold">Batas:</span> {{ \Carbon\Carbon::parse($event->registration_deadline)->format('d M Y, H:i') }}
                                    </div>
                                @endif
                            </div>

                            @php
                                $isDeadlinePassed = $event->registration_deadline && now()->greaterThan($event->registration_deadline);
                                $isQuotaFull = $event->quota && $event->registrations_count >= $event->quota;
                            @endphp

                            @if(in_array($event->id, $registeredEventIds))
                                <button disabled class="w-full px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed font-semibold text-xs uppercase text-center">
                                    Sudah Terdaftar
                                </button>
                            @elseif($isDeadlinePassed)
                                <button disabled class="w-full px-4 py-2 bg-red-400 text-white rounded-md cursor-not-allowed font-semibold text-xs uppercase text-center">
                                    Waktu Habis
                                </button>
                            @elseif($isQuotaFull)
                                <button disabled class="w-full px-4 py-2 bg-orange-400 text-white rounded-md cursor-not-allowed font-semibold text-xs uppercase text-center">
                                    Kuota Penuh
                                </button>
                            @else
                                <form action="{{ route('volunteer.events.register', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mendaftar pada kegiatan ini?');">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-700 text-center transition">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-3 bg-white p-6 rounded-lg shadow-sm text-center text-gray-500">
                        Saat ini belum ada kegiatan yang dibuka untuk sekretariat Anda.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>