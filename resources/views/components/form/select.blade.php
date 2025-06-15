@props([
    'label' => '',
    'name',
    'options' => [],
    'placeholder' => 'Select an option',
    'selected' => '',
])

@php
    $hasError = $errors->has($name);
    $baseClass = 'dark:bg-dark-900 shadow-theme-xs h-11 w-full appearance-none rounded-lg bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30';
    $defaultBorderClass = 'border border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800';
    $errorBorderClass = 'border border-error-300 focus:border-error-300 focus:ring-error-500/10 dark:border-error-700 dark:focus:border-error-800';
    $selectClass = $baseClass . ' ' . ($hasError ? $errorBorderClass : $defaultBorderClass);
@endphp

<div class="space-y-1">
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            {{ $label }}
        </label>
    @endif

    <div x-data="{ isOptionSelected: '{{ $selected }}' !== '' }" class="relative z-20">
        <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => $selectClass]) }} :class="isOptionSelected && 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = $event.target.value !== ''">
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $key => $value)
                <option value="{{ $key }}" @selected($selected == $key) class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">{{ $value }}</option>
            @endforeach
        </select>

        <span class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
            <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    </div>

    @error($name)
        <span class="text-theme-xs text-error-500">{{ $message }}</span>
    @enderror
</div>
