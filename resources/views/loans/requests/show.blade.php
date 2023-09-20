<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('اطلاعات وام') }}
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
        <div class="flex flex-col mt-6 space-y-6 px-6">
            <h4 class="text-right font-bold">اطلاعات وام</h4>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-row justify-start align-middle">
                    <span>وام گیرنده: </span>
                    <span class="mr-1 font-bold">{{ $loan->user->full_name }} </span>
                </div>
                <div class="flex flex-row justify-start align-middle">
                    <span>مبلغ: </span>
                    <span class="mr-1 font-bold">{{ $loan->amount . ' تومان' }} </span>
                </div>
                <div class="flex flex-row justify-start align-middle">
                    <span>وضعیت: </span>
                    <span class="mr-1 font-bold">{{ $loan->status_fa }} </span>
                </div>
                <div class="flex flex-row justify-start align-middle">
                    <span>تاریخ تایید/رد: </span>
                    <span class="mr-1 font-bold">{{ $loan->action_time_fa }} </span>
                </div>
                <div class="flex flex-row justify-start align-middle">
                    <span>ناظر: </span>
                    <span class="mr-1 font-bold">{{ $loan->approver->full_name }} </span>
                </div>
            </div>
        </div>
        @if($loan->status == 'created')
                <form id="create-employer" method="POST" action="{{ route('dashboard.employers.update', ['id' => $loan->id]) }}" class="flex flex-col mt-6 space-y-6 px-6">
                    @method('put')
                    {{ csrf_field() }}
                    <div class="flex flex-row">
                        <form class="inline-flex mx-0.5" method="POST" action="{{ route('dashboard.loans.action', ['id' => $loan->id]) }}">
                            {{ csrf_field() }}
                            <input name="action" hidden value="accepted">
                            <x-primary-button class="text-green-600 bg-green-500 hover:bg-green-400">تایید</x-primary-button>
                        </form>
                        <form class="inline-flex mx-0.5" method="POST" action="{{ route('dashboard.loans.action', ['id' => $loan->id]) }}">
                            {{ csrf_field() }}
                            <input name="action" hidden value="rejected">
                            <x-primary-button class="text-red-600 bg-red-500 hover:bg-red-400">رد</x-primary-button>
                        </form>
                    </div>
                </form>
            @endif
    </div>
</x-app-layout>
