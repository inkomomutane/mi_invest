<?php

namespace App\Actions\Website;

use App\Mail\SendMessagesMail;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;

use Mail;

class SendMessage
{

    public function handle(Agenda $agenda): bool
    {
        try {
            Mail::to($agenda->corretor->email ?? env('MAIL_RECEIVER_EMAIL'))
                ->cc(env('MAIL_ADMIN_RECEIVER_EMAIL'))
                ->bcc(env('MAIL_DEV_RECEIVER_EMAIL'))
                ->send(new SendMessagesMail($agenda));

            return true;
        } catch (\Throwable $th) {
            throw $th;

            return false;
        }
    }

    public function rules(): array
    {
        return [
            'nome_do_cliente' => 'required|string|max:125',
            'email' => 'email|nullable',
            'contacto' => 'string|max:125|nullable',
            'mensagem' => 'required|string',
        ];
    }

    public function __invoke(Request $actionRequest)
    {
        $message = collect($actionRequest->all())
            ->put('broker_id', User::first()->id)
            ->put('data_hora', now())
            ->put('property_id', null)->toArray();

        if ($this->handle(Agenda::create($message))) {
            return back()->with('success', 'A sua mensagem foi enviada com sucesso');
        }

        return back()->with('error', 'Erro ao envia sua mensagem, Tente mais tarde!');
    }
}
