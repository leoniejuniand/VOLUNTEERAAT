<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo Yayasan AAT -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 transition hover:opacity-80">
                        <!-- Memanggil gambar logo.png dari folder public -->
                        <img class="block h-10 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo VolunteerAAT">
                        
                        <!-- Teks VolunteerAAT (opsional, agar senada dengan halaman depan) -->
                        <span class="font-bold text-xl text-indigo-600 tracking-wider hidden sm:block">
                            Volunteer<span class="text-gray-800 dark:text-gray-200">AAT</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                @role('relawan')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('volunteer.events.index')" :active="request()->routeIs('volunteer.events.*')">
                        {{ __('Daftar Kegiatan') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('volunteer.events.history')" :active="request()->routeIs('volunteer.events.history')">
                        {{ __('Riwayat Kegiatan') }}
                    </x-nav-link>
                </div>
                @endrole

                @hasanyrole('super_admin|admin_sekre')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                        {{ __('Data Relawan') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
                        {{ __('Data Kegiatan') }}
                    </x-nav-link>
                </div>
                @endhasanyrole
                @role('super_admin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('secretariats.index')" :active="request()->routeIs('secretariats.*')">
                        {{ __('Data Sekretariat') }}
                    </x-nav-link>
                </div>
                @endrole
            </div>

            <!-- Settings Dropdown & Notifikasi -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                <!-- 👇 KODE LONCENG NOTIFIKASI 👇 -->
                <div class="relative mr-3">
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="relative inline-flex items-center p-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition ease-in-out duration-150">
                                <!-- Ikon SVG Lonceng -->
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                
                                <!-- Lingkaran Merah untuk Angka Notifikasi Baru -->
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-72 max-h-80 overflow-y-auto">
                                <div class="px-4 py-2 border-b bg-gray-50 font-semibold text-gray-700 text-sm">
                                    Notifikasi Anda
                                </div>
                                
                                <!-- Looping isi Notifikasi -->
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ $notification->data['url'] }}" class="block px-4 py-3 border-b text-sm text-gray-700 hover:bg-indigo-50 transition">
                                        <span class="font-bold text-indigo-600">{{ $notification->data['title'] }}</span><br>
                                        <span class="text-xs text-gray-600">{{ $notification->data['message'] }}</span><br>
                                        <span class="text-[10px] text-gray-400 mt-1 block">{{ $notification->created_at->diffForHumans() }}</span>
                                    </a>
                                @empty
                                    <div class="block px-4 py-4 text-sm text-gray-500 text-center italic">
                                        Belum ada notifikasi baru.
                                    </div>
                                @endforelse
                                
                                <!-- Tombol Tandai Semua Dibaca -->
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <form method="POST" action="{{ route('notifications.markAllRead') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-center px-4 py-2 text-xs font-bold text-indigo-600 hover:text-indigo-800 hover:bg-gray-50 transition">
                                            Tandai Semua Dibaca
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                <!-- 👆 SELESAI KODE LONCENG 👆 -->

                <!-- KODE DROPDOWN PROFIL ASLI ANDA -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
