<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kegiatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Nama Kegiatan')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="event_date" :value="__('Tanggal Pelaksanaan')" />
                            <x-text-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi Kegiatan')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required></textarea>
                        </div>

                        <!-- Poster Kegiatan -->
                        <div class="mb-4">
                            <x-input-label for="cover_image" :value="__('Poster / Gambar Kegiatan (Opsional)')" />
                            <input id="cover_image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" type="file" name="cover_image" accept="image/png, image/jpeg, image/jpg" />
                            <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB.</p>
                            <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                        </div>

                        <div class="mb-4 grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="registration_deadline" :value="__('Batas Waktu Pendaftaran (Opsional)')" />
                                <x-text-input id="registration_deadline" class="block mt-1 w-full" type="datetime-local" name="registration_deadline" />
                            </div>
                            <div>
                                <x-input-label for="quota" :value="__('Kuota Peserta (Opsional)')" />
                                <x-text-input id="quota" class="block mt-1 w-full" type="number" min="1" name="quota" placeholder="Kosongkan jika tak terbatas" />
                            </div>
                        </div>

                        <!-- Dropdown Status Kegiatan -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status Kegiatan')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="Buka" selected>Buka</option>
                                <option value="Tutup">Tutup</option>
                                <option value="Selesai">Selesai (Kegiatan Berakhir)</option>
                            </select>
                        </div>

                        <!-- Pilihan Sekre HANYA muncul untuk Super Admin -->
                        @role('super_admin')
                        <div class="mb-4">
                            <x-input-label for="secretariat_id" :value="__('Untuk Sekretariat')" />
                            <select name="secretariat_id" id="secretariat_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="" disabled selected>-- Pilih Sekretariat --</option>
                                @foreach($secretariats as $sekre)
                                    <option value="{{ $sekre->id }}">{{ $sekre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endrole

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Kegiatan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>