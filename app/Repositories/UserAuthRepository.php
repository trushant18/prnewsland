<?php

namespace App\Repositories;

use App\Events\SendResetPasswordMailEvent;
use App\Events\UserActivationMailEvent;
use App\Interfaces\UserAuthRepositoryInterface;
use App\Models\PasswordResets;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserAuthRepository implements UserAuthRepositoryInterface
{
    public function storeUser($request): array
    {
        DB::beginTransaction();
        try {
            $requestData = $request->except('_token');
            $requestData['activation_key'] = Str::random(15);
            $user = User::create($requestData);
            event(new UserActivationMailEvent($user));
            DB::commit();
            return ['status' => true];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function activateUser($key): array
    {
        $user = User::where('activation_key', $key)->first();
        if (isset($user)) {
            $user->update([
                'status' => 1,
                'activation_key' => null,
                'email_verified_at' => Carbon::now(),
            ]);
            return ['status' => true];
        }
        return ['status' => false, 'message' => 'You already use this activation process.'];
    }

    public function sendForgotPasswordMail($request): array
    {
        DB::beginTransaction();
        try {
            $requestData = $request->except('_token');
            $token = Str::random(15);
            $user = User::where('email', $requestData['email'])->first();
            if (isset($user)) {
                $emailData = array('email' => $requestData['email'], 'token' => $token, 'created_at' => Carbon::now());
                $emailExist = PasswordResets::where('email', $requestData['email'])->first();
                if (isset($emailExist)) {
                    PasswordResets::where('email', '=', $requestData['email'])->update($emailData);
                } else {
                    PasswordResets::create($emailData);
                }
                $emailData['reset_link'] = route('user.reset_password', $token);
                $emailData['name'] = $user->first_name . ' ' . $user->last_name;
                event(new SendResetPasswordMailEvent($emailData));
                DB::commit();
                return ['status' => true];
            } else {
                DB::rollBack();
                return ['status' => false, 'message' => 'User does not exist.'];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function resetPasswordStore($request)
    {
        $requestData = $request->except('_token');
        $user = User::where('email', $requestData['email'])->first();
        $user->update(['password' => $requestData['password']]);
        return true;
    }

    public function checkResetUserToken($token)
    {
        return PasswordResets::where('token', $token)->first();
    }
}
