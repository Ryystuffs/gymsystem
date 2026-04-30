<?php

use App\Services\AccountService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $searchName;
    public $startDate;
    public $endDate;

    protected AccountService $accountService;

    public function boot(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    #[Computed()]
    public function users(): LengthAwarePaginator
    {
        dump($this->searchName, $this->startDate, $this->endDate);
        return $this->accountService->getAccounts(
            $this->searchName,
            $this->startDate,
            $this->endDate   
        );

        
    }

    public function resetFilter()
    {
        $this->searchName = '';
        $this->startDate = '';
        $this->endDate = '';
    }

    public function tableFilter()
    {
        $this->resetPage();
    }
};