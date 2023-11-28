<x-gotime-app-layout layout="{{ config('naykel.template') }}" hasContainer class="py-2">

    <h1>{{ $pageTitle ?? null }}</h1>

    <div class="flex gap-3">
        <livewire:users-table />
        <livewire:posts-table />
    </div>

</x-gotime-app-layout>
