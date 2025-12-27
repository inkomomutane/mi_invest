<?php

namespace App\Actions\City;

use App\Data\CityData;
use App\Models\City;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Schema;

class GetCitiesJson
{

    public function __invoke(Request $request): JsonResponse
    {
        $queryBuilder = City::query()->when($request->get('search'), function (Builder $query) use ($request) {
            $query->whereAny([
                'name',
            ],'like', '%' . $request->get('search') . '%');
        });

        $selected =  $this->getSelectedItem($request);

        $items = $queryBuilder->get()->take(25);

        if ($selected){
            $items->contains('id', $selected->id) ?: $items->add($selected);
        }
        return response()->json(CityData::collect($items)->sortBy('name')->values());
    }

    /**
     * @param Request $request
     * @return City|null
     */
    private function getSelectedItem(Request $request): ?City
    {
        if ($request->get('selected_key') && $request->get('selected_value') && in_array(strtolower($request->get('selected_key')), Schema::getColumnListing((new City)->getTable()), true)) {
            if (!$request->get('search') || $request->get('search') === '') {
                $selectedKey = $request->get('selected_key');
                $selectedValue = $request->get('selected_value');
                return City::where($selectedKey,$selectedValue)->first();
            }
        }
        return null;
    }
}
