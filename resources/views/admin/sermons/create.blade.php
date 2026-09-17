<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Publish Blog') }}
            </h2>
            <a href="{{ route('admin.sermons.index') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Cancel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-8 shadow-2xl relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#D4AF37] rounded-full mix-blend-multiply filter blur-[80px] opacity-10"></div>
                
                <form action="{{ route('admin.sermons.store') }}" method="POST" enctype="multipart/form-data" 
                      x-data="{ quotes: [''] }" class="space-y-6 relative z-10">
                    @csrf
                    <!-- Type Selector -->
                    <div class="mb-8 p-4 bg-[#1A243D]/50 border border-[#1A243D] rounded-lg">
                        <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">What are you publishing?</label>
                        <div class="flex gap-6">
                            <label class="flex items-center gap-2 cursor-pointer text-white font-bold">
                                <input type="radio" name="type" value="sermon" x-model="type" class="text-[#D4AF37] focus:ring-[#D4AF37] bg-[#050A15] border-[#1A243D]">
                                Sermon / Message
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer text-white font-bold">
                                <input type="radio" name="type" value="blog" x-model="type" class="text-[#D4AF37] focus:ring-[#D4AF37] bg-[#050A15] border-[#1A243D]">
                                Church News / Announcement
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sermon Title -->
                        <div class="md:col-span-2">
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Message Topic / Title</label>
                            <input type="text" name="title" required placeholder="e.g. The Power of Grace" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition">
                            <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <!-- Speaker Name -->
                        <div>
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" x-text="type === 'sermon' ? 'Speaker\'s Name' : 'Author / Posted By'"></label>
                            <input type="text" name="speaker" required placeholder="e.g. Pastor O. Kayode Peter" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition">
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Date</label>
                            <input type="date" name="date" required style="color-scheme: dark;" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition">
                            <x-input-error :messages="$errors->get('date')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <!-- Blog Cover Photo -->
                        <div>
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Blog Cover Photo</label>
                            <input type="file" name="image" accept="image/*" required class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-widest file:bg-[#1A243D] file:text-[#D4AF37] hover:file:bg-white hover:file:text-[#050A15] cursor-pointer transition">
                            <p class="text-xs text-gray-500 mt-1">Portrait orientation recommended.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <!-- Document Upload -->
                        <div>
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Presentation / Slides (Optional)</label>
                            <input type="file" name="document" accept=".pdf,.ppt,.pptx,.doc,.docx" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-widest file:bg-[#1A243D] file:text-[#D4AF37] hover:file:bg-white hover:file:text-[#050A15] cursor-pointer transition">
                            <p class="text-xs text-gray-500 mt-1">PDF or PowerPoint. Max 10MB.</p>
                            <x-input-error :messages="$errors->get('document')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>
                    <!-- BLOG CONTENT (Shows only for Blog) -->
                    <div x-show="type === 'blog'" class="pt-6 border-t border-[#1A243D]">
                        <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Article Content</label>
                        <textarea name="content" rows="10" placeholder="Write your announcement or milestone details here..." class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition"></textarea>
                    </div>

                    <!-- Dynamic Quotes Array (Shows only for Sermon) -->
                    <div x-show="type === 'sermon'" class="pt-6 border-t border-[#1A243D] space-y-4">
                        <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Key Quotes from the Message (Optional)</label>
                        
                        <template x-for="(quote, index) in quotes" :key="index">
                            <div class="flex items-start gap-3">
                                <textarea :name="'quotes[' + index + ']'" x-model="quotes[index]" rows="2" placeholder="Enter a profound quote from the speaker..." class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition resize-none"></textarea>
                                
                                <button type="button" x-show="quotes.length > 1" @click="quotes.splice(index, 1)" class="p-3 mt-1 text-red-400 hover:text-red-300 hover:bg-red-900/30 rounded-lg transition" title="Remove Quote">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </template>

                        <button type="button" @click="quotes.push('')" class="flex items-center gap-2 text-sm font-bold text-[#D4AF37] hover:text-white transition duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Add Another Quote
                        </button>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-4 rounded-lg hover:bg-white transition-all duration-300 shadow-md">
                            Publish Blog
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>