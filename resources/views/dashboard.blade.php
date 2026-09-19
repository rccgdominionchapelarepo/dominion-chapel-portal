<x-app-layout>
    <x-slot name="header">
        <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
            @hasanyrole('super-admin|admin')
                {{ __('Admin Dashboard') }}
            @else
                {{ __('Member Portal') }}
            @endhasanyrole
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Card (Dynamic based on Role) -->
            <div class="bg-[#091124] border border-[#1A243D] overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="p-8 text-white relative overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#D4AF37] rounded-full mix-blend-multiply filter blur-[80px] opacity-10"></div>
                    
                    <h3 class="font-fraunces text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}</h3>
                    
                    @hasanyrole('super-admin|admin')
                        <p class="text-gray-400">You are viewing the RCCG Dominion Chapel administration portal.</p>
                    @else
                        <p class="text-gray-400">Welcome to your personal Dominion Chapel member portal. Manage your information, RSVPs, and offering and tithe giving here.</p>
                    @endhasanyrole
                </div>
            </div>

            <!-- ADMIN ONLY VIEW -->
            @hasanyrole('super-admin|admin')
                
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-lg">
                        <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Total Members</div>
                        <div class="font-fraunces text-5xl font-light text-white">{{ number_format($totalUsers) }}</div>
                    </div>
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-lg">
                    <!-- Stat Card 2: Thanksgiving RSVPs (Now a clickable link!) -->
                        <a href="{{ route('admin.thanksgiving.index') }}" class="block bg-[#091124] border border-[#1A243D] rounded-xl p-6 hover:border-[#D4AF37]/40 transition duration-300 shadow-lg group">
                            <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3 opacity-90 group-hover:opacity-100 transition">Thanksgiving RSVPs</div>
                            
                            <!-- We can dynamically pull the total from the DB here if you want, or just leave it static for now -->
                            <div class="font-fraunces text-5xl font-light text-white group-hover:text-[#D4AF37] transition">View &rarr;</div>
                        </a>
                    </div>
                    
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-lg">
                        <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Total Sermons</div>
                        <div class="font-fraunces text-5xl font-light text-white">{{ number_format($totalSermons) }}</div>
                    </div>
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-lg">
                        <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Magazines Uploaded</div>
                        <div class="font-fraunces text-5xl font-light text-white">{{ number_format($totalMagazines) }}</div>
                    </div>
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-lg">
                        <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Unread Inquiries</div>
                        <div class="font-fraunces text-5xl font-light text-white">{{ number_format($totalInquiries) }}</div>
                    </div>
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-lg">
                        <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Upcoming Events</div>
                        <div class="font-fraunces text-5xl font-light text-white">{{ number_format($totalEvents) }}</div>
                    </div>
                   
                    
                    
                </div>

                <!-- Quick Actions Section -->
                <div class="mt-8">
                    <h3 class="font-fraunces text-xl text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('admin.events.index') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300">
                            <span class="text-sm font-medium text-gray-300">Add Event</span>
                        </a>
                        <a href="{{ route('admin.magazines.index') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300">
                            <span class="text-sm font-medium text-gray-300">Manage Magazines</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300">
                            <span class="text-sm font-medium text-gray-300">Manage Users</span>
                        </a>
                        <a href="{{ route('admin.inquiries.index') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300">
                            <span class="text-sm font-medium text-gray-300">View Inquiries</span>
                        </a>
                        <a href="{{ route('thanksgiving.create') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300">
                            <span class="text-sm font-medium text-gray-300">My RSVP</span>
                        </a>
                        <a href="{{ route('admin.sermons.index') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300">
                            <span class="text-sm font-medium text-gray-300">Manage Sermons</span>
                        </a>
                        <a href="{{ route('admin.membership.index') }}" class="flex flex-col items-center justify-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:bg-[#111A30] transition duration-300"><span class="text-sm font-medium text-gray-300" >View Database </span></a>
                        
                    
                    </div>
                </div>

            <!-- MEMBER ONLY VIEW -->
            @else
                
                <div class="mt-8">
                    <h3 class="font-fraunces text-xl text-white mb-4">Your Quick Links</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Thanksgiving RSVP Link -->
                        <a href="{{ route('thanksgiving.create') }}" class="flex items-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:border-[#D4AF37]/50 transition duration-300 group">
                            <div class="p-3 bg-[#1A243D] rounded-lg group-hover:bg-[#D4AF37]/20 transition">
                                <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <div class="font-bold text-white text-lg">Thanksgiving Registration</div>
                                <div class="text-sm text-gray-400">Register yourself or your family for the upcoming thanksgiving service.</div>
                            </div>
                        </a>

                        <!-- Give/Tithe Link -->
                        <a href="{{ route('give') }}" class="flex items-center p-6 bg-[#091124] border border-[#1A243D] rounded-xl hover:border-[#D4AF37]/50 transition duration-300 group">
                            <div class="p-3 bg-[#1A243D] rounded-lg group-hover:bg-[#D4AF37]/20 transition">
                                <svg class="w-6 h-6 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <div class="font-bold text-white text-lg">Give Online</div>
                                <div class="text-sm text-gray-400">Pay tithes, offerings, or support church projects.</div>
                            </div>
                        </a>

                    </div>
                </div>

            @endhasanyrole

        </div>
    </div>
</x-app-layout>