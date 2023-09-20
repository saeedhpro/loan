@php($i = 0)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لیست درخواست های وام') }}
        </h2>
    </x-slot>
    <div class="overflow-x-auto my-12">
        <div>
            <table class="table">
                <!-- head -->
                <thead>
                <tr>
                    <th></th>
                    <th>نام</th>
                    <th>نام خانوادگی کارمند</th>
                    <th>مبلغ وام</th>
                    <th>وضعیت</th>
                    <th>زمان تایید/رد</th>
                    <th>ناظر</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($loans as $loan)
                    @php($i++)
                    <tr>
                        <th>
                            {{ (($loans->currentPage() - 1) * 10 + $i) }}
                        </th>
                        <td>
                            {{ $loan->user->name ?? '-' }}
                        </td>
                        <td>
                            {{ $loan->user->last_name ?? '-' }}
                        </td>
                        <td>
                            {{ $loan->amount . ' تومان' }}
                        </td>
                        <td>
                            {{ $loan->status_fa }}
                        </td>
                        <td>
                            {{ $loan->action_time_fa }}
                        </td>
                        <td>
                            {{ $loan->approver?->name . ' ' .$loan->approver?->last_name }}
                        </td>
                        <th class="flex flex-row">
                            <x-primary-link href="{{ route('dashboard.loans.show', ['id' => $loan->id]) }}" class="text-white-600 bg-blue-500">مشاهده</x-primary-link>
                            @if($loan->status == 'created')
                                <form class="inline-flex mx-0.5" method="POST" action="{{ route('dashboard.loans.action', ['id' => $loan->id]) }}">
                                    {{ csrf_field() }}
                                    <input name="action" hidden value="accepted">
                                    <x-primary-button class="text-green-600 bg-green-500 hover:bg-green-400">تایید</x-primary-button>
                                </form>
                                <form class="inline-flex" method="POST" action="{{ route('dashboard.loans.action', ['id' => $loan->id]) }}">
                                    {{ csrf_field() }}
                                    <input name="action" hidden value="rejected">
                                    <x-primary-button class="text-red-600 bg-red-500 hover:bg-red-400">رد</x-primary-button>
                                </form>
                            @endif
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4 px-6">
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
