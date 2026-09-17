@extends('layouts.public')

@section('title', 'Blog — RCCG Dominion Chapel')

@section('content')
<main class="bg-[#050A15] min-h-screen py-20 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-16 relative z-10">
            <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Dominion Blog</div>
            <h1 class="font-fraunces text-4xl md:text-5xl text-white mb-4">Message Highlights &amp; Blog Posts</h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg">Revisit powerful quotes, download presentation slides, and catch up on activities you might have missed.</p>
        </div>

        @if($sermons->count() > 0)
            <!-- Stylish Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($sermons as $sermon)
                    <a href="{{ route('sermons.show', $sermon) }}" class="group flex flex-col bg-[#091124] border border-[#1A243D] rounded-2xl overflow-hidden shadow-xl hover:shadow-[0_0_30px_rgba(212,175,55,0.1)] hover:border-[#D4AF37]/50 transition-all duration-500 relative">
                        
                        <!-- Image Container -->
                        <div class="h-64 w-full relative overflow-hidden bg-[#1A243D]">
                            <img src="{{ asset('storage/' . $sermon->image_path) }}" alt="{{ $sermon->speaker }}" class="w-full h-full object-cover object-top group-hover:scale-110 group-hover:opacity-80 transition-all duration-700">
                            
                            <!-- Dark Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#091124] via-transparent to-transparent opacity-90"></div>
                            
                            <!-- Date Badge -->
                            <!-- Badges -->
                            <div class="absolute top-4 right-4 flex flex-col items-end gap-2">
                                <div class="bg-[#050A15]/80 backdrop-blur-md border border-[#1A243D] text-[#D4AF37] font-bold font-mono-brand text-[10px] uppercase tracking-widest px-3 py-1.5 rounded shadow-lg">
                                    {{ $sermon->date->format('M d, Y') }}
                                </div>
                                
                                @if($sermon->type === 'blog')
                                    <div class="bg-[#D4AF37] text-[#050A15] font-bold font-mono-brand text-[10px] uppercase tracking-widest px-3 py-1.5 rounded shadow-lg">
                                        Church News
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Card Content -->
                        <div class="p-8 flex flex-col grow justify-between">
                            <div>
                                <h3 class="font-fraunces text-2xl text-white mb-3 group-hover:text-[#D4AF37] transition-colors leading-tight">{{ $sermon->title }}</h3>
                                <p class="text-sm text-gray-400 font-mono-brand uppercase tracking-wider mb-6">By {{ $sermon->speaker }}</p>
                            </div>
                            
                            <!-- Footer of the Card -->
                            <div class="flex items-center justify-between border-t border-[#1A243D] pt-4 mt-auto">
                                <div class="flex gap-2">
                                    @if($sermon->document_path)
                                        <span class="text-[#D4AF37]" title="Slides Available">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        </span>
                                    @endif
                                    @if(is_array($sermon->quotes) && count($sermon->quotes) > 0)
                                        <span class="text-gray-400" title="Quotes Available">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                        </span>
                                    @endif
                                </div>
                                <span class="text-sm font-bold text-[#D4AF37] opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-300">
                                    Read Notes &rarr;
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 border-t border-[#1A243D] pt-8">
                {{ $sermons->links() }}
            </div>
            
        @else
            <!-- Empty State -->
            <div class="text-center py-24 border-2 border-[#1A243D] border-dashed rounded-2xl max-w-3xl mx-auto">
                <svg class="w-12 h-12 text-[#1A243D] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <p class="text-gray-400 font-mono-brand uppercase tracking-widest text-sm">No messages have been uploaded yet.</p>
            </div>
        @endif

    </div>
</main>
@endsection