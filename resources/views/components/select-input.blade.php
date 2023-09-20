@props(['disabled' => false, 'options' => [], 'value' => ''])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    @foreach($options as $o)
        <option @if($value == $o['id']) selected @endif value="{{ $o['id'] }}">{{ $o['name'] }}</option>
    @endforeach
</select>
