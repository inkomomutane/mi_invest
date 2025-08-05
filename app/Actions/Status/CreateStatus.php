<?php

namespace App\Actions\Status;

use App\Data\StatusData;
use App\Models\Status;
use App\Models\User;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class CreateStatus
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

    public function handle(StatusData $statusData)
    {
        return Status::create($statusData->all());
    }

    public function rules()
    {
        return [
            'nome' => 'required|unique:statuses,nome',
        ];
    }

    public function __invoke(Request $request)
    {
        $validated = $request->validate($this->rules());
        
        try {
            $this->handle(StatusData::from($validated));
            flash()->addSuccess(__('messages.status_created_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.status_create_error'));
        }

        return \redirect()->back();
    }
}
