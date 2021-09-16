<?php

namespace App\Interfaces;

interface EmailTemplateRepositoryInterface
{
    public function getAllEmailTemplates();

    public function getEmailEventsTitles($id = null);

    public function storeEmailTemplate($request);

    public function getEmailTemplateDetails($id);

    public function updateEmailTemplate($request, $id);

    public function deleteEmailTemplate($id);
}