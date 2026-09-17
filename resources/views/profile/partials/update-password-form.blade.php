<section>
    <header>
        <h2 class="font-fraunces text-xl text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label for="update_password_password" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">New Password</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400 text-xs" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-[#1A243D] hover:bg-white text-gray-300 hover:text-[#050A15] px-6 py-2 rounded-lg text-sm font-bold transition duration-300 shadow-md">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#D4AF37] font-bold">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>