<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateStoreUser;
use App\Interfaces\UserAuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userAuthRepository;

    public function __construct(UserAuthRepositoryInterface $userAuthRepository)
    {
        $this->userAuthRepository = $userAuthRepository;
    }

    public function login()
    {
        if (auth()->user()) return redirect()->route('home');
        return view('front.auth.login');
    }

    public function register()
    {
        if (auth()->user()) return redirect()->route('home');
        return view('front.auth.register');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $userDetail = Auth::user();
            if ($userDetail->status == 0) {
                Auth::logout();
                return redirect()->back()->with('error', 'You have not activated your account yet. Please check your e-mail address you want to sign up with and look for the activation link. You can activate your account to use the system');
            }
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');

        }
    }

    public function storeUser(ValidateStoreUser $request): \Illuminate\Http\RedirectResponse
    {
        $response = $this->userAuthRepository->storeUser($request);
        if ($response['status']) {
            return redirect()->route('user.login')->with('success', 'Check Your Mail For Activation Link...');
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function activateUser($activationKey): \Illuminate\Http\RedirectResponse
    {
        $response = $this->userAuthRepository->activateUser($activationKey);
        if ($response['status']) {
            return redirect()->route('user.login')->with('success', 'You activated your account. Please login with your credentials.');
        } else {
            return redirect()->route('user.login')->with('error', $response['message']);
        }
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function forgotUserPassword()
    {
        if (auth()->user()) return redirect()->route('home');
        return view('front.auth.forgot_password');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendForgotPasswordMail(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $response = $this->userAuthRepository->sendForgotPasswordMail($request);
        if ($response['status']) {
            return redirect()->route('user.login')->with('success', 'Please check your email.');
        } else {
            return redirect()->back()->with('error', $response['message']);
        }
    }

    public function resetUserPassword($token)
    {
        $tokenData = $this->userAuthRepository->checkResetUserToken($token);
        if (isset($tokenData)) {
            return view('front.auth.reset_password', compact('tokenData'));
        } else {
            return redirect()->route('user.forgot_password')->with('error', 'Reset Password link was expired. Please retry your forgot password process.');
        }
    }

    public function resetPasswordStore(Request $request)
    {
        $this->userAuthRepository->resetPasswordStore($request);
        return redirect()->route('user.login')->with('success', 'Password reset successfully. Please try to login with new password.');
    }
}
