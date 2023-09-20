@php use Illuminate\Support\Facades\Auth; @endphp
@if(Auth::user()->hasPermission('index_employers'))
<x-responsive-nav-link :href="route('dashboard.employers.index')" :active="request()->routeIs('dashboard.employers.index')">
    {{ __('لیست کارمندان') }}
</x-responsive-nav-link>
@endif
@if(Auth::user()->hasPermission('create_employer'))
<x-responsive-nav-link :href="route('dashboard.employers.create')" :active="request()->routeIs('dashboard.employers.create')">
    {{ __('افزودن کارمند جدید') }}
</x-responsive-nav-link>
@endif
@if(Auth::user()->hasPermission('index_request_loans'))
<x-responsive-nav-link :href="route('dashboard.loans.requests')" :active="request()->routeIs('dashboard.loans.requests')">
    {{ __('لیست درخواست های وام') }}
</x-responsive-nav-link>
@endif
@if(Auth::user()->hasPermission('request_loan'))
    <x-responsive-nav-link :href="route('dashboard.loans.request')" :active="request()->routeIs('dashboard.loans.request')">
        {{ __('درخواست وام') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('dashboard.loans')" :active="request()->routeIs('dashboard.loans')">
        {{ __('لیست درخواست های من') }}
    </x-responsive-nav-link>
@endif
