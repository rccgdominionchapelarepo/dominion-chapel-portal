<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Thanksgiving Registration') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#D4AF37] rounded-full mix-blend-multiply filter blur-[80px] opacity-10"></div>
                
                <div class="text-center mb-8 relative z-10">
                    <h3 class="font-fraunces text-2xl font-bold text-white mb-2">Quarter: {{ $quarter }}</h3>
                    <p class="text-gray-400 text-sm">Register your attendance for the upcoming thanksgiving service.</p>
                </div>

                <!-- Alpine.js Initialization -->
                <!-- We start with 'individual' type, and an array with one empty string for the first family member -->
                <form action="{{ route('thanksgiving.store') }}" method="POST" 
                      x-data="{ 
                          type: 'individual', 
                          members: [''] 
                      }" 
                      class="space-y-6 relative z-10">
                    @csrf
                    
                    <input type="hidden" name="quarter" value="{{ $quarter }}">

                    <!-- Type Selection -->
                    <div>
                        <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Registration Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="individual" x-model="type" class="peer sr-only">
                                <div class="text-center py-3 border border-[#1A243D] rounded-lg bg-[#050A15] text-gray-400 peer-checked:border-[#D4AF37] peer-checked:text-[#D4AF37] peer-checked:bg-[#D4AF37]/10 transition-all font-bold">
                                    Individual
                                </div>
                            </label>
                            
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="family" x-model="type" class="peer sr-only">
                                <div class="text-center py-3 border border-[#1A243D] rounded-lg bg-[#050A15] text-gray-400 peer-checked:border-[#D4AF37] peer-checked:text-[#D4AF37] peer-checked:bg-[#D4AF37]/10 transition-all font-bold">
                                    Family
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Display Name -->
                    <div>
                        <label for="display_name" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">
                            <span x-text="type === 'family' ? 'Family Name' : 'Full Name'"></span>
                        </label>
                        <input type="text" id="display_name" name="display_name" required :placeholder="type === 'family' ? 'e.g. The Adebayo Family' : 'e.g. John Doe'"
                               class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300">
                    </div>

                    <!-- Dynamic Family Members List (Only shows if type == 'family') -->
                    <div x-show="type === 'family'" x-transition class="pt-4 border-t border-[#1A243D] space-y-4">
                        <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Family Members Attending</label>
                        
                        <!-- Loop through the members array -->
                        <template x-for="(member, index) in members" :key="index">
                            <div class="flex items-center gap-3">
                                <input type="text" :name="'family_members[' + index + ']'" x-model="members[index]" placeholder="Full Name"
                                       class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300">
                                
                                <!-- Show remove button if there is more than 1 member -->
                                <button type="button" x-show="members.length > 1" @click="members.splice(index, 1)" class="p-2 text-red-400 hover:text-red-300 hover:bg-red-900/30 rounded-lg transition duration-200" title="Remove Member">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </template>

                        <!-- Add Member Button -->
                        <button type="button" @click="members.push('')" class="flex items-center gap-2 text-sm font-bold text-[#D4AF37] hover:text-white transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add Another Member
                        </button>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-3 rounded-lg hover:bg-white transition-all duration-300 shadow-md">
                            Submit Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>