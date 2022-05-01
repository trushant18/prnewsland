@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Payment Methods</h3>
        </div>
        <!-- boxes -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Choose any method and continue your process</h4>
                        @include('admin.layout.partials.flash_messages')
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="razorpayMethod" value="razorpay" checked>
                            <label class="form-check-label" for="razorpayMethod">
                                Razorpay
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="paypalMethod" value="paypal">
                            <label class="form-check-label" for="paypalMethod">
                                PayPal
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right" id="razorpayBtn">
                                <button type="button" onclick="launchBOLT(); return false;" class="btn btn-primary mr-2">Pay {{ $news->planDetails->price }} $
                                </button>
                            </div>
                            <div class="col-md-12 text-right" id="payPalBtn" style="display: none;">
                                <a href="{{ route('make.payment', $news->id) }}" class="btn btn-primary mr-2">Pay {{ $news->planDetails->price }} $</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /boxes -->
    </div>
@endsection
@section('footer_scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">

        $('input[type=radio][name=payment_method]').change(function() {
            $("#razorpayBtn").toggle($(this).val() == 'razorpay');
            $("#payPalBtn").toggle($(this).val() == 'paypal');
        });

        function launchBOLT() {
            $.ajax({
                type: "POST",
                data: {news_id: '{{$news->id}}'},
                url: $app_url + '/payment/get-order',
                success: function (result) {
                    if (result.status == true) {
                        var options = result.data;
                        options.handler = function (response) {
                            var fr = '<form action=\"{{route('payment.verification')}}\" method=\"post\">' +
                                '<input type=\"hidden\" id=\"razorpay_payment_id\" name=\"razorpay_payment_id\" value=\"' + response.razorpay_payment_id + '\" />' +
                                '<input type=\"hidden\" id=\"razorpay_signature\" name=\"razorpay_signature\" value=\"' + response.razorpay_signature + '\" />' +
                                '<input type=\"hidden\" id=\"news_id\" name=\"news_id\" value=\"{{$news->id}}\" />' +
                                '<input type=\"hidden\" name=\"txnid\" value=\"' + options.txnid + '\" />' +
                                '</form>';
                            var form = jQuery(fr);
                            jQuery('body').append(form);
                            form.submit();
                        };
                        options.modal = {
                            ondismiss: function () {
                            },
                            // Boolean indicating whether pressing escape key
                            // should close the checkout form. (default: true)
                            escape: true,
                            // Boolean indicating whether clicking translucent blank
                            // space outside checkout form should close the form. (default: false)
                            backdropclose: false
                        };
                        var rzp = new Razorpay(options);
                        rzp.open();
                    }else{
                        toastr.error(result.message, "Error!", {timeOut: 2000});
                    }
                },
                error: function (data) {
                    console.log("abandoned - error");
                }
            });
        }
    </script>
@endsection
