@props(['label' => false, 'name', 'type' => 'text'])
<div class="space-y-2">
    @if ($label)
        <label for="{{ $name }}" class="label">{{ $label }}</label>
    @endif

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" {{ $attributes }}
            class="textarea focus:ring-1 ring-primary" value="{{ old($name) }}"></textarea>
    @else
        <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name) }}"
            class="input focus:ring-1 ring-primary" {{ $attributes }} />
    @endif
    <x-form.error name="{{ $name }}" />
</div>
