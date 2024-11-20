<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    @if (auth()->user()->role->name == App\Enums\RoleEnum::ADMIN->value)
        Sample
    @else
        @include('components.dtr-login')
    @endif
</x-app-layout>
