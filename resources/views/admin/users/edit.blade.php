<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Relawan: ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Pilihan Role -->
                        <div class="mb-4">
                            <x-input-label for="role" :value="__('Hak Akses (Role)')" />
                            <select name="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ strtoupper($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilihan Sekretariat -->
                        <div class="mb-4">
                            <x-input-label for="secretariat_id" :value="__('Sekretariat')" />
                            <select name="secretariat_id" id="secretariat_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pusat / Tanpa Sekretariat --</option>
                                @foreach($secretariats as $sekre)
                                    <option value="{{ $sekre->id }}" {{ $user->secretariat_id == $sekre->id ? 'selected' : '' }}>
                                        {{ $sekre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

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