<?php

namespace App\Actions\TranstionType;

use App\Models\PropertyPurpose;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTransactionType
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

    public function __invoke(PropertyFor $transactionType)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(PropertyPurpose::class, 'name')->ignore($transactionType->id, 'id')],
            'slug_text' => ['required', Rule::unique(PropertyPurpose::class, 'slug_text')->ignore($transactionType->id, 'id')],
        ]);

        try {
            $transactionType->name = $validated['name'];
            $transactionType->slug_text = $validated['slug_text'];
            $transactionType->save();
            flash()->addSuccess(__('messages.action_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
