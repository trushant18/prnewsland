<?php

namespace App\Interfaces;

interface ContactRequestRepositoryInterface
{
    public function getAllRequests();

    public function storeContactForm($request);
}