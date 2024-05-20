@props(['hasError', 'label', 'labelId'])

<label for="{{ $labelId }}" class="text-sm {{ $hasError ? 'text-red-600' : 'text-gray-600' }}">
    {{ $label }}
</label>
