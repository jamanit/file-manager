@props(['url', 'label' => 'Hapus'])

<button type="button" onclick="openDeleteModal(this)" data-url="{{ $url }}" class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded hover:bg-red-600 transition">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M6 18L18 6M6 6l12 12" />
    </svg>
    {{ $label }}
</button>
