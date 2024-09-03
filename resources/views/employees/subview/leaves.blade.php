<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row w-full gap-4">
            {{ __('Employee Leaves') }}

            @include('employees.partials.navigation')

        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col gap-3">

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Time</th>
                            <th class="px-4 py-3">Total Days</th>
                            <th class="px-4 py-3">Reason</th>
                            <th class="px-4 py-3">Approver</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($leaves as $leave)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $leave->start_date }} ~ {{ $leave->end_date }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $leave->start_time }} ~ {{ $leave->end_time }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $leave->total_days }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $leave->reason }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $leave->approver->fullName() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ Str::title($leave->status) }}
                                    {{ $leave->status == App\Enums\StatusEnum::APPROVED->value ? '~ ' . $leave->approved_date : '' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $leave->remarks }}
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
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $leaves->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
