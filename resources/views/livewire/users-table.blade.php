<div class="flex va-t gap-5">
    <div class="fg1">
        <div class="flex space-between va-c">
            <h1>Users Table</h1>
            <x-gt-button wire:click.prevent="add" text="New user" class="primary xs" />
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
                            <td class="space-x">
                                <x-gt-button wire:click.prevent="edit({{ $user->id }})" text="edit" class="link" />
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

    <div class="w-24">
        <form wire:submit="save">
            <div class="bx">
                <x-gt-input wire:model.blur="form.name" for="form.name" label="name" />
                <x-gt-input wire:model.blur="form.email" for="form.email" label="email" />
                <div class="flex va-c">
                    <x-gt-submit class="primary" />
                    <div wire:loading wire:target="save" class="spinner ml"></div>
                </div>
            </div>
        </form>
    </div>

</div>
