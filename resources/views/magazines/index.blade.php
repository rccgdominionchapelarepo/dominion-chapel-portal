@extends('layouts.public')

@section('title', 'Magazine Downloads — RCCG Dominion Chapel')

@section('content')
<main class="bg-[#050A15] min-h-screen py-20 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-16 relative z-10">
            <div class="font-mono-brand text-[#D4AF37] text-xs font-bold uppercase tracking-widest mb-3">Dominion Voice</div>
            <h1 class="font-fraunces text-4xl md:text-5xl text-white mb-4">Magazine Downloads</h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg">Download our latest monthly publications, insightful articles, and church updates directly to your device.</p>
        </div>

        @if($magazines->count() > 0)
            <!-- Magazine Grid (1 col mobile, 2 col tablet, 4 col desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($magazines as $magazine)
                    <div class="bg-[#091124] border border-[#1A243D] rounded-2xl overflow-hidden shadow-xl flex flex-col transition-all duration-500 hover:border-[#D4AF37]/50 hover:shadow-[0_0_30px_rgba(212,175,55,0.1)] group relative">
                        
                        <!-- Magazine Cover Image -->
                        <div class="aspect-[3/4] w-full relative overflow-hidden bg-[#1A243D]">
                            <img src="{{ asset('storage/' . $magazine->cover_image) }}" alt="{{ $magazine->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            <!-- Dark Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#091124] via-transparent to-transparent opacity-80"></div>
                        </div>
                        
                        <!-- Details & Button -->
                        <div class="p-6 flex flex-col grow justify-between relative z-10 -mt-12">
                            <div class="mb-6">
                                <div class="inline-block bg-[#050A15]/90 backdrop-blur-md border border-[#1A243D] text-[#D4AF37] font-bold font-mono-brand text-[10px] uppercase tracking-widest px-3 py-1.5 rounded shadow-lg mb-3">
                                    {{ $magazine->edition }}
                                </div>
                                <h3 class="font-fraunces text-xl text-white leading-tight group-hover:text-[#D4AF37] transition-colors">{{ $magazine->title }}</h3>
                            </div>
                            
                            <!-- Download PDF Link -->
                            <a href="{{ Storage::disk('r2')->url($magazine->file_path) }}" target="_blank" rel="noopener noreferrer" download class="mt-auto w-full inline-flex items-center justify-center gap-2 bg-[#1A243D] hover:bg-[#D4AF37] border border-[#D4AF37]/30 hover:border-[#D4AF37] text-white hover:text-[#050A15] px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v-8m0 8l-4-4m4 4l4-4"></path>
                                </svg>
                                Download PDF
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-16 border-t border-[#1A243D] pt-8">
                {{ $magazines->links() }}
            </div>
            
        @else
            <!-- Empty State -->
            <div class="text-center py-24 border-2 border-[#1A243D] border-dashed rounded-2xl max-w-3xl mx-auto">
                <svg class="w-12 h-12 text-[#1A243D] mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <p class="text-gray-400 font-mono-brand uppercase tracking-widest text-sm">No magazines have been published yet.</p>
            </div>
        @endif

    </div>
</main>
@endsection