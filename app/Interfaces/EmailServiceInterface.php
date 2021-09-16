<?php

namespace App\Interfaces;

interface EmailServiceInterface
{
    public function sendEmail($data = []);
}