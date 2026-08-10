<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kegiatan: ') }} {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Nama Kegiatan')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $event->title }}" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="event_date" :value="__('Tanggal Pelaksanaan')" />
                            <x-text-input id="event_date" class="block mt-1 w-full" type="date" name="event_date" value="{{ $event->event_date }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Lokasi')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ $event->location }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Deskripsi Kegiatan')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ $event->description }}</textarea>
                        </div>

                        <!-- Poster Kegiatan -->
                        <div class="mb-4">
                            <x-input-label for="cover_image" :value="__('Poster / Gambar Kegiatan')" />

                            @if($event->cover_image)
                                <div class="mt-2 mb-3">
                                    <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $event->cover_image) }}" alt="Poster" class="h-32 w-auto object-cover rounded-md border shadow-sm">
                                </div>
                            @endif

                            <input id="cover_image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" type="file" name="cover_image" accept="image/png, image/jpeg, image/jpg" />
                            <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika Anda tidak ingin mengubah gambar.</p>
                            <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                        </div>

                        <div class="mb-4 grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="registration_deadline" :value="__('Batas Waktu Pendaftaran')" />
                                <x-text-input id="registration_deadline" class="block mt-1 w-full" type="datetime-local" name="registration_deadline" value="{{ $event->registration_deadline ? \Carbon\Carbon::parse($event->registration_deadline)->format('Y-m-d\TH:i') : '' }}" />
                            </div>
                            <div>
                                <x-input-label for="quota" :value="__('Kuota Peserta')" />
                                <x-text-input id="quota" class="block mt-1 w-full" type="number" min="1" name="quota" value="{{ $event->quota }}" placeholder="Kosong = Tak terbatas" />
                            </div>
                        </div>

                        <!-- Status Kegiatan -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status Kegiatan')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="Buka" {{ $event->status == 'Buka' ? 'selected' : '' }}>Buka (Bisa Didaftar)</option>
                                <option value="Tutup" {{ $event->status == 'Tutup' ? 'selected' : '' }}>Tutup (Pendaftaran Penuh/Ditutup)</option>
                                <option value="Selesai" {{ $event->status == 'Selesai' ? 'selected' : '' }}>Selesai (Kegiatan Telah Berakhir)</option>
                            </select>
                        </div>

                        <!-- Pilihan Sekre HANYA muncul untuk Super Admin -->
                        @role('super_admin')
                        <div class="mb-4">
                            <x-input-label for="secretariat_id" :value="__('Untuk Sekretariat')" />
                            <select name="secretariat_id" id="secretariat_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($secretariats as $sekre)
                                    <option value="{{ $sekre->id }}" {{ $event->secretariat_id == $sekre->id ? 'selected' : '' }}>
                                        {{ $sekre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endrole

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>