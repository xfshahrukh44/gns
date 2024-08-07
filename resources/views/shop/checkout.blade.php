@extends('layouts.main')
@section('title', 'Checkout')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"
          integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .payment-accordion img {
            display: inline-block;
            margin-left: 10px;
            background-color: white;
        }

        form#order-place .form-control {
            border-width: 1px;
            border-color: rgb(255 255 255);
            border-style: solid;
            border-radius: 8px;
            background-color: transparent;
            height: 54px;
            padding-left: 15px;
            color: #fff;
        }

        form#order-place textarea.form-control {
            height: auto !important;
        }

        .checkoutPage {
            padding: 50px 0px;
        }

        .checkoutPage .section-heading h3 {
            margin-bottom: 30px;
        }

        .YouOrder {
            background-color: #c91d22;
            color: white;
            padding: 25px;
            padding-bottom: 2px;
            min-height: 300px;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .amount-wrapper {
            padding-top: 12px;
            border-top: 2px solid white;
            text-align: left;
            margin-top: 90px;
        }

        .amount-wrapper h2 {
            font-size: 20px;
            display: flex;
            justify-content: space-between;
        }

        .amount-wrapper h3 {
            display: FLEX;
            justify-content: SPACE-BETWEEN;
            font-size: 22px;
            border-top: 2px solid white;
            padding-top: 10px;
            margin-top: 14px;
        }

        .checkoutPage span.invalid-feedback strong {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            display: block;
            width: 100%;
            font-size: 15px;
            padding: 5px 15px;
            border-radius: 6px;
        }

        .payment-accordion .btn-link {
            display: block;
            width: 100%;
            text-align: left;
            padding: 10px 19px;
            color: black;
        }

        .payment-accordion .card-header {
            padding: 0px !important;
        }

        .payment-accordion .card-header:first-child {
            border-radius: 0px;
        }

        .payment-accordion .card {
            border-radius: 0px;
        }

        .form-group.hide {
            display: none;
        }

        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
            border-width: 1px;
            border-color: rgb(150, 163, 218);
            border-style: solid;
            margin-bottom: 10px;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        div#card-errors {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            display: block;
            width: 100%;

            font-size: 15px;
            padding: 5px 15px;
            border-radius: 6px;
            display: none;
            margin-bottom: 10px;
        }

        .proceed_button2 {
            background-color: transparent;
            width: 100% !important;
            color: #c0c0c0;
            border-radius: unset;
            height: 50px !important;
            border: 1px solid #c0c0c0;
        }


        a {

            text-decoration: none;
        }

        a:hover {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        h3 {
            color: #fff;
        }

        .customp {
            font-family: cursive;
            font-weight: bold;
        }

        .custompp {
            font-weight: bold;
            font-size: 17px;
        }

        input {
            color: black !important;
            border: 1px solid #000 !important;
        }


        textarea {
            color: black !important;
            border: 1px solid #000 !important;
        }

    </style>
@endsection
@section('content')



    <section class="heading-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-headings">
                        <h2> CHECKOUT </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="form-body checkoutPage">
        <div class="container">

            <form action="{{route('order.place')}}" method="POST" id="order-place">

                @csrf

                <?php $subtotal = 0; $addon_total = 0; $variation = 0; ?>

                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
                        <div class="section-heading dark-color">
                            <h3>Billing Address</h3>
                        </div>
                        @if (\Session::has('stripe_error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('stripe_error') !!}
                            </div>
                        @endif

                        <input type="hidden" name="payment_id" value=""/>
                        <input type="hidden" name="payer_id" value=""/>
                        <input type="hidden" name="payment_status" value=""/>
                        <input type="hidden" name="payment_method" id="payment_method" value="stripe"/>


                        {{--                    @if(Auth::check())--}}
                        <?php  $_getUser = DB::table('users')->where('id', '=', Auth::user()->id)->first();?>
                        <div class="form-group">
                            <label for="">First Name *</label>
                            <input class="form-control" id="f-name" name="first_name"
                                   value="{{old('first_name')?old('first_name'):$_getUser->name}}" placeholder=""
                                   style="color: black;" type="text" required autofocus style="color: black;">
                            <span class="invalid-feedback fname {{ ($errors->first('first_name') ? 'd-block' : '') }}">
                              <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Address *</label>
                            <input class="form-control" id="address" name="address_line_1" placeholder=""
                                   style="color: black;" type="text" value="{{old('address_line_1')}}" required>
                            <span class="invalid-feedback {{ ($errors->first('address_line_1') ? 'd-block' : '') }}">
                              <strong>{{ $errors->first('address_line_1') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Town / City *</label>
                            <input class="form-control right" placeholder="" style="color: black;" name="city" id="city"
                                   type="text" required>
                            <span class="invalid-feedback {{ ($errors->first('city') ? 'd-block' : '') }}">
                              <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" name="country" id="country" class="form-control left" placeholder=""
                                   style="color: black;">
                            <span class="invalid-feedback {{ ($errors->first('country') ? 'd-block' : '') }}">
                              <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Phone *</label>
                            <input class="form-control right" placeholder="" style="color: black;" name="phone_no"
                                   type="text" value="{{old('phone_no')}}" required>
                            <span class="invalid-feedback {{ ($errors->first('phone_no') ? 'd-block' : '') }}">
                              <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input class="form-control left" name="email" placeholder="" style="color: black;"
                                   type="email" value="{{old('email')?old('email'):$_getUser->email}}" required>
                            <span class="invalid-feedback {{ ($errors->first('email') ? 'd-block' : '') }}">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="">Postcode</label>
                            <input class="form-control" id="zip_code" name="zip_code" placeholder=""
                                   style="color: black;" type="text" value="{{old('zip_code')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Order Note</label>
                            <textarea class="form-control" id="comment" name="order_notes" placeholder=""
                                      style="color: black;" rows="5">{{old('order_notes')}}</textarea>
                        </div>
                        {{--                    @else--}}
                        {{--                    --}}

                        {{--                        <a style="text-decoration: none;" href="{{ url('signin') }}" target="_blank" class="btn proceed_button2"> You can not purchase without authentication (Please Signin Now) </a>--}}
                        {{--                  --}}
                        {{--                    @endif--}}

                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-5 col-xs-12">
                        <div class="section-heading dark-color">
                            <h3>YOUR ORDER</h3>
                        </div>
                        <div class="YouOrder">

                            @foreach($cart as $key=>$value)
                                <p class="custompp"> {{ $value['name'] }} <span class="customp"> x {{ $value['qty'] }} = ${{ $value['baseprice'] * $value['qty'] }} </span>
                                </p>
{{--                                <p class="custompp" style="margin-top: -15px;margin-left: 15px;"> > variation price--}}

{{--                                    <span class="customp">--}}

{{--                        <?php $t_var = 0;?>--}}
{{--                                        @foreach ($value['variation'] as $key => $values)--}}
{{--                                            <?php--}}
{{--                                            $t_var += $values['attribute_price'];--}}
{{--                                            ?>--}}
{{--                                        @endforeach--}}

{{--                        x {{ $value['qty'] }} = ${{ $t_var * $value['qty'] }}--}}

{{--                                        <?php $variation += $t_var * $value['qty']; ?>--}}

{{--                      </span>--}}

{{--                                </p>--}}

                                <hr>

                                <?php $subtotal += $value['baseprice'] * $value['qty'];
                                // $variation += $value['variation_price'];
                                ?>
                            @endforeach
                            <div class="amount-wrapper">
                                <h2> SUBTOTAL <span> <p class="customp">  ${{ $subtotal }} </p> </span></h2>
                                <h2> VARIATIONS <span> <p class="customp">  ${{ $variation }} </p> </span></h2>
                                <h3> Total <span> <p class="customp"> ${{ $subtotal + $variation }} </p> </span></h3>

                                <input type="hidden" name="total_price" value="{{ $subtotal + $variation }}"/>
                                <input type="hidden" name="total_variation_price" value="{{ $variation }}"/>

                            </div>
                        </div>
                        <div id="accordion" class="payment-accordion">


                        <!-- <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" data-payment="paypal">
                          Pay with Paypal <img src="{{ asset('images/paypal.png') }}" width="60" alt="">
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <input type="hidden" name="price" value="{{ $subtotal }}" />
                        <input type="hidden" name="product_id" value="" />
                        <input type="hidden" name="qty" value="value['qty']" />
                        <div id="paypal-button-container-popup"></div>
                      </div>
                    </div>

                  </div> -->


                            <div class="card">

                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="true" aria-controls="collapseTwo" data-payment="stripe">
                                            Pay with Credit Card <img src="{{ asset('images/payment1.png') }}" alt=""
                                                                      width="150">
                                        </button>
                                    </h5>
                                </div>


                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="stripe-form-wrapper require-validation"
                                             data-stripe-publishable-key="{{ config('services.stripe.key') }}"
                                             data-cc-on-file="false">
                                            <div id="card-element"></div>
                                            <div id="card-errors" role="alert"></div>
                                            <div class="form-group">
                                                @if($subtotal + $variation >= 0.5)
                                                    <button class="btn btn-danger btn-block" type="button"
                                                            id="stripe-submit">Pay Now
                                                        ${{ $subtotal + $variation  }}  </button>
                                                @else
                                                    <button class="btn btn-danger btn-block" type="button">Order amount must be at least $0.50 usd</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <button type="submit" class="hvr-wobble-skew" style="display:none">place order</button>
                        <!--   <a class="PaymentMethod-a" id="paypal-button-container-popup" href="#" style="display:none"></a> -->
                    </div>
                </div>

            </form>

        </div>
    </section>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
            integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>

        // $(document).on('click', ".btn", function(e){
        //   $('#order-place').submit();
        // });

        $('#accordion .btn-link').on('click', function (e) {
            if (!$(this).hasClass('collapsed')) {
                e.stopPropagation();
            }
            $('#payment_method').val($(this).attr('data-payment'));
        });

        $('.bttn').on('change', function () {
            var count = 0;
            if ($(this).prop("checked") == true) {
                if ($('#f-name').val() == "") {
                    $('.fname').text('first name is required field');
                } else {
                    $('.fname').text("");
                    count++;
                }
                if ($('#l-name').val() == "") {
                    $('.lname').text('last name is required field');
                } else {
                    $('.lname').text("");
                    count++;
                }

                if (count == 2) {
                    $('#paypal-button-container-popup').show();
                } else {
                    $(this).prop("checked", false);

                    $.toast({
                        heading: 'Alert!',
                        position: 'bottom-right',
                        text: 'Please fill the required fields before proceeding to pay',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });

                    return false;

                }

            } else {
                $('#paypal-button-container-popup').hide();
                // $('.btn').show();
            }

            $('input[name="' + this.name + '"]').not(this).prop('checked', false);
            //$(this).siblings('input[type="checkbox"]').prop('checked', false);
        });

        paypal.Button.render({
            env: 'sandbox', //production

            style: {
                label: 'checkout',
                size: 'responsive',
                shape: 'rect',
                color: 'gold'
            },
            client: {
                sandbox: 'AV06KMdIerC8pd6_i1gQQlyVoIwV8e_1UZaJKj9-aELaeNXIGMbdR32kDDEWS4gRsAis6SRpUVYC9Jmf',
                // production:'ARIYLCFJIoObVCUxQjohmqLeFQcHKmQ7haI-4kNxHaSwEEALdWABiLwYbJAwAoHSvdHwKJnnOL3Jlzje',
            },
            validate: function (actions) {
                actions.disable();
                paypalActions = actions;
            },

            onClick: function (e) {
                var errorCount = checkEmptyFileds();

                if (errorCount == 1) {
                    $.toast({
                        heading: 'Alert!',
                        position: 'bottom-right',
                        text: 'Please fill the required fields before proceeding to pay',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                    paypalActions.disable();
                } else {
                    paypalActions.enable();
                }
            },
            payment: function (data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: {
                                    total: {{number_format(((float)$subtotal+$variation),2, '.', '')}},
                                    currency: 'USD'
                                }
                            }
                        ]
                    }
                });
            },
            onAuthorize: function (data, actions) {
                return actions.payment.execute().then(function () {
                    // generateNotification('success','Payment Authorized');

                    $.toast({
                        heading: 'Success!',
                        position: 'bottom-right',
                        text: 'Payment Authorized',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 1000,
                        stack: 6
                    });

                    var params = {
                        payment_status: 'Completed',
                        paymentID: data.paymentID,
                        payerID: data.payerID
                    };

                    // console.log(data.paymentID);
                    // return false;
                    $('input[name="payment_status"]').val('Completed');
                    $('input[name="payment_id"]').val(data.paymentID);
                    $('input[name="payer_id"]').val(data.payerID);
                    $('input[name="payment_method"]').val('paypal');
                    $('#order-place').submit();
                });
            },
            onCancel: function (data, actions) {
                var params = {
                    payment_status: 'Failed',
                    paymentID: data.paymentID
                };
                $('input[name="payment_status"]').val('Failed');
                $('input[name="payment_id"]').val(data.paymentID);
                $('input[name="payer_id"]').val('');
                $('input[name="payment_method"]').val('paypal');
            }
        }, '#paypal-button-container-popup');


        var stripe = Stripe('{{ env("STRIPE_KEY") }}');

        // Create an instance of Elements.
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {style: style});
        card.mount('#card-element');

        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                $(displayError).show();
                displayError.textContent = event.error.message;
            } else {
                $(displayError).hide();
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('order-place');

        $('#stripe-submit').click(function () {
            stripe.createToken(card).then(function (result) {
                var errorCount = checkEmptyFileds();
                if ((result.error) || (errorCount == 1)) {
                    // Inform the user if there was an error.
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        $(errorElement).show();
                        errorElement.textContent = result.error.message;
                    } else {
                        $.toast({
                            heading: 'Alert!',
                            position: 'bottom-right',
                            text: 'Please fill the required fields before proceeding to pay',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            stack: 6
                        });
                    }
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('order-place');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }


        function checkEmptyFileds() {
            var errorCount = 0;
            $('form#order-place').find('.form-control').each(function () {
                if ($(this).prop('required')) {
                    if (!$(this).val()) {
                        $(this).parent().find('.invalid-feedback').addClass('d-block');
                        $(this).parent().find('.invalid-feedback strong').html('Field is Required');
                        errorCount = 1;
                    }
                }
            });
            return errorCount;
        }


    </script>
@endsection
