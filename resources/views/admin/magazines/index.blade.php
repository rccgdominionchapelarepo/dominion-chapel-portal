<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Manage Magazines') }}
            </h2>
            <a href="{{ route('admin.magazines.create') }}" class="bg-[#D4AF37] hover:bg-white text-[#050A15] px-4 py-2 rounded-lg text-sm font-bold transition duration-300 shadow-md">
                + Upload New Magazine
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

            <!-- Magazines List -->
            <div class="bg-[#091124] border border-[#1A243D] overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#050A15] border-b border-[#1A243D]">
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Magazine Details</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Edition</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">File Status</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1A243D]">
                            @forelse ($magazines as $magazine)
                                <tr class="hover:bg-[#111A30] transition duration-200">
                                    
                                    <!-- Image & Title -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-20 w-14 shrink-0 rounded overflow-hidden border border-[#1A243D] shadow-md bg-black">
                                                <img src="{{ asset('storage/' . $magazine->cover_image) }}" alt="Cover" class="h-full w-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-bold text-white text-lg leading-tight mb-1">{{ $magazine->title }}</div>
                                                <div class="text-xs text-gray-400 font-mono-brand uppercase tracking-wider">Uploaded: {{ $magazine->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Edition -->
                                    <td class="px-6 py-4">
                                        <span class="text-gray-300 text-sm font-bold">{{ $magazine->edition }}</span>
                                    </td>
                                    
                                    <!-- Assets -->
                                    <td class="px-6 py-4">
                                        @if($magazine->file_path)
                                            <span class="inline-flex items-center px-2 py-1 bg-red-900/30 text-red-400 text-[10px] rounded uppercase font-bold tracking-wider border border-red-900/50">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                PDF Ready
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <!-- Actions -->
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <!-- Preview PDF Button -->
                                            <a href="{{ asset('storage/' . $magazine->file_path) }}" target="_blank" class="p-2 text-gray-400 hover:text-[#D4AF37] transition duration-300" title="View PDF">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.magazines.destroy', $magazine) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this magazine? The PDF and Cover Image will be permanently deleted from the server.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-900/30 border border-red-900/50 hover:bg-red-600 text-red-400 hover:text-white rounded-lg transition duration-300" title="Delete Magazine">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        No magazines uploaded yet. Click the gold button above to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($magazines->hasPages())
                    <div class="px-6 py-4 border-t border-[#1A243D]">
                        {{ $magazines->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>