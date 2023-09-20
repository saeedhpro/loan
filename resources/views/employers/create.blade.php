<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('افزودن کارمند') }}
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
        <form id="create-employer" method="POST" action="{{ route('dashboard.employer.store') }}" class="flex flex-col mt-6 space-y-6 px-6">
            {{ csrf_field() }}
            <h4 class="text-right font-bold">اطلاعات کاربر</h4>
            <div class="flex">
                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="name" :value="__('نام')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')"  autofocus autocomplete="name" />
                    <x-input-error id="name_error" class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="last_name" :value="__('نام خانوادگی')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name')"  autofocus autocomplete="last_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
            </div>

            <div class="flex">
                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="username" :value="__('نام کاربری')" />
                    <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username')"  autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                </div>
                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="position" :value="__('سمت')" />
                    <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position')" autocomplete="position" />
                    <x-input-error class="mt-2" :messages="$errors->get('position')" />
                </div>
            </div>

            <div class="flex">
                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="role" :value="__('نقش کاربری')" />
                    <x-select-input :options="$roles" id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', 'employer')" required autocomplete="role" />
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
                <div class="w-full md:w-1/2 px-1">
                    <x-input-label for="password" :value="__('پسورد')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :value="old('password')" required autocomplete="password" />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
            </div>

            <hr class="my-4"/>

            <div class="flex flex-col">
                <h4 class="text-right font-bold">دسترسی ها</h4>
                <div class="flex my-2">
                    <div class="w-full px-1">
                        <div class="flex flex-row flex-wrap">
                            @foreach($permissions as $o)
                                <div class="form-control">
                                    <label class="cursor-pointer label">
                                        <input type="checkbox"
                                               id="{{ "checkbox".$o->id }}"
                                               value="{{ $o->id }}"
                                               name="permissions[]"
                                               class="checkbox checkbox-success"
                                               @if(is_array(old('permissions')) && in_array($o->id, old('permissions'))) checked @endif
                                        />
                                        <span class="label-text mr-2">{{ $o['title'] }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('permissions')" />
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('افزودن') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
