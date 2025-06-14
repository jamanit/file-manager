@props(['url', 'label' => 'Ubah'])

<a href="{{ $url }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-semibold rounded hover:bg-yellow-600 transition">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487a2.06 2.06 0 112.915 2.915L7.5 19.68l-4 1 1-4 12.362-12.193z" />
    </svg>
    {{ $label }}
</a>
