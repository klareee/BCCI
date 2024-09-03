<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full">
            {{ __('Create Deduction') }}

            <x-primary-button type="submit" id="triggerButton" class="ml-auto">Save</x-primary-button>
        </div>
    </x-slot>

    <form action="{{ route('deductions.store') }}" method="POST"
        onsubmit="return confirm('Are you sure you want to create this record?')">
        @csrf
        <x-primary-button hidden id="targetButton" class="ml-auto">Save</x-primary-button>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Employee Deduction Benefits') }}
                </h2>
            </header>

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="max-w-xl mb-4">
                <div class="flex gap-1">
                    <x-input-label for="benefit" :value="__('Benefit')" />
                    <span class="text-red-500">*</span>
                </div>
                <select name="benefit" id="benefit"
                    class="mt-1 block w-full py-2 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                    <option value="">Select one</option>
                    @foreach ($benefits as $benefit)
                        <option value="{{ $benefit->id }}">{{ $benefit->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('benefit')" />
            </div>

            <div class="max-w-xl mb-4">
                <div class="flex gap-1">
                    <x-input-label for="amount" :value="__('Amount')" />
                    <span class="text-red-500">*</span>
                </div>
                <x-text-input id="amount" name="amount" type="number" class="mt-1 block w-full"
                    :value="old('amount')" autofocus autocomplete="amount" />
                <x-input-error class="mt-2" :messages="$errors->get('amount')" />
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
