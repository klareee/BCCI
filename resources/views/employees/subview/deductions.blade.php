<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row w-full gap-4">
            {{ __('Employee Deductions') }}

            @include('employees.partials.navigation')

        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs flex flex-col gap-3">

        {{-- <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
            <div class="flex justify-center items-center w-12 bg-blue-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-blue-500">Info</span>
                    <p class="text-sm text-gray-600">Sample table page</p>
                </div>
            </div>
        </div> --}}

        <div class="flex gap-2">

            <a href="{{ route('employees.deduction-create', ['employee_id' => $user->id]) }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring ml-auto">
                Add
            </a>
        </div>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Benefit Name</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($deductions as $deduction)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $deduction->benefit->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $deduction->amount }}
                                </td>
                                <td class="px-4 py-3 flex gap-4">
                                    <a href="{{ route('deductions.edit', ['deduction' => $deduction]) }}" class="relative group text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>

                                        <span
                                            class="absolute left-1/2 bottom-full mb-2 hidden group-hover:flex -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg">
                                            Edit
                                        </span>
                                    </a>


                                    <form action="{{ route('deductions.destroy', ['deduction' => $deduction]) }}" method="post" onsubmit="return confirm('Do you want to delete this record?')">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="relative group text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            <span
                                                class="absolute left-1/2 bottom-full mb-2 hidden group-hover:flex -translate-x-1/2 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg">
                                                Delete
                                            </span>
                                        </button>
                                    </form>

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
                {{ $deductions->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
