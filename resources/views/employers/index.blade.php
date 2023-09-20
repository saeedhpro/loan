@php($i = 0)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('لیست کارمندان') }}
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
                    <th>نام خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>سمت</th>
                    <th>موجودی</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @php($i++)
                    <tr>
                        <th>
                            {{ (($users->currentPage() - 1) * 10 + $i) }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->last_name }}
                        </td>
                        <td>
                            {{ $user->username }}
                        </td>
                        <td>
                            {{ $user->position }}
                        </td>
                        <td>
                            {{ $user->amount . ' تومان' }}
                        </td>
                        <th class="flex flex-row">
                            <form class="inline-flex" method="POST" action="{{ route('dashboard.employers.destroy', ['id' => $user->id]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <x-primary-button class="text-red-600 bg-red-500 hover:bg-red-400">حذف</x-primary-button>
                            </form>
                            <x-secondary-link href="{{ route('dashboard.employers.edit', ['id' => $user->id]) }}" class="text-green-600 bg-red-500">ویرایش</x-secondary-link>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4 px-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
