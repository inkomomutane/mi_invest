<?php

namespace App\Actions\TranstionType;

use App\Data\PropertyPurposeData;
use App\Models\PropertyPurpose;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetTransactionTypes
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function handle(?string $term = null)
    {
        return PropertyPurposeData::collect(
            PropertyPurpose::query()
                ->when($term, function ($query, $search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('TransactionType/Index', [
            'transactionTypes' => $this->handle(request()->search),
        ]);
    }
}
