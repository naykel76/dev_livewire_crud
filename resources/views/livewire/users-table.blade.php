<div>
    <div class="fg1">
        <div class="flex space-between va-c">
            <h1>Users Table</h1>
            <x-gt-button text="New user" class="primary xs"
                wire:click.prevent="$dispatchTo('user-create-edit', 'create')" />
        </div>
        <div class="overflow-x-auto rounded-lg bdr">
            <table>
                <thead class="txt-upper bdr-b">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </thead>
                <tbody wire:loading.class="txt-muted" class="divide-y">
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="space-x-05 whitespace-nowrap">
                                <x-gt-button text="edit" class="link"
                                    wire:click.prevent="dispatchTo('user-create-edit', 'edit', {id: {{ $user->id }}})" />
                                <x-gt-button wire:confirm="Are you sure you want to delete this user?"
                                    wire:click.prevent="delete({{ $user->id }})" text="delete" class="link txt-red" />
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
    </div>
    <!-- Modal -->
    <livewire:user-create-edit @notify="$refresh" />
</div>
