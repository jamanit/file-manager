@extends('dashboard.layouts.main')
@push('title', 'Users')

@section('content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumb title="Users" :items="[['name' => 'Dashboard', 'url' => route('dashboard')], ['name' => 'Users']]" />

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-end">
                    <x-table.buttons.add :url="route('users.create')" />
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <div class="overflow-x-auto">
                        <x-table.datatable :columns="[['text' => 'No.', 'class' => 'w-0'], ['text' => 'Name'], ['text' => 'Email'], ['text' => 'Role'], ['text' => 'Actions', 'class' => 'text-center w-0']]" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        class: 'whitespace-nowrap',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'name',
                        name: 'name'
                    }, {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role_name',
                        name: 'role_name'
                    }, {
                        data: 'actions',
                        name: 'actions',
                        class: 'text-center whitespace-nowrap',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
