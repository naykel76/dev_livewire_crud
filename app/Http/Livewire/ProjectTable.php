<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Http\Livewire\Traits\WithSorting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectTable extends Component
{
    use WithPagination, WithSorting, WithFileUploads;

    public string $search = '';
    public string $searchField = 'title'; // default search field
    public array $searchOptions = ['title', 'status']; // available search fields
    public int $perPage = 10;
    public array $paginateOptions = [10, 25, 50, 100];
    public Project $editing;
    public bool $showModal;
    public $mainImage;

    public function rules()
    {
        return [
            'editing.id' => 'sometimes', // require for data binding
            'editing.title' => 'required|max:128',
            'editing.status' => 'sometimes|in:' . collect(Project::STATUS)->keys()->implode(','),
            'editing.sort_order' => 'nullable|integer',
            'editing.description' => 'sometimes',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankTransaction();
    }

    /**
     * Real time validation
     */
    public function updatedMainImage()
    {
        $this->validate(['mainImage' => 'nullable|image|max:1000']);
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
        $this->editing->forceFill([])->save();
        $this->mainImage ? $this->handleUpload($this->mainImage) : null;
        $this->showModal = false;

        $this->dispatchBrowserEvent('notify', 'Profile saved!');
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
     * compare the database field to the uploaded file and perform
     * necessary file actions
     */
    public function handleUpload(UploadedFile $file)
    {
        $dbField = $this->editing->image_name;

        tap($dbField, function ($previous) use ($file) {

            $this->editing->forceFill([
                'image_name' => $file->store('/', 'projects')
            ])->save();

            $previous ? Storage::disk('projects')->delete($previous) : null;
        });
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
