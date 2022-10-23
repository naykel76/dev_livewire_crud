<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# NAYKEL CRUD Application Sample Project

This sample project

## Round 1 - Set up

- [x] Create migration, model, and factory, then seed data
- [x] Create livewire data table component and view
- [x] Add livewire component to home page
- [x] Update render method to return projects with pagination
- [x] Update view to display basic data table and pagination

## Round 2 - Search and Sort

- [x] Add search macro to `AppServiceProvider`
- [x] Add `sortField()` method to `Project::class`
- [x] Fix incorrect pagination component
- [x] Add search and sort properties
- [x] Update render method to include search and sort queries
- [x] Update view to use Gotime <th> components with sortable columns

Search macro must be included in the `boot()` method of the `AppServiceProvider`.

```php
use Illuminate\Database\Eloquent\Builder;

public function boot() {

    Builder::macro('search', function ($field, $string) {
        return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
    });

}
```

## Round 3 - Refactor for Re-Usability and Toolbar

- [x] Add WithSorting trait
- [x] Add dropdown to select `$searchField`
- [x] Add dropdown to select `$perPage`
- [x] Select search field
- [x] Add Gotime Search/Sort toolbar component


There are some issues surrounding the `$sortField` attribute. For now the `id` field has been set as the default search field to prevent the column not found error.

The toolbar component comes from `naykel/gotime` package. For reference it look something like this:

```html
<div class="flex space-x-2">

    <x-gt-control.input wire:model="search" for="search" placeholder="Search {{ $searchField }}..." />

    <div class="flex va-c">
        <label class="mr-075">Search By</label>
        <x-gt-control.select wire:model="searchField" for="searchField">
            @foreach($searchOptions as $option)
                <option value="{{ $option }}">{{ Str::title($option) }}</option>
            @endforeach
        </x-gt-control.select>
    </div>

    <div class="flex va-c">
        <label class="mr-075">Items per page: </label>
        <x-gt-control.select wire:model="perPage" for="perPage">
            @foreach($paginateOptions as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </x-gt-control.select>
    </div>

</div>
```

## Round 4 - CRUD Functions and Modal

- [x] Add 'status' options to project model
- [x] add crud functions
- [x] Create edit/add form
- [x] Move form to Gotime modal
- [x] Add new button
- [x] Save button
- [x] Cancel function

```php
/**
* Create a instance of the model to avoid errors and set
* default values, but do not persist it to the database.
*/
public function makeBlankTransaction()
{
    return Project::make(['key' => 'value']);
}
```

## Round 5 - Trix Editor and Upload Image

- [x] Trix editor (Gotime component)
- [x] Add file upload for main image
- [x] Create storage disc and update model
- [x] Handle file function to manage storage and deleting
- [x] Notify on save and update (emits to gotime component)
- [x] Confirm on delete

For realtime upload validation move the validation logic from the `rules` array and use the Livewire `updated` hook.

```php
public function updatedMainImage() {
    $this->validate(['mainImage' => 'nullable|image|max:1000']);
}
```

Emitted message us the notification component from `naykel/gotime` package. For reference it look something like this:

```html
<div x-data="{ show: false, message: '' }" x-show="show"
    x-on:notify.window="show = true; message = $event.detail; setTimeout(() => { show = false }, 3000)">

    <div class="fixed pos-b pos-r mxy flex va-c space-between bx minw300">
        <x-gotime::icon icon="tick-round" class="fs0 txt-green" />
        <div x-text="message" class="mx"></div>
        <x-gotime::icon icon="close" class="fs0 close" @click="show = false" />
    </div>

</div>
```

## Round 6 - Refactor CRUD Functions

- [x] WithCrudTrait
- [x] Change WithSorting trait to WithDataTable and include search logic
- [x] Add additional fields with date and currency
- [x] Update factory
- [x] Add currency casting

