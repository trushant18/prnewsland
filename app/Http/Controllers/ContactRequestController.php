<?php

namespace App\Http\Controllers;

use App\Interfaces\ContactRequestRepositoryInterface;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    protected $contactRequestRepository;

    public function __construct(ContactRequestRepositoryInterface $contactRequestRepository)
    {
        $this->contactRequestRepository = $contactRequestRepository;
    }

    public function index()
    {
        $contact_requests = $this->contactRequestRepository->getAllRequests();
        return view('admin.contact_requests.index', compact('contact_requests'));
    }

    public function getContactDetails()
    {
        return view('front.contact');
    }

    public function storeContactForm(Request $request)
    {
        $this->contactRequestRepository->storeContactForm($request);
        return redirect()->back()->with('success', 'Contact request sent successfully.');
    }
}
