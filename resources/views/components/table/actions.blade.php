<div class="flex items-center gap-1">
    @isset($permissionBase)
        @can($permissionBase . ' edit')
            <x-table.buttons.edit :url="$editUrl" />
        @endcan
        @can($permissionBase . ' delete')
            <x-table.buttons.delete :url="$deleteUrl" />
        @endcan
    @endisset
</div>
