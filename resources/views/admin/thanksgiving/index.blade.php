<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Thanksgiving RSVPs') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Top Stats & Search Bar -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 bg-[#091124] border border-[#1A243D] p-6 rounded-xl shadow-lg">
                
                <!-- Metrics Container -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 sm:gap-8 w-full xl:w-auto">
                    
                    <!-- Total Families Stat -->
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-[#1A243D] rounded-lg">
                            <svg class="w-8 h-8 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div>
                            <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest">Total Families</div>
                            <div class="font-fraunces text-4xl font-light text-white">{{ $totalFamilies }}</div>
                        </div>
                    </div>

                    <!-- Subtle Divider (Hidden on mobile) -->
                    <div class="hidden sm:block h-12 w-px bg-[#1A243D]"></div>

                    <!-- Total Headcount Stat -->
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-[#1A243D] rounded-lg">
                            <svg class="w-8 h-8 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest">Total Headcount</div>
                            <div class="font-fraunces text-4xl font-light text-white">{{ $totalHeadcount }}</div>
                        </div>
                    </div>
                </div>

                <!-- Search Form & Export Button -->
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                    <form action="{{ route('admin.thanksgiving.index') }}" method="GET" class="flex gap-2 w-full">
                        <div class="relative w-full md:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search names..." 
                                   class="block w-full pl-10 pr-3 py-2 border border-[#1A243D] rounded-lg bg-[#050A15] text-gray-300 placeholder-gray-500 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 text-sm">
                        </div>
                        <button type="submit" class="bg-[#D4AF37] hover:bg-white text-[#050A15] px-4 py-2 rounded-lg text-sm font-bold transition duration-300">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.thanksgiving.index') }}" class="flex items-center justify-center bg-[#1A243D] hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-bold transition duration-300">Clear</a>
                        @endif
                    </form>

                    <!-- NEW EXPORT BUTTON -->
                    <a href="{{ route('admin.thanksgiving.export') }}" class="flex items-center justify-center gap-2 bg-green-900/40 hover:bg-green-600 border border-green-900/50 text-green-400 hover:text-white px-4 py-2 rounded-lg text-sm font-bold transition duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Export Excel
                    </a>
                </div>
            </div>

            <!-- Registrations Table -->
            <div class="bg-[#091124] border border-[#1A243D] overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#050A15] border-b border-[#1A243D]">
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Submitted By</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Quarter</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Type</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Family Members</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1A243D]">
                            @forelse ($registrations as $reg)
                                <tr class="hover:bg-[#111A30] transition duration-200">
                                    
                                    <!-- Name & Contact -->
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-white text-lg">{{ $reg->display_name }}</div>
                                        <div class="text-xs text-gray-400 mt-1">Acct: {{ $reg->user->name ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-500">{{ $reg->user->whatsapp_number ?? '' }}</div>
                                    </td>
                                    
                                    <!-- Quarter -->
                                    <td class="px-6 py-4">
                                        <span class="text-gray-300 text-sm font-bold">{{ $reg->quarter }}</span>
                                    </td>
                                    
                                    <!-- Type -->
                                    <td class="px-6 py-4">
                                        @if($reg->type === 'individual')
                                            <span class="px-3 py-1 bg-blue-900/30 text-blue-400 text-xs rounded-full uppercase font-bold tracking-wider border border-blue-900/50">
                                                Individual
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-green-900/30 text-green-400 text-xs rounded-full uppercase font-bold tracking-wider border border-green-900/50">
                                                Family
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- Attendees (Unpacking the JSON) -->
                                    <td class="px-6 py-4">
                                        @if($reg->type === 'individual')
                                            <span class="text-sm text-gray-400">1 Person</span>
                                        @elseif($reg->type === 'family' && is_array($reg->family_members))
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($reg->family_members as $member)
                                                    <span class="px-2 py-1 bg-[#1A243D] text-gray-300 text-xs rounded-md">
                                                        {{ $member }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <div class="text-xs text-[#D4AF37] font-bold mt-2 font-mono-brand">Total: {{ count($reg->family_members) }}</div>
                                        @else
                                            <span class="text-sm text-gray-500">No members listed</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        No thanksgiving registrations found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-[#1A243D]">
                    {{ $registrations->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>