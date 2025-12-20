<?php

namespace  App\Actions\Icon;
use App\Data\IconData;
use App\Models\Icon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Schema;

class IconSetSelect
{

    public function __invoke(Request $request): JsonResponse
    {
        $queryBuilder = Icon::query()->when($request->get('search'), function (Builder $query) use ($request) {
            $query->whereAny([
                'title',
                'tags',
                'categories',
                'lab',
            ],'like', '%' . $request->get('search') . '%');
        });

        $selected =  $this->getSelectedItem($request);

        $items = $queryBuilder->get()->take(25);

        if ($selected){
            $items->contains('id', $selected->id) ?: $items = collect([$selected])->merge($items);
        }

        return response()->json(IconData::collect($items)->values());
    }

    /**
     * @param Request $request
     * @return Icon|null
     */
    private function getSelectedItem(Request $request): ?Icon
    {
        if ($request->get('selected_key') && $request->get('selected_value') && in_array(strtolower($request->get('selected_key')), Schema::getColumnListing((new Icon())->getTable()), true)) {
            if (!$request->get('search') || $request->get('search') === '') {
                $selectedKey = $request->get('selected_key');
                $selectedValue = $request->get('selected_value');
                return Icon::where($selectedKey,$selectedValue)->first();
            }
        }
        return null;
    }
}
