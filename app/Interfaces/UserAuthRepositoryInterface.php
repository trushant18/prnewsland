<?php

namespace App\Interfaces;

interface UserAuthRepositoryInterface
{
    public function storeUser($request);

    public function activateUser($key);

    public function sendForgotPasswordMail($request);

    public function resetPasswordStore($request);

    public function checkResetUserToken($token);
}