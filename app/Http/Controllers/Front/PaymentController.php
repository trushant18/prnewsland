<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function paidNewsFrom($news_id)
    {
        $user = auth()->user();
        $news = News::where('payment_status', 0)->where('is_free', 0)->where('user_id', $user->id)->where('id', $news_id)->first();
        if (isset($news)){
            return view('user.paid_news_form', compact('user', 'news'));
        }else{
            return redirect()->back()->with('error', 'Invalid Request');
        }
    }

    public function getOrderId(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = auth()->user();
            $response = ["status" => false, "message" => "Please try after some time."];
            if (auth()->check()) {
                $requestData = $request->all();
                $news = News::where('id', '=', $requestData['news_id'])->first();
                if ($news) {
                    $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
                    $orderData = [
                        'receipt' => "Txn" . rand(10, 99) . date("YmdHis"),
                        'amount' => $news->planDetails->inr_price * 100,
                        'currency' => 'INR',
                        'payment_capture' => 1
                    ];
                    $razorpayOrder = $api->order->create($orderData);
                    $razorpayOrderId = $razorpayOrder['id'];
                    $data = [
                        "key" => env('RAZOR_KEY'),
                        "amount" => $orderData['amount'],
                        "name" => $news->title,
                        "description" => $news->title,
                        "image" => asset('front/images/favicon.png'),
                        "prefill" => [
                            "name" => $user->first_name . ' ' . $user->last_name,
                            "email" => $user->email,
                        ],
                        "notes" => [
                            "address" => "",
                            "merchant_order_id" => $orderData['receipt'],
                        ],
                        "order_id" => $razorpayOrderId,
                    ];
                    $response = ["status" => true, "data" => $data];
                }
            }
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => $e->getMessage()]);
        }
    }

    public function verification(Request $request): \Illuminate\Http\RedirectResponse
    {
        $requestData = $request->all();
        if (isset($requestData['razorpay_payment_id']) && !empty($requestData['razorpay_payment_id'])) {
            DB::beginTransaction();
            try {
                $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
                $payment = $api->payment->fetch($requestData['razorpay_payment_id']);
                if ($payment) {
                    $user = auth()->user();
                    $news = News::find($requestData['news_id']);
                    $news->update(['payment_status' => 1]);
                    Transaction::create([
                        'user_id' => $user->id,
                        'news_id' => $news->id,
                        'price' => ($payment->amount / 100),
                        'payment_id' => $payment->id,
                        'type' => 'razorpay',
                        'details' => json_encode($payment->toArray())
                    ]);
                    DB::commit();
                    return redirect()->route('user.press_releases')->with('success', 'Payment Captured Successfully');
                }
                return redirect()->route('paidNewsFrom', $requestData['news_id'])->with('error', 'something went wrong');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('paidNewsFrom', $requestData['news_id'])->with('error', $e->getMessage());
            }
        } else {
            return redirect()->route('paidNewsFrom', $requestData['news_id'])->with('error', 'Invalid request');
        }
    }
}
