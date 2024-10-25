<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            {{ __('Timesheet Logs') }}
            <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 border border-transparent rounded-lg bg-purple-600 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <span>Add Logs</span>
            </button>
        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col gap-3">
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Clock In/Out</th>
                            <th class="px-4 py-3">Tardiness (mins)</th>
                            <th class="px-4 py-3">Undertime (mins)</th>
                            <th class="px-4 py-3">Hours Worked</th>
                            <th class="px-4 py-3">Actions</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($entries as $entry)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $entry->clock_in->format('d-M-Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="block">In: {{ $entry->clock_in->format('h:i a') }}</span>
                                    <span class="block">Out: {{ $entry->clock_out?->format('h:i a') }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $entry->tardiness }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $entry->undertime }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $entry->hours_worked }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 transition-colors duration-150 border border-transparent rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    
                                </td>
                            </tr>
                        @empty
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm text-center" colspan="4">
                                    No data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $entries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
