<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-4 relative z-10">
        @csrf

        <div class="text-center mb-6">
            <h2 class="font-fraunces text-3xl font-bold text-white">Create Account</h2>
            <p class="text-sm text-gray-400 mt-1">Join the Dominion Chapel portal.</p>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Full Name</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 font-mono-brand text-xs" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 font-mono-brand text-xs" />
        </div>

        <!-- Custom Fields Grid (WhatsApp & DOB) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="whatsapp_number" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">WhatsApp No.</label>
                <input id="whatsapp_number" type="text" name="whatsapp_number" :value="old('whatsapp_number')" required placeholder="e.g. 08012345678"
                       class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
                <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2 text-red-400 font-mono-brand text-xs" />
            </div>

            <div>
                <label for="date_of_birth" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Date of Birth (Optional)</label>
                <input id="date_of_birth" type="date" name="date_of_birth" :value="old('date_of_birth')" style="color-scheme: dark;"
                       class="block w-full bg-[#050A15] border border-[#1A243D] text-gray-300 rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2 text-red-400 font-mono-brand text-xs" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 font-mono-brand text-xs" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 font-mono-brand text-xs" />
        </div>

        <!-- Submit Button -->
        <div class="mt-6 pt-2">
            <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-3 rounded-lg hover:bg-white hover:shadow-[0_0_20px_rgba(212,175,55,0.3)] transition-all duration-300">
                Register
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-400">Already registered? 
                <a href="{{ route('login') }}" class="text-[#D4AF37] font-bold hover:underline transition">Log in</a>
            </p>
        </div>
    </form>
</x-guest-layout>