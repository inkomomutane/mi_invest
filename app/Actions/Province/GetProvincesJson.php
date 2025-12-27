<?php

namespace App\Actions\Province;

use App\Data\ProvinceData;
use App\Models\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Schema;

class GetProvincesJson
{

    public function __invoke(Request $request): JsonResponse
    {
        $queryBuilder = Province::query()->when($request->get('search'), function (Builder $query) use ($request) {
            $query->whereAny([
                'name',
            ],'like', '%' . $request->get('search') . '%');
        });

        $selected =  $this->getSelectedItem($request);

        $items = $queryBuilder->get()->take(25);

        if ($selected){
            $items->contains('id', $selected->id) ?: $items->add($selected);
        }
        return response()->json(ProvinceData::collect($items)->sortBy('name')->values());
    }

    /**
     * @param Request $request
     * @return Province|null
     */
    private function getSelectedItem(Request $request): ?Province
    {
        if ($request->get('selected_key') && $request->get('selected_value') && in_array(strtolower($request->get('selected_key')), Schema::getColumnListing((new Province)->getTable()), true)) {
            if (!$request->get('search') || $request->get('search') === '') {
                $selectedKey = $request->get('selected_key');
                $selectedValue = $request->get('selected_value');
                return Province::where($selectedKey,$selectedValue)->first();
            }
        }
        return null;
    }
}
