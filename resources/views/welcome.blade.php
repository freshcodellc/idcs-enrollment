@extends('layouts.app')

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
                <a class="btn btn-primary btn-lg btn-warning text-center startbtn" href="{{ route('register') }}">
                    GET STARTED NOW
                </a>
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

@endsection
