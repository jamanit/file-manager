@extends('dashboard.layouts.main')
@push('title', 'Tambah Pengguna')

@section('content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumb title="Tambah Pengguna" :items="[['name' => 'Dashboard', 'url' => route('dashboard')], ['name' => 'Daftar Pengguna', 'url' => route('users.index')], ['name' => 'Tambah Pengguna']]" />

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
