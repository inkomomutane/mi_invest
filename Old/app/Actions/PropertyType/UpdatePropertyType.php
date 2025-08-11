<?php

namespace App\Actions\PropertyType;

use App\Models\PropertyType;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class UpdatePropertyType
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

    public function rules(): array
    {
        return [
            'nome' => 'required|string',
            'images' => '',
            'images.*' => 'image|max:15360',
        ];
    }

    public function __invoke(PropertyType $propertyType, Request $actionRequest)
    {

        $propertyType->nome = $actionRequest->nome;
        $propertyType->save();

        try {
            if ($actionRequest->file('images')) {

                foreach ($actionRequest->file('images') as $key => $file) {
                    $propertyType->addMedia($file)
                        ->toMediaCollection('icons');
                }
            }

            flash()->addSuccess(__('messages.action_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
