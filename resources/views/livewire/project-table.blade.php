<div>

    <div class="flex">
        <x-input wire:model="search" placeholder="Search projects..." />
    </div>

    <table class="fullwidth">

        <thead>

            <x-gt-table.th sortable wire:click="sortBy('title')" :direction="$sortBy === 'title' ? $sortDirection : null">Title</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortBy('status')" :direction="$sortBy === 'status' ? $sortDirection : null">Status</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortBy('sort_order')" :direction="$sortBy === 'sort_order' ? $sortDirection : null">Order</x-gt-table.th>
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
