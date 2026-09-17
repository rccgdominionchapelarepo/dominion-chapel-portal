<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('My Profile') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Update Profile Information -->
            <div class="p-4 sm:p-8 bg-[#091124] border border-[#1A243D] shadow-2xl sm:rounded-xl relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#D4AF37] rounded-full mix-blend-multiply filter blur-[80px] opacity-10 pointer-events-none"></div>
                <div class="max-w-xl relative z-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-[#091124] border border-[#1A243D] shadow-2xl sm:rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-[#091124] border border-[#1A243D] shadow-2xl sm:rounded-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>