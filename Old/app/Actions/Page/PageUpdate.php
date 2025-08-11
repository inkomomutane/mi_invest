<?php

namespace App\Actions\Page;

use App\Models\Page;
use App\Support\Enums\Pages;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class PageUpdate
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function rules(): array
    {
        return
        [
            'name' => 'nullable|string|max:125',
            'content' => 'nullable|string|max:500',
            'slogan' => 'nullable|string|max:125',
            'email' => 'nullable|email',
            'location' => 'nullable|string|max:125',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'contacts' => 'nullable|array',

            'homeMedia' => 'nullable',
            'homeMedia.*' => 'nullable|image|max:15360',

            'propertiesMedia' => 'nullable',
            'propertiesMedia.*' => 'nullable|image|max:15360',

            'aboutMedia' => 'nullable',
            'aboutMedia.*' => 'nullable|image|max:15360',

            'contactMedia' => 'nullable',
            'contactMedia.*' => 'nullable|image|max:15360',

            'termsMedia' => 'nullable',
            'termsMedia.*' => 'nullable|image|max:15360',

            'policyMedia' => 'nullable',
            'policyMedia.*' => 'nullable|image|max:15360',

            'logoMedia' => 'nullable',
            'logoMedia.*' => 'nullable|image|max:15360',
        ];
    }

    public function __invoke(Request $actionRequest)
    {
        try {

            $page = Page::all()->first();

            $page->content = $actionRequest->content;
            $page->name = $actionRequest->name;
            $page->slogan = $actionRequest->slogan;
            $page->location = $actionRequest->location;
            $page->email = $actionRequest->email;
            $page->facebook = $actionRequest->facebook;
            $page->instagram = $actionRequest->instagram;
            $page->whatsapp = $actionRequest->whatsapp;
            $page->save();

            if ($actionRequest->file('homeMedia')) {

                foreach ($actionRequest->file('homeMedia') as $file) {
                    $page->addMedia($file)->toMediaCollection(Pages::HOME, 'pages');
                }

            }

            if ($actionRequest->file('propertiesMedia')) {

                foreach ($actionRequest->file('propertiesMedia') as $file) {
                    $page->addMedia($file)
                        ->toMediaCollection(Pages::IMOVELS, 'pages');
                }

            }

            if ($actionRequest->file('aboutMedia')) {

                foreach ($actionRequest->file('aboutMedia') as $file) {
                    $page->addMedia($file)
                        ->toMediaCollection(Pages::ABOUT, 'pages');
                }

            }

            if ($actionRequest->file('contactMedia')) {

                foreach ($actionRequest->file('contactMedia') as $file) {
                    $page->addMedia($file)
                        ->toMediaCollection(Pages::CONTACT, 'pages');
                }

            }

            if ($actionRequest->file('termsMedia')) {

                foreach ($actionRequest->file('termsMedia') as $file) {
                    $page->addMedia($file)
                        ->toMediaCollection(Pages::TERMS, 'pages');
                }

            }

            if ($actionRequest->file('policyMedia')) {

                foreach ($actionRequest->file('policyMedia') as $file) {
                    $page->addMedia($file)
                        ->toMediaCollection(Pages::POLICY, 'pages');
                }

            }

            if ($actionRequest->file('logoMedia')) {

                foreach ($actionRequest->file('logoMedia') as $file) {
                    $page->addMedia($file)
                        ->toMediaCollection(Pages::LOGO, 'pages');
                }
            }
            flash()->addSuccess(__('messages.action_success'));

        } catch (\Throwable $th) {
            throw $th;
            flash()->addErro('Erro ao actualizar dados globais do site.');
        }

         return to_route('mproperty');
    }
}
