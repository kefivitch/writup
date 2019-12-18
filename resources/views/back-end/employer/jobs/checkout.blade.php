@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <section class="wt-haslayout wt-dbsectionspace">
        <div class="row">
            <div class=" col-sm-12 col-md-8 push-md-2 col-lg-8 push-lg-2" id="packages">
                <div class="preloader-section" v-if="loading" v-cloak>
                    <div class="preloader-holder">
                        <div class="loader"></div>
                    </div>
                </div>
                <div class="wt-dashboardbox">
                @if (Session::has('message'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                    </div>
                    @php session()->forget('message') @endphp;
                @elseif (Session::has('error'))
                    <div class="flash_msg">
                        <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ str_replace("'s", " ",Session::get('error')) }}}'" v-cloak></flash_messages>
                    </div>
                    @php session()->forget('error') @endphp;
                @endif
                <div class="sj-checkoutjournal">
                    <div class="sj-title">
                        <h3>{{{trans('lang.checkout')}}}</h3>
                    </div>
                    @php
                        session()->put(['product_id' => e($proposal->id)]);
                        session()->put(['product_title' => e($job->title)]);
                        session()->put(['product_price' => e($proposal->amount)]);
                        session()->put(['type' => 'project']);
                    @endphp
                    <table class="sj-checkouttable">
                        <thead>
                            <tr>
                                <th>{{trans('lang.item_title')}}</th>
                                <th>{{trans('lang.details')}}</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="sj-producttitle">
                                            <div class="sj-checkpaydetails">
                                                @if (!empty($job->title))
                                                    <h4>{{{$job->title}}}</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{{$proposal->amount}}} </td>
                                </tr>
                                <tr>
                                    <td>{{ trans('lang.freelancer') }}</td>
                                    <td>{{{ $freelancer_name }}}</td>
                                </tr>
                                <tr>
                                    <td>Montant HT :</td>
                                    <td>{{{ $proposal->amount }}} {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}</td>
                                </tr>
                                <tr>
                                    <td>TVA <small class="text-secondary">(19%)</small>: </td>
                                    <td>{{{ $proposal->amount * 0.19}}} {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}</td>
                                </tr>
                                <tr>
                                    <td>TTC :</td>
                                    <td>{{{ $proposal->amount + ($proposal->amount * 0.19)}}} {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if (!empty($payment_gateway))
                        <div class="sj-checkpaymentmethod">
                            <div class="sj-title">
                                <!--<h3>{{ trans('lang.select_pay_method') }}</h3>-->
                                <h3>Continuer le paiement</h3>
                            </div>
                            <ul class="sj-paymentmethod"><!--
                                @foreach ($payment_gateway as $gatway)
                                    <li>
                                        @if ($gatway == "paypal")
                                            <a href="{{{url('paypal/ec-checkout')}}}">
                                                <i class="fa fa-paypal"></i>
                                                <span><em>{{ trans('lang.pay_amount_via') }}</em> {{ Helper::getPaymentMethodList($gatway)['title']}} {{ trans('lang.pay_gateway') }}</span>
                                            </a>
                                        @elseif ($gatway == "stripe")
                                            <a href="javascrip:void(0);" v-on:click.prevent="getStriprForm">
                                                <i class="fab fa-stripe-s"></i>
                                                <span><em>{{ trans('lang.pay_amount_via') }}</em> {{ Helper::getPaymentMethodList($gatway)['title']}} {{ trans('lang.pay_gateway') }}</span>
                                            </a>
                                        @endif
                                    </li>
                                @endforeach-->
                                @php
                                    $NumSite = 'MAR762';
                                    $Password = 're#yjL10';
                                    $Amount = $proposal->amount*1000+($proposal->amount*0.19)*1000;
                                    $Devise = 'TND';
                                    $orderId = date('ymdHis');
                                    $signture = sha1($NumSite.$Password.$orderId.$Amount.$Devise);
                                @endphp
                                <FORM name="paiment" method="POST" action="https://preprod.gpgcheckout.com/Paiement_test/Validation_paiement.php" >
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="NumSite" value="<?php echo $NumSite;?>">
                                    <input type="hidden" name="Password" value="<?php echo md5($Password);?>">
                                    <input type="hidden" name="orderID" value="<?php echo $orderId ;?>">
                                    <input type="hidden" name="Amount" value="<?php echo $Amount;?>">
                                    <input type="hidden" name="Currency" value="<?php echo $Devise;?>">
                                    <input type="hidden" name="signature" value="<?php echo $signture;?>">
                                    <input type="hidden" name="Language" value="fr">
                                    <input type="hidden" name="EMAIL" value="{{ Auth::user()->email }}">
                                    <input type="hidden" name="CustLastName" value="{{ Auth::user()->first_name }}">
                                    <input type="hidden" name="CustFirstName" value="{{ Auth::user()->last_name }}">
                                    <input type="hidden" placeholder="Saisir votre ville" name="CustCity" value="">
                                    <input type="hidden" name="CustCountry" value="tunisie">
                                    <input type="hidden" name="CustTel" value="{{ Auth::user()->phone }}">
                                    <input type="hidden" name="PayementType" value="1">
                                    <input type="hidden" name="MerchandSession" value="{{ $proposal->id }}">
                                    <input type="hidden" name="orderProducts" value="{{ $job->title }}">
                                    <input type="hidden" name="vad" value="924200003">
                                    <input type="hidden" name="Terminal" value="001">
                                    <input type="hidden" name="TauxConversion" value=" ">
                                    <input type="hidden" name="BatchNumber" value=" ">
                                    <input type="hidden" name="MerchantReference" value="">
                                    <input type="hidden" name="Reccu_Num" value="">
                                    <input type="hidden" name="Reccu_ExpiryDate " value="">
                                    <input type="hidden" name="Reccu_Frecuency " value=" ">
                                    
                                    
                                    <div class="row mt-3">
                                        <div class="col-sm-9"></div>
                                        <div class="col-sm-3">
                                            <input type="submit" name="Valider" value="Valider" class="wt-btn">
                                        </div>
                                    </div>
                                    
                                </FORM>
                            </ul>
                        </div>
                    @endif
                </div>
                <b-modal ref="myModalRef" hide-footer title="Stripe Payment" class="la-pay-stripe">
                    <div class="d-block text-center">
                        <form class="wt-formtheme wt-form-paycard" method="POST" id="stripe-payment-form" role="form" action="" @submit.prevent='submitStripeFrom'>
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group wt-inputwithicon {{ $errors->has('card_no') ? ' has-error' : '' }}">
                                    <label>{{ trans('lang.card_no') }}</label>
                                    <img src="{{asset('images/pay-icon.png')}}">
                                    <input id="card_no" type="text" class="form-control" name="card_no" value="{{ old('card_no') }}" autofocus>
                                    @if ($errors->has('card_no'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('card_no') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('ccExpiryMonth') ? ' has-error' : '' }}">
                                    <label>{{ trans('lang.expiry_month') }}</label>
                                    <input id="ccExpiryMonth" type="number" class="form-control" name="ccExpiryMonth" value="{{ old('ccExpiryMonth') }}" min="1" max="12" autofocus>
                                    @if ($errors->has('ccExpiryMonth'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ccExpiryMonth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('ccExpiryYear') ? ' has-error' : '' }}">
                                    <label>{{ trans('lang.expiry_year') }}</label>
                                    <input id="ccExpiryYear" type="text" class="form-control" name="ccExpiryYear" value="{{ old('ccExpiryYear') }}" autofocus>
                                    @if ($errors->has('ccExpiryYear'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ccExpiryYear') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group wt-inputwithicon {{ $errors->has('cvvNumber') ? ' has-error' : '' }}">
                                    <label>{{ trans('lang.cvc_no') }}</label>
                                    <img src="{{asset('images/pay-img.png')}}">
                                    <input id="cvvNumber" type="text" class="form-control" name="cvvNumber" value="{{ old('cvvNumber') }}" autofocus>
                                    @if ($errors->has('cvvNumber'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cvvNumber') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group wt-btnarea">
                                    <input type="submit" name="button" class="wt-btn" value="Pay {{ !empty($symbol['symbol']) ? $symbol['symbol'] : '$' }}{{$proposal->amount}}">
                                </div>
                            </fieldset>
                        </form>
                    </b-modal>
                </div>
            </div>
        </div>
    </section>
@endsection
