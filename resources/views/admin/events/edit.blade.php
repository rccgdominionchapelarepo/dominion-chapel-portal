<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Edit Event') }}: {{ $event->title }}
            </h2>
            <a href="{{ route('admin.events.index') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Events
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-6 bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-lg shadow-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-8 bg-[#091124] border border-[#1A243D] rounded-xl p-8 shadow-2xl">
                
                <!-- Image Preview Column -->
                <div class="w-full md:w-1/2">
                    <h3 class="font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Current Flyer</h3>
                    <div class="bg-[#050A15] border border-[#1A243D] rounded-lg overflow-hidden relative group">
                        <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->title }}" class="w-full object-cover rounded-lg">
                        <div class="absolute top-3 left-3 bg-[#050A15]/80 backdrop-blur-sm border border-[#1A243D] text-[#D4AF37] text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-md">
                            {{ $event->tag }}
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="w-full md:w-1/2">
                    <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="title" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Event Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" required 
                                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300">
                        </div>

                        <div>
                            <label for="tag" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Program Tag</label>
                            <input type="text" id="tag" name="tag" value="{{ old('tag', $event->tag) }}" required 
                                   class="block w-full bg-[#050A15] border border-[#1A243D] text-white rounded-lg px-4 py-3 focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300">
                        </div>

                        <div>
                            <label for="image" class="block font-mono-brand text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Replace Flyer Image (Optional)</label>
                            <input type="file" id="image" name="image" accept="image/*"
                                   class="block w-full text-sm text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-[#1A243D] file:text-[#D4AF37] hover:file:bg-white hover:file:text-[#050A15] file:transition-all cursor-pointer bg-[#050A15] border border-[#1A243D] rounded-lg focus:outline-none">
                            <p class="text-xs text-gray-500 mt-2">Leave this blank to keep the current image. Max size: 5MB.</p>
                        </div>

                        <div class="pt-4 border-t border-[#1A243D]">
                            <button type="submit" class="w-full bg-[#D4AF37] text-[#050A15] font-bold py-3 rounded-lg hover:bg-white transition-all duration-300 shadow-md">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>