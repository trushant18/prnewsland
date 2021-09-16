<?php

namespace App\Repositories;

use App\Interfaces\EmailTemplateRepositoryInterface;
use App\Models\EmailTemplate;

class EmailTemplateRepository implements EmailTemplateRepositoryInterface
{
    public function getAllEmailTemplates()
    {
        return EmailTemplate::all();
    }

    public function getEmailEventsTitles($id = null)
    {
        $titles = [];
        $exist_record_actions = EmailTemplate::whereNotNull('id');
        if (isset($id)){
            $exist_record_actions = $exist_record_actions->where('id', '!=', $id);
        }
        $exist_record_actions = $exist_record_actions->pluck('identifier')->toArray();
        $actions = EmailTemplate::EMAIL_EVENTS;
        foreach ($actions as $key => $value) {
            if (!in_array($key, $exist_record_actions)){
                $titles[$key] = $value;
            }
        }
        return $titles;
    }

    public function storeEmailTemplate($request)
    {
        $requestData = $request->except('_token');
        EmailTemplate::create($requestData);
        return true;
    }

    public function getEmailTemplateDetails($id)
    {
        return EmailTemplate::findOrFail($id);
    }

    public function updateEmailTemplate($request, $id)
    {
        $requestData = $request->except('_token');
        $templateDetail = self::getEmailTemplateDetails($id);
        if (isset($templateDetail)) {
            $templateDetail->update($requestData);
        }
        return true;
    }

    public function deleteEmailTemplate($id)
    {
        return EmailTemplate::destroy($id);
    }
}