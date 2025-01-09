<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    @if (auth()->user()->role->name == App\Enums\RoleEnum::ADMIN->value)
        <h3>Welcome back Admin!</h3>
    @else
        @include('components.dtr-login')
    @endif
</x-app-layout>
