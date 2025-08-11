<?php

namespace App\Actions\Legal;

use App\Data\PolicyData;
use App\Models\Politica;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class UpdatePolicy
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

    public function handle(PolicyData $policy)
    {
        try {
            $politica = Politica::first();
            $politica->politicas = $policy->politicas;
            $politica->save();
            flash()->addSuccess(__('messages.action_success'));

            return $politica->getData();
        } catch (\Throwable $e) {
            flash()->addError(__('messages.action_error'));

            return $politica->getData();
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'politicas' => 'string|nullable',
        ];
    }

    public function __invoke(Request $actionRequest)
    {
        $this->handle(new PolicyData($actionRequest->politicas));

        return redirect()->back();
    }
}
