<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pendaftaran Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Kegiatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal & Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu Daftar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($registrations as $reg)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $reg->event->title }}
                                        <div class="text-xs text-gray-500 mt-1">Sekretariat: {{ $reg->event->secretariat->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($reg->event->event_date)->format('d M Y') }} <br>
                                        <span class="text-xs text-gray-500">{{ $reg->event->location }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $reg->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($reg->status == 'Diterima')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Diterima
                                            </span>
                                        @elseif($reg->status == 'Ditolak')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu Konfirmasi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Anda belum mendaftar ke kegiatan apa pun.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>