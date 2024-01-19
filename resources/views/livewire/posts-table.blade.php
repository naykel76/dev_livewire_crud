<div>
    <div class="flex space-between va-c">
        <h1>Posts Table</h1>
        <x-gt-button text="New post" class="primary xs"
            wire:click.prevent="$dispatchTo('post-create-edit', 'create')" />
    </div>
    <div class="overflow-x-auto rounded-lg bdr">
        <table>
            <thead class="txt-upper bdr-b">
                <th>Title</th>
                <th>Description</th>
                <th></th>
            </thead>
            <tbody wire:loading.class="txt-muted" class="divide-y">
                @forelse($posts as $post)
                    <tr>
                        <td>{{ str($post->title)->limit(15) }}</td>
                        <td>{{ str($post->description)->limit(30) }}</td>
                        <td class="space-x-05 whitespace-nowrap">
                            <x-gt-button text="edit" class="link"
                                wire:click.prevent="dispatchTo('post-create-edit', 'edit', {id: {{ $post->id }}})" />
                            <x-gt-button wire:confirm="Are you sure you want to delete this post?"
                                wire:click.prevent="delete({{ $post->id }})" text="delete" class="link txt-red" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="tac pxy" colspan="6">No records found...</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <livewire:post-create-edit @notify="$refresh" />
</div>
