<?php

namespace App\Actions\Message;

use App\Models\Agenda;
use Illuminate\Http\Request;

class UpdateMassageReadState
{

    public function handle(Agenda $agenda, bool $isReaded)
    {
        $agenda->is_readed = $isReaded;
        $agenda->save();

        return $agenda->getData();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'is_readed' => 'boolean',
        ];
    }

    public function __invoke(Agenda $agenda, Request $actionRequest)
    {

        return $this->handle($agenda, $actionRequest->is_readed);

    }
}
