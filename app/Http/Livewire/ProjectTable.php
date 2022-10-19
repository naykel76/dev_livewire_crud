<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectTable extends Component
{

    use WithPagination;

    public function render()
    {
        return view('livewire.project-table')->with([
            'projects' => Project::paginate(10),
        ]);
    }
}
