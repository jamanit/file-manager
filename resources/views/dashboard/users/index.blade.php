@extends('dashboard.layouts.main')
@push('title', 'Daftar Pengguna')

@section('content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumb title="Daftar Pengguna" :items="[['name' => 'Dashboard', 'url' => route('dashboard')], ['name' => 'Daftar Pengguna']]" />

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-end">
                    <x-table.buttons.add :url="route('users.create')" />
                </div>
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <div class="overflow-x-auto">
                        <x-table.datatable :columns="[['text' => 'No.', 'class' => 'w-0'], ['text' => 'Nama'], ['text' => 'Email'], ['text' => 'Peran'], ['text' => 'Aksi', 'class' => 'text-center w-0']]" />
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
                        data: 'email',
                        name: 'email'
                    }, {
                        data: 'uuid',
                        class: 'whitespace-nowrap',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let editRoute = "{{ route('users.edit', ':uuid') }}".replace(':uuid', data);
                            let deleteRoute = "{{ route('users.destroy', ':uuid') }}".replace(':uuid', data);
                            return `
                                <div class="flex items-center gap-2"> 
                                    @component('components.table.buttons.edit', ['url' => '__EDIT__']) Ubah @endcomponent
                                    @component('components.table.buttons.delete', ['url' => '__DELETE__']) Hapus @endcomponent
                                </div>
                            `.replace('__EDIT__', editRoute).replace('__DELETE__', deleteRoute);
                        }
                    }
                ]
            });
        });
    </script>
@endpush
