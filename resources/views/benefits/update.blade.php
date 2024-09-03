<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full">
            {{ __('Create Benefit') }}

            <x-primary-button type="submit" id="triggerButton" class="ml-auto">Save</x-primary-button>
        </div>
    </x-slot>

    <form action="{{ route('deductions.store') }}" method="POST"
        onsubmit="return confirm('Are you sure you want to update this record?')">
        @csrf
        @method('PUT')
        <x-primary-button hidden id="targetButton" class="ml-auto">Save</x-primary-button>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Benefit Information') }}
                </h2>
            </header>

            <div class="max-w-xl mb-4">
                <div class="flex gap-1">
                    <x-input-label for="name" :value="__('Name')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name') ?? $benefit->name" autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
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
