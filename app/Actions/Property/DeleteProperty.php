<?php

namespace App\Actions\Property;

use App\Models\Property;

class DeleteProperty
{

    public function __invoke(Property $property)
    {
        if (! is_null($property)) {
            try {
                $property->delete();
                flash()->addSuccess(__('messages.action_success'));

                return to_route('property.all');
            } catch (\Throwable $e) {
                throw $e;
                flash()->addError(__('messages.action_error'));

                return to_route('property.all');
            }
        } else {
            flash()->addError('error', 'Erro ao deletar: " Contacte o administrador do sistema."');

            return to_route('property.all');
        }
    }
}
