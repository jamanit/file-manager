@props(['url', 'label' => 'Lihat'])

<a href="{{ $url }}" class="inline-flex items-center px-3 py-1.5 bg-blue-light-500 text-white text-xs font-semibold rounded hover:bg-blue-light-600 transition">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>
    {{ $label }}
</a>
