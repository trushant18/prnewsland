<?php

namespace App\Repositories;

use App\Interfaces\ContactRequestRepositoryInterface;
use App\Models\ContactRequest;

class ContactRequestRepository implements ContactRequestRepositoryInterface
{
    public function getAllRequests()
    {
        return ContactRequest::all();
    }

    public function storeContactForm($request)
    {
        $requestData = $request->except('_token');
        ContactRequest::create($requestData);
        return true;
    }
}