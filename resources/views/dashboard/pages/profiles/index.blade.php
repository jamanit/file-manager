@extends('dashboard.layouts.main')
@push('title', 'Profile')

@section('content')
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <x-breadcrumb title="Profile" :items="[['name' => 'Dashboard', 'url' => route('dashboard')], ['name' => 'Profile']]" />

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] lg:p-6">
                    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
                            <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
                                <div class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full dark:border-gray-800">
                                    <img src="{{ asset('/') }}assets/images/user.png" alt="user" />
                                </div>
                                <div class="order-3 xl:order-2">
                                    <h4 class="mb-2 text-lg font-semibold text-center text-gray-800 dark:text-white/90 xl:text-left">
                                        {{ auth()->user()->name }}
                                    </h4>
                                    <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ auth()->user()->email }}
                                        </p>
                                        <div class="hidden h-3.5 w-px bg-gray-300 dark:bg-gray-700 xl:block"></div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ auth()->user()->getRoleNames()->implode(', ') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center order-2 gap-2 grow xl:order-3 xl:justify-end">
                                    <a href="{{ route('logout') }}" class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 lg:inline-flex lg:w-auto">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M15.1007 19.247C14.6865 19.247 14.3507 18.9112 14.3507 18.497L14.3507 14.245H12.8507V18.497C12.8507 19.7396 13.8581 20.747 15.1007 20.747H18.5007C19.7434 20.747 20.7507 19.7396 20.7507 18.497L20.7507 5.49609C20.7507 4.25345 19.7433 3.24609 18.5007 3.24609H15.1007C13.8581 3.24609 12.8507 4.25345 12.8507 5.49609V9.74501L14.3507 9.74501V5.49609C14.3507 5.08188 14.6865 4.74609 15.1007 4.74609L18.5007 4.74609C18.9149 4.74609 19.2507 5.08188 19.2507 5.49609L19.2507 18.497C19.2507 18.9112 18.9149 19.247 18.5007 19.247H15.1007ZM3.25073 11.9984C3.25073 12.2144 3.34204 12.4091 3.48817 12.546L8.09483 17.1556C8.38763 17.4485 8.86251 17.4487 9.15549 17.1559C9.44848 16.8631 9.44863 16.3882 9.15583 16.0952L5.81116 12.7484L16.0007 12.7484C16.4149 12.7484 16.7507 12.4127 16.7507 11.9984C16.7507 11.5842 16.4149 11.2484 16.0007 11.2484L5.81528 11.2484L9.15585 7.90554C9.44864 7.61255 9.44847 7.13767 9.15547 6.84488C8.86248 6.55209 8.3876 6.55226 8.09481 6.84525L3.52309 11.4202C3.35673 11.5577 3.25073 11.7657 3.25073 11.9984Z"
                                                fill="" />
                                        </svg>
                                        Sign out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
                                    Personal Information
                                </h4>

                                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
                                    <div>
                                        <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                            Name
                                        </p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                            {{ auth()->user()->name }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                            Email
                                        </p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                            {{ auth()->user()->email }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                                            Roles
                                        </p>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                                            {{ auth()->user()->getRoleNames()->implode(', ') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @can('profiles edit')
                                <button @click="isProfileInfoModal = true" class="flex w-full items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200 lg:inline-flex lg:w-auto">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                            fill="" />
                                    </svg>
                                    Edit
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.pages.profiles.profile-info-modal')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
