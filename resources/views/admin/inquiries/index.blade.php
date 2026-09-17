<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Inbox & Inquiries') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-lg shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Filter Section -->
            <div class="bg-[#091124] border border-[#1A243D] p-6 rounded-xl shadow-lg mb-6">
                <form action="{{ route('admin.inquiries.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    
                    <!-- Subject/Type Filter -->
                    <div class="w-full md:w-auto flex-1">
                        <label for="subject" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Inquiry Type</label>
                        <select name="subject" id="subject" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 text-sm">
                            <option value="">All Types</option>
                            <option value="Testimony / Thanksgiving" {{ request('subject') == 'Testimony / Thanksgiving' ? 'selected' : '' }}>Testimony / Thanksgiving</option>
                            <option value="Prayer Request" {{ request('subject') == 'Prayer Request' ? 'selected' : '' }}>Prayer Request</option>
                            <option value="Counseling" {{ request('subject') == 'Counseling' ? 'selected' : '' }}>Counseling</option>
                            <option value="General Inquiry" {{ request('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                        </select>
                    </div>

                    <!-- Read Status Filter -->
                    <div class="w-full md:w-auto flex-1">
                        <label for="status" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Read Status</label>
                        <select name="status" id="status" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-2.5 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 text-sm">
                            <option value="">All Messages</option>
                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread Only</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read Only</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none bg-[#D4AF37] hover:bg-white text-[#050A15] px-6 py-2.5 rounded-lg text-sm font-bold transition duration-300">
                            Apply Filters
                        </button>
                        @if(request('subject') || request('status'))
                            <a href="{{ route('admin.inquiries.index') }}" class="flex-1 md:flex-none text-center flex items-center justify-center bg-[#1A243D] hover:bg-gray-600 text-white px-4 py-2.5 rounded-lg text-sm font-bold transition duration-300">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 gap-6">
                @forelse($inquiries as $inquiry)
                    <div class="bg-[#091124] border {{ $inquiry->is_read ? 'border-[#1A243D]' : 'border-[#D4AF37]/50' }} rounded-xl p-6 shadow-lg relative transition-all">
                        
                        @if(!$inquiry->is_read)
                            <span class="absolute -top-3 -right-3 flex h-6 w-6">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#D4AF37] opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-6 w-6 bg-[#D4AF37] text-[#050A15] text-xs font-bold items-center justify-center border-2 border-[#091124]">!</span>
                            </span>
                        @endif

                        <div class="flex flex-col md:flex-row justify-between gap-4 mb-4 border-b border-[#1A243D] pb-4">
                            <div>
                                <h3 class="font-bold text-white text-lg">{{ $inquiry->name }}</h3>
                                <div class="flex gap-4 text-xs text-gray-400 mt-1 font-mono-brand uppercase tracking-wider">
                                    @if($inquiry->email === 'hidden@anonymous.local')
                                        <span class="text-gray-500 italic">Identity Hidden</span>
                                    @else
                                        <span><a href="mailto:{{ $inquiry->email }}" class="text-[#D4AF37] hover:underline">{{ $inquiry->email }}</a></span>
                                        @if($inquiry->phone)
                                            <span>&bull;</span>
                                            <span>{{ $inquiry->phone }}</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="text-xs text-gray-500 font-mono-brand uppercase text-left md:text-right">
                                {{ $inquiry->created_at->format('M d, Y') }} <br>
                                {{ $inquiry->created_at->format('h:i A') }}
                            </div>
                        </div>

                        <div>
                            <div class="text-sm font-bold text-gray-300 mb-2 font-mono-brand uppercase tracking-widest">
                                <span class="inline-block px-3 py-1 bg-[#1A243D] border border-[#D4AF37]/30 text-[#D4AF37] rounded-md mb-3 text-xs font-bold uppercase tracking-widest">
                                    {{ $inquiry->subject ?? 'General Inquiry' }}
                                </span>
                            </div>
                            <p class="text-gray-300 text-sm whitespace-pre-wrap leading-relaxed">{{ $inquiry->message }}</p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-[#1A243D] flex justify-end gap-3">
                            @if(!$inquiry->is_read)
                                <form action="{{ route('admin.inquiries.read', $inquiry) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-[#1A243D] hover:bg-[#D4AF37] text-white hover:text-[#050A15] px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition duration-300">
                                        Mark as Read
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this message permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-900/40 hover:bg-red-600 border border-red-900/50 text-red-400 hover:text-white px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition duration-300">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-[#091124] border border-[#1A243D] border-dashed rounded-xl p-12 text-center">
                        <h4 class="text-white font-bold text-lg mb-1">Inbox Zero</h4>
                        <p class="text-sm text-gray-500">You currently have no new messages or inquiries.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $inquiries->links() }}
            </div>
            
        </div>
    </div>
</x-app-layout>