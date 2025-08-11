<?php

namespace App\Actions\Message;

use App\Data\AgendaData;
use App\Models\Agenda;
use Auth;
use Inertia\Inertia;

class GetMessages
{

    public function handle()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasAnyRole('Admin', 'Super-Admin')) {
            return AgendaData::collect(
                Agenda::with('property')->orderBy('is_readed', 'asc')->
            orderBy('updated_at', 'desc')->paginate(7));
        } else {
            return AgendaData::collect(
                Agenda::whereCorretorId(Auth::user()->id)->with('property')->orderBy('is_readed', 'asc')->
            orderBy('updated_at', 'desc')->paginate(7));
        }
    }

    public function __invoke()
    {
        return Inertia::render('Message/Index', [
            'messages_agendas' => $this->handle(),
        ]);
    }
}
