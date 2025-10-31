<?php

namespace App\Actions\TransactionType;


use App\Data\TransactionTypeData;
use App\Models\TransactionType;
use App\Models\User;
use App\Enums\SystemRoles;
use Inertia\Inertia;

class GetTransactionTypes
{

    public function authorize(User $user): bool
    {
        return true;
        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function handle(?string $term = null):mixed
    {
        return TransactionTypeData::collect(
            TransactionType::query()
                ->when($term, function ($query, $search) {
                    $query->whereAny(['name','prefix'], 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        abort_if(!$this->authorize(auth()->user()), 403);
        return Inertia::render('TransactionType/Index', [
            'transactionTypes' => $this->handle(request()->search),
        ]);
    }
}
