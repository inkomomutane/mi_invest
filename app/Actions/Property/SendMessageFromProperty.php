<?php

namespace App\Actions\Property;

use App\Actions\Website\SendMessage;
use App\Models\Property;
use Illuminate\Http\Request;

class SendMessageFromProperty
{

    public function rules(): array
    {
        return [
            'nome_do_cliente' => 'required|string|max:125',
            'email' => 'email|nullable',
            'contacto' => 'string|max:125|nullable',
            'mensagem' => 'required|string',
        ];
    }

    public function __invoke(Property $property, Request $actionRequest)
    {
        $message = collect($actionRequest->all())
            ->put('broker_id', $property->broker_id)
            ->put('data_hora', now())
            ->put('property_id', $property->id)->toArray();
        if ((SendMessage::run(Agenda::create($message)))) {
            return back()->with('success', 'A sua mensagem foi enviada com sucesso');
        }

        return back()->with('error', 'Erro ao envia sua mensagem, Tente mais tarde!');
    }
}
