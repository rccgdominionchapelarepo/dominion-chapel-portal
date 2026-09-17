@extends('layouts.public')

@section('title', $sermon->title . ' — RCCG Dominion Chapel')

@section('content')
<main class="bg-[#050A15] min-h-screen py-12 md:py-20 font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <a href="{{ route('sermons.index') }}" class="inline-flex items-center text-sm font-bold text-[#D4AF37] hover:text-white transition duration-300 mb-8 font-mono-brand uppercase tracking-widest">
            &larr; Back to Blog
        </a>

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row gap-8 items-start mb-16">
            <!-- Speaker Image -->
            <div class="w-full md:w-1/3 shrink-0">
                <div class="rounded-xl overflow-hidden border-2 border-[#1A243D] shadow-2xl relative">
                    <img src="{{ asset('storage/' . $sermon->image_path) }}" alt="{{ $sermon->speaker }}" class="w-full h-auto object-cover">
                </div>
            </div>
            
            <!-- Sermon Info & Download Button -->
            <div class="w-full md:w-2/3">
                <div class="font-mono-brand text-gray-400 text-xs font-bold uppercase tracking-widest mb-3">
                    {{ $sermon->date->format('l, F j, Y') }}
                </div>
                <h1 class="font-fraunces text-4xl md:text-5xl text-white mb-4 leading-tight">{{ $sermon->title }}</h1>
                <p class="text-xl text-[#D4AF37] mb-8 font-serif italic">
                    {{ $sermon->type === 'sermon' ? 'Ministered by' : 'Posted by' }} {{ $sermon->speaker }}
                </p>

                <!-- Blog Content Section -->
                @if($sermon->type === 'blog' && $sermon->content)
                    <div class="bg-[#091124] border border-[#1A243D] p-8 md:p-12 rounded-xl shadow-xl mt-8 relative z-10">
                        <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed font-sans">
                            {!! nl2br(e($sermon->content)) !!}
                        </div>
                    </div>
                @endif

                <!-- Document Download Button (Only shows if a document was uploaded) -->
                @if($sermon->document_path)
                    <a href="{{ asset('storage/' . $sermon->document_path) }}" download class="inline-flex items-center justify-center gap-3 bg-[#1A243D] hover:bg-[#D4AF37] border border-[#D4AF37]/30 hover:border-[#D4AF37] text-white hover:text-[#050A15] px-6 py-3 rounded-lg font-bold transition-all duration-300 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Presentation Slides
                    </a>
                @endif
            </div>
        </div>

        <!-- Stylish Quotes Section -->
        @if(is_array($sermon->quotes) && count($sermon->quotes) > 0)
            <div class="space-y-12 relative z-10">
                <div class="text-center mb-10 border-b border-[#1A243D] pb-4">
                    <h2 class="font-fraunces text-2xl text-white">Key Takeaways & Quotes</h2>
                </div>

                @foreach($sermon->quotes as $quote)
                    <div class="relative bg-[#091124] border-l-4 border-[#D4AF37] p-8 md:p-10 rounded-r-xl shadow-xl">
                        <!-- Giant decorative quote mark in the background -->
                        <div class="absolute top-0 left-4 text-[120px] leading-none text-[#1A243D] font-serif opacity-30 select-none pointer-events-none" style="font-family: Georgia, serif;">
                            &ldquo;
                        </div>
                        
                        <!-- The actual quote text -->
                        <p class="relative z-10 font-serif text-xl md:text-2xl text-gray-300 leading-relaxed italic">
                            "{{ $quote }}"
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</main>
@endsection