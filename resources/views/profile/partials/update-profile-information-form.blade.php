<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Nomor WhatsApp -->
     <div>
         <x-input-label for="whatsapp_number" :value="__('Nomor WhatsApp')" />
         <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full" :value="old('whatsapp_number', $user->whatsapp_number)" placeholder="Contoh: 081234567890" />
         <x-input-error class="mt-2" :messages="$errors->get('whatsapp_number')" />
     </div>

     <!-- Instansi / Asal Kampus -->
     <div>
         <x-input-label for="institution" :value="__('Instansi / Asal Kampus')" />
         <x-text-input id="institution" name="institution" type="text" class="mt-1 block w-full" :value="old('institution', $user->institution)" placeholder="Contoh: Universitas Jenderal Soedirman" />
         <x-input-error class="mt-2" :messages="$errors->get('institution')" />
     </div>

     <!-- Alamat -->
     <div>
         <x-input-label for="address" :value="__('Alamat Domisili')" />
         <textarea id="address" name="address" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('address', $user->address) }}</textarea>
         <x-input-error class="mt-2" :messages="$errors->get('address')" />
     </div>

     <!-- Foto Profil -->
     <div>
         <x-input-label for="profile_picture" :value="__('Foto Profil (Opsional)')" />

         @if($user->profile_picture)
             <div class="mt-2 mb-3">
                 <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="h-20 w-20 object-cover rounded-full border shadow-sm">
             </div>
         @endif

         <input id="profile_picture" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none" type="file" name="profile_picture" accept="image/png, image/jpeg, image/jpg" />
         <p class="mt-1 text-xs text-gray-500">Format: JPG/PNG. Maksimal 2MB.</p>
         <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
     </div>
     
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
