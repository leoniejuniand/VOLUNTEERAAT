<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Sekretariat (Cabang)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Tambah Sekretariat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-lg font-bold mb-4">Tambah Sekretariat Baru</h3>
                    <form action="{{ route('secretariats.store') }}" method="POST" class="flex items-center space-x-4">
                        @csrf
                        <div class="flex-grow">
                            <x-text-input id="name" class="block w-full" type="text" name="name" placeholder="Nama Sekretariat (Contoh: Surabaya)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <x-primary-button>
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <!-- Tabel Daftar Sekretariat -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Sekretariat</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total User</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Total Kegiatan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($secretariats as $sekre)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $sekre->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $sekre->users_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $sekre->events_count }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <form action="{{ route('secretariats.destroy', $sekre->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sekretariat ini? Pastikan tidak ada data yang terikat.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>