<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full">
            {{ __('Create Leave Type') }}

            <x-primary-button type="submit" id="triggerButton" class="ml-auto">Save</x-primary-button>
        </div>
    </x-slot>

    <form action="{{ route('leave-types.store') }}" method="POST"
        onsubmit="return confirm('Are you sure you want to create this record?')">
        @csrf
        <x-primary-button hidden id="targetButton" class="ml-auto">Save</x-primary-button>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Leave Type Information') }}
                </h2>
            </header>

            <div class="max-w-xl mb-4">
                <div class="flex gap-1">
                    <x-input-label for="name" :value="__('Name')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"
                    autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="max-w-xl mb-4">
                <div class="flex gap-1">
                    <x-input-label for="is_paid" :value="__('Is Paid')" />
                    <span class="text-red-500">*</span>
                </div>
                <select name="is_paid" id="is_paid"
                    class="mt-1 block w-full py-2 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Select one</option>
                    <option value="paid">Paid</option>
                    <option value="not_paid">Not Paid</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('is_paid')" />
            </div>
    </form>

    <script>
        // Get the buttons by their IDs
        const targetButton = document.getElementById('targetButton');
        const triggerButton = document.getElementById('triggerButton');

        // Add an event listener to the trigger button
        triggerButton.addEventListener('click', function() {
            // Programmatically trigger a click on the target button
            targetButton.click();
        });
    </script>
</x-app-layout>
