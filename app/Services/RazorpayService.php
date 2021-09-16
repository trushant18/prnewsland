<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\PackageSubscription;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class RazorpayService
{
    public function createRazorpayBookingId($unique_id)
    {
        $total_amount = Booking::where('unique_booking_key', $unique_id)->sum(DB::raw('quantity * customer_price'));
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $response = $api->order->create(
            ['receipt' => 'order_rcptid_' . $unique_id,
                'amount' => $total_amount * 100,
                'currency' => 'INR']);
        $razorpayOrderId = $response['id'];
        Booking::where('unique_booking_key', $unique_id)->update(['razorpay_order_id' => $razorpayOrderId]);
        if ($response) {
            return ['result_status' => true, 'razorpay_order_id' => $razorpayOrderId];
        }
        return ['result_status' => false, 'error' => $response->getMessage()];
    }

    public function createSubscriptionOrderId($package_subscription_id)
    {
        $packageSubscription = PackageSubscription::findOrFail($package_subscription_id);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $response = $api->order->create(
            ['receipt' => 'order_rcptid_' . $packageSubscription->unique_key,
                'amount' => $packageSubscription->total_amount * 100,
                'currency' => 'INR']);
        $razorpayOrderId = $response['id'];
        $packageSubscription->update(['razorpay_order_id' => $razorpayOrderId]);
        if ($response) {
            return ['result_status' => true, 'razorpay_order_id' => $razorpayOrderId, 'order_id' => 'order_rcptid_' . $packageSubscription->unique_key];
        }
        return ['result_status' => false, 'error' => $response->getMessage()];
    }

    public function sendPaymentLink($booking)
    {
        try {
            $message = 'Payment Link for service on ' . formatDate($booking->service_date, "d/m/Y h:i A");
            $postData = "type=link";
            $postData .= "&amount=" . ($booking->total_amount * 100) . "&currency=INR";
            $postData .= "&description=" . $message;
            $postData .= "&customer[name]=" . $booking->customer->name . "&customer[contact]=" . $booking->customer->contact_number;
            $postData .= "&callback_method=get&callback_url=" . route('app.dopayment');
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/invoices');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_KEY') . ':' . env('RAZORPAY_SECRET'));

            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            $err = curl_error($ch);
            curl_close($ch);
            if (!$err) {
                return ['status' => true, 'message' => 'Message Sent Successfully', 'data' => json_decode($response, true)];
            }
            return ['status' => false, 'message' => $err, 'data' => json_decode($response, true)];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}