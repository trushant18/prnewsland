<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateEmailTemplate;
use App\Interfaces\EmailTemplateRepositoryInterface;

class EmailTemplateController extends Controller
{
    protected $emailTemplateRepository;

    public function __construct(EmailTemplateRepositoryInterface $emailTemplateRepository)
    {
        $this->emailTemplateRepository = $emailTemplateRepository;
    }

    public function index()
    {
        $email_templates = $this->emailTemplateRepository->getAllEmailTemplates();
        return view('admin.email_templates.index', compact('email_templates'));
    }

    public function create()
    {
        $email_events = $this->emailTemplateRepository->getEmailEventsTitles();
        return view('admin.email_templates.create', compact('email_events'));
    }

    public function store(ValidateEmailTemplate $request)
    {
        $this->emailTemplateRepository->storeEmailTemplate($request);
        return redirect()->route('admin.email_templates')->with('success', 'Data Created Successfully.');
    }

    public function edit($id)
    {
        $email_events = $this->emailTemplateRepository->getEmailEventsTitles($id);
        $template = $this->emailTemplateRepository->getEmailTemplateDetails($id);
        return view('admin.email_templates.edit', compact('template', 'email_events'));
    }

    public function update(ValidateEmailTemplate $request, $id)
    {
        $this->emailTemplateRepository->updateEmailTemplate($request, $id);
        return redirect()->route('admin.email_templates')->with('success', 'Data Updated Successfully.');
    }

    public function delete($id)
    {
        $this->emailTemplateRepository->deleteEmailTemplate($id);
        return redirect()->route('admin.email_templates')->with('success', 'Data Deleted Successfully.');
    }
}