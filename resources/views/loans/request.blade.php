<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('درخواست وام') }}
        </h2>
    </x-slot>
    <div class="overflow-x-auto mb-6">
        @if($success)
            <div class="mt-4 mx-6 px-4 bg-green-100 border border-green-400 text-green-700 py-3 rounded-lg relative text-right">
                <span class="block sm:inline">با موفقیت انجام شد</span>
            </div>
        @endif
        @if(!$success && $error != '')
            <div class="mt-4 mx-6 px-4 bg-red-100 border border-red-400 text-red-700 py-3 rounded-lg relative text-right" role="alert">
                <span class="block sm:inline">{{ $error }}</span>
            </div>
        @endif
        <form id="create-employer" method="POST" action="{{ route('dashboard.loans.store') }}" class="flex flex-col mt-6 space-y-6 px-6">
            {{ csrf_field() }}
            <h4 class="text-right font-bold">اطلاعات درخواست</h4>
            <div class="flex">
                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="amount" :value="__('مبلغ (تومان)')" />
                    <x-text-input id="amount" name="amount" placeholder="۱۰۰۰۰ تومان" type="number" class="mt-1 block w-full" :value="old('amount')"  autofocus autocomplete="amount" />
                    <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('ثبت') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
