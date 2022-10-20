<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectTable extends Component
{

    use WithPagination;

    public string $search = '';
    public string $searchBy = 'title'; // default search field

    public $sortBy = "title";
    public $sortDirection = "asc";

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }

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
        return view('livewire.project-table')->with([
            'projects' => Project::search($this->searchBy, $this->search)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate(10),
        ]);
    }
}
