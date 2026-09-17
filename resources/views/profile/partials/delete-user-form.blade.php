<section class="space-y-6">
    <header>
        <h2 class="font-fraunces text-xl text-red-400">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-900/40 hover:bg-red-600 border border-red-900/50 text-red-400 hover:text-white px-6 py-2 rounded-lg text-sm font-bold transition duration-300">
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-[#091124] border border-[#1A243D] rounded-xl">
            @csrf
            @method('delete')

            <h2 class="font-fraunces text-xl text-white">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" placeholder="{{ __('Password') }}"
                       class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-red-500 focus:ring focus:ring-red-500/20 transition-all duration-300" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400 text-xs" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-[#1A243D] hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition duration-300">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-bold transition duration-300">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>