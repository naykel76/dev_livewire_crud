<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Http\Livewire\DataTable\WithSorting;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectTable extends Component
{

    use WithPagination, WithSorting;

    public string $search = '';
    public string $searchField = 'title'; // default search field
    public $searchOptions = ['title', 'status']; // available search fields

    public $perPage = 10;
    public $paginateOptions = [10, 25, 50, 100];

    /**
     *  Return to first page after search updated
     */
    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        sleep(1);

        $query = Project::search($this->searchField, $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.project-table')->with([
            'projects' => $query,
        ]);
    }
}
