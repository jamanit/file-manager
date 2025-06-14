@props([
    'id' => 'dataTable',
    'columns' => [],
])

<div class="overflow-x-auto">
    <table class="py-2 min-w-full text-sm text-left divide-y divide-gray-200 dark:divide-gray-700" id="{{ $id }}">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                @foreach ($columns as $col)
                    <th class="px-4 py-3 font-semibold text-gray-700 dark:text-white {{ $col['class'] ?? '' }}">
                        {{ $col['text'] }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-100 dark:divide-gray-800 text-gray-700 dark:text-gray-100"></tbody>
    </table>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/jquery/jquery.dataTables.min.css">
    <style>
        body.dark .dataTables_wrapper select,
        body.dark .dataTables_wrapper input[type="search"] {
            background-color: #111827 !important;
            /* bg-gray-900 */
            color: #ffffff !important;
            border: 1px solid #374151 !important;
            /* border-gray-700 */
        }

        body.dark .dataTables_wrapper .dataTables_length,
        body.dark .dataTables_wrapper .dataTables_filter,
        body.dark .dataTables_wrapper .dataTables_info,
        body.dark .dataTables_wrapper .dataTables_paginate {
            color: #ffffff !important;
        }

        body.dark .dataTables_wrapper .dataTables_paginate .paginate_button {
            background-color: #1f2937 !important;
            /* bg-gray-800 */
            color: #ffffff !important;
            border: none;
        }

        body.dark .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #374151 !important;
            /* bg-gray-700 */
            color: #ffffff !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('/') }}assets/jquery/jquery.dataTables.min.js"></script>
@endpush
