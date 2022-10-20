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

    public Project $editing;
    public $showModal;

    public function rules()
    {
        return [
            'editing.title' => 'required|max:128',
            'editing.status' => 'sometimes|in:' . collect(Project::STATUS)->keys()->implode(','),
            'editing.sort_order' => 'nullable|integer',
            'editing.image_name' => 'sometimes',
            'editing.description' => 'sometimes',
            'editing.id' => 'sometimes' // this is solely for data binding
        ];
    }


    public function mount()
    {
        $this->editing = $this->makeBlankTransaction();
    }

    /**
     * Create blank transaction and set defaults.
     */
    public function create(): void
    {
        /**
         * if $editing has primary key, there is record from the
         * database in the current form so don't reset fields.
         */
        if ($this->editing->getKey()) $this->editing = $this->makeBlankTransaction();

        $this->showModal = true;
    }

    public function edit(Project $project)
    {
        // if the current $editing model is not equal to the
        // $project model passed in then override it, otherwise
        // leave it alone. isNot() helper compares two models
        if ($this->editing->isNot($project)) $this->editing = $project;

        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();
        $this->editing->save();
        $this->showModal = false;
    }

    public function delete($id): void
    {
        $project = Project::find($id);
        $project->delete();
    }

    /**
     * Reset forms and close
     */
    public function cancel(): void
    {
        // this is a hacky way to reset the form!
        $this->editing = $this->makeBlankTransaction();
        $this->showModal = false;
    }

    /**
     * Create instance of the model to avoid errors and set
     * default values, but do not persist to the database.
     */
    public function makeBlankTransaction()
    {
        return Project::make([]);
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

        $query = Project::search($this->searchField, $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.project-table')->with([
            'projects' => $query,
        ]);
    }
}
