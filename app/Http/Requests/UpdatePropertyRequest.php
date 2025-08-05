<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'titulo' => ['required', 'string', Rule::unique(Property::class, 'titulo')->ignore($this->property->id, 'id')],
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
}
