<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithCrud;
use App\Models\Project;
use App\Http\Livewire\Traits\WithDataTable;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectTable extends Component
{
    use WithPagination, WithDataTable, WithFileUploads, WithCrud;

    public string $searchField = 'title'; // default search field
    public array $searchOptions = ['title', 'status']; // available search fields

    public bool $showModal;

    public $mainImage;

    /**
     * Primary resource model class
     * @var string
     */
    private static $model = Project::class;

    /**
     * Current model for editing
     * @var Project
     */
    public Project $editing;

    /**
     * Default values for blank model
     * @var string[]
     */
    protected $initialData = ['status' => 'draft'];


    public function rules()
    {
        return [
            'editing.id' => 'sometimes', // required for data binding
            'editing.title' => 'required|max:128',
            'editing.status' => 'sometimes|in:' . collect(Project::STATUS)->keys()->implode(','),
            'editing.sort_order' => 'nullable|integer',
            'editing.project_value' => 'nullable|numeric',
            'editing.description' => 'sometimes',
        ];
    }

    /**
     * Real time validation
     */
    public function updatedMainImage()
    {
        $this->validate(['mainImage' => 'nullable|image|max:1000']);
    }

    /**
     * Reset forms and close
     */
    public function cancel(): void
    {
        // this is a hacky way to reset the form!
        $this->editing = $this->makeBlankModel();
        $this->showModal = false;
    }

    /**
     * compare the database field to the uploaded file and perform
     * necessary file actions
     */
    public function handleMainImage(UploadedFile $file)
    {
        $dbField = $this->editing->image_name;

        tap($dbField, function ($previous) use ($file) {

            $this->editing->forceFill([
                'image_name' => $file->store('/', 'projects')
            ])->save();

            $previous ? Storage::disk('projects')->delete($previous) : null;
        });
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
