<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Manage Events & Programs') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg shadow-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-lg shadow-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- LEFT COLUMN: Upload Form -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-6 shadow-2xl sticky top-6">
                        <h3 class="font-fraunces text-xl text-white mb-6">Upload New Flyer</h3>
                        
                        <!-- Note the enctype="multipart/form-data" which is required for file uploads -->
                        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                            @csrf
                            
                            <div>
                                <label for="title" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Event Title</label>
                                <input type="text" id="title" name="title" required placeholder="e.g. Divine Intervention"
                                       class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300">
                            </div>

                            <div>
                                <label for="tag" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Program Tag</label>
                                <input type="text" id="tag" name="tag" required placeholder="e.g. Theme Sunday, Special Program"
                                       class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300">
                            </div>

                            <div>
                                <label for="image" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Flyer Image</label>
                                <input type="file" id="image" name="image" accept="image/*" required
                                       class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#1A243D] file:text-[#D4AF37] hover:file:bg-white hover:file:text-[#050A15] file:transition-all cursor-pointer bg-[#050A15] border border-[#1A243D] rounded-lg focus:outline-none">
                                <p class="text-xs text-gray-500 mt-2">JPG, PNG, or WEBP (Max 5MB). Portrait orientation recommended.</p>
                            </div>

                            <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-3 rounded-lg hover:bg-white transition-all duration-300 mt-4 shadow-md">
                                Publish Event
                            </button>
                        </form>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Active Events Grid -->
                <!-- RIGHT COLUMN: Active Events Grid -->
                <div class="w-full lg:w-2/3">
                    
                    <!-- Header & Search Bar -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h3 class="font-fraunces text-xl text-white">Active Programs</h3>
                        
                        <form action="{{ route('admin.events.index') }}" method="GET" class="w-full sm:w-72 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or tag..." 
                                   class="block w-full pl-9 pr-3 py-2 border border-[#1A243D] rounded-lg leading-5 bg-[#050A15] text-gray-300 placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 text-sm">
                        </form>
                    </div>
                    
                    @if($events->count() > 0)
                        <!-- Grid updated to 2 columns on medium screens, 3 columns on extra large screens -->
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach($events as $event)
                                <div class="bg-[#091124] border border-[#1A243D] rounded-xl overflow-hidden shadow-lg group relative flex flex-col">
                                    <!-- Image Preview: Reduced height from h-64 to h-48 for a tighter card -->
                                    <div class="h-48 w-full bg-[#050A15] relative overflow-hidden shrink-0">
                                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <!-- Overlay Tag -->
                                        <div class="absolute top-3 left-3 bg-[#050A15]/90 backdrop-blur-sm border border-[#1A243D] text-[#D4AF37] text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded">
                                            {{ $event->tag }}
                                        </div>
                                    </div>
                                    
                                    <!-- Card Details & Actions -->
                                    <div class="p-4 flex flex-col grow justify-between gap-3">
                                        <div>
                                            <h4 class="font-bold text-white text-md line-clamp-1" title="{{ $event->title }}">{{ $event->title }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">Added {{ $event->created_at->format('M d, Y') }}</p>
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="flex items-center gap-2 mt-auto">
                                            <a href="{{ route('admin.events.edit', $event) }}" class="flex-1 text-center bg-[#1A243D] hover:bg-[#D4AF37] text-gray-300 hover:text-[#050A15] py-2 rounded-lg text-sm font-bold transition duration-300">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="shrink-0" onsubmit="return confirm('Are you sure you want to delete this event flyer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-900/30 border border-red-900/50 hover:bg-red-600 text-red-400 hover:text-white p-2 rounded-lg transition duration-300" title="Delete Event">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination Links -->
                        <div class="mt-6">
                            {{ $events->links() }}
                        </div>
                    @else
                        <div class="bg-[#091124] border border-[#1A243D] border-dashed rounded-xl p-12 text-center flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <h4 class="text-white font-bold text-lg mb-1">No Events Found</h4>
                            <p class="text-sm text-gray-500">Upload a flyer or adjust your search.</p>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>