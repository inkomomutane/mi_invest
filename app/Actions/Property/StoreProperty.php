<?php

namespace App\Actions\Property;

use App\Models\Property;
use Illuminate\Http\Request;

class StoreProperty
{

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|unique:properties,titulo',
            'descricao' => 'string|nullable',
            'details' => 'string|nullable',
            'slug' => 'string|nullable',
            'banheiros' => 'numeric|nullable',
            'preco' => 'string|nullable',
            'ano' => 'numeric|nullable',
            'andares' => 'numeric|nullable',
            'area' => 'numeric|nullable',
            'quartos' => 'numeric|nullable',
            'suites' => 'numeric|nullable',
            'garagens' => 'numeric|nullable',
            'piscinas' => 'numeric|nullable',
            'endereco' => 'string|nullable',
            'mapa' => 'string|nullable',
            'published_at' => 'nullable',
            'views' => 'nullable|numeric',
            'neighborhood_id' => 'required|numeric',
            'condition_id' => 'required|numeric',
            'tipo_de_property_id' => 'required|numeric',
            'status_id' => 'numeric|required',
            'broker_id' => 'numeric|nullable',
            'property_for_id' => 'required|numeric',
            'regra_de_business_id' => 'required|numeric',
            'intermediation_rule_id' => 'required|numeric',
        ];
    }

    public function __invoke(Request $actionRequest)
    {
        $data = collect($actionRequest->all())
            ->put('broker_id', $actionRequest->user()->id)
            ->put('published_at', now())
            ->except('images')->toArray();
        try {
            $property = Property::create($data);
            if (request()->hasFile('images')) {
                foreach ($actionRequest->images as $image) {
                    $property->addMedia($image)->toMediaCollection('posts', 'posts');
                }
            }
            flash()->addSuccess(__('messages.action_success'));

            return to_route('property.not.approved.all');
        } catch (\Throwable $e) {
            throw $e;
            flash()->addError(__('messages.action_error'));

            return back();
        }
    }
}
