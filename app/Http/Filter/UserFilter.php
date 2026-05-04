<?php

namespace App\Http\Filter;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserFilter 
{
    public function getAccounts(
        ?string $searchName = '',
        ?string $startDate = '',
        ?string $endDate = ''
    ): LengthAwarePaginator
    {
        return User::select('id', 'name', 'email', 'role', 'created_at')
        ->when($searchName, function ($q) use ($searchName) {
            $q->where('name', 'LIKE', '%' . $searchName . '%');
        })
            ->when($startDate, function ($q) use ($startDate) {
                $q->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($q) use ($endDate) {
                $q->whereDate('created_at', '<=', $endDate);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}