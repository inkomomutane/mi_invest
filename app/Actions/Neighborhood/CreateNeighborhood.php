<?php

namespace App\Actions\Neighborhood;

use App\Models\Neighborhood;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateNeighborhood
{

    public function handle(array $neighborhood): Neighborhood
    {
        return Neighborhood::create($neighborhood);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:neighborhoods,name',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle($request->validate($this->rules()));
        flash()->addSuccess(__('messages.neighborhood_created_success'));

        return \redirect()->back();
    }
}
