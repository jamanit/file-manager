@props([
    'type' => 'submit',
    'label' => 'Submit',
    'color' => 'brand',
])

@php
    $colors = [
        'brand' => ['bg' => 'bg-brand-500', 'hover' => 'hover:bg-brand-600', 'text' => 'text-white'],
        'error' => ['bg' => 'bg-error-500', 'hover' => 'hover:bg-error-600', 'text' => 'text-white'],
        'warning' => ['bg' => 'bg-warning-500', 'hover' => 'hover:bg-warning-600', 'text' => 'text-white'],
        'success' => ['bg' => 'bg-success-500', 'hover' => 'hover:bg-success-600', 'text' => 'text-white'],
        'blue' => ['bg' => 'bg-blue-500', 'hover' => 'hover:bg-blue-600', 'text' => 'text-white'],
        'blue-light' => ['bg' => 'bg-blue-light-500', 'hover' => 'hover:bg-blue-light-600', 'text' => 'text-white'],
        'gray' => ['bg' => 'bg-gray-500', 'hover' => 'hover:bg-gray-600', 'text' => 'text-white'],
        'orange' => ['bg' => 'bg-orange-500', 'hover' => 'hover:bg-orange-600', 'text' => 'text-white'],
    ];

    $selected = $colors[$color] ?? $colors['brand'];

    $buttonClass = "{$selected['bg']} {$selected['hover']} {$selected['text']} px-4 py-2.5 text-sm font-medium rounded-lg focus:outline-none transition inline-flex items-center";
@endphp

<button type="{{ $type }}" x-data="{ loading: false }" x-on:click.prevent="
        if (!loading) {
            loading = true;
            $nextTick(() => $el.form?.requestSubmit());
        }
    " x-bind:disabled="loading" x-bind:class="{ 'opacity-50 cursor-not-allowed': loading }" {{ $attributes->merge(['class' => $buttonClass]) }}>
    <svg x-show="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
    </svg>

    <span x-show="!loading">{{ $label }}</span>
    <span x-show="loading">Loading...</span>
</button>
