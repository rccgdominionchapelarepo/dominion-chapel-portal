<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Church Membership Database') }}
            </h2>
            <a href="{{ route('admin.membership.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                Download Excel Sheet
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 border-b dark:border-gray-600 text-gray-600 dark:text-gray-300">
                                <th class="p-4 rounded-tl-lg">Family Name</th>
                                <th class="p-4">Contact Info</th>
                                <th class="p-4">Total Members</th>
                                <th class="p-4">Date Submitted</th>
                                <th class="p-4 rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 dark:text-gray-200">
                            @forelse($families as $family)
                                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="p-4 font-medium">{{ $family->family_name }} Family</td>
                                    <td class="p-4">
                                        <div class="text-sm">{{ $family->email }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $family->phone_number }}</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $family->members->count() }} individuals
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $family->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-5 text-right rounded-r-2xl border-y border-r border-slate-700/50 group-hover:border-sky-500/30 transition-colors">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.membership.show', $family->id) }}" class="inline-flex items-center justify-center bg-slate-700/50 hover:bg-sky-500 text-white font-medium text-sm px-4 py-2 rounded-xl transition-all duration-200 shadow-sm">
                                                View
                                            </a>
                                            <form action="{{ route('admin.membership.destroy', $family->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this family and all its members? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center bg-slate-700/50 hover:bg-rose-500 text-white font-medium text-sm px-4 py-2 rounded-xl transition-all duration-200 shadow-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-500 dark:text-gray-400">No membership forms have been submitted yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $families->links() }}
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>