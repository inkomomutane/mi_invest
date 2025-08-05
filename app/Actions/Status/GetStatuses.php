<?php

namespace App\Actions\Status;

use App\Data\StatusData;
use App\Models\Status;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetStatuses
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
        return StatusData::collect(
            Status::query()
                ->when($term, function ($query, $search) {
                    $query->where('nome', 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Status/Index', [
            'statuses' => $this->handle(request()->search),
        ]);
    }
}
