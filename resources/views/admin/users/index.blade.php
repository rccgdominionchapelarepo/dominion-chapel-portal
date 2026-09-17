<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-fraunces text-2xl text-white leading-tight tracking-wide">
                {{ __('Manage Users & Roles') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-[#D4AF37] hover:text-white transition">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Alert Messages -->
            <!-- Search Bar -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 justify-between items-center bg-[#091124] border border-[#1A243D] p-4 rounded-xl shadow-lg">
                <div class="relative w-full sm:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or phone..." 
                           class="block w-full pl-10 pr-3 py-2 border border-[#1A243D] rounded-lg leading-5 bg-[#050A15] text-gray-300 placeholder-gray-500 focus:outline-none focus:border-[#D4AF37] focus:ring focus:ring-[#D4AF37]/20 transition-all duration-300 sm:text-sm">
                </div>
                
                <div class="flex gap-2 w-full sm:w-auto">
                    <button type="submit" class="w-full sm:w-auto bg-[#D4AF37] hover:bg-white text-[#050A15] px-6 py-2 rounded-lg text-sm font-bold transition duration-300 shadow-md">
                        Search User
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.users.index') }}" class="w-full sm:w-auto text-center bg-[#1A243D] hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm font-bold transition duration-300">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
            @if (session('success'))
                <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-900/50 border border-red-500 text-red-300 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-[#091124] border border-[#1A243D] overflow-hidden shadow-2xl sm:rounded-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#050A15] border-b border-[#1A243D]">
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">User</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Contact</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Current Role</th>
                                <th class="font-mono-brand text-[#D4AF37] text-xs uppercase tracking-widest px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1A243D]">
                            @foreach ($users as $user)
                                <tr class="hover:bg-[#111A30] transition duration-200">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">Joined: {{ $user->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-300">{{ $user->email }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->whatsapp_number }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @foreach($user->roles as $role)
                                            <span class="px-2 py-1 bg-[#1A243D] text-[#D4AF37] text-xs rounded-md uppercase font-bold tracking-wider">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                   <td class="px-6 py-4">
                                        @if(auth()->id() === $user->id)
                                            <span class="text-xs text-gray-500 italic">This is you</span>
                                        @else
                                            <div class="flex items-center gap-4">
                                                <!-- Update Role Form -->
                                                <form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="flex items-center gap-2">
                                                    @csrf
                                                    <select name="role" class="bg-[#050A15] border border-[#1A243D] text-gray-300 text-sm rounded-lg focus:ring-[#D4AF37] focus:border-[#D4AF37] block w-full p-2">
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                                {{ ucfirst($role->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="bg-[#1A243D] hover:bg-[#D4AF37] text-white hover:text-[#050A15] px-3 py-2 rounded-lg text-sm font-bold transition duration-300">
                                                        Save
                                                    </button>
                                                </form>

                                                <!-- Delete User Form -->
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely delete {{ $user->name }}? This action cannot be undone.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-900/40 border border-red-900/50 hover:bg-red-600 text-red-400 hover:text-white px-3 py-2 rounded-lg text-sm font-bold transition duration-300" title="Delete User">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-[#1A243D]">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>