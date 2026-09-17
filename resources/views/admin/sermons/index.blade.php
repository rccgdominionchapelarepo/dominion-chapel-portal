<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Manage Blogs') }}
            </h2>
            <a href="{{ route('admin.sermons.create') }}" class="bg-[#D4AF37] hover:bg-white text-[#050A15] px-4 py-2 rounded-lg text-sm font-bold transition duration-300 shadow-md">
                + Publish New Blog
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if (session('success'))
                <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-6 py-4 rounded-xl shadow-lg font-bold">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-6 py-4 rounded-xl shadow-lg font-bold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Sermons List -->
            <div class="bg-[#091124] border border-[#1A243D] overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#050A15] border-b border-[#1A243D]">
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Blog Details</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Date </th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Assets Attached</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1A243D]">
                            @forelse ($sermons as $sermon)
                                <tr class="hover:bg-[#111A30] transition duration-200">
                                    
                                    <!-- Image & Title -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-16 w-16 shrink-0 rounded-lg overflow-hidden border border-[#1A243D]">
                                                <img src="{{ asset('storage/' . $sermon->image_path) }}" alt="{{ $sermon->speaker }}" class="h-full w-full object-cover object-top">
                                            </div>
                                            <div>
                                                <div class="font-bold text-white text-lg leading-tight mb-1">{{ $sermon->title }}</div>
                                                <div class="text-xs text-gray-400 font-mono-brand uppercase tracking-wider">By {{ $sermon->speaker }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Date -->
                                    <td class="px-6 py-4">
                                        <span class="text-gray-300 text-sm font-bold">{{ $sermon->date->format('M d, Y') }}</span>
                                    </td>
                                    
                                    <!-- Assets (Quotes/Docs) -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col gap-2">
                                            @if($sermon->document_path)
                                                <span class="inline-flex items-center w-max px-2 py-1 bg-blue-900/30 text-blue-400 text-[10px] rounded uppercase font-bold tracking-wider border border-blue-900/50">
                                                    📄 Slides Attached
                                                </span>
                                            @endif
                                            
                                            <span class="inline-flex items-center w-max px-2 py-1 bg-[#1A243D] text-gray-300 text-[10px] rounded uppercase font-bold tracking-wider border border-[#1A243D]">
                                                💬 {{ is_array($sermon->quotes) ? count($sermon->quotes) : 0 }} Quotes
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <!-- Actions -->
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('sermons.show', $sermon) }}" target="_blank" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                                                View Live &nearr;
                                            </a>

                                            <form action="{{ route('admin.sermons.destroy', $sermon) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sermon? This will also delete the associated image and PDF files permanently.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-900/30 border border-red-900/50 hover:bg-red-600 text-red-400 hover:text-white rounded-lg transition duration-300" title="Delete Sermon">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        No sermons published yet. Click the gold button above to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($sermons->hasPages())
                    <div class="px-6 py-4 border-t border-[#1A243D]">
                        {{ $sermons->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>