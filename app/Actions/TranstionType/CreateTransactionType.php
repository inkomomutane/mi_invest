<?php

namespace App\Actions\TranstionType;

use App\Data\PropertyPurposeData;
use App\Models\PropertyPurpose;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class CreateTransactionType
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

    public function handle(PropertyPurposeData $transactionTypeData)
    {
        return PropertyPurpose::create($transactionTypeData->all());
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:property_fors,name',
            'slug_text' => 'required|unique:property_fors,slug_text',
        ];
    }

    public function __invoke(Request $request)
    {
        $this->handle(PropertyPurposeData::from($request->validated()));
        flash()->addSuccess(__('messages.action_success'));

        return \redirect()->back();
    }
}
