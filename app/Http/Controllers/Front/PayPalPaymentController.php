<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalPaymentController extends Controller
{
    //https://hackthestuff.com/article/paypal-payment-gateway-integration-in-laravel-8
    public function handlePayment($news_id): \Illuminate\Http\RedirectResponse
    {
        $newsDetails = News::find($news_id);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment', $news_id),
                "cancel_url" => route('cancel.payment', $news_id),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $newsDetails->price
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('paidNewsForm', $news_id)
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()->route('paidNewsForm', $news_id)->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function paymentCancel($news_id): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('paidNewsForm', $news_id)->with('error', 'Something went wrong.');
    }


    public function paymentSuccess(Request $request, $news_id): \Illuminate\Http\RedirectResponse
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        dd($response);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('user.press_releases')->with('error', 'Payment Captured Successfully');
        } else {
            return redirect()->route('paidNewsForm', $news_id)->with('error', 'Something went wrong.');
        }
    }
}


