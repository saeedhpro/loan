<x-responsive-nav-link :href="route('dashboard.employers.index')" :active="request()->routeIs('dashboard.employers.index')">
    {{ __('لیست کارمندان') }}
</x-responsive-nav-link>
<x-responsive-nav-link :href="route('dashboard.employers.create')" :active="request()->routeIs('dashboard.employers.create')">
    {{ __('افزودن کارمند جدید') }}
</x-responsive-nav-link>
<x-responsive-nav-link :href="route('dashboard.loans.requests')" :active="request()->routeIs('dashboard.loans.requests')">
    {{ __('لیست درخواست های وام') }}
</x-responsive-nav-link>
