@props(['url', 'label' => 'Tambah'])

<a href="{{ $url }}" class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-xs font-semibold rounded hover:bg-blue-600 transition">
    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
    </svg>
    {{ $label }}
</a>
