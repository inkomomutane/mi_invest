<?php

namespace App\Actions\Legal;

use App\Data\TermAndConditionData;
use App\Models\Termo;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class UpdateTermAndCondition
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

    public function handle(TermAndConditionData $term)
    {
        try {
            $termo = Termo::first();
            $termo->termos = $term->term;
            $termo->save();
            flash()->addSuccess(__('messages.action_success'));

            return $termo->getData();
        } catch (\Throwable $e) {
            flash()->addError(__('messages.action_error'));

            return $termo->getData();
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
            'termos' => 'string|nullable',
        ];
    }

    public function __invoke(Request $actionRequest)
    {
        $this->handle(new TermAndConditionData($actionRequest->termos));

        return redirect()->back();
    }
}
