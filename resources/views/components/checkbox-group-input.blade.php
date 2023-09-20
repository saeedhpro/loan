@props(['options' => [], 'permissions' => [], 'name' => ''])

<div {{ $attributes->merge([]) }}>
    @foreach($options as $o)
        <div class="form-control">
            <label class="cursor-pointer label">
                <input type="checkbox" id="{{ "checkbox".$o->id }}" value="{{ $o->id }}" name="{{ $name }}" class="checkbox checkbox-success" />
                <span class="label-text mr-2">{{ $o['title'] }}</span>
            </label>
        </div>
    @endforeach
</div>
