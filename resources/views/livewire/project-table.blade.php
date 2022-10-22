<div>

    <x-gt-modal wire:model="showModal" maxWidth="xl">
        <div class="flex space-between va-c">
            <div class="bx-title">Edit/Add Project</div>
            <x-gotime-icon wire:click="$toggle('showModal')" icon="close" class="close sm" />
        </div>

        <form wire:submit.prevent="save">

            <div class="grid cols-75:25">

                <div class="bdr-r pr">
                    <div class="bx light">
                        <div class="flex gg">
                            <x-gt-input wire:model.defer="editing.id" for="editing.id" label="ID" rowClass="w-5" disabled />
                            <x-gt-input wire:model.defer="editing.title" for="editing.title" label="Title" rowClass="fg1" />
                        </div>
                        <x-gt-trix wire:model.lazy="editing.description" for="editing.description" label="Description" />
                    </div>
                </div>

                <div>
                    <x-gt-select wire:model.defer="editing.status" for="editing.status" label="Status" placeholder="Please Select...">
                        @foreach(\App\Models\Project::STATUS as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-gt-select>

                    <x-gt-input wire:model.defer="editing.sort_order" for="editing.sort_order" label="Sort Order" />

                    <div class="bx">
                        @if($mainImage)
                            <img src="{{ $mainImage->temporaryUrl() }}" alt="{{ $editing->title ?? null }}">
                        @else
                            <img src="{{ $editing->mainImageUrl() }}" alt="{{ $editing->title ?? null }}">
                        @endif
                    </div>

                    <div class="tac">
                        <x-gt-control.file wire:model="mainImage" for="mainImage" buttonText="Select Image" />
                    </div>
                </div>

            </div>
        </form>
        <button wire:click="save()" class="btn primary">Save</button>
        <button wire:click="cancel()" class="btn">Cancel</button>
    </x-gt-modal>

    <div class="tar mb">
        <button wire:click="create" class="btn primary">
            <x-iconit.plus-round-o class="mr-05" />Add New</button>
    </div>

    <div class="bx">
        <x-gt-search-sort-toolbar :searchField="$searchField" :searchOptions="$searchOptions" :paginateOptions="$paginateOptions" />
    </div>

    <table class="fullwidth">

        <thead>

            <x-gt-table.th sortable wire:click="sortField('title')" :direction="$sortField === 'title' ? $sortDirection : null">Title</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('status')" :direction="$sortField === 'status' ? $sortDirection : null">Status</x-gt-table.th>
            <x-gt-table.th sortable wire:click="sortField('sort_order')" :direction="$sortField === 'sort_order' ? $sortDirection : null">Order</x-gt-table.th>
            <x-gt-table.th>Image</x-gt-table.th>
            <x-gt-table.th></x-gt-table.th>

        </thead>

        <tbody>
            @forelse($projects as $project)

                <tr wire:loading.class.delay="txt-muted">
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->sort_order }}</td>
                    <td>{{ $project->image_name }}</td>
                    <td class="tar txt-sm">
                        <a wire:click="edit({{ $project->id }})">edit</a>
                        <a wire:click="delete({{ $project->id }})" onclick="confirm('Are you sure?')" class="txt-red ml-05">delete</a>
                    </td>
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
