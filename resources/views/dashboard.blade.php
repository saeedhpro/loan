<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('پنل کاربری') }}
        </h2>
    </x-slot>
    <div class="flex flex-col mt-6 space-y-6 px-6">
        <h4 class="text-right font-bold">آمار</h4>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-row justify-start align-middle">
                <span>مبلغ کل وام های پرداختی: </span>
                <span class="mr-1 font-bold">{{ $statistics['total'] }} تومان</span>
            </div>
            <div class="flex flex-row justify-start align-middle">
                <span>تعداد وام های در انتظار: </span>
                <span class="mr-1 font-bold">{{ $statistics['created'] }} عدد</span>
            </div>
            <div class="flex flex-row justify-start align-middle">
                <span>تعداد وام های تایید شده: </span>
                <span class="mr-1 font-bold">{{ $statistics['accepted'] }} عدد</span>
            </div>
            <div class="flex flex-row justify-start align-middle">
                <span>تعداد وام های رد شده: </span>
                <span class="mr-1 font-bold">{{ $statistics['rejected'] }} عدد</span>
            </div>
        </div>
    </div>
</x-app-layout>
