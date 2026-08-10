<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Peserta: ') }} {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-between items-center">
                <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">&larr; Kembali ke Daftar Kegiatan</a>
                
                <!-- TOMBOL DOWNLOAD EXPORT -->
                <a href="{{ route('events.participants.export', $event->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Download Rekap Data
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Relawan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Daftar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Saat Ini</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Ubah Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($registrations as $reg)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reg->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reg->user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $reg->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-700">
                                        {{ $reg->status }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('events.registrations.update', $reg->id) }}" method="POST" class="flex items-center justify-end space-x-2">
                                        @csrf
                                        @method('PUT')

                                        <!-- Pilihan Status Terima/Tolak -->
                                        <select name="status" class="text-sm border-gray-300 rounded-md py-1">
                                            <option value="Menunggu Konfirmasi" {{ $reg->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="Diterima" {{ $reg->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                            <option value="Ditolak" {{ $reg->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>

                                        <!-- Pilihan Kehadiran (Hanya relevan jika Diterima) -->
                                        <select name="is_present" class="text-sm border-gray-300 rounded-md py-1 {{ $reg->status != 'Diterima' ? 'opacity-50' : '' }}">
                                            <option value="0" {{ !$reg->is_present ? 'selected' : '' }}>Tidak Hadir</option>
                                            <option value="1" {{ $reg->is_present ? 'selected' : '' }}>Hadir (Absen)</option>
                                        </select>

                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs font-semibold">Simpan</button>
                                    </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada relawan yang mendaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>