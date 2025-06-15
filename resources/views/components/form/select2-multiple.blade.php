@props([
    'label' => '',
    'name',
    'options' => [],
    'selected' => [],
])

@php
    $fieldId = Str::slug($name, '_');
    $hasError = $errors->has($name);

    $baseClass = 'dark:bg-dark-900 shadow-theme-xs h-11 w-full appearance-none rounded-lg bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30';
    $defaultBorderClass = 'border border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800';
    $errorBorderClass = 'border border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800';

    $selectClass = $baseClass . ' ' . ($hasError ? $errorBorderClass : $defaultBorderClass);
@endphp

<div>
    <label for="{{ $fieldId }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
        {{ $label }}
    </label>

    <select id="{{ $fieldId }}" name="{{ $name }}[]" {{ $attributes->merge(['class' => 'select2 ' . $selectClass]) }} multiple>
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}" @if (in_array($option['value'], $selected)) selected @endif>
                {{ $option['text'] }}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="mt-1 text-sm text-red-600 dark:text-red-400">
            {{ $message }}
        </div>
    @enderror
</div>

@once
    @push('styles')
        <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: 'Select an option',
                    width: '100%'
                });
            });
        </script>
    @endpush
@endonce
