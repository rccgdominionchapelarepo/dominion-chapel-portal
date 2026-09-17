<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5 relative z-10">
        @csrf

        <div class="text-center mb-8">
            <h2 class="font-fraunces text-3xl font-bold text-white">Welcome Back</h2>
            <p class="text-sm text-gray-400 mt-1">Sign in to access the portal.</p>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 font-mono-brand text-xs" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 shadow-inner">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 font-mono-brand text-xs" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-[#1A243D] bg-[#050A15] text-[#D4AF37] shadow-sm focus:ring-[#D4AF37]/50">
                <span class="ms-2 text-sm text-gray-400 group-hover:text-white transition">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-[#D4AF37] hover:text-white transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-8">
            <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-3 rounded-lg hover:bg-white hover:shadow-[0_0_20px_rgba(212,175,55,0.3)] transition-all duration-300">
                Log In
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-400">Don't have an account? 
                <a href="{{ route('register') }}" class="text-[#D4AF37] font-bold hover:underline transition">Sign up</a>
            </p>
        </div>
    </form>
</x-guest-layout>