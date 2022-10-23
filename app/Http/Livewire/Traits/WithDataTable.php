<?php

namespace App\Http\Livewire\Traits;

trait WithDataTable
{

    public string $search = '';

    public $sortField = 'id'; // default field
    public $sortDirection = "asc";

    public int $perPage = 10;
    public array $paginateOptions = [10, 25, 50, 100];


    public function sortField($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    /**
     *  Return to first page after search updated
     */
    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }
}
