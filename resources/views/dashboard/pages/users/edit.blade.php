@extends('dashboard.layouts.main')
@push('title', 'Edit User')

@section('content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumb title="Edit User" :items="[['name' => 'Dashboard', 'url' => route('dashboard')], ['name' => 'Users', 'url' => route('users.index')], ['name' => 'Edit User']]" />

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <form action="{{ route('users.update', $user->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 spcace-y-4">
                            <x-form.input name="name" label="Name" placeholder="Enter name" value="{{ old('name', $user->name) }}" />
                            <x-form.input type="email" name="email" label="Email" placeholder="Enter email" value="{{ old('email', $user->email) }}" />
                            <x-form.input type="password" name="password" label="Password" placeholder="Enter password" />
                            <x-form.input type="password" name="password_confirmation" label="Password Confirmation" placeholder="Enter password confirmation" />
                            <x-form.select2 name="roles" label="Roles" :options="$roleOptions" :selected="old('roles', $selectedRoles)" :multiple="true" />
                        </div>

                        <div class="mt-4">
                            <x-form.button label="Save Changes" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
