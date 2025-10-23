<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div class="flex flex-col md:flex-row md:items-start md:justify-between mt-6 space-y-6 md:space-y-0 md:space-x-8">
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6 w-full md:w-2/3">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*" />

            <div class="flex items-center gap-4">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                    Save
                </button>

                @if (session('message') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>

        <div class="flex flex-col items-center md:items-end md:w-1/3">
            <img id="profile_preview"
                src="{{ $user->profile_photo_path ? asset('storage/profile_photo/' . $user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF' }}"
                alt="Foto Profil"
                class="w-32 h-32 rounded-full object-cover border-4 border-blue-100 shadow cursor-pointer transition hover:opacity-80"
                onclick="document.getElementById('profile_photo').click();" />

            <p class="mt-3 text-sm text-gray-600">Klik foto untuk mengganti</p>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('profile_photo');
        const previewImg = document.getElementById('profile_preview');

        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</section>
