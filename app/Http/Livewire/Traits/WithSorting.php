<?php

namespace App\Http\Livewire\Traits;

trait WithSorting
{

    public $sortField = 'id'; // default field
    public $sortDirection = "asc";

    public function sortField($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

}
