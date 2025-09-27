<?php

namespace App\Actions\Status;

use App\Data\StatusData;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateStatus
{

    public function handle(StatusData $status): Status
    {
        return Status::create($status->all());
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:statuses,name',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle(StatusData::from($request->validate($this->rules())));
        flash()->addSuccess(__('messages.status_created_success'));
        return \redirect()->back();
    }
}
