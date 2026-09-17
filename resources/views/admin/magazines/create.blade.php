<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Upload Dominion Magazine') }}
            </h2>
            <a href="{{ route('admin.magazines.index') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Cancel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#091124] border border-[#1A243D] rounded-xl p-8 shadow-2xl relative overflow-hidden">
                <!-- Decorative Glow -->
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#D4AF37] rounded-full mix-blend-multiply filter blur-[80px] opacity-10"></div>
                
                <form action="{{ route('admin.magazines.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Magazine Title -->
                        <div class="md:col-span-2">
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Magazine Title</label>
                            <input type="text" name="title" required placeholder="e.g. The Dominion Voice" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition">
                            <x-input-error :messages="$errors->get('title')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <!-- Edition / Month -->
                        <div class="md:col-span-2">
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Edition / Release Date</label>
                            <input type="text" name="edition" required placeholder="e.g. September 2026 Edition" class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition">
                            <x-input-error :messages="$errors->get('edition')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <!-- Cover Image Upload -->
                        <div>
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Front Cover Image</label>
                            <input type="file" name="cover_image" accept="image/*"  class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-widest file:bg-[#1A243D] file:text-[#D4AF37] hover:file:bg-white hover:file:text-[#050A15] cursor-pointer transition">
                            <p class="text-xs text-gray-500 mt-1">Upload a clear image of the front cover (JPG/PNG) (OPTIONAL).</p>
                            <x-input-error :messages="$errors->get('cover_image')" class="mt-2 text-red-400 text-xs" />
                        </div>

                        <!-- PDF Document Upload -->
                        <div>
                            <label class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Magazine PDF File</label>
                            <input type="file" name="file" accept=".pdf" required class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-widest file:bg-[#1A243D] file:text-[#D4AF37] hover:file:bg-white hover:file:text-[#050A15] cursor-pointer transition">
                            <p class="text-xs text-gray-500 mt-1">Upload the actual magazine PDF (Max 100MB).</p>
                            <x-input-error :messages="$errors->get('file')" class="mt-2 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#1A243D] mt-6">
                        <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-4 rounded-lg hover:bg-white transition-all duration-300 shadow-md">
                            Upload & Publish Magazine
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>