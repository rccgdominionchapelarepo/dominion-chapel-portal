<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ $family->family_name }} Family Details
            </h2>
            <a href="{{ route('admin.membership.index') }}" class="text-yellow-500 hover:text-yellow-400 font-bold text-sm transition flex items-center gap-2">
                &larr; Back to Database
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- 1. Family Contact Information -->
            <div class="bg-slate-900 border-2 border-yellow-500 rounded-xl p-8 shadow-[0_0_15px_rgba(234,179,8,0.1)] relative overflow-hidden">
                <!-- Decorative Top Accent -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-600 via-yellow-400 to-yellow-600"></div>

                <h3 class="text-yellow-500 text-sm font-bold uppercase tracking-widest border-b-2 border-slate-700/70 pb-4 mb-6">Primary Contact Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                    <div>
                        <span class="block text-slate-400 text-xs uppercase font-bold tracking-wider mb-2">Email Address</span> 
                        <span class="text-white text-lg font-medium">{{ $family->email }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-xs uppercase font-bold tracking-wider mb-2">Phone Number</span> 
                        <span class="text-white text-lg font-medium">{{ $family->phone_number ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-xs uppercase font-bold tracking-wider mb-2">Home Address</span> 
                        <span class="text-white text-lg font-medium">{{ $family->home_address ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-slate-400 text-xs uppercase font-bold tracking-wider mb-2">Emergency Contact</span> 
                        <span class="text-white text-lg font-medium">
                            {{ $family->emergency_contact_name ?: 'N/A' }} 
                            @if($family->emergency_contact_phone)
                                <span class="text-yellow-500/80 text-base ml-1">({{ $family->emergency_contact_phone }})</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- 2. Individual Family Members -->
            <div class="flex items-center justify-between mt-12 mb-2 px-1">
                <h3 class="text-white text-2xl font-bold">Household Members</h3>
                <span class="bg-slate-900 border-2 border-yellow-500 text-yellow-500 text-xs font-bold uppercase tracking-widest px-5 py-2 rounded-full shadow-[0_0_10px_rgba(234,179,8,0.15)]">
                    Total: {{ $family->members->count() }}
                </span>
            </div>
            
            @foreach($family->members as $index => $member)
                <div class="bg-slate-900 border-2 border-yellow-500/50 hover:border-yellow-500 rounded-xl p-8 mb-6 shadow-lg hover:shadow-[0_0_15px_rgba(234,179,8,0.15)] transition duration-300">
                    <h4 class="text-2xl font-bold text-white mb-6 border-b-2 border-slate-700/70 pb-4 flex items-center gap-3">
                        {{ $member->full_name }} 
                        @if($member->preferred_name)
                            <span class="text-lg text-yellow-500 font-medium tracking-wide">("{{ $member->preferred_name }}")</span>
                        @endif
                    </h4>
                    <div>
                        <span class="text-sm font-medium text-gray-500 block mb-1">Personal Email</span> 
                        <span class="text-gray-900">{{ $member->email ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-500 block mb-1">Personal Phone</span> 
                        <span class="text-gray-900">{{ $member->phone_number ?: 'N/A' }}</span>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-8 gap-x-6">
                        <div>
                            <span class="text-slate-400 text-xs uppercase font-bold tracking-widest block mb-2">Date of Birth</span> 
                            <span class="text-gray-100 text-base font-medium">{{ $member->dob ? $member->dob->format('M d, Y') : 'Not Provided' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-xs uppercase font-bold tracking-widest block mb-2">Gender</span> 
                            <span class="text-gray-100 text-base font-medium">{{ $member->gender ?: 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-xs uppercase font-bold tracking-widest block mb-2">Marital Status</span> 
                            <span class="text-gray-100 text-base font-medium">{{ $member->marital_status ?: 'N/A' }}</span>
                        </div>
                        
                        <div>
                            <span class="text-slate-400 text-xs uppercase font-bold tracking-widest block mb-2">Church Group</span> 
                            <span class="bg-yellow-500/10 border border-yellow-500/50 text-yellow-500 text-sm font-bold px-4 py-1.5 rounded-full inline-block">{{ $member->church_group }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-xs uppercase font-bold tracking-widest block mb-2">Membership Status</span> 
                            <span class="text-gray-100 text-base font-medium">{{ $member->membership_status ?: 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 text-xs uppercase font-bold tracking-widest block mb-2">Water Baptism</span> 
                            <span class="text-gray-100 text-base font-medium">{{ $member->water_baptism ?: 'N/A' }}</span>
                        </div>
                        
                        <div class="col-span-1 sm:col-span-2 md:col-span-3 border-t border-gray-100 pt-5 mt-2">
                            <span class="text-sm font-bold text-gray-700 block mb-3">Areas to Serve</span>
                            @if($member->areas_to_serve)
                                <!-- Adding str_replace to cleanly format any old test arrays still in the database -->
                                <span class="bg-gray-100 border border-gray-300 text-gray-700 text-sm px-4 py-2 rounded-md inline-block">
                                    {{ trim(str_replace(['[', ']', '"'], '', $member->areas_to_serve)) }}
                                </span>
                            @else
                                <span class="text-gray-400 italic text-sm">No service areas specified</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>