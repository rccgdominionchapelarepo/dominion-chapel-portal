<section>
    <header>
        <h2 class="font-fraunces text-xl text-white">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error class="mt-2 text-red-400 text-xs" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error class="mt-2 text-red-400 text-xs" :messages="$errors->get('email')" />
        </div>

        <!-- WhatsApp Number -->
        <div>
            <label for="whatsapp_number" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">WhatsApp Number</label>
            <input id="whatsapp_number" name="whatsapp_number" type="text" value="{{ old('whatsapp_number', $user->whatsapp_number) }}" required 
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error class="mt-2 text-red-400 text-xs" :messages="$errors->get('whatsapp_number')" />
        </div>

        <!-- Date of Birth -->
        <div>
            <label for="date_of_birth" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Date of Birth</label>
            <!-- Note: We use color-scheme: dark so the calendar picker matches the theme -->
            <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth', $user->date_of_birth) }}" required style="color-scheme: dark;"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300" />
            <x-input-error class="mt-2 text-red-400 text-xs" :messages="$errors->get('date_of_birth')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-[#D4AF37] hover:bg-white text-[#050A15] px-6 py-2 rounded-lg text-sm font-bold transition duration-300 shadow-md">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-[#D4AF37] font-bold">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>