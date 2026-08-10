<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Relawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sekretariat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $u)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $u->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $u->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-indigo-600">
                                        {{ $u->getRoleNames()->first() ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $u->secretariat ? $u->secretariat->name : 'Pusat' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('users.edit', $u->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>