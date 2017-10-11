@extends('layouts.n_app')

@section('content')
<div class="bgcolor">
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-push-1 text-center">
            <h5>3-BUREAU</strong></h5>
            <h3 class="mheadline">SEE YOUR CREDIT SCORES & FULL REPORT</h3>
        </div>
    </div>

    <div class="row mpoints">
        <div class="col-md-4 midcenter vroof">
            <h4>7-Day Free Trial</h4>
        </div>
        <div class="col-md-4 midcenter">
            <h4>Monthly Credit Monitoring and $1M Protection for Just $29.95 per Month</h4>
        </div>
        <div class="col-md-4 midcenter vroof">
            <h4>Easy Online Cancellation</h4>
        </div>
    </div>
</div>
</div>

<div class="lined">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <img class="img-responsive" src="{{ asset('i/scoreicon.png') }}" alt="">
                <p>Free Monthly 3-Bureau Credit Report</p>
            </div>
            <div class="col-md-4 center-feature text-center">
                <h3>See Your Scores Now</h3>
                <p>Get your full credit report from all three credit reporting agencies in minutes.</p>
                <p><em>Checking your credit will not harm your score.</em></p>
                @if (empty(Auth::user()->id))

                <form class="form-horizontal" method="POST">
                    {{ csrf_field() }}

                    <div class="row startform">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">First Name</label>
                                <div class="col-md-8 startformfield">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required>

                                    @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-8 startformfield">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>

                                    @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-8 startformfield">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-warning text-center startbtn">
                        GET STARTED NOW
                    </button>
                </form>
                @else
                <a class="btn btn-primary btn-lg btn-warning text-center startbtn" href="{{ route('home') }}">
                    Go to My Account
                </a>
                @endif
            </div>
            <div class="col-md-4 text-center">
                <img style="height: 300px; margin: 50px 0 10px; padding: 0 0 25px;" src="{{ asset('i/checkbadge.png') }}" alt="">
                <p>$1M in Identity Protection</p>
            </div>
        </div>
    </div>
</div>
{{--  End Grey row  --}}

<div class="container">
    <div class="row iconrow">
        <div class="col-md-4 text-center">
            <i class="fa fa-tablet-alt fa-4x"></i>
            <h4>Access Anytime</h4>
        </div>
        <div class="col-md-4 text-center">
            <i class="fa fa-lock-alt fa-4x"></i>
            <h4>Secure Online Delivery</h4>        
        </div>
        <div class="col-md-4 text-center">
            <i class="fa fa-shield-check fa-4x"></i>
            <h4>24/7 Credit Monitoring</h4>         
        </div>
    </div>
    <div class="row iconrow">
        <div class="col-md-4 text-center">
            <i class="fa fa-check-circle fa-4x"></i>
            <h4>All 3 Bureaus</h4>
        </div>
        <div class="col-md-4 text-center">
            <i class="fa fa-sign-out fa-4x"></i>
            <h4>Easy Online Cancellation</h4>        
        </div>
        <div class="col-md-4 text-center">
            <i class="fa fa-bolt fa-4x"></i>
            <h4>Fast Access</h4>         
        </div>
    </div>   
</div>

@endsection
