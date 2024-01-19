<x-gt-modal wire:model="showModal">
    <form wire:submit="save">
        <x-gt-input wire:model.blur="form.title" for="form.title" label="title" />
        <x-gt-textarea wire:model="form.description" for="form.description" label="description" />
        <div class="flex va-c">
            <x-gt-button wire:click="$toggle('showModal')" text="Cancel" />
            <x-gt-submit class="primary ml-auto">
                Save
            </x-gt-submit>
            <div wire:loading wire:target="save" class="spinner sm ml"></div>
        </div>
    </form>
</x-gt-modal>
