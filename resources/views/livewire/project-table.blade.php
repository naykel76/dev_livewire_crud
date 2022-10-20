<div>

    <x-gt-search-sort-toolbar :searchField="$searchField" :searchOptions="$searchOptions" :paginateOptions="$paginateOptions"/>

    <table class="fullwidth">

        <thead>

            <x-gt-table.th sortable wire:click="sortField('title')" :direction="$sortField === 'title' ? $sortDirection : null">Title</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('status')" :direction="$sortField === 'status' ? $sortDirection : null">Status</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('sort_order')" :direction="$sortField === 'sort_order' ? $sortDirection : null">Order</x-gt-table.th>
            <x-gt-table.th>Image</x-gt-table.th>

        </thead>

        <tbody>

            @forelse($projects as $project)

                <tr wire:loading.class.delay="txt-muted">
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->sort_order }}</td>
                    <td>{{ $project->image_name }}</td>
                </tr>

            @empty

                <tr>
                    <td class="tac pxy txt-lg" colspan="6">No records found...</td>
                </tr>

            @endforelse

        </tbody>

    </table>

    {{ $projects->links('gotime::pagination.livewire') }}

</div>
