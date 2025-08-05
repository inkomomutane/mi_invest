<?php

namespace App\Actions\Property;

use App\Models\Property;
use Illuminate\Http\Request;

class CommentProperty
{

    public function rules(): array
    {
        return [
            'nome' => ['nullable', 'string', 'max:125'],
            'comentario' => ['nullable', 'string', 'max:125'],
        ];
    }

    public function __invoke(Property $property, Request $actionRequest)
    {
        try {
            $property->comentarios()->create($actionRequest->all());

            return back()->with('success', 'Comentário enviado com sucesso')->withHeaders(['#comments']);
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao enviar seu comentário, tente novamente')->withHeaders(['#comments']);
        }
    }
}
