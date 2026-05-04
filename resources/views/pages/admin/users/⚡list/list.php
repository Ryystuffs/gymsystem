<?php

use App\Http\Filter\UserFilter;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $searchName = '';
    public $startDate = '';
    public $endDate = '';

    #[Computed()]
    public function users()
    {
        return app(UserFilter::class)->getAccounts(
            $this->searchName,
            $this->startDate,
            $this->endDate
        );
    }

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->reset(['searchName', 'startDate', 'endDate']);
        $this->resetPage();
    }
};